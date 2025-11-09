<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Total_mo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * ログインユーザ数集計
	 */
	public function getLoginData()
	{

		$sql = "SELECT count(R01_Id) as notlogin FROM R01_Reserver WHERE R01_Login_Flg = 0 AND R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$notlogin = $query->row_array();

		$sql = "SELECT count(R01_Id) as logined FROM R01_Reserver WHERE R01_Login_Flg <> 0 AND R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$logined = $query->row_array();

		$sql = "SELECT count(R01R.R01_Id) as entryed FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id AND R01M.R01_seq = 0
				WHERE R01M.R01_Entry_Flg = 1 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$entryed = $query->row_array();

		$sql = "SELECT count(R01_Id) as totalpax FROM R01_Reserver WHERE R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$totalpax = $query->row_array();

		return array($notlogin, $logined, $entryed, $totalpax);
	}

	/**
	 * ログインユーザ数集計
	 */
	public function getRegisterData()
	{
		$sql = "SELECT count(R01R.R01_Id) as entryedreserver FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 1 AND R01M.R01_seq = 0 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$entryedreserver = $query->row_array();
		$sql = "SELECT count(R01R.R01_Id) as notentryreserver FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 0 AND R01M.R01_seq = 0 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$notentryreserver = $query->row_array();

		$sql = "SELECT count(R01R.R01_Id) as entryedadultmember FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 1 AND R01M.R01_seq != 0 AND R01M.R01_Age > 19 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$entryedadultmember = $query->row_array();
//子供A（6～19）
		$sql = "SELECT count(R01R.R01_Id) as entryedchildmemberA FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 1 AND R01M.R01_seq != 0 AND R01M.R01_Age < 20 AND R01M.R01_Age > 5 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$entryedchildmemberA = $query->row_array();
//子供A（3～5）
		$sql = "SELECT count(R01R.R01_Id) as entryedchildmemberB FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 1 AND R01M.R01_seq != 0 AND R01M.R01_Age < 6 AND R01M.R01_Age > 2 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$entryedchildmemberB = $query->row_array();
//子供A（0～2）
		$sql = "SELECT count(R01R.R01_Id) as entryedchildmemberC FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 1 AND R01M.R01_seq != 0 AND R01M.R01_Age < 3 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$entryedchildmemberC = $query->row_array();

//未登録者
		$sql = "SELECT count(R01R.R01_Id) as notentrymember FROM R01_Reserver R01R 
				INNER JOIN R01_Member R01M ON R01R.R01_Id = R01M.R01_Id
				WHERE R01M.R01_Entry_Flg = 0 AND R01M.R01_seq != 0 AND R01R.R01_Test_Flg = 0";
		$query = $this->db->query($sql);
		$notentrymember = $query->row_array();

		return array($entryedreserver, $notentryreserver, $entryedadultmember, $entryedchildmemberA, $entryedchildmemberB, $entryedchildmemberC, $notentrymember);
	}
}
