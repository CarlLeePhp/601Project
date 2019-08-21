<?php
class Job_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    /**
     * Select Functions
    */
    // get all jobs
    public function get_jobs($page="") {
        if($page=='archive'){
            $this->db->where('JobStatus','completed');
        } else {
            $data = array('completed');
            $this->db->where_not_in('JobStatus',$data);
        }
        $this->db->order_by('JobSubmittedDate', 'DESC');
        $query = $this->db->get('Job');
        return $query->result_array();
    }

    // get all unchecked jobs
    public function getUnchecked(){
        $this->db->where('Checked', NULL);
        $this->db->order_by('JobSubmittedDate', 'DESC');
        $query = $this->db->get('Job');
        return $query->result_array();
    }

    public function get_publishedjobs($page,$jobTitle,$jobType,$location) {
        $this->db->select('JobID,ThumbnailText,PublishTitle,JobTitle,JobType,City,JobImage');
         
        $this->db->where('JobStatus', 'published');
        if($page=="home"){
            $this->db->order_by('PublishDate', 'DESC');
            $this->db->limit(9);
        }
        if($jobTitle != ""){
            $this->db->like('JobTitle', $jobTitle);
        }
        if($jobType != "Enter Job Type" && $jobType != ""){
            $this->db->where('JobType', $jobType);
        }
        if($location != "Enter Location" && $location != "" && $location != "Enter City"){
            $this->db->where('City', $location);
        }
     
        $query = $this->db->get('Job');
        return $query->result_array();
    }

    public function get_specificJobInfo($jobID){
        $this->db->where('JobStatus', 'published');
        $this->db->where('JobID',$jobID);
        $this->db->select('JobID,ThumbnailText,JobTitle,JobType,City,Suburb,PublishDate,PublishTitle,Editor1,JobImage');
        $query = $this->db->get('Job');
        return $query->row_array();
    }

    public function get_specificJob($jobID){
        $this->db->where('JobID', $jobID);
        $query = $this->db->get('Job');
        return $query->row_array();
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

    public function publishJob($jobID,$textEditor,$thumbnailText,$publishTitle,$publishDate,$fileDestination=""){
        
        $data = array(
            'JobStatus' => 'published',
            'Editor1' => $textEditor,
            'ThumbnailText' => $thumbnailText,
            'PublishTitle' => $publishTitle,
            'PublishDate' => $publishDate,
        );
        if(!empty($fileDestination)){
            $data['JobImage'] = $fileDestination;
        }
        $this->db->where('JobID',$jobID);
        $this->db->update('Job',$data);
    }
    // Insert a new Sale

    public function unpublishJob($jobID){
        $data = array(
            'JobStatus' => 'null',
        );
        $this->db->where('JobID',$jobID);
        $this->db->update('Job',$data);
    }


    public function updateJobDetailsStatusNull($jobID){
        $this->db->where('JobID',$jobID);
        $data = array(
            'JobStatus' => '',
        );
        $this->db->update('Job',$data);
    }

    public function updateBookmarkStatus($jobID,$bookmarkValue){

        $this->db->where('JobID',$jobID);
        $data = array(
            'Bookmark' => $bookmarkValue,
        );
        $this->db->update('Job',$data);
    }
}
