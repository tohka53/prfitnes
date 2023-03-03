<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: //intranet.congreso.gob.gt/');  //I have also tried the * wildcard and get the same response
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome/logged';
//$route['default_controller'] = 'ctrl_website/index';
$route['404_override'] = 'welcome/logged';
$route['translate_uri_dashes'] = FALSE;


if(DB_NAME != NULL){
    require_once( BASEPATH .'database/DB.php' );
    $db =& DB();
    $db->select('link_sub_item, slug');
    $query = $db->get( 'sys_navbar_subs_items' );
    $result = $query->result();
    foreach( $result as $row ){
        $slug = $row->slug;
        $controller = $row->link_sub_item;
        $route[ $slug ]  = $controller . "/";

        $route[ $slug . '/add'] = $controller . '/add';
        $route[ $slug . '/insert'] = $controller . '/$1/insert';
        $route[ $slug . '/insert_validation'] = $controller . '/$1/insert_validation';
        $route[ $slug . '/success'] = $controller . '/$1/success';
        $route[ $slug . '/success/:num'] = $controller . '/$1/success';
        $route[ $slug . '/delete/:num'] = $controller . '/$1/delete';
        $route[ $slug . '/delete_file/:any/:any'] = $controller . '/$1/delete_file';
        $route[ $slug . '/edit/:num'] = $controller . '/$1/edit';
        $route[ $slug . '/update_validation/:num'] = $controller . '/$1/update_validation';
        $route[ $slug . '/update/:num'] = $controller . '/$1/update';
        $route[ $slug . '/ajax_list_info'] = $controller . '/$1/ajax_list_info';
        $route[ $slug . '/ajax_list'] = $controller . '/ajax_list';
        $route[ $slug . '/read/:num'] = $controller . '/$1/read';
        $route[ $slug . '/export'] = $controller . '/$1/export';
        $route[ $slug . '/print'] = $controller . '/$1/print';
        $route[ $slug . '/upload_file/:any'] = $controller . '/$1/upload_file';
    }    
}


/**
* rutas personalizadas
*/

$route['revisar'] = 'welcome/check_system_data';
$route['crear_db'] = 'welcome/crear_db';
$route['login'] = 'welcome/login';
$route['revisar_logueo'] = 'welcome/check_login';
$route['dashboard'] = 'welcome/dashboard';

$route['cerrar_sesion'] = 'ctrl_sistema/close_session';

/**
* rutas website
*/