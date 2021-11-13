<?php 
namespace App\Models;

use CodeIgniter\Model;

class TributoModel extends Model
{
    protected $table = 'actividad_tributo';
    //protected $primaryKey = 'idActividad';
    //protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'idTributo', 'idActividad', 'estado',
    ];

    public function obtenerActividades()
    {
        $builder = $this->db->table("actividad_tributo")
        ->select('actividad_economica.actividad, tributo.nombre, tributo.tasa')
        ->join('tributo', 'actividad_tributo.idTributo = tributo.idTributo')
        ->join('actividad_economica', 'actividad_tributo.idActividad = actividad_economica.idActividad');              
        return $builder;
    }
}
?>