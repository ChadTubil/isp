<?php

namespace App\Controllers;
use App\Models\UsersModel;
class UsersController extends BaseController
{
    public $usersModel;
    public $session;
    public function __construct() {
        $this->usersModel = new UsersModel();
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
        session()->setTempdata('deletesuccess', 'User is deleted!', 2);
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
        if (! $this->request->is('post')) {
            return view('usersview-add');
        }
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
            
        }

        return view('usersview-add', $data);
    }
}