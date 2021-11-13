<?php
namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'tipo_persona';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_tipoP';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre', 'estado',
    ];   
}
