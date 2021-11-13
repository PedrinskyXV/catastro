<?php
namespace App\Controllers;

use App\Entities\Usuario;
use App\Models\RolModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use \Hermawan\DataTables\DataTable;

class UsuarioController extends Controller
{

    public function MiPerfil()
    {
        $datos['titulo'] = ucfirst('mi perfil');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $usuarioModel = new UsuarioModel();
        $consulta = $usuarioModel->obtenerUsuarioFiltradoUsuario(session()->get('usuario'));
        $datos['usuario'] = $consulta[0];
        return view('Usuario/miPerfil', $datos);
    }

    public function Index()
    {
        $datos['titulo'] = ucfirst('usuarios');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        return view('Usuario/index', $datos);
    }

    public function Agregar()
    {
        $datos['titulo'] = ucfirst('agregar usuario');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $rol = new RolModel();
        $datos['roles'] = $rol->findAll();
        return view('Usuario/agregar', $datos);
    }

    public function Ver($id = 0)
    {
        $datos['titulo'] = ucfirst('informacion del usuario');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $rol = new RolModel();
        $datos['roles'] = $rol->findAll();

        $usuario = new UsuarioModel();
        $usuarios = $usuario->obtenerUsuarioFiltradoId($id);
        $datos['usuario'] = $usuarios[0];
        return view('Usuario/ver', $datos);
    }

    public function Editar($id = 0)
    {
        $datos['titulo'] = ucfirst('informacion del usuario');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');

        $rol = new RolModel();
        $datos['roles'] = $rol->findAll();

        $usuario = new UsuarioModel();
        $usuarios = $usuario->obtenerUsuarioFiltradoId($id);
        $datos['usuario'] = $usuarios[0];
        return view('Usuario/editar', $datos);
    }

