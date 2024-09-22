<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\PlansModel;
use App\Models\InclusionModel;
use App\Models\BundlesModel;
class PlansController extends BaseController
{
    public $usersModel;
    public $plansModel;
    public $inclusionsModel;
    public $bundlesModel;
    public $session;
    public function __construct() {
        $this->usersModel = new UsersModel();
        $this->plansModel = new PlansModel();
        $this->inclusionsModel = new InclusionModel();
        $this->bundlesModel = new BundlesModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Internet Plans',
            'page_heading' => 'INTERNET PLANS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();
        $data['plansdata'] = $this->plansModel->where('isdel', '0')->findAll();

        return view('plansview', $data);
    }
    public function plandelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->plansModel->where('planid', $id)->update($id, $data);
        session()->setTempdata('error', 'Plan is deleted!', 2);
        return redirect()->to(base_url()."plans"); 
    }
    public function planadd()
    {
        $data = [
            'page_title' => 'ISP - Internet Plans',
            'page_heading' => 'INTERNET PLANS',
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
            $rules = [
                'iptplan' => [
                    'iptplan' => 'required',
                    'errors' => [
                        'required' => 'Plan is required.',
                    ],
                ],
                'iptspeed' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Speed is required.',
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
                    'name' => $this->request->getVar('iptplan'),
                    'speed' => $this->request->getVar('iptspeed'),
                    'price' => $this->request->getVar('iptprice'),
                    'description' => $this->request->getVar('iptdescription'),
                    'requirements' => $this->request->getVar('iptrequirements'),
                    'createdat' => date('Y-m-d'),
                ];
                $this->plansModel->save($data);
                session()->setTempdata('success', 'Plan added successfully', 3);
                return redirect()->to(base_url().'plans');
                
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('plansview-add', $data);
    }
    public function planedit($id=null){
        $data = [
            'page_title' => 'ISP - Internet Plans',
            'page_heading' => 'INTERNET PLANS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();
        $data['plansdata'] = $this->plansModel->where('planid', $id)->findAll();

        if ($this->request->is('post')) {
            $data = [
                'name' => $this->request->getVar('iptplan'),
                'speed' => $this->request->getVar('iptspeed'),
                'price' => $this->request->getVar('iptprice'),
                'description' => $this->request->getVar('iptdescription'),
                'requirements' => $this->request->getVar('iptrequirements'),
            ];
            $this->plansModel->where('planid', $id)->update($id, $data);
            session()->setTempdata('success', 'Plan is updated', 3);
            return redirect()->to(base_url().'plans');
        }

        return view('plansview-edit', $data);
    }
    public function planview($id=null){
        $data = [
            'page_title' => 'ISP - Internet Plans',
            'page_heading' => 'INTERNET PLANS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();
        $data['plansdata'] = $this->plansModel->where('planid', $id)->findAll();
        $data['inclusionsdata'] = $this->inclusionsModel->where('isdel', '0')->findAll();
        $data['bundlesdata'] = $this->bundlesModel->where('planid', $id)
        ->where('isdel', '0')->findAll();

        return view('plansview-view', $data);
    }
    public function planinclusion($id=null){
        $data = [
            'page_title' => 'ISP - Internet Plans',
            'page_heading' => 'INTERNET PLANS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersinfo'] = $this->usersModel->where('isdel', '0')->findAll();
        $data['plansdata'] = $this->plansModel->where('planid', $id)->findAll();
        $data['inclusionsdata'] = $this->inclusionsModel->where('isdel', '0')->findAll();
        $data['bundlesdata'] = $this->bundlesModel->where('planid', $id)
        ->where('isdel', '0')->findAll();

        return view('plansview-inclusions', $data);
    }
    public function planinclusionadd($id=null, $inclid=null){
        $data = [
            'planid' => $id,
            'inclusionid' => $inclid,
            'createdat' => date('Y-m-d'),
        ];
        $this->bundlesModel->save($data);
        session()->setTempdata('success', 'Inclusion is added', 3);
        return redirect()->to(base_url().'plans/inclusions/'.$id);
    }
    public function planinclusiondelete($planid=null, $inclid=null){
        $bundles = $this->bundlesModel->where('planid', $planid)
        ->where('inclusionid', $inclid)->findAll();
        foreach($bundles as $bundle){
            $BUNDLEID = $bundle['bundleid'];
        }
        $data = [
            'isdel' => '1',
        ];
        $this->bundlesModel->where('planid', $planid)->where('inclusionid', $inclid)->update($BUNDLEID, $data);
        session()->setTempdata('success', 'Inclusion is deleted', 3);
        return redirect()->to(base_url().'plans/inclusions/'.$planid);
    }
}
