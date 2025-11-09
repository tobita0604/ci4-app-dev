<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stock_lib
{
    private $CI;
    public function __construct()
    {
        $this->CI = & get_instance ();
        $this->CI->load->model('option_mo');
		$this->CI->load->library('session');
    }

    public function balanceCheck($id, $type)
    {
        if(!empty($id)){
            $R01_Id = $this->CI->session->userdata('user_data');
            $members = $this->CI->option_mo->get_members_info($R01_Id);
            $_balance = 0;
    
            $stock = $this->CI->option_mo->getOptionsStock($id);
            // マイナス在庫のバグを補正
            if($stock['M01_Balance'] <= 0){
                $stock['M01_Balance'] = 0;
            }

            foreach($members as $member){
                if(1 == $type && $member['R02_Option1_Time'] == $stock['M01_Stock_Id']){
                    $_balance++;
                } elseif(2 == $type && $member['R02_Option2_Time'] == $stock['M01_Stock_Id']){
                    $_balance++;
                }
            }

            $stock['M01_Balance'] = (int)$stock['M01_Balance'] + $_balance;

            if($stock['M01_Balance'] <= 0){
                return true;
            } else {
                return false;
            }
		}
    }

    public function balanceCheckNoTime($id, $type)
    {
		if(!empty($id)){
            $R01_Id = $this->CI->session->userdata('user_data');
            $members = $this->CI->option_mo->get_members_info($R01_Id);
            $_balance = 0;

            $stocks = $this->CI->option_mo->getNoTimeStock($id, $type);
			if(!empty($stocks)){
				foreach($stocks as $stock){
					if($stock['M01_Id'] == $id){
                        // マイナス在庫のバグを補正
                        if($stock['M01_Balance'] <= 0){
                            $stock['M01_Balance'] = 0;
                        }

                        foreach($members as $member){
                            if(1 == $type && $member['R02_Option1_Time'] == $stock['M01_Stock_Id']){
                                $_balance++;
                            } elseif(2 == $type && $member['R02_Option2_Time'] == $stock['M01_Stock_Id']){
                                $_balance++;
                            }
                        }
            
                        $stock['M01_Balance'] = (int)$stock['M01_Balance'] + $_balance;

                        if($stock['M01_Balance'] <= 0){
                            return true;
                        } else {
                            return false;
                        }
					}
				}	
			}
		}
    }

    public function balanceBeforeUpdateCheck($options)
    {
        if(!empty($options)){
            $R01_Id = $this->CI->session->userdata('user_data');
            $members = $this->CI->option_mo->get_members_info($R01_Id);
            $_balance = 0;
            $adjust = [];

            // 8月23日分の在庫確認
            foreach($options as $index => $option){
                if(!empty($option['R02_Option1_Time'])){
                    if(!empty($adjust)){
                        $flg = 0;
                        foreach($adjust as $i => $data){
                            if($data['id'] == $option['R02_Option1_Time']){
                                $adjust[$i]['stock'] = $adjust[$i]['stock']+1;
                                $flg ++;
                            }
                        }
                        if(empty($flg)){
                            $adjust[$index]['id'] = $option['R02_Option1_Time'];
                            $adjust[$index]['stock'] = $adjust['stock']+1;
                        }
                    } else {
                        $adjust[$index]['id'] = $option['R02_Option1_Time'];
                        $adjust[$index]['stock'] = $adjust['stock']+1;
                    }
                }
            }

            if(!empty($adjust)){
                foreach($adjust as $a){
                    $stock = $this->CI->option_mo->getOptionsStock($a['id']);
                    foreach($members as $member){
                        if($member['R02_Option1_Time'] == $stock['M01_Stock_Id']){
                            $_balance++;
                        }
                    }
                    $balamce = ((int)$stock['M01_Balance'] - $a['stock']) + $_balance;
                    if($balamce < 0){
                        return true;
                    }                    
                }
            }


            $adjust = [];
            // 8月24日分の在庫確認
            foreach($options as $index => $option){
                if(!empty($option['R02_Option2_Time'])){
                    if(!empty($adjust)){
                        $flg = 0;
                        foreach($adjust as $i => $data){
                            if($data['id'] == $option['R02_Option2_Time']){
                                $adjust[$i]['stock'] = $adjust[$i]['stock']+1;
                                $flg ++;
                            }
                        }
                        if(empty($flg)){
                            $adjust[$index]['id'] = $option['R02_Option2_Time'];
                            $adjust[$index]['stock'] = $adjust['stock']+1;
                        }
                    } else {
                        $adjust[$index]['id'] = $option['R02_Option2_Time'];
                        $adjust[$index]['stock'] = $adjust['stock']+1;
                    }
                }
            }

            if(!empty($adjust)){
                foreach($adjust as $a){
                    $stock = $this->CI->option_mo->getOptionsStock($a['id']);
                    foreach($members as $member){
                        if($member['R02_Option2_Time'] == $stock['M01_Stock_Id']){
                            $_balance++;
                        }
                    }
                    $balamce = ((int)$stock['M01_Balance'] - $a['stock']) + $_balance;
                    if($balamce < 0){
                        return true;
                    }                    
                }
            }
		}
        return false;
    }

}
