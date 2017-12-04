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



class Officer_Regular_SalaryController extends Controller
{
    public $show_action = true;

    public function __construct()
    {
        $this->menu_id = Menu::get('Officer_Regular_Salary');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $battalions=Battalion::all();
            return View('payroll.report.common.common_salary_report_header', [
                'show_actions' => $this->show_action,
                'battalions' => $battalions,
                'header'=>'Officer Regular Salary',
                'is_officer_selected'=>1,
                'print_url' => 'officer_regular_salary_pdf',
            ]);

        } else {
            return View('error');
        }
    }

    public function officer_regular_salary_pdf(Request $request)
    {
        //echo 'officer_regular_salary_pdf';die();
        if(Menu::hasAccess("Officer_Regular_Salary", "create"))
        {
            //.................common input start..................
            if(isset($request->battalion_id))
            {
                $battalion_id=$request->battalion_id;
            }
            else
            {
                $battalion_id=Session::get('battalion_id');
            }

            if(isset($request->wing_id))
            {
                $wing_id=$request->wing_id;
            }
            else
            {
                $wing_id=Session::get('wing_id');
            }

            if(isset($request->branch_id))
            {
                $branch_id=$request->branch_id;
            }
            else
            {
                $branch_id=Session::get('branch_id');
            }

            if(isset($request->sub_branch_id))
            {
                $sub_branch_id=$request->sub_branch_id;
            }
            else
            {
                $sub_branch_id=Session::get('sub_branch_id');
            }

            if(isset($request->section_id))
            {
                $section_id=$request->section_id;
            }
            else
            {
                $section_id=Session::get('section_id');
            }

            if(isset($request->sub_section_id))
            {
                $sub_section_id=$request->sub_section_id;
            }
            else
            {
                $sub_section_id=Session::get('sub_section_id');
            }

            // if(isset($request->is_officer))
            // {
            //    $is_officer=$request->is_officer;
            // }
            // else
            // {
            //     $is_officer=0;
            // }
            $is_officer='Yes';

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

            //............oficer employee start.............
            $employees=DB::SELECT("SELECT ei.emp_id, ei.rab_id, ei.emp_name, ei.personal_no, r.rank_short_name, b.battalion_name, b.battalion_address,r.rank_name, d.designation_name,psp.id,psp.salary_amount
                FROM `payroll_salary_process` psp
                inner join posting_record pr on(pr.`posting_rec_id`=psp.`posting_rec_id`)
                inner join employees_info ei on(ei.emp_id=pr.emp_id)
                inner JOIN ranks r ON (ei.rank_id = r.id)
                LEFT JOIN designations d ON (ei.designation_id = d.id)
                LEFT JOIN battalions b ON (b.id = pr.battalion_id)
                WHERE psp.`salary_date`='$salary_date'
                $v_postin_rec_sql
                $v_officer_sql
                $v_query
                and psp.`deleted_at` is null
                AND pr.`deleted_at` IS NULL
                AND ei.`deleted_at` IS NULL
                AND r.`deleted_at` IS NULL
                AND d.`deleted_at` IS NULL
                AND b.`deleted_at` IS NULL
                ");
            //............oficer employee end.............

            //..........basic start......
            $basic_salary=DB::SELECT("SELECT sum(pspd.amount) as basic_salary
                FROM `payroll_salary_process` psp
                inner join posting_record pr on(pr.`posting_rec_id`=psp.`posting_rec_id`)
                inner join employees_info ei on(ei.emp_id=pr.emp_id)
                inner JOIN ranks r ON (ei.rank_id = r.id)
                inner join payroll_salary_process_details pspd on(pspd.`salary_process_id`=psp.`id`)
                WHERE psp.`salary_date`='$salary_date'
                and pspd.process_type='3'
                $v_postin_rec_sql
                $v_officer_sql
                $v_query
                and psp.`deleted_at` is null
                and pspd.`deleted_at` is null
                AND pr.`deleted_at` IS NULL
                AND ei.`deleted_at` IS NULL
                AND r.`deleted_at` IS NULL
                ")[0];
            //..........basic end......

            //..........allowance heads start......
            $allowance_heads=DB::SELECT("SELECT ph.`id` , ph.name, ph.code, SUM( pspd.`amount` ) as sum_amount
            FROM  `payroll_salary_process` psp
            INNER JOIN posting_record pr ON ( pr.`posting_rec_id` = psp.`posting_rec_id` ) 
            INNER JOIN employees_info ei ON ( ei.emp_id = pr.emp_id ) 
            INNER JOIN ranks r ON ( ei.rank_id = r.id ) 
            INNER JOIN payroll_salary_process_details pspd ON ( pspd.`salary_process_id` = psp.`id` ) 
            INNER JOIN payroll_allowances pa ON ( pa.id = pspd.allowance_id ) 
            INNER JOIN payroll_heads ph ON ( ph.id = pa.payroll_head_id ) 
            WHERE psp.`salary_date` =  '$salary_date'
            AND pspd.process_type =  '1'
            $v_postin_rec_sql
            $v_officer_sql
            $v_query
            AND psp.`deleted_at` IS NULL 
            AND pspd.`deleted_at` IS NULL 
            AND pa.`deleted_at` IS NULL 
            AND ph.`deleted_at` IS NULL 
            AND pr.`deleted_at` IS NULL
            AND ei.`deleted_at` IS NULL
            AND r.`deleted_at` IS NULL
            GROUP BY ph.id
            ORDER BY ph.id ASC 
            ");
            //..........allowance heads end......

            //..........other allowance heads start......
            $allowances=DB::SELECT("SELECT pa.`id` , pa.allowance_name,SUM( pspd.`amount` ) as sum_amount
            FROM  `payroll_salary_process` psp
            INNER JOIN posting_record pr ON ( pr.`posting_rec_id` = psp.`posting_rec_id` ) 
            INNER JOIN employees_info ei ON ( ei.emp_id = pr.emp_id ) 
            INNER JOIN ranks r ON ( ei.rank_id = r.id ) 
            INNER JOIN payroll_salary_process_details pspd ON ( pspd.`salary_process_id` = psp.`id` ) 
            INNER JOIN payroll_allowances pa ON ( pa.id = pspd.allowance_id ) 
            INNER JOIN payroll_heads ph ON ( ph.id = pa.payroll_head_id ) 
            WHERE psp.`salary_date` =  '$salary_date'
            AND pspd.process_type =  '1'
            and ph.id='22'
            $v_postin_rec_sql
            $v_officer_sql
            $v_query
            AND psp.`deleted_at` IS NULL 
            AND pspd.`deleted_at` IS NULL 
            AND pa.`deleted_at` IS NULL 
            AND ph.`deleted_at` IS NULL 
            AND pr.`deleted_at` IS NULL
            AND ei.`deleted_at` IS NULL
            AND r.`deleted_at` IS NULL
            GROUP BY pa.id
            ORDER BY pa.id ASC 
            ");
            //..........other allowance heads end......

            //..........deductions heads start......
            $deduction_heads=DB::SELECT("SELECT ph.`id` , ph.name, ph.code, SUM( pspd.`amount` ) as sum_amount
            FROM  `payroll_salary_process` psp
            INNER JOIN posting_record pr ON ( pr.`posting_rec_id` = psp.`posting_rec_id` ) 
            INNER JOIN employees_info ei ON ( ei.emp_id = pr.emp_id ) 
            INNER JOIN ranks r ON ( ei.rank_id = r.id ) 
            INNER JOIN payroll_salary_process_details pspd ON ( pspd.`salary_process_id` = psp.`id` ) 
            INNER JOIN payroll_deductions pd ON ( pd.id = pspd.deduction_id ) 
            INNER JOIN payroll_heads ph ON ( ph.id = pd.payroll_head_id ) 
            WHERE psp.`salary_date` =  '$salary_date'
            AND pspd.process_type =  '2'
            $v_postin_rec_sql
            $v_officer_sql
            $v_query
            AND psp.`deleted_at` IS NULL 
            AND pspd.`deleted_at` IS NULL 
            AND pd.`deleted_at` IS NULL 
            AND ph.`deleted_at` IS NULL 
            AND pr.`deleted_at` IS NULL
            AND ei.`deleted_at` IS NULL
            AND r.`deleted_at` IS NULL
            GROUP BY ph.id
            ORDER BY ph.id ASC 
            ");
            //..........deductions heads end......

            $battalion=Battalion::find($battalion_id);
            $wing=Wing::find($wing_id);

            //................report data end.............


            //................report pdf start.............
            $config=[
              'mode'=>'bn',
              //'format'=>'L',
              'default_font_size' => '12',
              'default_font' => 'solaimanlipi',
            ];
            
            $data=[
            'employees'=>$employees,
            'battalion'=>$battalion,
            'wing'=>$wing,
            'salary_date'=>$salary_date,
            'basic_salary'=>$basic_salary,
            'allowance_heads'=>$allowance_heads,
            'allowances'=>$allowances,
            'deduction_heads'=>$deduction_heads
            ];
            $mergeData=[];
            $pdf = PDF::loadView('payroll.report.officer.officer_regular_salary',$data,$mergeData,$config);
            //return $pdf->stream('officer_regular_salary_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->download('officer_regular_salary_'.date('Y-m-d H:i:s').'.pdf');
            //................report pdf end.............
        }
    }


}
