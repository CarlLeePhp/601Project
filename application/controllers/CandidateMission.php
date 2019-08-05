<?php

class CandidateMission extends CI_Controller{
    function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

        $this->load->library('session');
        // Load Modesl
        $this->load->model('candidate_model');
	}
    public function index($param = ''){
        
        
        if($param == 'active'){ $active1='';$active2='active';}
        else {$active1='active';$active2='';}
        $data['active1'] = $active1;
        $data['active2'] = $active2;
      
        $userdata['userType'] = 'anyone';
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
        }
        
        $data['citizenships'] = $this->candidate_model->get_citizenships();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/candidatesMission', $data, $userdata);
        $this->load->view('templates/footer');
    }

    public function applyJob(){
        if(!isset($_SESSION['userEmail'])){
            redirect('/personcenter/index');
        }
        $userID = $_SESSION['userID'];
        $data = array(
        'jobInterest' => $this->input->post('jobInterest'),
        'jobType' => $this->input->post('jobType'),
        'jobCV' => $this->input->post('jobCV'),
        'transportation' => $this->input->post('transportation'),
        'LicenseNumber' => $this->input->post('LicenseNumber'),
        'classLicense' => $this->input->post('classLicense'),
        'endorsement' => $this->input->post('endorsement'),
        'citizenship' => $this->input->post('citizenship'),
        'nationality' => $this->input->post('nationality'),
        'passportCountry' => $this->input->post('passportCountry'),
        'passportNumber' => $this->input->post('passportNumber'),
        'compensationInjury' => $this->input->post('compensationInjury'),
        'compensationDateFrom' => $this->input->post('compensationDateFrom'),
        'compensationDateTo' => $this->input->post('compensationDateTo'),
        'asthma' => $this->input->post('asthma'),
        'blackOut' => $this->input->post('blackOut'),
        'diabetes' => $this->input->post('diabetes'),
        'bronchitis' => $this->input->post('bronchitis'),
        'backInjury' => $this->input->post('backInjury'),
        'deafness' => $this->input->post('deafness'),
        'dermatitis' => $this->input->post('dermatitis'),
        'skinInfection' => $this->input->post('skinInfection'),
        'allergies' => $this->input->post('allergies'),
        'hernia' => $this->input->post('hernia'),
        'highBloodPressure' => $this->input->post('highBloodPressure'),
        'heartProblems' => $this->input->post('heartProblems'),
        'usingDrugs' => $this->input->post('usingDrugs'),
        'usingContactLenses' => $this->input->post('usingContactLenses'),
        'RSI' => $this->input->post('RSI'),
        'dependants' => $this->input->post('dependants'),
        'smoke' => $this->input->post('smoke'),
        'conviction' => $this->input->post('conviction'),
        'convictionDetails' => $this->input->post('convictionDetails'),
        'UserID' => $userID
        );

        $this->candidate_model->applyJob($data);

        $config['upload_path'] = '/var/www/candidatesCV/';
        $config['allowed_types'] = 'doc|jpg|png';
        $config['max_size'] = 10000;
        $config['max_width'] = 0;
        $config['max_height'] = 0;

        $this->load->library('upload', $config);
        $fileName = $_FILES['jobCV']['name'];
        echo "File Name: ".$fileName;
        if (!$this->upload->do_upload('jobCV')) {
            echo "Apply Failed";
        } else {
            redirect('/Home/index/');
        }

        
    }

}