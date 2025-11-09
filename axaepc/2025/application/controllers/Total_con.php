<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Total_con extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('common_helper');
		$this->load->library('session');
		$this->load->model("total_mo");
	}

	public function index()
	{
		// Check session
		$admin_id = $this->session->userdata('admin_id_session');
		if (isset($admin_id)) {

			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view("total_vi", $data);
			$this->load->view('last_vi');
		} else {
			redirect(base_url("admin_con"));
		}
	}
	public function login()
	{

		// Check session
		$admin_id = $this->session->userdata('admin_id_session');
		$chager_type = $this->session->userdata('charger_type');

		if (isset($admin_id)) {
			$data['login'] = $this->total_mo->getLoginData();
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view("total_login_vi", $data);
			$this->load->view('last_vi');
		} else {
			redirect(base_url("admin_con"));
		}
	}


	public function register()
	{
		// Check session
		$admin_id = $this->session->userdata('admin_id_session');
		$chager_type = $this->session->userdata('charger_type');

		if (isset($admin_id)) {
			$data['register'] = $this->total_mo->getRegisterData();
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view("total_register_vi", $data);
			$this->load->view('last_vi');
		} else {
			redirect(base_url("admin_con"));
		}
	}
}
