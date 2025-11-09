<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Reserve_mo extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	//==============================================
	// 本人情報取得
	//==============================================
	public function get_common_info($R01_Id)
	{
		$this->db->select("*");
		$this->db->from("R01_Reserver");
		$this->db->where("R01_Id", $R01_Id);
		$query = $this->db->get();
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	public function get_note($R01_Id)
	{
		$this->db->select("*");
		$this->db->from("R01_note");
		$this->db->where("R01_Id", $R01_Id);
		$query = $this->db->get();
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}
	public function save_note($data)
	{
		//var_dump($data);
		$this->db->replace("R01_note", $data);
		return $this->db->last_query();
	}

	public function save_chargepax($data)
	{
		//var_dump($data);
		$charge['R01_Charge_Invites'] = $data['R01_Charge_Invites'];
		$this->db->where('R01_Id', $data['R01_Id']);
		$this->db->update('R01_Reserver', $charge);

		return $this->db->affected_rows();
	}

	public function get_reserver_info($R01_Id)
	{
		$this->db->select("*");
		$this->db->from("R01_Member");
		$this->db->where("R01_Id", $R01_Id);
		$this->db->where("R01_seq", '0');
		$query = $this->db->get();
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	//　本人情報更新
	//==============================================
	public function update_reserver($reserve)
	{
		$this->db->where('R01_Id', $reserve['R01_Id']);
		$this->db->update('R01_Reserver', $reserve);

		return $this->db->affected_rows();
	}

	//==============================================
	//　本人情報バックアップ
	//==============================================
	public function backup_reserver($reserve)
	{
		$this->db->insert('R01_Reserver_Backup', $reserve);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	//==============================================
	// 同伴者情報取得（全９名）
	//==============================================
	public function get_all_members_info($R01_Id)
	{
		$this->db->select("*");
		$this->db->from("R01_Member");
		$this->db->where("R01_Id", $R01_Id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->select("R01M.*");
		$this->db->from("(SELECT 1 seq UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) SEQ");
		$this->db->join("($sub_query) R01M", "SEQ.seq = R01M.R01_seq", "LEFT");

		$this->db->order_by("SEQ.seq");
		$query = $this->db->get();
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}

	//==============================================
	// 同伴者情報取得（登録済分）
	//==============================================
	public function get_members_info($R01_Id, $R01_seq = '')
	{
		$this->db->select("*");
		$this->db->from("R01_Member");
		$this->db->where("R01_Id", $R01_Id);
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
	//　同伴者情報登録
	//==============================================
	public function add_member($member)
	{
		$this->db->insert('R01_Member', $member);
		return $this->db->affected_rows();
	}

	//==============================================
	//　同伴者情報更新
	//==============================================
	public function update_member($member)
	{
		$this->db->where('R01_Id', $member['R01_Id']);
		$this->db->where('R01_seq', $member['R01_seq']);
		$this->db->update('R01_Member', $member);
		// echo $this->db->last_query();
		// exit;
		return $this->db->affected_rows();
	}

	//==============================================
	//　同伴者情報バックアップ
	//==============================================
	public function backup_member($member)
	{
		$this->db->insert('R01_Member_Backup', $member);
		return $this->db->affected_rows();
	}

	//==============================================
	//　同伴者情報削除
	//==============================================
	public function delete_members($R01_Id, $R01_seq = '')
	{
		$this->db->where('R01_Id', $R01_Id);
		if ($R01_seq != '') {
			$this->db->where("R01_seq", $R01_seq);
		}
		$this->db->delete('R01_Member');
		return $this->db->affected_rows();
	}
}
