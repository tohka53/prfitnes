<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('create_input_text'))
{
    function create_input_text($attributes){

        $default_attributes = array(
            'required' => '',
            'type' => '',
            'name' => '',
            'id' => '',
            'value' => '',
            'placeholder' => '',
            'class' => ''
        );

        if(empty($attributes)){
            $attributes = $default_attributes;
        }else{
            $attributes = $attributes + $default_attributes;
        }


        $input = "<input ";
        foreach ($attributes as $key => $value) {
            # code...
            $input .= " " . $key ."='". $value."'";
        }
        
        echo $input . " >";
    } 
}