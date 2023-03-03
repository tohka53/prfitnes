<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_Trigger extends CI_Controller {
    
    public $token ="";
    public $data = array();
    public $table_logs = "";
    public $statusAction = "";
    public $PK_name = "";
	public $c;
 
	public function __construct(){
		parent:: __construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('image_CRUD');
        $crud = new grocery_CRUD();  
        
    
        /* define default timezone */
        date_default_timezone_set('America/Guatemala');
        $this->token = check_token();    
    }
    
    public function sidebar_values(){

        $this->data['parents'] = $this->mdl_sidebar_items->list_sidebar_parents_items( $this->session->userdata("id_work") );
        $this->data['children'] = $this->mdl_sidebar_items->list_sidebar_items_with_children(  $this->session->userdata("id_work"));
        return $this->data;
    }
	
    /**
    * trigger 
    * 
    * set_logs()
    * logs_after()
    * create_logs_array()
    * _delete_()
    * get_id_name()
    * 
    */
    public function set_logs($crud, $table){
        if (!$this->db->table_exists("logs_" . $table)){
            //echo "no existe esta tabla `logs_".$table ." ";
            $query = "CREATE TABLE `logs_".$table ."` LIKE `" . $table . "`";
            if($this->db->query($query)){
                $query = "ALTER TABLE `logs_".$table ."` ADD COLUMN `id_modificado` int(11) NOT NULL, ADD COLUMN `id_colaboradores` int(11) NOT NULL, ADD COLUMN `fecha_log` DATETIME NULL DEFAULT NULL, ADD COLUMN `action` varchar(1) NOT NULL";
                if($this->db->query($query)){
                    return true;
                }
            }
            /*crear objecto logs */
        }else{
            return true;
        }      
    }    
    
    public function logs_after_($post_array,$primary_key){
    
        $logs_insert = $this->create_logs_array($post_array, $primary_key);

        $this->db->insert("logs_".$this->table_logs, $logs_insert );
        return true;            

    }
    
    public function create_logs_array($post_array, $primary_key){
		$fields = $this->db->field_data($this->table_logs);
        
		foreach($fields as $field){
            if(!$field->primary_key){
                $logs_insert[$field->name] = $post_array[$field->name];
            }
            
            /* crear modelo que busque en base de datos */
            if("logs_".$this->table_logs == "logs_tb_diputados_bloques" || "logs_".$this->table_logs == "tb_curules_bloques_diputados" || "logs_".$this->table_logs == "tb_juntas_directivas" || "logs_".$this->table_logs == "logs_tb_comisiones_diputados" ){
                $logs_insert[$field->name] = $post_array[$field->name];
            }
        }
		
        $append_data_logs = array(
            "id_modificado" => $primary_key,
            "id_colaboradores" => $this->session->userdata("id_user"),
            "fecha_log" => date('Y-m-d H:i:s'),
            "action" => $this->statusAction
        );
        
        $logs_insert = array_merge($logs_insert, $append_data_logs );
        return $logs_insert;
    }
    
    /** Eliminar datos */
    
    public function _delete_($primary_key){
        /* almacena los datos correspondientes a la eliminación del item */
        $append_data_logs = array(
            "id_modificado" => $primary_key,
            "id_colaboradores" => $this->session->userdata("id_user"),
            "fecha_log" => date('Y-m-d H:i:s'),
            "action" => 'd'
        );   
        
        $this->db->insert("logs_".$this->table_logs, $append_data_logs );
        
        
        return $this->db->update($this->table_logs, array('status' => '0'), array($this->PK_name => $primary_key));
    }
    
    /* obtiene el nombre del PK de la tabla para poder darlo de baja al eliminar */
    public function get_id_name(){
        $fields = $this->db->field_data($this->table_logs);
        foreach ($fields as $field)
        {
            if($field->primary_key){
                $this->PK_name = $field->name;
            }
        } 
    }  
    
    /*
    *
    * end trigger
    *
    */
    
    
}