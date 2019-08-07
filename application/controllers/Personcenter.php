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
		$data['userEmail'] = $_SESSION['userEmail'];
		$data['lastName'] = $_SESSION['lastName'];
		$data['firstName'] = $_SESSION['firstName'];
		$data['DOB'] = $_SESSION['DOB'];
		$data['address'] = $_SESSION['address'];
		$data['city'] = $_SESSION['city'];
		$data['zipcode'] = $_SESSION['zip'];
		$data['suburb'] = $_SESSION['suburb'];
		$data['phoneNumber'] = $_SESSION['phoneNumber'];
		$data['message'] = '';
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}

	public function updatePassword(){
		$userdata['userType'] = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		$newPassword = $_POST['newPassword'];
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		$encryptPass = do_hash( $_POST['oldPassword'], 'sha256');
		$data['message'] = "";

		if($_SESSION['userPassword'] != $encryptPass){
			$data['message'] = "Password is not the same as your current password, failed to update password";
		} else {
			$this->User_model->update_personalPassword($userID,$newPassword);
			$data['message'] = "Success! Your password has been changed";
		}

		$data['userID'] = $_SESSION['userID'];
		$data['title'] = "Personal Information";
		$data['userEmail'] = $_SESSION['userEmail'];
		$data['lastName'] = $_SESSION['lastName'];
		$data['firstName'] = $_SESSION['firstName'];
		$data['DOB'] = $_SESSION['DOB'];
		$data['address'] = $_SESSION['address'];
		$data['city'] = $_SESSION['city'];
		$data['zipcode'] = $_SESSION['zip'];
		$data['suburb'] = $_SESSION['suburb'];
		$data['phoneNumber'] = $_SESSION['phoneNumber'];
		$data['title'] = "Personal Information";
		$data['userEmail'] = $_SESSION['userEmail'];
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}

	public function updateDetails(){
		$userdata['userType'] = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		
		$data['lastName'] = $_POST['lastName'];
		$data['firstName'] = $_POST['firstName'];
		$data['DOB'] = $_POST['DOB'];
		$data['address'] = $_POST['address'];
		$data['city'] = $_POST['city'];
		$data['zipcode'] = $_POST['zip'];
		$data['suburb'] = $_POST['suburb'];
		$data['phoneNumber'] = $_POST['phoneNumber'];
		
		$this->User_model->update_personalDetails($userID,$data);
		
		$data['message'] = "Your data has been updated successfully!";
		$data['title'] = "Personal Information";
		$data['userEmail'] = $_SESSION['userEmail'];
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}
}