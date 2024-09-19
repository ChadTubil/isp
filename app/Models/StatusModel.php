<?php
namespace App\Models;
use \CodeIgniter\Model;

class StatusModel extends Model 
{
    protected $table = 'status';
    protected $primaryKey = 'stid';
    protected $allowedFields = [
        'name', 'description', 'isdel',
    ];
    protected $returnType = 'array';
}