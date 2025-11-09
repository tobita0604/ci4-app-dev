<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer_mo extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'R02_Option';
    }

    //==============================================
    // 移動方法情報登録処理
    //==============================================
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //==============================================
    // 移動方法情報登録更新処理
    //==============================================
    public function save_bus_info($R01_Id, $R01_seq, $bus_dep, $bus_arr)
    {
        // すでにレコードがあるかチェック
        $this->db->from($this->table);
        $this->db->where('R02_Id', $R01_Id);
        $this->db->where('R02_seq', $R01_seq);
        $query = $this->db->get();

        $data = [
            'R02_bus_dep' => $bus_dep,
            'R02_bus_arr' => $bus_arr
        ];

        if ($query->num_rows() > 0) {
            // UPDATE
            $this->db->where('R02_Id', $R01_Id);
            $this->db->where('R02_seq', $R01_seq);
            $this->db->update($this->table, $data);
        } else {
            // INSERT
            $data['R02_Id'] = $R01_Id;
            $data['R02_seq'] = $R01_seq;
            $this->db->insert($this->table, $data);
        }
    }

    //==============================================
    // 移動方法合計情報取得
    //==============================================
    public function getTransferCount()
    {
        $this->db->select("
            (SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_dep = '1' AND R01_Reserver.R01_Test_Flg = 0) AS dep_bus,
            (select count(d1.R02_id) from (SELECT DISTINCT R02_id FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_dep = '1' AND R01_Reserver.R01_Test_Flg = 0) as d1) AS dep_bus_family,
            (SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_dep = '2' AND R01_Reserver.R01_Test_Flg = 0) AS dep_car,
            (select count(d2.R02_id) from (SELECT DISTINCT R02_id FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_dep = '2' AND R01_Reserver.R01_Test_Flg = 0) as d2) AS dep_car_family,
            (SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_arr = '1' AND R01_Reserver.R01_Test_Flg = 0) AS arr_bus,
            (select count(a1.R02_id) from (SELECT DISTINCT R02_id FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_arr = '1' AND R01_Reserver.R01_Test_Flg = 0) as a1) AS arr_bus_family,
            (SELECT COUNT(*) FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_arr = '2' AND R01_Reserver.R01_Test_Flg = 0) AS arr_car,
            (select count(a2.R02_id) from (SELECT DISTINCT R02_id FROM R02_Option LEFT JOIN R01_Reserver ON R01_Reserver.R01_Id = R02_Option.R02_Id WHERE R02_bus_arr = '2' AND R01_Reserver.R01_Test_Flg = 0) as a2) AS arr_car_family
        ");
        $this->db->from($this->table);
        $this->db->order_by('R02_Id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
