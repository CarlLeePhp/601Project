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
                
        $userdata['userType'] = 'anyone';
        
        $this->load->view('templates/header', $userdata);
        $this->load->view('pages/register');
        $this->load->view('templates/footer');
        

        
    }

    function newUser(){
        $userEmail = $_POST['Email'];
        $userPasswd = $_POST['password'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $DOB = $_POST['DOB'];
        $Address = $_POST['Address'];
        $City = $_POST['City'];
        $ZipCode = $_POST['ZipCode'];
        $Suburb = $_POST['Suburb'];
        $PhoneNumber = $_POST['PhoneNumber'];
        $gender = $_POST['gender'];

        $userType = 'candidate';
        $userPasswd = do_hash($userPasswd, 'sha256');

        $this->register_model->addUser($firstName, $lastName, $userEmail, $userPasswd, $Address, $City, $ZipCode, $Suburb, $userType, $PhoneNumber, $DOB, $gender);
        
        $userdata['userType'] = 'anyone';
        $this->load->view('templates/header', $userdata);
        $this->load->view('login');
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