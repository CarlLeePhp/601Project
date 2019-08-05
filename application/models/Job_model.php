<?php
class Job_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    /**
     * Select Functions
    */
    // get all jobs
    public function get_jobs() {
        $query = $this->db->get('Job');
        return $query->result_array();
    }

    public function get_sale(){
        $query = $this->db->get('SALE');
        return $query->result_array();
    }

    public function get_model(){
        $query = $this->db->get('BM');
        return $query->result_array();
    }

    public function get_boat($dealerID) {
        $sql = "SELECT BOAT_ID, BOAT_SERIAL, MODEL ";
        $sql = $sql."FROM BOAT ";
        $sql = $sql."LEFT JOIN BM ON BOAT.BOAT_MODEL = BM.MODEL_ID ";
        $sql = $sql."WHERE DEALER_ID = ".$dealerID;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Insert functions
     */

     

    // Insert a new Boat
    public function addJob($clientTitle,$clientName,$clientCompany,$clientEmail,$clientContact,$clientCity,$clientAddress,$clientJobTitle,$clientJobType,$description) {
        $data = array(
            'ClientTitle' => $clientTitle,
            'ClientName' => $clientName,
            'Company' => $clientCompany,
            'Email' => $clientEmail,
            'ContactNumber' => $clientContact,
            'City' => $clientCity,
            'Address' => $clientAddress,
            'JobTitle' => $clientJobTitle,
            'JobType' => $clientJobType,
            'Description' => $description
        );
        $this->db->insert('Job', $data);
    }

    // Insert a new Sale

    public function add_sale($name, $email) {
        $data = array(
            'SALE_NAME' => $name,
            'SALE_EMAIL' => $email
        );
        $this->db->insert('SALE', $data);

        
    }

    // Insert a new boat model
    public function add_model($model) {
        $data = array(
            'MODEL' => $model
        );
        $this->db->insert('BM', $data);
    }

    /**
     * Update Functions
     */

    public function update_serial($boat_id, $serial) {
        $data = array(
            'BOAT_SERIAL' => $serial
        );
        $this->db->where('BOAT_ID', $boat_id);
        $this->db->update('BOAT', $data);
    }
}
