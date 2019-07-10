<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
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
/* Default */
$route['default_controller'] = 'login/ctrlogin';
$route['module_name'] = 'login/ctrlogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'home/ctrhome';
$route['signout'] = 'home/ctrhome/closesession';
$route['start_quest/([A0-9=]+)'] = 'home/ctrhome/start_quest/$1';
$route['view_results_pre/([A0-9=]+)'] = 'home/ctrhome/view_quest_pre/$1';
$route['view_results_post/([A0-9=]+)'] = 'home/ctrhome/view_quest_post/$1';
$route['view_results_admin/([A0-9=]+)'] = 'home/ctrhome/view_quest_admin/$1';
$route['graficas'] = 'home/ctrhome/graficar';
$route['start_quest_admin/([A0-9=]+)'] = 'home/ctrhome/start_quest_admin/$1';

$route['carga_calificaciones'] = 'home/ctrhome/carga_calificaciones';
$route['carga_usuarios'] = 'home/ctrhome/carga_usuarios';
$route['carga_grupos'] = 'home/ctrhome/carga_grupos';
$route['carga_instructores'] = 'home/ctrhome/carga_instructores';
$route['admon_usuarios'] = 'home/ctrhome/admon_usuarios';
$route['admon_grupos'] = 'home/ctrhome/admon_grupos';
$route['test'] = 'home/ctrhome/tests';

$route['graficar'] = 'home/ctrhome/new_graph';
$route['grafica_general'] = 'home/ctrgraph';

$route['settings_questions'] = 'home/ctrsettings/vwedit_preguntas';
