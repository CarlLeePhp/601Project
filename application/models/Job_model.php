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
        $this->db->order_by('JobSubmittedDate', 'DESC');
        $query = $this->db->get('Job');
        return $query->result_array();
    }

    public function get_publishedjobs($page,$jobTitle,$jobType,$location) {
        $this->db->select('JobID,ThumbnailText,PublishTitle,JobTitle,JobType,City');
         
        $this->db->where('JobStatus', 'published');
        if($page=="home"){
            $this->db->limit(9); 
        }
        if($jobTitle != ""){
            $this->db->where('JobTitle', $jobTitle);
        }
        if($jobType != ""){
            $this->db->where('JobType', $jobType);
        }
        if($location != ""){
            $this->db->where('City', $location);
        }
     
        $query = $this->db->get('Job');
        return $query->result_array();
    }

    public function get_specificJob($jobID){
        $this->db->where('JobID', $jobID);
        $query = $this->db->get('job');
        return $query->row_array();
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
    public function addJob($clientTitle,$clientName,$clientCompany,$clientEmail,$clientContact,$clientCity,$clientAddress,$clientJobTitle,$clientJobType,$description,$suburb,$dateJobSubmitted) {
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
            'Description' => $description,
            'Suburb' => $suburb,
            'JobSubmittedDate' => $dateJobSubmitted,
        );
        $this->db->insert('Job', $data);
    }

    public function publishJob($jobID,$textEditor,$thumbnailText,$publishTitle,$publishDate){
        $data = array(
            'JobStatus' => 'published',
            'Editor1' => $textEditor,
            'ThumbnailText' => $thumbnailText,
            'PublishTitle' => $publishTitle,
            'PublishDate' => $publishDate,
        );
        $this->db->where('JobID',$jobID);
        $this->db->update('job',$data);
    }
    // Insert a new Sale

    public function unpublishJob($jobID){
        $data = array(
            'JobStatus' => 'null',
        );
        $this->db->where('JobID',$jobID);
        $this->db->update('job',$data);
    }

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
