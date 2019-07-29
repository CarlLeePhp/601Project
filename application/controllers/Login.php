<?php
/* Functions
 * 1. This is a login and session test page
 */

class Login extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		// Load url helper
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('session');
        // Load Models
        $this->load->model('user_model');
    }

    function index(){
        $userdata['userType'] = 'anyone';
        
        $this->load->view('templates/header', $userdata);
        $this->load->view('login/main');
        $this->load->view('templates/footer');
    }

    public function login(){
        // When someone enter this link without login, it should be redirecte to login/index
        if(isset($_POST['email'])){
            $userEmail = $_POST['email'];
            $userPasswd = $_POST['passwd'];
            $userPasswd = do_hash($userPasswd, 'sha256');
            // get the user's information from database
            $data['user'] = $this->user_model->getUserByEmail($userEmail);
            if($data['user']['UserPasswd'] == $userPasswd){
                $newdata = array(
                    'userEmail' => $userEmail,
                    'userType' => $data['user']['UserType'],
                    'firstName' => $data['user']['FirstName'],
                    'lastName' => $data['user']['LastName']
                );
                $this->session->set_userdata($newdata);

                redirect('/personcenter/index');
            } else {
                redirect('/login/index');
            }

        } else {
            redirect('/login/index');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('home/index/');
    }

    public function forgotPassword(){
        $userdata['userType'] = 'anyone';
        $this->load->view('templates/header',$userdata);
        $this->load->view('login/forgotPassword');
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