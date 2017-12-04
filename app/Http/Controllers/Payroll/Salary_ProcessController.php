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
use Carbon\Carbon;

use App\Helpers\CommonHelper;

use App\Models\Payroll_Salary_Process;
use App\Models\Payroll_Salary_Process_Detail;
use App\Models\Payroll_Hrm;
use App\Models\Payroll_Hrm_Detail;
use App\Models\Payroll_Pay_Scale_Detail;

use App\Models\Battalion;
use App\Models\Posting_Record;

class Salary_ProcessController extends Controller
{
    public $show_action = true;
    
    public function __construct()
    {
        $this->menu_id = Menu::get('Salary_Process');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $list_values = Payroll_Salary_Process::dt_info();
            return View('payroll.salary_process.index', [
                'show_actions' => $this->show_action,
                'values'=>$list_values,
            ]);
        } else {
            return View('error');
        }
    }
    public function create()
    {
        $battalions=Battalion::all();
        return View('payroll.salary_process.process_form',[
            'battalions'=>$battalions
            ]);
    }
    public function edit($id)
    {
        $month_last_date = new Carbon('last day of this month');
        $dt = Carbon::create(2012, 1, 31, 12, 0, 0);
        echo $dt->endOfMonth();

        $c_salary_date = Carbon::parse('2017-10-01');
        $v_from_date = Carbon::parse('2017-11-01');
        $date_diff = $v_from_date->diffInDays($c_salary_date);
        echo $month_last_date->day.'<br>';
        echo $date_diff;
        if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
        {
            echo $date_diff;die();
            $pspd_from_date=$phd->effective_from_date;
            $pspd_to_date=$c_salary_date->endOfMonth();
        }
        else
        {
            echo 'munna';die();
            $pspd_from_date=$salary_date;
            $pspd_to_date=$c_salary_date->endOfMonth();
        }
    }
    public function store(Request $request){
        if(Menu::hasAccess("Salary_Process", "create")) 
        {   
            //echo 'munna';die();
            //$month_last_date = new Carbon('last day of this month');
            //.........salary start date.........
            $y_m=$request->salary_date;
            $salary_date=$y_m.'-01';
            $c_salary_date= Carbon::parse($salary_date);
            //.........salary start date.........

            //.........salary end date.........
            $a_salary_end_date=explode(" ",$c_salary_date->endOfMonth());
            $salary_end_date=$a_salary_end_date[0];
            //echo $salary_end_date;die();
            $month_last_date= Carbon::parse($c_salary_date->endOfMonth());
            //.........salary end date.........

            $v_posting_rec_id=Session::get('posting_rec_id');
            //echo $v_posting_rec_id;die();

            $battalion_id=$request->battalion_id;
            $wing_id=$request->wing_id;
            $branch_id=$request->branch_id;
            $sub_branch_id=$request->sub_branch_id;
            $section_id=$request->section_id;
            $sub_section_id=$request->sub_section_id;


            $posting_records = $request->posting_rec_id;
            if(in_array('all', $posting_records)) 
            {
               $posting_records = Payroll_Salary_Process::posting_record_list($battalion_id,$wing_id,$branch_id,$sub_branch_id,$section_id,$sub_section_id);
            }
            else
            {
               $posting_records = Posting_Record::whereIn('posting_rec_id', $posting_records)->get(); 
            }
            
            //...........all employee process start...........
            foreach ($posting_records as $key => $posting_record) {

                /*******************************Payroll_Salary_Process table Start ***************************/

                $payroll_salary_process_check=Payroll_Salary_Process::where('posting_rec_id',$posting_record->posting_rec_id)
                ->where('salary_date',$salary_date)
                ->first();

                if(isset($payroll_salary_process_check->id))
                {
                    //.......update start.......
                    $payroll_salary_process=Payroll_Salary_Process::find($payroll_salary_process_check->id);
                    //.......update end.......
                }
                else
                {
                    //.......insert start.......
                    $payroll_salary_process=new Payroll_Salary_Process();
                    //.......insert end.......
                }
                
                $payroll_salary_process->posting_rec_id=$posting_record->posting_rec_id;
                $payroll_salary_process->salary_date=$salary_date;
                $payroll_salary_process->created_by=$v_posting_rec_id;
                $payroll_salary_process->save();

                $v_payroll_salary_process_id=$payroll_salary_process->id;

                /*******************************Payroll_Salary_Process table end ***************************/






                /*******************************payroll_salary_process_details table Start ***************************/

                //.........payroll_salary_process_details date start.....

                //$payroll_hrms=Payroll_Hrm::where('emp_id',$posting_record->emp_id)->get();

                $payroll_hrms=DB::SELECT("SELECT * 
                FROM (
                SELECT * 
                FROM  `payroll_hrm` ph
                WHERE ph.`emp_id` =  '$posting_record->emp_id'
                AND ph.`effective_date` <=  '$salary_end_date'
                and ph.deleted_at is null
                )a
                WHERE a.`end_date` >=  '$salary_date'
                OR a.`end_date` IS NULL");
                //.......multiple pay scale against 1 employee start.....
                foreach ($payroll_hrms as $key => $payroll_hrm) 
                {   
                    $v_effective_date = Carbon::parse($payroll_hrm->effective_date);
                    $v_salary_date = Carbon::parse($salary_date);
                    $v_working_days = $v_effective_date->diffInDays($v_salary_date);

                    //echo $month_last_date->day.'<br>'.$v_working_days.'<br>';

                    $less_than_one_month_pay_scale=0;
                    if($month_last_date->day>$v_working_days && $month_last_date->month==$v_effective_date->month)
                    {
                        $v_from_date=$payroll_hrm->effective_date;
                        $less_than_one_month_pay_scale=1;
                    }
                    else
                    {
                        $v_from_date=$salary_date;
                    }
                    //echo $v_from_date;die();

                    $job_end=0;

                    if(isset($payroll_hrm->end_date))
                    {
                        $v_end_date = Carbon::parse($payroll_hrm->end_date);
                        $v_salary_date = Carbon::parse($salary_date);
                        $v_last_working_days = $v_end_date->diffInDays($v_salary_date);

                        if($month_last_date->day>$v_last_working_days)
                        {
                            $job_end=1;
                            $v_to_date=$payroll_hrm->end_date;
                        }
                        else
                        {
                            $v_to_date=$month_last_date;
                        }

                    }
                    else
                    {
                        $v_to_date=$month_last_date; 
                    }
                    //echo $v_to_date;die();
                    //.........payroll_salary_process_details date end.....



                    //................pay scale amount start...............

                    // $v_pay_scale_year=1; //here will be many condition

                    // $payroll_pay_scale_detail=Payroll_Pay_Scale_Detail::where('pay_scale_id',$payroll_hrm->pay_scale_id)
                    // ->where('pay_scale_year',$v_pay_scale_year)
                    // ->first();
                    //print_r($payroll_pay_scale_detail);die();
                    //$v_pay_scale_amount=$payroll_pay_scale_detail->pay_scale_amount;

                    
                    $v_basic_from_date = Carbon::parse($v_from_date);
                    $v_basic_to_date = Carbon::parse($v_to_date);
                    

                    $v_ammount_from_date = Carbon::parse($v_from_date);
                    $v_ammount_to_date = Carbon::parse($v_to_date);
                    $date_diff = $v_ammount_to_date->diffInDays($v_ammount_from_date);
                    $amount_date_diff=$date_diff+1;
                    if($amount_date_diff==$month_last_date->day)
                    {
                        $v_pay_scale_amount=$payroll_hrm->basic_salary;
                        $v_basic_amount=$payroll_hrm->basic_salary;
                    }
                    else
                    {
                        $v_pay_scale_amount=($payroll_hrm->basic_salary*$amount_date_diff)/$month_last_date->day;
                        //$v_pay_scale_amount=number_format($v_pay_scale_amount,2);
                        $v_basic_amount=$payroll_hrm->basic_salary;
                    }



                    //................pay scale amount end...............

                    //................pay scale entry in payroll_salary_process_details start.........
                    $payroll_salary_process_detail_pay_scale_info=Payroll_Salary_Process_Detail::where('salary_process_id',$v_payroll_salary_process_id)
                    ->where('payroll_hrm_id',$payroll_hrm->id)
                    ->where('pay_scale_id',$payroll_hrm->pay_scale_id)
                    ->where('basic_amount',$v_basic_amount)
                    ->first();
                     //echo $v_payroll_salary_process_id.'salary_process_id'.$payroll_hrm->id.'hrm'.$payroll_hrm->pay_scale_id.'scale'.$v_pay_scale_amount.'amount';
                     //print_r($payroll_salary_process_detail_pay_scale_info);die();

                    if(empty($payroll_salary_process_detail_pay_scale_info))
                    {
                        $payroll_salary_process_detail=new Payroll_Salary_Process_Detail();
                    }
                    else
                    {
                        $payroll_salary_process_detail=Payroll_Salary_Process_Detail::find($payroll_salary_process_detail_pay_scale_info->id);
                    }
                    $payroll_salary_process_detail->salary_process_id=$v_payroll_salary_process_id;
                    $payroll_salary_process_detail->payroll_hrm_id=$payroll_hrm->id;
                    $payroll_salary_process_detail->pay_scale_id=$payroll_hrm->pay_scale_id;
                    $payroll_salary_process_detail->basic_amount=$payroll_hrm->basic_salary;
                    $payroll_salary_process_detail->process_type=3; //pay scale=3
                    $payroll_salary_process_detail->from_date=$v_from_date;
                    $payroll_salary_process_detail->to_date=$v_to_date;
                    $payroll_salary_process_detail->amount=$v_pay_scale_amount;

                
                    $payroll_salary_process_detail->save();

                    

                    
                    //................pay scale entry in payroll_salary_process_details end.........

                    $payroll_hrm_details=Payroll_Salary_Process::salary_process_info($payroll_hrm->id,$salary_date,$salary_end_date);
                    // echo count($payroll_hrm_details);
                    // print_r($payroll_hrm_details);die();
                    //............for update delete records start............

                     // $payroll_salary_process_detail_infos=Payroll_Salary_Process_Detail::where('salary_process_id',$v_payroll_salary_process_id)->get();

                    $payroll_salary_process_detail_infos=Payroll_Salary_Process_Detail::where('salary_process_id',$v_payroll_salary_process_id)
                    ->where('payroll_hrm_id',$payroll_hrm->id)
                    ->where('process_type','<',3)
                    ->get();
                    //print_r($payroll_salary_process_detail_infos);die();
                    foreach ($payroll_salary_process_detail_infos as $key => $value) {
                        $v_delete=1;
                        foreach ($payroll_hrm_details as $key => $phd) {
                            if(isset($value->allowance_id))
                            {
                                if($value->allowance_id==$phd->payroll_allowance_id)
                                {
                                    $v_delete=0;
                                    break;
                                }
                            }
                            if(isset($value->deduction_id))
                            {
                                if($value->deduction_id==$phd->payroll_deduction_id)
                                {
                                    $v_delete=0;
                                    break;
                                }
                            }
                            
                        }
                        if($v_delete==1)
                        {
                            //echo $v_delete;die();
                            Payroll_Salary_Process_Detail::find($value->id)->delete();
                        }
                    }
                    //............for update delete records end............


                    //................allowance/deduction entry in payroll_salary_process_details start.........
                    foreach ($payroll_hrm_details as $key => $phd) {
                      
                        $payroll_salary_process_detail_info=DB::SELECT("SELECT * from
                        (
                        SELECT * 
                        FROM `payroll_salary_process_details` pspd
                        WHERE pspd.`salary_process_id`='$v_payroll_salary_process_id'
                        and pspd.`payroll_hrm_id`='$payroll_hrm->id'
                        and pspd.`deleted_at` is null
                        ) a
                        where a.`allowance_id`='$phd->payroll_allowance_id'
                        or a.`deduction_id`='$phd->payroll_deduction_id'
                        ");


                         // echo $v_payroll_salary_process_id.'salary_process_id<br>'.$payroll_hrm->id.'hrm_id<br>'.$phd->payroll_allowance_id.'allowance_id<br>'.$phd->payroll_deduction_id;
                         // print_r($payroll_salary_process_detail_info);die();

                        if(empty($payroll_salary_process_detail_info))
                        {
                            $payroll_salary_process_detail=new Payroll_Salary_Process_Detail();
                        }
                        else
                        {
                            $payroll_salary_process_detail_info=$payroll_salary_process_detail_info[0];
                            $payroll_salary_process_detail=Payroll_Salary_Process_Detail::find($payroll_salary_process_detail_info->id);
                        }

                        $payroll_salary_process_detail->salary_process_id=$v_payroll_salary_process_id;
                        $payroll_salary_process_detail->payroll_hrm_id=$payroll_hrm->id;


                        //.....allowance date or deduction date calculation start....
                           if($job_end==1)
                           {
                                //.....when job end.....

                                // $pspd_from_date=$salary_date;
                                // $pspd_to_date=$v_to_date;

                                //.................From Date-To Date Start....................
                                if(isset($phd->effective_from_date) && isset($phd->effective_to_date))
                                {
                                    $v_from_date = Carbon::parse($phd->effective_from_date);
                                    $v_to_date = Carbon::parse($phd->effective_to_date);
                                    $date_diff = $v_from_date->diffInDays($v_to_date);
                                    if($date_diff<$month_last_date->day && $v_from_date->month==$v_to_date->month)
                                    {
                                        //.............same month from date-to date.......
                                        $pspd_from_date=$phd->effective_from_date;
                                        $pspd_to_date=$phd->effective_to_date;
                                    }
                                    else if($date_diff<$month_last_date->day && $v_from_date->month<$v_to_date->month)
                                    {
                                        if($c_salary_date->month==$v_from_date->month)
                                        {
                                            $pspd_from_date=$phd->effective_from_date;
                                            $pspd_to_date=$c_salary_date->endOfMonth();
                                        }
                                        else
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$phd->effective_to_date;
                                        }
                                    }
                                }
                               else if(isset($phd->effective_from_date))
                               {
                                    $v_from_date = Carbon::parse($phd->effective_from_date);
                                    $date_diff = $v_from_date->diffInDays($c_salary_date);
                                    if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
                                    {
                                        $pspd_from_date=$phd->effective_from_date;
                                        $pspd_to_date=$v_to_date;
                                    }
                                    else
                                    {
                                        $pspd_from_date=$salary_date;
                                        $pspd_to_date=$v_to_date;
                                    }
                               }
                               else if(isset($phd->effective_to_date))
                               {
                                    $v_to_date = Carbon::parse($phd->effective_to_date);
                                    $date_diff = $v_to_date->diffInDays($c_salary_date);
                                    if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
                                    {
                                        $pspd_from_date=$salary_date;
                                        $pspd_to_date=$phd->effective_to_date;
                                    }
                                    else
                                    {
                                        $pspd_from_date=$salary_date;
                                        $pspd_to_date=$c_salary_date->endOfMonth();
                                    }
                               }
                               else
                               {
                                    $pspd_from_date=$salary_date;
                                    $pspd_to_date=$v_to_date;
                               }
                                //.................From Date-To Date End....................
                           }
                           else
                           {
                                if($less_than_one_month_pay_scale==1)
                                {
                                    //.......if job is less than 1 month,start from any date of the month

                                    // $pspd_from_date=$payroll_hrm->effective_date;
                                    // $pspd_to_date=$v_to_date;

                                    //.................From Date-To Date Start....................
                                    if(isset($phd->effective_from_date) && isset($phd->effective_to_date))
                                    {
                                        $v_from_date = Carbon::parse($phd->effective_from_date);
                                        $v_to_date = Carbon::parse($phd->effective_to_date);
                                        $date_diff = $v_from_date->diffInDays($v_to_date);

                                        //echo $date_diff;die();

                                        if($date_diff<$month_last_date->day && $v_from_date->month==$v_to_date->month)
                                        {
                                            //.............same month from date-to date.......
                                            $pspd_from_date=$phd->effective_from_date;
                                            $pspd_to_date=$phd->effective_to_date;
                                        }
                                        else if($date_diff<$month_last_date->day && $v_from_date->month<$v_to_date->month)
                                        {
                                            if($c_salary_date->month==$v_from_date->month)
                                            {
                                                $pspd_from_date=$phd->effective_from_date;
                                                $pspd_to_date=$c_salary_date->endOfMonth();
                                            }
                                            else
                                            {
                                                $pspd_from_date=$salary_date;
                                                $pspd_to_date=$phd->effective_to_date;
                                            }
                                        }
                                    }
                                   else if(isset($phd->effective_from_date))
                                   {
                                        $v_from_date = Carbon::parse($phd->effective_from_date);
                                        $date_diff = $v_from_date->diffInDays($c_salary_date);
                                        if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
                                        {
                                            $pspd_from_date=$phd->effective_from_date;
                                            $pspd_to_date=$v_to_date;
                                        }
                                        else
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$v_to_date;
                                        }
                                   }
                                   else if(isset($phd->effective_to_date))
                                   {
                                        $v_to_date = Carbon::parse($phd->effective_to_date);
                                        $date_diff = $v_to_date->diffInDays($c_salary_date);
                                        if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$phd->effective_to_date;
                                        }
                                        else
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$v_to_date;
                                        }
                                   }
                                   else
                                   {
                                        //echo $key++;
                                        //echo $v_to_date;die();
                                        $pspd_from_date=$payroll_hrm->effective_date;
                                        //$pspd_to_date=$v_to_date;
                                        $pspd_to_date=$c_salary_date->endOfMonth();
                                   }
                                   //.................From Date-To Date End....................

                                }
                                else
                                {
                                    if(isset($phd->effective_from_date) && isset($phd->effective_to_date))
                                    {
                                        $v_from_date = Carbon::parse($phd->effective_from_date);
                                        $v_to_date = Carbon::parse($phd->effective_to_date);
                                        $date_diff = $v_from_date->diffInDays($v_to_date);
                                        if($date_diff<$month_last_date->day && $v_from_date->month==$v_to_date->month)
                                        {
                                            //.............same month from date-to date.......
                                            $pspd_from_date=$phd->effective_from_date;
                                            $pspd_to_date=$phd->effective_to_date;
                                        }
                                        else if($date_diff<$month_last_date->day && $v_from_date->month<$v_to_date->month)
                                        {
                                            if($c_salary_date->month==$v_from_date->month)
                                            {
                                                $pspd_from_date=$phd->effective_from_date;
                                                $pspd_to_date=$c_salary_date->endOfMonth();
                                            }
                                            else
                                            {
                                                $pspd_from_date=$salary_date;
                                                $pspd_to_date=$phd->effective_to_date;
                                            }
                                        }
                                   }
                                   else if(isset($phd->effective_from_date))
                                   {
                                        $v_from_date = Carbon::parse($phd->effective_from_date);
                                        $date_diff = $v_from_date->diffInDays($c_salary_date);
                                        if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
                                        {
                                            $pspd_from_date=$phd->effective_from_date;
                                            $pspd_to_date=$c_salary_date->endOfMonth();
                                        }
                                        else
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$c_salary_date->endOfMonth();
                                        }
                                   }
                                   else if(isset($phd->effective_to_date))
                                   {
                                        $v_to_date = Carbon::parse($phd->effective_to_date);
                                        $date_diff = $v_to_date->diffInDays($c_salary_date);
                                        if($date_diff<$month_last_date->day && $c_salary_date->month==$v_from_date->month)
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$phd->effective_to_date;
                                        }
                                        else
                                        {
                                            $pspd_from_date=$salary_date;
                                            $pspd_to_date=$c_salary_date->endOfMonth();
                                        }
                                   }
                                   else
                                   {

                                        $pspd_from_date=$salary_date;
                                        $pspd_to_date=$c_salary_date->endOfMonth();
                                   }
                                }
                                
                           }
                        //.....allowance date or deduction date calculation end ....



                        if($phd->payroll_type==1)
                        //..........................Allowance Start............................................... 
                        {
                           
                           $payroll_salary_process_detail->allowance_id=$phd->payroll_allowance_id; 
                           $process_type=$phd->payroll_type;
                           
                           //.....allowance amount calculation start....
                            $v_ammount_from_date = Carbon::parse($pspd_from_date);
                            $v_ammount_to_date = Carbon::parse($pspd_to_date);
                            $date_diff = $v_ammount_to_date->diffInDays($v_ammount_from_date);
                            $amount_date_diff=$date_diff+1;
                            switch ($phd->allowance_time_interval) {
                               case '1':
                                //for monthly
                                    if($amount_date_diff==$month_last_date->day)
                                    {
                                        $day=1;
                                    }
                                    else
                                    {
                                        $day=$amount_date_diff/$month_last_date->day;
                                    }
                                   
                                   break;
                                case '2':
                                //for daily
                                   //$day=$month_last_date->day;
                                   $day=$amount_date_diff;
                                   break;   
                                case '3':
                                //for weekly
                                    if($amount_date_diff>20)
                                    {
                                        $day=4;
                                    }
                                    elseif ($amount_date_diff>13 && $amount_date_diff<21) {
                                        $day=3;
                                    }
                                    elseif ($amount_date_diff>6 && $amount_date_diff<14) {
                                        $day=2;
                                    }
                                    else
                                    {
                                        $day=1;   
                                    }
                                   
                                   break; 
                               default:
                                   $day=1;
                                   break;
                           }

                           
                           if($phd->allowance_type==1)
                           {
                                //fixed
                                $v_allowance_amount=$phd->allowance_amount*$day;
                           }
                           else if($phd->allowance_type==2)
                           {
                                //percentage
                                if($phd->allowance_salary_head_id==1)
                                {
                                    $v_basic=$v_pay_scale_amount;
                                    $percentage_amount=($v_basic*$phd->allowance_amount)/100;
                                    //$v_allowance_amount=$percentage_amount*$day;
                                    //$v_allowance_amount=$percentage_amount;

                                    $basic_date_diff = $v_basic_to_date->diffInDays($v_basic_from_date);
                                    if($basic_date_diff==$date_diff)
                                    {
                                        $v_allowance_amount=$percentage_amount;
                                    }
                                    else
                                    {
                                        $v_allowance_amount=$percentage_amount*$day;
                                    }

                                }
                                else
                                {
                                    $main_info=DB::SELECT("SELECT pspd.amount
                                    FROM `payroll_allowances` pa
                                    inner join payroll_salary_process_details pspd on(pspd.id=pa.allowance_id)
                                    WHERE pa.`payroll_head_id`=$phd->allowance_salary_head_id
                                    and pa.`deleted_at` is null
                                    and pspd.`deleted_at` is null")[0];
                                    $v_main=$main_info->amount;
                                    $percentage_amount=($v_main*$phd->allowance_amount)/100;
                                    //$v_allowance_amount=$percentage_amount*$day;
                                    //$v_allowance_amount=$percentage_amount;

                                    $basic_date_diff = $v_basic_to_date->diffInDays($v_basic_from_date);
                                    if($basic_date_diff==$date_diff)
                                    {
                                        $v_allowance_amount=$percentage_amount;
                                    }
                                    else
                                    {
                                        $v_allowance_amount=$percentage_amount*$day;
                                    }

                                }
                           }
                           

                           if($v_allowance_amount>=$phd->allowance_max_amount && $phd->allowance_max_amount>0)
                           {
                                $v_allowance_amount=$phd->allowance_max_amount;
                           }

                           if($v_allowance_amount<=$phd->allowance_max_amount && $phd->allowance_min_amount>0)
                           {
                                $v_allowance_amount=$phd->allowance_min_amount;
                           }

                           //.....allowance amount calculation start....
                           $pspd_amount=$v_allowance_amount;
                        }
                        //..........................Allowance End............................................... 
                        else if($phd->payroll_type==2)
                        //.....................................Deduction Start.......................................
                        {
                            
                            $payroll_salary_process_detail->deduction_id=$phd->payroll_deduction_id; 
                            $process_type=$phd->payroll_type;

                            //.....deduction amount calculation start....
                            $v_ammount_from_date = Carbon::parse($pspd_from_date);
                            $v_ammount_to_date = Carbon::parse($pspd_to_date);
                            $date_diff = $v_ammount_to_date->diffInDays($v_ammount_from_date);
                            $amount_date_diff=$date_diff+1;
                            switch ($phd->deduction_time_interval) {
                               case '1':
                                //for monthly
                                    if($amount_date_diff==$month_last_date->day)
                                    {
                                        $day=1;
                                    }
                                    else
                                    {
                                        $day=$amount_date_diff/$month_last_date->day;
                                    }
                                   
                                   break;
                                case '2':
                                //for daily
                                   //$day=$month_last_date->day;
                                   $day=$amount_date_diff;
                                   break;   
                                case '3':
                                //for weekly
                                    if($amount_date_diff>20)
                                    {
                                        $day=4;
                                    }
                                    elseif ($amount_date_diff>13 && $amount_date_diff<21) {
                                        $day=3;
                                    }
                                    elseif ($amount_date_diff>6 && $amount_date_diff<14) {
                                        $day=2;
                                    }
                                    else
                                    {
                                        $day=1;   
                                    }
                                   
                                   break; 
                               default:
                                   $day=1;
                                   break;
                           }

                           
                           if($phd->deduction_type==1)
                           {
                                //fixed
                                $v_deduction_amount=$phd->deduction_amount*$day;
                           }
                           else if($phd->deduction_type==2)
                           {
                                //percentage
                                //if($phd->deduction_salary_head_id==1)
                                if($phd->deduction_salary_head_id==0)
                                {
                                    $v_basic=$v_pay_scale_amount;
                                    $percentage_amount=($v_basic*$phd->deduction_amount)/100;
                                    //$v_deduction_amount=$percentage_amount*$day;
                                    //$v_deduction_amount=$percentage_amount;

                                   
                                    $basic_date_diff = $v_basic_to_date->diffInDays($v_basic_from_date);
                                    if($basic_date_diff==$date_diff)
                                    {
                                        $v_deduction_amount=$percentage_amount;
                                    }
                                    else
                                    {
                                        $v_deduction_amount=$percentage_amount*$day;
                                    }


                                }
                                else
                                {
                                    $main_info=DB::SELECT("SELECT pspd.amount
                                    FROM payroll_salary_process_details pspd
                                    WHERE pspd.`allowance_id`=$phd->deduction_salary_head_id
                                    and pspd.`deleted_at` is null")[0];

                                    // $main_info=DB::SELECT("SELECT pspd.amount
                                    // FROM `payroll_deductions` pd
                                    // inner join payroll_salary_process_details pspd on(pd.id=pspd.deduction_id)
                                    // WHERE pd.`payroll_head_id`=$phd->deduction_salary_head_id
                                    // and pd.`deleted_at` is null
                                    // and pspd.`deleted_at` is null")[0];
                                    
                                    $v_main=$main_info->amount;
                                    $percentage_amount=($v_main*$phd->deduction_amount)/100;
                                    //$v_deduction_amount=$percentage_amount*$day;
                                    //$v_deduction_amount=$percentage_amount;

                                    $basic_date_diff = $v_basic_to_date->diffInDays($v_basic_from_date);
                                    if($basic_date_diff==$date_diff)
                                    {
                                        $v_deduction_amount=$percentage_amount;
                                    }
                                    else
                                    {
                                        $v_deduction_amount=$percentage_amount*$day;
                                    }

                                }
                           }
                           

                           if($v_deduction_amount>=$phd->deduction_max_amount && $phd->deduction_max_amount>0)
                           {
                                $v_deduction_amount=$phd->deduction_max_amount;
                           }

                           if($v_deduction_amount<=$phd->deduction_max_amount && $phd->deduction_min_amount>0)
                           {
                                $v_deduction_amount=$phd->deduction_min_amount;
                           }
                           //.....Deduction amount calculation end....
                           $pspd_amount=$v_deduction_amount;
                           //echo $v_deduction_amount;die();
                        }
                        //.....................................Deduction End.......................................
                        $payroll_salary_process_detail->process_type=$process_type;


                        $payroll_salary_process_detail->from_date=$pspd_from_date;
                        $payroll_salary_process_detail->to_date=$pspd_to_date;
                        $payroll_salary_process_detail->amount=$pspd_amount;
                        $payroll_salary_process_detail->save();

                   

                        
                    }
                    //................allowance/deduction entry in payroll_salary_process_details start.........

                }
                //.......multiple pay scale against 1 employee end.....

                /*******************************payroll_salary_process_details table End ***************************/

                $this->salary_amount_update($v_payroll_salary_process_id);


            }
            //...........all employee process end...........
            return redirect()->route(config('laraadmin.adminRoute') . '.salary_process.index');
        }
        else
        {
            return View('error');
        }
    }
    public function update(Request $request, $id)
    {
        if(Menu::hasAccess("Payroll_Hrm", "edit")) 
        {
            

        }
        else
        {
            return View('error');
        }
    }
    
    public function destroy($id){
        if(Menu::hasAccess("Payroll_Hrm", "delete")) {
            $payroll_hrm_detail_all=Payroll_Hrm_Detail::where('payroll_hrm_id',$id)->get();
            foreach ($payroll_hrm_detail_all as $key => $value) {
                Payroll_Hrm_Detail::find($value->id)->delete();
            }

            $payroll_hrm = Payroll_Hrm::find($id);
            $payroll_hrm->delete();

            return redirect()->route(config('laraadmin.adminRoute') . '.payroll_hrm.index');
        }else{
            return View('error');
        }
    }

    public function show($id)
    {
        $config=[
          'mode'=>'bn',
          'default_font_size' => '12',
          'default_font' => 'solaimanlipi',
        ];
        $salary_emp_info = Payroll_Salary_Process::pay_scale_salary_process_info($id); 
        $earnings = Payroll_Salary_Process::earnings($id);
        $deductions= Payroll_Salary_Process::deductions($id);
        $data=[
        'salary_emp_info'=>$salary_emp_info,
        'earnings'=>$earnings,
        'deductions'=>$deductions
        ];
        $mergeData=[];
        $pdf = PDF::loadView('payroll.salary_process.pay_slip',$data,$mergeData,$config);
        return $pdf->stream('pay_slip_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function salary_amount_update($id)
    {
        $v_earning_amount=DB::SELECT("SELECT sum(a.`amount`) as earning_amount
        from
        (
        SELECT pspd.*
        FROM `payroll_salary_process_details` pspd
        WHERE pspd.`salary_process_id`='$id'
        ) a
        where a.`process_type`='1' or a.`process_type`='3'")[0];

        $v_deduction_amount=DB::SELECT("SELECT sum(pspd.`amount`) as deduction_amount
        FROM `payroll_salary_process_details` pspd
        WHERE pspd.`salary_process_id`='$id'
        and pspd.`process_type`='2'")[0];

        $salary=$v_earning_amount->earning_amount-$v_deduction_amount->deduction_amount;

        $payroll_salary_process=Payroll_Salary_Process::find($id);
        $payroll_salary_process->salary_amount=$salary;
        $payroll_salary_process->save();

    }

}