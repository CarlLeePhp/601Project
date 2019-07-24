<?php


class Demo extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        // Load Models
        $this->load->helper('form');
    }

    public function index(){
        $this->load->view('demo/upload_form', array('error' => ' '));
    }

    public function do_upload(){
        $config['upload_path'] = '/var/www/html/dealers/';
        $config['allowed_types'] = 'git|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 2000;
        $config['max_height'] = 1800;

        $this->load->library('upload', $config);

        if( ! $this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('demo/upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('demo/success', $data);
        }
    }
}