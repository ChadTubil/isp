<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\EmployeesModel;
use App\Models\PositionsModel;
class EmployeesController extends BaseController
{
    public $empModel;
    public $usersModel;
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
            'page_title' => 'ISP - Employees',
            'page_heading' => 'EMPLOYEES',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['employeesdata'] = $this->empModel->where('isdel', '0')->findAll();
        $data['positionsdata'] = $this->posModel->where('isdel', '0')->findAll();

        return view('employeesview', $data);
    }
    public function employeesadd()
    {
        $data = [
            'page_title' => 'ISP - Employees',
            'page_heading' => 'EMPLOYEES',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['employeesdata'] = $this->empModel->where('isdel', '0')->findAll();
        $data['positionsdata'] = $this->posModel->where('isdel', '0')->findAll();

        if ($this->request->is('post')) {
            $rules = [
                'iptempnum' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Employee number is required.',
                    ],
                ],
                'iptlastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Employee lastname is required.',
                    ],
                ],
                'iptfirstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Employee firstname is required.',
                    ],
                ],
                'iptmiddlename' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Employee middlename is required.',
                    ],
                ],
                'ipthiring' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Employee hiring date is required.',
                    ],
                ],
                'iptposition' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Employee position is required.',
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $LN = $this->request->getVar('iptlastname');
                $FN = $this->request->getVar('iptfirstname');
                $MN = $this->request->getVar('iptmiddlename');
                $EXT = $this->request->getVar('iptext');

                $data = [
                    'empnum' => $this->request->getVar('iptempnum'),
                    'empfn' => $this->request->getVar('iptfirstname'),
                    'mn' => $this->request->getVar('iptmiddlename'),
                    'ln' => $this->request->getVar('iptlastname'),
                    'extension' => $this->request->getVar('iptext'),
                    'fullname' => $LN.', '.$FN.' '.$MN.' '.$EXT,
                    'hiringdate' => $this->request->getVar('ipthiring'),
                    'position' => $this->request->getVar('iptposition'),
                ];
                $this->empModel->save($data);
                session()->setTempdata('success', 'Employee added successfully', 3);
                return redirect()->to(base_url().'employees');
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('employeesview-add', $data);
    }
    public function employeedelete($id=null) {
        $data = [
            'isdel' => '1',
        ];
        $this->empModel->where('empid', $id)->update($id, $data);
        $this->usersModel->where('uaccid', $id)->update($id, $data);
        session()->setTempdata('error', 'Employee is deleted!', 2);
        return redirect()->to(base_url()."employees"); 
        
        
    }
    public function employeesedit($id=null){
        $data = [
            'page_title' => 'ISP - Employees',
            'page_heading' => 'EMPLOYEES',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url());
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);

        $data['employeesdata'] = $this->empModel->where('isdel', '0')->findAll();
        $data['positionsdata'] = $this->posModel->where('isdel', '0')->findAll();

        if ($this->request->is('post')) {
            $LN = $this->request->getVar('iptlastname');
            $FN = $this->request->getVar('iptfirstname');
            $MN = $this->request->getVar('iptmiddlename');
            $EXT = $this->request->getVar('iptext');

            $data = [
                'empnum' => $this->request->getVar('iptempnum'),
                'empfn' => $this->request->getVar('iptfirstname'),
                'mn' => $this->request->getVar('iptmiddlename'),
                'ln' => $this->request->getVar('iptlastname'),
                'extension' => $this->request->getVar('iptext'),
                'fullname' => $LN.', '.$FN.' '.$MN.' '.$EXT,
                'hiringdate' => $this->request->getVar('ipthiring'),
                'position' => $this->request->getVar('iptposition'),
            ];
            $this->empModel->where('empid', $id)->update($id, $data);
            session()->setTempdata('success', 'Employee is updated', 3);
            return redirect()->to(base_url().'employees');
        }

        return view('employeesview-edit', $data);
    }
}
