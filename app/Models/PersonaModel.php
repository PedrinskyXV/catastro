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
        'estado', 'id_tipoP'
    ];

    protected $validationRules = [    
        'nombre' => 'required|min_length[8]|max_length[50]|alpha',        
        'correo' => 'required|min_length[8]|max_length[50]|valid_email',
        'direccion' => 'required|min_length[8]|max_length[250]',
        'dui' => 'required|min_length[8]|max_length[10]',
        'nit' => 'required|min_length[8]|max_length[20]',
        'telefono' => 'required|min_length[8]|max_length[25]',
        'id_tipoP' => 'required|is_natural_no_zero',
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
