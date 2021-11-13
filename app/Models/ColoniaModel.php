<?php
namespace App\Models;

use CodeIgniter\Model;

class ColoniaModel extends Model
{
    protected $table = 'colonia';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_colonia';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre', 'zona', 'estado',
    ];

    public function obtenerColonias()
    {
        $builder = $this->db->table("colonia")
        ->select('id_colonia, colonia.nombre, colonia.id_zona , colonia.estado, zona.nombre as znombre, zona.id_zona as IdZona')
        ->join('zona', 'zona.id_zona = colonia.id_zona');              
        return $builder;
    }
}
