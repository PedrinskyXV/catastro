<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('acceso', 'AccesoController::Login');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->get('/', 'AccesoController::Login');

$routes->group('root', [], function($routes){
    $routes->get('', '');
});

$routes->group('acceso', function($routes){
    $routes->get('/', 'AccesoController::Login');
    $routes->post('autentificar', 'AccesoController::Autentificar');
});

$routes->get("empresa/index", "EmpresaController::Index");
$routes->get('empresa/agregar', 'EmpresaController::Agregar');
$routes->get("empresa/ajaxEmpresas", "EmpresaController::ajaxEmpresa");
$routes->get('empresa/buscarPersona/(:num)', 'EmpresaController::BuscarPersona/$1');

$routes->post('empresa/insertar', 'EmpresaController::insertar');

$routes->get('usuario/perfil', 'UsuarioController::MiPerfil');

$routes->get('usuario/index', 'UsuarioController::Index');
$routes->get('usuario/agregar', 'UsuarioController::Agregar');
$routes->post('usuario/insertar', 'UsuarioController::insertar');
$routes->get('usuario/ajaxUsuarios', 'UsuarioController::ajaxUsuarios');

$routes->get('usuario/editar/(:num)', 'UsuarioController::Editar/$1');
$routes->post('usuario/editarPerfil', 'UsuarioController::EditarPerfil');
$routes->post('usuario/modificar', 'UsuarioController::Modificar');
$routes->get('usuario/editarClave/(:num)', 'UsuarioController::EditarClave/$1');
$routes->post('usuario/CambiarClave', 'UsuarioController::CambiarClave');
$routes->get('usuario/ver/(:num)', 'UsuarioController::Ver/$1');
$routes->get('usuario/estado/(:num)', 'UsuarioController::CambiarEstado/$1');


$routes->get('logout', 'AccesoController::CerrarSesion');

$routes->get('zona/index', 'ZonaController::Index');
$routes->get('zona/agregar', 'ZonaController::Agregar');
$routes->get('zona/ajaxZonas', 'ZonaController::ajaxZonas');

$routes->get('colonia/index', 'ColoniaController::Index');
$routes->get('colonia/agregar', 'ColoniaController::Agregar');
$routes->get('colonia/ajaxColonias', 'ColoniaController::ajaxColonias');