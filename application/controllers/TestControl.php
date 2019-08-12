<?php

class TestControl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($param)
    {

      $data['mess'] = $_POST[$param];


        
    }

}