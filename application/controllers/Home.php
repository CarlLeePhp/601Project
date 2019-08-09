<?php

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
		$this->load->model('city_model');
	}
	public function index()
	{	
		$userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		}
		$data['cities'] = $this->city_model->get_cities();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/main',$data);
        $this->load->view('templates/footer');
	}
}
