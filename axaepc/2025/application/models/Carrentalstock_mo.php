<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class CarRentalStock_mo extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'R02_Car_Rental_Stock';
    }

    //==============================================
    // レンタカーストック情報登録処理
    //==============================================
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //==============================================
    // レンタカーストック情報更新処理
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
    // レンタカーストック情報単数取得処理
    //==============================================
    public function getCarRentalStock($data = [])
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
        $getCarRentalStock = $query->row_array();
        return $getCarRentalStock;
    }

    //==============================================
    // レンタカーストック情報複数取得処理
    //==============================================
    public function getCarRentalStocks($data = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        $this->db->order_by('R02_Sort_Order', 'ASC');
        $query = $this->db->get();
        $getCarRentalStocks = $query->result_array();
        return $getCarRentalStocks;
    }

    //==============================================
    // レンタカーストックviewラジオボタン用
    //==============================================
    public function getCarRentalView($data = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        $this->db->order_by('R02_Sort_Order', 'ASC');
        $this->db->group_by('R02_Class');
        $query = $this->db->get();
        $getCarRentalStocks = $query->result_array();
        return $getCarRentalStocks;
    }

    //==============================================
    // レンタカーストック日付取得
    //==============================================
    public function getCarRentalDays($data = [])
    {
        $this->db->select('R02_Rental_Day');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        $this->db->group_by('R02_Rental_Day');
        $query = $this->db->get();
        $getCarRentalStocks = $query->result_array();
        return $getCarRentalStocks;
    }

    //==============================================
    // レンタカーストック情報フィールド取得処理
    //==============================================
    public function getFields()
    {
        return $this->db->list_fields($this->table);
    }
}
