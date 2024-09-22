<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\EmployeesModel;
use App\Models\PositionsModel;
class UsersController extends BaseController
{
    public $usersModel;
    public $empModel;
    public $posModel;
    public $session;
    public function __construct() {
        $this->usersModel = new UsersModel();
        $this->empModel = new EmployeesModel();
        $this->posModel = new PositionsModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Users Management',
            'page_heading' => 'USERS MANAGEMENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();

        return view('usersview', $data);
    }
    public function userdelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->usersModel->where('uid', $id)->update($id, $data);
        session()->setTempdata('error', 'User is deleted!', 2);
        return redirect()->to(base_url()."users"); 
    }
    public function useradd()
    {
        $data = [
            'page_title' => 'ISP - Users Management',
            'page_heading' => 'USERS MANAGEMENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();

        // ADD
        if ($this->request->is('post')) {
            // return redirect()->to(base_url().'dashboard');
            $rules = [
                'user' => [
                        'rules' => 'required|min_length[4]|max_length[16]',
                        'errors' => [
                            'required' => 'Employee ID is required.',
                            'min_length' => 'Employee ID must be atleast 4 characters.',
                            'max_length' => 'Employee ID is only up to 16 characters only.'
                        ],
                    ],
                    'pass' => [
                        'rules' => 'required|min_length[4]|max_length[16]',
                        'errors' => [
                            'required' => 'Password is required.',
                            'min_length' => 'Password must be atleast 4 characters.',
                            'max_length' => 'Password is only up to 16 characters only.'
                        ],
                    ],
            ];
            if($this->validate($rules))
            {
                $Admin = $this->request->getVar('chkadmin');
                $Cashier = $this->request->getVar('chkcashier');
                $Staff = $this->request->getVar('chkstaff');
                if($Admin == ''){
                    $ADMIN = 0;
                }else{
                    $ADMIN = 1;
                }
                if($Cashier == ''){
                    $CASHIER = 0;
                }else{
                    $CASHIER = 1;
                }
                if($Staff == ''){
                    $STAFF = 0;
                }else{
                    $STAFF = 1;
                }

                $udata = [
                    'username' => $this->request->getVar('user'),
                    'password' => $this->request->getVar('pass'),
                    'admin' => $ADMIN,
                    'cashier' => $CASHIER,
                    'staff' => $STAFF,
                ];
                $this->usersModel->save($udata);
                session()->setTempdata('success', 'User added successfully', 3);
                return redirect()->to(base_url().'users');
                
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('usersview-add', $data);
    }
    public function useredit($id=null){
        $data = [
            'page_title' => 'ISP - Users Management',
            'page_heading' => 'USERS MANAGEMENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();

        $data['usersedit'] = $this->usersModel->where('uid', $id)->findAll();

        if ($this->request->is('post')) {
            $Admin = $this->request->getVar('chkadmin');
            $Cashier = $this->request->getVar('chkcashier');
            $Staff = $this->request->getVar('chkstaff');
            if($Admin == ''){
                $ADMIN = 0;
            }else{
                $ADMIN = 1;
            }
            if($Cashier == ''){
                $CASHIER = 0;
            }else{
                $CASHIER = 1;
            }
            if($Staff == ''){
                $STAFF = 0;
            }else{
                $STAFF = 1;
            }

            $udata = [
                'username' => $this->request->getVar('user'),
                'password' => $this->request->getVar('pass'),
                'admin' => $ADMIN,
                'cashier' => $CASHIER,
                'staff' => $STAFF,
            ];
            $this->usersModel->where('uid', $id)->update($id, $udata);
            session()->setTempdata('success', 'User is updated', 3);
            return redirect()->to(base_url().'users');
        }

        return view('usersview-edit', $data);
    }
    public function useraccess($id=null){
        $data = [
            'page_title' => 'ISP - Users Management',
            'page_heading' => 'USERS MANAGEMENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();

        $data['usersedit'] = $this->usersModel->where('uid', $id)->findAll();
        $data['empdata'] = $this->empModel->where('isdel', '0')
        ->where('status', 0)->findAll();
        $data['posdata'] = $this->posModel->where('isdel', '0')->findAll();

        return view('usersview-access', $data);

    }
    public function userlink($id=null, $empid=null){
        $data = [
            'uaccid' => $empid,
        ];
        $this->usersModel->where('uid', $id)->update($id, $data);
        $empdata = [
            'status' => '1',
        ];
        $this->empModel->where('empnum', $empid)->update($empid, $empdata);
        session()->setTempdata('success', 'Account linked!', 2);
        return redirect()->to(base_url()."users"); 
    }
}
