<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour_con extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('session_helper');
		$this->load->library('session');
	}

	public function index()
	{
		if (check_first_session()) {
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('index_vi');
			$this->load->view('footer_vi');
			$this->load->view('spnavi_vi');
			$this->load->view('last_vi');
		} else {
			redirect(base_url("first_index"));
		}
	}
}
