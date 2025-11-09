<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IpSetting extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('admin_validate_lib');
        $this->load->model("admin_admin_ip_mo");

    }

    /*
    *　初期表示
    */
    public function index()
    {
        // Check session
        $admin_id = $this->session->userdata('admin_id_session');

        if (isset($admin_id)) {
            $data['admins'] = $this->admin_admin_ip_mo->getAdmins();
            $this->load->view('head_vi');
            $this->load->view('header_vi');
            $this->load->view("ip_setting_vi", $data);
            $this->load->view('last_vi');
        } else {
            redirect(base_url("admin_con"));
        }
    }

    /*
    *　登録 入力画面
    */
    public function ipSettingRegist()
    {
        // Check session
        $admin_id = $this->session->userdata('admin_id_session');

        if (isset($admin_id)) {
            $this->load->view('head_vi');
            $this->load->view('header_vi');
            $this->load->view("ip_setting_regist_vi");
            $this->load->view('last_vi');
        } else {
            redirect(base_url("admin_con"));
        }
    }

    /*
    *　編集 入力画面
    */
    public function ipSettingEdit()
    {
        $id = $this->input->get('id');
        $data = $this->admin_admin_ip_mo->getAdmin(['id' => $id]);
        if (!empty($data)) {
            $this->load->view('head_vi');
            $this->load->view('header_vi');
            $this->load->view("ip_setting_edit_vi", compact('data'));
            $this->load->view('last_vi');
        } else {
            redirect(base_url('IpSetting'));
        }
    }

    /*
    *　登録 更新 実行
    */
    public function save()
    {
        if (!empty($this->input->post('data'))) {
            $data = $this->input->post('data');
            $this->admin_validate_lib->input_ip_setting();
            if ($this->form_validation->run() == true) {
                // 更新
                if (!empty($data['id'])) {
                    $this->admin_admin_ip_mo->update($data);
                    $this->session->set_flashdata('save_message', '更新しました。');
                    $this->session->set_flashdata('save_success', 'success');
                    // 登録
                } else {
                    $this->admin_admin_ip_mo->insert($data);
                    $this->session->set_flashdata('save_message', '登録しました。');
                    $this->session->set_flashdata('save_success', 'success');
                }
                redirect(base_url('IpSetting'));
            } else {
                if (!empty($data['id'])) {
                    $this->load->view('head_vi');
                    $this->load->view('header_vi');
                    $this->load->view("ip_setting_edit_vi", compact('data'));
                    $this->load->view('last_vi');
                } else {
                    $this->load->view('head_vi');
                    $this->load->view('header_vi');
                    $this->load->view("ip_setting_regist_vi", compact('data'));
                    $this->load->view('last_vi');
                }
            }
        } else {
            $this->session->set_flashdata('save_message', 'システムエラー');
            redirect(base_url('IpSetting'));
        }
    }

    /*
    *　削除 実行
    */
    public function adminDelete()
    {
        $id = $this->input->get('id');
        if (!empty($id)) {
            $ip = $this->admin_admin_ip_mo->getAdmin(['id' => $id]);
            if (!empty($ip)) {
                $ip['deleted'] = date('Y-m-d H:i:s');
                $this->admin_admin_ip_mo->update($ip);
                $this->session->set_flashdata('save_message', '削除しました。');
                $this->session->set_flashdata('save_success', 'success');
            }
        }
        redirect(base_url('IpSetting'));
    }
}
