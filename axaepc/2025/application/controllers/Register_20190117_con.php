<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Register_con extends CI_Controller {
	
	public function Register_con() {
		
		parent::__construct ();
		$this->load->helper('url' );	
		$this->load->helper('session_helper');
		$this->load->helper('common_helper');
		$this->load->library('session');
		$this->load->library('convert_format');
		$this->load->library('email');
		$this->load->model('entry_mo');
		$this->load->model('register_mo');
		
	}
	
	public function index() {
			
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			
			$reserve = $this->input->post('reserve');
			$invites = $this->input->post('invites');
			
			if(empty($reserve)) {
				$reserve = $this->register_mo->get_reserver_info($R01_Id);
			}
			if(empty($invites)) {
				$invites = $this->register_mo->get_members_info($R01_Id);
			}
			$data['reserve'] = $reserve;
			$data['invites'] = $invites;
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('regist_vi',$data);
			$this->load->view('regist_script_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}		
		
	}
	
	public function index2() {
			
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			
			$reserve = $this->register_mo->get_reserver_info($R01_Id);
			$invites = $this->register_mo->get_members_info($R01_Id);

			$this->session->set_userdata('reserve', $reserve);
			$this->session->set_userdata('invites', $invites);
			
			$data['reserve'] = $reserve;
			$data['invites'] = $invites;
			
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('registno_vi',$data);
			$this->load->view('regist2_script_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}		
		
	}
	
	public function save_entry_no() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$reserve = $this->session->userdata('reserve');
			$entry_reserve = $this->input->post('reserve');
			$entry_reserve = $entry_reserve + $reserve;
			$this->session->set_userdata('reserve', $entry_reserve);
			redirect(base_url("register_con/regist_reserver"));
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	public function regist_reserver() {
			
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$reserve = $this->session->userdata('reserve');
			
			$data['reserve'] = $reserve;
			
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('registreserver_vi',$data);
			$this->load->view('regist2_script_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}		
		
	}
	
	public function save_reserver() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$reserve = $this->session->userdata('reserve');
			$entry_reserve = $this->input->post('reserve');
			$entry_reserve = $this->edit_reserve_info($entry_reserve, $R01_Id);
			$entry_reserve = $entry_reserve + $reserve;
			$this->session->set_userdata('reserve', $entry_reserve);
			
			$invites_no = $reserve['R01_Free_Invites'] + $reserve['R01_Charge_Invites'];
			if($invites_no == 1) {
				redirect(base_url("register_con/confirm2"));
			} else {
				redirect(base_url("register_con/regist_member"));
			}
			
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	public function regist_member() {
			
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$invites = $this->session->userdata('invites');
			
			$idx = $this->session->flashdata("idx");
			
			if(empty($idx)) {
				$idx = $this->input->post("idx");
			}
			
			if(empty($idx)) {
				$idx = 0;
			}
			
			$data['invites'] = $invites;
			$data['idx'] = $idx;
			
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('registmember_vi',$data);
			$this->load->view('regist2_script_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}
		
	}
	
	public function go_back_entry() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$reserve = $this->session->userdata('reserve');
			$invites = $this->session->userdata('invites');
			
			$invites_no = $reserve['R01_Free_Invites'] + $reserve['R01_Charge_Invites'];
			$idx = $this->input->post('idx');
			if($invites_no == 1 || $idx == '0'){
				redirect(base_url("register_con/regist_reserver"));
			} else {
				if($idx == '') {
					$idx = $invites_no - 1;
				}
				$this->session->set_flashdata("idx", --$idx);
				redirect(base_url("register_con/regist_member"));
			}
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	public function save_member() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$reserve = $this->session->userdata('reserve');
			$invites = $this->session->userdata('invites');
			
			$idx = $this->input->post("idx");
			$invite = $this->input->post("invite");
			
			$invite = $this->edit_member_info($invite, $reserve, $R01_Id);
			
			$invites[$idx++] = $invite;
			$this->session->set_userdata('invites', $invites);
			
			
			$invites_no = $reserve['R01_Free_Invites'] + $reserve['R01_Charge_Invites'] - 1;
			if($invites_no > $idx){
				$this->session->set_flashdata("idx", $idx);
				redirect(base_url("register_con/regist_member"));
			} else {
				redirect(base_url("register_con/confirm2"));
			}
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	function confirm2() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			
			$reserve = $this->session->userdata('reserve');
			
			$data['reserve'] = $reserve;
			
			$invites_no = $reserve['R01_Free_Invites'] + $reserve['R01_Charge_Invites'];
			if($invites_no > 1) {
				$invites = $this->session->userdata('invites');
				$data['invites'] = $invites;
			}
			
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('confirm2_vi',$data);
			$this->load->view('confirm2_script_vi');
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	function confirm() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			
			$reserve = $this->input->post('reserve');
			$reserve = $this->edit_reserve_info($reserve, $R01_Id);
			
			$invites = $this->input->post('invites');
			$invites = $this->edit_members_info($invites, $reserve, $R01_Id);
			
			
			$data['reserve'] = $reserve;
			$data['invites'] = $invites;
			
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('confirm_vi',$data);
			$this->load->view('confirm_script_vi');
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	function end() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			
			$reserve = $this->input->post('reserve');
			$this->register_mo->update_reserver($reserve);
			
			$invites = $this->input->post('invites');
			$invites_no = $reserve['R01_Free_Invites'] + $reserve['R01_Charge_Invites'];
			$this->register_mo->delete_members($R01_Id);
			$idx = 1;
			foreach($invites as $invite) {
				$invite['R01_seq'] = $idx;
				if($invites_no == $idx++) {
					break;
				}
				$this->register_mo->add_member($invite);
			}
			
			$data = $this->register_mo->get_reserver_info($R01_Id);
			$this->load->view('head_vi');
			$this->load->view('header_vi',$data);
			$this->load->view('end_vi',$data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			$this->load->view('last_vi');
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	function cancel_member() {
		if(check_login_user_session()){
			$R01_Id = $this->session->userdata('user_data');
			$R01_seq = $this->input->post('R01_seq');
			
			$reserve = $this->register_mo->get_reserver_info($R01_Id);
			
			if($R01_seq >= $reserve['R01_Free_Invites']) {
				$invites = $this->register_mo->get_members_info($R01_Id, $R01_seq);
				$this->register_mo->delete_members($R01_Id);
				$idx = 1;
				foreach($invites as $invite) {
					$invite['R01_seq'] = $idx++;
					$this->register_mo->add_member($invite);
				}
			} else {
				$this->register_mo->delete_members($R01_Id, $R01_seq);
			}
			redirect(base_url("register_con"));
		}else{
			redirect(base_url("login_con"));
		}
	}
	
	private function edit_member_info($invite, $reserve, $id) {
		$edited = $this->edit_reserve_info($invite, $id);
		if(!empty($edited['copy'])) {
			$edited['R01_Postal1'] = $reserve['R01_Postal1'];
			$edited['R01_Postal2'] = $reserve['R01_Postal2'];
			$edited['R01_Prefecture'] = $reserve['R01_Prefecture'];
			$edited['R01_Address'] = $reserve['R01_Address'];
			$edited['R01_Tel_No'] = $reserve['R01_Tel_No'];
			$edited['R01_Emer_Name'] = $reserve['R01_Emer_Name'];
			$edited['R01_Emer_Relationship'] = $reserve['R01_Emer_Relationship'];
			$edited['R01_Emer_Tel_No'] = $reserve['R01_Emer_Tel_No'];
			unset($edited['copy']);
		}
		return $edited;
	}
	
	private function edit_members_info($invites, $reserve, $id) {
		$edited_invites = array();
		foreach($invites as $idx => $invite) {
			$edited = $this->edit_reserve_info($invite, $id);
			$edited['R01_seq'] = $idx;
			if(!empty($edited['copy'])) {
				$edited['R01_Postal1'] = $reserve['R01_Postal1'];
				$edited['R01_Postal2'] = $reserve['R01_Postal2'];
				$edited['R01_Prefecture'] = $reserve['R01_Prefecture'];
				$edited['R01_Address'] = $reserve['R01_Address'];
				$edited['R01_Tel_No'] = $reserve['R01_Tel_No'];
				$edited['R01_Emer_Name'] = $reserve['R01_Emer_Name'];
				$edited['R01_Emer_Relationship'] = $reserve['R01_Emer_Relationship'];
				$edited['R01_Emer_Tel_No'] = $reserve['R01_Emer_Tel_No'];
				unset($edited['copy']);
			}
			$edited_invites[] = $edited;
		}
		return $edited_invites;
	}
	
	private function edit_reserve_info($reserve, $id) {
		$reserve['R01_Id'] = $id;
		$reserve['R01_Birthdate'] = $reserve['Birth_Year'].'-'.$reserve['Birth_Month'].'-'.$reserve['Birth_Day'];
		$reserve['R01_Passport_Date'] = $reserve['Passport_Year'].'-'.$reserve['Passport_Month'].'-'.$reserve['Passport_Day'];
		if ($reserve['R01_Nationality']=='0') {
			$reserve['R01_Nationality']=$reserve['R01_Nationality_other'];
		}
		
		unset($reserve['R01_Nationality_other']);
		unset($reserve['Birth_Year']);
		unset($reserve['Birth_Month']);
		unset($reserve['Birth_Day']);
		unset($reserve['Passport_Year']);
		unset($reserve['Passport_Month']);
		unset($reserve['Passport_Day']);
		unset($reserve['R01_Email_cfm']);
		
		return $reserve;
	}

}