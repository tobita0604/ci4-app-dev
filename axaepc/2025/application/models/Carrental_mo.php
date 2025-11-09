<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class CarRental_mo extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'R01_Car_Rental';
    }

    //==============================================
    // レンタカー情報登録処理
    //==============================================
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //==============================================
    // レンタカー情報更新処理
    //==============================================
    public function update($data, $condition = [])
    {
        if (!empty($condition)) {
            foreach ($condition as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    //==============================================
    // レンタカー情報削除処理
    //==============================================
    public function delete($R01_User_Id)
    {
        $this->db->where('R01_User_Id', $R01_User_Id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    //==============================================
    // レンタカー情報単数取得処理
    //==============================================
    public function getCarRental($data = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        // $this->db->where('deleted is null');
        $query = $this->db->get();
        $getCarRental = $query->row_array();
        return $getCarRental;
    }

    //==============================================
    // レンタカー情報複数取得処理
    //==============================================
    public function getCarRentals($data = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        // $this->db->order_by('rank', 'ASC');
        $query = $this->db->get();
        $getCarRentals = $query->result_array();
        return $getCarRentals;
    }

    //==============================================
    // レンタカー情報フィールド取得処理
    //==============================================
    public function getFields()
    {
        return $this->db->list_fields($this->table);
    }

    //==============================================
    // 管理画面レンタカー情報検索
    //==============================================
    public function searchCarRentals($data)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data['R01_User_Id'])) {
            $this->db->like("R01_User_Id", $data["R01_User_Id"]);
        }
        if (!empty($data['R01_Name_Kanji'])) {
            $this->db->like("R01_Name_Kanji", $data["R01_Name_Kanji"]);
        }
        if (!empty($data['R01_Name_Kana'])) {
            $this->db->like("R01_Name_Kana", $data["R01_Name_Kana"]);
        }
        if (!empty($data['R01_Class'])) {
            $this->db->where("R01_Class", $data["R01_Class"]);
        }
        if (!empty($data['R01_Schedule'])) {
            $this->db->where("R01_Schedule", $data["R01_Schedule"]);
        }
        if (!empty($data['R01_Child_Seat'])) {
            $this->db->where("R01_Child_Seat", $data["R01_Child_Seat"]);
        }
        $query = $this->db->get();
        $searchCarRentals = $query->result_array();
        return $searchCarRentals;
    }
}
