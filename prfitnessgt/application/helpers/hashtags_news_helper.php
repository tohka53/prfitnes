<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* La function @check_token  
* verifica la existencia de un token de ingreso 
* referente al usuario logueado.
* si el token existe tendrá acceso al sistema
* y a los modulos asignados según sus permisos.
*/

if ( ! function_exists('hashtags_news'))
{
    function hashtags_news($str, $value = true) {
		 /*busca noticias por medio del hashtag **/
		$str = str_replace('á', 'a', $str); 
		$str = str_replace('é', 'e', $str); 
		$str = str_replace('í', 'i', $str); 
		$str = str_replace('ó', 'o', $str); 
		$str = str_replace('ú', 'u', $str); 
		$str = str_replace('Á', 'A', $str); 
		$str = str_replace('É', 'E', $str); 
		$str = str_replace('Í', 'I', $str); 
		$str = str_replace('Ó', 'O', $str); 
		$str = str_replace('Ú', 'U', $str); 
		
		$class = ($value)? 'class="badge badge-primary text-white': 'text-info font-weight-bold d-none d-md-inline-block';
		$regex = "/#+([a-zA-ZáéíóúÁÉÍÓÚ0-9_]+)/";
		$str = preg_replace($regex, '<a href="'. base_url() .'hashtags/$1"'. $class. '">$0</a>', $str);
		return($str);
    }  
}

