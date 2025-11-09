<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_admin_ip_mo extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'R03_Admin_Ip';
    }

    public function insert($data = [])
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function getAdmin($data = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        $this->db->where('deleted is null');
        $query = $this->db->get();
        $getHotel = $query->row_array();
        return $getHotel;
    }

    public function getAdmins($data = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        $this->db->where('deleted is null');
        $this->db->where('display_flg', 0);
        $query = $this->db->get();
        $getHotel = $query->result_array();
        return $getHotel;
    }
}
