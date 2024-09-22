<?php
namespace App\Models;
use \CodeIgniter\Model;

class InclusionModel extends Model 
{
    protected $table = 'inclusions';
    protected $primaryKey = 'inclid';
    protected $allowedFields = [
        'name', 'description', 'price',
        'createdat', 'status', 'isdel',
    ];
    protected $returnType = 'array';
}