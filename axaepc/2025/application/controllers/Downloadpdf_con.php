<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Downloadpdf_con extends CI_Controller {

	
//------------------------コンストラクタ------------------------
	public function __construct() {		
		parent::__construct ();
		ini_set("max_execution_time",0);
		$this->load->helper( 'url' );

		$this->load->library('session');
		$this->load->library('convert_format');		
		date_default_timezone_set("Asia/Tokyo");		
	}

	
//------------------------INDEX------------------------
	
	public function index() {
		$data['userDatas'] = "";
		$data['type'] = "user";
		$this->load->view('Pdf_schedule_template', $data);		
	
	}
	public function local_download() {

	}
}
