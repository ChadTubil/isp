<?php
namespace App\Models;
use \CodeIgniter\Model;

class AccountsModel extends Model 
{
    protected $table = 'accounts';
    protected $primaryKey = 'accountid';
    protected $allowedFields = [
        'clientid', 'planid', 'billid', 'createdat',
        'status', 'isdel',
    ];
    protected $returnType = 'array';
}