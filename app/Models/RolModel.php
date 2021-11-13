<?php
namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'rol';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_rol';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'rol', 'estado',
    ];   
}
