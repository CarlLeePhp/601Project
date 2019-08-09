<?php 


class EmployerMission extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

        $this->load->library('session');
        
        // Load Models
        $this->load->model('city_model');
        $this->load->model('job_model');
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
        $data['cities'] = $this->city_model->get_cities();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/employerMission', $data);
        $this->load->view('templates/footer');

    }

    public function addJob(){
        $clientTitle = $_POST['clientTitle'];
        $clientName = $_POST['clientName'];
        $clientCompany = $_POST['clientCompany'];
        $clientEmail = $_POST['clientEmail'];
        $clientContact = $_POST['clientContact'];
        $clientCity = $_POST['clientCity'];
        $clientAddress = $_POST['clientAddress'];
        $clientJobTitle = $_POST['clientJobTitle'];
        $clientJobType = $_POST['clientJobType'];
        $description = $_POST['description'];
        
        $userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
        }
        $this->job_model->addJob($clientTitle,$clientName,$clientCompany,$clientEmail,$clientContact,$clientCity,$clientAddress,$clientJobTitle,$clientJobType,$description);
        $data['cities'] = $this->city_model->get_cities();
        $data['title'] = 'Job was added successfully.';
        $this->load->view('templates/header', $userdata);
        $this->load->view('home/main', $data);
        $this->load->view('templates/footer');
    }
}