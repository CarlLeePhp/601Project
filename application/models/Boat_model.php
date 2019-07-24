<?php
class Boat_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    /**
     * Select Functions
    */
    // get all dealers join with sale, available = yes
    public function get_dealer(){
        $sql = "SELECT DEALER_ID, DEALER_NAME, SALE_NAME, SALE_EMAIL FROM DEALER LEFT JOIN SALE ON DEALER.SALE_ID = SALE.SALE_ID WHERE DEALER.AVAILABLE = 'yes'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // get all boats
    public function get_boats(){
        $query = $this->db->get('BOAT');

        return $query->result_array();
    }

    public function get_boat_id($boat_id){
        $this->db->where('BOAT_ID', $boat_id);
        $query = $this->db->get('BOAT');

        return $query->row_array();
    }

    // get max boat_id
    public function get_max_boat_id(){
        $sql = "SELECT MAX(BOAT_ID) AS MAX_ID FROM BOAT";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    // get boats by dealer_id
    public function get_boat($dealer_id){
        $sql = "SELECT BOAT_ID, BOAT_SERIAL, MODEL ";
        $sql = $sql."FROM BOAT LEFT JOIN BM ON BOAT.BOAT_MODEL = BM.MODEL_ID ";
        $sql = $sql."WHERE BOAT.DEALER_ID=".$dealer_id;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Insert functions
     */
    // Insert a check list item
    public function add_boat($dealer_id, $model_id) {
        $data = array(
            'DEALER_ID' => $dealer_id,
            'BOAT_MODEL' => $model_id
        );
        $this->db->insert('BOAT', $data);
    }

    /**
     * Update Functions
     */


    public function update_boat($boat_id, $model_id, $serial){
        $data = array(
            'BOAT_MODEL' => $model_id,
            'BOAT_SERIAL' => $serial
        );
        $this->db->where('BOAT_ID', $boat_id);
        $this->db->update('BOAT', $data);
    }

    // update missed parts information by boat id
    public function update_missed($boat_id, $missed){
        $data = array(
            'MISSED' => $missed
        );
        $this->db->where('BOAT_ID', $boat_id);
        $this->db->update('BOAT', $data);
    }
    
    public function remove_boat($boat_id){
        $data = array(
            'BOAT_ID' => $boat_id
        );
        $this->db->delete('BOAT', $data);
    }
}
