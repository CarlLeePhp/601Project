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
    }

    public function index(){
                
        $userdata['userType'] = 'anyone';
        
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/register');
        $this->load->view('templates/footer');
        
    }

    public function newUser(){
        /**
         * Check password and confirm password.
         * If they are different, return an information.
         */
        $userEmail = $_POST['Email'];
        $userPasswd = $_POST['password'];
        $confirmPassword= $_POST['confirmPassword'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $DOB = $_POST['DOB'];
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
        
        $this->load->view('templates/header', $userdata);
        $this->load->view('login/main');
        $this->load->view('templates/footer');
    }

    public function newStaff(){
        $userEmail = $_POST['email'];
        $userPasswd = $_POST['password'];
        $confirmPassword= $_POST['confirmPassword'];
        $firstName = '';
        $lastName = '';
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
        $data['modalHeader'] = "";
        if($userPasswd == $confirmPassword){
            $data['modalHeader']="Success";
            $data['message']='Successful in adding a new staff';
        $this->register_model->addUser($firstName, $lastName, $userEmail, $userPasswd, $Address, $City, $ZipCode, $Suburb, $userType, $PhoneNumber, $DOB, $gender);
        } else {
            $data['modalHeader']="Failed";
            $data['message']='The password and the confirmation did not match!, Failed to add a staff into database';
        }  
        $userdata['userType'] = $_SESSION['userType'];
        $data['title'] = "Manage Staff";
        $this->load->view('templates/header',$userdata);
        $this->load->view('pages/manageStaff',$data);
        $this->load->view('templates/footer');
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