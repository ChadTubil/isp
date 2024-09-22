<?php
namespace App\Models;
use \CodeIgniter\Model;

class BundlesModel extends Model 
{
    protected $table = 'bundles';
    protected $primaryKey = 'bundleid';
    protected $allowedFields = [
        'planid', 'inclusionid', 'createdat', 'status',
        'isdel',
    ];
    protected $returnType = 'array';
}