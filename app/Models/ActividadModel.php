<?php 
namespace App\Models;

use CodeIgniter\Model;

class ActividadModel extends Model
{
    protected $table = 'actividad_economica';
    protected $primaryKey = 'idActividad';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'actividad', 'idRubro', 'estado',
    ];

    public function obtenerActividades()
    {
        $builder = $this->db->table("actividad_economica")
        ->select('idActividad, actividad_economica.actividad, rubro.nombre as rubro, actividad_economica.estado')
        ->join('rubro', 'actividad_economica.idRubro = rubro.idRubro');              
        return $builder;
    }
    public function filtrarActividades($rubro)
    {
        $builder = $this->db->table("actividad_economica")
        ->select('idActividad, actividad_economica.actividad, rubro.nombre as rubro, actividad_economica.estado')
        ->join('rubro', 'actividad_economica.idRubro = rubro.idRubro')
        ->where('rubro.idRubro',$rubro);              
        return $builder;
    }

    public function obtenerTributoActividad()
    {
        $builder = $this->db->table("actividad_tributo")
        ->select("rubro.nombre, actividad_economica.actividad, tributo.nombre as tributo, tributo.tasa, tributo.tipo", false)
        ->join("tributo", "actividad_tributo.idTributo = tributo.idTributo")
        ->join("actividad_economica", "actividad_tributo.idActividad = actividad_economica.idActividad")
        ->join("rubro", "actividad_economica.idRubro = rubro.idRubro");
        return $builder->get()->getResult("array");
    }
}
?>