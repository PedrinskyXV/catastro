<?php

namespace App\Controllers;

use App\Models\ActividadEconomicaModel;
use App\Models\ColoniaModel;
use App\Models\EmpresaActividadModel;
use App\Models\EmpresaModel;
use App\Models\PersonaModel;
use App\Models\RubroModel;
use App\Models\TipoPersonaModel;
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

        $tipo = new TipoPersonaModel();
        $datos['tipoPersonas'] = $tipo->findAll();

        $rubro = new RubroModel();
        $datos['rubros'] = $rubro->findAll();

        $colonias = new ColoniaModel();
        $datos['colonias'] = $colonias->findAll();

        return view('Empresa/agregar', $datos);
    }

    public function Ver($id = 0)
    {
        $datos['titulo'] = ucfirst('informacion del usuario');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $tipo = new TipoPersonaModel();
        $datos['tipoPersonas'] = $tipo->findAll();

        $rubro = new RubroModel();
        $datos['rubros'] = $rubro->findAll();

        $colonias = new ColoniaModel();
        $datos['colonias'] = $colonias->findAll();

        $empresa = new EmpresaModel();
        $empresas = $empresa->obtenerEmpresaFiltrado($id);
        $datos['empresas'] = $empresas[0];

        /* var_dump($empresas[0]);
        die(); */

        return view('Empresa/ver', $datos);
    }

    public function Editar($id = 0)
    {
        $datos['titulo'] = ucfirst('informacion del usuario');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $tipo = new TipoPersonaModel();
        $datos['tipoPersonas'] = $tipo->findAll();

        $rubro = new RubroModel();
        $datos['rubros'] = $rubro->findAll();

        $colonias = new ColoniaModel();
        $datos['colonias'] = $colonias->findAll();

        $empresa = new EmpresaModel();
        $empresas = $empresa->obtenerEmpresaFiltrado($id);
        $datos['empresas'] = $empresas[0];

        /* var_dump($empresas[0]);
        die(); */

        return view('Empresa/editar', $datos);
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
        if ($_POST) {

            $validar = $this->validate([
                'nombre_persona' => 'required|min_length[8]|max_length[50]|alpha_space',
                'correo_persona' => 'required|min_length[8]|max_length[50]|valid_email',
                'direccion_persona' => 'required|min_length[8]|max_length[250]',
                'dui' => 'required|min_length[8]|max_length[10]',
                'nit' => 'required|min_length[8]|max_length[20]',
                'telefono_persona' => 'required|min_length[8]|max_length[25]',
                'sTipoPersona' => 'required|is_natural_no_zero',
                'sActividad' => 'required|is_natural_no_zero',
                'sRubro' => 'required|is_natural_no_zero',
                'nombre_juridico' => 'required|alpha_numeric_space|min_length[5]|max_length[150]',
                'nombre_comercial' => 'required|alpha_numeric_space|min_length[5]|max_length[150]',
                'correo_empresa' => 'required|valid_email|min_length[8]|max_length[100]',
                'telefono_empresa' => 'required|min_length[8]|max_length[17]',
                'direccion_empresa' => 'required|min_length[8]|max_length[250]',
                'direccion_contacto' => 'required|min_length[8]|max_length[250]',
                'sColonia' => 'required|integer',
            ]);

            if ($validar) {
                $idPersona = $this->request->getVar('id_persona');

                $dataPersona = [                    
                    'nombre' => $this->request->getVar('nombre_persona'),
                    'direccion' => $this->request->getVar('direccion_persona'),
                    'correo' => $this->request->getVar('correo_persona'),
                    'telefono' => $this->request->getVar('telefono_persona'),
                    'dui' => $this->request->getVar('dui'),
                    'nit' => $this->request->getVar('nit'),
                    'id_tipoP' => $this->request->getVar('sTipoPersona'),
                ];

                $empresaModel = new EmpresaModel();
                $personaModel = new PersonaModel();
                $empresaActividad = new EmpresaActividadModel();

                if (strlen($idPersona) == 0) {

                    if ($personaModel->insert($dataPersona)) {

                        $newEmpresa = [
                            'id_persona' => $personaModel->getInsertID(),
                            'nombre_juridico' => $this->request->getVar('nombre_juridico'),
                            'nombre_comercial' => $this->request->getVar('nombre_comercial'),
                            'correo' => $this->request->getVar('correo_empresa'),
                            'telefono' => $this->request->getVar('telefono_empresa'),
                            'direccion' => $this->request->getVar('direccion_empresa'),
                            'direccion_contacto' => $this->request->getVar('direccion_contacto'),
                            'id_colonia' => $this->request->getVar('sColonia'),
                        ];

                        if ($empresaModel->insert($newEmpresa)) {

                            $dataActividad = [
                                'idActividad' => $this->request->getVar('sActividad'),
                                'id_empresa' => $empresaModel->getInsertID()
                            ];

                            if ($empresaActividad->insert($dataActividad)) {
                                session()->setFlashdata('alert', [
                                    'msg' => 'Empresa fue agregada con exito.',
                                    'icon' => 'success',
                                ]);
                                return $this->response->redirect(base_url(session()->get('rol').'/empresa/index'));
                            }
                            else{
                                session()->setFlashdata('alert', [
                                    'msg' => 'Empresa actividad no pudo ser agregada.',
                                    'icon' => 'error',
                                ]);
                            }

                        } else {
                            session()->setFlashdata('alert', [
                                'msg' => 'Empresa no pudo ser agregada.',
                                'icon' => 'error',
                            ]);
                        }
                    }
                } else {
                    if ($personaModel->update($idPersona, $dataPersona)) {

                        $newEmpresa = [
                            'id_persona' => $idPersona,
                            'nombre_juridico' => $this->request->getVar('nombre_juridico'),
                            'nombre_comercial' => $this->request->getVar('nombre_comercial'),
                            'correo' => $this->request->getVar('correo_empresa'),
                            'telefono' => $this->request->getVar('telefono_empresa'),
                            'direccion' => $this->request->getVar('direccion_empresa'),
                            'direccion_contacto' => $this->request->getVar('direccion_contacto'),
                            'id_colonia' => $this->request->getVar('sColonia'),
                        ];

                        if ($empresaModel->insert($newEmpresa)) {

                            $dataActividad = [
                                'idActividad' => $this->request->getVar('sActividad'),
                                'id_empresa' => $empresaModel->getInsertID()
                            ];

                            if ($empresaActividad->insert($dataActividad)) {
                                session()->setFlashdata('alert', [
                                    'msg' => 'Empresa agregada y persona fue editada con exito.',
                                    'icon' => 'success',
                                ]);
                                return $this->response->redirect(base_url(session()->get('rol').'/empresa/index'));
                            }

                        } else {
                            session()->setFlashdata('alert', [
                                'msg' => 'Empresa no pudo ser agregada.',
                                'icon' => 'error',
                            ]);
                        }
                        
                    }
                    else{
                        session()->setFlashdata('alert', [
                            'msg' => 'Persona no pudo ser actualizada.',
                            'icon' => 'error',
                        ]);
                    }
                }
            }

        }
        $db = db_connect();

        return redirect()->back()->withInput()->with('errores', $this->validator);
    }

    public function modificar()
    {
       
        if ($_POST) {

            $validar = $this->validate([
                'id_empresa' => 'required|integer',
                'id_persona' => 'required|integer',
                'id_empresa_actividad' => 'required|integer',
                'nombre_persona' => 'required|min_length[8]|max_length[50]|alpha_space',
                'correo_persona' => 'required|min_length[8]|max_length[50]|valid_email',
                'direccion_persona' => 'required|min_length[8]|max_length[250]',
                'dui' => 'required|min_length[8]|max_length[10]',
                'nit' => 'required|min_length[8]|max_length[20]',
                'telefono_persona' => 'required|min_length[8]|max_length[25]',
                'sTipoPersona' => 'required|is_natural_no_zero',
                'sActividad' => 'required|is_natural_no_zero',
                'sRubro' => 'required|is_natural_no_zero',
                'nombre_juridico' => 'required|alpha_numeric_space|min_length[5]|max_length[150]',
                'nombre_comercial' => 'required|alpha_numeric_space|min_length[5]|max_length[150]',
                'correo_empresa' => 'required|valid_email|min_length[8]|max_length[100]',
                'telefono_empresa' => 'required|min_length[8]|max_length[17]',
                'direccion_empresa' => 'required|min_length[8]|max_length[250]',
                'direccion_contacto' => 'required|min_length[8]|max_length[250]',
                'sColonia' => 'required|integer',
            ]);

            if ($validar) {
                
                $idEmpresa = $this->request->getVar('id_empresa');
                $idPersona = $this->request->getVar('id_persona');
                $empActividad = $this->request->getVar('noCuenta');

                $dataPersona = [                    
                    'nombre' => $this->request->getVar('nombre_persona'),
                    'direccion' => $this->request->getVar('direccion_persona'),
                    'correo' => $this->request->getVar('correo_persona'),
                    'telefono' => $this->request->getVar('telefono_persona'),
                    'dui' => $this->request->getVar('dui'),
                    'nit' => $this->request->getVar('nit'),
                    'id_tipoP' => $this->request->getVar('sTipoPersona'),
                ];

                $empresaModel = new EmpresaModel();
                $personaModel = new PersonaModel();
                $empresaActividad = new EmpresaActividadModel();

                $newEmpresa = [                        
                    'nombre_juridico' => $this->request->getVar('nombre_juridico'),
                    'nombre_comercial' => $this->request->getVar('nombre_comercial'),
                    'correo' => $this->request->getVar('correo_empresa'),
                    'telefono' => $this->request->getVar('telefono_empresa'),
                    'direccion' => $this->request->getVar('direccion_empresa'),
                    'direccion_contacto' => $this->request->getVar('direccion_contacto'),
                    'id_colonia' => $this->request->getVar('sColonia'),
                ];

                if ($empresaModel->update($idEmpresa ,$newEmpresa)) {
                    session()->setFlashdata('alert', [
                        'msg' => 'Empresa fue agregada con exito.',
                        'icon' => 'success',
                    ]);
                    return $this->response->redirect(base_url(session()->get('rol').'/empresa/index'));                    

                } else {
                    session()->setFlashdata('alert', [
                        'msg' => 'Empresa no pudo ser agregada.',
                        'icon' => 'error',
                    ]);
                }               
            }                    
        }        

        return redirect()->back()->withInput()->with('errores', $this->validator);
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
                $refEditar = base_url('/empresa/editar') . '/' . $row->id_empresa;
                $refVer = base_url('/empresa/ver') . '/' . $row->id_empresa;
                $refEstado = base_url('/empresa/estado') . '/' . $row->id_empresa;
                $refRestablecer = base_url('/empresa/editarClave') . '/' . $row->id_empresa;
                
                $btns = '<div class="dropdown">
                            <button class="btn bg-dark-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="' . $refVer . '"><i class="bi bi-info-circle"></i> Ver </a></li>
                            <li><a class="dropdown-item" href="' . $refEditar . '"><i class="bi-shield-lock"></i> Editar </a></li>
                            <li><a class="dropdown-item" href="' . $refRestablecer . '" name="restablecerContra"><i class="bi-shield-lock"></i> Restablecer contraseña </a></li>
                            <li><a class="dropdown-item" href="' . $refEstado . '"><i class="bi bi-eye"></i> Dar de ' . ($row->estado ? 'Baja' : 'Alta') . ' </a></li>
                            </ul>
                        </div>';

                /* $btn .= '<button type="button" class="btn btn-info btn-sm me-2" onclick="alert(\'GENERAR ESTADO DE CUENTA: '.$row->id_empresa.'\')"><i class="bi bi-file-earmark-text"></i></button>'; */
                return $btns;
            });

        return $data->postQuery(function ($builder) {
            $builder->orderBy('id_empresa', 'asc');
        })->toJson(true);
    }

    public function buscarPersona()
    {
        $id = $this->request->getVar('id');

        $persona = new PersonaModel();
        $verificar = $persona->obtenerPersonaFiltrado($id);

        if (!empty($verificar)) {
            echo json_encode($verificar[0]);
        }
    }

    public function obtenerActividad()
    {
        $id = $this->request->getVar('id');

        $actividad = new ActividadEconomicaModel();
        $verificar = $actividad->obtenerActividadesEconomicas($id);

        if (!empty($verificar)) {
            echo json_encode($verificar);
        }
    }
}
