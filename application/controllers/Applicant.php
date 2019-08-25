<?php

class Applicant extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
        $this->load->helper('security');

        $this->load->library('session');
        // Load Modesl
        $this->load->model('job_model');
		$this->load->model('city_model');
        $this->load->model('candidate_model');
	}
    public function index(){
        
        
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $userdata['userType'] = $_SESSION['userType'];

            $data['title'] = "Manage Client";
            $data['message'] ="";
            $data['jobs'] = $this->job_model->getUnchecked();
            $data['candidates'] = $this->candidate_model->getUnchecked();
            
            $this->load->view('templates/header',$userdata);
            //$this->load->view('pages/lookForApplicants',$data);
            $this->load->view('applicant/tabHeader');
            $this->load->view('applicant/tab1');
            $this->load->view('applicant/tab2');
            $this->load->view('templates/modal');
            $this->load->view('applicant/vue',$data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }
    }

    // show candidate table
	public function manageCandidate(){
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $userdata['userType'] = $_SESSION['userType'];
            $data['title'] = "Manage Candidate";
            $data['message'] ="";
            $data['candidateNum'] = $this->candidate_model->countAll();
            // $data['candidateNum'] = 30;
            $data['candidates'] = $this->candidate_model->getCandidatesWithName(10, 0);
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/manageCandidate',$data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }
		
    }

    // download CV
    public function downloadCV($fileName){
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $path = '/var/www/candidatesCV/'.$fileName;
            force_download($path, NULL);
        } else {
            redirect('/');
        }
    }
    
    
    /**
     * AJAX Methods
     */
    // get a offset value then return candidates
    public function getCandidates(){
            if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $offset=$_POST['offset'];
            $candidates = $this->candidate_model->getCandidatesWithName(10, $offset);
            echo json_encode($candidates);
        } else {
            redirect('/');
        }

    }
    public function applyJob(){
        if(!isset($_SESSION['userEmail'])){
            //redirect('/personcenter/index');
            echo "Please login";
            exit;
        }

        
        $userID = $_SESSION['userID'];
        $data = array(
        'JobInterest' => $this->input->post('jobInterest'),
        'JobType' => $this->input->post('jobType'),
        'Transportation' => $this->input->post('transportation'),
        'LicenseNumber' => $this->input->post('licenseNumber'),
        'ClassLicense' => $this->input->post('classLicense'),
        'Endorsement' => $this->input->post('endorsement'),
        'Citizenship' => $this->input->post('citizenship'),
        'Nationality' => $this->input->post('nationality'),
        'PassportCountry' => $this->input->post('passportCountry'),
        'PassportNumber' => $this->input->post('passportNumber'),
        'WorkPermitNumber' => $this->input->post('workPermitNumber'),
        'WorkPermitExpiry' => $this->input->post('workPermitExpiry'),
        'CompensationInjury' => $this->input->post('compensationInjury'),
        'CompensationDateFrom' => $this->input->post('compensationDateFrom'),
        'CompensationDateTo' => $this->input->post('compensationDateTo'),
        'Asthma' => $this->input->post('asthma'),
        'BlackOut' => $this->input->post('blackOut'),
        'Diabetes' => $this->input->post('diabetes'),
        'Bronchitis' => $this->input->post('bronchitis'),
        'BackInjury' => $this->input->post('backInjury'),
        'Deafness' => $this->input->post('deafness'),
        'Dermatitis' => $this->input->post('dermatitis'),
        'SkinInfection' => $this->input->post('skinInfection'),
        'Allergies' => $this->input->post('allergies'),
        'Hernia' => $this->input->post('hernia'),
        'HighBloodPressure' => $this->input->post('highBloodPressure'),
        'HeartProblems' => $this->input->post('heartProblems'),
        'UsingDrugs' => $this->input->post('usingDrugs'),
        'UsingContactLenses' => $this->input->post('usingContactLenses'),
        'RSI' => $this->input->post('RSI'),
        'Dependants' => $this->input->post('dependants'),
        'Smoke' => $this->input->post('smoke'),
        'Conviction' => $this->input->post('conviction'),
        'ConvictionDetails' => $this->input->post('convictionDetails'),
        'UserID' => $userID
        );

        $this->candidate_model->applyJob($data);

        
        echo "Update successfully";
    }

    public function uploadCV(){
        if(!isset($_SESSION['userEmail'])){
            echo "Please login";
            exit;
        }
        $userID = $_SESSION['userID'];
        
        // get max candidate ID
        $candidate = $this->candidate_model->getMaxIDByUserID($userID);
        $maxID=$candidate['MaxID'];

        $config['upload_path'] = '/var/www/candidatesCV/';
        $config['allowed_types'] = 'pdf|png|doc|docx';
        $config['max_size'] = 10000;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['file_name'] = $maxID; // the uploaded file's extension will be applied

       
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('jobCV')) {
            echo $maxID."Apply Failed";
        } else {
            echo $maxID."Apply Successfully";
        }

         // Update the download link
        $uploadName = $_FILES['jobCV']['name'];
        $items = explode(".", $uploadName);
        $extent = $items[count($items) - 1];
        $downloadName = $config['file_name'].'.'.$extent;
        $this->candidate_model->updateLinkByID($maxID, $downloadName);
    }

    public function candidateDetails($candidateID){
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $userdata['userType'] = $_SESSION['userType'];
            $data['candidate'] = $this->candidate_model->getCandidateFullInfo($candidateID);

            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/candidateDetails',$data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

}