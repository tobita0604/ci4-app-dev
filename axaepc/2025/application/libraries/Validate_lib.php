<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Validate_lib
{
    private $CI;
    public function __construct()
    {
        $this->CI = & get_instance ();
        $this->CI->load->library('form_validation');
        $this->CI->form_validation->set_error_delimiters('<div class="error-msg"><label style="color: red;">※', '</label></div>');
    }

    public function checkCarRental(){
        $this->CI->form_validation->set_rules('reserve[R01_Class]', '予約クラス', 'required');
        $this->CI->form_validation->set_rules('reserve[R01_FromDriveDate]', '貸出日付', 'required');
        //$this->CI->form_validation->set_rules('reserve[R01_FromDriveTime]', '貸出時間', 'required');
        //$this->CI->form_validation->set_rules('reserve[R01_ToDriveDate]', '返却日付', 'required');
        //$this->CI->form_validation->set_rules('reserve[R01_ToDriveTime]', '返却時間', 'required');
        $this->CI->form_validation->set_rules('reserve[R01_Name_Kanji]', '運転者氏名（漢字）', 'required');
        $this->CI->form_validation->set_rules('reserve[R01_Name_Kana]', '運転者氏名（カナ）', 'required|kana_full');
        $this->CI->form_validation->set_rules('reserve[R01_Driver_License_No]', '免許証番号', 'required');
        $this->CI->form_validation->set_rules('reserve[R01_Driver_License_Expiry]', '有効期限', 'required');
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
        $this->CI->form_validation->set_message('numeric', '{field} は半角数字で入力してください。');
        $this->CI->form_validation->set_message('min_length', '{field} は{param}文字以上で入力してください。');
        $this->CI->form_validation->set_message('exact_length', '{field} は{param}文字で入力してください。');
        $this->CI->form_validation->set_message('valid_time', '{field} は正しく入力してください。');
        $this->CI->form_validation->set_message('valid_ip', '{field}を正しく入力してください。');
        $this->CI->form_validation->set_message('kana', '{field}はカナで入力してください。');
        $this->CI->form_validation->set_message('kana_full', '{field}はカナで入力してください。');
        $this->CI->form_validation->set_message('day_from_to', '貸出日付と返却日付は正しく入力してください。');
        $this->CI->form_validation->set_message('alpha', '{field}はローマ字で入力してください。');
        $this->CI->form_validation->set_message('valid_date', '{field}は正しく入力してください。');
        $this->CI->form_validation->set_message('integer', '{field}は英数字半角で入力してください。');
        $this->CI->form_validation->set_message('password_pattern', '{field}を正しく入力してください。(英大文字、英小文字、数字、記号が各１文字以上必要です）');
	}
}
