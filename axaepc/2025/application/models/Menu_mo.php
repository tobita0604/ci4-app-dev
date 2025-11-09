<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Menu_mo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function update($data, $condition = [])
	{
		if (!empty($condition)) {
			foreach ($condition as $key => $val) {
				$this->db->where($key, $val);
			}
		}
		$this->db->update('R01_Reserver', $data);
		return $this->db->affected_rows();
	}

	public function get_branch_list()
	{
		$this->db->select("R01_Branch_Cd, R01_Branch_Name");
		$this->db->from("R01_Reserver");
		$this->db->group_by("R01_Branch_Cd");
		$this->db->where("R01_Test_Flg", 0);

		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	public function search_data($params)
	{
		$this->db->select("R01R.*, R01M.*, R01G.*, R01note.R01_note");
		$this->db->from("R01_Reserver R01R");
		$this->db->join("R01_Member R01M", "R01R.R01_Id = R01M.R01_Id AND R01M.R01_seq = 0", "INNER");
		$this->db->join("(SELECT R01_Id, MIN(R01_Entry_Flg) ALL_REG, COUNT(R01_Id) PER_NO FROM R01_Member GROUP BY R01_Id) R01G", "R01R.R01_Id = R01G.R01_Id", "INNER");
		$this->db->join("R01_note R01note", "R01note.R01_Id = R01M.R01_Id", "LEFT");

		$this->create_condition($params);

		$this->db->order_by('R01R.seqno');

		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	public function search_data_export($params)
	{
		//$this->db->select("*");
		$this->db->select("R01R.*, R01M.*, R02.*, R02C.*, R01note.R01_note as admin_note,(select count(*) from R01_Member sanka where R01R.R01_Id = sanka.R01_Id and sanka.R01_Cancel_Flg = 1) as cancel_pax");
		$this->db->from("R01_Reserver R01R");
		$this->db->join("R01_Member R01M", "R01R.R01_Id = R01M.R01_Id", "INNER");
		$this->db->join("R02_Option R02", "R01M.R01_Id = R02.R02_Id AND R01M.R01_seq = R02.R02_seq", "LEFT");
		$this->db->join("R01_Car_Rental R02C", "R01M.R01_Id = R02C.R01_User_Id AND R01M.R01_seq = 0", "LEFT");
		$this->db->join("R01_note R01note", "R01note.R01_Id = R01M.R01_Id", "LEFT");

		$this->create_condition($params);

		$this->db->order_by('R01R.seqno');
		$this->db->order_by('R01M.R01_seq');
		//$this->db->order_by('R01R.R01_Category_Flg');
		//$this->db->order_by('R01R.R01_Id');
		//$this->db->order_by('R01M.R01_seq');

		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	private function create_condition($params)
	{
		if (!empty($params['R01_Test_Flg'])) {
			$this->db->where("R01R.R01_Test_Flg", 0);
		}
		if (!empty($params['R01_Id'])) {
			$this->db->where("R01M.R01_Id", $params["R01_Id"]);
		}
		if (!empty($params['R01_Name'])) {
			$this->db->like("R01M.R01_Name", $params["R01_Name"]);
		}
		if (!empty($params['R01_Roma_Last'])) {
			$this->db->like("R01M.R01_Roma_Last", $params["R01_Roma_Last"], "BOTH");
		}
		if (!empty($params['R01_Roma_First'])) {
			$this->db->like("R01M.R01_Roma_First", $params["R01_Roma_First"], "BOTH");
		}
		if (!empty($params['R01_Email'])) {
			$this->db->where("R01M.R01_Email", $params["R01_Email"]);
		}
		if (!empty($params['R01_Branch_Cd'])) {
			$this->db->where("R01R.R01_Branch_Cd", $params["R01_Branch_Cd"]);
		}
		if ($params['R01_Login_Flg'] != '') {
			$this->db->where("R01R.R01_Login_Flg", $params["R01_Login_Flg"]);
		}
		if ($params['R01_Entry_Flg'] != '') {
			$this->db->where("R01M.R01_Entry_Flg", $params["R01_Entry_Flg"]);
		}
		if ($params['R01_reentry'] != '') {
			$this->db->where("R01R.R01_reentry", $params["R01_reentry"]);
		}
	}
}
