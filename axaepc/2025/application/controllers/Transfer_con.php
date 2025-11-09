<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfer_con extends CI_Controller
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
		$this->load->library('form_validation');
		$this->load->library('validate_lib');
		$this->load->model('option_mo');
		$this->load->model('transfer_mo');
		//$this->load->model('carrental_mo');
		//$this->load->model('carrentalstock_mo');
		$this->load->model('reserve_mo');
		$this->current_date = date('Y-m-d H:i:s');
		//$this->car_schedule = $this->config->item('car_schedule');
		//$this->child_seat = $this->config->item('child_seat');
		//$this->car_limit = date('Y-m-d H:i:s', strtotime($this->config->item('car_limit')));
	}

	public function index()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->reserve_mo->get_common_info($R01_Id);
			$members = $this->option_mo->get_members_info($R01_Id);
			//$reserve = $this->carrental_mo->getCarRental(['R01_User_Id' => $R01_Id]);
			//$rental_stocks = $this->carrentalstock_mo->getCarRentalView();
			//$rental_stocks_table = $this->viewRentalStockTable();

			//$data['reserve'] = $reserve;
			$data['common'] = $common;
			$data['members'] = $members;
			//$data['rental_stocks'] = $rental_stocks;
			//$data['rental_stocks_table'] = $rental_stocks_table;
			//$data['car_limit'] = $this->car_limit;
			$data['current_date'] = $this->current_date;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('trans_vi', $data);
			$this->load->view('trans_script_vi');
			//$this->load->view('car_confirm_vi',$data);
			//$this->load->view('car_rental_script_vi');
			//$this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	public function edit()
	{

		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$common = $this->reserve_mo->get_common_info($R01_Id);
			$members = $this->option_mo->get_members_info($R01_Id);

			// $reserve = $this->carrental_mo->getCarRental(['R01_User_Id' => $R01_Id]);
			// $rental_stocks = $this->carrentalstock_mo->getCarRentalView();
			// $rental_stocks_table = $this->viewRentalStockTable();

			// $data['reserve'] = $reserve;
			// $data['rental_stocks'] = $rental_stocks;
			// $data['rental_stocks_table'] = $rental_stocks_table;
			$data['common'] = $common;
			$data['members'] = $members;
			$data['current_date'] = $this->current_date;

			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('trans_edit_vi', $data);
			$this->load->view('trans_script_vi');
			// $this->load->view('car_rental_script_vi');
			// $this->load->view('aside_mypage_vi');
			$this->load->view('footer_vi');
			$this->load->view('last_vi');
		} else {
			redirect(base_url("login_con"));
		}
	}

	public function save()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$members = $this->option_mo->get_members_info($R01_Id);

			$bus_dep_data = $this->input->post('R02_bus_dep');
			$bus_arr_data = $this->input->post('R02_bus_arr');
			// $reserve = $this->input->post('reserve');

			// $rental_date = explode("#", $reserve['R01_FromDriveDate']);
			// $reserve['R01_FromDriveDate'] = $rental_date[0];
			// $reserve['R01_ToDriveDate'] = $rental_date[1];

			// $this->validate_lib->checkCarRental();
			// if ($this->form_validation->run() == true) {
			// 登録、更新処理前に在庫確認（更新処理用に前回の予約データを取得）
			// $old_reserve = $this->carrental_mo->getCarRental(['R01_User_Id' => $R01_Id]);
			// if ($this->checkCarRental($reserve, $old_reserve) == true) {

			$this->db->trans_begin(); // トランザクション開始

			foreach ($members as $i => $v) {
				$bus_dep = isset($bus_dep_data[$v['R01_seq']]) ? $bus_dep_data[$v['R01_seq']] : 0;
				$bus_arr = isset($bus_arr_data[$v['R01_seq']]) ? $bus_arr_data[$v['R01_seq']] : 0;

				// モデルを呼び出して保存（insert or update）
				$this->transfer_mo->save_bus_info($v['R01_Id'], $v['R01_seq'], $bus_dep, $bus_arr);
			}
			// // R01_User_Id が有る場合 UPDATE 
			// if (!empty($reserve['R01_User_Id'])) {
			// 	$_reserve = $reserve;
			// 	unset($_reserve['R01_User_Id']);
			// 	$this->carrental_mo->update($_reserve, ['R01_User_Id' => $reserve['R01_User_Id']]);
			// 	$this->adjustCarRental($reserve, $old_reserve, 2);
			// 	$this->session->set_tempdata('success_flash', '更新完了しました。', 1);

			// 	// R01_User_Id が無い場合 INSERT 
			// } else {
			// 	$reserve['R01_User_Id'] = $R01_Id;
			// 	$reserve['R01_Regist_Flg'] = 1; //登録済みフラグを 1:登録 にする
			// 	$this->carrental_mo->insert($reserve);
			// 	$this->adjustCarRental($reserve, $old_reserve, 1);
			// 	$this->session->set_tempdata('success_flash', '登録完了しました。', 1);
			// }

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_tempdata('success_flash', 'システムエラー：DB更新処理に失敗しました。', 1);
				// 入力画面呼び出し
				$common = $this->reserve_mo->get_common_info($R01_Id);

				// $rental_stocks = $this->carrentalstock_mo->getCarRentalView();
				// $rental_stocks_table = $this->viewRentalStockTable();

				$data['common'] = $common;
				$data['members'] = $members;
				$data['current_date'] = $this->current_date;
				// $data['reserve'] = $reserve;
				// $data['rental_stocks'] = $rental_stocks;
				// $data['rental_stocks_table'] = $rental_stocks_table;
				$this->load->view('head_vi');
				$this->load->view('header_vi', $data);
				$this->load->view('trans_edit_vi', $data);
				$this->load->view('trans_script_vi');
				// $this->load->view('car_rental_vi', $data);
				// $this->load->view('car_rental_script_vi');
				// $this->load->view('aside_mypage_vi');
				$this->load->view('footer_vi');
				$this->load->view('last_vi');
			} else {
				$this->db->trans_commit();
				// 完了画面呼び出し
				$this->load->view('head_vi');
				$this->load->view('header_vi');
				$this->load->view('trans_complete_vi');
				// $this->load->view('aside_mypage_vi');
				$this->load->view('footer_vi');
				$this->load->view('last_vi');
			}
			// } else {
			// 	$this->session->set_tempdata('success_flash', '選択された予約クラスは満車のため予約できません。', 1);
			// 	// 入力画面呼び出し
			// 	$rental_stocks = $this->carrentalstock_mo->getCarRentalView();
			// 	$rental_stocks_table = $this->viewRentalStockTable();
			// 	$data['reserve'] = $reserve;
			// 	$data['rental_stocks'] = $rental_stocks;
			// 	$data['rental_stocks_table'] = $rental_stocks_table;
			// 	$this->load->view('head_vi');
			// 	$this->load->view('header_vi', $data);
			// 	$this->load->view('car_rental_vi', $data);
			// 	$this->load->view('car_rental_script_vi');
			// 	$this->load->view('aside_mypage_vi');
			// 	$this->load->view('footer_vi');
			// 	$this->load->view('last_vi');
			// }
			// } else {
			// 	// 入力画面呼び出し
			// 	$rental_stocks = $this->carrentalstock_mo->getCarRentalView();
			// 	$rental_stocks_table = $this->viewRentalStockTable();
			// 	$data['reserve'] = $reserve;
			// 	$data['rental_stocks'] = $rental_stocks;
			// 	$data['rental_stocks_table'] = $rental_stocks_table;
			// 	$this->load->view('head_vi');
			// 	$this->load->view('header_vi', $data);
			// 	$this->load->view('car_rental_vi', $data);
			// 	$this->load->view('car_rental_script_vi');
			// 	$this->load->view('aside_mypage_vi');
			// 	$this->load->view('footer_vi');
			// 	$this->load->view('last_vi');
			// }
		} else {
			redirect(base_url("login_con"));
		}
	}

	public function cancel()
	{
		if (check_login_user_session()) {
			$R01_Id = $this->session->userdata('user_data');
			$old_reserve = $this->carrental_mo->getCarRental(['R01_User_Id' => $R01_Id]);
			$old_day_count = ((strtotime($old_reserve['R01_ToDriveDate']) - strtotime($old_reserve['R01_FromDriveDate'])) / 86400) + 1; // 前回予約カウンタ値算出

			$this->db->trans_begin(); // トランザクション開始
			// 在庫差し戻し :20220617_tobita
			// ※在庫戻しの処理は同じソース内にもう一か所あります。「20220617_tobita」で検索してください。
			for ($i = 0; $i < $old_day_count; $i++) {
				$old_check_day = $this->getReserveDate($old_reserve['R01_FromDriveDate'], $i); // 前回予約レンタル開始日を取得
				// 予約クラスの在庫を取得
				$_stock = $this->carrentalstock_mo->getCarRentalStock(['R02_Class' => $old_reserve['R01_Class'], 'R02_Rental_Day' => $old_check_day]);
				$_id = $_stock['R02_Class'];
				// キーを更新しないよう考慮
				unset($_stock['R02_Class']);
				unset($_stock['R02_Rental_Day']);
				$_stock['R02_Reserve'] -= 1;
				$_stock['R02_Balance'] += 1;
				// 在庫更新（対象の在庫を加算）
				$this->carrentalstock_mo->update($_stock, ['R02_Class' => $_id, 'R02_Rental_Day' => $old_check_day]);
			}
			// レンタル登録情報物理削除
			$this->carrental_mo->delete($old_reserve['R01_User_Id']);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_tempdata('success_flash', 'システムエラー：キャンセル処理に失敗しました。', 1);
				redirect(base_url("CarRental_con"));
			} else {
				$this->db->trans_commit();
				$this->session->set_tempdata('success_flash', 'キャンセルしました。', 1);
				redirect(base_url("CarRental_con"));
			}
		} else {
			redirect(base_url("login_con"));
		}
	}

	// レンタカーの在庫調整（在庫更新処理）
	// $flg = 1:INSERT 2:UPDATE
	private function adjustCarRental($reserve, $old_reserve, $flg)
	{
		$day_count = ((strtotime($reserve['R01_ToDriveDate']) - strtotime($reserve['R01_FromDriveDate']))) / 86400 + 1; // カウンタ値算出
		$old_day_count = ((strtotime($old_reserve['R01_ToDriveDate']) - strtotime($old_reserve['R01_FromDriveDate'])) / 86400) + 1; // 前回予約カウンタ値算出

		// INSERTの場合
		if ($flg == 1) {
			// 在庫減算
			for ($i = 0; $i < $day_count; $i++) {
				$check_day = $this->getReserveDate($reserve['R01_FromDriveDate'], $i); // レンタル日を取得
				// 予約クラスの在庫を取得
				$stock = $this->carrentalstock_mo->getCarRentalStock(['R02_Class' => $reserve['R01_Class'], 'R02_Rental_Day' => $check_day]);
				$id = $stock['R02_Class'];
				// キーを更新しないよう考慮
				unset($stock['R02_Class']);
				unset($stock['R02_Rental_Day']);
				$stock['R02_Reserve'] += 1;
				$stock['R02_Balance'] -= 1;
				// 在庫更新（対象の在庫を減算）
				$this->carrentalstock_mo->update($stock, ['R02_Class' => $id, 'R02_Rental_Day' => $check_day]);
			}

			// UPDATEの場合 :20220617_tobita
			// ※在庫戻しの処理は同じソース内にもう一か所あります。「20220617_tobita」で検索してください。
		} else if ($flg == 2) {
			// 在庫差し戻し
			for ($i = 0; $i < $old_day_count; $i++) {
				$old_check_day = $this->getReserveDate($old_reserve['R01_FromDriveDate'], $i); // 前回予約レンタル日を取得
				// 予約クラスの在庫を取得
				$_stock = $this->carrentalstock_mo->getCarRentalStock(['R02_Class' => $old_reserve['R01_Class'], 'R02_Rental_Day' => $old_check_day]);
				$_id = $_stock['R02_Class'];
				// キーを更新しないよう考慮
				unset($_stock['R02_Class']);
				unset($_stock['R02_Rental_Day']);
				$_stock['R02_Reserve'] -= 1;
				$_stock['R02_Balance'] += 1;
				// 在庫更新（対象の在庫を加算）
				$this->carrentalstock_mo->update($_stock, ['R02_Class' => $_id, 'R02_Rental_Day' => $old_check_day]);
			}

			// 在庫減算
			for ($i = 0; $i < $day_count; $i++) {
				$check_day = $this->getReserveDate($reserve['R01_FromDriveDate'], $i); // レンタル開始日を取得
				// 予約クラスの在庫を取得
				$stock = $this->carrentalstock_mo->getCarRentalStock(['R02_Class' => $reserve['R01_Class'], 'R02_Rental_Day' => $check_day]);
				$id = $stock['R02_Class'];
				// キーを更新しないよう考慮
				unset($stock['R02_Class']);
				unset($stock['R02_Rental_Day']);
				$stock['R02_Reserve'] += 1;
				$stock['R02_Balance'] -= 1;
				// 在庫更新（対象の在庫を減算）
				$this->carrentalstock_mo->update($stock, ['R02_Class' => $id, 'R02_Rental_Day' => $check_day]);
			}
		}
	}

	// レンタカーの在庫確認
	private function checkCarRental($reserve, $old_reserve)
	{
		$rental_start_day = date('d', strtotime($reserve['R01_FromDriveDate'])); // レンタル開始日
		$rental_end_day = date('d', strtotime($reserve['R01_ToDriveDate'])); // レンタル終了日
		$day_count = ((strtotime($reserve['R01_ToDriveDate']) - strtotime($reserve['R01_FromDriveDate']))) / 86400 + 1; // カウンタ値算出
		$stock_flg = true;

		//echo "#開始日 ".$reserve['R01_FromDriveDate']."<br>";
		//echo "#返却日 ".$reserve['R01_ToDriveDate']."<br>";
		//echo "#日数　 ".$day_count."<br>";



		// 更新処理を行う場合、前回と同じクラス、貸出日、返却日なら在庫確認の処理をパスする
		if (!empty($old_reserve)) {
			$old_rental_start_day = date('d', strtotime($old_reserve['R01_FromDriveDate'])); // 前回予約レンタル開始日
			$old_rental_end_day = date('d', strtotime($old_reserve['R01_ToDriveDate'])); // 前回予約レンタル終了日

			if (($reserve['R01_Class'] == $old_reserve['R01_Class']) && ($rental_start_day == $old_rental_start_day) && ($rental_end_day == $old_rental_end_day)) {
				return true;
			}
		}

		for ($i = 0; $i < $day_count; $i++) {
			$check_day = $this->getReserveDate($reserve['R01_FromDriveDate'], $i); // レンタル日を取得
			// 予約クラスの在庫を取得
			$stock = $this->carrentalstock_mo->getCarRentalStock(['R02_Class' => $reserve['R01_Class'], 'R02_Rental_Day' => $check_day]);
			// 在庫が無ければエラーとする
			if ($stock['R02_Balance'] < 1) {
				$stock_flg = false;
			}
			//echo $reserve['R01_FromDriveDate']." ".$check_day."->(".$stock['R02_Balance'].") "." 日数(".$i.")".$stock_flg."<br>";
		}
		if ($stock_flg) {
			return true;
		} else {
			return false;
		}
	}

	// 在庫の残数を表示するtableの準備
	private function viewRentalStockTable()
	{
		$rental_stocks = $this->carrentalstock_mo->getCarRentalStocks();
		$rental_stocks_days = $this->carrentalstock_mo->getCarRentalDays();
		foreach ($rental_stocks as $index1 => $stock) {
			foreach ($rental_stocks_days as $index2 => $day) {
				if ($stock['R02_Rental_Day'] == $day['R02_Rental_Day']) {
					$data[$index2][$stock['R02_Class']] = $stock['R02_Balance'];
					$data[$index2]['day'] = $day['R02_Rental_Day'];
				}
			}
		}
		return $data;
	}

	// レンタル開始日を算出
	private function getReserveDate($date, $day)
	{
		// 予約が1日以上の場合
		if ($day > 0) {
			return date('j', strtotime('+' . $day . ' day', strtotime($date)));
			// 予約が1日の場合
		} else {
			return date('j', strtotime($date));
		}
	}
}
