<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\PersonaModel;
use \Hermawan\DataTables\DataTable;

class EmpresaController extends BaseController
{
    public function Agregar()
    {
        $datos['titulo'] = ucfirst('agregar empresa');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');
        
        return view('Empresa/agregar', $datos);
    }

    public function Index()
    {
        $datos['titulo'] = ucfirst('empresas');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        return view('Empresa/index', $datos);
    }

    public function insertar()
    {
        var_dump($_POST);
        die();
        
        if ($_POST) {
            

            $data = [
                'usuario' => $nuevoUsuario,
                'rol' => $this->request->getVar('sRol'),
                'nombre' => $this->request->getVar('unombre'),
                'apellido' => $this->request->getVar('uapellido'),
                'correo' => $this->request->getVar('ucorreo'),
            ];

            

            if (empty($verificar)) {
                

                if ($usuarioModel->save($usuario)) {
                    session()->setFlashdata('alert', [
                        'msg' => 'Usuario agregado con exito.',
                        'icon' => 'success',
                    ]);
                    return $this->response->redirect(base_url('usuario/index'));
                } else {
                    if (!empty($verificar)) {
                        session()->setFlashdata('alert', [
                            'msg' => 'El usuario ya existe.',
                            'icon' => 'error',
                        ]);
                    } else {
                        session()->setFlashdata('alert', [
                            'msg' => 'Usuario no pudo ser agregado.',
                            'icon' => 'error',
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->withInput(); /* ->with('errores', $usuarioModel->errors()); */
    }
    
    public function ajaxEmpresa()
    {
        $empresa = new EmpresaModel();
        $builder = $empresa->obtenerEmpresa();
        $data = DataTable::of($builder)
            ->addNumbering('no')
            ->setSearchableColumns(['persona.nit', 'persona.dui', 'persona.nombre', 'persona.correo', 'persona.telefono', 'nombre_juridico', 'nombre_comercial', 'colonia.nombre', 'zona.nombre', 'empresa.correo', 'empresa.telefono', 'empresa.direccion'])
            ->edit('estado', function ($row) {
                return '<span class="badge bg-' . ($row->estado ? 'success' : 'secondary') . '">' . ($row->estado ? 'Disponible' : 'No Disponible') . '</span>';
            })
            ->add('action', function ($row) {

                $btns = '<div class="dropdown">
                            <button class="btn bg-dark-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle"></i> Ver </a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Editar </a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text"></i> Estado de cuenta </a></li>
                            </ul>
                        </div>';

                /* $btn .= '<button type="button" class="btn btn-info btn-sm me-2" onclick="alert(\'GENERAR ESTADO DE CUENTA: '.$row->id_empresa.'\')"><i class="bi bi-file-earmark-text"></i></button>'; */
                return $btns;
            });
                        
        return $data->postQuery(function ($builder) {
            $builder->orderBy('id_empresa', 'asc');
        })->toJson(true);
    }

    public function buscarPersona($id = 0)
    {
        $persona = new PersonaModel();
        $verificar = $persona->obtenerPersonaFiltrado($id);

        if(!empty($verificar))
        {
            echo json_encode($verificar[0]);
        }
    }
}
