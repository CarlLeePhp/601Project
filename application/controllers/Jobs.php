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
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		}

		// get all jobs for the table status=NULL
		$data['jobs'] = $this->job_model->get_jobs();
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

	/**
	 * AJAX Methods for staff and Admin
	 */
}
