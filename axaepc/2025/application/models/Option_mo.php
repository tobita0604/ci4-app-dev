<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Option_mo extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//==============================================
	// 同伴者情報取得（登録済分）
	//==============================================
	public function get_members_info($R01_Id, $R01_seq = '')
	{
		$this->db->select("*");
		$this->db->from("R01_Member R01");
		$this->db->join("R02_Option R02", "R01.R01_Id = R02.R02_Id AND R01.R01_seq = R02.R02_seq", "LEFT");
		$this->db->where("R01_Id", $R01_Id);
		// $this->db->where("R01_Cancel_Flg", '0');
		if ($R01_seq != '') {
			$this->db->where("R01_seq", $R01_seq);
		}
		$this->db->order_by("R01_seq");


		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプショナル情報取得（登録済分）
	//==============================================
	public function get_options_info($R01_Id)
	{
		$this->db->select("*");
		$this->db->from("R02_Option R02");
		$this->db->where("R02_Id", $R01_Id);
		$this->db->order_by("R02_seq");


		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプショナルツアー全日付取得
	//==============================================
	public function get_times($id, $type)
	{
		$this->db->select("*");
		$this->db->from("M01_Option_Time");
		if (!empty($id)) {
			$this->db->where('M01_Id', $id);
		}
		if ($type == 1) {
			$this->db->where('M01_Date_Flg', 1);
		} else if ($type == 2) {
			$this->db->where('M01_Date_Flg', 2);
		} else if ($type == 3) {
			$this->db->where('M01_Date_Flg', 3);
		}
		$this->db->order_by("M01_Time_Id");
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// 参加可能オプショナル取得
	//==============================================
	public function get_availables($params = array())
	{
		$this->db->select("*");
		$this->db->from("M01_Option_Available M01A");
		$this->db->join("M01_Option M01", "M01A.M01_Id = M01.M01_Id AND M01A.M01_Type = M01.M01_Type", "INNER");
		$this->db->join("M01_Option_Time M01T", "M01T.M01_Day = M01A.M01_Day AND M01T.M01_Period = M01A.M01_Period AND M01T.M01_Type = M01A.M01_Type", "INNER");
		if (!empty($params['M01_Type'])) {
			$this->db->where("M01.M01_Type", $params['M01_Type']);
		}
		if (!empty($params['M01_Id'])) {
			$this->db->where("M01.M01_Id", $params['M01_Id']);
		}
		if (!empty($params['M01_Day'])) {
			$this->db->where("M01A.M01_Day", $params['M01_Day']);
		}
		if (!empty($params['M01_Period'])) {
			$this->db->where("M01A.M01_Period", $params['M01_Period']);
		}
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプショナル取得
	//==============================================
	public function get_options($params = array())
	{
		$this->db->select("*");
		$this->db->from("M01_Option");
		if (!empty($params['M01_Type'])) {
			$this->db->where("M01_Type", $params['M01_Type']);
		}
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプション人数取得
	//==============================================
	public function get_menber_options($params)
	{
		$this->db->select("*");
		$this->db->from("R02_Option");
		if (!empty($params)) {
			$this->db->where("R02_Id", $params);
		}
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプショナルツアー登録
	//==============================================
	public function add_option($option)
	{
		$this->db->insert('R02_Option', $option);
		return $this->db->affected_rows();
	}

	//==============================================
	//　オプショナル情報登録
	//==============================================
	public function backup_option($option)
	{
		$this->db->insert('R02_Option_Backup', $option);
		return $this->db->affected_rows();
	}

	//==============================================
	//　オプショナルツアー削除
	//==============================================
	public function delete_options($R02_Id, $R02_seq = '')
	{
		$this->db->where('R02_Id', $R02_Id);
		if ($R02_seq != '') {
			$this->db->where("R02_seq", $R02_seq);
		}
		$this->db->delete('R02_Option');
		return $this->db->affected_rows();
	}

	//==============================================
	// オプショナルツアー全日付取得 
	//==============================================
	// add 2022.6.8 tobita
	public function get_schedule($prm)
	{
		$this->db->select("*");
		$this->db->from("M01_Option");
		if ($prm == 1) {
			$this->db->where('M01_Day1_On', 1);
		} else if ($prm == 2) {
			$this->db->where('M01_Day2_On', 1);
		} else if ($prm == 3) {
			$this->db->where('M01_Day3_On', 1);
		}
		$this->db->order_by("M01_Sort_Order");
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプショナルツアー更新
	//==============================================
	public function update($data, $condition = [])
	{
		if (!empty($condition)) {
			foreach ($condition as $key => $val) {
				$this->db->where($key, $val);
			}
		}
		$this->db->update('R02_Option', $data);
		return $this->db->affected_rows();
	}

	//==============================================
	// オプショナルツアー時間指定なしの在庫取得
	//==============================================
	public function getNoTimeStock($prm, $type)
	{
		$this->db->select("*");
		$this->db->from("M01_Option_Time");
		$this->db->where('M01_Id', $prm);
		if ($type == 1) {
			$this->db->where('M01_Date_Flg', 1);
		} else if ($type == 2) {
			$this->db->where('M01_Date_Flg', 2);
		}
		$this->db->where('M01_Time_Text', "");
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// オプショナルツアー在庫更新
	//==============================================
	public function updateStock($data, $condition = [])
	{
		if (!empty($condition)) {
			foreach ($condition as $key => $val) {
				$this->db->where($key, $val);
			}
		}
		$this->db->update('M01_Option_Time', $data);
		return $this->db->affected_rows();
	}

	//==============================================
	// オプショナルツアー在庫取得
	//==============================================
	public function getOptionsStock($id)
	{
		$this->db->select("*");
		$this->db->from("M01_Option_Time");
		$this->db->where('M01_Stock_Id', $id);
		$query = $this->db->get();
		$getOptionsStock = $query->row_array();
		return $getOptionsStock;
	}

	//==============================================
	// オプショナルツアー在庫状況画面用データ取得
	//==============================================
	public function getOptionsStockView()
	{
		/*	    $this->db->select("a.M01_id,a.M01_id_name,a.M01_Name, b.M01_Date_Flg, b.M01_Time_Text, b.M01_Stock, b.M01_Reserve, b.M01_Balance");
	    $this->db->select("(select count(temp.M01_id) from M01_Option_Time temp where temp.M01_id = a.M01_id group by temp.M01_id) as ct");
	    $this->db->select("(select count(temp2.M01_Id) from M01_Option_Time temp2 where temp2.M01_id = a.M01_id and temp2.M01_Date_Flg = b.M01_Date_Flg group by temp2.M01_id,temp2.M01_Date_Flg) as ct2");
 	    $this->db->from("M01_Option a");
	    $this->db->join("M01_Option_Time b", "a.M01_Id = b.M01_Id");
	    $this->db->order_by("a.M01_sort_order");
	    $this->db->order_by("a.M01_Id", "asc");
	    $this->db->order_by("b.M01_Date_Flg","asc");
	    $this->db->order_by("b.M01_Time_id","asc");
 */
		// $query = $this->db->query("SELECT a.M01_id, a.M01_id_name, a.M01_Name, b.M01_Stock_Id,b.M01_Date_Flg, b.M01_Time_Text, b.M01_Stock, b.M01_Reserve, b.M01_Balance, (select count(temp.M01_id) from M01_Option_Time temp where temp.M01_id = a.M01_id group by temp.M01_id) as ct, (select count(temp2.M01_Id) from M01_Option_Time temp2 where temp2.M01_id = a.M01_id and temp2.M01_Date_Flg = b.M01_Date_Flg group by temp2.M01_id, temp2.M01_Date_Flg) as ct2 FROM M01_Option a JOIN M01_Option_Time b ON a.M01_Id = b.M01_Id ORDER BY a.M01_sort_order, a.M01_Id ASC, b.M01_Date_Flg ASC, b.M01_Time_id ASC");

		// 選択するカラムとサブクエリを指定
		// $this->db->select("
		// 	a.M01_id,
		// 	a.M01_id_name,
		// 	a.M01_Name,
		// 	b.M01_Stock_Id,
		// 	b.M01_Date_Flg,
		// 	b.M01_Time_Text,
		// 	b.M01_Stock,
		// 	b.M01_Reserve,
		// 	b.M01_Balance,
		// 	(SELECT COUNT(temp.M01_id) FROM M01_Option_Time temp WHERE temp.M01_id = a.M01_id GROUP BY temp.M01_id) AS ct,
		// 	(SELECT COUNT(temp2.M01_Id) FROM M01_Option_Time temp2 WHERE temp2.M01_id = a.M01_id AND temp2.M01_Date_Flg = b.M01_Date_Flg GROUP BY temp2.M01_id, temp2.M01_Date_Flg) AS ct2
		// 	", false);

		$this->db->select("
			a.M01_id,
			a.M01_Name,
			CASE
				WHEN a.M01_id = 'S01' THEN '8月6日'
				WHEN a.M01_id = 'S02' THEN '8月7日'
				WHEN a.M01_id = 'H01' THEN '8月6日'
				WHEN a.M01_id = 'H02' THEN '8月7日'
				ELSE ''
			END AS R02_Date,
			(SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE (R02_Option1 = 'S01' OR R02_Option2 = 'S01') AND R01_Reserver.R01_Test_Flg = 0 ) AS S01_Total,
        	(SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE (R02_Option1 = 'H01' OR R02_Option2 = 'H01') AND R01_Reserver.R01_Test_Flg = 0 ) AS H01_Total,
			(SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE (R02_Option1 = 'S02' OR R02_Option2 = 'S02') AND R01_Reserver.R01_Test_Flg = 0 ) AS S02_Total,
        	(SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE (R02_Option1 = 'H02' OR R02_Option2 = 'H02') AND R01_Reserver.R01_Test_Flg = 0 ) AS H02_Total
			", false);

		// メインテーブルの指定
		$this->db->from('M01_Option a');

		// 結合の指定
		// $this->db->join('M01_Option_Time b', 'a.M01_Id = b.M01_Id');

		// 条件の指定
		$this->db->where_in('a.M01_id', array('S01', 'H01', 'S02', 'H02'));

		// 並び順の指定
		$this->db->order_by('a.M01_sort_order', 'ASC');
		$this->db->order_by('a.M01_Id', 'ASC');
		// $this->db->order_by('b.M01_Date_Flg', 'ASC');
		// $this->db->order_by('b.M01_Time_id', 'ASC');
		$this->db->group_by(array("a.M01_id", "a.M01_Name"));

		// クエリの実行
		$query = $this->db->get();

		$getOptionsStockView = $query->result_array();
		// print_r($this->db->last_query());
		// exit;
		if ($getOptionsStockView && count($getOptionsStockView) > 0) {
			return $getOptionsStockView;
		} else {
			return array();
		}
	}

	//==============================================
	// オプショナル情報取得（登録済分）
	//==============================================
	public function getOptionPrice($options, $R01_Id, $idx)
	{
		// 年齢を取得
		$this->db->where('R01_Id', $R01_Id);
		$this->db->where('R01_seq', $idx);
		$row = $this->db->get('R01_Member')->row_array();

		if (!isset($row['R01_Age']) || !is_numeric($row['R01_Age'])) {
			return 0;
		}

		$age = $row['R01_Age'];
		$total_price = 0;

		// 各オプションをチェックして加算
		foreach ($options as $opt_val) {
			if ($opt_val !== '0' && !empty($opt_val)) {
				$this->db->where('M01_Id', $opt_val);
				$row_op = $this->db->get('M01_Option')->row_array();

				if (!empty($row_op)) {
					$price = ($age < 18) ? $row_op['M01_Price2'] : $row_op['M01_Price1'];
					$total_price += $price;
				}
			}
		}

		return $total_price;
	}
}
