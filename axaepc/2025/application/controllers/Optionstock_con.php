<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Optionstock_con extends CI_Controller
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
		$this->load->model('carrental_mo');
		$this->load->model('carrentalstock_mo');
		date_default_timezone_set("Asia/Tokyo");
	}


	//------------------------INDEX------------------------

	public function index()
	{
		// 使用していないが念のためログイン画面に遷移するように設定
		redirect(base_url("admin_con"));
	}

	//------------------------参加者検索------------------------

	public function search()
	{
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');
		if (!$admin_Id) {
			redirect(base_url('admin_con'));
			exit();
		}
		$data = [];
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');
		$data['stock'] = array();
		$data['stock'] = $this->option_mo->getOptionsStockView();
		//var_dump($data);
		$this->load->view('head_vi');
		$this->load->view('header_vi');
		$this->load->view('optionstock_vi', $data);
		$this->load->view('last_vi');
	}

	public function save()
	{
		$key = $this->input->post('M01_Stock_Id');
		//現在の予約数を取得
		$currentdata = $this->option_mo->getOptionsStock($key);
		//入力した在庫数で更新
		$data['M01_Stock'] = $this->input->post('M01_Stock');
		$data['M01_Balance'] = $data['M01_Stock'] - $currentdata['M01_Reserve'];
		$this->option_mo->updateStock($data, ['M01_Stock_Id' => $key]);
		redirect(base_url('optionstock_con/search'));
	}
}
