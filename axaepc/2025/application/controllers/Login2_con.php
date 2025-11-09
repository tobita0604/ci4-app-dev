<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Login2_con extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('session_helper');
		$this->load->library('session');	
		$this->load->model('login_mo');			
	}
	
	public function index() {
		if($this->session->userdata('accpswd') == 'axa2025' || $this->input->post('accpswd') == 'axa2025') {
			$this->session->set_userdata('accpswd', 'axa2025');
			$this->load->view('head_vi');
			$this->load->view('login2_vi');
		} else {
			redirect(DIRECT_ACCESS_URL);
		}
	}
	
	public function login(){
		$data = array();
        $R00_Id = !isset($_POST['R00_Id'])?"":$_POST['R00_Id'];
        $R00_Password = !isset($_POST['R00_Password'])?"":$_POST['R00_Password'];
		
		if($R00_Id == ''){
			$data['R00_Id_Err'] = '※ログインIDを入力してください。';
		}
		if($R00_Password == ''){
			$data['R00_Password_Err'] = '※パスワードを入力してください。';
		}
		if(count($data)>0){
			$this->load->view('head_vi');
			$this->load->view('login_vi', $data);
			return;
		}else{
			$user_data = $this->login_mo->isExistUser($R00_Id);
			if(count($user_data)>0){
				if($user_data['R01_Login_Flg'] == 0){
					$data['R00_Id']=$R00_Id;
					$this->load->view('create_password_vi',$data);
				}else{
					$user_exist_flg = $this->login_mo->isExistUserByPassword($R00_Id,$R00_Password);
					if($user_exist_flg){
						$R00_reserve['R01_Id'] = $R00_Id;
						$R00_reserve['R01_Last_Login_Date'] =  date('Y-m-d H:i:s');
						$setPassFlg = $this->login_mo->updateReserveById($R00_reserve);
						$this->session->set_userdata('user_data',$R00_Id);
						redirect('register_con');
						
						
					}else{
						$data['messager'] = '認証に失敗しました。ログインIDとパスワードをお確かめください。';
						$this->load->view('head_vi');
						$this->load->view('login2_vi', $data);
						return;
					}						
				}
			}else{
				$data['messager'] = '認証に失敗しました。ログインIDとパスワードをお確かめください。';
				$this->load->view('head_vi');
				$this->load->view('login2_vi', $data);
				return;
			}
		}
	}
	//==================================
	//パスワード作成
	//==================================
	public function create_password(){
		$R00_Password = $this->input->post('R00_Password');
		$R00_Id = $this->input->post('R00_Id');
		$R00_Password_con = $this->input->post('R00_Password_con');
		if($R00_Password != '' && $R00_Password_con !=''){
			if($R00_Password ==  $R00_Password_con){
				$R00_reserve['R01_Id'] = $R00_Id;
				$R00_reserve['R01_Password'] = $R00_Password;
				$R00_reserve['R01_Login_Flg'] = 1;
				$R00_reserve['R01_First_Login_Date'] =  date('Y-m-d H:i:s');
				$R00_reserve['R01_Last_Login_Date'] =  date('Y-m-d H:i:s');
				$setPassFlg = $this->login_mo->updateReserveById($R00_reserve);
				if($setPassFlg){
					$this->session->set_userdata('user_data',$R00_Id);
					redirect(base_url("register_con"));
				}
				$data['messager'] ="※パスワードが設定できません。";	
			}else{
				$data['messager'] ="※パスワードまたは確認パスワードが異なります。";	
			}
		}else{
			$data['messager'] ="※パスワード、確認パスワードを入力してください。";			
		}
		$data['R00_Id']= $R00_Id;
		
		$this->load->view('create_password_vi',$data);
	}	
	//==================================
	//ログアウト
	//==================================
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url("login_con"));
	}
	//==================================
	//パスワード忘れ
	//==================================
	public function forget_password(){
		$data =array();
		$data['R00_Id'] =""; 
		$data['birth_yy'] ="";
		$data['birth_mm'] ="";
		$data['birth_dd'] ="";
		if(isset($_POST['password_reset'])){
			$data = $this->input->post();
			$R00_Id = $data['R00_Id'];
			$R00_Birth_Date = $data['birth_yy'].'-'.$data['birth_mm'].'-'.$data['birth_dd'];
			if($R00_Id==''){
				$data['R00_Id_Err'] = "※ログインIDを入力してください。";
			}else{
				$Exist_Flg = $this->login_mo->isExistUserByBirthday($R00_Id,$R00_Birth_Date);
				if($Exist_Flg){
					$Reserve['R01_Id']=$R00_Id;
					$Reserve['R01_Login_Flg']=0;
					$Reserve['R01_Password']='axa2018';
					$UpdateFlg = $this->login_mo->updateReserveById($Reserve);
					if($UpdateFlg){
						redirect(base_url("login_con"));							
					}else{
						$data['messager'] = "※パスワードリセットできません。。";
					}
				}else{
					$data['messager'] = "※ログインIDまたは生年月日が誤りです。";
				}
			}
		}		
		
		$this->load->view('forget_password_vi', $data);
	}
}