    public function insertar()
    {
        if ($_POST) {

            $validar = $this->validate([
                'usuario' => 'required|min_length[5]|max_length[50]|alpha_numeric|is_unique[usuario.usuario]',
                'usuario_nombre' => 'required|min_length[3]|max_length[50]|alpha',
                'usuario_apellido' => 'required|min_length[3]|max_length[50]|alpha',
                'usuario_correo' => 'required|min_length[8]|max_length[80]|valid_email|is_unique[usuario.correo]',
                'sRol' => 'required|is_natural_no_zero',
            ],
                [
                    'usuario' => [
                        'required' => 'El usuario es requerido.',
                        'min_length' => 'El usuario debe tener como minimo 8 caracteres.',
                        'max_length' => 'El usuario debe tener como maximo 50 caracteres.',
                        'alpha_numeric' => 'El usuario debe tener solo letras y numeros.',
                        'is_unique' => 'El usuario ya existe.',
                    ],
                    'usuario_nombre' => [
                        'required' => 'El nombre es requerido.',
                        'min_length' => 'El nombre debe tener como minimo 3 caracteres.',
                        'max_length' => 'El nombre debe tener como maximo 50 caracteres.',
                        'alpha_numeric' => 'El nombre debe tener solo letras .',
                    ],
                    'usuario_apellido' => [
                        'required' => 'El apellido es requerido.',
                        'min_length' => 'El apellido debe tener como minimo 3 caracteres.',
                        'max_length' => 'El apellido debe tener como maximo 50 caracteres.',
                        'alpha_numeric' => 'El apellido debe tener solo letras .',
                    ],
                    'usuario_correo' => [
                        'required' => 'El correo es requerido.',
                        'min_length' => 'El correo debe tener como minimo 8 caracteres.',
                        'max_length' => 'El correo debe tener como maximo 80 caracteres.',
                        'valid_email' => 'El correo es invalido.',
                        'is_unique' => 'El correo ya existe.',
                    ],
                ]);

            if ($validar) {
                $usuarioModel = new UsuarioModel();

                $nuevoUsuario = $this->request->getVar('usuario');

                $verificar = $usuarioModel->obtenerUsuarioFiltradoUsuario($nuevoUsuario);

                if (empty($verificar)) {
                    $usuario = new Usuario();
                    $default = "alcaldia123";

                    $usuario->usuario = $nuevoUsuario;
                    $usuario->clave = $default;
                    $usuario->nombre = $this->request->getVar('usuario_nombre');
                    $usuario->apellido = $this->request->getVar('usuario_apellido');
                    $usuario->correo = $this->request->getVar('usuario_correo');
                    $usuario->id_rol = $this->request->getVar('sRol');

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
        }

        return redirect()->back()->withInput()->with('errores', $this->validator);
    }

    public function EditarPerfil()
    {
        if ($_POST) {
            $usuarioModel = new UsuarioModel();

            $id = $this->request->getVar('id');
            $nuevoUsuario = $this->request->getVar('usuario');

            $data = [
                'usuario' => $nuevoUsuario,
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'correo' => $this->request->getVar('correo'),
            ];

            $consulta = $usuarioModel->obtenerUsuarioFiltradoId($id);
            $verificar = $usuarioModel->obtenerUsuarioFiltradoUsuario($nuevoUsuario);
            if (!empty($consulta)) {

                if ($usuarioModel->update($id, $data)) {
                    session()->setFlashdata('alert', [
                        'msg' => 'Perfil modificado con exito.',
                        'icon' => 'success',
                    ]);
                    var_dump(session()->get());
                    session()->set($data);
                    return $this->response->redirect(site_url('usuario/perfil'));
                } else {
                    if (!empty($verificar)) {
                        session()->setFlashdata('alert', [
                            'msg' => 'El usuario ya existe.',
                            'icon' => 'error',
                        ]);
                    } else {
                        session()->setFlashdata('alert', [
                            'msg' => 'Perfil no pudo ser modificado.',
                            'icon' => 'error',
                        ]);
                    }
                }
            } else {
                session()->setFlashdata('alert', [
                    'msg' => 'El usuario no existe o se encuentra en uso.',
                    'icon' => 'error',
                ]);
            }
        }

        return redirect()->back()->withInput(); /* ->with('errores', $usuarioModel->errors()); */
    }

    public function Modificar()
    {        
        if ($_POST) {

            $validar = $this->validate([
                'usuario' => 'required|min_length[5]|max_length[50]|alpha_numeric',
                'usuario_nombre' => 'required|min_length[3]|max_length[50]|alpha',
                'usuario_apellido' => 'required|min_length[3]|max_length[50]|alpha',
                'usuario_correo' => 'required|min_length[8]|max_length[80]|valid_email',
                'sRol' => 'required|is_natural_no_zero',
            ],
                [
                    'usuario' => [
                        'required' => 'El usuario es requerido.',
                        'min_length' => 'El usuario debe tener como minimo 8 caracteres.',
                        'max_length' => 'El usuario debe tener como maximo 50 caracteres.',
                        'alpha_numeric' => 'El usuario debe tener solo letras y numeros.',                        
                    ],
                    'usuario_nombre' => [
                        'required' => 'El nombre es requerido.',
                        'min_length' => 'El nombre debe tener como minimo 3 caracteres.',
                        'max_length' => 'El nombre debe tener como maximo 50 caracteres.',
                        'alpha_numeric' => 'El nombre debe tener solo letras .',
                    ],
                    'usuario_apellido' => [
                        'required' => 'El apellido es requerido.',
                        'min_length' => 'El apellido debe tener como minimo 3 caracteres.',
                        'max_length' => 'El apellido debe tener como maximo 50 caracteres.',
                        'alpha_numeric' => 'El apellido debe tener solo letras .',
                    ],
                    'usuario_correo' => [
                        'required' => 'El correo es requerido.',
                        'min_length' => 'El correo debe tener como minimo 8 caracteres.',
                        'max_length' => 'El correo debe tener como maximo 80 caracteres.',
                        'valid_email' => 'El correo es invalido.',                        
                    ],
                ]);

            if ($validar) {
                $usuarioModel = new UsuarioModel();

                $id = $this->request->getVar('id');
                $nuevoUsuario = $this->request->getVar('usuario');

                $data = [
                    'usuario' => $nuevoUsuario,
                    'nombre' => $this->request->getVar('usuario_nombre'),
                    'apellido' => $this->request->getVar('usuario_apellido'),
                    'correo' => $this->request->getVar('usuario_correo'),
                    'id_rol' => $this->request->getVar('sRol'),
                ];

                $consulta = $usuarioModel->obtenerUsuarioFiltradoId($id);
                $verificar = $usuarioModel->obtenerUsuarioFiltradoUsuario($nuevoUsuario);

                if (!empty($consulta)) {

                    if ($usuarioModel->update($id, $data)) {
                        session()->setFlashdata('alert', [
                            'msg' => 'El usuario modificado con exito.',
                            'icon' => 'success',
                        ]);

                        return $this->response->redirect(base_url('usuario/index'));
                    } else {

                        var_dump($usuarioModel->update($id, $data));
                        die();

                        if (!empty($verificar)) {
                            session()->setFlashdata('alert', [
                                'msg' => 'El usuario ya existe.',
                                'icon' => 'error',
                            ]);
                        } else {
                            session()->setFlashdata('alert', [
                                'msg' => 'Perfil no pudo ser modificado.',
                                'icon' => 'error',
                            ]);
                        }
                    }
                } else {
                    session()->setFlashdata('alert', [
                        'msg' => 'El usuario no existe o se encuentra en uso.',
                        'icon' => 'error',
                    ]);
                }
            }
        }

        return redirect()->back()->withInput(); /* ->with('errores', $usuarioModel->errors()); */
    }

    public function CambiarClave()
    {
        //helper(['form', 'url']);

        if ($_POST) {
            $validar = $this->validate([
                'claveActual' => 'required|min_length[8]|max_length[70]',
                'clave' => 'required|min_length[8]|max_length[70]|differs[claveActual]',
                'clave2' => 'required|min_length[8]|max_length[70]|matches[clave]',
            ],
                [
                    'claveActual' => [
                        'required' => 'El valor de la contraseña actual es requerido.',
                        'min_length' => 'El usuario debe tener como minimo 8 caracteres.',
                        'max_length' => 'El usuario debe tener como maximo 70 caracteres.',
                    ],
                    'clave' => [
                        'required' => 'El valor de la nueva contraseña es requerido.',
                        'min_length' => 'El nombre debe tener como minimo 8 caracteres.',
                        'max_length' => 'El nombre debe tener como maximo 70 caracteres.',
                        'differs' => 'El nombre no puede ser la actual.',
                    ],
                    'clave2' => [
                        'required' => 'El valor de la confirmacion es requerido.',
                        'min_length' => 'La confirmacion contraseña debe tener como minimo 8 caracteres.',
                        'max_length' => 'La confirmacion contraseña debe tener como maximo 70 caracteres.',
                        'matches' => 'No coincide con la nueva contraseña.',
                    ],
                ]);

            if ($validar) {
                $usuarioModel = new UsuarioModel();

                $id = $this->request->getVar('id');
                $claveNuevo = $this->request->getVar('clave');
                $claveActual = $this->request->getVar('claveActual');

                $usuario = new Usuario();
                $consulta = $usuarioModel->obtenerUsuarioFiltradoId($id);

                if (!empty($consulta)) {
                    $consulta = $consulta[0];
                    $contrasena = $consulta['clave'];

                    if (password_verify($claveActual, $contrasena)) {
                        $usuario->clave = $claveNuevo;

                        if ($usuarioModel->update($id, $usuario)) {
                            session()->setFlashdata('alert', [
                                'msg' => 'Contraseña actualizada con exito.',
                                'icon' => 'success',
                            ]);

                            return $this->response->redirect(base_url('usuario/perfil'));
                        }
                    }

                } else {
                    session()->setFlashdata('alert', [
                        'msg' => 'El usuario no existe',
                        'icon' => 'error',
                    ]);
                }
            }
        }

        session()->setFlashdata('alert', [
            'msg' => 'Verifique el formulario de CAMBIAR CONTRASEÑA.',
            'icon' => 'error',
        ]);

        return redirect()->back()->withInput()->with('errores', $this->validator);
    }

    public function EditarClave($id = 0)
    {
        $usuarioModel = new UsuarioModel();
        //$id = $this->request->getVar('id');

        $usuario = new Usuario();

        $consulta = $usuarioModel->obtenerUsuarioFiltradoId($id);

        if (!empty($consulta)) {
            $consulta = $consulta[0];
            $usuario = new Usuario();

            if (empty($this->request->getVar('clave'))) {
                $usuario->clave = 'alcaldia123';
            } else {
                $usuario->clave = $this->request->getVar('clave');
            }

            if ($usuarioModel->update($id, $usuario)) {
                session()->setFlashdata('alert', [
                    'msg' => 'Contraseña actualizada con exito.',
                    'icon' => 'success',
                ]);
                return $this->response->redirect(site_url('usuario/index'));
            } else {
                session()->setFlashdata('alert', [
                    'msg' => 'Contraseña no pudo ser actualizada.',
                    'icon' => 'error',
                ]);
            }
        } else {
            session()->setFlashdata('alert', [
                'msg' => 'El usuario no existe',
                'icon' => 'error',
            ]);
        }

        return redirect()->back()->withInput(); /* ->with('errores', $usuarioModel->errors()); */
    }

    public function CambiarEstado($id = 0)
    {
        $usuarioModel = new UsuarioModel();
        //$id = $this->request->getVar('id');

        $usuario = new Usuario();

        $consulta = $usuarioModel->obtenerUsuarioFiltradoId($id);

        if (!empty($consulta)) {
            $consulta = $consulta[0];
            $usuario = new Usuario();

            $estado = $consulta['estado'];

            if ($estado == '1') {
                $usuario->estado = 0;
                $usuarioModel->delete($id);
            } else {
                $usuario->estado = 1;
            }

            if ($usuarioModel->update($id, $usuario)) {

                session()->setFlashdata('alert', [
                    'msg' => 'Estado actualizado con exito.',
                    'icon' => 'success',
                ]);
                return $this->response->redirect(site_url('usuario/index'));
            } else {
                session()->setFlashdata('alert', [
                    'msg' => 'Estado actualizado no pudo ser actualizado.',
                    'icon' => 'error',
                ]);
            }
        } else {
            session()->setFlashdata('alert', [
                'msg' => 'El usuario no existe',
                'icon' => 'error',
            ]);
        }

        return redirect()->back()->withInput(); /* ->with('errores', $usuarioModel->errors()); */
    }

    public function ajaxUsuarios()
    {
        $usuario = new UsuarioModel();
        $builder = $usuario->obtenerUsuario();

        $data = DataTable::of($builder)
            ->addNumbering('no')
            ->setSearchableColumns(['usuario', 'nombre', 'apellido', 'correo', 'rol.rol'])
            ->edit('estado', function ($row) {
                return '<span class="badge bg-' . ($row->estado ? 'success' : 'secondary') . '">' . ($row->estado ? 'Disponible' : 'No Disponible') . '</span>';
            })
            ->edit('nombre', function ($row) {
                return $row->nombre . ' ' . $row->apellido;
            })
            ->add('action', function ($row) {
                $refEditar = base_url('/usuario/editar') . '/' . $row->id_usuario;
                $refVer = base_url('/usuario/ver') . '/' . $row->id_usuario;
                $refEstado = base_url('/usuario/estado') . '/' . $row->id_usuario;
                $refRestablecer = base_url('/usuario/editarClave') . '/' . $row->id_usuario;

                $btns = '<div class="dropdown">
                            <button class="btn bg-dark-light dropdown-toggle" type="button" id="btnAcciones" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnAcciones">
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
            $builder->orderBy('id_usuario', 'asc');
        })->toJson(true);
    }
}
