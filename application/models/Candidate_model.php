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
    // get all candidate with the firstname and lastname of the user
    public function getCandidatesWithName($limitNum, $offsetNum){
        //$mySql = "SELECT User.FirstName, User.LastName, Candidate.* FROM Candidate INNER JOIN User ON Candidate.UserID=User.UserID";
        //$query = $this->db->query($mySql);
        $this->db->select('User.FirstName, User.LastName, Candidate.*');
        $this->db->from('Candidate');
        $this->db->join('User', 'Candidate.UserID = User.UserID');
        $this->db->limit($limitNum, $offsetNum);
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
    public function countAll(){
        $result = $this->db->count_all('Candidate');
        return $result;
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

    public function update_sale($sale_id, $sale_name, $sale_email){
        $data = array(
            'SALE_NAME' => $sale_name,
            'SALE_EMAIL' => $sale_email
        );
        $this->db->where('SALE_ID', $sale_id);
        $this->db->update('SALE', $data);
    }

    public function remove_sale($sale_id){
        $data = array(
            'AVAILABLE' => 'no'
        );
        $this->db->where('SALE_ID', $sale_id);
        $this->db->update('SALE', $data);
    }
}
