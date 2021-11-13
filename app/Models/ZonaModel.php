<?php
namespace App\Models;

use CodeIgniter\Model;

class ZonaModel extends Model
{
    protected $table = 'zona';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_zona';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre', 'estado',
    ];

    public function obtenerZonas()
    {
        $builder = $this->db->table("zona")
        ->select('id_zona, nombre, estado');              
        return $builder;
    }
}
