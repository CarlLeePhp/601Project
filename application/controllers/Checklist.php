<?php
/* Functions
 * 1. List all check list temple. => index
 * 2. Add a new check list item for a specific boat model.
 * 3. Update a check list item.
 * 4. Delete a check list item.
 * AJAX:
 * 1. return check list item as per boat model ID
 */

class Checklist extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        // Load Models
        $this->load->model('checklist_model');
        $this->load->model('pages_model');
        $this->load->model('boatmodel_model');
    }

    function index(){
        $data['message'] = '';
        
        // when get update, update the description
        if(isset($_POST['update'])){
            $cltp_id = $_POST['update'];
            $item = $_POST['item'];
            $item_type = $_POST['type'];

            $this->checklist_model->update_item($cltp_id, $item, $item_type);
            $data['message'] = "The item (ID ".$cltp_id.") was updated.";
        }
        
        // when get remove, remove that item
        if(isset($_POST['remove'])){
            $cltp_id = $_POST['remove'];
            

            $this->checklist_model->remove_item($cltp_id);
            $data['message'] = "The item (ID ".$cltp_id.") was removed.";
        }
        // get all boat model to fill the dropdown
        $data['models'] = $this->boatmodel_model->get_model();

        $data['title'] = 'Check List Item Management';
        $this->load->view('templates/header');
        $this->load->view('checklist/main', $data);
        $this->load->view('templates/footer');
    }

    function edit_item($cltp_id){
        
        // find the item by ID
   
        $data['item'] = $this->checklist_model->get_item_id($cltp_id);
        $data['title'] = "Check List Item Edit";
        $this->load->view('templates/header');
        $this->load->view('checklist/edit_item', $data);
        $this->load->view('templates/footer');
        
    }

    function remove_item($cltp_id){
        // find the item by ID
        $data['item'] = $this->checklist_model->get_item_id($cltp_id);
        $data['title'] = "Are you suer you want to remove:";
        $this->load->view('templates/header');
        $this->load->view('checklist/remove_item', $data);
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
            $result = $result.$item['CLTP_ID'].",";
            $result = $result.$item['CLTP_DES'].",";
            $result = $result.$item['BOAT_MODEL'].",";
            $result = $result.$item['TYPE'].",";
        }
        $result = substr($result, 0, strlen($result) - 1);
        echo $result;
    }

    function add_item(){
        $model_id = $_POST['model_id'];
        $new_item = $_POST['new_item'];
        $item_type = $_POST['type'];

        $this->checklist_model->add_item($model_id, $new_item, $item_type);

        // get the new list
        $data = $this->checklist_model->get_item($model_id);
        $result = "";
        foreach ($data as $item){
            $result = $result.$item['CLTP_ID'].",";
            $result = $result.$item['CLTP_DES'].",";
            $result = $result.$item['BOAT_MODEL'].",";
            $result = $result.$item['TYPE'].",";
        }
        $result = substr($result, 0, strlen($result) - 1);
        echo $result;
    }
}