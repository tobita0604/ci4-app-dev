<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('check_first_session'))
{
    function check_first_session()	
    {		
		if(!isset($_SESSION['netID'])){
			return false;
		}else{
			return true;
		}			
    }
}
if ( ! function_exists('check_login_user_session'))
{
    function check_login_user_session()	
    {		
		if(!isset($_SESSION['user_data'])){
			return false;
		}else{
			return true;
		}			
    }
}