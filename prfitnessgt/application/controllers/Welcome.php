<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Content-Type: text/html;charset=utf-8");
class Welcome extends CI_Controller {

    private $token ="";
    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->token = check_token(); 
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function logged()
	{
        /**
        * verifica que no exista un segmento extra de url 
        * si lo hay lo identifica y lo elimina.        
        */
        $array = $this->uri->segment_array();
        if(!empty($array)){
            unset($array[1]);
            //
            if(empty($array[1])){
                header("location:" . ROOT_SYS );
            }            
        }
        /**
        * verifica la existencia de una base de datos 
        * sino existe la solicita.
        */
        if( $this->db->database == ""){
            $data['title'] = "inicio";
            //$this->load->view('inc/header_ini',$data);
            $this->load->view('master_views/vw_build_system');            
        }else{
            /**
            * evita que salga del sistema sin eliminar los datos
            */        
            if($this->session->userdata('allow_token')){
		
                $this->dashboard();

            }else{
                $this->login();               
            }
        }
	}
    
    public function check_system_data(){
        $data['title'] = "inicio";
        $this->load->view('inc/header_ini.php',$data);     
         // basic required field with cascaded rules
        $this->form_validation->set_rules('root_sys', '"la ruta del Sistema"', 'required|min_length[12]|max_length[50]');
        $this->form_validation->set_rules('sys_name', '"El nombre del Sistema"', 'required|min_length[8]|max_length[50]');
        $this->form_validation->set_rules('db_name', '"El nombre de la Base de Datos"', 'required|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('db_user', '"El nombre del usuario de la Base de Datos"', 'required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('db_pass', '"la clave de la Base de Datos"', 'min_length[8]|max_length[20]');
        $this->form_validation->set_rules('conf_db_pass', 'la confirmacion de la clave', 'matches[db_pass]');
          
        if ($this->form_validation->run() == FALSE){
            $this->load->view('master_views/vw_build_system');
        }else{                 
            $root_sys =  $this->input->post('root_sys');
            $sys_name =  $this->input->post('sys_name');
            $db_name = $this->input->post('db_name');
            $db_user = $this->input->post('db_user');
            $db_pass = $this->input->post('db_pass'); 

            
            /***
            *
            * check database connections and creating database if not exist
            *
            */
            
            $servername = "localhost";
            $username = $db_user;
            $password = $db_pass;

            // SE CREA LA connection
            $conn = new mysqli($servername, $username, $password);
            // SE REVISA LA connection
            if ($conn->connect_error) {
                show_error("error en la conexion a la base de datos". $conn->connect_error , 500 );
                exit;                  
            }  
            
            mysqli_set_charset($conn,"utf8");            

            // SE CREA LA database
            $sql = "CREATE DATABASE IF NOT EXISTS " . $db_name;
                if ($conn->query($sql) === TRUE) {
                /**
                * datos ingresados al archivo del sistema.
                */ 
                $data = '<?php' . "\n " .
                        'define(\'ROOT_SYS\',"'.$root_sys.'");'."\n".
                        'define(\'NAME_SYS\',"'.$sys_name.'");'."\n".
                        'define(\'DB_USER\',"'.$db_user.'");'."\n".
                        'define(\'DB_NAME\',"'.$db_name.'");'."\n".
                        'define(\'DB_PASS\',"'.$db_pass.'");'."\n";

                if ( !write_file(FCPATH .'/assets/sys_data_init.php', $data)){
                    echo 'Error, no fue posible crear el archivo de inicio por favor consulte con su webmaster.';
                }else{  
                    $this->crear_db($conn,$db_name, $sys_name, $root_sys );
                }  
            } else {
                show_error("Uno o mas datos ingresados de la base de datos no son correctos por favor intenta ingresarlos nuevamente <code>" 
                . $conn->error . "</code>", 500 );
                exit;                  
               
            }                                           
        }       
    }
     
    
    private function crear_db($conn, $db_name, $sys_name, $root_sys){

        /****************************************************************************************************
        *                   CREAR LA BASE DE DATOS
        *****************************************************************************************************/
        
        $data['title'] = "login";
        $this->load->view('inc/header_ini', $data);        
        echo "bienvenidos al sistema" . "<BR>";
        
        $this->load->dbforge();
        //$this->db->query('use ' . DB_NAME);

        /*
            SE CREA LA TABLA sys_navbar_items        
        */
        // sql to create table
        $sql = "CREATE TABLE `" . $db_name . "`.`sys_navbar_items` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nombre_item` varchar(50) DEFAULT NULL,
                  `icon_item` varchar(50) DEFAULT NULL,
                  `link_item` varchar(150) DEFAULT NULL,
                  `identify` varchar(5) DEFAULT NULL,
                  `status` int(1) NULL DEFAULT '1',
                  PRIMARY KEY (`id`)
                ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
            ";

        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla  sys_navbar_items ". $conn->error , 500 );
            exit;                  
        }          
        /*
            SE CREA LA TABLA sys_navbar_subs_items        
        */
        $sql = "CREATE TABLE `" . $db_name . "`.`sys_navbar_subs_items` (
              `id_sub_item` int(11) NOT NULL AUTO_INCREMENT,
              `id_parent_item` int(11) UNSIGNED NOT NULL,
              `name_sub_item` varchar(100) DEFAULT NULL,
              `slug` varchar(50) DEFAULT NULL,
              `link_sub_item` varchar(150) DEFAULT NULL,
              `referency_word` varchar(2) DEFAULT NULL,              
              `status` int(1) NULL DEFAULT '1',
              PRIMARY KEY (`id_sub_item`)
            ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
            ";
        
        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla sys_navbar_subs_items ". $conn->error , 500 );
            exit;                  
        }          
        /*
            SE CREA LA TABLA sys_permisos        
        */
        $sql = "CREATE TABLE `" . $db_name . "`.`sys_permisos` (
              `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
              `id_rol` int(11) NOT NULL,
              `id_slug` int(11) NOT NULL,
              `crear` int(1) NOT NULL DEFAULT '0',
              `editar` int(1) NOT NULL DEFAULT '0',
              `eliminar` int(1) NOT NULL DEFAULT '0',
              `exportar` int(1) NOT NULL DEFAULT '0',
              `imprimir` int(1) NOT NULL DEFAULT '0',
              `leer` int(1) NOT NULL DEFAULT '0',
              `status` int(1) NULL DEFAULT '1',
              PRIMARY KEY (`id_permiso`)
            ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
            ";

        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla sys_permisos ". $conn->error , 500 );
            exit;                  
        } 
        /*
            SE CREA LA TABLA tb_renglon        
        */

        $sql = "CREATE TABLE `" . $db_name . "`.`tb_renglon` (
              `id_renglon` int(11) NOT NULL AUTO_INCREMENT,
              `nombre_renglon` varchar(3) DEFAULT '0',
	          `descripcion` VARCHAR(150) NOT NULL,
              `status` int(1) NULL DEFAULT '1',
              PRIMARY KEY (`id_renglon`)
            ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
        ";

        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla ". $conn->error , 500 );
            exit;                  
        } 
         /*
            SE CREA LA TABLA tb_roles        
        */
        $sql = "CREATE TABLE `" . $db_name . "`.`tb_roles` (
              `id_rol` int(11) NOT NULL AUTO_INCREMENT,
              `rol` varchar(50) NOT NULL,
              `descripcion_rol` varchar(150) NOT NULL,
              `status` int(1) NULL DEFAULT '1',
              PRIMARY KEY (`id_rol`)
            ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
        ";

        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla ". $conn->error , 500 );
            exit;                  
        }        
        
             
        /*
            SE CREA LA TABLA tb_colaboradores        
        */

        $sql = "CREATE TABLE `" . $db_name . "`.`tb_colaboradores` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `id_colaborador` int(11) NOT NULL,
          `id_puesto` int(11) NOT NULL,
          `id_rol` int(11) NOT NULL,
          `id_renglon` int(11) NOT NULL,
          `nombres` varchar(100) NOT NULL DEFAULT '0',
          `apellidos` varchar(100) NOT NULL DEFAULT '0',
          `usuario` varchar(50) NOT NULL DEFAULT '0',
          `clave` varchar(50) NOT NULL DEFAULT '0',
          `md5_clave` varchar(50) NOT NULL DEFAULT '0',
          `no_telefono` varchar(50) DEFAULT '0',
          `nivel_academico` varchar(50) DEFAULT '0',
          `email` varchar(50) DEFAULT '0',
          `nit` varchar(50) DEFAULT '0',
          `dpi` varchar(50) DEFAULT '0',
          `imagen` longtext NOT NULL,
          `usuario_activo` int(11) NOT NULL DEFAULT '0',
          `token` varchar(32) NOT NULL DEFAULT '0',
          `status` int(11) DEFAULT '1',
          PRIMARY KEY (`id`)
        ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
        ";

        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla  tb_coladoradores". $conn->error , 500 );
            exit;                  
        }          
        
        /*
            SE CREA LA TABLA tb_puestos        
        */
        $sql = "CREATE TABLE `" . $db_name . "`.`tb_puestos` (
              `id_puesto` int(11) NOT NULL AUTO_INCREMENT,
              `puesto` varchar(200) NOT NULL DEFAULT '0',
              `status` int(1) NULL DEFAULT '1',
              PRIMARY KEY (`id_puesto`)
            ) COLLATE='utf8_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
        ";

        if (!$conn->query($sql) === TRUE) {
            show_error("error al crear la tabla  tb_puestos". $conn->error , 500 );
            exit;                  
        }                
        
        /***********************************************************************************************
        *                               CARGA DE DATOS A LAS TABLAS        
        ************************************************************************************************/
        
        /*
            SE CARGA LA TABLA sys_navbar_items        
        */   
        $sql = "INSERT INTO `" . $db_name . "`.`sys_navbar_items` (`id`, `nombre_item`, `icon_item`, `link_item`, `identify`) VALUES
                (1, 'Sistema', 'ti-panel', '../Sistema', 'DS'),
                (2, 'Administración', 'ti-settings', '../Administracion', 'AD'),
                (3, 'Evaluación', 'ti-align-center', '../Evaluacion', 'EV');"
        ;  
        if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla ". $conn->error , 500 );
            exit;                  
        }           
        /*
            SE CARGA LA TABLA sys_navbar_subs_items        
        */        
        $sql = "INSERT INTO 
            `" . $db_name . "`.`sys_navbar_subs_items` (`id_sub_item`, `id_parent_item`, `name_sub_item`, `slug`, `link_sub_item`, `referency_word`)       
            VALUES
            (1, 1, 'Categorías', 'categorias', 'ctrl_sistema/categorias_sidebar', 'CA'),
            (2, 1, 'Subcategorías', 'subcategorias', 'ctrl_sistema/sub_categorias_sidebar', 'SC'),
            (3, 1, 'Roles', 'roles', 'ctrl_sistema/roles', 'RL'),           
            (4, 1, 'Permisos', 'permisos', 'ctrl_sistema/permisos', 'PR'),
            (5, 2, 'Colaboradores', 'colaboradores', 'ctrl_sistema/colaboradores', 'CL'),
            (6, 2, 'Puestos', 'puestos', 'ctrl_sistema/puestos', 'PT'),
            (7, 2, 'Renglones', 'renglones', 'ctrl_sistema/renglones', 'RG')
        ";
       if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla ". $conn->error , 500 );
            exit;                  
        }  
        
        /*
            SE CARGA LA TABLA tb_renglon        
        */        
        $sql = "INSERT INTO `" . $db_name . "`.`tb_renglon` (`id_renglon`, `nombre_renglon`,`descripcion`) VALUES
                (1, '011', 'Personal permanente del Congreso de la República de Guatemala');"
        ;
       if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla tb_renglon ". $conn->error , 500 );
            exit;                  
        }          
        /*
            SE CARGA LA TABLA tb_roles        
        */          
        $sql = "INSERT INTO `" . $db_name . "`.`tb_roles` (`id_rol`, `rol`, `descripcion_rol`) VALUES
                (1, 'Super Administrador', 'Administrador total del sistema.'),
                (2, 'Administrador', 'Encargado de la administración completa del sistema.'),                
                (3, 'Temporal', 'Rol temporal '),
                (4, 'Invitado', 'Colaborar con todos los permisos restringidos a excepción de poder consultar y ver datos');
            ";
       if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla tb_roles ". $conn->error , 500 );
            exit;                  
        }  
        /*
            SE CARGA LA TABLA sys_permisos        
        */         
        $sql = "INSERT INTO 
                `" . $db_name . "`.`sys_permisos` 
            (`id_permiso`, `id_rol`, `id_slug`, `crear`, `editar`, `eliminar`, `exportar`, `imprimir`, `leer`) 
            
            VALUES
            
            (1, 1, 1, 1, 1, 1, 1, 1, 1),
            (2, 1, 2, 1, 1, 1, 1, 1, 1),
            (3, 1, 3, 1, 1, 1, 1, 1, 1),
            (4, 1, 4, 1, 1, 1, 1, 1, 1),
            (5, 1, 5, 1, 1, 1, 1, 1, 1),
            (6, 1, 6, 1, 1, 1, 1, 1, 1),
            (7, 1, 7, 1, 1, 1, 1, 1, 1)
        ";
       if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla sys_permisos ". $conn->error , 500 );
            exit;                  
        } 
        /*
            SE CARGA LA TABLA tb_colaboradores        
        */
        $sql = "INSERT INTO `" . $db_name . "`.`tb_colaboradores` 
        (`id`, `id_colaborador`, `id_puesto`, `id_rol`,`id_renglon`, `nombres`, `apellidos`, `usuario`, `clave`,`md5_clave`,`no_telefono`, `nivel_academico`, `email`, `nit`, `dpi`, `imagen`, `usuario_activo`, `token`) 
        VALUES
        (1, 1, 139, 1, 1, 'Informatica', 'Desarrollo', 'idesarrollo', 'sup3rdes@',MD5('sup3rdes@'), '22447878', '', '', '', '', 'avatar.jpg', 0, '0');";
        
       if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla tb_colaboradores". $conn->error , 500 );
            exit;                  
        }  
        
        /*
            SE CARGA LA TABLA tb_puestos      
        */
        $sql = "INSERT INTO `" . $db_name . "`.`tb_puestos` (`id_puesto`, `puesto`) VALUES
            (1, 'ENCARGADO DE BANCOS'),
            (2, 'TECNICO LEGISLATIVO'),
            (3, 'CONTADORA GENERAL DEL CONGRESO'),
            (4, 'SECRETARIA EJECUTIVA III'),
            (5, 'SECRETARIA EJECUTIVA I'),
            (6, 'TECNICO PARLAMENTARIO II'),
            (7, 'TAQUIGRAFA PARLAMENTARIA II'),
            (8, 'TAQUIGRAFA PARLAMENTARIA I'),
            (9, 'SECRETARIA DE LA PRESIDENCIA'),
            (10, 'ENCARGADO DE COMISIONES OFICIALES'),
            (11, 'ENCARGADO DE REPRODUCCIONES'),
            (12, 'CONSERJE I'),
            (13, 'TELEFONISTA II'),
            (14, 'ENCARGADO DE MANTENIMIENTO'),
            (15, 'ENCARGADO DE QUORUM'),
            (16, 'ENCARGADO DE ARCHIVO'),
            (17, 'SUPERVISOR DE CONSERJES Y UJIERES'),
            (18, 'CONSERJE II'),
            (19, 'CONSERJE'),
            (20, 'TELEFONISTA I'),
            (21, 'ENCARGADO DE PRESUPUESTO'),
            (22, 'SECRETARIA EJECUTIVA II'),
            (23, 'JEFE SECRETARIAL DE LA PRESIDENCIA'),
            (24, 'SECRETARIA EJECUTIVA DE JUNTA DIRECTIVA'),
            (25, 'AUXILIAR ADMINISTRATIVO'),
            (26, 'SUB ENCARGADO DE INVENTARIOS'),
            (27, 'ENCARGADO DE CONSERJES Y UJIERES'),
            (28, 'TRABAJADOR DE MANTENIMIENTO'),
            (29, 'ASISTENTE'),
            (30, 'PROFESIONAL III'),
            (31, 'SUBENCARGADO DE CONSERJES Y UJIERES'),
            (32, 'ANALISTA INSTITUCIONAL'),
            (33, 'AUXILIAR DE INVENTARIOS'),
            (34, 'TECNICO OPERATIVO'),
            (35, 'ASISTENTE DE AUDITORIA INTERNA'),
            (36, 'GUARDALMACEN'),
            (37, 'JEFE DE PERSONAL'),
            (38, 'TECNICO DE INFORMATICA'),
            (39, 'TECNICO PARLAMENTARIO DE SEC. LEGI'),
            (40, 'AUXILIAR DE AUDITORIA II'),
            (41, 'TECNICO EN SOPORTE DE INFORMATICA'),
            (42, 'TECNICO OPERATIVO I'),
            (43, 'GUARDIA PARLAMENTARIA'),
            (44, 'AUXILIAR DE ARCHIVO'),
            (45, 'ANALISTA DE NOMINAS Y SALARIOS'),
            (46, 'MEDICO'),
            (47, 'JEFE DE LA UNIDAD DE CAPACITACION'),
            (48, 'AUXILIAR DE AUDITORIA I'),
            (49, 'SECRETARIA EJECUTIVA'),
            (50, 'TECNICO EN RECURSOS HUMANOS'),
            (51, 'TECNICO OPERATIVO II'),
            (52, 'ASISTENTE DE ATENCION CIUDADANA'),
            (53, 'AUXILIAR DE BODEGA DE SUMINISTROS'),
            (54, 'GUARDIA PARLAMENTARIO'),
            (55, 'ASISTENTE ADMINISTRATIVO'),
            (56, 'ASISTENTE ADMINISTRATIVO DEL CONGR'),
            (57, 'JEFE DEL DEPARTAMENTO DE TELECOMUNICACIONES DEL OR'),
            (58, 'TECNICO EN INFORMACION LEGISLATIVA'),
            (59, 'ENCARGADO DE MENSAJEROS'),
            (60, 'AUXILIAR FINANCIERO I'),
            (61, 'TECNICO PARLAMENTARIO I'),
            (62, 'MENSAJERO'),
            (63, 'TECNICO EN RELACIONES PUBLICAS'),
            (64, 'ASISTENTE UNIDAD DE CAPACITACION'),
            (65, 'TECNICO COMISION DE FINANZAS'),
            (66, 'ASISTENTE DE PROTOCOLO'),
            (67, 'TECNICO PARLAMENTARIO'),
            (68, 'JEFE UNIDAD TECNICA DE ANALISIS DE COYUNTURA - UTA'),
            (69, 'ASISTENTE LEGISLATIVO'),
            (70, 'TECNICO EN INFORMATICA'),
            (71, 'SECRETARIA'),
            (72, 'AUXILIAR DE IMPRESION'),
            (73, 'AUXILIAR DE OFICINA'),
            (74, 'ASISTENTE DE NOMINAS Y CONTRATOS'),
            (75, 'TECNICO ADMINISTRATIVO'),
            (76, 'TECNICO OPERATIVO III'),
            (77, 'ASISTENTE PROFESIONAL ADMINISTRATI'),
            (78, 'TECNICO EN MODERNIZACION'),
            (79, 'UJIER'),
            (80, 'AUXILIAR DE MONITOREO'),
            (81, 'DIRECTOR DE PROTOCOLO'),
            (82, 'COORDINADOR GENERAL DE LA UNIDAD PERMANENTE DE ASE'),
            (83, 'AUXILIAR DE AUDITORIA'),
            (84, 'JEFE DE EDECANES DE GUARDIA PARLAM'),
            (85, 'ENCARGADO DE SONIDO'),
            (86, 'TECNICO EN COMUNICACION SOCIAL'),
            (87, 'ASISTENTE TECNICO'),
            (88, 'ASISTENTE ADMINISTRATIVA'),
            (89, 'AUXILIAR FINANCIERO'),
            (90, 'EDECAN'),
            (91, 'ASESOR PARLAMENTARIO'),
            (92, 'ASISTENTE JURIDICO LABORAL'),
            (93, 'MAESTRA JARDIN INFANTIL'),
            (94, 'JEFE DEL DEPARTAMENTO DE SERVICIOS SOCIALES'),
            (95, 'MAESTRA DEL JARDIN INFANTIL'),
            (96, 'EDECAN DE PROTOCOLO'),
            (97, 'ASISTENTE DE DIRECCION DE PERSONAL'),
            (98, 'TECNICO PLANTA TELEFONICA'),
            (99, 'ASISTENTE DEL DEPARTAMENTO DE SERVICIOS SOCIALES'),
            (100, 'NIÑERA'),
            (101, 'NI?ERA JARDIN INFANTIL'),
            (102, 'AUXILIAR DE BODEGA'),
            (103, 'JEFE DE GRUPO'),
            (104, 'TRABAJADOR OPERATIVO'),
            (105, 'AUXILIAR DE MANTENIMIENTO'),
            (106, 'MAESTRA DE MUSICA DEL JARDIN INFANTIL'),
            (107, 'NI?ERA DEL JARDIN INFANTIL'),
            (108, 'ASISTENTE DE COMUNICACION SOCIAL'),
            (109, 'ASISTENTE TECNICO I'),
            (110, 'AUXILIAR EN ATENCION CIUDADANA'),
            (111, 'ASISTENTE ADMINISTRATIVO II'),
            (112, 'TECNICO'),
            (113, 'JEFE DE INFORMACION DEL CANAL DE TELEVISION'),
            (114, 'SUPERVISOR DE RECURSOS HUMANOS'),
            (115, 'DIRECTOR FINANCIERO'),
            (116, 'PROCURADOR DE LA ASESORIA JURIDICA'),
            (117, 'ASISTENTE PROFESIONAL ADMINISTRATIVO'),
            (118, 'PILOTO'),
            (119, 'AUXILIAR DE INFORMATICA'),
            (120, 'PSICOLOGA DEL JARDIN INFANTIL'),
            (121, 'FOTOGRAFO'),
            (122, 'ENFERMERA PROFESIONAL'),
            (123, 'AUXILIAR DE RECURSOS HUMANOS'),
            (124, 'MAESTRA DE EDUCACION FISICA'),
            (125, 'COORDINADORA GENERAL DEL ARCHIVO LEGISLATIVO Y BIB'),
            (126, 'COORDINADOR Y EDITOR DE LA PAGINA WEB'),
            (127, 'AUXILIAR DE BIBLIOTECA'),
            (128, 'ASISTENTE DIRECCION LEGISLATIVA'),
            (129, 'GUARDIA'),
            (130, 'CAMAROGRAFO'),
            (131, 'ASISTENTE SUBDIRECCION ADMINISTRATIVA'),
            (132, 'ANALISTA DE COMPRAS'),
            (133, 'JEFE DEL DEPARTAMENTO DE EVALUACION DEL DESEMPE?O '),
            (134, 'PRESIDENTE - DIPUTADO'),
            (135, 'DIPUTADO'),
            (136, 'PRIMER VICEPRESIDENTE-DIPUTADO'),
            (137, 'SECRETARIO EJECUTIVO I'),
            (138, 'DIRECTOR I'),
            (139, 'SUPER ADMINISTRADOR DEL SISTEMA');
        ";
        
       if (!$conn->query($sql) === TRUE) {
            show_error("error al insertar los datos en la tabla tb_puestos ". $conn->error , 500 );
            exit;                  
        }          
        /*
        * se crea la base de datos y las tablas principales del sistema.
        */
        
        $file = 'C:\xampp\htdocs\master';
        $newfile = 'C:\xampp\htdocs\\'.  $sys_name;    
        
        if($this->xcopy($file, $newfile)){
            //SE ASIGNA LA DIRECCION A UNA VARIABLE PARA NO PERDERLA
            $new_address = $root_sys;

            $data = '<?php' . "\n " .
                    'define(\'ROOT_SYS\',"http://localhost/master");'."\n".
                    'define(\'NAME_SYS\',"");'."\n".
                    'define(\'DB_USER\',"");'."\n".
                    'define(\'DB_NAME\',"");'."\n".
                    'define(\'DB_PASS\',"");'."\n";

            if ( !write_file(FCPATH .'/assets/sys_data_init.php', $data)){
                echo 'Error, no fue posible crear el archivo de inicio por favor consulte con su webmaster.';
            }else{  
                /**
                * SE ENVIA AL ROOT DEL SISTEMA.            
                */
               header('Location: ' . $new_address);
                //redirect('/account/login', 'refresh');            
            }             
        }        
    }   
    
    public function xcopy($source, $dest, $permissions = 0755){
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            // Deep copy directories
            $this->xcopy("$source/$entry", "$dest/$entry", $permissions);
        }
        
        // Clean up
        $dir->close();
        return true;
    }    
    
    private function sidebar_values(){

        $this->data['parents'] = $this->mdl_sidebar_items->list_sidebar_parents_items( $this->session->userdata("id_work") );
        $this->data['children'] = $this->mdl_sidebar_items->list_sidebar_items_with_children(  $this->session->userdata("id_work"));
        return $this->data;
    }
        
    public function login(){        		
        if( $this->db->database == ""){
             echo redirect('welcome/index');
        }else{
            /**
            * evita que salga del sistema sin eliminar los datos
            */
            if($this->session->userdata('allow_token')){
		
                $this->dashboard();

            }else{
                $this->load->view("login/login");
            }       
        }
    }

    public function check_login(){
        
        $data = json_decode(file_get_contents('php://input'), true);       
        $this->load->model("mdl_login");
        $usr = $data['usuario'];
        $pass = md5($data['clave']);
                                  
        $respond = $this->mdl_login->check_permission($usr, $pass);

		if(gettype($respond) == 'array'){
			$errors['error'] = "";
			$sessionArray = array(
                'usuario'  => $usr,
                'allow_token' => md5(uniqid(mt_rand(),TRUE)),
                'nombre' => $respond[0]['nombre'],
                'id_user' => $respond[0]['id'],
                'id_work' => $respond[0]['id_colaborador'],
                'imagen' => $respond[0]['imagen'],
                'rol' => $respond[0]['id_rol'],
                /*'tipo_colaborador' => $respond[0]['id_tipo_colaborador'],
                'oficina' => $respond[0]['id_oficina'],
                'depto' => $respond[0]['id_depto'],
                'direccion' => $respond[0]['id_direccion'],*/
             //   'puestojefe' => $respond[0]['puesto'],

			);
			$this->session->set_userdata($sessionArray);	
           
			/* insert token an change status */
			
			$request = $this->mdl_login->update_online_user($usr, $pass, $this->session->userdata('allow_token'));
			if($request){
				echo "done";
			}else{
				echo "error al 0x00001 update DB.";
			}
					
		}else{
            echo $respond;
        }      
    }   
    
    public function dashboard(){
		/* if token is alive */
		if($this->session->userdata('allow_token')){
		
            $data['title'] = $this->uri->segment(1);
            $this->load->view("inc/header", $data);
            $this->load->model('inc/mdl_sidebar_items');
            $this->sidebar_values();
            $this->load->view('inc/sidebar', $this->data);
            $this->load->view('inc/navbar');
            $this->load->view('core_views/dashboard/overview');
		
		}else{
			$this->login();
		}
    }
}
