<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reentry_con extends CI_Controller
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
		$this->load->model('common_mo');
		$this->load->model('entry_mo');
		$this->load->model('option_mo');
		$this->load->library('session');
		$this->load->library('email');
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
		if (isset($_POST['downloadcsv'])) {
			$this->downloadcsv();
			return;
		}
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');
		$Charger_Type = $this->session->userdata('Charger_Type');

		if (isset($admin_Id)) {
			$result = array();
			$searchKey = $this->get_init_search_key();
			if (isset($_POST['searchbtn'])) {
				$searchKey = $this->get_search_key();
				$result = $this->menu_mo->search_data($searchKey);
			}

			$data['searchbtn'] = $this->input->post("searchbtn");
			$data['searchKey'] = $searchKey;
			$data['result'] = $result;
			$data['count_resever'] = count($result);
			$data['branches'] = $this->menu_mo->get_branch_list();

			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('reentry_script_vi');
			$this->load->view('reentry_vi', $data);
			$this->load->view('last_vi');
		} else {
			redirect(base_url('admin_con'));
		}
	}

	//------------------------再入力許可設定（更新）------------------------

	public function entrychange()
	{
		$upd_flg = 0;
		$id = $this->input->post('id');
		$reentry_flg = $this->input->post('reentry_flg');
		if (!empty($id) && $reentry_flg != '') {
			$upd_flg = $this->menu_mo->update(['R01_reentry' => $reentry_flg], ['R01_Id' => $id]);
			if ($upd_flg > 0) {
				$this->session->set_tempdata('success_flash', '更新完了しました。', 1);
			} else {
				$this->session->set_tempdata('error_flash', '更新に失敗しました。', 1);
			}
		} else {
			$this->session->set_tempdata('error_flash', '更新に失敗しました。', 1);
		}
		redirect(base_url('reentry_con/search'));
	}

	//------------------------CSV出力------------------------

	private function downloadcsv()
	{
		// Check session
		$admin_Id = $this->session->userdata('admin_id_session');
		$Charger_Type = $this->session->userdata('Charger_Type');

		if (isset($admin_Id)) {
			$searchKey = $this->get_search_key();
			$result = $this->menu_mo->search_data_export($searchKey);
			$times = $this->option_mo->get_times(array('M01_Type' => OPTION_TYPE_FARM, 'M01_Day' => '1'));
			array_unshift($times, array());
			$options = $this->option_mo->get_options();
			for ($i = 0; $i < count($options); $i++) {
				$option = array_shift($options);
				$options[$option['M01_Id']] = $option;
			}

			// ヘッダ文字列
			$headers = $this->create_headers();

			$fileName = mb_convert_encoding("AXA" . date('Ymd_His') . ".csv", "SJIS", "UTF-8");

			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=' . $fileName);
			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');
			fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
			// output the column headings
			fputcsv($output, $headers);
			//データ抽出する

			if ($result != NULL && count($result) > 0) {
				foreach ($result as $row) {
					$csvdata = $this->create_columns($row, $options, $times);
					fputcsv($output, $csvdata);
				}
			}
			fclose($output);
		}
	}

	private function get_init_search_key()
	{
		return array(
			'R01_Id' => '',
			'R01_Name' => '',
			'R01_Roma_Last' => '',
			'R01_Roma_First' => '',
			'R01_Email' => '',
			'R01_Branch_Cd' => '',
			'R01_Login_Flg' => '',
			'R01_Entry_Flg' => '',
			'R01_Test_Flg' => '1',
			'R01_reentry' => '',
		);
	}

	private function get_search_key()
	{
		$searchKey = $this->input->post();
		if (!isset($searchKey['R01_Test_Flg'])) {
			$searchKey['R01_Test_Flg'] = '1';
		}
		return $searchKey;
	}

	private function create_headers()
	{
		$headers = array();
		$headers[] = 'ID(個別）';
		$headers[] = '代・同';
		$headers[] = '社員番号';
		$headers[] = 'SEQ';
		$headers[] = '管理コード';
		$headers[] = 'パスワード';
		$headers[] = 'カテゴリー';
		$headers[] = '1Q家族招待OP';
		$headers[] = '4Q家族招待OP';
		$headers[] = 'OP①';
		$headers[] = '招待人数';
		$headers[] = '自費参加者';
		$headers[] = '参加者計';
		$headers[] = '同行者';

		$headers[] = '支社名';
		$headers[] = '名前';
		$headers[] = '名前（Surname）';
		$headers[] = '名前（Given name）';
		$headers[] = '性別';
		$headers[] = '国籍';
		$headers[] = 'その他国籍';
		$headers[] = '生年月日';
		$headers[] = '年齢';
		$headers[] = '同行者と関係';
		$headers[] = '郵便番号';
		$headers[] = '都道府県';
		$headers[] = '市区郡';
		$headers[] = '町村名番地番号';
		$headers[] = '建物名・部屋番号等';
		$headers[] = '連絡先電話番号';
		$headers[] = '携帯電話番号';
		$headers[] = 'メールアドレス';
		$headers[] = '緊急連絡先お名前';
		$headers[] = '緊急連絡先の続柄';
		$headers[] = '緊急連絡先電話番号';
		$headers[] = '請求書送付先';
		$headers[] = 'レンタカーの利用';
		$headers[] = '備考';
		$headers[] = 'OP①';
		$headers[] = 'OP②';
		$headers[] = 'メニュー';
		$headers[] = '時間';
		$headers[] = 'OP②';
		$headers[] = 'メニュー';
		$headers[] = '時間';
		$headers[] = 'OP③';
		$headers[] = 'クラブ';
		$headers[] = 'シューズ';
		$headers[] = '7/31午前';
		$headers[] = '7/31午後';
		$headers[] = '8/1午前';
		$headers[] = '8/1午後';
		$headers[] = '8/2午前';
		$headers[] = 'image_file_name';
		$headers[] = '機内食';
		$headers[] = 'バシネット';
		$headers[] = '身長';
		$headers[] = '体重';
		$headers[] = 'ハイチェア';
		$headers[] = 'ベビーベッド';
		$headers[] = 'ベビーカー';
		$headers[] = '作成日';
		$headers[] = '更新日';

		return $headers;
	}

	private function create_columns($row, $options, $times)
	{
		$columns = array();
		$seq = $row['R01_seq'] + 1;
		// ID(個別）
		$columns[] = $row['R01_Id'] . '-' . $seq;
		// 代・同
		$columns[] = $row['R01_seq'] == '0' ? '代' : '同';
		// 社員番号
		$columns[] = $row['R01_Id'];
		// SEQ
		$columns[] = $seq;
		// 管理コード
		$columns[] = $row['R01_Code'];
		// パスワード
		$columns[] = $row['R01_Password'];
		// カテゴリー
		$columns[] = get_label('カテゴリ', $row['R01_Category_Flg']);
		// 1Q家族招待OP
		$columns[] = get_label('1Q', $row['R01_1Q_Flg']);
		// 4Q家族招待OP
		$columns[] = get_label('4Q', $row['R01_4Q_Flg']);
		// シーライフパーク
		$columns[] = get_label('パーク', $row['R01_Park_Flg']);
		// 招待人数
		$columns[] = $row['R01_Free_Invites'];
		// 自費参加者
		$columns[] = $row['R01_Charge_Invites'];
		// 参加者計
		$columns[] = $row['R01_Free_Invites'] + $row['R01_Charge_Invites'];
		// 同行者
		$columns[] = $row['R01_Free_Invites'] + $row['R01_Charge_Invites'] - 1;

		// 支社名
		$columns[] = $row['R01_Branch_Name'];
		// 名前
		$columns[] = $row['R01_Name'];
		// 名前（Surname）
		$columns[] = $row['R01_Roma_Last'];
		// 名前（Given name）
		$columns[] = $row['R01_Roma_First'];
		// 性別
		$columns[] = get_label('性別', $row['R01_Gender']);
		// 国籍
		$columns[] = $row['R01_Nationality'] == '日本' ? '日本' : '';
		// その他国籍
		$columns[] = $row['R01_Nationality'] == '日本' ? '' : $row['R01_Nationality'];
		// 生年月日
		$columns[] = empty_date($row['R01_Birthdate']) ? '' : $row['R01_Birthdate'];
		// 年齢
		$columns[] = empty_date($row['R01_Birthdate']) ? '' : $row['R01_Age'];
		// 同行者と関係
		$columns[] = empty($row['R01_Relationship']) ? '' : getRelationship($row['R01_Relationship']);
		// 郵便番号
		$columns[] = $row['R01_Postal1'] . '-' . $row['R01_Postal2'];
		// 都道府県
		$columns[] = empty($row['R01_Prefecture']) ? '' : getPrefecture($row['R01_Prefecture']);
		// 市区郡
		$columns[] = $row['R01_Address'];
		// 町村名番地番号
		$columns[] = $row['R01_Address2'];
		// 建物名・部屋番号等
		$columns[] = $row['R01_Address3'];
		// 連絡先電話番号
		$columns[] = $row['R01_Tel_No'];
		// 携帯電話番号
		$columns[] = $row['R01_Mobile_No'];
		// メールアドレス
		$columns[] = $row['R01_Email'];
		// 緊急連絡先お名前
		$columns[] = $row['R01_Emer_Name'];
		// 緊急連絡先の続柄
		$columns[] = $row['R01_Emer_Relationship'];
		// 緊急連絡先電話番号
		$columns[] = $row['R01_Emer_Tel_No'];
		// 請求書送付先
		$columns[] = get_label('請求', $row['R01_Invoice_Flg']);
		// レンタカーの利用
		$columns[] = get_label('レンタカー', $row['R01_Car_Rental']);
		// 備考
		$columns[] = $row['R01_Note'];
		// シーライフパーク（7/31）
		$columns[] = get_label('オプションパーク', $row['R02_Park_Flg']);
		// クアロア牧場
		$columns[] = get_label('オプション牧場', $row['R02_Farm_Flg']);
		// メニュー
		if (empty($row['R02_Farm_Flg'])) {
			$columns[] = '';
		} else if (empty($row['R02_Farm_Tour'])) {
			$columns[] = '不参加';
		} else {
			$columns[] = $options[$row['R02_Farm_Tour']]['M01_Name'];
		}
		// 時間
		$columns[] = (empty($row['R02_Farm_Flg']) || empty($row['R02_Farm_Time'])) ? ''
			: $times[$row['R02_Farm_Time']]['M01_Period_Text'];
		// クアロア牧場
		$columns[] = get_label('オプション牧場', $row['R02_Farm_Flg2']);
		// メニュー
		if (empty($row['R02_Farm_Flg2'])) {
			$columns[] = '';
		} else if (empty($row['R02_Farm_Tour2'])) {
			$columns[] = '不参加';
		} else {
			$columns[] = $options[$row['R02_Farm_Tour2']]['M01_Name'];
		}
		// 時間
		$columns[] = (empty($row['R02_Farm_Flg2']) || empty($row['R02_Farm_Time2'])) ? ''
			: $times[$row['R02_Farm_Time2']]['M01_Period_Text'];
		// FAゴルフコンペ
		$columns[] = get_label('オプションゴルフ', $row['R02_Golf_Flg']);
		// クラブ
		$columns[] = empty($row['R02_Golf_Flg']) ? '' : get_label('クラブ', $row['R02_Golf_Club']);
		// シューズ
		if (empty($row['R02_Golf_Flg'])) {
			$columns[] = '';
		} else if ($row['R02_Golf_Shoes'] == '0.0') {
			$columns[] = '持参する';
		} else {
			$columns[] = $row['R02_Golf_Shoes'] . 'cm';
		}
		// $columns[] = empty($row['R02_Golf_Flg']) ? '' : $row['R02_Golf_Shoes'].'cm';
		// 7/31午前
		$columns[] = empty($row['R02_Option1']) ? '' : $options[$row['R02_Option1']]['M01_Name'];
		// 7/31午後
		$columns[] = empty($row['R02_Option2']) ? '' : $options[$row['R02_Option2']]['M01_Name'];
		// 8/1午前
		$columns[] = empty($row['R02_Option3']) ? '' : $options[$row['R02_Option3']]['M01_Name'];
		// 8/1午後
		$columns[] = empty($row['R02_Option4']) ? '' : $options[$row['R02_Option4']]['M01_Name'];
		// 8/2午前
		$columns[] = empty($row['R02_Option5']) ? '' : $options[$row['R02_Option5']]['M01_Name'];
		// image_file_name
		$columns[] = $row['R01_Brochure_Img'];
		// 機内食
		$columns[] = get_label('機内食', $row['R01_Baby_Meal']);
		// バシネット
		$columns[] = get_label('バシネット', $row['R01_Baby_Bassinet']);
		// 身長
		$columns[] = empty($row['R01_Baby_Height']) ? '' : $row['R01_Baby_Height'] . 'cm';
		// 体重
		$columns[] = empty($row['R01_Baby_Weight']) ? '' : $row['R01_Baby_Weight'] . 'kg';
		// ハイチェア
		$columns[] = get_label('ハイチェア', $row['R01_Baby_Chair']);
		// ベビーベッド
		$columns[] = get_label('ベビーベッド', $row['R01_Baby_Bed']);
		// ベビーカー
		$columns[] = get_label('ベビーカー', $row['R01_Baby_Car']);
		// 作成日
		$columns[] = empty_date($row['R01_First_Login_Date']) ? '' : $row['R01_First_Login_Date'];
		// 更新日
		$columns[] = empty_date($row['R01_Update_Date']) ? '' : $row['R01_Update_Date'];
		return $columns;
	}
}
