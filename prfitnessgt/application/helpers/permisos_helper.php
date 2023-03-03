<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('permisos'))
{
    function permisos($crud, $slug) {
        $ci=& get_instance();

        $ci->db->select("a.*, c.name_sub_item as slug, d.rol ");
        $ci->db->from("sys_permisos a");
        $ci->db->join("tb_colaboradores b", "a.id_rol = b.id_rol", "inner");
        $ci->db->join("sys_navbar_subs_items c", "a.id_slug = c.id_sub_item", "inner");
        $ci->db->join("tb_roles d", "a.id_rol = d.id_rol", "inner");
        $ci->db->where("id =", $ci->session->userdata("id_user"));
        $ci->db->where("c.slug =", $slug);
        $query = $ci->db->get();
        /*echo "<pre>";
            print_r($query->result_array());
        echo "</pre>";*/

        $permiso = $query->result_array();
        if(!empty($permiso)){

    
            $permiso = $permiso[0];

            if($permiso['crear'] == 0){
                $crud->unset_add();			
            }

            if($permiso['editar'] == 0){
                $crud->unset_edit();
            }
            if($permiso['eliminar'] == 0){
                $crud->unset_delete();
            }

            if($permiso['exportar'] == 0){
                $crud->unset_export();
            }

            if($permiso['imprimir'] == 0){
                $crud->unset_print();
            }

            if($permiso['leer']== 0){
                $crud->unset_read();
            }	
        }else{
            /* show error or not allow to show this page */
            redirect('/error','refresh');
            
        }	
    }    
}

