<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Index_con extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct ();
		$this->load->helper( 'url' );
		$this->load->helper( 'session_helper' );		
		$this->load->library ( 'session' );	
		$this->load->model('entry_mo');		
	}
	
	public function index() {		
		if(check_login_user_session()){
			$R00_Id = $this->session->userdata('user_data');	
			$data = $this->entry_mo->get_reserver_info($R00_Id);
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('index_vi');
			$this->load->view('aside_vi',$data);
			$this->load->view('footer_vi');
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}				
	}
}