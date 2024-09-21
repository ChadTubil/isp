<?php
namespace App\Models;
use \CodeIgniter\Model;

class PositionsModel extends Model 
{
    protected $table = 'positions';
    protected $primaryKey = 'posid';
    protected $allowedFields = [
        'name', 'description', 'isdel',
    ];
    protected $returnType = 'array';
}