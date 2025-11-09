<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Login_mo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//======================================
	//ユーザ存在確認
	//======================================
	public function isExistUser($R00_Id)
	{
		$this->db->select('*');
		$this->db->from('R01_Reserver');
		$this->db->where('R01_Id', $R00_Id);
		$query = $this->db->get();
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return null;
		}
	}
	//======================================
	//ユーザ存在確認 生年月日
	//======================================	
	public function isExistUserByBirthday($R00_Id, $R00_Birth_Date)
	{
		$this->db->select('*');
		$this->db->from('R01_Member');
		$this->db->where('R01_Id', $R00_Id);
		$this->db->where('R01_Birthdate', $R00_Birth_Date);
		$query = $this->db->get();
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return true;
		} else {
			return false;
		}
	}
	//======================================
	//ユーザ存在確認 パスワード
	//======================================
	public function isExistUserByPassword($R00_Id, $R00_Password)
	{
		$this->db->select('*');
		$this->db->from('R01_Reserver');
		$this->db->where('R01_Id', $R00_Id);
		$this->db->where('R01_Password', $R00_Password);
		$query = $this->db->get();
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return true;
		} else {
			return false;
		}
	}
	//=========================
	//パスワード作成
	//=========================
	public function updateReserveById($data)
	{
		$this->db->where('R01_Id', $data['R01_Id']);
		$this->db->update('R01_Reserver', $data);
		return $this->db->affected_rows();
	}
}
