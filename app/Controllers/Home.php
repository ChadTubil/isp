<?php

namespace App\Controllers;
use App\Models\UsersModel;
class Home extends BaseController
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
        $data = [];
        if(session()->has('logged_user'))
        {
            return redirect()->to(base_url().'dashboard');
        }
        // LOGIN
        if (! $this->request->is('post')) {
            return view('welcome_message');
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
            $users = $this->request->getVar('user');
            $password = $this->request->getVar('pass');

            $userdata = $this->usersModel->verifyUser($users);
            // print_r($userdata);
            if($userdata != '')
            {
                if($password == $userdata['password']){
                    $this->session->set('logged_user', $userdata['uid']);
                    return redirect()->to(base_url().'dashboard');
                }
                else
                {
                    $this->session->setTempdata('error', 'Sorry! Wrong password', 3);
                    return redirect()->to(current_url());
                }
            }
            else
            {
                    $this->session->setTempdata('error','Sorry! User does not exists', 3);
                    return redirect()->to(current_url());
            }
        }
        else
        {
            $data['validation'] = $this->validator;
        }
        return view('welcome_message', $data);
    }
    public function logout() 
    {
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to(base_url());
    }
}
