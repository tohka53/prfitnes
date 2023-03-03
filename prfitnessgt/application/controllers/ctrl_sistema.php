<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_Sistema extends Ctrl_trigger {
    
	public function __construct(){
		parent:: __construct();
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();  
        /* define default timezone */
        date_default_timezone_set('America/Guatemala');
        $this->token = check_token();    
    }
    
	public function _callback_yes_or_not($value, $row)
	{
		if ($value == '0') {
			return "<label class ='label label-danger'>inactivo</label>";
		} elseif ($value == '1') {
			return "<label class ='label label-success'>activo</label>";
		} else{
			"-";
		}
    }

    public function _estado_colaborador_values($value, $row)
    {
        if( $row->usuario_activo == 1){
            return "<label class ='label label-success'>online</label>";
        }else{
            return "<label class ='label label-danger'>offline</label>";
        }
    }  

	public function close_session()
    {
		$this->session->sess_destroy();
		$this->load->model("mdl_login");	
		$request = $this->mdl_login->update_offline_user($this->session->userdata('usuario'));
		if($request){
			redirect('/login', 'refresh');	
		}else{
			echo "error al 0x00001 update DB.";
		}			
	} 
       
    public function categorias_sidebar()
    {
        try{
            if( $this->session->userdata('allow_token') === $this->token){
            
            $crud = new grocery_CRUD();       
            permisos($crud, $this->uri->segment(1));
            $crud->set_theme('flexigrid');
            $myTable = 'sys_navbar_items';
            $crud->set_table($myTable);                  
            $crud->set_subject('Categoria Sidebar');
                            
            /* change names */
            $crud->display_as('nombre_item','Nombre de la categoría');            
            $crud->display_as('icon_item','Icono de la categoría'); 
            $crud->display_as('link_item','Link de la categoría'); 
            $crud->display_as('identify','Acrónimo'); 
            /* required */
            $crud->required_fields(
                'nombre_item',
                'icon_item',
                'link_item',
                'identify'
            );
            
            /* campos */
            $crud->columns(
                'nombre_item',
                'icon_item',
                'link_item',
                'identify'                
            );
            
            /* campos ocultos */                
            $crud->field_type('id', 'hidden');  
            $crud->field_type("status" , "hidden", 1);
            /* archivo de placeholders */
            $crud->set_js('assets/js/placeholders_system.js');                
            /* create logs */
            $this->statusAction = $crud->getState();
            $this->table_logs = $myTable;
            if($this->set_logs($crud, $this->table_logs)){
                $crud->callback_after_insert(array($this, 'logs_after_'));
            }
            $crud->callback_after_update(array($this, 'logs_after_'));                   
            $this->get_id_name();
            $crud->callback_delete(array($this,'_delete_')); 
            /*--end create logs -- */                 
            $output = $crud->render();

            $data['title'] = $this->uri->segment(1);
            $this->load->view("inc/header", $data);
            $this->load->model('inc/mdl_sidebar_items');
            $this->sidebar_values();
            $this->load->view('inc/sidebar', $this->data);
            $this->load->view("inc/navbar");
            $this->load->view("sistema/vw_sistema", $output); 
            show_or_hide_footer();
        }else{
            $this->load->view("login/login");
        }
        
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }

    public function sub_categorias_sidebar()
    {
        try{

            if( $this->session->userdata('allow_token') === $this->token){         
                $crud = new grocery_CRUD();
                permisos($crud, $this->uri->segment(1));
                $crud->set_theme('flexigrid');
                $myTable = 'sys_navbar_subs_items';
                $crud->set_table($myTable);           
                $crud->where($myTable . '.status',1);
                $crud->set_subject('Subcategorias Sidebar');                
                /* change names */       
                $crud->display_as('name_sub_item','Nombre de la subcategoría'); 
                $crud->display_as('slug','Slug'); 
                $crud->display_as('link_sub_item','Controlador');
                $crud->display_as('referency_word','Referencia');
            
                /* realaciones entre las tablas */
                $crud->set_relation("id_parent_item","sys_navbar_items", "nombre_item");	
                $crud->display_as('id_parent_item','Categoría'); 
                
                /* required */
                $crud->required_fields(
                    'id_parent_item',
                    'name_sub_item',
                    'slug',
                    'link_sub_item',
                    'referency_word'
                );                        

                /* campos */
                $crud->columns(
                    'id_parent_item',
                    'name_sub_item',
                    'slug',
                    'link_sub_item',
                    'referency_word'               
                );

                /* campos ocultos */                
                $crud->field_type('id_sub_item', 'hidden');
                $crud->field_type("status" , "hidden", 1);
                /* archivo de placeholders */
                $crud->set_js('assets/js/placeholders_system.js');                
                /* salida */
                $crud->set_language("spanish");
                
                /* create logs */
                $this->statusAction = $crud->getState();
                $this->table_logs = $myTable;
                if($this->set_logs($crud, $this->table_logs)){
                    $crud->callback_after_insert(array($this, 'logs_after_'));
                }
                $crud->callback_after_update(array($this, 'logs_after_'));                   
                $this->get_id_name();
                $crud->callback_delete(array($this,'_delete_')); 
                /*--end create logs -- */                                
                $output = $crud->render();

                $data['title'] = $this->uri->segment(1);
                $this->load->view("inc/header", $data);
                $this->load->model('inc/mdl_sidebar_items');
                $this->sidebar_values();
                $this->load->view('inc/sidebar', $this->data);
                $this->load->view("inc/navbar");
                $this->load->view("sistema/vw_sistema", $output);
                show_or_hide_footer();           
            }else{
                $this->load->view("login/login");
            }   
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }    

    public function roles()
    {
        try{
            if( $this->session->userdata('allow_token') === $this->token){ 
                $crud = new grocery_CRUD();      
                permisos($crud, $this->uri->segment(1));          
                $crud->set_theme('flexigrid');
                $myTable = 'tb_roles';
                $crud->set_table($myTable); 
                $crud->set_subject('Roles');           
                /* requeridos */
                $crud->required_fields(
                    'rol',
                    'descripcion_rol'
                ); 
                
                /* campos */
                $crud->columns(
                    'rol',
                    'descripcion_rol'               
                );

                /* campos ocultos */                
                $crud->field_type('id_sub_item', 'hidden');     
                $crud->field_type("status" , "hidden", 1);
                /* campos ocultos*/
                $crud->field_type("id_rol" , "hidden");
                /* archivo de placeholders */
                $crud->set_js('assets/js/placeholders_system.js');  

                $crud->set_language("spanish");
                
                /* create logs */
                $this->statusAction = $crud->getState();
                $this->table_logs = $myTable;
                if($this->set_logs($crud, $this->table_logs)){
                    $crud->callback_after_insert(array($this, 'logs_after_'));
                }
                $crud->callback_after_update(array($this, 'logs_after_'));                   
                $this->get_id_name();
                $crud->callback_delete(array($this,'_delete_')); 
                /*--end create logs -- */                                
                $output = $crud->render();

                $data['title'] = $this->uri->segment(1);
                $this->load->view("inc/header", $data);
                $this->load->model('inc/mdl_sidebar_items');
                $this->sidebar_values();
                $this->load->view('inc/sidebar', $this->data);
                $this->load->view("inc/navbar");
                $this->load->view("sistema/vw_sistema", $output);
                
                show_or_hide_footer();
            }else{
                $this->load->view("login/login");
            } 
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }     

    public function permisos()
    {
        try{
            if( $this->session->userdata('allow_token') === $this->token){  
                $crud = new grocery_CRUD();
                permisos($crud, $this->uri->segment(1));                                
                $crud->set_theme('flexigrid');
                $myTable = 'sys_permisos';
                $crud->where($myTable . '.status',1);
                $crud->set_table($myTable);                       
                $crud->set_subject('Permisos');

                /* required */
                $crud->required_fields(
                    'nombre_permiso',
                    'id_rol',
                    'id_slug'
                );   
                
                $crud->columns(
                    'id_rol',
                    'id_slug',
					'leer',
					'crear',
					'editar',
					'eliminar',
					'imprimir',
					'exportar'                
                );
			
                /* ocultos */
                $crud->field_type("id_permiso", "hidden");
                $crud->field_type("status", "hidden", 1);
                                
				/* change in view all values */
				$columns = array(
					'leer',
					'crear',
					'editar',
					'eliminar',
					'imprimir',
					'exportar'
				);	
				
				foreach ($columns as $value) {
					$crud->callback_read_field($value, function ($value, $primary_key) {
						if ($value == '0') {
                            return "<label class ='label label-danger'>inactivo</label>";
						} elseif ($value == '1') {
                            return "<label class ='label label-success'>activo</label>";
						} else{
							"-";
						}
					});	
                }

                $crud->callback_column('leer',array($this,'_callback_yes_or_not'));
                $crud->callback_column('crear',array($this,'_callback_yes_or_not'));
                $crud->callback_column('editar',array($this,'_callback_yes_or_not'));
                $crud->callback_column('eliminar',array($this,'_callback_yes_or_not'));
                $crud->callback_column('imprimir',array($this,'_callback_yes_or_not'));
                $crud->callback_column('exportar',array($this,'_callback_yes_or_not'));
                /* relations between tables */
                $crud->set_relation("id_rol","tb_roles", "rol");	
                $crud->display_as('id_rol','Rol permiso'); 

                $crud->set_relation("id_slug","sys_navbar_subs_items", "name_sub_item");
                $crud->display_as("id_slug", "Catálago");
                /* display true or false */
                
                $crud->field_type('crear','true_false');
                $crud->field_type('editar','true_false');
                $crud->field_type('eliminar','true_false');
                $crud->field_type('exportar','true_false');
                $crud->field_type('imprimir','true_false');
                $crud->field_type('leer','true_false');       
                $crud->set_js('assets/js/placeholders_system.js');  
                $crud->set_language("spanish");
                
                /* create logs */
                $this->statusAction = $crud->getState();
                $this->table_logs = $myTable;
                if($this->set_logs($crud, $this->table_logs)){
                    $crud->callback_after_insert(array($this, 'logs_after_'));
                }
                $crud->callback_after_update(array($this, 'logs_after_'));                   
                $this->get_id_name();
                $crud->callback_delete(array($this,'_delete_')); 
                /*--end create logs -- */	                
                                
                $output = $crud->render();

                $data['title'] = $this->uri->segment(1);
                $this->load->view("inc/header", $data);
                $this->load->model('inc/mdl_sidebar_items');
                $this->sidebar_values();
                $this->load->view('inc/sidebar', $this->data);
                $this->load->view("inc/navbar");
                $this->load->view("sistema/vw_sistema", $output);             
                show_or_hide_footer();
            }else{
                $this->load->view("login/login");
            } 
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }             
    
   public function colaboradores(){
        try{
            if( $this->session->userdata('allow_token') === $this->token){             
                $crud = new grocery_CRUD();      
                permisos($crud, $this->uri->segment(1));          
                $crud->set_theme('flexigrid');
                $myTable = 'tb_colaboradores';
                $crud->where($myTable .'.status=', 1);
                $crud->set_table($myTable);       
                
                $crud->required_fields(
                    'id_colaborador',
                    'id_puesto',
                    'id_rol',
                    
                    'nombres',
                    'apellidos',
                    'usuario',
                    'clave'
                );
                /* ocultos */                
                $crud->field_type("id", "hidden");
            
                $crud->columns(
                    'nombres',
                    'apellidos',  
                    'usuario',
                    'id_colaborador',
                    'id_rol',             
                    'usuario_activo'
                );                   

                $crud->display_as('id_colaborador','Id colaborador');
                
                $crud->set_js('assets/js/placeholders_system.js');  
                
                $crud->set_subject('Colaborador');
                $crud->callback_add_field('id_colaborador', function () {                                
                    return '<div class="form-input-box" id="id_colaborador_box">
                        <input type="number" maxlength="50"  min="1" class="form-control" value="" id="id_colaborador" name="id_colaborador">
                    </div> ';
                });
                             

                /* muestra los roles en la ventana editar */
                $crud->callback_edit_field('id_rol', function ($value, $primary_key) {                
                    
                    $rol =  $this->session->userdata('rol');
                    $this->load->model("model_listados");
                    $request = $this->model_listados->get_listado_roles($rol);
                    if(gettype($request) == "boolean"){            
                        echo "no existen datos";
                    }else{
                        $select = "<select id='id_rol' name='id_rol' style='width:300px';>";
                        $select .= '<option></option>';
                        for ($i=0; $i < count($request); $i++) { 
                            /* si el valor es igual al encontrado se selecciona */
                            if($value == $request[$i]['id_rol']){
                                $select .= '<option selected="selected" value="'. $request[$i]['id_rol']  .'">' . $request[$i]['rol'] . '</option>';
                            }else{
                                $select .= '<option value="'. $request[$i]['id_rol']  .'">' . $request[$i]['rol'] . '</option>';
                            }                            
                        }                 
                        $select .= "</select>";

                        return $select;
                    }   
                });                  

                /* read */
                $crud->callback_read_field('usuario_activo', function ($value, $primary_key) {
                    if( $value == 1){
                        return "<label class ='label label-success'>online</label>";
                    }else{
                        return "<label class ='label label-danger'>offline</label>";
                    }
                });

                $crud->field_type('usuario_activo', 'hidden'); 
                $crud->field_type('token', 'hidden'); 
                $crud->field_type('status', 'hidden', 1); 
                $crud->field_type('id_renglon', 'hidden', 1); 
                
                $crud->field_type('clave', 'password'); 
                $crud->field_type('md5_clave','hidden'); 
                
                $crud->callback_before_insert(array($this,'encrypt_password_callback'));
                $crud->callback_before_update(array($this,'encrypt_password_callback'));
                
                $crud->callback_after_insert(array($this, '_bitacora_colaboradores'));
                $crud->callback_after_update(array($this, '_bitacora_colaboradores'));                                               

                $crud->callback_column('usuario_activo',array($this,'_estado_colaborador_values'));  

                /* upload */
                $crud->set_field_upload('imagen','assets/uploads/images_colaboradores');
                $crud->display_as('imagen','Imagen');                  

                /* relations between tables */  
                $crud->set_relation("id_puesto","tb_puestos", "puesto");	
                $crud->display_as('id_puesto','Puesto'); 

                $crud->display_as('clave','Clave'); 

               // $crud->callback_delete(array($this,'delete_user'));
                
              //  $crud->set_relation("id_renglon","tb_renglon", "nombre_renglon");	
                //$crud->display_as('id_renglon','Renglon');

                $crud->set_relation("id_rol","tb_roles", "rol");	
                $crud->display_as('id_rol','Rol');  
                
                //$crud->set_relation("id_colaborador","tb_roles", "rol");	
                $crud->display_as('id_colaborador','ID Colaborador');
                
                /* create logs */
                $this->statusAction = $crud->getState();
                $this->table_logs = $myTable;
                if($this->set_logs($crud, $this->table_logs)){
                    $crud->callback_after_insert(array($this, 'logs_after_'));
                }
                $crud->callback_after_update(array($this, 'logs_after_'));                   
                $this->get_id_name();
                $crud->callback_delete(array($this,'_delete_')); 
                /*--end create logs -- */	
                
                /* salida */;
                $crud->set_language("spanish");  
                $output = $crud->render();

                $data['title'] = $this->uri->segment(1);
                $this->load->view("inc/header", $data);
                $this->load->model('inc/mdl_sidebar_items');
                $this->sidebar_values();
                $this->load->view('inc/sidebar', $this->data);
                $this->load->view("inc/navbar");
                $this->load->view("sistema/vw_sistema", $output);            
                show_or_hide_footer();
            }else{
                $this->load->view("login/login");
            } 
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }
    
    function encrypt_password_callback($post_array) {
        
        $post_array['md5_clave'] = md5(trim($post_array['clave']));
        //$post_array['status'] = 1;
        return $post_array;
    }    
    
    public function puestos()
    {
        try{
            if( $this->session->userdata('allow_token') === $this->token){ 
                $crud = new grocery_CRUD();
                permisos($crud, $this->uri->segment(1));
                $crud->set_theme('flexigrid');
                $myTable = 'tb_puestos';
                $crud->set_table($myTable);
                $crud->set_subject('Puestos');                
                /* required */
                $crud->required_fields(
                    'puesto'
                );    
                
				$crud->columns(
					'puesto'
				);     
                
                /* ocultos */
                $crud->field_type("id_puesto", "hidden");      
                $crud->field_type("status" , "hidden", 1);
                
                $crud->set_js('assets/js/placeholders_system.js');  
                
                /* create logs */
                $this->statusAction = $crud->getState();
                $this->table_logs = $myTable;
                if($this->set_logs($crud, $this->table_logs)){
                    $crud->callback_after_insert(array($this, 'logs_after_'));
                }
                $crud->callback_after_update(array($this, 'logs_after_'));                   
                $this->get_id_name();
                $crud->callback_delete(array($this,'_delete_')); 
                /*--end create logs -- */	                
                                
                $crud->set_language("spanish");
                $output = $crud->render();

                $data['title'] = $this->uri->segment(1);
                $this->load->view("inc/header", $data);
                $this->load->model('inc/mdl_sidebar_items');
                $this->sidebar_values();
                $this->load->view('inc/sidebar', $this->data);
                $this->load->view("inc/navbar");
                $this->load->view("sistema/vw_sistema", $output);
                
                show_or_hide_footer();
            }else{
                $this->load->view("login/login");
            } 
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }      
    
    public function renglones()
    {
        try{
            if( $this->session->userdata('allow_token') === $this->token){ 
                $crud = new grocery_CRUD();                
                permisos($crud, $this->uri->segment(1));
                $crud->set_theme('flexigrid');                
                $myTable = 'tb_renglon';
                $crud->set_table($myTable);                          
                $crud->set_subject('Identificador');
                /* required */
                $crud->required_fields(
                    'nombre_renglon'
                );    
                
				$crud->columns(
					'nombre_renglon',
                    'descripcion'
				);                
                
                /* ocultos */
                $crud->field_type("id_renglon", "hidden");   
                $crud->field_type("status" , "hidden", 1);
                
                $crud->set_js('assets/js/placeholders_system.js');                  
                
                $crud->set_language("spanish");
                
                /* create logs */
                $this->statusAction = $crud->getState();
                $this->table_logs = $myTable;
                if($this->set_logs($crud, $this->table_logs)){
                    $crud->callback_after_insert(array($this, 'logs_after_'));
                }
                $crud->callback_after_update(array($this, 'logs_after_'));                   
                $this->get_id_name();
                $crud->callback_delete(array($this,'_delete_')); 
                /*--end create logs -- */	                
                
                $output = $crud->render();
                $data['title'] = $this->uri->segment(1);
                $this->load->view("inc/header", $data);
                $this->load->model('inc/mdl_sidebar_items');
                $this->sidebar_values();
                $this->load->view('inc/sidebar', $this->data);
                $this->load->view("inc/navbar");
                $this->load->view("sistema/vw_sistema", $output);
                
                show_or_hide_footer();
            }else{
                $this->load->view("login/login");
            } 
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }         
    }      
    
    public function delete_user($primary_key)
    {
         $this->db->update(
            'tb_colaboradores',
            array(
                'status' => '0'
            ),
            array('id' => $primary_key)
        ); 
        
        $user_logs_insert = array(
            "id_eliminado" => $primary_key,
            'id_colaborador_elimina' => $this->session->userdata("id_user"),
            "fecha" => date('Y-m-d H:i:s')
            );             
            $this->db->insert('tb_colaboradores_eliminados',$user_logs_insert);            
        return true;
    }    
    
    public function get_roles_(){

        $rol =  $this->session->userdata('rol');
        $this->load->model("model_listados");
        $request = $this->model_listados->get_listado_roles($rol);
        if(gettype($request) == "boolean"){            
            echo "no existen datos";
        }else{

            $select = "<select id='id_rol' name='id_rol' style='width:300px';>";
            $select .= '<option></option>';
            for ($i=0; $i < count($request); $i++) { 
                /* si el valor es igual al encontrado se selecciona */
                $select .= '<option value="'. $request[$i]['id_rol']  .'">' . $request[$i]['rol'] . '</option>';
            }                 
            $select .= "</select>";

            return $select;
        } 
    }	

/****************************************************************************
*                                                                           *
*                               PROFILE SETTINGS                            *
*                                                                           *
*****************************************************************************/
    /* End of file Controllername.php */    

    public function perfil()
    {
        //$this->defaultLoads();
        try{
            $this->load->library('fields_creator');
            $this->fields_creator->set_table('tb_colaboradores');  

             $arrayAttr = array(
                'id_colaborador' => array(
                    'required' => 'required',
                ),
                'id_sexo' => array(
                    'required' => 'required',
                ),               
                'nombres' => array(
                    'required' => 'required',
                ),
                'apellidos' => array(
                    'required' => 'required',
                ),
                'usuario' => array(
                    'required' => 'required',
                ),
                'clave' => array(
                    'type' => 'password'
                )             
            );

            $this->fields_creator->add_costum_attr($arrayAttr); 
            //$this->fields_creator->show_costum_attr();

            #variables: @campo, @table, @campo, @desplegar.
            $this->fields_creator->make_select('id_sexo', 'tb_sexos', 'id_sexo');
            //$this->fields_creator->make_select('id_rol','tb_materias_primas', 'codigo');
            #se ingresan todos los campos que no se necesitan en el formulario
            $avoids = array(
                'id',
                'token'                
            );
            $this->fields_creator->avoid_field($avoids);

            $this->data['inputs'] = $this->fields_creator->render();

            $this->load->view("inc/header");
            $this->load->model('inc/mdl_sidebar_items');
            $this->sidebar_values();
            $this->load->view('inc/sidebar', $this->data);
            $this->load->view("inc/navbar");
            $this->fields_creator->show_inputs();
            $data['id'] = $this->session->userdata("id_work") ;
            $this->load->view("sistema/vw_perfil", $data);
            $this->load->view("inc/footer");     

        }catch(Exception $e){
            show_error($e->getMessage().' --- ');//.$e->getTraceAsString());
        }
    }
}



