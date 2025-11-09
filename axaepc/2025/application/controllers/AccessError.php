<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class AccessError extends CI_Controller {
    public function __construct()
    {
        parent::__construct ();
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index() 
    {
        $this->load->view('head_vi');
        $this->load->view('header_vi');
        $this->load->view("login_access_error_vi", []);
        $this->load->view('last_vi');
    }
}