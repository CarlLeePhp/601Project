<?php
/* Functions
 * 1. List all boat models. => index
 * 2. 
 * AJAX:
 * 1. return check list item as per boat model ID
 */

class Register extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        $this->load->helper('security');
        // Load Models
        $this->load->model('register_model');
        $this->load->library('session');
    }

    function index(){
        // get new register
        if(isset($_POST['new'])){
            $userName = $_POST['name'];
            $userEmail = $_POST['email'];
            $userType = $_POST['type'];
            $userPasswd = $_POST['passwd'];

            $userPasswd = do_hash($userPasswd, 'sha256');
            $this->register_model->addUser($userName, $userEmail, $userPasswd, $userType);
        }


        $data['title'] = 'Register Page';
        $this->load->view('templates/header');
        $this->load->view('register/main', $data);
        $this->load->view('templates/footer');
    }

    function edit_sale($sale_id){
        // find the sale by ID
        $data['sale'] = $this->sale_model->get_sale_id($sale_id);
        $data['title'] = "Sale Edit";
        $this->load->view('templates/header');
        $this->load->view('sale/edit_sale', $data);
        $this->load->view('templates/footer');
    }

    function remove_sale($sale_id){
        $data['sale'] = $this->sale_model->get_sale_id($sale_id);
        $data['title'] = "Are you sure you want to remove:";

        $this->load->view('templates/header');
        $this->load->view('sale/remove_sale', $data);
        $this->load->view('templates/footer');        
    }

    /**
     * AJAX
     */
    // return check list item
    function getItem($model_id){
        $data = $this->checklist_model->get_item($model_id);
        $result = "";
        foreach ($data as $item){
            $result = $result.$item['CLTP_DES'].",";
        }
        $result = substr($result, 0, strlen($result) - 1);
        echo $result;
    }

    // add a new boat model
    function add_model(){
        $new_model = $_POST['new_model'];
        
        $this->boatmodel_model->add_model($new_model);

    }
}