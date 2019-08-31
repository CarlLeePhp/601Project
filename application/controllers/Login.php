<?php
/* Functions
 * 1. This is a login and session test page
 */

class Login extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('session');
        // Load Models
        $this->load->model('user_model');
    }

    function index(){
        $userdata['userType'] = 'anyone';
        $message['wrongInfo'] = 'undefined';
        $this->load->view('templates/header', $userdata);
        $this->load->view('login/main',$message);
        $this->load->view('templates/footer');
    }

    public function login(){
        // When someone enter this link without login, it should be redirecte to login/index
        if(isset($_POST['submittedLoginForm'])){
        if(isset($_POST['Email'])){
            
            $userEmail = $this->security->xss_clean(stripslashes(trim($_POST['Email'])));
            $userPasswd = $this->security->xss_clean(stripslashes(trim($_POST['Password'])));
            $userPasswd = do_hash($userPasswd, 'sha256');
            // get the user's information from database
            $data['user'] = $this->user_model->getUserByEmail($userEmail);
            if($data['user']['UserPasswd'] == $userPasswd && strlen($_POST['Password']) > 5){
                $newdata = array(
                    'userEmail' => $userEmail,
                    'userID' => $data['user']['UserID'],
                    'userType' => $data['user']['UserType'],
                    'firstName' => $data['user']['FirstName'],
                    'lastName' => $data['user']['LastName'],
                    'userPassword' => $data['user']['UserPasswd'],
                    'DOB' => $data['user']['DOB'],
                    'address' => $data['user']['Address'],
                    'city' => $data['user']['City'],
                    'zip' => $data['user']['ZipCode'],
                    'suburb' => $data['user']['Suburb'],
                    'phoneNumber' => $data['user']['PhoneNumber'],
                    
                );
                $this->session->set_userdata($newdata);

                redirect('/personcenter/index');
            } else {
              
                $userdata['userType'] = 'anyone';
                
                $message['wrongInfo'] = "invalidInfo";
                $this->load->view('templates/header', $userdata);
                $this->load->view('login/main',$message);
                $this->load->view('templates/footer');
            }
        
        } else {
            redirect('/login/index');
        }
        } else {redirect('/login/index');}
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('home/index/');
    }

    public function forgotPassword(){
        $userdata['userType'] = 'anyone';
        $this->load->view('templates/header',$userdata);
        $this->load->view('login/forgotPassword');
        $this->load->view('templates/footer');
    }

    /**
     * AJAX
     */
}