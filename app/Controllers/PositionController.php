<?php

namespace App\Controllers;
use App\Models\PositionsModel;
use App\Models\UsersModel;
class PositionController extends BaseController
{
    public $posModel;
    public $usersModel;
    public $session;
    public function __construct() {
        $this->posModel = new PositionsModel();
        $this->usersModel = new UsersModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Employment Position',
            'page_heading' => 'EMPLOYMENT POSITION',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['positiondata'] = $this->posModel->where('isdel', '0')->findAll();;

        return view('positionview', $data);
    }
    public function positionadd()
    {
        $data = [
            'page_title' => 'ISP - Employment Position',
            'page_heading' => 'EMPLOYMENT POSITION',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['positiondata'] = $this->posModel->where('isdel', '0')->findAll();

        if ($this->request->is('post')) {
            $rules = [
                'iptposition' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Position is required.',
                        ],
                    ],
            ];
            if($this->validate($rules))
            {
                $data = [
                    'name' => $this->request->getVar('iptposition'),
                    'description' => $this->request->getVar('iptdescription'),
                ];
                $this->posModel->save($data);
                session()->setTempdata('success', 'Position added successfully', 3);
                return redirect()->to(base_url().'position');
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('positionview-add', $data);
    }
    public function positiondelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->posModel->where('posid', $id)->update($id, $data);
        session()->setTempdata('error', 'Position is deleted!', 2);
        return redirect()->to(base_url()."position"); 
        
        
    }
    public function positionedit($id=null){
        $data = [
            'page_title' => 'ISP - Employment Position',
            'page_heading' => 'EMPLOYMENT POSITION',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['positiondata'] = $this->posModel->where('posid', $id)->findAll();

        if ($this->request->is('post')) {
            $data = [
                'name' => $this->request->getVar('iptposition'),
                'description' => $this->request->getVar('iptdescription'),
            ];
            $this->posModel->where('posid', $id)->update($id, $data);
            session()->setTempdata('success', 'Position is updated', 3);
            return redirect()->to(base_url().'position');
        }

        return view('positionview-edit', $data);
    }
}
