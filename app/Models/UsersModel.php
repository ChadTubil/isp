<?php
namespace App\Models;
use \CodeIgniter\Model;

class UsersModel extends Model 
{
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $allowedFields = [
        'uaccid', 'username', 'password', 'admin',
        'cashier', 'staff', 'status', 'isdel',
    ];
    protected $returnType = 'array';
    
    public function getLoggedInUserData($uid){
        $builder = $this->db->table('users');
        $builder->where('uid', $uid);
        $result = $builder->get();
        if(count($result->getResultArray())==1){
            return $result->getRow();
        }
        else{
            return false;
        }
    }
    public function verifyUser($users){

        $builder = $this->db->table('users');
        $builder->select("uid, uaccid, username, password, admin, cashier, staff, status, isdel");
        $builder->where('username', $users);

        $result = $builder->get();
        if(count($result->getResultArray())==1)
        {
            return $result->getRowArray();
        }
        else
        {
            return false;
        }
    }
}