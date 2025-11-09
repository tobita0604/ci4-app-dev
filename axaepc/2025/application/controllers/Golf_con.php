<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Golf_con extends CI_Controller {
	private $current_date;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url' );	
		$this->load->helper('session_helper');
		$this->load->helper('common_helper');
		$this->load->library('session');
		$this->load->library('convert_format');
		$this->load->library('email');
		$this->load->model('reserve_mo');
		$this->load->model('option_mo');
		$this->current_date = date('Y-m-d H:i:s');
		$this->golf_limit = date('Y-m-d H:i:s', strtotime($this->config->item('golf_limit')));
	}
	
	public function index() {
			
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			
			$common = $this->session->userdata('common');
			$members = $this->option_mo->get_members_info($R01_Id);

			$data['common'] = $common;
			$data['members'] = $members;
			$data['golf_limit'] = $this->golf_limit;
			$data['current_date'] = $this->current_date;

			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('golf_confirm_vi',$data);
			$this->load->view('golf_script_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}
		
	}

	public function edit() {
		if(check_login_user_session()){

			$R01_Id = $this->session->userdata('user_data');
			
			$common = $this->session->userdata('common');
			$members = $this->option_mo->get_members_info($R01_Id);
			
			$data['common'] = $common;
			$data['members'] = $members;
			
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('golf_vi',$data);
			$this->load->view('golf_script_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}

	}

	public function save() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			// $members = $this->option_mo->get_members_info($R01_Id);
			$option_members = $this->option_mo->get_menber_options($R01_Id);
			
			$options = $this->input->post('option');
			$update_flg = false;
			
			foreach($options as $indx => $o){
				// ゴルフフラグを設定
				if($o['R02_Golf_Club'] <> 0 || $o['R02_Golf_Biko'] <> ""){
					$options[$indx]['R02_Golf_Flg'] = 1;
				}
			}

			// 既にデータが存在する場合updateを行う
			if(!empty($option_members)){
				$update_flg = true;
			}

			if($update_flg){
				foreach($options as $idx=>$option) {
					//$this->option_mo->update(['R02_Golf_Flg' => $option['R02_Golf_Flg'], 'R02_Golf_Club' => $option['R02_Golf_Club'], 'R02_Golf_Shoes' => $option['R02_Golf_Shoes'], 'R02_Golf_Biko' => $option['R02_Golf_Biko']],['R02_Id' => $R01_Id, 'R02_seq' => $idx]);
					$this->option_mo->update(['R02_Golf_Flg' => $option['R02_Golf_Flg'], 'R02_Golf_Club' => $option['R02_Golf_Club'], 'R02_Golf_Biko' => $option['R02_Golf_Biko']],['R02_Id' => $R01_Id, 'R02_seq' => $idx]);
				}
			} else {
				foreach($options as $idx=>$option) {
					$option['R02_Id'] = $R01_Id;
					$option['R02_seq'] = $idx;
					$this->option_mo->add_option($option);
				}	
			}

			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('golf_complete_vi');
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}
	}

}