<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Entry_mo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_R01_Reserver($R01_Reserver)
	{
		$this->db->insert('R01_Resever', $R01_Reserver);
	}

	public function get_reserver_info($R00_Id)
	{
		$sql = "SELECT * FROM R00_Reserve where R00_Id = '" . $R00_Id . "'";
		$query = $this->db->query($sql);
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr[0];
		} else {
			return NULL;
		}
	}
	//=============================================
	//予約データ更新
	//==============================================
	public function UpdateReserveData($reserve)
	{
		$this->db->where('R00_Id', $reserve['R00_Id']);
		$this->db->update('R00_Reserve', $reserve);
		return $this->db->affected_rows();
	}

	/**
	 *
	 *画像ファイル名取得
	 */
	public function get_imgfilename()
	{
		$sql = "SELECT * FROM M01_ImageFileNo where M01_Key='1'";
		$query = $this->db->query($sql);
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr[0];
		} else {
			return NULL;
		}
	}
	/**
	 * 画像がデーターベースに保存する
	 * @param 画像パース $imageFile
	 * @param ユーザー登録ＩＤ $userId
	 */
	public function saveImageToDB($imageFile, $imageName, $userId)
	{
		$sql = "UPDATE R00_Reserve";
		$sql .= " SET R00_Passport_Img_File = '" . $imageFile . "' ,";
		$sql .= " R00_Passport_Upload_Name = '" . $imageName . "' ";
		$sql .= " WHERE R00_Id ='" . trim($userId) . "'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	/*
	 * ユーザーの画像を取得
	 */
	public function getImageFromDB($userId)
	{
		$sql = "SELECT R00_Passport_Img_File , OCTET_LENGTH(R00_Passport_Img_File) FROM R00_Reserve WHERE R00_Id ='" . trim($userId) . "'";
		$query = $this->db->query($sql);
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr[0];
		} else {
			return NULL;
		}
	}

	public function getImageNameFromDB($userId)
	{
		$sql = "SELECT R00_Passport_Upload_Name FROM R00_Reserve WHERE R00_Id ='" . trim($userId) . "'";
		$query = $this->db->query($sql);
		$query_arr = $query->result_array();
		if ($query_arr && count($query_arr) > 0) {
			return $query_arr[0];
		} else {
			return NULL;
		}
	}
}
