<?php

namespace App\Controllers;
use App\Models\StatusModel;
use App\Models\UsersModel;
class StatusController extends BaseController
{
    public $statusModel;
    public $usersModel;
    public $session;
    public function __construct() {
        $this->statusModel = new StatusModel();
        $this->usersModel = new UsersModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Employment Status',
            'page_heading' => 'Employment Status',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['statusdata'] = $this->statusModel->where('isdel', '0')->findAll();;

        return view('statusview', $data);
    }
    public function statusadd()
    {
        $data = [
            'page_title' => 'ISP - Employment Status',
            'page_heading' => 'Employment Status',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['statusdata'] = $this->statusModel->where('isdel', '0')->findAll();

        if ($this->request->is('post')) {
            $rules = [
                'iptstatus' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Status is required.',
                        ],
                    ],
            ];
            if($this->validate($rules))
            {
                $data = [
                    'name' => $this->request->getVar('iptstatus'),
                    'description' => $this->request->getVar('iptdescription'),
                ];
                $this->statusModel->save($data);
                session()->setTempdata('success', 'Status added successfully', 3);
                return redirect()->to(base_url().'status');
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('statusview-add', $data);
    }
    public function statusdelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->statusModel->where('stid', $id)->update($id, $data);
        session()->setTempdata('error', 'Status is deleted!', 2);
        return redirect()->to(base_url()."status"); 
        
        
    }
}
