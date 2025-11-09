<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_validate_lib
{
    private $CI;
    public function __construct()
    {
        $this->CI = & get_instance ();
        $this->CI->load->library('form_validation');
        $this->CI->form_validation->set_error_delimiters('<div class="error-msg"><label style="color: red;">※', '</label></div>');
    }

    public function input_ip_setting(){
        $this->CI->form_validation->set_rules('data[address_name]', '名称', 'required');
        $this->CI->form_validation->set_rules('data[ip_address]', 'IPアドレス', 'required|valid_ip');
        $this->set_message();
    }

    private function set_message()
    {
        $this->CI->form_validation->set_message('required', '{field} は必須項目です。');
        $this->CI->form_validation->set_message('valid_email', '{field} を正しく入力してください。');
        $this->CI->form_validation->set_message('valid_name', '{field} を正しく入力してください。');
        $this->CI->form_validation->set_message('matches', '{field} は一致しません。正しく入力してください。');
        $this->CI->form_validation->set_message('alpha_numeric_spaces', '{field} は半角英数で入力してください。');
        $this->CI->form_validation->set_message('alpha_numeric', '{field} は半角英数で入力してください。');
        $this->CI->form_validation->set_message('min_length', '{field} は{param}文字以上で入力してください。');
        $this->CI->form_validation->set_message('valid_time', '{field} は正しく入力してください。');
        $this->CI->form_validation->set_message('valid_ip', '{field}を正しく入力してください。');
        $this->CI->form_validation->set_message('kana', '{field}はカナで入力してください。');
        $this->CI->form_validation->set_message('alpha', '{field}はローマ字で入力してください。');
        $this->CI->form_validation->set_message('valid_date', '{field}は正しく入力してください。');
        $this->CI->form_validation->set_message('integer', '{field}は英数字半角で入力してください。');
        $this->CI->form_validation->set_message('password_pattern', '{field}を正しく入力してください。(英大文字、英小文字、数字、記号が各１文字以上必要です）');
	}
}
