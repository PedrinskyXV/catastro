<?php
namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresa';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_usuario';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nombre_juridico', 'nombre_comercial',
        'giro_actividad', 'actividad_economica',
        'telefono', 'correo',
        'direccion', 'estado'];

    public function obtenerEmpresa()
    {
        $builder = $this->db->table("empresa")
            ->select('nombre_juridico, nombre_comercial, empresa.id_colonia ,empresa.correo, colonia.nombre as colonia, zona.nombre as zona,empresa.telefono, persona.nit AS NIT, empresa.id_empresa, empresa.estado AS estado')
            ->join('persona', 'persona.id_persona = empresa.id_persona')
            ->join('colonia', 'colonia.id_colonia = empresa.id_colonia')
            ->join('zona', 'zona.id_zona = colonia.id_zona');        

        return $builder;
    }
}
