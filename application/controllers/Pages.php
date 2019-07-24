<?php
class Pages extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        // email library
        $this->load->library('email');
        // Load Models
        $this->load->model('pages_model');
        $this->load->model('list_model');
        $this->load->model('boatmodel_model');
        $this->load->model('boat_model');
        $this->load->model('checklist_model');

        $this->load->helper('form');
        
    }
    
    // index
    public function index(){
        // Default Message
        $data['message'] = "";
        
        // get dealer ID from database
        $data['dealers'] = $this->pages_model->get_dealer();
        $data['models'] = $this->boatmodel_model->get_model();
        $data['boats'] = $this->boat_model->get_boats();


        $data['title'] = 'Check List Main Page';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/main', $data);
        $this->load->view('templates/footer', $data);
    }

    // Create a new Dealer
    public function new_dealer(){
        // get all sale
        $data['sales'] = $this->pages_model->get_sale();

        $this->load->view('templates/header');
        $this->load->view('pages/new_dealer', $data);
        $this->load->view('templates/footer');
    }

    


    // Create a new Model
    public function new_model(){
        $this->load->view('templates/header');
        $this->load->view('pages/new_model');
        $this->load->view('templates/footer');
    }

    /**
     * AJAX
     */
    // Create a new Boat
    public function new_boat(){
        $dealer_id = $_POST['dealer'];
        $model_id = $_POST['model'];
        $serial = $_POST['serial'];
        
        // Add a new boat 
        $this->boat_model->add_boat($dealer_id, $model_id);

        // get all CLTP and max boat id
        $items = $this->checklist_model->get_item($model_id);
        $max_id = $this->boat_model->get_max_boat_id();
        
        foreach ($items as $item){
            $cl_des = $item['CLTP_DES'];
            $cl_type = $item['TYPE'];
            $this->list_model->add_item($max_id['MAX_ID'], $cl_des, $cl_type);
        }

        // insert the serial and create a folder
        $this->boat_model->update_boat($max_id['MAX_ID'], $model_id, $serial);

        $my_path = "/var/www/html/dealers/".$dealer_id."/".$serial;
        mkdir($my_path);

        // Return checklist
        $checklist = $this->list_model->get_item($max_id['MAX_ID']);
        $result = json_encode($checklist);
        echo $result;

    }

    // update check list
    public function update_list(){
        $cl_id = $_POST['cl_id'];
        $checked_str = $_POST['checked'];
        $checked = 0;
        if($checked_str=="true"){
            $checked = 1;
        }
        
        $this->list_model->update_check($cl_id, $checked);
       
    }

    // update missed parts for the new boat
    public function update_missed(){
        $max_id = $this->boat_model->get_max_boat_id();
        $missed = $_POST['missed'];

        $this->boat_model->update_missed($max_id['MAX_ID'], $missed);
    }
    // return Boats IDs
    public function getBoat($dealerID){
        $data = $this->pages_model->get_boat($dealerID);
        $result = "";
        foreach ($data as $item){
            $result = $result.$item['BOAT_ID'].",";
            $result = $result.$item['MODEL'].",";
            $result = $result.$item['BOAT_SERIAL'].",";
        }
        $result = substr($result, 0, strlen($result) - 1);
        echo $result;
    }

    // update serial number
    public function updateSerial($boat_id, $serial){
        $this->pages_model->update_serial($boat_id, $serial);
        // echo "Serial: ".$serial." for boat id:".$boat_id;
    }

    /**
     * Other methods
     */
    // Sent email
    public function sent_email(){
        $this->email->from('leekunhui@gmail.com', 'Carl Li');
        $this->email->to('likunhui@hotmail.com');

        $this->email->subject('Test Email Function');
        $this->email->message('Testing the email class.');
        $this->email->attach('/var/www/html/img/apple.jpeg');

        if($this->email->send()){
            $data['message'] = "Success";
        } else {
            $data['message'] = "Failure";
        }

        $this->load->view('templates/header');
        $this->load->view('pages/result_email', $data);
        $this->load->view('templates/footer');

    }

    /**
     * Get uploaded files
     */
    public function get_file(){

        $data['message'] = "";
        $config['upload_path']      = '/var/www/html/dealers/';
        $config['allowed_types']      = 'gif|jpg|png|jpeg';
        $config['max_size']      = 400;
        $config['max_width']      = 1920;
        $config['max_height']      = 1280;

        $this->load->library('upload', $config);
        if(! $this->upload->do_upload('userfile')) {
            $errors =  array('error' => $this->upload->display_errors());
            foreach ($errors as $item => $value) {
                $data['message'] =$data['message'].$item.":".$value."--";
            }
            
        } else {
            $data['message'] = "Success";
        }

        // copy from index
        // get dealer ID from database
        $data['dealers'] = $this->pages_model->get_dealer();


        $data['title'] = 'Check List Main Page';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/main', $data);
        $this->load->view('templates/footer', $data);

    }
}
