<?php
/* Functions
 * 1. List all boat models. => index
 * 2. 
 * AJAX:
 * 1. return check list item as per boat model ID
 */

class Register extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        $this->load->helper('security');
        // Load Models
        $this->load->model('register_model');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('City_model');
    }

    public function index(){
                
        $userdata['userType'] = 'anyone';
        

        $data['users'] = $this->user_model->getUsers();
        $data['cities'] = $this->City_model->get_cities();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/register', $data);
        $this->load->view('templates/footer');
        
    }

    public function newUser(){
        /**
         * Check password and confirm password.
         * If they are different, return an information.
         */
        $errorIsTrue = false;

        if(isset($_POST['Email'])){
            if(preg_match('%^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,4}$%',stripslashes(trim($_POST['Email'])))){
                $userEmail = $_POST['Email'];
            } else { $errorIsTrue = true; echo 'Invalid Email Address';}
        }
        
        if(isset($_POST['password'])){
            if(preg_match('%^[a-zA-Z0-9!@#\$\%\^&\*\(\)\-\+\.\?_]{6,}$%',stripslashes(trim($_POST['password'])))){
                $userPasswd = $_POST['password'];
            } else { $errorIsTrue = true;  echo 'Invalid UserPassword';}
        }

        if(isset($_POST['firstName'])){
            if(preg_match('%^[a-zA-Z0-9\.\'-:"\, ]{2,}$%',stripslashes(trim($_POST['firstName'])))){
                $firstName = $_POST['firstName'];
            } else { $errorIsTrue = true; echo 'Error The name you entered, was redeemed as invalid. The reason for this is because it contains disallowed special character or it is too short. Failed to register User';}
        }

        if(isset($_POST['lastName'])){
            if(preg_match('%^[a-zA-Z0-9\.\'-:"\, ]{2,}$%',stripslashes(trim($_POST['lastName'])))){
                $lastName = $_POST['lastName'];
            } else { $errorIsTrue = true; echo 'Error The last name you entered, was redeemed as invalid. The reason for this is because it contains disallowed special character or it is too short. Failed to register User';}
        }
        
        if(isset($_POST['DOB'])){
            if(preg_match('%^[1|2]{1}(9[0-9][0-9]|0[0-9][0-9])-(0[0-9]|1[0|1|2])-(0[0-9]|1[0-9]|2[0-9]|3[0-1])$%',stripslashes(trim($_POST['DOB'])))){
                if($_POST['DOB']<=date("Y-m-d")){
                    $DOB = $_POST['DOB'];
                } { $errorIsTrue = true; echo 'The DOB cant be bigger than current Date';}
            } else { $errorIsTrue = true; echo 'Error The Date is invalid format';}
        }
        
        // if(isset($_POST['Address'])){
        //     if(preg_match('%%',stripslashes(trim($_POST['Address'])))){
               
        //     } else { echo 'Invalid address';}
        // }
        $Address = $_POST['Address'];
        $City = $_POST['City'];
        $ZipCode = $_POST['ZipCode'];
        $Suburb = $_POST['Suburb'];
        $PhoneNumber = $_POST['PhoneNumber'];
        $gender = $_POST['gender'];

        $userType = 'candidate';
        $userPasswd = do_hash($userPasswd, 'sha256');

        $this->register_model->addUser($firstName, $lastName, $userEmail, $userPasswd, $Address, $City, $ZipCode, $Suburb, $userType, $PhoneNumber, $DOB, $gender);
        
        $userdata['userType'] = 'anyone';
        $message['wrongInfo'] = 'undefined';
        $this->load->view('templates/header', $userdata);
        $this->load->view('login/main',$message);
        $this->load->view('templates/footer');
    }

    public function newStaff(){
        if($_SESSION['userType']=='admin'){

            // if(preg_match("",$_POST['email']))
            $userEmail = $_POST['email'];
            $userPasswd = $_POST['password'];
            $confirmPassword= $_POST['confirmPassword'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $DOB = '';
            $Address = '';
            $City = '';
            $ZipCode = '';
            $Suburb = '';
            $PhoneNumber = '';
            $gender = '';

            $userType = 'staff';
            $userPasswd = do_hash($userPasswd, 'sha256');
            $data['message'] = "";
            
            $this->register_model->addUser($firstName, $lastName, $userEmail, $userPasswd, $Address, $City, $ZipCode, $Suburb, $userType, $PhoneNumber, $DOB, $gender);
        
            $userdata['userType'] = $_SESSION['userType'];
            $data['title'] = "Manage Staff";
            $data['staffs'] = $this->user_model->getAllStaff();
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/manageStaff',$data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    
    public function forgotPasswd(){
        $userdata['userType'] = 'anyone';
        $this->load->view('templates/header', $userdata);
        $this->load->view('login/forgot');
        $this->load->view('templates/footer');
    }
    
    /**
     * AJAX
     */
    public function sendPasswd(){
        $userEmail = $_POST['email'];

        // Random a string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $userPasswd = do_hash($randomString, 'sha256');

        // check the email
        $data['user'] = $this->user_model->getUserByEmail($userEmail);
        if($data['user'] != null){
            // update the user information by email
            $this->user_model->updatePasswdByEmail($userEmail, $userPasswd);

            /**
             * development config
             */
            
            $config['smtp_host'] = 'smtp.google.com';
            $config['smtp_user'] = 'kunhuilearners1@gmail.com';
            $config['smtp_pass'] = 'diligence';
            $config['smtp_port'] = '587';
            $config['smtp_crypto'] = 'tls';
            $this->email->from('kunhuilearners1@gmail.com', 'Carl Lee');
            $this->email->to($userEmail);

            $this->email->subject('Message from Mark Lee');
            $this->email->message('Your new password: '.$randomString);

            if($this->email->send()){
                echo "New password was sent to you email.";
            } else {
                echo "Email was send failed, please try again later.";
            }
            
            echo 'Password was reset';
        } else {
            echo 'The email is not exist.';
        }
    }
}