<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_con extends CI_Controller
{
	//------------------------コンストラクタ------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin_mo');
        $this->load->model('menu_mo');
        $this->load->library('session');
        $this->load->model("admin_admin_ip_mo");
    }

	//------------------------INDEX------------------------
	public function index()
	{
		$this->authIpAddress();
		$this->load->view('head_vi');
		$this->load->view('header_vi');
		$this->load->view('admin_vi');
		$this->load->view('last_vi');
	}


	//------------------------管理者ログイン------------------------
	public function admin_login()
	{
		$this->authIpAddress();
		$admin_id = $_POST['user_id'];
		$admin_pass = $_POST['password'];
		$data = array();
		$data['R01_Id'] = $admin_id;
		$data['R01_Password'] = $admin_pass;

		// CHECK LOGIN
		if (empty($admin_id) || empty($admin_pass)) { // IDとパスワード入力していない場合
			if (empty($admin_id) && empty($admin_pass)) {
				$data['messager'] = 'ご登録IDとパスワードを入力してください。';
			} else {
				$data['messager'] = 'ご登録IDまたはパスワードが違います。';
			}
			$this->load->view('head_vi');
			$this->load->view('admin_vi', $data);
			$this->load->view('last_vi');
		} else {
			$isExistUser = $this->admin_mo->isExistIdAndPassword($admin_id, $admin_pass);
			$charger_type_arr = $this->admin_mo->getChargerTypeById($admin_id);
			$charger_type = $charger_type_arr['Charger_Type'];
			if ($isExistUser != null || $isExistUser != "") {
				$this->session->set_userdata('admin_id_session', $admin_id);
				$this->session->set_userdata('charger_type', $charger_type);
				redirect(base_url('menu_con'));
			} else {
				$data['messager'] = 'ご登録IDまたはパスワードが違います。';
				$data['title'] = 'Login';
				$this->load->view('head_vi');
				$this->load->view('admin_vi', $data);
				$this->load->view('last_vi');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('admin_id_session');
		$this->session->unset_userdata('charger_type');
		$this->session->sess_destroy();
		redirect(base_url('admin_con'));
	}

	//==================================
	//IPアドレス確認
	//==================================
	private function authIpAddress()
	{
		// $admin_ip = $this->input->ip_address();
		// $result = $this->admin_admin_ip_mo->getAdmin(['ip_address' => $admin_ip]);
		// if (empty($result)) {
		// 	redirect(base_url("accessError"));
		// }
	}
}
