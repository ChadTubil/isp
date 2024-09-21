<?php
namespace App\Models;
use \CodeIgniter\Model;

class EmployeesModel extends Model 
{
    protected $table = 'employees';
    protected $primaryKey = 'empid';
    protected $allowedFields = [
        'empnum', 'empfn', 'mn', 'ln',
        'extension', 'fullname', 'hiringdate', 'resignationdate',
        'position', 'status', 'isdel',
    ];
    protected $returnType = 'array';
}