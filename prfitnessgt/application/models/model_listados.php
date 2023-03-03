<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Listados extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
/* nombre del diputado, director o jefe */
    public function get_oficina_jefe($of, $us){

        /* busca la direccion perteneciente  */
        $this->db->select("a.id_direccion, c.nombre_direccion");
        $this->db->from("tb_oficina a");
        $this->db->join("tb_oficina b", "a.id_direccion = b.id_direccion");
        $this->db->join("tb_direccion c", "a.id_direccion = c.id_direccion");
        $this->db->where("a.id_oficina =", $of);
        $this->db->group_by("a.id_direccion");
        $query = $this->db->get();

        $resultado = $query->result_array();

        /* se obtiene el diputado, direcctor o jefe del área */
        $this->db->select("a.id_tipo_colaborador, CONCAT(a.nombres, ' ', a.apellidos) as nombres ");
        $this->db->from("tb_colaboradores a");
        $this->db->join("tb_oficina b", "a.id_oficina = b.id_oficina");
        $this->db->join("tb_tipos_colaboradores c", "a.id_tipo_colaborador = c.id_tipo_colaborador");
        $this->db->join("tb_direccion d", "b.id_direccion = d.id_direccion");
        $this->db->where("b.id_direccion =", $resultado[0]['id_direccion']);
        $query = $this->db->get();

        /* se recorre el arreglo para buscar la autoridad mas alta en la gerarquía de la oficina */
        if(!empty($query->result_array())){
            $jefes = $query->result_array();
            $nombres_jefe_inmediato = array();
            $ids = array();
            for ($i=0; $i < count($jefes) ; $i++) { 
               $ids[$i] = intval($jefes[$i]["id_tipo_colaborador"]) ;
            }
            /* se almacena el id de la gerarquía más alta  */
            $jefe_inmediato = min($ids);

            /* se devuelve el nombre del diputado, director o jefe. */
            for ($i=0; $i < count($jefes); $i++) { 
                if(intval($jefes[$i]["id_tipo_colaborador"]) === $jefe_inmediato){
                    return $nombres_jefe_inmediato["nombres"] = $jefes[$i]["nombres"];
                } 
            }
            
        }else{
            return false;
        }
    }

    /* devuelve las oficinas al que pertenece el usuario logueado */
    public function get_listado_oficinas($of, $tc){
        /* busca la direccion perteneciente  */
        $tc = intval($tc);
        if($tc != 3){
            $this->db->select("a.id_direccion, c.nombre_direccion");
            $this->db->from("tb_oficina a");
            $this->db->join("tb_oficina b", "a.id_direccion = b.id_direccion");
            $this->db->join("tb_direccion c", "a.id_direccion = c.id_direccion");
            $this->db->where("a.id_oficina =", $of);
            $this->db->group_by("a.id_direccion");
            $query = $this->db->get();
    
            $resultado = $query->result_array();
    
            $this->db->select("a.id_oficina, a.nombre, b.nombre_direccion");
            $this->db->from("tb_oficina a");
            $this->db->join("tb_direccion b", "a.id_direccion = b.id_direccion");
            $this->db->where("a.id_direccion =", $resultado[0]['id_direccion']);
            $query = $this->db->get();
            return $query->result_array();

        }else{

            /* se obtiene la direccion y el departamento al que pertenece el jefe */
            $this->db->select("id_direccion, id_depto");
            $this->db->from("tb_oficina");
            $this->db->where("id_oficina =", $of);
            $query_of = $this->db->get();
            $resultado = $query_of->result_array();

            if(!empty($resultado)){
                $this->db->select("a.id_oficina, a.nombre, e.nombre_direccion");
                $this->db->from("tb_oficina a");
                $this->db->join("tb_colaboradores b", "a.id_depto = a.id_depto");
                $this->db->join("tb_departamento c", "a.id_depto = c.id_depto");
                $this->db->join("tb_unidad d", "c.id_depto = d.id_depto");
                $this->db->join("tb_direccion e", "a.id_direccion = e.id_direccion");
                $this->db->where("b.id_tipo_colaborador =", $tc); 
                $this->db->where("a.id_direccion = ", $resultado[0]['id_direccion'] ); 
                $this->db->where("a.id_depto = ", $resultado[0]['id_depto'] ); 
    
                $this->db->group_by('a.id_oficina');          
                $query = $this->db->get();            
    
                return $query->result_array();;

            }else{
                return "no existen datos";
            }
        }
    }

    public function get_colaboradores_por_oficina($of, $eval){

        $this->db->select("a.id_colaborador, a.id, CONCAT(a.nombres, ' ', a.apellidos) as nombres ");
        $this->db->from("tb_colaboradores a");
        $this->db->join("tb_oficina b","a.id_oficina = b.id_oficina", "inner");
        $this->db->where("b.id_oficina =", $of);
        /* no muestra ninguna autoridad alta o evaluadores */
        if($this->session->userdata("tipo_colaborador") == 1 || $this->session->userdata("tipo_colaborador") == 2){
            /* diputados y direcctores no */
            $ignore = array(1,2);
        }else{
            /* diputados , direcctores y jefes no */
            $ignore = array(1,2,3);
        }
        $this->db->where_not_in('a.id_tipo_colaborador', $ignore);
        $query = $this->db->get();
        $eval = intval($eval);

        if(!empty($query->result_array())){

            if($eval === 1 ){

                $this->db->select("b.id_colaborador, b.id, CONCAT(b.nombres, ' ', b.apellidos) as nombres  ");
                $this->db->from("tb_evaluacion a");
                $this->db->join("tb_colaboradores b","a.id_colaborador = b.id", "inner");
                $this->db->where("a.id_tipo_eval =", $eval);
                $this->db->where("a.id_oficina = ", $of);  
                $this->db->where("YEAR ( a.fecha_evaluacion  ) = ", date("Y"));  

                $query_dos = $this->db->get();
                $mainArray  = $query->result_array();
                $subArray  = $query_dos->result_array();
                    
                /* elimina los colaboradores ya evaluados del anio actual */
                foreach ($mainArray as $key => $mainData){
                    foreach ($subArray as $subData){
                        if($mainData['nombres'] === $subData['nombres']){
                            unset($mainArray[$key]);
                            break;
                        }
                    }
                }           
                return $mainArray;
            }else{
                return $query->result_array();
            }
        }else{
            return "no existen datos";
        }
    }

    public function get_datos_por_oficina($of){
        $this->db->select("a.id_direccion, a.id_depto, a.id_unidad");
        $this->db->from("tb_oficina	a");
        $this->db->where("a.id_oficina = ",$of);
        $query = $this->db->get();
        if(!empty($query->result_array())){
            return $query->result_array();
        }else{
            return "no existen datos";
        }
    }

    public function get_listado_roles($rol){
        $this->db->select("a.id_rol, a.rol");
        $this->db->from("tb_roles a");
        if(intval($rol) == 7){
            $roles_validos = [7,3];
            $this->db->where_in("a.id_rol",$roles_validos);   
        }
        
        $query = $this->db->get();
        if(!empty($query->result_array())){
            return $query->result_array();
        }else{
            return "no existen datos";
        }
    }

}

/* End of file ModelName.php */
