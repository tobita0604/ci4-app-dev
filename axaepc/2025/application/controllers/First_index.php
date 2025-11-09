<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First_index extends CI_Controller {

	/**
	 * コンストラクタ
	 */
	function __construct()
	{
		date_default_timezone_set('Asia/Tokyo');
    	parent::__construct();
    	$this->load->library('session');
    	$this->load->helper('url');
	}
	
	public function index(){
		$data = NULL;
	    if(isset($_POST['netID'])){
	        $data['netID'] = $this->input->post('netID');
	    }			
		$this->load->view('first_index', $data);   
	}
	 public function login(){
		$netID = !isset($_POST['netID'])?"":$_POST['netID'];
	
		if (($netID == "") ||($netID == NULL) || ($netID != "netz2017")) { 
            $data['messager'] = '認証に失敗しました。ログインIDをお確かめください。';
            $this->load->view('first_index', $data);
            return;
		} else {
				$this->session->set_userdata('netID',$netID);
				date_default_timezone_set('Asia/Tokyo');
				$R00_last_login_date = date('Y-m-d H:i:s');
				redirect(base_url("index_con"));
				return;
		}
	 }
	
}
