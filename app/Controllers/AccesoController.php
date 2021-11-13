<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AccesoController extends BaseController
{
    private $db;
    private $session;

    public function __construct()
    {
        $this->db = db_connect();
        $this->session = session();
    }

    public function Login()
    {
        $datos['titulo'] = ucfirst('acceso');
        $datos['head'] = view('Template/head', $datos);
        $datos['footer'] = view('Template/footer');
        return view('Acceso/login', $datos);
    }

    public function Autentificar()
    {
        $session = session();

        $usuarioModel = new UsuarioModel();

        $usuario = $this->request->getVar('usuario');
        $clave = $this->request->getVar('clave');

        $consulta = $usuarioModel->obtenerUsuarioFiltradoUsuario($usuario);
        if (!empty($consulta)) {
            $consulta = $consulta[0];
            if ($consulta['estado'] == 1) {
                $contrasena = $consulta['clave'];

                if (password_verify($clave, $contrasena)) {
                    $session_usuario = [
                        'usuario' => $consulta['usuario'],
                        'nombre' => $consulta['nombre'],
                        'apellido' => $consulta['apellido'],
                        'rol' => $consulta['rol_nombre'],
                        'estaLogeado' => true,
                    ];

                    $session->set($session_usuario);
                    return redirect()->to('empresa/agregar');
                } else {
                    $session->setFlashdata('msg', 'La contraseña es incorrecta.');
                    return redirect()->to('acceso');
                }
            }
            $session->setFlashdata('msg', 'El usuario se encuentra desactivado.');
            return redirect()->to('acceso');
        } else {
            $session->setFlashdata('msg', 'El usuario es incorrecto o no existe.');
            return redirect()->to('acceso');
        }
    }

    public function CerrarSesion()
    {
        session()->destroy();
        return redirect()->to(base_url('acceso/'));
    }

    public function NoAutorizado()
    {
        return view('errors/html/error_401');
    }
}
