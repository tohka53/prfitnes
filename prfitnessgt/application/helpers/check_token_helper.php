<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* La function @check_token  
* verifica la existencia de un token de ingreso 
* referente al usuario logueado.
* si el token existe tendrá acceso al sistema
* y a los modulos asignados según sus permisos.
*/

if ( ! function_exists('check_token'))
{
    function check_token() {        
            $ci=& get_instance();
        /* verifica la existencia de una base de datos */
        if( $ci->db->database != ""){
            $ci->db->select("token");
            $ci->db->from("tb_colaboradores");
            $ci->db->where("id =", $ci->session->userdata("id_user"));
            $query = $ci->db->get();
            $token = $query->result_array();

            if(!empty($token)){
                return $token[0]['token'];
            }else{
                return false;
            }
        }
    }  
}

