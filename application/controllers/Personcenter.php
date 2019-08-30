<?php

class Personcenter extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->model('city_model');
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
		
		if($_SESSION['userType']=='admin'){

			$data['title'] = "Manage Staff";
			$data['message'] ="";
			$data['staffs'] = $this->User_model->getAllStaff();
			$this->load->view('templates/header',$userdata);
			$this->load->view('pages/manageStaff',$data);
			$this->load->view('templates/footer');
		} else {
			redirect('/');
		}
	}

	//checkThis
	public function newStaffPassword(){

		$userdata['userType'] = $_SESSION['userType'];
		
		if($_SESSION['userType']=='admin'){

			$staffID = $_POST['staffID'];
			$password = $_POST['newPassword'];
			$data['title'] = "Manage Staff";
			$data['message'] ="";
			$this->User_model->update_staffPassword($staffID,$password);
			$data['staffs'] = $this->User_model->getAllStaff();
			$this->load->view('templates/header',$userdata);
			$this->load->view('pages/manageStaff',$data);
			$this->load->view('templates/footer');
		} else {
			redirect('/');
		}
	}

	//checkThis
	public function removeStaff(){
		$userdata['userType'] = $_SESSION['userType'];
		
		if($_SESSION['userType']=='admin'){
		
			$encryptPass = do_hash( $_POST['adminPassword'], 'sha256');
			$staffID = $_POST['staffID'];
			$data['message'] = "";
			if($_SESSION['userPassword'] != $encryptPass){
				$data['message'] = "wrong administrator password failure in removing staff";
			} else {
			$this->User_model->delete_staff($staffID);
			}
			$data['title'] = "Manage Staff";
			$data['staffs'] = $this->User_model->getAllStaff();
			$this->load->view('templates/header',$userdata);
			$this->load->view('pages/manageStaff',$data);
			$this->load->view('templates/footer');
		} else {
			redirect('/');
		}
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
		$data['cities'] = $this->city_model->get_cities();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}

	public function updatePassword(){
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}

		$userdata['userType'] = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		
		$encryptPass = do_hash( $_POST['oldPassword'], 'sha256');
		$data['message'] = "";
		
		if(isset($_POST['newPassword'])){
            if(preg_match('%^[a-zA-Z0-9!@#\$\%\^&\*\(\)\-\+\.\?_]{6,}$%',stripslashes(trim($_POST['newPassword'])))){
				$newPassword = $this->security->xss_clean($_POST['newPassword']);
				if(($_SESSION['userPassword'] != $encryptPass)){
					$data['message'] = "The password you entered in Current Password input box is not the same as your current password, failed to update password";
				} else {
					$this->User_model->update_personalPassword($userID,$newPassword);
					$data['message'] = "Success! Your password has been changed";
					$_SESSION['userPassword'] = do_hash($newPassword,'sha256');
				}
            } else {  $data['message']='Invalid UserPassword length is too short or the usage of unallowed special characters';}
        } else {$data['message']='Please enter a new password';}
		
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
		$data['cities'] = $this->city_model->get_cities();
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

		$_SESSION['lastName'] = $_POST['lastName'];
		$_SESSION['firstName'] = $_POST['firstName'];
		$_SESSION['DOB'] = $_POST['DOB'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['zipcode'] = $_POST['zip'];
		$_SESSION['suburb'] = $_POST['suburb'];
		$_SESSION['phoneNumber'] = $_POST['phoneNumber'];
		
		$this->User_model->update_personalDetails($userID,$data);
		
		$data['message'] = "Your data has been updated successfully!";
		$data['title'] = "Personal Information";
		$data['userEmail'] = $_SESSION['userEmail'];
		$data['cities'] = $this->city_model->get_cities();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}
}