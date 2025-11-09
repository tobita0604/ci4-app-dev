<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Download_mo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//==============================================
	// 同伴者情報取得（登録済分）
	//==============================================
	public function search_photo($params = array())
	{
		$this->db->select("*");
		$this->db->from("R01_Reserver R01R");
		$this->db->join("R01_Member R01M", "R01R.R01_Id = R01M.R01_Id AND R01M.R01_seq = 0", "INNER");
		if (!empty($params['R01_Test_Flg'])) {
			$this->db->where("R01R.R01_Test_Flg", 0);
		}
		if (empty($params['R01_Brochure_Img'])) {
			$this->db->where("R01R.R01_Brochure_Img != ''");
		}
		if (!empty($params['R01_Id'])) {
			$this->db->where("R01R.R01_Id", $params['R01_Id']);
		}
		$this->db->order_by("R01R.R01_Id");
		$this->db->order_by("R01M.R01_seq");


		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}
}
