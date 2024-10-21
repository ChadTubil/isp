<?php

namespace App\Controllers;
use App\Models\BillsModel;
use App\Models\UsersModel;
use App\Models\AccountsModel;
use App\Models\ClientsModel;
use App\Models\PlansModel;
use App\Models\BundlesModel;
use App\Models\InclusionModel;
use TCPDF;
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
    public function print($id=null){
        // Load TCPDF library
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetAuthor('ISP');
        $pdf->SetTitle('STATEMENT OF ACCOUNT');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5,40,5);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();

        $imagePath = FCPATH .'public/assets/Logo2.png';
        $pdf->Image($imagePath, $x = 5, $y = 0, $w = 206, $h = 36); 
        $pdf->Line(5, 37, 211, 37);

        $html = '';

        // Output PDF to browser
        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->Output('INNOSAMPLE.pdf', 'D');
    }
}
