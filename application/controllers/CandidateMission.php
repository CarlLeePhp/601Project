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

            $path = 'C:\\xamppNew2\\htdocs\\' .'candidatesCV\\'.$fileName;
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
                if(isset($_FILES['jobCVID'])){
                    $config['upload_path'] = '/var/www/html/candidatesCV';
                    //$config['upload_path'] = 'C:\\xamppNew2\\htdocs\\candidatesCV';
                    $config['allowed_types'] = 'pdf|png|doc|docx';
                    $config['max_size'] = 10000;
                    $config['max_width'] = 0;
                    $config['max_height'] = 0;
                    $config['file_name'] = $userID;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('jobCV')) {
                        echo "Apply Failed";
                    } else {
                        echo "Apply Successfully";
                    }

                    // Update the download link
                    $uploadName = $_FILES['jobCVID']['name'];
                    $items = explode(".", $uploadName);
                    $extent = $items[count($items) - 1];
                    $downloadName = $config['file_name'] .'.'.$extent;
                    $this->candidate_model->updateLinkByID($userID, $downloadName);
                }
        }
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
        $userID = $_SESSION['userID'];
        
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
            echo $maxID."Apply Failed";
        } else {
            echo $maxID."Apply Successfully";
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
}