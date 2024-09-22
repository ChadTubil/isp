<?php

namespace App\Controllers;
use App\Models\InclusionModel;
use App\Models\UsersModel;
class InclusionsController extends BaseController
{
    public $inclusionsModel;
    public $usersModel;
    public $session;
    public function __construct() {
        $this->inclusionsModel = new InclusionModel();
        $this->usersModel = new UsersModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Inclusions',
            'page_heading' => 'INCLUSIONS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['inclusionsdata'] = $this->inclusionsModel->where('isdel', '0')->findAll();

        return view('inclusionsview', $data);
    }
    public function inclusionadd()
    {
        $data = [
            'page_title' => 'ISP - Inclusions',
            'page_heading' => 'INCLUSIONS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['inclusionsdata'] = $this->inclusionsModel->where('isdel', '0')->findAll();

        if ($this->request->is('post')) {
            $rules = [
                'iptname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name is required.',
                    ],
                ],
                'iptprice' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Price is required.',
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $data = [
                    'name' => $this->request->getVar('iptname'),
                    'price' => $this->request->getVar('iptprice'),
                    'description' => $this->request->getVar('iptdescription'),
                ];
                $this->inclusionsModel->save($data);
                session()->setTempdata('success', 'Inclusion added successfully', 3);
                return redirect()->to(base_url().'inclusions');
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('inclusionsview-add', $data);
    }
    public function inclusiondelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->inclusionsModel->where('inclid', $id)->update($id, $data);
        session()->setTempdata('error', 'Inclusion is deleted!', 2);
        return redirect()->to(base_url()."inclusions"); 
        
        
    }
    public function inclusionedit($id=null){
        $data = [
            'page_title' => 'ISP - Inclusions',
            'page_heading' => 'INCLUSIONS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['inclusionsdata'] = $this->inclusionsModel->where('inclid', $id)->findAll();

        if ($this->request->is('post')) {
            $data = [
                'name' => $this->request->getVar('iptname'),
                'price' => $this->request->getVar('iptprice'),
                'description' => $this->request->getVar('iptdescription'),
            ];
            $this->inclusionsModel->where('inclid', $id)->update($id, $data);
            session()->setTempdata('success', 'Inclusion is updated', 3);
            return redirect()->to(base_url().'inclusions');
        }

        return view('inclusionsview-edit', $data);
    }
}
