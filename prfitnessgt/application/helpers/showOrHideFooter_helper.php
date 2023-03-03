<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('show_or_hide_footer'))
{
    function show_or_hide_footer($value = false) {
        $ci=& get_instance();
        $showFooter = true;
    
        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
        $complete_url =   $_SERVER["REQUEST_URI"];
        
        $last = explode('/',$complete_url);
    
        $a = $complete_url;
    
		if(!$value){
			if ( preg_match('/(add|edit|read)/i' , $a)){
				$showFooter = false;
			}
		}else{
			$showFooter = true;
		}

        $data['showFooter'] = $showFooter;            
        $ci->load->view('inc/footer_to_grocery', $data);           
    }  
}

