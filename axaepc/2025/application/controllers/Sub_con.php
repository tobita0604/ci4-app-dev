<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_con extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('session_helper');
		$this->load->library('session');
		$this->load->model('entry_mo');
	}

	public function tour()
	{
		if (check_login_user_session()) {
			$R00_Id = $this->session->userdata('user_data');
			$data = $this->entry_mo->get_reserver_info($R00_Id);
			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('tour_vi');
			$this->load->view('aside_vi', $data);
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect('http://aw.knt.co.jp/netz/');
		}
	}
	public function hotel()
	{
		if (check_login_user_session()) {
			$R00_Id = $this->session->userdata('user_data');
			$data = $this->entry_mo->get_reserver_info($R00_Id);
			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('hotel_vi');
			$this->load->view('aside_vi', $data);
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect('http://aw.knt.co.jp/netz/');
		}
	}
	public function tetuzuki()
	{
		if (check_login_user_session()) {
			$R00_Id = $this->session->userdata('user_data');
			$data = $this->entry_mo->get_reserver_info($R00_Id);
			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('tetuzuki_vi');
			$this->load->view('aside_vi', $data);
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect('http://aw.knt.co.jp/netz/');
		}
	}
	public function kanko()
	{
		if (check_login_user_session()) {
			$R00_Id = $this->session->userdata('user_data');
			$data = $this->entry_mo->get_reserver_info($R00_Id);
			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('kanko_vi');
			$this->load->view('aside_vi', $data);
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect('http://aw.knt.co.jp/netz/');
		}
	}
	public function cebu()
	{
		$R00_Id = $this->session->userdata('user_data');
		$data = $this->entry_mo->get_reserver_info($R00_Id);
		if (check_login_user_session()) {
			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('cebu_vi');
			$this->load->view('aside_vi', $data);
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect('http://aw.knt.co.jp/netz/');
		}
	}
	public function whatsnew()
	{
		$R00_Id = $this->session->userdata('user_data');
		$data = $this->entry_mo->get_reserver_info($R00_Id);
		if (check_login_user_session()) {
			$this->load->view('head_vi');
			$this->load->view('header_vi', $data);
			$this->load->view('whatsnew_vi');
			$this->load->view('aside_vi', $data);
			$this->load->view('footer_vi');

			$this->load->view('last_vi');
		} else {
			redirect('http://aw.knt.co.jp/netz/');
		}
	}
}
