<?php

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
	}
	public function index()
	{	
		$data['userType'] = 'anyone';
		if(isset($_SESSION['logged_in'])){
            $data['userType'] = $_SESSION['userType'];
        }
		$this->load->view('templates/header');
        $this->load->view('register/main', $data);
        $this->load->view('templates/footer');
	}
}
