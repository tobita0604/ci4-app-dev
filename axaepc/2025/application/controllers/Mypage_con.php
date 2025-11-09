<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mypage_con extends CI_Controller
{
	private $current_date;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('session_helper');
		$this->load->helper('common_helper');
		$this->load->library('session');
		$this->load->library('convert_format');
		$this->load->library('email');
		$this->load->model('reserve_mo');
		$this->load->database();
		$this->current_date = date('Y-m-d H:i:s');
	}

	public function index()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');

			$common = $this->reserve_mo->get_common_info($R01_Id);
			$reserve = $this->reserve_mo->get_reserver_info($R01_Id);
			$invites = $this->reserve_mo->get_all_members_info($R01_Id);

			$this->session->set_userdata('common', $common);
			$this->session->set_userdata('reserve', $reserve);
			$this->session->set_userdata('invites', $invites);

			$data['common'] = $common;
			$data['reserve'] = $reserve;
			$data['invites'] = $invites;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('session_timeout_vi');
			$this->load->view('registno_vi', $data);
			$this->load->view('regist_script2_vi', $data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	public function admin_view()
	{
		$R01_Id = $this->input->post('R01_Id');
		$this->session->set_userdata('accpswd', 'axa2025');
		$this->session->set_userdata('user_data', $R01_Id);
		redirect(base_url("mypage_con"));
	}

	//==============================================
	// 共通情報保存
	//==============================================
	public function save_entry_no()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$entry_common = $this->input->post('common');
			var_dump($entry_common);
			$entry_common = $entry_common + $common;
			var_dump($common);
			var_dump($entry_common);
			$this->session->set_userdata('common', $entry_common);
			redirect(base_url("mypage_con/regist_reserver"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 本人情報登録画面表示
	//==============================================
	public function regist_reserver()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');

			$data['back_to_top'] = $this->input->post('back_to_top');

			$data['common'] = $common;
			$data['reserve'] = $reserve;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('session_timeout_vi');
			//入力締め切り制御
			$today = date('Y-m-d H:i:s');
			$this->entry_limit = $this->config->item('entry_limit');
			if (($today < $this->entry_limit) || ($data['common']['R01_reentry'] == 1)) {
				$this->load->view('registreserver2_vi', $data);
			} else {
				$this->load->view('registreserver_vi', $data);
			}
			$this->load->view('regist_script2_vi', $data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 本人情報保存
	//==============================================
	public function save_reserver()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');

			$entry_common = $this->input->post('common');
			$entry_common = $entry_common + $common;
			$this->session->set_userdata('common', $entry_common);

			$entry_reserve = $this->input->post('reserve');
			$entry_reserve = $this->edit_entry_info($entry_reserve, $R01_Id);
			$entry_reserve = $entry_reserve + $reserve;
			$this->session->set_userdata('reserve', $entry_reserve);

			$invites_no = $common['R01_Free_Invites'] + $common['R01_Charge_Invites'];
			if ($invites_no == 1) {
				redirect(base_url("mypage_con/confirm"));
			} else {
				redirect(base_url("mypage_con/confirm"));
			}
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 本人情報更新
	//==============================================
	public function update_reserver()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');

			$entry_common = $this->input->post('common');
			$common = $entry_common + $common;

			$entry_reserve = $this->input->post('reserve');
			$entry_reserve = $this->edit_entry_info($entry_reserve, $R01_Id);
			$reserve = $entry_reserve + $reserve;

			$this->db->trans_start();
			$this->backup();

			$reserve['R01_seq'] = '0';
			$this->reserve_mo->update_member($reserve);

			$common['R01_Update_Date'] = $this->current_date;
			$common['R01_Update_User'] = $R01_Id;
			$this->reserve_mo->update_reserver($common);

			$this->db->trans_complete();
			redirect(base_url("mypage_con"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 同伴者情報登録画面表示
	//==============================================
	public function regist_member()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');
			$invites = $this->session->userdata('invites');

			$data['back_to_top'] = $this->input->post('back_to_top');

			$idx = $this->session->flashdata("idx");

			if (empty($idx)) {
				$idx = $this->input->post("idx");
			}

			if (empty($idx)) {
				$idx = 0;
			}

			$data['common'] = $common;
			$data['reserve'] = $reserve;
			$data['invites'] = $invites;
			$data['idx'] = $idx;
			if ($common['R01_Free_Invites'] <= ++$idx) {
				$data['gai'] = 'gai';
			} else {
				$data['gai'] = '';
			}

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('session_timeout_vi');
			$this->load->view('registmember2_vi', $data);
			$this->load->view('regist_script2_vi', $data);
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 同伴者情報保存
	//==============================================
	public function save_member()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');
			$invites = $this->session->userdata('invites');

			$idx = $this->input->post("idx");
			$invite = $this->input->post("invite");

			$invite = $this->edit_member_info($invite, $reserve, $R01_Id);

			$invites[$idx++] = $invite;
			$this->session->set_userdata('invites', $invites);


			$invites_no = $common['R01_Free_Invites'] + $common['R01_Charge_Invites'] - 1;
			if ($invites_no > $idx) {
				$this->session->set_flashdata("idx", $idx);
				redirect(base_url("mypage_con/regist_member"));
			} else {
				redirect(base_url("mypage_con/confirm"));
			}
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 同伴者情報更新
	//==============================================
	public function update_member()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');

			$idx = $this->input->post("idx");
			$invite = $this->input->post("invite");

			$invite = $this->edit_member_info($invite, $reserve, $R01_Id);


			$this->db->trans_start();
			$this->backup();
			$common['R01_Update_Date'] = $this->current_date;
			$common['R01_Update_User'] = $R01_Id;

			$this->reserve_mo->update_reserver($common);

			$invite['R01_Id'] = $R01_Id;
			$invite['R01_seq'] = ++$idx;
			if ($this->reserve_mo->get_members_info($invite['R01_Id'], $invite['R01_seq'])) {
				$this->reserve_mo->update_member($invite);
			} else {
				$this->reserve_mo->add_member($invite);
			}

			$this->db->trans_complete();
			redirect(base_url("mypage_con"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 戻るボタン処理
	//==============================================
	public function go_back_entry()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');
			$invites = $this->session->userdata('invites');

			$invites_no = $common['R01_Free_Invites'] + $common['R01_Charge_Invites'];
			$idx = $this->input->post('idx');

			if ($invites_no == 1 || $idx == '0') {
				redirect(base_url("mypage_con"));
			} else {
				if ($idx == '') {
					$idx = $invites_no - 1;
				}
				$this->session->set_flashdata("idx", --$idx);
				redirect(base_url("mypage_con/regist_member"));
			}
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 確認画面表示
	//==============================================
	public function confirm()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');

			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');

			$data['common'] = $common;
			$data['reserve'] = $reserve;

			$invites_no = $common['R01_Free_Invites'] + $common['R01_Charge_Invites'];
			if ($invites_no > 1) {
				$invites = $this->session->userdata('invites');
				$data['invites'] = $invites;
			}

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('session_timeout_vi');
			$this->load->view('confirm_vi', $data);
			$this->load->view('confirm_script_vi');
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// DB更新
	//==============================================
	public function end()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');

			$common = $this->input->post('common');
			$reserve = $this->input->post('reserve');
			$invites = $this->input->post('invites');

			$this->db->trans_start();
			$this->backup();

			$common['R01_Update_Date'] = $this->current_date;
			$common['R01_Update_User'] = $R01_Id;
			$this->reserve_mo->update_reserver($common);

			$this->reserve_mo->delete_members($R01_Id);

			$reserve['R01_seq'] = '0';
			$this->reserve_mo->add_member($reserve);

			$invites_no = $common['R01_Free_Invites'] + $common['R01_Charge_Invites'] - 1;
			if ($invites_no == '1' || !empty($invites)) {
				$seq = 1;
				foreach ($invites as $idx => $invite) {
					if ($invites_no == $idx++) {
						break;
					}
					$invite['R01_Id'] = $R01_Id;
					$invite['R01_seq'] = $seq++;
					$this->reserve_mo->add_member($invite);
				}
			}


			$this->db->trans_complete();
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('session_timeout_vi');
			$this->load->view('end_vi');
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 同伴者キャンセル処理
	//==============================================
	public function cancel_member()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->session->userdata('common');
			$reserve = $this->session->userdata('reserve');

			$idx = $this->input->post("idx");

			$this->db->trans_start();
			$this->backup();
			$common['R01_Update_Date'] = $this->current_date;
			$common['R01_Update_User'] = $R01_Id;

			$this->reserve_mo->update_reserver($common);

			$invite['R01_Id'] = $R01_Id;
			$invite['R01_seq'] = ++$idx;
			$invite['R01_Cancel_Flg'] = '1';
			if ($this->reserve_mo->get_members_info($invite['R01_Id'], $invite['R01_seq'])) {
				$this->reserve_mo->update_member($invite);
			} else {
				$this->reserve_mo->add_member($invite);
			}

			$this->db->trans_complete();
			redirect(base_url("mypage_con"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// バックアップ
	//==============================================
	private function backup()
	{
		$R01_Id = $this->session->userdata('user_data');

		$reserve = $this->reserve_mo->get_common_info($R01_Id);
		$invites = $this->reserve_mo->get_members_info($R01_Id);

		$reserve['R01_Backup_Date'] = $this->current_date;
		$reserve['R01_Backup_User'] = $R01_Id;

		$R01_Backup_Id = $this->reserve_mo->backup_reserver($reserve);
		foreach ($invites as $invite) {
			$invite['R01_Backup_Id'] = $R01_Backup_Id;
			$this->reserve_mo->backup_member($invite);
		}
	}

	//==============================================
	// 同伴者情報編集
	//==============================================
	private function edit_member_info($invite, $reserve, $id)
	{
		$edited = $this->edit_entry_info($invite, $id);
		if (!empty($edited['copy'])) {
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

	//==============================================
	// 共通情報編集
	//==============================================
	private function edit_entry_info($reserve, $id)
	{
		$reserve['R01_Id'] = $id;
		$reserve['R01_Birthdate'] = $reserve['Birth_Year'] . '-' . $reserve['Birth_Month'] . '-' . $reserve['Birth_Day'];
		$reserve['R01_Passport_Issue_Date'] = $reserve['Issue_Year'] . '-' . $reserve['Issue_Month'] . '-' . $reserve['Issue_Day'];
		$reserve['R01_Passport_Valid_Date'] = $reserve['Valid_Year'] . '-' . $reserve['Valid_Month'] . '-' . $reserve['Valid_Day'];
		$reserve['R01_Passport_Date'] = $reserve['Passport_Year'] . '-' . $reserve['Passport_Month'] . '-' . $reserve['Passport_Day'];
		$reserve['R01_Mobile_No'] = $reserve['Mobile1'] . '-' . $reserve['Mobile2'] . '-' . $reserve['Mobile3'];
		$reserve['R01_Tel_No'] = $reserve['Tel1'] . '-' . $reserve['Tel2'] . '-' . $reserve['Tel3'];
		$reserve['R01_Emer_Tel_No'] = $reserve['Emer1'] . '-' . $reserve['Emer2'] . '-' . $reserve['Emer3'];
		if ($reserve['R01_Nationality'] == '0') {
			$reserve['R01_Nationality'] = $reserve['R01_Nationality_other'];
		}

		unset($reserve['R01_Nationality_other']);
		unset($reserve['Birth_Year']);
		unset($reserve['Birth_Month']);
		unset($reserve['Birth_Day']);
		unset($reserve['Issue_Year']);
		unset($reserve['Issue_Month']);
		unset($reserve['Issue_Day']);
		unset($reserve['Valid_Year']);
		unset($reserve['Valid_Month']);
		unset($reserve['Valid_Day']);
		unset($reserve['Passport_Year']);
		unset($reserve['Passport_Month']);
		unset($reserve['Passport_Day']);
		unset($reserve['Tel1']);
		unset($reserve['Tel2']);
		unset($reserve['Tel3']);
		unset($reserve['Mobile1']);
		unset($reserve['Mobile2']);
		unset($reserve['Mobile3']);
		unset($reserve['Emer1']);
		unset($reserve['Emer2']);
		unset($reserve['Emer3']);
		unset($reserve['R01_Email_cfm']);

		return $reserve;
	}
}
