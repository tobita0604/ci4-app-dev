<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Async_con extends CI_Controller {
	private $current_date;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url' );	
		$this->load->helper('session_helper');
		$this->load->helper('common_helper');
		$this->load->library('session');
		$this->load->library('convert_format');
		$this->load->library('email');
		$this->load->model('reserve_mo');
		$this->current_date = date('Y-m-d H:i:s');
	}
	
	public function image_save() {
		$id = $_POST['id'];
		$seq = $_POST['seq'];
		$type = $_POST['type'];

		if(empty($msg)){
			if (isset($_FILES["Img_File"]))
			{
				if($_FILES["Img_File"]["name"] != ""){
					$maxFileSize = 10 * 1000 * 1000; //MB
					if($_FILES["Img_File"]["size"] > ($maxFileSize * 1000 * 1000)){
						echo "(ERR)アップロードファイルは10MB以下のサイズをご用意ください。" ;
						$errors=1;
						exit;
					}else{
						$filename = stripslashes($_FILES["Img_File"]["name"]);
						$extension = get_extension($filename);
						$extension = strtolower($extension);
						if (($extension != "jpg") && ($extension != "jpeg")  && ($extension != "pdf")){
							echo "(ERR)アップロードファイルはJPG/JPEG/PDFでご用意ください。" ;
							$errors=1;
							exit;
						} else {
							$newname="upload/".$type.'/'.uniqid($id."_".$seq."_").".".$extension;
							$tmp_name = $_FILES["Img_File"]["tmp_name"];
							move_uploaded_file($tmp_name, $newname);
							
							echo $newname;
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
		} else {
			echo $msg;
		}

	}

}