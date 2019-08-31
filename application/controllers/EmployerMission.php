<?php 


class EmployerMission extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

        $this->load->library('session');
        
        // Load Models
        $this->load->model('city_model');
        $this->load->model('job_model');
	}
    public function index($param=''){

        $data['active1'] = '';
        $data['active2'] = '';
        $data['active3'] = '';
        $data['message'] = '';
        if($param == 2) {
            $data['active2'] = 'active';
        } elseif ($param == 3) {
            $data['active3'] = 'active';
        } else {
            $data['active1'] = 'active';
        }

        $userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
        }
        $data['message'] = array();
        $data['cities'] = $this->city_model->get_cities();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/employerMission', $data);
        $this->load->view('templates/footer');

    }

    public function addJob(){
        $errMessage = array();
        $errorIsTrue = false;
       
        if(isset($_POST['clientTitle'])){
            if(preg_match('%^(m|d|-)[ris]{0,3}[\.]?$%',stripslashes(trim($_POST['clientTitle'])))){
                $clientTitle = $this->security->xss_clean(stripslashes($_POST['clientTitle']));
            } else { $errorIsTrue = true; array_push($errMessage,'Please choose your title from dropdown list'); }
        } else { $clientTitle = "-";}

        //$clientTitle = $this->security->xss_clean(stripslashes($_POST['clientTitle']));

        if(isset($_POST['clientName'])){
            if(preg_match('%^[a-zA-Z\.\'\-:\"\, ]{2,}$%',stripslashes(trim($_POST['clientName'])))){
                $clientName = $this->security->xss_clean($_POST['clientName']);
            } else { $errorIsTrue = true; array_push($errMessage,'Please enter a valid name that doesn\'t contain special character and more than 2 characters in length');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter the name');}

        $clientCompany = $this->security->xss_clean(trim($_POST['clientCompany']));

        if(isset($_POST['clientEmail'])){
            if(preg_match('%^[a-zA-Z0-9\._\-\+]+@[a-zA-Z0-9\.\-]+\.[A-Za-z]{2,4}$%',stripslashes(trim($_POST['clientEmail'])))){
                $clientEmail = $this->security->xss_clean($_POST['clientEmail']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid Email Address');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter an email');}
        
        
        $data['active1'] = '';
        $data['active2'] = '';
        $data['active3'] = 'active';
        $data['message'] = '';
        
        if(isset($_POST['clientContact'])){
            if(preg_match('%^[\+]?\(?[\+]?[0-9]{2,4}\)?[\- \.]?\(?[0-9]{2,4}[\-\. ]?[0-9]{2,4}[\-\. ]?[0-9]{0,6}?\)?$%',stripslashes(trim($_POST['clientContact'])))){
                $clientContact = $this->security->xss_clean($_POST['clientContact']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid Contact number');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter a contact number');}

        $data['cities'] = $this->city_model->get_cities();
        $cities = array();
        foreach($data['cities'] as $city){
            array_push($cities,$city['CityName']);
        }

        if (in_array($_POST['clientCity'], $cities)) {
            $clientCity = $this->security->xss_clean(stripslashes(trim($_POST['clientCity'])));
        } else {
            $errorIsTrue = true; array_push($errMessage,'invalid city, the city doesnt exists in New Zealand');
        }
        
        if(isset($_POST['clientAddress'])){
            if(preg_match('%\d%',stripslashes(trim($_POST['clientAddress'])))){
                $clientAddress = $this->security->xss_clean($_POST['clientAddress']);
            } else {
                $errorIsTrue = true; array_push($errMessage,'invalid address, address must contains numbers');
            }
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter An address');}

        if(isset($_POST['clientSuburb'])){
            $clientSuburb = $this->security->xss_clean(stripslashes(trim($_POST['clientSuburb'])));
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter the suburb'); }
        if(isset($_POST['clientJobTitle'])){
            $clientJobTitle = $this->security->xss_clean(stripslashes(trim($_POST['clientJobTitle'])));
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter the job title');}
        
        if(isset($_POST['clientJobType'])){
            if($_POST['clientJobType']=="PartTime" || $_POST['clientJobType']=="FullTime"){
                $clientJobType = $this->security->xss_clean($_POST['clientJobType']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid job type');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter the job type');}

        $description = $this->security->xss_clean(stripslashes(trim($_POST['description'])));
        $dateJobSubmitted = date('Y-m-d'); 
        
        $userdata['userType'] = 'anyone';
        $data['message'] = array();
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
        }
        if(!$errorIsTrue){
            $this->job_model->addJob($clientTitle,$clientName,$clientCompany,$clientEmail,$clientContact,$clientCity,$clientAddress,$clientJobTitle,$clientJobType,$description,$clientSuburb,$dateJobSubmitted);
            $data['title'] = 'Job was added successfully.';
        } else {
            $data['message'] = $errMessage;
        }
        
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/employerMission', $data);
        $this->load->view('templates/footer');
    }
}