<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $datos['titulo'] = ucfirst('acceso');
        $datos['head'] = view('Template/head', $datos);        
        $datos['header'] = view('Template/header'); 
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');
        return view('Empresa/agregar', $datos);
    }
}
