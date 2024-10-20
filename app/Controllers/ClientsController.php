<?php

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\UsersModel;
use App\Models\PlansModel;
use App\Models\AccountsModel;
use App\Models\BundlesModel;
use App\Models\InclusionModel;
class ClientsController extends BaseController
{
    public $clientsModel;
    public $usersModel;
    public $plansModel;
    public $accountsModel;
    public $bundlesModel;
    public $inclusionModel;
    public $session;
    public function __construct() {
        $this->clientsModel = new ClientsModel();
        $this->usersModel = new UsersModel();
        $this->plansModel = new PlansModel();
        $this->accountsModel = new AccountsModel();
        $this->bundlesModel = new BundlesModel();
        $this->inclusionModel = new InclusionModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Register Client',
            'page_heading' => 'REGISTER CLIENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['clientdata'] = $this->clientsModel->where('isdel', '0')->findAll();

        if ($this->request->is('post')) {
            $rules = [
                'iptlastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lastname is required.',
                    ],
                ],
                'iptfirstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Firstname is required.',
                    ],
                ],
                'iptmiddlename' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Middlename is required.',
                    ],
                ],
                'iptmobile' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mobile Number is required.',
                    ],
                ],
                'iptemail' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email Address is required.',
                    ],
                ],
                'iptprovince' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Province is required.',
                    ],
                ],
                'iptcity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'City is required.',
                    ],
                ],
                'iptbarangay' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Barangay is required.',
                    ],
                ],
                'iptzipcode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ZIP CODE is required.',
                    ],
                ],
                'iptpropertytype' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Property Type is required.',
                    ],
                ],
                'iptstreet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Street is required.',
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $data = [
                    'firstname' => $this->request->getVar('iptfirstname'),
                    'middlename' => $this->request->getVar('iptmiddlename'),
                    'lastname' => $this->request->getVar('iptlastname'),
                    'fullname' => $this->request->getVar('iptlastname').', '.$this->request->getVar('iptfirstname').' '.$this->request->getVar('iptmiddlename'),
                    'mobile' => $this->request->getVar('iptmobile'),
                    'email' => $this->request->getVar('iptemail'),
                    'province' => $this->request->getVar('iptprovince'),
                    'city' => $this->request->getVar('iptcity'),
                    'barangay' => $this->request->getVar('iptbarangay'),
                    'zipcode' => $this->request->getVar('iptzipcode'),
                    'propertytype' => $this->request->getVar('iptpropertytype'),
                    'houseunitno' => $this->request->getVar('ipthouseunitno'),
                    'buildingname' => $this->request->getVar('iptbuildingname'),
                    'street' => $this->request->getVar('iptstreet'),
                    'villagesubdivision' => $this->request->getVar('iptvillagesubdivision'),
                ];
                $this->clientsModel->save($data);
                session()->setTempdata('success', 'Client is added successfully', 3);
                return redirect()->to(base_url().'register-client');
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('clientview-add', $data);
    }
    public function clients(){
        $data = [
            'page_title' => 'ISP - Clients',
            'page_heading' => 'CLIENTS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['clientdata'] = $this->clientsModel->where('isdel', '0')->paginate(20);

        if ($this->request->is('post')) {
            $searchClient = $this->request->getVar('searchclient');

            if($searchClient == ''){
                $ClientCondition = array('isdel' => 0);
                $data['resultClient'] = $this->clientsModel->where($ClientCondition)->findAll();
                return view('clients-results', $data);
            }else{
                $ClientCondition = array('isdel' => 0);
                $data['resultClient'] = $this->clientsModel
                ->like('fullname', $searchClient)
                ->orlike('clientid', $searchClient)->where($ClientCondition)->findAll();
                return view('clients-results', $data);
            }
        }

        return view('clients', $data);
    }
    public function clientdelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->clientsModel->where('clientid', $id)->update($id, $data);
        session()->setTempdata('error', 'Client is deleted!', 2);
        return redirect()->to(base_url()."clients"); 
    }
    public function clientedit($id=null) {
        $data = [
            'page_title' => 'ISP - Clients',
            'page_heading' => 'CLIENTS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['clientdata'] = $this->clientsModel->where('clientid', $id)->findAll();

        if ($this->request->is('post')) {
            $data = [
                'firstname' => $this->request->getVar('iptfirstname'),
                'middlename' => $this->request->getVar('iptmiddlename'),
                'lastname' => $this->request->getVar('iptlastname'),
                'fullname' => $this->request->getVar('iptlastname').', '.$this->request->getVar('iptfirstname').' '.$this->request->getVar('iptmiddlename'),
                'mobile' => $this->request->getVar('iptmobile'),
                'email' => $this->request->getVar('iptemail'),
                'province' => $this->request->getVar('iptprovince'),
                'city' => $this->request->getVar('iptcity'),
                'barangay' => $this->request->getVar('iptbarangay'),
                'zipcode' => $this->request->getVar('iptzipcode'),
                'propertytype' => $this->request->getVar('iptpropertytype'),
                'houseunitno' => $this->request->getVar('ipthouseunitno'),
                'buildingname' => $this->request->getVar('iptbuildingname'),
                'street' => $this->request->getVar('iptstreet'),
                'villagesubdivision' => $this->request->getVar('iptvillagesubdivision'),
            ];
            $this->clientsModel->where('clientid', $id)->update($id, $data);
            session()->setTempdata('success', 'Client is updated successfully', 3);
            return redirect()->to(base_url().'clients');
        }
        return view('clientview-edit', $data);
    }
    public function clientprocess($id=null){
        $data = [
            'page_title' => 'ISP - Process Client',
            'page_heading' => 'PROCESS CLIENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['clientdata'] = $this->clientsModel->where('clientid', $id)->findAll();
        $data['plandata'] = $this->plansModel->where('isdel', '0')->findAll();

        return view('clientview-process', $data);
    }
    public function clientprocess1($planid=null, $clientid=null){
        $data = [
            'page_title' => 'ISP - Process Client',
            'page_heading' => 'PROCESS CLIENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['clientdata'] = $this->clientsModel->where('clientid', $clientid)->findAll();
        $data['plandata'] = $this->plansModel->where('planid', $planid)->findAll();
        $data['bundledata'] = $this->bundlesModel->where('planid', $planid)->findAll();
        $data['inclusiondata'] = $this->inclusionModel->where('isdel', '0')->findAll();

        return view('clientview-process-2', $data);
    }
    public function clientprocess2($planid=null, $clientid=null){
        $data = [
            'clientid' => $clientid,
            'planid' => $planid,
            'createdat' => date('Y-m-d'),
        ];
        $this->accountsModel->save($data);
        $accountdata = $this->accountsModel
        ->where('clientid', $clientid)->where('planid', $planid)->findAll();
        foreach($accountdata as $accountd){
            $accid = $accountd['accountid'];
        }
        return redirect()->to(base_url().'clients-bill-process/'.$accid);
    }
    public function clientsbill($id=null)
    {
        $data = [
            'page_title' => 'ISP - Process Client',
            'page_heading' => 'PROCESS CLIENT',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['clientdata'] = $this->clientsModel->where('clientid', $clientid)->findAll();
        $data['plandata'] = $this->plansModel->where('planid', $planid)->findAll();
        $data['bundledata'] = $this->bundlesModel->where('planid', $planid)->findAll();
        $data['inclusiondata'] = $this->inclusionModel->where('isdel', '0')->findAll();

        return view('clientbillview', $data);
    }
}
