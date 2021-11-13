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
        helper('date');

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
                        'idUsuario' => $consulta['id_usuario'],
                        'usuario' => $consulta['usuario'],
                        'nombre' => $consulta['nombre'],
                        'apellido' => $consulta['apellido'],
                        'rol' => $consulta['rol_nombre'],
                        'estaLogeado' => true,
                    ];
                    $date = now();

                    $session->set($session_usuario);
                    $this->createDate = now();

                    $group = $consulta['rol_nombre'];

                    $usuarioModel->update($consulta['id_usuario'] , ['ultimo_acceso' => date('Y-m-d H:i:s')], false);

                    return redirect()->to($group.'/inicio/index');
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
        return redirect()->to(base_url('/'));
    }

    public function NoAutorizado()
    {
        return view('errors/html/error_401');
    }
}
