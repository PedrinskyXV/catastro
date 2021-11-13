<?php

namespace App\Controllers;

use App\Models\ColoniaModel;
use App\Models\ZonaModel;
use \Hermawan\DataTables\DataTable;

class ColoniaController extends BaseController
{
    public function Agregar()
    {
        $datos['titulo'] = ucfirst('agregar colonia');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');
        $zona = new ZonaModel();
        $datos['zonas'] = $zona->findAll();
        return view('Colonia/agregar', $datos);
    }
    public function Editar()
    {
        $datos['titulo'] = ucfirst('agregar colonia');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');
        $zona = new ZonaModel();
        $datos['zonas'] = $zona->findAll();
        return view('Colonia/editar', $datos);
    }

    public function Index()
    {
        $datos['titulo'] = ucfirst('colonias');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');
        

        return view('Colonia/index', $datos);
    }

    public function ajaxColonias()
    {
        $colonia = new ColoniaModel();
        $builder = $colonia->obtenerColonias();

        $data = DataTable::of($builder)
            ->addNumbering('no')
            ->setSearchableColumns(['id_colonia','colonia.nombre', 'zona.nombre'])
            ->edit('estado', function ($row) {
                return '<span class="badge bg-' . ($row->estado ? 'success' : 'secondary') . '">' . ($row->estado ? 'Disponible' : 'No Disponible') . '</span>';
            })
            ->add('action', function ($row) {

                $btns = '<div class="dropdown">
                            <button class="btn bg-dark-light dropdown-toggle" type="button" id="btnAcciones" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnAcciones">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle"></i> Ver </a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Editar </a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text"></i> Dar de baja </a></li>
                            </ul>
                        </div>';

                /* $btn .= '<button type="button" class="btn btn-info btn-sm me-2" onclick="alert(\'GENERAR ESTADO DE CUENTA: '.$row->id_empresa.'\')"><i class="bi bi-file-earmark-text"></i></button>'; */
                return $btns;
            });            

        return $data->postQuery(function($builder){
            $builder->orderBy('id_colonia', 'asc');
        })->toJson(true);
    }
}
