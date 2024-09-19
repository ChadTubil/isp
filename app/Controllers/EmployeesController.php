<?php

namespace App\Controllers;

class EmployeesController extends BaseController
{
    public function index(): string
    {
        return view('employeesview');
    }
}
