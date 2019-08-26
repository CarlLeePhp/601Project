<?php
class Candidate_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    /**
     * Select Functions
    */
    // get all candidates
    public function getCandidates(){
        $query = $this->db->get('Candidate');
        return $query->result_array();
    }

    
    // get all candidates data that matches jobid for jobDetails
    public function getCandidatesJobDetails($jobID){
        $mySql = "SELECT Candidate.CandidateID,User.FirstName, User.LastName, User.PhoneNumber, User.Email,User.Address, Candidate.JobType,Candidate.CandidateHoursWorked,Candidate.CandidateNotes,Candidate.CandidateEarnings,Candidate.JobRate,Candidate.CandidateNotes FROM Candidate INNER JOIN User ON Candidate.UserID=User.UserID WHERE Candidate.JobID=" . $jobID ;
        $query = $this->db->query($mySql);
        return $query->result_array(); 
    }

    //updateCandidateHoursWorking in jobDetails
    public function updateCandidateHoursWorking($candidateID,$hoursWorked,$candidateEarnings){
        $this->db->where('CandidateID',$candidateID);
        $data = array (
            'CandidateHoursWorked' =>$hoursWorked,
            'CandidateEarnings' => $candidateEarnings
        );
        $this->db->update('Candidate',$data);
    }

    public function resetCandidateJobDetailsData($candidateID){
        $this->db->where('CandidateID',$candidateID);
        $data = array (
            'CandidateHoursWorked' => 0,
            'JobRate' => 0,
            'CandidateEarnings' => 0
        );
        $this->db->update('Candidate',$data);
    }
    //updateCandidateJobRate in jobDetails
    public function updateJobRate($candidateID,$jobRate){
        $this->db->where('CandidateID',$candidateID);
        $data = array(
            'JobRate' => $jobRate,
        );
        $this->db->update('Candidate',$data);
    }

    public function updateCandidateNotes($candidateID,$candidateNotes){
        $this->db->where('CandidateID',$candidateID);
        $data = array (
            'CandidateNotes' => $candidateNotes,
        );
        $this->db->update('Candidate',$data);
    }

    //get candidate based on ID return inner joined table between candidate and user, so far it has been only used on jobdetails table
    public function getCandidateByID($candidateID){
        $mySql = "SELECT Candidate.CandidateID,User.FirstName, User.LastName, User.PhoneNumber, User.Email,User.Address, Candidate.JobType,Candidate.CandidateHoursWorked,Candidate.CandidateNotes,Candidate.CandidateEarnings,Candidate.JobRate,Candidate.CandidateNotes FROM Candidate INNER JOIN User ON Candidate.UserID=User.UserID WHERE Candidate.CandidateID=" . $candidateID ;
        $query = $this->db->query($mySql);
        return $query->row_array();
    }

    public function getCandidateFullInfo($candidateID){
        $mySql = "SELECT User.FirstName, User.LastName, User.PhoneNumber,User.City, User.Suburb, User.DOB, User.Gender,User.ZipCode, User.Email,User.Address, Candidate.* FROM Candidate INNER JOIN User ON Candidate.UserID=User.UserID WHERE Candidate.CandidateID=" . $candidateID ;
        $query = $this->db->query($mySql);
        return $query->row_array();
    }

    //assign jobID to candidate
    public function assignCandidateJobID($candidateID,$jobID){
        $this->db->where('CandidateID',$candidateID);
        $data = array( 
            'JobID' => $jobID,
        );
        $this->db->update('Candidate',$data);
    }

    //remove Candidate From table in job Details
    public function removeAssignedCandidate($candidateID){
        $this->db->where('CandidateID',$candidateID);
        $data = array( 
            'JobID' => '',
        );
        $this->db->update('Candidate',$data);
    }
    // get an user by user name
    public function getUserByEmail($userEmail){
        $this->db->where('Email', $userEmail);
        $query = $this->db->get('User');
        return $query->row_array();
    }

    // get all users
    public function getUsers(){
        $query = $this->db->get('User');
        return $query->result_array();
    }

    //only getting the ID of the user
    public function getUserByData($firstName,$lastName){
        $mySql = 'SELECT User.UserID From User WHERE User.UserID = (SELECT MAX(User.UserID) FROM User WHERE User.FirstName="'.$firstName . '" AND User.LastName="'. $lastName .'")';
        $query = $this->db->query($mySql);
        return $query->row_array();
    }

    // get all candidate with the firstname and lastname of the user
    public function getCandidatesWithName($limitNum, $offsetNum,$page=""){
        //$mySql = "SELECT User.FirstName, User.LastName, Candidate.* FROM Candidate INNER JOIN User ON Candidate.UserID=User.UserID";
        //$query = $this->db->query($mySql);
        $this->db->select('User.FirstName, User.LastName,User.DOB,User.City,User.Address,User.Suburb,User.PhoneNumber,User.Email,User.Gender,Candidate.*');
        $this->db->from('Candidate');
        $this->db->join('User', 'Candidate.UserID = User.UserID');
        if($page == "jobDetails"){
             $this->db->where('Candidate.JobID',NULL);
            $this->db->or_where('Candidate.JobID',"");
            $this->db->or_where('Candidate.JobID',0);
        }
        $this->db->limit($limitNum, $offsetNum);
        $query = $this->db->get();
        return $query->result_array();
    }
    // get all unchecked candidate with the firstname and lastname
    public function getUnchecked(){
        //$mySql = "SELECT User.FirstName, User.LastName, Candidate.* FROM Candidate INNER JOIN User ON Candidate.UserID=User.UserID";
        //$query = $this->db->query($mySql);
        $this->db->select('User.FirstName, User.LastName,User.DOB,User.City,User.Address,User.Suburb,User.PhoneNumber,User.Email,User.Gender,Candidate.*');
        $this->db->from('Candidate');
        $this->db->join('User', 'Candidate.UserID = User.UserID');
        $this->db->where('Checked', NULL);
        $query = $this->db->get();
        return $query->result_array();
    }
    // get all citizenships
    public function get_citizenships(){
        $query = $this->db->get('Citizenship');
        return $query->result_array();
    }

    public function getMaxIDByUserID($userID){
        $mySql = "SELECT MAX(CandidateID) AS MaxID FROM Candidate WHERE UserID='".$userID."'";
        $query = $this->db->query($mySql);
        return $query->row_array();
    }

    // return how many candidates
    public function countAll($page=""){
        
        
        if($page == "jobDetails"){
            $this->db->where('JobID',NULL);
            $this->db->or_where('JobID',"");
            $this->db->or_where('JobID',0);
        }
        
        return $this->db->count_all_results('Candidate');
    }
    /**
     * Insert functions
     */
    public function applyJob($data) {
       
        $this->db->insert('Candidate', $data);
    }

    /**
     * Update Functions
     */

    public function updatePasswdByEmail($email, $userPasswd){
        $data = array(
            'UserPasswd' => $userPasswd
        );
        $this->db->where('Email', $email);
        $this->db->update('User', $data);
    }

    // update jobCV by ID
    public function updateLinkByID($candidateID, $fileName){
        $data = array(
            'jobCV' => $fileName
        );
        $this->db->where('CandidateID', $candidateID);
        $this->db->update('Candidate', $data);
    }
}
