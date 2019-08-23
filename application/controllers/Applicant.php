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
            $this->load->view('pages/lookForApplicants',$data);
            
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
        'jobInterest' => $this->input->post('jobInterest'),
        'jobType' => $this->input->post('jobType'),
        'transportation' => $this->input->post('transportation'),
        'LicenseNumber' => $this->input->post('licenseNumber'),
        'classLicense' => $this->input->post('classLicense'),
        'endorsement' => $this->input->post('endorsement'),
        'citizenship' => $this->input->post('citizenship'),
        'nationality' => $this->input->post('nationality'),
        'passportCountry' => $this->input->post('passportCountry'),
        'passportNumber' => $this->input->post('passportNumber'),
        'workPermitNumber' => $this->input->post('workPermitNumber'),
        'workPermitExpiry' => $this->input->post('workPermitExpiry'),
        'compensationInjury' => $this->input->post('compensationInjury'),
        'compensationDateFrom' => $this->input->post('compensationDateFrom'),
        'compensationDateTo' => $this->input->post('compensationDateTo'),
        'asthma' => $this->input->post('asthma'),
        'blackOut' => $this->input->post('blackOut'),
        'diabetes' => $this->input->post('diabetes'),
        'bronchitis' => $this->input->post('bronchitis'),
        'backInjury' => $this->input->post('backInjury'),
        'deafness' => $this->input->post('deafness'),
        'dermatitis' => $this->input->post('dermatitis'),
        'skinInfection' => $this->input->post('skinInfection'),
        'allergies' => $this->input->post('allergies'),
        'hernia' => $this->input->post('hernia'),
        'highBloodPressure' => $this->input->post('highBloodPressure'),
        'heartProblems' => $this->input->post('heartProblems'),
        'usingDrugs' => $this->input->post('usingDrugs'),
        'usingContactLenses' => $this->input->post('usingContactLenses'),
        'RSI' => $this->input->post('RSI'),
        'dependants' => $this->input->post('dependants'),
        'smoke' => $this->input->post('smoke'),
        'conviction' => $this->input->post('conviction'),
        'convictionDetails' => $this->input->post('convictionDetails'),
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