<?php

class CandidateMission extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
        $this->load->helper('security');
        $this->load->helper('download');

        $this->load->library('session');
        // Load Modesl
        $this->load->model('candidate_model');
        $this->load->model('city_model');
        $this->load->model('register_model');
        $this->load->model('job_model');
	}
    public function index($param = ''){
        
        
        if($param == 'active'){ $active1='';$active2='active';}
        else {$active1='active';$active2='';}
        $data['active1'] = $active1;
        $data['active2'] = $active2;
      
        $userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
        }
        $data['citizenships'] = $this->candidate_model->get_citizenships();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/candidatesMission', $data, $userdata);
        $this->load->view('templates/footer');
    }

    // show candidate table
	public function manageCandidate($page="",$jobID= ""){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){

            $userdata['userType'] = $_SESSION['userType'];
            $data['title'] = "Manage Candidate";
            $data['message'] ="";
            $data['candidateNum'] = $this->candidate_model->countAll($page);
            // $data['candidateNum'] = 30;
            $data['candidates'] = $this->candidate_model->getCandidatesWithName(10, 0,$page);
            
            //is it a good idea to match the interest from candidate / job?
            $data['job'] = array (
                'JobType' => "",
                'City' => "",
                'JobTitle' => "",
            );
            if(!empty($jobID)){
                $data['job'] = $this->job_model->get_specificJob($jobID);
            }
            $data['fromPage'] = $page; 
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/manageCandidate',$data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
		
    }

    // download CV
    public function downloadCV($fileName){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){

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
    public function getCandidates($page=""){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){

            $offset=$_POST['offset'];
            $candidates = $this->candidate_model->getCandidatesWithName(10, $offset,$page);
            echo json_encode($candidates);
        } else {
            redirect('/');
        }

    }

    public function getRandomAlphabet(){
        $alphabetArray = array( 'a', 'b', 'c', 'd', 'e','f', 'g', 'h', 'i', 'j','k', 'l', 'm', 'n', 'o',
        'p', 'q', 'r', 's', 't','u', 'v', 'w', 'x', 'y','z'
        );
        $randomNum = rand(0,25);
        $alphabet = $alphabetArray[$randomNum];
        return $alphabet;
    }

    public function applyJob(){
        if(!isset($_SESSION['userEmail'])){
            //redirect('/personcenter/index');
            echo "Please login";
            exit;
        }
        $candidateNotes = "";
        if($_SESSION['userType']!='admin' && $_SESSION['UserType']!='staff')
        {
            $userID = $_SESSION['userID'];
        }
        else {
                $userEmail = 'LeeRecruitment:' . $_POST['email'];
                $userPasswd = rand(10000,99999);
                $pos = rand(0,4); 
                $alphabet = $this->getRandomAlphabet();
                $newUserPasswd = substr_replace($userPasswd, $alphabet, $pos, 1);
                
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $Address = $_POST['Address'];
                $City = $_POST['City'];
                $ZipCode = $_POST['ZipCode'];
                $Suburb = $_POST['Suburb'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $gender = $_POST['gender'];

                $userType = 'candidate';
                $newUserPasswd = do_hash($newUserPasswd, 'sha256');
                $candidateNotes = $_POST['candidateNotes'];
                $this->register_model->addUser($firstName, $lastName, $userEmail, $newUserPasswd, $Address, $City, $ZipCode, $Suburb, $userType, $PhoneNumber, "0000-00-00", $gender);
                $userData = $this->candidate_model->getUserByData($firstName,$lastName);
                $userID = $userData['UserID'];
        }
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
        'UserID' => $userID,
        'CandidateNotes' => $candidateNotes,
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

    public function candidateDetails($candidateID,$jobID=""){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){

            $userdata['userType'] = $_SESSION['userType'];
            $data['candidate'] = $this->candidate_model->getCandidateFullInfo($candidateID);
            if(!empty($jobID)){
                $data['job'] = $this->job_model->get_specificJob($jobID);
            }
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/candidateDetails',$data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    public function addingNewCandidateStaffOnly(){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $userdata['userType'] = $_SESSION['userType'];

            $data['citizenships'] = $this->candidate_model->get_citizenships();
            $data['cities'] = $this->city_model->get_cities();
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/candidateFormStaffOnly',$data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }
    }
}