<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OptionTest_con extends CI_Controller
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
		$this->load->model('option_mo');
		$this->current_date = date('Y-m-d H:i:s');
	}

	public function index()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');

			$common = $this->session->userdata('common');
			$members = $this->option_mo->get_members_info($R01_Id);
			$schedule1 = $this->option_mo->get_schedule(1);
			$schedule2 = $this->option_mo->get_schedule(2);
			$schedule3 = $this->option_mo->get_schedule(0);
			foreach ($schedule3 as $s) {
				$schedule[$s['M01_Id']] = $s['M01_Name'];
			}

			if ($members[0]['R01_Entry_Flg'] == '0') {
				$link = base_url('register_con');
				echo "<script>alert('申込を完了してください。');location.href='$link';</script>";
			}

			// スケジュールの時間をカンマ区切りで分割
			foreach ($schedule1 as $indx1 => $s1) {
				if (!empty($s1['M01_Day1_Time'])) {
					$schedule1[$indx1]['M01_Day1_Time'] = explode(',', $s1['M01_Day1_Time']);
				}
			}

			foreach ($schedule2 as $indx2 => $s2) {
				if (!empty($s2['M01_Day2_Time'])) {
					$schedule2[$indx2]['M01_Day2_Time'] = explode(',', $s2['M01_Day2_Time']);
				}
			}

			$data['common'] = $common;
			$data['members'] = $members;
			$data['schedule1'] = $schedule1;
			$data['schedule2'] = $schedule2;
			$data['schedule'] = $schedule;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('option_test_view_vi', $data);
			$this->load->view('option_script_vi', $data);
			// $this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	// 7/6からのオプショナルツアー申込
	public function option_7()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');

			$common = $this->session->userdata('common');
			$members = $this->option_mo->get_members_info($R01_Id);
			$schedule1 = $this->option_mo->get_schedule(1);
			$schedule2 = $this->option_mo->get_schedule(2);

			if ($members[0]['R01_Entry_Flg'] == '0') {
				$link = base_url('register_con');
				echo "<script>alert('申込を完了してください。');location.href='$link';</script>";
			}

			// スケジュールの時間をカンマ区切りで分割
			foreach ($schedule1 as $indx1 => $s1) {
				if (!empty($s1['M01_Day1_Time'])) {
					$schedule1[$indx1]['M01_Day1_Time'] = explode(',', $s1['M01_Day1_Time']);
				}
			}

			foreach ($schedule2 as $indx2 => $s2) {
				if (!empty($s2['M01_Day2_Time'])) {
					$schedule2[$indx2]['M01_Day2_Time'] = explode(',', $s2['M01_Day2_Time']);
				}
			}

			$data['common'] = $common;
			$data['members'] = $members;
			$data['schedule1'] = $schedule1;
			$data['schedule2'] = $schedule2;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('option_vi', $data);
			$this->load->view('option_script_vi', $data);
			// $this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	public function option_4q()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');

			$common = $this->session->userdata('common');
			$members = $this->option_mo->get_members_info($R01_Id);
			$schedule1 = $this->option_mo->get_schedule(1);
			$schedule2 = $this->option_mo->get_schedule(2);

			if ($members[0]['R01_Entry_Flg'] == '0') {
				$link = base_url('register_con');
				echo "<script>alert('申込を完了してください。');location.href='$link';</script>";
			}

			// スケジュールの時間をカンマ区切りで分割
			foreach ($schedule1 as $indx1 => $s1) {
				if (!empty($s1['M01_Day1_Time'])) {
					$schedule1[$indx1]['M01_Day1_Time'] = explode(',', $s1['M01_Day1_Time']);
				}
			}

			foreach ($schedule2 as $indx2 => $s2) {
				if (!empty($s2['M01_Day2_Time'])) {
					$schedule2[$indx2]['M01_Day2_Time'] = explode(',', $s2['M01_Day2_Time']);
				}
			}

			$data['common'] = $common;
			$data['members'] = $members;
			$data['schedule1'] = $schedule1;
			$data['schedule2'] = $schedule2;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('option_invitation_vi', $data);
			$this->load->view('option_script_vi', $data);
			// $this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	// public function confirm() {

	// 	if(check_login_user_session()){
	// 		$R01_Id = $this->session->userdata('user_data');
	// 		$members = $this->option_mo->get_members_info($R01_Id);
	// 		$options = $this->option_mo->get_options();
	// 		foreach($options as $option) {
	// 			$prices[$option['M01_Id']] =  $option;
	// 		}
	// 		$options = $this->input->post('option');

	// 		$data['members'] = $members;
	// 		$data['options'] = $options;
	// 		$data['schedule1'] = $options['R02_Option1_Time'];
	// 		$data['schedule2'] = $options['R02_Option2_Time'];

	// 		$this->load->view('head_vi');
	// 		$this->load->view('header_vi',$data);
	// 		$this->load->view('option_confirm_vi',$data);
	// 		$this->load->view('option_script_vi',$data);
	// 		$this->load->view('aside_mypage_vi');
	// 		$this->load->view('footer_vi');

	// 		$this->load->view('last_vi');
	// 	}else{
	// 		redirect(base_url("login_con"));
	// 	}

	// }

	public function save_option()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$members = $this->option_mo->get_members_info($R01_Id);
			$options = $this->option_mo->get_options();
			foreach ($options as $option) {
				$prices[$option['M01_Id']] =  $option;
			}
			$options = $this->input->post('option');

			foreach ($options as $indx => $o) {
				$time_srt1 = null;
				$time_srt2 = null;
				foreach ($o['R02_Option1_Time'] as $time1) {
					if (!empty($time1)) {
						$time_srt1 = $time1;
					}
				}
				foreach ($o['R02_Option2_Time'] as $time2) {
					if (!empty($time2)) {
						$time_srt2 = $time2;
					}
				}

				$options[$indx]['R02_Option1_Time'] = $time_srt1;
				$options[$indx]['R02_Option2_Time'] = $time_srt2;
			}

			$this->backup();


			// 既にデータが存在する場合updateを行う
			if (!empty($members)) {
				$update_flg = true;
			}

			if ($update_flg) {
				foreach ($options as $idx => $option) {
					$this->option_mo->update($option, ['R02_Id' => $R01_Id, 'R02_seq' => $idx]);
				}
			} else {
				foreach ($options as $idx => $option) {
					$option['R02_Id'] = $R01_Id;
					$option['R02_seq'] = $idx;
					$this->option_mo->add_option($option);
				}
			}

			$this->session->set_tempdata('success_flash', '更新完了しました。', 1);
			redirect(base_url("option_con/complete"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	// 自費参加
	public function save_jihi()
	{
		if (check_login_user_session()) {
			$update_flg = false;
			$R01_Id = $this->session->userdata('user_data');
			$options = $this->option_mo->get_options_info($R01_Id);
			$members = $this->option_mo->get_members_info($R01_Id);

			// 既にデータが存在する場合updateを行う
			if (!empty($options)) {
				$update_flg = true;
			}

			if ($update_flg) {
				foreach ($options as $idx => $option) {
					$option['R02_Option1'] = 0;
					$option['R02_Option2'] = 0;
					$option['R02_Option1_Time'] = null;
					$option['R02_Option2_Time'] = null;
					$option['R02_Option_Type'] = 2; // 自費参加
					$this->option_mo->update($option, ['R02_Id' => $R01_Id, 'R02_seq' => $option['R02_seq']]);
				}
			} else {
				foreach ($members as $idx => $member) {
					$_menber['R02_Id'] = $R01_Id;
					$_menber['R02_seq'] = $member['R01_seq'];
					$_menber['R02_Option_Type'] = 2; // 自費参加
					$this->option_mo->add_option($_menber);
				}
			}

			$this->session->set_tempdata('success_flash', '更新完了しました。', 1);
			redirect(base_url("option_con/complete"));
		} else {
			redirect(base_url("login_con"));
		}
	}

	// 自費参加
	public function complete()
	{
		if (check_login_user_session()) {
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('option_complete_vi');
			$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
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
		$options = $this->option_mo->get_options_info($R01_Id);

		$reserve['R01_Backup_Date'] = $this->current_date;
		$reserve['R01_Backup_User'] = $R01_Id;

		$R01_Backup_Id = $this->reserve_mo->backup_reserver($reserve);
		foreach ($options as $option) {
			$option['R02_Backup_Id'] = $R01_Backup_Id;
			$this->option_mo->backup_option($option);
		}
	}

	private function calculate_price($common, $member, $option, $prices)
	{
		$price = 0;
		$age = calculate_age($member['R01_Birthdate']);
		$is_twelve = $age > -1 && $age < 12;
		if (!empty($option['R02_Park_Flg']) && empty($option['R01_Park_Flg'])) {
			if ($is_twelve) {
				$price += $prices['02']['M01_Price2'];
			} else {
				$price += $prices['02']['M01_Price1'];
			}
		}
		if (!empty($option['R02_Farm_Flg']) && !empty($option['R02_Farm_Tour'])) {
			if ($is_twelve) {
				$price += $prices[$option['R02_Farm_Tour']]['M01_Price2'];
			} else {
				$price += $prices[$option['R02_Farm_Tour']]['M01_Price1'];
			}
		}
		if (!empty($option['R02_Golf_Flg'])) {
			if ($is_twelve) {
				$price += $prices['01']['M01_Price2'];
			} else {
				$price += $prices['01']['M01_Price1'];
			}
		}
		if (!empty($option['R02_Option1'])) {
			if ($is_twelve) {
				$price += $prices[$option['R02_Option1']]['M01_Price2'];
			} else {
				$price += $prices[$option['R02_Option1']]['M01_Price1'];
			}
		}
		if (!empty($option['R02_Option2'])) {
			if ($is_twelve) {
				$price += $prices[$option['R02_Option2']]['M01_Price2'];
			} else {
				$price += $prices[$option['R02_Option2']]['M01_Price1'];
			}
		}
		if (!empty($option['R02_Option3'])) {
			if ($is_twelve) {
				$price += $prices[$option['R02_Option3']]['M01_Price2'];
			} else {
				$price += $prices[$option['R02_Option3']]['M01_Price1'];
			}
		}
		if (!empty($option['R02_Option4'])) {
			if ($is_twelve) {
				$price += $prices[$option['R02_Option4']]['M01_Price2'];
			} else {
				$price += $prices[$option['R02_Option4']]['M01_Price1'];
			}
		}
		if (!empty($option['R02_Option5'])) {
			if ($is_twelve) {
				$price += $prices[$option['R02_Option5']]['M01_Price2'];
			} else {
				$price += $prices[$option['R02_Option5']]['M01_Price1'];
			}
		}

		return $price;
	}
}
