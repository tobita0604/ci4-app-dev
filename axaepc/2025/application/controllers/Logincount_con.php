<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Logincount_con extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct ();
		$this->load->helper( 'url' );
		$this->load->model('logincount_mo');
		$this->load->library ( 'session' );

	}
	
	public function index() {
		
		// Check session
		$admin_id = $this->session->userdata('admin_id_session');
		$chager_type = $this->session->userdata('charger_type');
		
		if (isset($admin_id)) {
			
				
				$data['title'] = 'ログイン集計';
				$data['update_status'] = 0;
				$data['logincount'] = $this->logincount_mo->getLoginData();


				$this->load->view('head_vi');
				$this->load->view('header_vi');
				$this->load->view("logincount_vi" , $data);
				$this->load->view('last_vi');
			
		} else {
			redirect(base_url("admin_con"));
		}
	}

	
}
