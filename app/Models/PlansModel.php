<?php
namespace App\Models;
use \CodeIgniter\Model;

class PlansModel extends Model 
{
    protected $table = 'plans';
    protected $primaryKey = 'planid';
    protected $allowedFields = [
        'name', 'speed', 'price', 'description',
        'requirements', 'inclusionid', 'createdat', 'status',
        'isdel',
    ];
    protected $returnType = 'array';
}