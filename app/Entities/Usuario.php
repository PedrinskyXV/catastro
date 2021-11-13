<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity
{

    protected $datamap = [
        'usuario' => 'usuario',
        'clave' => 'clave',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'correo' => 'correo',
        'id_rol' => 'id_rol',
        'estado' => 'estado'];

    public function setClave(string $clave)
    {
        $this->attributes['clave'] = password_hash($clave, PASSWORD_BCRYPT);

        return $this;
    }
}
