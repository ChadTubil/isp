<?php
namespace App\Models;
use \CodeIgniter\Model;

class ClientsModel extends Model 
{
    protected $table = 'clients';
    protected $primaryKey = 'clientid';
    protected $allowedFields = [
        'firstname', 'middlename', 'lastname', 'fullname', 'mobile',
        'email', 'province', 'city', 'barangay',
        'zipcode', 'propertytype', 'houseunitno', 'buildingname',
        'street', 'villagesubdivision', 'status', 'isdel',
    ];
    protected $returnType = 'array';
}