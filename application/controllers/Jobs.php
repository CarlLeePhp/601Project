<?php

class Jobs extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// Load url helper
		$this->load->helper('url');
		$this->load->helper('security');

		$this->load->library('session');
		// Load Models
		$this->load->model('job_model');
		$this->load->model('city_model');
		$this->load->model('candidate_model');
	}
	public function index()
	{	
		$userdata['userType'] = 'anyone';
		$jobTitle ="";
		$jobType="";
		$location="";
		$page="jobs";
        if(isset($_SESSION['userEmail'])){
            $userdata['userEmail'] = $_SESSION['userEmail'];
			$userdata['userType'] = $_SESSION['userType'];
		};
		if(isset($_POST['jobTitle'])){
			$jobTitle = $_POST['jobTitle'];
			
		};
		if(isset($_POST['jobType'])){
			$jobType = $_POST['jobType'];
			};
		if(isset($_POST['location'])){
			$location = $_POST['location'];
		};

		// get all jobs for the table status=published
		$data['jobs'] = $this->job_model->get_publishedjobs($page,$jobTitle,$jobType,$location);
		
		$data['cities'] = $this->city_model->get_cities();
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/jobs', $data);
        $this->load->view('templates/footer');
	}

	
	// show client tables
	public function manageClient(){
		if(!(isset($_SESSION['userType']))&& $_SESSION['userType']!='admin'){
			redirect('/');
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Manage Client";
		$data['message'] ="";
		$data['jobs'] = $this->job_model->get_jobs();
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/manageClient',$data);
		$this->load->view('templates/footer');
		
	}

	public function jobDetails($paramJobID){
		if(!(isset($_SESSION['userType']))&& ($_SESSION['userType']!='admin' || $_SESSION['userType']!='staff')){
			redirect('/');
			$paramJobID="";
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Job Details";
		$data['job'] = $this->job_model->get_specificJob($paramJobID);
		$data['candidatesData'] = $this->candidate_model->getCandidatesJobDetails($paramJobID);
		
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobDetails',$data);
		$this->load->view('templates/footer');
	}

	public function jobPublish($paramJobID){
		if(!(isset($_SESSION['userType']))&& !($_SESSION['userType']=='admin' || $_SESSION['userType']=='staff')){
			redirect('/');
			$paramJobID = "";
		}
		$job = $this->job_model->get_specificJob($paramJobID);
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Job Details";

		//content
		$publishTitle = $_POST['publishTitle'];
		if($publishTitle == NULL) {
			$publishTitle = $job['JobType'] . ' ' . $job['JobTitle'] . ' worker Needed in ' . $job['City'];
		}
		$thumbnailText = $_POST['thumbnailText'];
		if($thumbnailText == NULL || strcasecmp($thumbnailText,'Enter text for thumbnail')==0){
			$thumbnailText = "";
		}
		$textEditor = $_POST['editor1'];
		if($textEditor == NULL || strrpos($textEditor,'Enter the text for job')){
			$textEditor = 'For further information please contact us or email us at <a href="mailto:mark@leerecruitment.co.nz"><strong>mark@leerecruitment.co.nz</strong></a>';
		}
		//4digitsYear-2digitsMonth-2digitsDay Format to match sql
		$publishDate = date('Y-m-d');
		//update the job
		$this->job_model->publishJob($paramJobID,$textEditor,$thumbnailText,$publishTitle,$publishDate);
		//select the job 
		$data['job'] = $this->job_model->get_specificJob($paramJobID);
		$data['candidatesData'] = $this->candidate_model->getCandidatesJobDetails($paramJobID);

		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobDetails',$data);
		$this->load->view('templates/footer');
	}

	public function jobUnpublish($paramJobID){
		if(!(isset($_SESSION['userType']))&& !($_SESSION['userType']=='admin' || $_SESSION['userType']=='staff')){
			redirect('/');
			$paramJobID = "";
		}
		$userdata['userType'] = $_SESSION['userType'];
		$data['title'] = "Job Details";
		
		//update the jobstatus to null
		$this->job_model->unpublishJob($paramJobID);
		//select the job 
		$data['job'] = $this->job_model->get_specificJob($paramJobID);
		$data['candidatesData'] = $this->candidate_model->getCandidatesJobDetails($paramJobID);
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobDetails',$data);
		$this->load->view('templates/footer');
	}
	/**
	 * AJAX Methods for staff and Admin
	 */
	public function updateHoursWorked($candidateID){
		$candidateData = $this->candidate_model->getCandidateByID($candidateID);
		$hoursWorked = $_POST['hoursWorked'];
		$diffhoursWorked = $hoursWorked - $candidateData['CandidateHoursWorked'];
		$currentEarnings = $candidateData['CandidateEarnings'];
		$jobRate = $candidateData['JobRate'];
		$currentEarnings = $diffhoursWorked * $jobRate + $currentEarnings; 
		$this->candidate_model->updateCandidateHoursWorking($candidateID,$hoursWorked,$currentEarnings);
		$candidateData = $this->candidate_model->getCandidateByID($candidateID);
		$workingHoursSaved = $_POST['workingHoursSaved'];
		$this->loadJobDetailsRow($candidateData,$workingHoursSaved);
	}

	public function loadJobDetailsTable($candidatesData){
		echo '<table class="table border-bottom border-dark"><thead>
        <tr>
		<th scope="col">#</th>
		<th scope="col">!</th>
        <th scope="col">Candidate Name</th>
        <th scope="col">Contact Number</th>
		<th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Job Type</th>
        <th scope="col">Hours working</th>
        <th scope="col">JobRates</th>
		<th scope="col">Total Earned</th>
        <th scope="col">Notes</th>
        </tr>
		</thead><tbody class="align-items-center">';
		foreach ($candidatesData as $candidateData){
		$savedHoursWorked[$candidateData['CandidateID']] = $candidateData['CandidateHoursWorked'];
		echo '<form>';
		$this->loadJobDetailsRow($candidateData,$savedHoursWorked[$candidateData['CandidateID']]);
        echo '</form>';
		}
		echo '</tbody>
		</table>';
	}

	public function loadJobDetailsRow($candidateData,$savedHoursWorked){
		echo '<th><a onclick="removeAssignedCandidate(' .  $candidateData['CandidateID'] . ')" class="text-danger"><i style="font-size:25px" class="icon ion-md-close-circle"></i> </a></th>';
		echo '<td><a onclick="resetCandidateData(' . $candidateData['CandidateID'] .',' . $savedHoursWorked . ')" class="text-secondary" ><i style="font-size:25px" class="icon ion-md-trash"></i></a></td>';
		echo '<td>' . $candidateData['FirstName'] . ' ' . $candidateData['LastName'] . '</td>';
        echo '<td>' . $candidateData['PhoneNumber'] . '</td>';
        echo '<td>' . $candidateData['Email'] . '</td>';
		echo '<td>' . $candidateData['Address'] . '</td>';
        echo '<td>' . $candidateData['jobType'] . '</td>';
		echo '<td><input type="text" id="hoursWorked' . $candidateData['CandidateID'] . '" onchange="updateHoursWorked(' . $candidateData['CandidateID'] .',' . $savedHoursWorked . ')" placeholder="' . $candidateData['CandidateHoursWorked'] . '"></td>';
		echo '<td><input type="text" id="jobRate' . $ciandidateData['CandidateID'] . '" onchange="updateJobRate(' . $candidateData['CandidateID'] .',' . $savedHoursWorked . ')" placeholder="' . $candidateData['JobRate'] .'"></td>';
		echo '<td><input type="text" class="border-0" id="candidateEarnings' . $candidateData['CandidateID'] . '" value="' . $candidateData['CandidateEarnings'] . '"></td>';
		echo '<td><input type="text" id="candidateNotes' . $candidateData['CandidateID'] . '" onchange="updateCandidateNotes(' . $candidateData['CandidateID'] . ',' . $savedHoursWorked . ')" placeholder="' . $candidateData['CandidateNotes'] . '"></td></tr>';
	}

	//this is working, Removed Candidate, set job Status to NULL
	public function removeAssignedCandidate($candidateID,$jobID){
		$this->candidate_model->removeAssignedCandidate($candidateID);
		$job = $this->job_model->get_specificJob($jobID);
		$candidatesData = $this->candidate_model->getCandidatesJobDetails($jobID);
		if(sizeof($candidatesData)==0){
			$this->job_model->updateJobDetailsStatusNull($jobID);
		}
		$this->loadJobDetailsTable($candidatesData);
	}

	public function updateJobRate($candidateID){
		
		$candidateData = $this->candidate_model->getCandidateByID($candidateID);
		$jobRate = $_POST['jobRate'];
		$workingHoursSaved = $_POST['workingHoursSaved'];
		if($workingHoursSaved=="" || $workingHoursSaved == NULL || $workingHoursSaved == 0){
			$candidateEarnings = $jobRate * $candidateData['CandidateHoursWorked'];
			$this->candidate_model->updateCandidateHoursWorking($candidateID,$candidateData['CandidateHoursWorked'],$candidateEarnings);
		}
		$this->candidate_model->updateJobRate($candidateID,$jobRate);
		$candidateData = $this->candidate_model->getCandidateByID($candidateID);
		$workingHoursSaved = $_POST['workingHoursSaved'];
		$this->loadJobDetailsRow($candidateData,$workingHoursSaved);
	}

	public function updateCandidateNotes($candidateID){
		$candidateNotes = $_POST['candidateNotes'];
		$this->candidate_model->updateCandidateNotes($candidateID,$candidateNotes);
		$candidateData = $this->candidate_model->getCandidateByID($candidateID);
		$workingHoursSaved = $_POST['workingHoursSaved'];
		$this->loadJobDetailsRow($candidateData,$workingHoursSaved);
	}

	public function resetCandidateData($candidateID){
		$this->candidate_model->resetCandidateJobDetailsData($candidateID);
		$candidateData = $this->candidate_model->getCandidateByID($candidateID);
		$workingHoursSaved = $_POST['workingHoursSaved'];
	
		$this->loadJobDetailsRow($candidateData,$workingHoursSaved);
	}

	public function jobInfo($jobID){
		$data['job'] = $this->job_model->get_specificJobInfo($jobID);
		
		$userdata['userType'] = $_SESSION['userType'];
		$this->load->view('templates/header',$userdata);
		$this->load->view('pages/jobInfo',$data);
		$this->load->view('templates/footer');
	}
}
