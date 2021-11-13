<?php 
namespace App\Models;

use CodeIgniter\Model;

class TributoModel extends Model
{
    protected $table = 'tributo';
    protected $primaryKey = 'idTributo';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre', 'tasa', 'tipo', 'razon', 'estado',
    ];

    public function obtenerTributos()
    {
        $builder = $this->db->table("tributo")
        ->select('idTributo, tasa, tipo, razon, creado_el, editado_el, estado');              
        return $builder;
    }
}
?>