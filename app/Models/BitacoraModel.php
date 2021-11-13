<?php
namespace App\Models;

use CodeIgniter\Model;

class BitacoraModel extends Model
{
    protected $table = 'bitacora';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_bitacora';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'info', 'fecha',
    ];
    
    public function obtenerBitacoras()
    {
        $builder = $this->db->table("bitacora")
        ->select('id_bitacora, info, fecha, usuario.usuario')
        ->join('usuario', 'usuario.id_usuario = bitacora.id_usuario');
        return $builder;
    }
}
