<?php 
namespace App\Models;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table      = 'usuario';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_usuario';

    protected $allowedFields = ['usuario', 'clave', 'nombre', 'apellido', 'correo', 'id_rol', 'estado'];

    protected $returnType = 'App\Entities\Usuario';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'editado_el';
    protected $deletedField  = 'desactivado_el';

    public function obtenerUsuario()
    {
        $builder = $this->db->table("usuario");
        $builder->select('usuario.id_usuario, usuario.usuario, usuario.nombre, usuario.apellido, usuario.correo, usuario.ultimo_acceso as acceso, usuario.estado, rol.rol as rol_nombre, rol.id_rol');
        $builder->join('rol', 'usuario.id_rol = rol.id_rol');
        $builder->whereNotIn('usuario.id_usuario', ['1']);
        
        return $builder;
    }

    public function obtenerUsuarioFiltradoId($id)
    {
        $builder = $this->db->table("usuario as u");
        $builder->select('u.*, r.rol as rol_nombre');
        $builder->join('rol as r', 'u.id_rol = r.id_rol');
        $builder->where('id_usuario', $id);
        $data = $builder->get()->getResultArray();
        return $data;
    }

    public function obtenerUsuarioFiltradoUsuario($usuario)
    {
        $builder = $this->db->table("usuario as u");
        $builder->select('u.*, r.rol as rol_nombre');
        $builder->join('rol as r', 'u.id_rol = r.id_rol');
        $builder->where('usuario', $usuario);
        $data = $builder->get()->getResultArray();
        return $data;
    }
}