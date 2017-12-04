<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dwij\Laraadmin\Models\Menu;
use DB;
use Validator;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Input;
use Response;
use Lang;
use Session;
use PDF;

use App\Helpers\CommonHelper;
use App\Models\Employee_Info;

use mPDF;


class Regular_Salary_Est_PoliceController extends Controller
{
    public $show_action = true;

    public function __construct()
    {
        $this->menu_id = Menu::get('regular_salary_est_police');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $employees =Employee_Info::dropdown_rab_without_officer(); /**/
            return View('payroll.regular_salary_police.index', [
                'show_actions' => $this->show_action,
                'employees' => $employees,
                'print_url' => 'regular_salary_est_police_pdf',
            ]);
        } else {
            return View('error');
        }
    }

    public function showReport(Request $request)
    {
        if(Menu::hasAccess("regular_salary_est_afd", "create")){
            //echo 'munna';die();

            $config=[
              'mode'=>'bn',
              'formate' => 'L',
              'default_font_size' => '9',
              'default_font' => 'solaimanlipi',
            ];
             $employee = Employee_Info::officerSalaryEmployee($request->emp_id);

            // $data=[
            //     'empoloyee'=>    $employee
            // ];
            // $mergeData=[];
            // $pdf = PDF::loadView('payroll.regular_salary.regular_salary',$data,$mergeData,$config);
            // return $pdf->stream('regular_salary_establishment_afd'.date('Y-m-d H:i:s').'.pdf');


            $mpdf = new mPDF(
                'bn',
                'L',
                '9',
                'solaimanlipi'
            );
           // $stylesheet = file_get_contents('payroll.regular_salary.regular_salary');


            $html = View('payroll.regular_salary_police.regular_salary',[
                'empoloyee'=>    $employee
            ]);

            $mpdf->WriteHTML($html);

            $mpdf->AddPage('L');

            $html2 = View('payroll.regular_salary_police.regular_employee_salary',[
                'empoloyee'=>    $employee
            ]);
            $mpdf->WriteHTML($html2);

            $mpdf->AddPage('L');
            $html3 = View('payroll.regular_salary_police.regular_employee_salary_summery',[
                'empoloyee'=>    $employee
            ]);
            $mpdf->WriteHTML($html3);

            $mpdf->AddPage();
            $html4 = View('payroll.regular_salary_police.future_funding_cut',[
                'empoloyee'=>    $employee
            ]);
            $mpdf->WriteHTML($html4);


            $mpdf->AddPage();
            $html5 = View('payroll.regular_salary_police.establishment_regular_salary',[
                'empoloyee'=>    $employee
            ]);
            $mpdf->WriteHTML($html5);

            $mpdf->AddPage();
            $html6 = View('payroll.regular_salary_police.bill_received',[
                'empoloyee'=>    $employee
            ]);
            $mpdf->WriteHTML($html6);


            $mpdf->Output();

        }

    }


}
