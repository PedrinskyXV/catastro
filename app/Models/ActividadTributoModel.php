<?php 
namespace App\Models;

use CodeIgniter\Model;

class ActividadTributoModel extends Model
{
    protected $table = 'actividad_tributo';
    //protected $primaryKey = 'idActividad';
    //protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'idTributo', 'idActividad', 'estado',
    ];

}
?>