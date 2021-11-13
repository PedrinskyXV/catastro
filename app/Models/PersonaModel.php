<?php
namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table = 'persona';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_persona';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre', 'correo', 'direccion',
        'nit', 'dui', 'telefono',
        'tipo', 'estado',
    ];

    public function obtenerPersonaFiltrado($nit)
    {
        $builder = $this->db->table("persona");
        $builder->select('persona.*');        
        $builder->orWhere('persona.nit', $nit);
        $builder->orWhere('persona.dui', $nit);
        
        $data = $builder->get()->getResultArray();
        return $data;
    }
}
