<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Admin_mo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * 登録ＩＤとパスワードが存在かどうかチェック
	 */
	public function isExistIdAndPassword($r01_Id, $r01_Password)
	{
		$sql = "SELECT * FROM C00_Charger WHERE  Charger_Id= '" . trim($r01_Id) . "' AND  Charger_Password= '" . trim($r01_Password) . "'";
		$query = $this->db->query($sql);
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}
	public function getChargerTypeById($r01_Id)
	{
		$sql = "SELECT * FROM C00_Charger WHERE  Charger_Id= '" . trim($r01_Id) . "'";
		$query = $this->db->query($sql);
		$query_arr = $query->row_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr;
		} else {
			return NULL;
		}
	}
}
