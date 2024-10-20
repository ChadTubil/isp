<?php
namespace App\Models;
use \CodeIgniter\Model;

class InvoicesModel extends Model 
{
    protected $table = 'invoices';
    protected $primaryKey = 'invoiceid';
    protected $allowedFields = [
        'accountid', 'billno', 'amounttopay', 'startperiod',
        'endperiod', 'duedate', 'mrfplan', 'mrfqty',
        'mrfamount', 'othertotalamount', 'status', 'isdel',
    ];
    protected $returnType = 'array';
}