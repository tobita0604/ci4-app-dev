<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Entry_con extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct ();
		$this->load->helper( 'url' );	
		$this->load->helper( 'session_helper' );
		$this->load->helper( 'common_helper' );
		$this->load->library ( 'session' );
		$this->load->library ( 'convert_format' );
		$this->load->library('email');
		$this->load->model('entry_mo');
		
	}
	
	public function index() {
			
			if(check_login_user_session()){
				$R00_Id = $this->session->userdata('user_data');	
				$data = $this->entry_mo->get_reserver_info($R00_Id);
			//var_dump($data);
				$this->load->view('head_vi');
				$this->load->view('header_vi',$data);
				$this->load->view('entry_script_vi');
				$this->load->view('entry_vi',$data);
				$this->load->view('aside_mypage_vi');
				$this->load->view('footer_vi');
				
				$this->load->view('last_vi');
			}else{
				redirect(base_url("login_con"));
			}			
		
	}
	//==============================
	//確認画面
	//==============================
	public function confirm() {
		
				
			if(check_login_user_session()){
				$data['entry'] = $this->getPostData();
				$R00_Id = $this->session->userdata('user_data');
				$data['R00_Id'] = $R00_Id;				
				$data_side = $this->entry_mo->get_reserver_info($R00_Id);				
				$this->load->view('head_vi');
				$this->load->view('entry_script_vi');
				$this->load->view('header_vi',$data);							
				$this->load->view('confirm_vi', $data);				
				$this->load->view('aside_vi',$data_side);
				$this->load->view('footer_vi');
				
				$this->load->view('last_vi');							
			}else{
				redirect(base_url("login_con"));
			}			
		
	}
	public function end() {

			mb_language("Japanese");
			mb_internal_encoding("UTF-8");				

			if(check_login_user_session()){
				$entry = $this->getPostData();
				$reserve = $this->setEntrySaveData($entry);	 		
				$this->entry_mo->UpdateReserveData($reserve);
				if($reserve['R00_kibou'] != "XX") {
				/*お客さんのメールとbcc KNT*/
				//$this->email->from('knt-esg213@or.knt.co.jp', mb_encode_mimeheader('【2017年10-11月　店舗の絆強化コンテスト　報奨旅行】','ISO-2022-JP'));
				$this->email->from('knt-esg213@or.knt.co.jp', '【2017年10-11月　店舗の絆強化コンテスト　報奨旅行】');
				$this->email->to($reserve['R00_Email']); 
				//$this->email->bcc('awstour-ecc3@or.knt.co.jp'); 
			
				$this->email->subject("【2017年10-11月　店舗の絆強化コンテスト　報奨旅行】 お申込み受付しました");
				$body = "";
				//$body .= trim($reserve['R01_Name_Kanji_Sei'])."　".trim($reserve['R01_Name_Kanji_Mei'])."様\r\n";
				$body .= "\r\n";
				$body .= "{unwrap}この度は、「2017年10-11月　店舗の絆強化コンテスト　報奨旅行」にご登録いただきまして{/unwrap}\r\n";
				$body .= "{unwrap}有難うございました。{/unwrap}\r\n";
				$body .= "\r\n";
				$body .= "\r\n";
				$body .= "{unwrap}専用サイトでの出欠の登録が完了いたしました。{/unwrap}\r\n";
				$body .= "\r\n";
				$body .= "■パスポートコピーご提出のお願い\r\n";
				$body .= "{unwrap}ツアーサイトにログインの上、「マイページ」もしくは「パスポート画像のアップロード」ボタンからパスポートの顔写真ページの画像キャプチャを、PDFもしくはJPEGファイルにてアップロードしてください。{/unwrap}\r\n";
				$body .= "{unwrap}パスポートを申請中の方は、受領でき次第、アップロードしてください。申請から受領までに、通常1週間程度(土・日・休日を除く)かかります。遅くても、12月19日（火）までには申請をお済ませの上、12月27日（水）までに、ツアーサイトのマイページからアップロードしてください。{/unwrap}\r\n";

				$body .= "\r\n";
				$body .= "{unwrap}■入力内容に変更がある場合{/unwrap}\r\n";
				$body .= "{unwrap}近畿日本ツーリスト　専用Eメールknt-esg213@or.knt.co.jp　宛てに{/unwrap}\r\n";
				$body .= "{unwrap}ご連絡ください。{/unwrap}\r\n";
				$body .= "\r\n";
				$body .= "{unwrap}■登録内容を確認する場合{/unwrap}\r\n";
				$body .= "{unwrap}ツアーサイトにログインの上、「マイページ」より登録内容をご確認ください。{/unwrap}\r\n";
				$body .= "\r\n";
				$body .= "{unwrap}■今後のスケジュール{/unwrap}\r\n";
				$body .= "{unwrap}2018年1月22日（月）頃　最終のご案内（決定航空便、集合時間等）を専用サイトにて{/unwrap}\r\n";
				$body .= "{unwrap}ご案内いたします。トップページよりログインの上、「マイページ」よりご確認ください。{/unwrap}\r\n";
				$body .= "\r\n";
				
				
				$body .= "\r\n";

				$body .= "\r\n";
				$body .= "{unwrap}以上、宜しくお願い申しあげます。{/unwrap}\r\n";
				


				$body .= "\r\n";
				$body .= "{unwrap}【お問い合わせ】{/unwrap}\r\n";
				$body .= "{unwrap}============================================================================{/unwrap}\r\n";
				$body .= "{unwrap} 近畿日本ツーリスト株式会社　第３営業支店{/unwrap}\r\n";
				$body .= "{unwrap}「2017年10-11月　店舗の絆強化コンテスト　報奨旅行」係{/unwrap}\r\n";
				$body .= "{unwrap}営業時間：月-金　09:300〜18:00　土日祝日休業（12月29日～1月3日まで休業）{/unwrap}\r\n";
				$body .= "{unwrap}TEL　：　03-6891-9303{/unwrap}\r\n";
				$body .= "{unwrap}FAX　：　03-6891-9403{/unwrap}\r\n";
				$body .= "Eメール :{unwrap} knt-esg213@or.knt.co.jp{/unwrap}\r\n";
				
				
				
				
				$body .= "============================================================================\r\n";
				$body .= "\r\n";
				$this->email->message($body);	

				$this->email->send();
				}
				
				
				
				$R00_Id = $this->session->userdata('user_data');
				$data = $this->entry_mo->get_reserver_info($R00_Id);
				$this->load->view('head_vi');
				$this->load->view('confirm_script_vi');
				$this->load->view('header_vi',$data);						
				$this->load->view('end_vi');				
				$this->load->view('aside_vi',$data);
				$this->load->view('footer_vi');
				
				$this->load->view('last_vi');							
			}else{
				redirect(base_url("login_con"));
			}			
		
	}
	//=================================================
	//データ作成
	//=================================================
	private function getPostData(){
		$entries = $_POST;
		foreach($entries as $key => $val){
			$data[$key] = $val;
		}
		return $data;
	}
	private function setEntrySaveData($entry){
		$entry['R00_Id']=$this->session->userdata('user_data');
		if($entry['course']==0){
			$entry['R00_kibou']='XX';			
		}else{
						
			unset($entry['R00_Email_conf']);
			
			if($entry['R00_Nationality']== "0"){
			$entry['R00_Nationality']=$entry['R00_Nationality_other'];			
			}
		}
		$entry['R00_Update_date']=  date('Y-m-d H:i:s');
		$entry['R00_Entry_flag'] = 1;
		unset($entry['R00_Nationality_other']);		
		unset($entry['R00_Passport_Img_File']);		
				
		unset($entry['R00_Passport_Upload_Name']);	
		unset($entry['course']);		
		return $entry;
	}
