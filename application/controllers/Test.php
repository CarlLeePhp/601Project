<?php

class Test extends CI_Controller {

	function __construct() {
		parent::__construct();
        // Models
        $this->load->model('candidate_model');

		// Load url helper
        $this->load->helper('url');
        $this->load->helper('download');
		
	}
	public function index()
	{	
        $candidateNum = $this->candidate_model->countAll();
        echo $candidateNum;
    }
    
    public function downloadCV(){
        $path = '/var/www/candidatesCV/1.txt';
        force_download($path, NULL);
    }
}
