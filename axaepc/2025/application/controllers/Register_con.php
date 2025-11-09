<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_con extends CI_Controller
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
		$this->load->library('email_lib');
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


			//入力締め切り制御
			$today = date('Y-m-d H:i:s');
			$this->entry_limit = $this->config->item('entry_limit');
			if (($today < $this->entry_limit) || ($data['common']['R01_reentry'] == 1)) {
				$this->load->view('head_vi');
				$this->load->view('header_vi', $data);
				$this->load->view('session_timeout_vi');
				$this->load->view('registno_vi', $data);
				$this->load->view('regist_script_vi', $data);
				$this->load->view('aside_mypage_vi');
				$this->load->view('footer_vi');
				$this->load->view('last_vi');
			} else {
				$this->load->view('head_vi');
				$this->load->view('header_vi', $data);
				$this->load->view('session_timeout_vi');
				$this->load->view('registstop_vi', $data);
				$this->load->view('aside_mypage_vi');
				$this->load->view('footer_vi');
				$this->load->view('last_vi');
			}
		} else {
			redirect(base_url("login_con"));
		}
	}

	public function admin_view()
	{
		$R01_Id = $this->input->post('R01_Id');
		$this->session->set_userdata('accpswd', 'axa2025');
		$this->session->set_userdata('user_data', $R01_Id);
		redirect(base_url("register_con"));
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
			$entry_common = $entry_common + $common;
			$this->session->set_userdata('common', $entry_common);
			redirect(base_url("register_con/regist_reserver"));
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
			if ($data['common']['R01_reentry'] == 1) {
				$this->load->view('registreserver_vi', $data);
			} else {
				$this->load->view('registreserver_confirm_vi', $data);
			}
			$this->load->view('regist_script_vi', $data);
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
			//var_dump($reserve);

			$entry_common = $this->input->post('common');
			if (!empty($common)) {
				$entry_common = $entry_common + $common;
			}
			$this->session->set_userdata('common', $entry_common);

			$entry_reserve = $this->input->post('reserve');
			$entry_reserve = $this->edit_entry_info($entry_reserve, $R01_Id);
			//echo is_array($entry_reserve);
			if (!empty($reserve)) {
				$entry_reserve = $entry_reserve + $reserve;
			}

			$invites_no = $common['R01_Free_Invites'] + $common['R01_Charge_Invites'];
			if ($invites_no >= 1) {
				redirect(base_url("register_con/regist_member"));
				// redirect(base_url("register_con/confirm"));
			} else {
				redirect(base_url("register_con/confirm"));
			}
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// メモ情報保存
	//==============================================
	public function save_note()
	{
		if (check_login_user_session()) {
			$data['R01_Id'] = $this->input->post('kid');
			$data['R01_note'] = $this->input->post('R01_note');
			$result = $this->reserve_mo->save_note($data);
			$this->session->set_userdata('sysmsg', 'メモを登録しました。');
			redirect(base_url("mypage_admin_con/note_view"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	//==============================================
	// 自費参加人数保存
	//==============================================
	public function save_chaegepax()
	{
		if (check_login_user_session()) {
			$data['R01_Id'] = $this->input->post('kid');
			$data['R01_Charge_Invites'] = $this->input->post('Charge_Invites');
			$result = $this->reserve_mo->save_chargepax($data);
			$this->session->set_userdata('sysmsg', '自費参加人数を更新しました。');
			redirect(base_url("mypage_admin_con/chargepax_view"));
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
			redirect(base_url("register_con"));
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
			if ($data['common']['R01_reentry'] == 1) {
				$this->load->view('registmember_vi', $data);
			} else {
				$this->load->view('registmember_confirm_vi', $data);
			}
			$this->load->view('regist_script_vi', $data);
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
				redirect(base_url("register_con/regist_member"));
			} else {
				redirect(base_url("register_con/confirm"));
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

			// POSTから受け取った値
			$posted_idx = $this->input->post("idx");

			// IDXが数値であることを確認
			if (!is_numeric($posted_idx)) {
				log_message('error', '不正なIDX値: ' . $posted_idx . ' ユーザー: ' . $R01_Id);
				$this->session->set_flashdata('error', '不正な操作が検出されました');
				redirect(base_url("register_con"));
				return;
			}

			// 整数値に変換
			$idx = intval($posted_idx);

			// 許可された範囲内かチェック
			// ここでは、R01_Free_Invites + R01_Charge_Invites - 1までを許可(本人は idx = 0 の為 -1 する)
			$max_allowed = ($common['R01_Free_Invites'] + $common['R01_Charge_Invites'] - 1);
			if ($idx < 0 || $idx > $max_allowed) {
				log_message('error', 'IDX値が範囲外: ' . $idx . ' (最大: ' . $max_allowed . ') ユーザー: ' . $R01_Id);
				$this->session->set_flashdata('error', '不正な操作が検出されました');
				redirect(base_url("register_con"));
				return;
			}

			$invite = $this->input->post("invite");
			$invite = $this->edit_member_info($invite, $reserve, $R01_Id);

			$this->db->trans_start();
			$this->backup();
			$common['R01_Update_Date'] = $this->current_date;
			$common['R01_Update_User'] = $R01_Id;

			$this->reserve_mo->update_reserver($common);

			$invite['R01_Id'] = $R01_Id;
			$invite['R01_seq'] = ++$idx;
			$invite['R01_Name'] = $invite['R01_Name_Last'] . ' ' . $invite['R01_Name_First'];
			if ($this->reserve_mo->get_members_info($invite['R01_Id'], $invite['R01_seq'])) {
				$this->reserve_mo->update_member($invite);
			} else {
				$this->reserve_mo->add_member($invite);
			}

			$this->db->trans_complete();
			redirect(base_url("register_con"));
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
				redirect(base_url("register_con"));
			} else {
				if ($idx == '') {
					$idx = $invites_no - 1;
				}
				$this->session->set_flashdata("idx", --$idx);
				redirect(base_url("register_con/regist_member"));
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

			// 登録データをセッションに格納（セキュリティ対応）
			$this->session->set_userdata('reg_common', $data['common']);
			$this->session->set_userdata('reg_reserve', $data['reserve']);

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
			$common = $this->session->userdata('reg_common');
			$reserve = $this->session->userdata('reg_reserve');

			//$common = $this->input->post('common');
			//$reserve = $this->input->post('reserve');
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
				if (!empty($invites)) {
					foreach ($invites as $idx => $invite) {
						if ($invites_no == $idx++) {
							break;
						}
						$invite['R01_Id'] = $R01_Id;
						$invite['R01_seq'] = $seq++;
						$invite['R01_Name'] = $invite['R01_Name_Last'] . ' ' . $invite['R01_Name_First'];
						$this->reserve_mo->add_member($invite);
					}
				}
			}

			$this->session->unset_tempdata('reg_common');
			$this->session->unset_tempdata('reg_reserve');

			$this->db->trans_complete();

			//メール送信
			$data['reporter_mail'] = $reserve['R01_Email'];
			$data['reporter_name'] = $reserve['R01_Name'];
			$this->email_lib->reservationCompleteMail($data);

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
			redirect(base_url("register_con"));
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
		if (!empty($invites)) {
			foreach ($invites as $invite) {
				$invite['R01_Backup_Id'] = $R01_Backup_Id;
				$invite['R01_Name'] = $invite['R01_Name_Last'] . ' ' . $invite['R01_Name_First'];
				$this->reserve_mo->backup_member($invite);
			}
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
			$edited['R01_Address2'] = $reserve['R01_Address2'];
			$edited['R01_Address3'] = $reserve['R01_Address3'];
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

		if (!empty($reserve['Birth_Year']) && !empty($reserve['Birth_Month']) && !empty($reserve['Birth_Day'])) {
			$reserve['R01_Birthdate'] = $reserve['Birth_Year'] . '-' . $reserve['Birth_Month'] . '-' . $reserve['Birth_Day'];
		} else {
			$reserve['R01_Birthdate'] = '';
		}

		if (!empty($reserve['Issue_Year']) && !empty($reserve['Issue_Month']) && !empty($reserve['Issue_Day'])) {
			$reserve['R01_Passport_Issue_Date'] = $reserve['Issue_Year'] . '-' . $reserve['Issue_Month'] . '-' . $reserve['Issue_Day'];
		} else {
			$reserve['R01_Passport_Issue_Date'] = '';
		}

		if (!empty($reserve['Valid_Year']) && !empty($reserve['Valid_Month']) && !empty($reserve['Valid_Day'])) {
			$reserve['R01_Passport_Valid_Date'] = $reserve['Valid_Year'] . '-' . $reserve['Valid_Month'] . '-' . $reserve['Valid_Day'];
		} else {
			$reserve['R01_Passport_Valid_Date'] = '';
		}

		if (!empty($reserve['Passport_Year']) && !empty($reserve['Passport_Month']) && !empty($reserve['Passport_Day'])) {
			$reserve['R01_Passport_Date'] = $reserve['Passport_Year'] . '-' . $reserve['Passport_Month'] . '-' . $reserve['Passport_Day'];
		} else {
			$reserve['R01_Passport_Date'] = '';
		}

		if (!empty($reserve['Mobile1']) && !empty($reserve['Mobile2']) && !empty($reserve['Mobile3'])) {
			$reserve['R01_Mobile_No'] = $reserve['Mobile1'] . '-' . $reserve['Mobile2'] . '-' . $reserve['Mobile3'];
		} else {
			$reserve['R01_Mobile_No'] = '';
		}

		if (!empty($reserve['Tel1']) && !empty($reserve['Tel2']) && !empty($reserve['Tel3'])) {
			$reserve['R01_Tel_No'] = $reserve['Tel1'] . '-' . $reserve['Tel2'] . '-' . $reserve['Tel3'];
		} else {
			$reserve['R01_Tel_No'] = '';
		}

		if (!empty($reserve['Emer1']) && !empty($reserve['Emer2']) && !empty($reserve['Emer3'])) {
			$reserve['R01_Emer_Tel_No'] = $reserve['Emer1'] . '-' . $reserve['Emer2'] . '-' . $reserve['Emer3'];
		} else {
			$reserve['R01_Emer_Tel_No'] = '';
		}

		if (!empty($reserve['R01_Nationality'])) {
			if ($reserve['R01_Nationality'] == '0') {
				$reserve['R01_Nationality'] = $reserve['R01_Nationality_other'];
			}
		} else {
			$reserve['R01_Nationality'] = '';
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
