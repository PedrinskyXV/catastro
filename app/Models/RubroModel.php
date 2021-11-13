<?php
namespace App\Models;

use CodeIgniter\Model;

class RubroModel extends Model
{
    protected $table = 'rubro';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idRubro';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre', 'estado',
    ];

    public function obtenerRubros()
    {
        $builder = $this->db->table("rubro")
        ->select('idRubro, nombre, estado');              
        return $builder;
    }
}
