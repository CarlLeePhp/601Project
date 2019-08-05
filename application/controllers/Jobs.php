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
	}
	public function index()
	{	
		$userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		}

		// get all jobs for the table
		$data['jobs'] = $this->job_model->get_jobs();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/jobs', $data);
        $this->load->view('templates/footer');
	}
}
