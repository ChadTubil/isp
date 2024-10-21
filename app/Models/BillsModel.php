<?php
namespace App\Models;
use \CodeIgniter\Model;

class BillsModel extends Model 
{
    protected $table = 'bills';
    protected $primaryKey = 'billsid';
    protected $allowedFields = [
        'soano', 'billno', 'accountid', 'amounttopay',
        'startbill', 'endbill', 'duedate', 'dateofpayment',
        'status', 'createdat', 'isdel',
    ];
    protected $returnType = 'array';
}