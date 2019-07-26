<?php

class Aboutus extends CI_Controller {

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
		if(isset($_SESSION['userName'])){
            $data['userName'] = $_SESSION['userName'];
			$data['userType'] = $_SESSION['userType'];
		}
		
		$data['title'] = "This is About Us Page";
		$this->load->view('templates/header');
		$this->load->view('templates/navtop', $data);
		$this->load->view('templates/navbar');
        $this->load->view('home/main', $data);
        $this->load->view('templates/footer');
	}
}
