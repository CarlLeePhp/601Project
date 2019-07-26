<?php

class Personcenter extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
	}
	public function index()
	{	
        // Check username and the passwd
		if(! isset($_SESSION['userType'])){
			redirect('/login/index');
		}
		
		$data['userName'] = $_SESSION['userName'];
		$data['userType'] = $_SESSION['userType'];
        $data['message'] = "Please Login";
		$data['title'] = "This is Personal Center Page";
		$this->load->view('templates/header');
		$this->load->view('templates/navtop', $data);
		$this->load->view('templates/navbar');
        $this->load->view('personcenter/main', $data);
        $this->load->view('templates/footer');
    }
    
}
