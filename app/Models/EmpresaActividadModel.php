<?php 
namespace App\Models;

use CodeIgniter\Model;

class EmpresaActividadModel extends Model{
    protected $table      = 'empresa_actividad';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'noCuenta';

    protected $allowedFields = [
        'idActividad', 'id_empresa'
    ];

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'editado_el';
    protected $deletedField  = 'desactivado_el';
}