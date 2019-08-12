<?php

class Jobs extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
		// Load Models
		$this->load->model('job_model');
		$this->load->model('city_model');
	}
	public function index()
	{	
		$userdata['userType'] = 'anyone';
		$jobTitle ="";
		$jobType="";
		$location="";
		$page="jobs";
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		};
		if(isset($_POST['jobTitle'])){
			$jobTitle = $_POST['jobTitle'];
			
		};
		if(isset($_POST['jobType'])){
			$jobType = $_POST['jobType'];
		};
		if(isset($_POST['location'])){
			$location = $_POST['location'];
		};

		// get all jobs for the table status=published
		$data['jobs'] = $this->job_model->get_publishedjobs($page,$jobTitle,$jobType,$location);
		
		$data['cities'] = $this->city_model->get_cities();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/jobs', $data);
        $this->load->view('templates/footer');
	}

	
	// show client tables
	public function manageClient(){
		if(!(isset($_SESSION['userType']))&& $_SESSION['userType']!='admin'){
			redirect('/');
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Manage Client";
		$data['message'] ="";
		$data['jobs'] = $this->job_model->get_jobs();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/manageClient',$data);
		$this->load->view('templates/footer');
		
	}

	public function jobDetails($paramJobID){
		if(!(isset($_SESSION['userType']))&& ($_SESSION['userType']!='admin' || $_SESSION['userType']!='staff')){
			redirect('/');
			$paramJobID="";
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Job Details";
		$data['job'] = $this->job_model->get_specificJob($paramJobID);

		
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobDetails',$data);
		$this->load->view('templates/footer');
	}

	public function jobPublish($paramJobID){
		if(!(isset($_SESSION['userType']))&& !($_SESSION['userType']=='admin' || $_SESSION['userType']=='staff')){
			redirect('/');
			$paramJobID = "";
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Job Details";
		$publishTitle = $_POST['publishTitle'];
		$thumbnailText = $_POST['thumbnailText'];
		$textEditor = $_POST['editor1'];
		//4digitsYear-2digitsMonth-2digitsDay Format to match sql
		$publishDate = date('Y-m-d');
		//update the job
		$this->job_model->publishJob($paramJobID,$textEditor,$thumbnailText,$publishTitle,$publishDate);
		//select the job 
		$data['job'] = $this->job_model->get_specificJob($paramJobID);
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobDetails',$data);
		$this->load->view('templates/footer');
	}

	public function jobUnpublish($paramJobID){
		if(!(isset($_SESSION['userType']))&& !($_SESSION['userType']=='admin' || $_SESSION['userType']=='staff')){
			redirect('/');
			$paramJobID = "";
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Job Details";
		
		//update the jobstatus to null
		$this->job_model->unpublishJob($paramJobID);
		//select the job 
		$data['job'] = $this->job_model->get_specificJob($paramJobID);
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobDetails',$data);
		$this->load->view('templates/footer');
	}
	/**
	 * AJAX Methods for staff and Admin
	 */
}
