<?php
namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresa';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_empresa';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = [
        'nombre_juridico', 'nombre_comercial',
        'giro_actividad', 'actividad_economica',
        'telefono', 'correo',
        'direccion', 'estado'];
    
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'editado_el';
    protected $deletedField  = 'desactivado_el';

    protected $validationRules = [
        'nombre_juridico' => 'required|alpha_numeric_space|min_length[5]|max_length[150]',
        'nombre_comercial' => 'required|alpha_numeric_space|min_length[5]|max_length[150]',
        'correo' => 'required|valid_email|min_length[8]|max_length[100]',
        'telefono' => 'required|alpha_numeric_space|min_length[8]|max_length[17]',
        'direccion' => 'required|alpha_numeric_space|min_length[8]|max_length[250]',        
    ];

    public function obtenerEmpresa()
    {
        $builder = $this->db->table("empresa")
            ->select('nombre_juridico, nombre_comercial, empresa.id_colonia ,empresa.correo, colonia.nombre as colonia, zona.nombre as zona,empresa.telefono, persona.nit AS NIT, empresa.id_empresa, empresa.estado AS estado')
            ->join('persona', 'persona.id_persona = empresa.id_persona')
            ->join('colonia', 'colonia.id_colonia = empresa.id_colonia')
            ->join('zona', 'zona.id_zona = colonia.id_zona');        

        return $builder;
    }

    public function obtenerEmpresaImpuestos()
    {
        $builder = $this->db->table("vEmpresaImpuestos")
        ->select("*");
        //var_dump($builder->get()->getResult());
        return $builder->get()->getResult("array");
    }

    // Campo 0: código 1: marca

    public function filtro($valor){
        $builder = $this->db->table("vEmpresaImpuestos")
        ->select("*")
        ->where("nombre_comercial", $valor);
        return $builder->get()->getResult("array");
    }
    
    public function obtenerEmpresaTotales($valor)
    {
        $builder = $this->db->table("vEmpresaTotales")
        ->select("SUM(montoReportado) as montoReportado, SUM(montoFijo+montoPorcentaje) as TOTAL", false)
        ->where("nombre_comercial", $valor);
        return $builder->get()->getResult("array");
    }
}
