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
/*$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/

$route['museos/(:any)']['get'] = 'museos/view/$1';
$route['museos']['get'] = 'museos';
$route['centros/(:any)']['get'] = 'centros/view/$1';
$route['centros']['get'] = 'centros';
$route['colecciones/(:any)']['get'] = 'colecciones/view/$1';
$route['colecciones']['get'] = 'colecciones';
$route['exposiciones/(:any)']['get'] = 'exposiciones/view/$1';
$route['exposiciones']['get'] = 'exposiciones';
$route['noticias/(:any)']['get'] = 'noticias/view/$1';
$route['noticias']['get'] = 'noticias';
$route['multimedia/(:any)']['get'] = 'multimedia/view/$1';
$route['multimedia']['get'] = 'multimedia';
$route['agenda/(:any)']['get'] = 'agenda/view/$1';
$route['agenda']['get'] = 'agenda';
$route['search']['post'] = 'home/search';
$route['fmn']['get'] = 'home/fmn';
$route['educacion']['get'] = 'home/educacion';
$route['contactenos']['get'] = 'contactenos';
$route['contactenos']['post'] = 'contactenos/send';
$route['home']['get'] = 'home';

/* URLS for searching inside museums tables */

$route['noticias-museos/(:any)']['get'] = 'noticias/view/$1/_museos';
$route['exposiciones-museos/(:any)']['get'] = 'exposiciones/view/$1/_museos';
$route['multimedia-museos/(:any)']['get'] = 'multimedia/view/$1/_museos';
$route['agenda-museos/(:any)']['get'] = 'agenda/view/$1/_museos';

/* Routes for administration */

$route['admin/noticias']['get'] = 'admin/noticias';
$route['admin/noticias/new']['get'] = 'admin/nueva_noticia';
$route['admin/noticias/(:num)']['get'] = 'admin/noticias/$1';
$route['admin/noticias']['post'] = 'admin/set_noticia';
$route['admin/noticias/(:num)/destroy']['post'] = 'admin/eliminar_noticia/$1';

$route['admin/obras']['get'] = 'admin/obras';
$route['admin/obras/new']['get'] = 'admin/nueva_obra';
$route['admin/obras/(:num)']['get'] = 'admin/obras/$1';
$route['admin/obras']['post'] = 'admin/set_obra';
$route['admin/obras/(:num)/destroy']['post'] = 'admin/eliminar_obra/$1';

$route['admin/exposiciones']['get'] = 'admin/exposiciones';
$route['admin/exposiciones/new']['get'] = 'admin/nueva_exposicion';
$route['admin/exposiciones/(:num)']['get'] = 'admin/exposiciones/$1';
$route['admin/exposiciones']['post'] = 'admin/set_exposicion';
$route['admin/exposiciones/(:num)/destroy']['post'] = 'admin/eliminar_exposicion/$1';

$route['admin/colecciones']['get'] = 'admin/colecciones';
$route['admin/colecciones/new']['get'] = 'admin/nueva_coleccion';
$route['admin/colecciones/(:num)']['get'] = 'admin/colecciones/$1';
$route['admin/colecciones']['post'] = 'admin/set_coleccion';
$route['admin/colecciones/(:num)/destroy']['post'] = 'admin/eliminar_coleccion/$1';

$route['admin/multimedia']['get'] = 'admin/multimedia';
$route['admin/multimedia/new']['get'] = 'admin/nueva_multimedia';
$route['admin/multimedia/(:num)']['get'] = 'admin/multimedia/$1';
$route['admin/multimedia']['post'] = 'admin/set_multimedia';
$route['admin/multimedia/(:num)/destroy']['post'] = 'admin/eliminar_multimedia/$1';

$route['admin/establecimientos']['get'] = 'admin/establecimientos';
$route['admin/museo/new']['get'] = 'admin/nuevo_establecimiento/museo';
$route['admin/instituto/new']['get'] = 'admin/nuevo_establecimiento/instituto';
$route['admin/establecimientos/(:num)']['get'] = 'admin/establecimientos/$1';
$route['admin/establecimientos/museo']['post'] = 'admin/set_establecimiento/museo';
$route['admin/establecimientos/instituto']['post'] = 'admin/set_establecimiento/instituto';
$route['admin/establecimientos/(:num)/destroy']['post'] = 'admin/eliminar_museo/$1';//should be establecimiento

$route['admin/agenda']['get'] = 'admin/agenda';
$route['admin/agenda/new']['get'] = 'admin/nueva_agenda';
$route['admin/agenda/(:num)']['get'] = 'admin/agenda/$1';
$route['admin/agenda']['post'] = 'admin/set_agenda';
$route['admin/agenda/(:num)/destroy']['post'] = 'admin/eliminar_agenda/$1';

$route['admin/fechas-agenda']['get'] = 'admin/fechas_agenda';
$route['admin/fechas-agenda/new']['get'] = 'admin/nueva_fechas_agenda';
$route['admin/fechas-agenda/(:num)']['get'] = 'admin/fechas_agenda/$1';
$route['admin/fechas-agenda']['post'] = 'admin/set_fechas_agenda';
$route['admin/fechas-agenda/(:num)/destroy']['post'] = 'admin/eliminar_fechas_agenda/$1';

$route['admin/contactenos']['get'] = 'admin/contactenos';
$route['admin/contactenos/(:num)']['get'] = 'admin/contactenos/$1';


$route['admin/noticias-museos']['get'] = 'admin/noticias_museos';
$route['admin/noticias-museos/(:num)']['get'] = 'admin/noticias_museos/$1';
$route['admin/noticias-museos']['post'] = 'admin/set_noticia_museos';

$route['admin/agenda-museos']['get'] = 'admin/agenda_museos';
$route['admin/agenda-museos/(:num)']['get'] = 'admin/agenda_museos/$1';
$route['admin/agenda-museos']['post'] = 'admin/set_agenda_museos';

$route['admin/fechas-agenda-museos']['get'] = 'admin/fechas_agenda_museos';
$route['admin/fechas-agenda-museos/(:num)']['get'] = 'admin/fechas_agenda_museos/$1';
$route['admin/fechas-agenda-museos']['post'] = 'admin/set_fechas_agenda_museos';

$route['admin/exposiciones-museos']['get'] = 'admin/exposiciones_museos';
$route['admin/exposiciones-museos/(:num)']['get'] = 'admin/exposiciones_museos/$1';
$route['admin/exposiciones-museos']['post'] = 'admin/set_exposicion_museos';

$route['admin/multimedia-museos']['get'] = 'admin/multimedia_museos';
$route['admin/multimedia-museos/(:num)']['get'] = 'admin/multimedia_museos/$1';
$route['admin/multimedia-museos']['post'] = 'admin/set_multimedia_museos';


$route['default_controller'] = 'home';

$route['(:any)'] = ''; //send to error page
$route['(:any)/(:any)'] = ''; //send to error page
$route['(:any)/(:any)/(:any)'] = ''; //send to error page