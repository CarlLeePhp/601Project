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
	
	//the page where the user are redirected when they login
	//inside personcenter/main it loads different view based on userType
	//admin:view->personcenter->adminPanel
	//staff:view->personcenter->staffPanel
	//candidate:view->personcenter->personalPanel
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
	

	//load the page that are only accessible by UserType admin
	//3 functions that are available in this page : 
	//Personcenter->newStaffPassword
	//Personcenter->removeStaff
	//Register->newStaff
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

	//called from: view->staffManager->changeStaffPassword
	//a function that is called from manageStaff that are only accessible by userType admin
	//updating the password of the staff based on the staff ID
	//calling the model of user_model->update_staffPassword($staffID,$password);
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

	//called from: view->staffManager->removeStaff
	//a function that is called from manageStaff that are only accessible by userType admin
	//removing staff based on the staff ID
	//calling the model of user_model->delete_staff($staffID);
	public function removeStaff(){
		$userdata['userType'] = $_SESSION['userType'];
		
		if($_SESSION['userType']=='admin'){
		
			$encryptPass = do_hash( $_POST['adminPassword'], 'sha256');
			$staffID = $_POST['staffID'];
			$data['message'] = "";
			//validate the administrator password, so no one could come and update it except for the one that know the password
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

	//called from: view->personcenter->main --- view->personcenter->adminPanel , view->personcenter->personalPanel , view->personcenter->staffPanel
	//in this page , the users could see their information or update it if they wishes for it
	//with data saved from session
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
		//temporary session to hold the err message
		$data['errMess'] = $this->session->flashdata('errMessage');
		
		$data['cities'] = $this->city_model->get_cities();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/personalInfo',$data);
		$this->load->view('templates/footer');
	}

	//called from: view->pages->personalInfo
	//update details function that are available from the personalInfo Page
	//updating a user password calling a user_model->update_personalPassword($userID,$newPassword);
	public function updatePassword(){
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}

		$userdata['userType'] = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		
		$encryptPass = do_hash( $_POST['oldPassword'], 'sha256');
		$data['message'] = "";
		
		if(isset($_POST['newPassword'])){
			//check user new password, the length should be atleast 6 digits
			//allowed character allAlphabets,digits, !@#$%^&*()-+._
            if(preg_match('%^[a-zA-Z0-9!@#\$\%\^&\*\(\)\-\+\.\?_]{6,}$%',stripslashes(trim($_POST['newPassword'])))){
				$newPassword = $this->security->xss_clean($_POST['newPassword']);
				//check the authenticity
				if(($_SESSION['userPassword'] != $encryptPass)){
					$data['message'] = "The password you entered in Current Password input box is not the same as your current password, failed to update password";
				} else {
					//update it into newone
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

	//called from: view->pages->personalInfo
	//update details function that are available from the personalInfo Page
	//updating a user details calling a user_model->update_personalDetails($userID,$data);
	public function updateDetails(){
		$errorIsTrue = false;
		$errMessage = array();
		$userdata['userType'] = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		if(!(isset($_SESSION['userType']))){
			redirect('/');
		}
		
		if(isset($_POST['firstName'])){
			//match all alphabets, the only special characters that are allowed are: .'-",
			//minimum length 2
            if(preg_match('%^[a-zA-Z\.\'\-"\, ]{2,}$%',stripslashes(trim($_POST['firstName'])))){
                $data['firstName'] = $this->security->xss_clean($_POST['firstName']);
            } else { $errorIsTrue = true; array_push($errMessage,'Error The firstname you entered, was redeemed as invalid. The reason for this is because it contains disallowed special character or it is too short. Failed to update user data');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter First Name');}

		if(isset($_POST['lastName'])){
			//match all alphabets, the only special characters that are allowed are: .'-",
			//minimum length 2
            if(preg_match('%^[a-zA-Z\.\'\-"\, ]{2,}$%',stripslashes(trim($_POST['lastName'])))){
				$data['lastName'] = $this->security->xss_clean($_POST['lastName']);
            } else { $errorIsTrue = true; array_push($errMessage,'Error The last name you entered, was redeemed as invalid. The reason for this is because it contains disallowed special character or it is too short. Failed to update user data');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter Last Name');}
		
		if(isset($_POST['DOB'])){
			//match the date YYYY-MM-DD
            if(preg_match('%^[1|2]{1}(9[0-9][0-9]|0[0-9][0-9])-(0[0-9]|1[0|1|2])-(0[0-9]|1[0-9]|2[0-9]|3[0-1])$%',stripslashes(trim($_POST['DOB'])))){
                if($_POST['DOB']<date("Y-m-d")){
                    $data['DOB'] = $this->security->xss_clean($_POST['DOB']);
                } else { $errorIsTrue = true; array_push($errMessage,'The Date Of Birth / DOB field cant be bigger than current Date');}
            } else { $errorIsTrue = true; array_push($errMessage,'Error The Date is invalid format');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter Date of birth');}
		
		if(isset($_POST['address'])){
			//check if the address contains number
            if(preg_match('%\d%',stripslashes(trim($_POST['address'])))){
                $data['address'] = $this->security->xss_clean($_POST['address']);
            } else {
                $errorIsTrue = true; array_push($errMessage,'invalid address, address must contains numbers');
            }
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter An address');}
		
		//load the city from database
		$data['cities'] = $this->city_model->get_cities();
		$cities = array();
		//insert it into array
        foreach($data['cities'] as $city){
            array_push($cities,$city['CityName']);
        }
		//check if the post value is a match with items in city array
        if (in_array($_POST['city'], $cities)) {
            $data['city']  = $this->security->xss_clean(stripslashes(trim($_POST['city'])));
        } else {
            $errorIsTrue = true; array_push($errMessage,'invalid city, the city doesnt exists in New Zealand');
		}
		
		if(isset($_POST['zip'])){
			//zip code is 4 digits
            if(preg_match('%^\d{4}$%',stripslashes(trim($_POST['zip'])))){
                $data['zipcode'] = $this->security->xss_clean($_POST['zip']);
            } else { $errorIsTrue = true; array_push($errMessage,'invalid zip code, zip should contains 4 digits'); }
		} 
		
		if(isset($_POST['suburb'])){
			//any alphabets special characters that are allowed: multiple space,/.'()&:,"
			//length 3-18
            if(preg_match('%^[a-zA-Z\s/\.\'\(\)&:\,"]{3,18}$%',stripslashes(trim($_POST['suburb'])))){
                $data['suburb'] = $this->security->xss_clean($_POST['suburb']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid Suburb');}
		}
		
		if(isset($_POST['phoneNumber'])){
			//match with a string that possibly start with + or (+ then a number suffix possibly a closing)
			//followed by a possibility of the user entered delimiter then numbers from 2-4 digits a possibility of delimiter 2-4digits and another possible delimiter and possibility of 0-6 digits
			//min length 5 , max length 18
            if(preg_match('%^[\+]?\(?[\+]?[0-9]{1,4}\)?[\- \.]?\(?[0-9]{2,4}[\-\. ]?[0-9]{2,4}[\-\. ]?[0-9]{0,6}?\)?$%',stripslashes(trim($_POST['phoneNumber'])))){
				$data['phoneNumber'] = $this->security->xss_clean($_POST['phoneNumber']);
            } else { $errorIsTrue = true; array_push($errMessage,'Invalid Phone number');}
        } else { $errorIsTrue = true; array_push($errMessage,'Please enter a phone number');}
		
		//if any of the grep match is not fulfilled redirect and print message
		if(!$errorIsTrue){
		$_SESSION['lastName'] = $_POST['lastName'];
		$_SESSION['firstName'] = $_POST['firstName'];
		$_SESSION['DOB'] = $_POST['DOB'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['zipcode'] = $_POST['zip'];
		$_SESSION['suburb'] = $_POST['suburb'];
		$_SESSION['phoneNumber'] = $_POST['phoneNumber'];
		//remove cities var from data so it wont be send into the model
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