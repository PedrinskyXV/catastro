<?php

namespace App\Controllers;

class InicioController extends BaseController
{
    public function index()
    {
        $datos['titulo'] = ucfirst('bienvenido');
        $datos['head'] = view('Template/head', $datos);        
        $datos['header'] = view('Template/header'); 
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $datos['bitacora'] = view('Bitacora/tabla');

        return view('Inicio/index', $datos);
    }
}
