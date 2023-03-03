<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_Login extends CI_Model {

	function __construct()
    {
        parent::__construct();
    } 
    
    //    ORIGINAL
    public function check_permission($usr, $pass){
        
        $this->db->select('a.id,
                        a.id_colaborador,
                        a.usuario, 
                        a.clave, 
                        a.id_rol, 
                        a.imagen , 
                        CONCAT(a.nombres, " ", a.apellidos) as nombre, 
                        
                        ');

        $this->db->from('tb_colaboradores a');
        $this->db->where('a.usuario =', $usr);
        $this->db->where('a.md5_clave =', $pass);  
      
       
        $query = $this->db->get();
        
        if(!empty($query->result_array())){
            return $query->result_array();
        }else{
            $fields = array(
               
                $usr, $pass
            );

            $error = $this->check_in_which_is_the_error($fields);

            if(!$error['usr']){
                return "datos invalidos";
            }elseif(!$error['pass']){
                return "datos invalidos";
            }else{
                return "por favor revisa tus credenciales";
            }
        }
    }

    public function check_in_which_is_the_error($fields){
        $arrayData = array(
            0 => array(
                'fields' => 'usuario',
                'column' => 'usuario',
                'value' => $fields[0]
            ),
            1 => array(
                'fields' => 'md5_clave',
                'column' => 'md5_clave',
                'value' => $fields[1]
            )            
        );

        for ($i=0; $i < count($fields); $i++) { 
            $user;
            $pass;
            if($i == 0){
                $pass = $this->review_error($arrayData[$i]);
            }else{
                $user = $this->review_error($arrayData[$i]);
            }
        }
        $error_array = array(
            "usr" => $user,
            "pass" => $pass
        );

        return $error_array;        
    }

    public function review_error($arrayData){
 
        $this->db->select($arrayData['fields']);
        $this->db->from('tb_colaboradores');
        $this->db->where($arrayData['column'],$arrayData['value']);    
        $query = $this->db->get();
        if(!empty($query->result_array())){
            return false;
        }else{
            return true;
        }
    } 

    public function update_online_user($user, $pass, $tk){
        $data = array( 
            'usuario_activo' =>  1, 
            'token' => $tk
        );
        $where = "usuario ='" . $user . "' AND md5_clave ='" . $pass . "'";
        $query = $this->db->update('tb_colaboradores', $data, $where);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_offline_user($user){
        $data = array( 
            'usuario_activo' =>  0, 
            'token' => 0
        );
        $where = "usuario ='" . $user . "'";
        $query = $this->db->update('tb_colaboradores', $data, $where);
        if($query){
            return true;
        }else{
            return false;
        }
    }  
      
}

/* End of file Mdls_Login.php */
