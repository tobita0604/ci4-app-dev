<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_WARNING);
class Download_con extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('common_helper');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('download');
		$this->load->library('session');
		$this->load->config('config');
		$this->load->model('login_mo');
		$this->load->model('download_mo');
	}
	
	public function index() {
		redirect(base_url("download_con/photo"));
	}
	public function photo() {
		$admin_id = $this->session->userdata('admin_id_session');
		
		if (isset($admin_id)) {
			$data['searchKey'] = $this->get_init_search_key();
			$data['result'] = NULL;
			$data['count_resever'] = "";
			
			if(isset($_POST['searchbtn'])){
				$data['searchKey'] = $this->get_search_key();
				$data['result'] = $this->download_mo->search_photo($data['searchKey']);
				$data['count_resever'] = count($data['result']);
			}
			
			$this->load->view('head_vi');
			$this->load->view('header_vi');
			$this->load->view('download_photo_vi' , $data);
			$this->load->view('last_vi');
			
			
			
		} else {
			redirect(base_url("admin_con"));
		}
	}
	
	private function get_init_search_key() {
		return array(
			'R01_Id' => $this->input->post('R01_Id'),
			'R01_Test_Flg' => '1'
		);
	}
	
	private function get_search_key() {
		$searchKey =  $this->input->post();
		if(!isset($searchKey['R01_Test_Flg'])) {
			$searchKey['R01_Test_Flg'] = '1';
		}
		return $searchKey;
	}
	
	/**
	 * 一括ダウンロード
	 * 
	 */
	public function download_photo($type) { 
		$admin_id = $this->session->userdata('admin_id_session');
		
		if (isset($admin_id)) {
			$searchKey = $this->get_init_search_key();
			$data_search = $this->download_mo->search_photo($searchKey);
			$filename = 'photo.zip';
			$foldername = 'photo';
			$col = 'R01_Brochure_Img';
			$zip = new ZipArchive();
		
			
			if ($zip->open($filename, ZIPARCHIVE::CREATE|ZIPARCHIVE::OVERWRITE)==TRUE) {
				$zip->addEmptyDir($foldername);
				if ($data_search != NULL) {
					foreach ($data_search as $tmpdata){
						if(!empty($tmpdata[$col])) {
							$shortname = download_name($tmpdata);
							$file=APPPATH.'../'.$tmpdata[$col];
							$file_data = $foldername."/".$shortname;
							$file_data = mb_convert_encoding($file_data, 'SJIS-win', 'UTF-8') ;
							$content = file_get_contents($file);
							$zip->addFromString($file_data , $content);
						}
					}
				}
				$zip->close();
			} 
			
			force_download($filename, NULL);
			
			return;
		}
	}
	
	
}