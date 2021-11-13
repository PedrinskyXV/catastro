<?php

namespace App\Controllers;

use App\Models\BitacoraModel;
use App\Models\ZonaModel;
use \Hermawan\DataTables\DataTable;

class BitacoraController extends BaseController
{

    public function Index()
    {
        $datos['titulo'] = ucfirst('zonas');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');
        
        $datos['bitacora'] = view('Bitacora/tabla');

        return view('Bitacora/index', $datos);
    }

    public function ajaxBitacoras()
    {
        $bitacora = new BitacoraModel();
        $builder = $bitacora->obtenerBitacoras();

        $data = DataTable::of($builder)
            ->addNumbering('no')
            ->setSearchableColumns(['info','fecha', 'usuario.usuario']);           

        return $data->postQuery(function($builder){
            $builder->orderBy('id_bitacora', 'desc');
        })->toJson(true);
    }
}
