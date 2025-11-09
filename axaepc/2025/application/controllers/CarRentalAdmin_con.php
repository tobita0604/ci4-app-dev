<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class CarRentalAdmin_con extends CI_Controller {

	
//------------------------コンストラクタ------------------------
	public function __construct() {
		
		parent::__construct ();
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
		$this->car_schedule = $this->config->item('car_schedule');
		$this->child_seat = $this->config->item('child_seat');

		
		date_default_timezone_set("Asia/Tokyo");
		
	}

	
//------------------------INDEX------------------------
	
public function index() 
{
	// 使用していないが念のためログイン画面に遷移するように設定
	redirect(base_url("admin_con"));
}
	
//------------------------参加者検索------------------------

	public function search() {
		if(isset($_POST['downloadcsv'])){
			$this->downloadcsv();
			return;
		}
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');
		$Charger_Type = $this->session->userdata('Charger_Type');
		$rental_stocks = $this->carrentalstock_mo->getCarRentalView();
		$rental_stocks_table = $this->viewRentalStockTable();

		$rental_stocks = $this->carrentalstock_mo->getCarRentalStocks();

		if (isset($admin_Id)) {
			$result = array();
			$searchKey = $this->get_init_search_key();
			if(isset($_POST['searchbtn'])){
				$searchKey = $this->get_search_key();
				$result = $this->carrental_mo->searchCarRentals($searchKey);
				
			}

			$data['rental_stocks'] = $rental_stocks;
			$data['rental_stocks_table'] = $rental_stocks_table;
			$data['searchbtn'] = $this->input->post("searchbtn");
			$data['searchKey'] = $searchKey;
			$data['result'] = $result;
			$data['count_resever'] = count($result);
			// $data['branches'] = $this->menu_mo->get_branch_list();
			// $data['rental_stocks'] = $rental_stocks;
			
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('search_script_vi');
			$this->load->view('car_rental_admin_vi' , $data);
			$this->load->view('last_vi');
			
		} else {
			redirect(base_url('admin_con'));
		}
	}
	
	private function downloadcsv(){
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');
		$Charger_Type = $this->session->userdata('Charger_Type');
		
		if (isset($admin_Id)) {
			$searchKey = $this->get_search_key();
			$result = $this->carrental_mo->searchCarRentals($searchKey);
			
			// ヘッダ文字列
			$headers = $this->create_headers();
			
			$fileName = mb_convert_encoding("AXAレンタカー予約" . date('Ymd_His') . ".csv", "SJIS" ,"UTF-8");
			
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename='.$fileName);		
			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');		
			fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));		
			// output the column headings
			fputcsv($output, $headers);	
			//データ抽出する
			
			if($result != NULL && count($result) > 0){
				foreach ($result as $row){
					$csvdata = $this->create_columns($row);
					fputcsv($output, $csvdata);
				}
			}	
			fclose($output);
		}
		
	}
	
	private function get_init_search_key() {
		return array(
		'R01_User_Id'=>'',
		'R01_Name_Kanji'=>'',
		'R01_Name_Kana'=>'',
		'R01_Class'=>'',
		'R01_Schedule'=>'0',
		'R01_Child_Seat'=>'0',
		);
	}
	
	private function get_search_key() {
		$searchKey = $this->input->post();
		return $searchKey;
	}
	
	private function create_headers() {
		$headers = array();
		$headers[] = '社員番号';
		$headers[] = 'お名前(漢字)';
		$headers[] = 'お名前(カナ)';
		$headers[] = '運転免許証番号';
		$headers[] = '運転免許証有効期限';
		$headers[] = 'レンタカークラス';
		$headers[] = '貸出日';
		$headers[] = '貸出時間';
		$headers[] = '返却日';
		$headers[] = '返却時間';
		$headers[] = '自動車保険';
		$headers[] = 'チャイルドシート';
		return $headers;
	}
	
	private function create_columns($row) {
		$columns = array();
		// 社員番号
		$columns[] = $row['R01_User_Id'];
		// お名前(漢字)
		$columns[] = $row['R01_Name_Kanji'];
		// お名前(カナ)
		$columns[] = $row['R01_Name_Kana'];
		// 運転免許証番号
		$columns[] = empty($row['R01_Driver_License_No'])?'':'\''.$row['R01_Driver_License_No'];
		// 運転免許証有効期限
		$columns[] = empty($row['R01_Driver_License_Expiry'])?'':$row['R01_Driver_License_Expiry'];
		// レンタカークラス
		$columns[] = empty($row['R01_Class'])?'':$row['R01_Class'];
		// 貸出日
		$columns[] = empty($row['R01_FromDriveDate'])?'':$row['R01_FromDriveDate'];
		// 貸出時間
		$columns[] = empty($row['R01_FromDriveTime'])?'':$row['R01_FromDriveTime'];
		// 返却日
		$columns[] = empty($row['R01_ToDriveDate'])?'':$row['R01_ToDriveDate'];
		// 返却時間
		$columns[] = empty($row['R01_ToDriveTime'])?'':$row['R01_ToDriveTime'];
		// 自動車保険
		$columns[] = empty($row['R01_Car_Insurance'])?'':$row['R01_Car_Insurance'];
		// チャイルドシート
		if(empty($row['R01_Child_Seat'])) {
			$columns[] = '';
		} else {
			$columns[] = v($this->child_seat, $row['R01_Child_Seat']);
		}
		return $columns;
	}
	
	// 在庫の残数を表示するtableの準備
	private function viewRentalStockTable(){
		$rental_stocks = $this->carrentalstock_mo->getCarRentalStocks();
		$rental_stocks_days = $this->carrentalstock_mo->getCarRentalDays();
		foreach($rental_stocks as $index1 => $stock){
			foreach($rental_stocks_days as $index2 => $day){
				if($stock['R02_Rental_Day'] == $day['R02_Rental_Day']){
					$data[$index2][$stock['R02_Class']] = $stock['R02_Balance'];
					$data[$index2]['day'] = $day['R02_Rental_Day'];
				}
			}
		}
		return $data;
	}
	
}
