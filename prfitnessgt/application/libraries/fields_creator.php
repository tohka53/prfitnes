<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fields_creator {

    private $CI;
    public $table;
    public $costum_attr = array();
    public $selects = array();
    public $inputs = array();
    public $avoids_fields = array();

    #datos para los nuevos selects
    public $selects_data = array();


    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }
    #ingresa el nombre de la tabla para su busqueda en la base de datos.
    public function set_table($table){
        $this->CI->load->model('fields_creator/fields_creator_model');
        $check= $this->CI->fields_creator_model->check_if_tb_exist($table);
        if($check){
            $this->table = $table;
        }else{
            $error = 'Error 0x000DT01 por favor consulta con tu webmaster';
            throw new Exception($error);
        }
        
    }
    #ingresa los atributos que se desean agregar o cambiar en el campo.
    public function add_costum_attr($attributes){
        $this->costum_attr = $attributes;
    }
    #elimina los campos que no se desean mostrar en el formulario.
    public function avoid_field($target){
        $this->avoids_fields = $target;
    }


    public function make_select($field, $table_select, $field_select){
        $this->selects_data[$field] = array(
            'campo' => $field,
            'tabla' => $table_select,
            'campo_select' => $field_select,
            'required' => ''
        );
    }

    #crea un select con los campos necesarios
    private function create_select($selects){//$field, $table_select, $field_select

        foreach ($selects as $key => $value) {
            # code...

            //print_r($value['campo']);
            $this->CI->load->model('fields_creator/fields_creator_model');
            $detalles_select = $this->CI->fields_creator_model->get_data_to_create_select($value['campo'], $value['tabla'], $value['campo_select']);
            
            #dibuja el select            
            $this->selects[$value['campo']] = $this->draw_select($value['campo'],$detalles_select);         
        }


       //$this->display_data_fake($select_array);
            
    }

    private function draw_select($field,$options){

        $attributes = array( 
            'name' => $field,
            'id' => $field,
            'class' => 'form-control valid'
        );

        if(!empty($this->costum_attr[$field])){
            $addAttr = $this->costum_attr[$field];
            $attributes = array_merge($attributes , $addAttr);
        }else{
            $attributes = $attributes;
        }        
        
        #se abre la etiqueta select y se insertan todos los atributos
        $select = "<select ";
        foreach ($attributes as $key => $value) {
            $select .= " " . $key ."='". $value."'";
        }
        $select .= '><option selected="" value="">- Selecciona -</option>';

        #se agregan todos las opciones que se encuentran en la base de datos.
        for ($i=0; $i < count($options); $i++) { 
            # code...            
            $select .="<option value='". $options[$i]->value."'>" .$options[$i]->text. "</option>";            
        }


       // $this->display_data_fake( $options );
        #se cierra el select.
        $select .= "</select>";

        return $select;      
    }

    #adquiere todos los campos que se necesitan en el formulario.
    public function  create_inputs($attr_customs){
        $this->CI->load->model('fields_creator/fields_creator_model');
        $detalles = $this->CI->fields_creator_model->get_columns_details($this->table);
        $inputs = array();
        foreach ($detalles as $key) {
            $input[$key->nombre] = $this->create_text_input($key,$attr_customs);
        }

        $this->inputs = $input;
        //$this->display_data_fake( $this->inputs);
        //return $input;
    }

    #crea todos los campos que se vayan a mostrar en el formulario
    public function create_text_input($attr,$attr_customs){
        
        $attributes = array(
            'required' => $this->change_required_value($attr->requerido),
            'type' => $this->change_text_or_numeric_field($attr->tipo),
            'name' => $attr->nombre,
            'id' => $attr->nombre,
            'maxlength' => $attr->maxlength = ($this->change_text_or_numeric_field($attr->tipo) == 'text') ?  $attr->maxlength : $attr->maxlength =  $attr->smaxlength,
            "minlength" => $attr->maxlength = ($this->change_text_or_numeric_field($attr->tipo) == 'text') ?  "" : $attr->maxlength =  "0",
            'value' => '',
            'placeholder' => $placeholder = ($this->change_text_or_numeric_field($attr->tipo) == 'text') ? $placeholder = "ej: Xxxx Xxxxx": $placeholder = "ej 10" ,
            'class' => 'form-control valid'
        );
        
        if(!empty($attr_customs[$attr->nombre])){
            $addAttr = $attr_customs[$attr->nombre];
            $attributes = array_merge($attributes , $addAttr);
        }else{
            $attributes = $attributes;
        }
        

        $input = "<input ";
        foreach ($attributes as $key => $value) {
            $input .= " " . $key ."='". $value."'";
        }
        
        return $input . " >";
    }

    #cambia los valores obtenidos de la base de datos a la sintaxis requerida y entendible para html
    private function change_required_value($required){
        return $required = ($required == "YES")? $required = 'required' : $required = '';
    }

    #cambia los valores de varchar a text, int a numeric.
    private function change_text_or_numeric_field($type){
        return $type = ($type == "varchar")? $required = 'text' : $required = 'number';
    }

    #imprime los atributos ingresados a modo de test
    public function show_costum_attr(){
        print_r($this->costum_attr);
    }

    #imprime los campos generados a modo de test
    public function show_inputs(){
        //print_r($this->inputs);
    }

    private function display_data_fake($x){
        print_r($x);
    }

    private function execute_avoid($avoids){
        foreach ($avoids as $key) {
            # code...
            unset($this->inputs[$key]);
        }
    }



    public function render(){
        $this->costum_attr;
        $this->selects;        
        $this->avoids_fields;

        $this->create_inputs($this->costum_attr);  
        $this->execute_avoid($this->avoids_fields);

        if(!empty($this->selects_data)){
            $this->create_select($this->selects_data);
            $this->inputs = array_merge($this->inputs ,$this->selects);
        }        
        //$this->display_data_fake($this->inputs);
        return $this->inputs;

    }
}