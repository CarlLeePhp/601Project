<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    /**
     * Select Functions
    */
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
    

    public function get_sale_id($sale_id){
        $this->db->where('SALE_ID', $sale_id);
        $query = $this->db->get('SALE');
        
        return $query->row_array();
    }

    /**
     * Insert functions
     */
   

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

    public function getAllStaff(){
        $this->db->where('UserType', 'staff');
        $query = $this->db->get('User');
        return $query->result_array();
    }

    public function update_staffPassword($staffID, $newpassword){
        $password = do_hash($newpassword, 'sha256');
        $data = array(
            'UserID' => $staffID,
            'UserPasswd' => $password
        );
       
        $this->db->where('UserID', $staffID);
        $this->db->update('user', $data);
    }

    
    public function delete_staff($staffID) {
        $data = array(
            'UserID' => $staffID
        );
        $this->db->where('UserID',$staffID);
        $this->db->delete('user',$data);
    }

    public function update_personalPassword($userID, $newpassword){
        $password = do_hash($newpassword, 'sha256');
        $data = array(
            'UserID' => $userID,
            'UserPasswd' => $password
        );
       
        $this->db->where('UserID', $userID);
        $this->db->update('user', $data);
    }

    public function update_personalDetails($userID,$data){
        $this->db->where('UserID', $userID);
        $this->db->update('user', $data);
    }
}
