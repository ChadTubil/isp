<?php
namespace App\Models;
use \CodeIgniter\Model;

class EmployeesModel extends Model 
{
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $allowedFields = [
        'uaccid', 'username', 'password', 'admin',
        'cashier', 'staff', 'status', 'isdel',
    ];
    protected $returnType = 'array';
}