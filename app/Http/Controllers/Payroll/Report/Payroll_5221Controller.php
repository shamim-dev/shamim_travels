<?php

namespace App\Http\Controllers\Payroll\Report;

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
use App\Models\Battalion;
use App\Models\Wing;
use mPDF;


class Payroll_5221Controller extends Controller
{
    public $show_action = true;

    public function __construct()
    {
        $this->menu_id = Menu::get('Payroll_5221');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $battalions=Battalion::all();
            return View('payroll.report.common.common_salary_report_header', [
                'show_actions' => $this->show_action,
                'battalions' => $battalions,
                'header'=>'Payroll 5221',
                'is_officer'=>1,
                'print_url' => 'payroll_5221_pdf',
            ]);

        } else {
            return View('error');
        }
    }

    public function payroll_5221_pdf(Request $request)
    {
        if(Menu::hasAccess("Payroll_5221", "create"))
        {
            //.................common input start..................
            $battalion_id=$request->battalion_id;
            $wing_id=$request->wing_id;
            $branch_id=$request->branch_id;
            $sub_branch_id=$request->sub_branch_id;
            $section_id=$request->section_id;
            $sub_section_id=$request->sub_section_id;

            if(isset($request->is_officer))
            {
               $is_officer=$request->is_officer;
            }
            else
            {
                $is_officer=0;
            }

            if($battalion_id>0 && $wing_id>0 && $branch_id>0 && $sub_branch_id>0 && $section_id>0 && $sub_section_id>0)
            {
                $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
            and pr.branch_id=$branch_id and pr.sub_branch_id=$sub_branch_id
            and pr.section_id=$section_id and pr.sub_section_id=$sub_section_id";
            }
            elseif($battalion_id>0 && $wing_id>0 && $branch_id>0 && $sub_branch_id>0 && $section_id>0)
            {
                $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
            and pr.branch_id=$branch_id and pr.sub_branch_id=$sub_branch_id
            and pr.section_id=$section_id";

            }
            elseif($battalion_id>0 && $wing_id>0 && $branch_id>0 && $sub_branch_id>0)
            {
                $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
            and pr.branch_id=$branch_id and pr.sub_branch_id=$sub_branch_id";
            }
            elseif($battalion_id>0 && $wing_id>0 && $branch_id>0)
            {
                $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
            and pr.branch_id=$branch_id";
            }
            elseif($battalion_id>0 && $wing_id>0)
            {
                $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id";
            }
            elseif($battalion_id>0)
            {
                $v_query="and pr.`battalion_id`=$battalion_id";
            }
            else
            {
                $v_query=NULL;
            }

            if(empty($is_officer))
            {
                $v_officer_sql=NULL;
                
            }
            else
            {
                $v_officer_sql="and r.is_officer='$is_officer'";
            }

            $y_m=$request->salary_date;
            $salary_date=$y_m.'-01';

            $posting_rec_id=$request->posting_rec_id;
            if(in_array('all', $posting_rec_id)){
                $v_postin_rec_sql = NULL;
            }else{
                $posting_rec = implode(',', $posting_rec_id);
                $v_postin_rec_sql = "AND psp.posting_rec_id in ($posting_rec)";

            }
            //.................common input end..................


            //................report data start.............
            $employees=DB::SELECT("SELECT psp.*,ei.emp_id, ei.rab_id, ei.emp_name, ei.personal_no, r.rank_short_name,r.rank_name, d.designation_name
                FROM `payroll_salary_process` psp
                inner join posting_record pr on(pr.`posting_rec_id`=psp.`posting_rec_id`)
                inner join employees_info ei on(ei.emp_id=pr.emp_id)
                inner JOIN ranks r ON (ei.rank_id = r.id)
                LEFT JOIN designations d ON (ei.designation_id = d.id)
                WHERE psp.`salary_date`='$salary_date'
                $v_postin_rec_sql
                $v_officer_sql
                $v_query
                and psp.`deleted_at` is null
                and pr.`deleted_at` is null
                and ei.`deleted_at` is null
                and r.`deleted_at` is null
                and d.`deleted_at` is null
                ");
            $battalion=Battalion::find($battalion_id);
            $wing=Wing::find($wing_id);
            //................report data end.............


            //................report pdf start.............
            $config=[
              'mode'=>'bn',
              'default_font_size' => '12',
              'default_font' => 'solaimanlipi',
            ];
            
            $data=[
            'employees'=>$employees,
            'battalion'=>$battalion,
            'wing'=>$wing,
            'salary_date'=>$salary_date
            ];
            $mergeData=[];
            $pdf = PDF::loadView('payroll.report.payroll_5221.payroll_5221',$data,$mergeData,$config);
            //return $pdf->stream('regular_salary_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->download('regular_salary_'.date('Y-m-d H:i:s').'.pdf');
            //................report pdf end.............
        }
    }


}
