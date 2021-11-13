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

    public function obtenerActividadesEconomicas($id)
    {
        $builder = $this->db->table("actividad_economica")
        ->select('actividad_economica.idActividad, actividad_economica.actividad, actividad_economica.idRubro, actividad_economica.estado')
        ->join('rubro', 'rubro.idRubro = actividad_economica.idRubro')
        ->where('actividad_economica.idRubro', $id);
        
        $data = $builder->get()->getResultArray();
        return $data;
    }
}
