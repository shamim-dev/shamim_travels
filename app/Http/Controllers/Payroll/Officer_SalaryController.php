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


class Officer_SalaryController extends Controller
{
    public $show_action = true;
    
    public function __construct()
    {
        $this->menu_id = Menu::get('officer_regular_salary');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $employees =Employee_Info::dropdown_rab_officer();
            return View('payroll.officer_salary.index', [
                'show_actions' => $this->show_action,
                'employees' => $employees,
                'print_url' => 'officer_regular_salary_pdf',
            ]);
        } else {
            return View('error');
        }
    }

    public function showReport(Request $request)
    {
        if(Menu::hasAccess("officer_regular_salary", "create")){
            $config=[
              'mode'=>'bn',
              'default_font_size' => '12',
              'default_font' => 'solaimanlipi',
            ];
            $employee = Employee_Info::officerSalaryEmployee($request->emp_id);
            
            $data=[
                'empoloyee'=>    $employee
            ];
            $mergeData=[];
            $pdf = PDF::loadView('payroll.officer_salary.officer_regular_salary',$data,$mergeData,$config);
            return $pdf->stream('officer_regular_salary'.date('Y-m-d H:i:s').'.pdf');

        }

    }


}