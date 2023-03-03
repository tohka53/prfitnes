<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_Sidebar_Items extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function list_sidebar_parents_items($id_user){
        $r = $this->db;
        $this->db->distinct();
        $r->select("d.id,nombre_item, icon_item, link_item, identify ");
        $r->from("tb_colaboradores a");
        $r->join("sys_permisos b" , "b.id_rol = a.id_rol", "inner");
        $r->join("sys_navbar_subs_items c" , "c.id_sub_item = b.id_slug", "inner");
        $r->join("sys_navbar_items d" , "d.id = c.id_parent_item", "inner");
        $r->where("a.id_colaborador =",$id_user);
        $r->where("b.status =", 1);
        $r->where("c.status =", 1);
        $r->where("d.status =", 1);
        
        $query = $r->get();
        if(!empty($query->result())){
            return $query->result_array();
        }else{
            return false;
        }        
    }

    public function list_sidebar_items_with_children($id_user){

        $r = $this->db;
        $r->select("id_sub_item,id_parent_item,name_sub_item,slug,link_sub_item,referency_word");
        $r->from("tb_colaboradores a");
        $r->join("sys_permisos b" , "b.id_rol = a.id_rol", "inner");
        $r->join("sys_navbar_subs_items c" , "c.id_sub_item = b.id_slug", "inner");
        $r->join("sys_navbar_items d" , "d.id = c.id_parent_item", "inner");
        $r->where("a.id_colaborador =", $id_user);
        $r->order_by('name_sub_item');
        $r->where("b.status =", 1);
        $r->where("c.status =", 1);
        $r->where("d.status =", 1);        
        $query = $r->get();
        if(!empty($query->result())){
            return $query->result_array();
        }else{
            return false;
        }          
    }

    public function get_allow_links_per_user(){
        $r = $this->db;
        $r->select("d.nombre_item as padre, slug as hijo");
        $r->from("tb_colaboradores a");
        $r->join("sys_permisos b" , "b.id_rol = a.id_rol", "inner");
        $r->join("sys_navbar_subs_items c" , "c.id_sub_item = b.id_slug", "inner");
        $r->join("sys_navbar_items d" , "d.id = c.id_parent_item", "inner");
        $r->where("a.id_colaborador =", 5413);
        $r->where("b.status =", 1);
        $r->where("c.status =", 1);
        $r->where("d.status =", 1);        
        $query = $r->get();
        if(!empty($query->result())){
            return $query->result_array();
        }else{
            return false;
        }

    }

}

/* End of file ModelName.php */

