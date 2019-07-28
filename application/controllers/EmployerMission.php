<?php 


class EmployerMission extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
	}
    public function index($param=''){

        $data['active1'] = '';
        $data['active2'] = '';
        $data['active3'] = '';
        if($param == 2) {
            $data['active2'] = 'active';
        } elseif ($param == 3) {
            $data['active3'] = 'active';
        } else {
            $data['active1'] = 'active';
        }

        $userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		}
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/employerMission', $data);
        $this->load->view('templates/footer');

    }
}