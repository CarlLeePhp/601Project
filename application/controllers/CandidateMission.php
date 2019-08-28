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

    // show candidate table -- this
	public function manageCandidate($page="",$jobID= ""){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){

            $userdata['userType'] = $_SESSION['userType'];
            $data['title'] = "Manage Candidate";
            $data['message'] ="";
            
            
            $data['job'] = array (
                'JobType' => "",
                'City' => "",
                'JobTitle' => "",
            );
            if(!empty($jobID)){
                $data['job'] = $this->job_model->get_specificJob($jobID);
            }
            $data['jobID'] = $jobID;
            $data['candidateNum'] = $this->candidate_model->countAll($page,$data['job']['City'],$data['job']['JobType']);
            // $data['candidateNum'] = 30;
            $data['candidates'] = $this->candidate_model->getCandidatesWithName(10, 0,$page,$data['job']['City'],$data['job']['JobType']);
            
            //is it a good idea to match the interest from candidate / job?
            
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

            $path = constant('CV_PATH').$fileName;
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
            $offset = $_POST['offset'];
            $jobInterest = $_POST['jobInterest'];
            $city = $_POST['city'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $suburb = $_POST['suburb'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            $jobType = $_POST['jobType'];
            
            
            $data['candidates'] = $this->candidate_model->getCandidatesWithName(10, $offset,$page,$city,$jobType,$jobInterest,$firstName,$lastName,$suburb,$phoneNumber,$email);
            echo json_encode($data['candidates']);
        } else {
            redirect('/');
        }
    }

    public function applyFilterCandidate($page=""){
        if($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
        
            $jobInterest = $_POST['jobInterest'];
            $city = $_POST['city'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $suburb = $_POST['suburb'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            $jobType = $_POST['jobType'];
            
            $data['candidates'] = $this->candidate_model->getFilterCandidate($page,$city,$jobType,$jobInterest,$firstName,$lastName,$suburb,$phoneNumber,$email);
            echo json_encode($data['candidates']);
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
            // Staff and Mark Lee won't apply a job for themselves
            // So this means it comes from the staff only page
            // So there are three more things: firstName and lastName
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $candidateNotes = $_POST['candidateNotes'];
            $userData = $this->candidate_model->getUserByData($firstName,$lastName);
            $userID = $userData['UserID'];

        }
        $data = array(
        'JobInterest' => $this->input->post('JobInterest'),
        'JobType' => $this->input->post('JobType'),
        'Transportation' => $this->input->post('Transportation'),
        'LicenseNumber' => $this->input->post('LicenseNumber'),
        'ClassLicense' => $this->input->post('ClassLicense'),
        'Endorsement' => $this->input->post('Endorsement'),
        'Citizenship' => $this->input->post('Citizenship'),
        'Nationality' => $this->input->post('Nationality'),
        'PassportCountry' => $this->input->post('PassportCountry'),
        'PassportNumber' => $this->input->post('PassportNumber'),
        'WorkPermitNumber' => $this->input->post('WorkPermitNumber'),
        'WorkPermitExpiry' => $this->input->post('workPermitExpiry'),
        'CompensationInjury' => $this->input->post('CompensationInjury'),
        'CompensationDateFrom' => $this->input->post('CompensationDateFrom'),
        'CompensationDateTo' => $this->input->post('CompensationDateTo'),
        'Asthma' => $this->input->post('Asthma'),
        'BlackOut' => $this->input->post('BlackOut'),
        'Diabetes' => $this->input->post('Diabetes'),
        'Bronchitis' => $this->input->post('Bronchitis'),
        'BackInjury' => $this->input->post('BackInjury'),
        'Deafness' => $this->input->post('Deafness'),
        'Dermatitis' => $this->input->post('Dermatitis'),
        'SkinInfection' => $this->input->post('SkinInfection'),
        'Allergies' => $this->input->post('Allergies'),
        'Hernia' => $this->input->post('Hernia'),
        'HighBloodPressure' => $this->input->post('HighBloodPressure'),
        'HeartProblems' => $this->input->post('HeartProblems'),
        'UsingDrugs' => $this->input->post('UsingDrugs'),
        'UsingContactLenses' => $this->input->post('UsingContactLenses'),
        'RSI' => $this->input->post('RSI'),
        'Dependants' => $this->input->post('Dependants'),
        'Smoke' => $this->input->post('Smoke'),
        'Conviction' => $this->input->post('Conviction'),
        'ConvictionDetails' => $this->input->post('ConvictionDetails'),
        'UserID' => $userID,
        'CandidateNotes' => $candidateNotes,
        );

        
        $this->candidate_model->applyJob($data);
        
    }

    public function uploadCV(){
        if(!isset($_SESSION['userEmail'])){
            echo "Please login";
            exit;
        }
        
        if($_SESSION['userType']!='admin' && $_SESSION['UserType']!='staff')
        {
            
            $userID = $_SESSION['userID'];
        }
        else {
            // Staff and Mark Lee won't apply a job for themselves
            // So this means it comes from the staff only page
            // So there are three more things: firstName and lastName
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $userData = $this->candidate_model->getUserByData($firstName,$lastName);
            $userID = $userData['UserID'];
        }
        
        
        
        // get max candidate ID
        $candidate = $this->candidate_model->getMaxIDByUserID($userID);
        $maxID=$candidate['MaxID'];

        $config['upload_path'] = constant('CV_PATH');

        $config['allowed_types'] = 'pdf|png|doc|docx';
        $config['max_size'] = 10000;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['file_name'] = $maxID; // the uploaded file's extension will be applied


        
        $this->load->library('upload', $config);
        //what is this for?
        if (!$this->upload->do_upload('JobCV')) {
            echo "Apply Failed.";
        } else {
            echo "Apply Successfully";
        }

        
        // Update the download link
        $uploadName = $_FILES['JobCV']['name'];
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

    public function addUserByStaff(){
        if(!isset($_SESSION['userEmail'])){
            //redirect('/personcenter/index');
            echo "Please login";
            exit;
        }

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userAddress = $_POST['userAddress'];
        $city = $_POST['city'];
        $zipCode = $_POST['zipCode'];
        $suburb = $_POST['suburb'];
        $phoneNumber = $_POST['phoneNumber'];
        $gender = $_POST['gender'];
        $userEmail = 'LeeRecruitment:' . $_POST['userEmail'];
        $userPasswd = rand(10000,99999);
        $pos = rand(0,4); 
        $alphabet = $this->getRandomAlphabet();
        $newUserPasswd = substr_replace($userPasswd, $alphabet, $pos, 1);
        $userType = 'candidate';
        $newUserPasswd = do_hash($newUserPasswd, 'sha256');
        $this->register_model->addUser($firstName, $lastName, $userEmail, $newUserPasswd, $userAddress, $city, $zipCode, $suburb, $userType, $phoneNumber, "0000-00-00", $gender);

    }
}