<?php

namespace App\Controllers;
use App\Models\UsersModel;
class DashboardController extends BaseController
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
            'page_title' => 'ISP - Dashboard',
            'page_heading' => 'DASHBOARD',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        return view('dashboardview', $data);
    }
    public function error404(){
        $data = [
            'page_title' => 'ISP - 404',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        return view('custom_erros', $data);
    }
}
