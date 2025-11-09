<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransferAdmin_con extends CI_Controller
{
	//------------------------コンストラクタ------------------------
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('common_helper');
		$this->load->model('menu_mo');
		$this->load->model('mypage_mo');
		$this->load->model('login_mo');
		$this->load->library('session');
		$this->load->model('common_mo');
		$this->load->model('entry_mo');
		$this->load->model('option_mo');
		$this->load->model('transfer_mo');

		date_default_timezone_set("Asia/Tokyo");
	}


	//------------------------INDEX------------------------

	public function index()
	{
		// 使用していないが念のためログイン画面に遷移するように設定
		redirect(base_url("admin_con"));
	}

	//------------------------北海道内の移動方法の取得------------------------

	public function search()
	{
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');

		if (isset($admin_Id)) {
			$result = array();
			$result = $this->transfer_mo->getTransferCount();
			$data['result'] = $result;

			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('transfer_admin_vi', $data);
			$this->load->view('last_vi');
		} else {
			redirect(base_url('admin_con'));
		}
	}
}
