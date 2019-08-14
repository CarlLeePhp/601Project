<?php


Class City_model extends CI_Model{

    public function __construct() {
        $this->load->database();
    }


    public function get_cities(){
        $query = $this->db->get('City');
        return $query->result_array();
    }

}