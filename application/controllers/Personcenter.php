<?php

class Personcenter extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('User_model');
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
	
	//checkThis
	public function manageStaff(){
		
		$userdata['userType'] = $_SESSION['userType'];
		
		if(!(isset($_SESSION['userType']))&& $_SESSION['userType']!='admin'){
			redirect('/');
		}
		
		$data['title'] = "Manage Staff";
		$data['message'] ="";
		$data['staffs'] = $this->User_model->getAllStaff();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/manageStaff',$data);
		$this->load->view('templates/footer');
		
    
	}

	//checkThis
	public function newStaffPassword(){
		$userdata['userType'] = $_SESSION['userType'];
		
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}

		$staffID = $_POST['staffID'];
		$password = $_POST['newPassword'];
		$data['title'] = "Manage Staff";
		$data['message'] ="";
		$this->User_model->update_staffPassword($staffID,$password);
		$data['staffs'] = $this->User_model->getAllStaff();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/manageStaff',$data);
		$this->load->view('templates/footer');
	}

	//checkThis
	public function removeStaff(){
		$userdata['userType'] = $_SESSION['userType'];
		
		if(!(isset($_SESSION['userType'])) && $_SESSION['userType']!='admin'){
			redirect('/');
		}
		
		$encryptPass = do_hash( $_POST['adminPassword'], 'sha256');
		$staffID = $_POST['staffID'];
		$data['message'] = "";
		if($_SESSION['userPassword'] != $encryptPass){
			$data['message'] = "wrong password";
		} else {
		$this->User_model->delete_staff($staffID);
		}
		$data['title'] = "Manage Staff";
		$data['staffs'] = $this->User_model->getAllStaff();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/manageStaff',$data);
		$this->load->view('templates/footer');
	}

	public function personalInfo(){
		
		$userdata['userType'] = $_SESSION['userType'];
		
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		
		$data['userID'] = $_SESSION['userID'];
		$data['title'] = "Personal Information";
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}
}