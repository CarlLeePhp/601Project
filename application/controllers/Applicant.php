<?php

class Applicant extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
        $this->load->helper('security');

        $this->load->library('session');
        // Load Modesl
        $this->load->model('job_model');
		$this->load->model('city_model');
        $this->load->model('candidate_model');
    }

    //loading a look for applicants page
    //accessible only for staff and admin, in there they could see all new candidate and request from client
    public function index(){
        
        
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $userdata['userType'] = $_SESSION['userType'];

            $data['title'] = "Manage Client";
            $data['message'] ="";
            $data['jobs'] = $this->job_model->getUnchecked();
            $data['candidates'] = $this->candidate_model->getUnchecked();
            
            $this->load->view('templates/header',$userdata);
            //$this->load->view('pages/lookForApplicants',$data);
            $this->load->view('applicant/tabHeader');
            $this->load->view('applicant/tab1');
            $this->load->view('applicant/tab2');
            $this->load->view('templates/modal');
            $this->load->view('applicant/vue',$data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }
    }

    // show candidate table
	public function manageCandidate(){
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $userdata['userType'] = $_SESSION['userType'];
            $data['title'] = "Manage Candidate";
            $data['message'] ="";
            $data['candidateNum'] = $this->candidate_model->countAll();
            // $data['candidateNum'] = 30;
            $data['candidates'] = $this->candidate_model->getCandidatesWithName(10, 0);
            $this->load->view('templates/header',$userdata);
            $this->load->view('pages/manageCandidate',$data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }
		
    }

    // download CV
    public function downloadCV($fileName){
        if( $_SESSION['userType']=='admin' || $_SESSION['userType'] =='staff'){
            $path = '/var/www/candidatesCV/'.$fileName;
            force_download($path, NULL);
        } else {
            redirect('/');
        }
    }
    
    
    /**
     * AJAX Methods
     */
    public function checkClient(){
        $jobID = $_POST['jobID'];
        // Check the Job
        $this->job_model->checkJob($jobID);
        
    }

    public function checkCandidate(){
        $candidateID = $_POST['candidateID'];
        // Check the Candidate
        $this->candidate_model->checkCandidate($candidateID);
    }
    

}