/*
	*画像アップロード
	*
	*/
	public function image_save()
	{
	$R00_Id = $this->session->userdata('user_data');
		
		if (isset($_FILES["R00_Passport_Img_File"]))
		{
			if($_FILES["R00_Passport_Img_File"]["name"] != ""){
				$maxFileSize = 10 * 1000 * 1000; //MB
				if($_FILES["R00_Passport_Img_File"]["size"] > ($maxFileSize * 1000 * 1000)){
					echo "(ERR)アップロードファイルはサイズ" ;
					$errors=1;
					exit;
				}else{
					$filename = stripslashes($_FILES["R00_Passport_Img_File"]["name"]);
					$extension = $this->getExtension($filename);
					$extension = strtolower($extension);
					if (($extension != "jpg") && ($extension != "jpeg")  && ($extension != "pdf") ){
						echo "(ERR)アップロードファイルはJPG/JPEG/PDFでご用意ください。" ;
						$errors=1;
						exit;
					} else {
						
						// ファイル名変更
						$userdata = $this->entry_mo->get_reserver_info($R00_Id);
						//$filename = $R00_Id ."_" . $userdata['R00_Sei']. $userdata['R00_Name']."." . $extension;
						$filename = $R00_Id ."." . $extension;
						// バイナリデータ
						$fp = fopen($_FILES["R00_Passport_Img_File"]["tmp_name"], "rb");
						$imgdat = fread($fp, filesize($_FILES["R00_Passport_Img_File"]["tmp_name"]));
						fclose($fp);
						$imgdat = addslashes($imgdat);
						$this->entry_mo->saveImageToDB($imgdat , $filename , $R00_Id);
						//画像フォルダ保存
						
						$newname="pass_img/".$filename;
						$tmp_name = $_FILES["R00_Passport_Img_File"]["tmp_name"];
						move_uploaded_file($tmp_name, $newname);
						
						echo $filename;
					}
				}
			} else {
				echo "(ERR)アップロードファイルを選んでください！";
				$errors =1;
				exit;
			}
		} else {
			
			echo "(ERR)アップロードファイルを選んでください！";
		}
	}	
	public function image_save2() {
		$R00_Id = $_POST['userid'];
		
		if (isset($_FILES["R00_Passport_Img_File"]))
		{
			if($_FILES["R00_Passport_Img_File"]["name"] != ""){
				$maxFileSize = 10 * 1000 * 1000; //MB
				if($_FILES["R00_Passport_Img_File"]["size"] > ($maxFileSize * 1000 * 1000)){
					echo "(ERR)アップロードファイルはサイズ" ;
					$errors=1;
					exit;
				}else{
					$filename = stripslashes($_FILES["R00_Passport_Img_File"]["name"]);
					$extension = $this->getExtension($filename);
					$extension = strtolower($extension);
					if (($extension != "jpg") && ($extension != "jpeg")  && ($extension != "pdf") ){
						echo "(ERR)アップロードファイルはJPG/JPEG/PDFでご用意ください。" ;
						$errors=1;
						exit;
					} else {
						
						// ファイル名変更
						//$userdata = $this->entry_mo->get_reserver_info($R00_Id);
						//$filename = $R00_Id ."_" . $userdata['R00_Sei']. $userdata['R00_Name']."." . $extension;
						$filename = $R00_Id ."." . $extension;
						// バイナリデータ
						$fp = fopen($_FILES["R00_Passport_Img_File"]["tmp_name"], "rb");
						$imgdat = fread($fp, filesize($_FILES["R00_Passport_Img_File"]["tmp_name"]));
						fclose($fp);
						$imgdat = addslashes($imgdat);
						$this->entry_mo->saveImageToDB($imgdat , $filename , $R00_Id);
						//画像フォルダ保存
						
						$newname="pass_img/".$filename;
						$tmp_name = $_FILES["R00_Passport_Img_File"]["tmp_name"];
						move_uploaded_file($tmp_name, $newname);
						
						echo $filename;
					}
				}
			} else {
				echo "(ERR)アップロードファイルを選んでください！";
				$errors =1;
				exit;
			}
		} else {
			
			echo "(ERR)アップロードファイルを選んでください！";
		}
	}
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}	

}