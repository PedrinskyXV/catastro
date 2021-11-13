<?php
namespace App\Models;

use CodeIgniter\Model;

class ActividadEconomicaModel extends Model
{
    protected $table = 'actividad_economica';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idActividad';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'actividad', 'idRubro',
    ];

    public function obtenerActividadesEconomicas()
    {
        $builder = $this->db->table("actividad_economica")
        ->select('actividad, idRubro, estado');              
        return $builder;
    }
}
