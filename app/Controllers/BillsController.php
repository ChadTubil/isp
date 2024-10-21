<?php

namespace App\Controllers;
use App\Models\BillsModel;
use App\Models\UsersModel;
use App\Models\AccountsModel;
use App\Models\ClientsModel;
use App\Models\PlansModel;
use App\Models\BundlesModel;
use App\Models\InclusionModel;
class BillsController extends BaseController
{
    public $billsModel;
    public $usersModel;
    public $accountsModel;
    public $clientsModel;
    public $plansModel;
    public $bundlesModel;
    public $inclusionModel;
    public $session;
    public function __construct() {
        $this->billsModel = new BillsModel();
        $this->usersModel = new UsersModel();
        $this->accountsModel = new AccountsModel();
        $this->clientsModel = new ClientsModel();
        $this->plansModel = new PlansModel();
        $this->bundlesModel = new BundlesModel();
        $this->inclusionModel = new InclusionModel();
        helper('form');
        $this->session = session();
    }
    public function index()
    {
        $data = [
            'page_title' => 'ISP - Bills',
            'page_heading' => 'BILLS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['billsdata'] = $this->billsModel->findAll();
        return view('billsview', $data);
    }
    public function view($id=null){
        $data = [
            'page_title' => 'ISP - Bills',
            'page_heading' => 'BILLS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $BILLSDATA = $this->billsModel->where('billsid', $id)->findAll();
        foreach($BILLSDATA as $BILLSD){
            $ACCOUNTID = $BILLSD['accountid'];
        }
        $ACCOUNTSDATA = $this->accountsModel->where('accountid', $ACCOUNTID)->findAll();
        foreach($ACCOUNTSDATA as $ACCOUNTSD){
            $CLIENTID = $ACCOUNTSD['clientid'];
            $PLANID = $ACCOUNTSD['planid'];
        }
        $data['clientdata'] = $this->clientsModel->where('clientid', $CLIENTID)->findAll();
        $data['plandata'] = $this->plansModel->where('planid', $PLANID)->findAll();
        $data['bundledata'] = $this->bundlesModel->where('planid', $PLANID)->findAll();
        $data['inclusiondata'] = $this->inclusionModel->where('isdel', '0')->findAll();
        $data['accountsdata'] = $this->accountsModel->where('accountid', $ACCOUNTID)->findAll();
        $data['billsdata'] = $this->billsModel->where('billsid', $id)->findAll();

        return view('billsview-view', $data);
    }
}
