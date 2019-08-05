<?php

class Personcenter extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
	}
	public function index()
	{	
        // Check username and the passwd
		if(! isset($_SESSION['userType'])){
			redirect('/login/index');
		}
		
		$userdata['userEmail'] = $_SESSION['userEmail'];
		$userdata['userType'] = $_SESSION['userType'];
		$data['firstName'] = $_SESSION['firstName'];

        $data['message'] = "Please Login";
		$data['title'] = "Personal Center";
		$this->load->view('templates/header', $userdata);
        $this->load->view('personcenter/main', $data);
        $this->load->view('templates/footer');
	}
	
	public function manageStaff(){
		
		$userdata['userType'] = $_SESSION['userType'];
		
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		
		$data['title'] = "Manage Staff";
		$data['message'] = "";
		$data['modalHeader'] ="";
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/manageStaff',$data);
		$this->load->view('templates/footer');
		
    
	}

	public function updateInfo(){
		
		$userdata['userType'] = $_SESSION['userType'];
		
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		
		$data['UserID'] = $_SESSION['UserID'];
		$data['title'] = "Personal Information";
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/updateInfo',$data);
		$this->load->view('templates/footer');
	}
}