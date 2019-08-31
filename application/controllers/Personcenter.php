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
		$data['errMess'] = $this->session->flashdata('errMessage');
		
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
		$errorIsTrue = false;
		$errMessage = array();
		$userdata['userType'] = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		
		if(isset($_POST['firstName'])){
            if(preg_match('%^[a-zA-Z\.\'\-\"\, ]{2,}$%',stripslashes(trim($_POST['firstName'])))){
                $data['firstName'] = $this->security->xss_clean($_POST['firstName']);
            } else { $errorIsTrue = true; array_push($errMessage,'Error The firstname you entered, was redeemed as invalid. The reason for this is because it contains disallowed special character or it is too short. Failed to update user data');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter First Name');}

		if(isset($_POST['lastName'])){
            if(preg_match('%^[a-zA-Z\.\'\-\"\, ]{2,}$%',stripslashes(trim($_POST['lastName'])))){
				$data['lastName'] = $this->security->xss_clean($_POST['lastName']);
            } else { $errorIsTrue = true; array_push($errMessage,'Error The last name you entered, was redeemed as invalid. The reason for this is because it contains disallowed special character or it is too short. Failed to update user data');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter Last Name');}
		
		if(isset($_POST['DOB'])){
            if(preg_match('%^[1|2]{1}(9[0-9][0-9]|0[0-9][0-9])-(0[0-9]|1[0|1|2])-(0[0-9]|1[0-9]|2[0-9]|3[0-1])$%',stripslashes(trim($_POST['DOB'])))){
                if($_POST['DOB']<date("Y-m-d")){
                    $data['DOB'] = $this->security->xss_clean($_POST['DOB']);
                } else { $errorIsTrue = true; array_push($errMessage,'The Date Of Birth / DOB field cant be bigger than current Date');}
            } else { $errorIsTrue = true; array_push($errMessage,'Error The Date is invalid format');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter Date of birth');}
		
		if(isset($_POST['address'])){
            if(preg_match('%\d%',stripslashes(trim($_POST['address'])))){
                $data['address'] = $this->security->xss_clean($_POST['address']);
            } else {
                $errorIsTrue = true; array_push($errMessage,'invalid address, address must contains numbers');
            }
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter An address');}
		
		$data['cities'] = $this->city_model->get_cities();
        $cities = array();
        foreach($data['cities'] as $city){
            array_push($cities,$city['CityName']);
        }

        if (in_array($_POST['city'], $cities)) {
            $data['city']  = $this->security->xss_clean(stripslashes(trim($_POST['city'])));
        } else {
            $errorIsTrue = true; array_push($errMessage,'invalid city, the city doesnt exists in New Zealand');
		}
		
		if(isset($_POST['zip'])){
            if(preg_match('%^\d{4}$%',stripslashes(trim($_POST['zip'])))){
                $data['zipcode'] = $this->security->xss_clean($_POST['zip']);
            } else { $errorIsTrue = true; array_push($errMessage,'invalid zip code, zip should contains 4 digits'); }
		} 
		
		if(isset($_POST['suburb'])){
            if(preg_match('%^[a-zA-Z\s/\.\'\(\)&:\,\"]+$%',stripslashes(trim($_POST['suburb'])))){
                $data['suburb'] = $this->security->xss_clean($_POST['suburb']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid Suburb');}
		}
		
		if(isset($_POST['phoneNumber'])){
            if(preg_match('%^[\+]?\(?[\+]?[0-9]{2,4}\)?[\- \.]?\(?[0-9]{2,4}[\-\. ]?[0-9]{2,4}[\-\. ]?[0-9]{0,6}?\)?$%',stripslashes(trim($_POST['phoneNumber'])))){
				$data['phoneNumber'] = $this->security->xss_clean($_POST['phoneNumber']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid Phone number');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter a phone number');}
		
		if(!$errorIsTrue){
		$_SESSION['lastName'] = $_POST['lastName'];
		$_SESSION['firstName'] = $_POST['firstName'];
		$_SESSION['DOB'] = $_POST['DOB'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['zipcode'] = $_POST['zip'];
		$_SESSION['suburb'] = $_POST['suburb'];
		$_SESSION['phoneNumber'] = $_POST['phoneNumber'];
		unset($data['cities']);
		$this->User_model->update_personalDetails($userID,$data);
		
		$data['message'] = "Your data has been updated successfully!";
		$data['title'] = "Personal Information";
		$data['userEmail'] = $_SESSION['userEmail'];
		$data['cities'] = $this->city_model->get_cities();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
		} else {
			$this->session->set_flashdata('errMessage', $errMessage);
			redirect('/Personcenter/personalInfo');
		}
	}
}