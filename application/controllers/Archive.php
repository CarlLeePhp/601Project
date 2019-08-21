<?php



class Archive extends CI_Controller{

    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
		$this->load->model('city_model');
		$this->load->model('job_model');
	}

    public function index(){
        
        if(isset($_SESSION['userType']) && ($_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff')){

            $userdata['userType'] = $_SESSION['userType'];
            $data['title'] = "Archive";
            $data['message'] ="";
            $data['jobs'] = $this->job_model->get_jobs('archive');
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/archive',$data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }
}