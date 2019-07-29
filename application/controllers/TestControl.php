<?php


class TestControl extends CI_Controller {

    public function __construct() {
        parent::__construct();
        }

    public function index(){
        
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
            'convictionDetails' => $this->input->post('convictionDetails')

           
            );

            foreach($data as $key => $value) {
                echo "$key: $value <br>";
            } 
    }


}