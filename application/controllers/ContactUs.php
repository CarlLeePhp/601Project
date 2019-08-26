<?php
class ContactUS extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
	}

    public function index(){

        $userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		}
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/contactUS');
        $this->load->view('templates/footer');

    }

    /**
     * Methods for AJAX
     */

    public function sendMessage(){
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $userContact = $_POST['userContact'];
        $userMessage = $_POST['userMessage'];

        /**
         * Email config
         */
            
        $to      = 'leekunhui@gmail.com';
        $subject = 'Message from Website';
        $message = 'Name: '.$userName.'; Email: '.$userEmail.'; Contact: '.$userContact.';\n Message:'.$userMessage;
        $headers = 'From: carl@markleetesting12300.name' . "\r\n" .
            'Return-Path: carl@markleetesting12300.name' . "\r\n" .
            'Reply-To: carl@markleetesting12300.name' . "\r\n";
        mail($to, $subject, $message, $headers);

     }
}