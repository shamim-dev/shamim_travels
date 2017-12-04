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

use App\Models\Payroll_Hrm;
use App\Models\Payroll_Hrm_Detail;
use App\Models\Employee_Info;
use App\Models\Payroll_Pay_Scale;
use App\Models\Payroll_Allowance;
use App\Models\Payroll_Deduction;
class Payroll_HrmController extends Controller
{
    public $show_action = true;
    
    public function __construct()
    {
        $this->menu_id = Menu::get('Payroll_Hrm');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $list_values = Payroll_Hrm::dtList();
            return View('payroll.payroll_hrm.index', [
                'show_actions' => $this->show_action,
                'values'=>$list_values,
            ]);
        } else {
            return View('error');
        }
    }
    public function create()
    {
        $employees=Employee_Info::dropdown_rab_employee();
        $payroll_pay_scales=Payroll_Pay_Scale::all();
        $payroll_allowances=Payroll_Allowance::all();
        $payroll_deductions=Payroll_Deduction::all();

        return View('payroll.payroll_hrm.add_form',[
            'employees'=>$employees,
            'payroll_pay_scales'=>$payroll_pay_scales,
            'payroll_allowances'=>$payroll_allowances,
            'payroll_deductions'=>$payroll_deductions,
            ]);
    }
    public function edit($id)
    {
        $employees=Employee_Info::dropdown_rab_employee();
        $payroll_pay_scales=Payroll_Pay_Scale::all();
        $payroll_allowances=Payroll_Allowance::all();
        $payroll_deductions=Payroll_Deduction::all();

        $payroll_hrm=Payroll_Hrm::find($id);
        $payroll_hrm_details=Payroll_Hrm_Detail::payroll_hrm_detail_infos($id);
        //print_r($payroll_policy_details);die();

        return View('payroll.payroll_hrm.edit_form',[
            'employees'=>$employees,
            'payroll_pay_scales'=>$payroll_pay_scales,
            'payroll_allowances'=>$payroll_allowances,
            'payroll_deductions'=>$payroll_deductions,
            'payroll_hrm'=>$payroll_hrm,
            'payroll_hrm_details'=>$payroll_hrm_details,
            ]);
    }
    public function store(Request $request){
        if(Menu::hasAccess("Payroll_Hrm", "create")) 
        {     
            $v_posting_rec_id=Session::get('posting_rec_id');

            $payroll_types=$request->payroll_type;
            $payroll_allowances=$request->payroll_allowance_id;
            $payroll_deductions=$request->payroll_deduction_id;


            //............check unique start...........
            $payroll_allowances_entry=array_filter($payroll_allowances, 'strlen');
            $payroll_allowances_unique=array_unique($payroll_allowances_entry);
            if(count($payroll_allowances_entry)>count($payroll_allowances_unique))
            {
                return redirect()->back()->withErrors(Lang::get('messages.Allowances are unique'));
            }

            $payroll_deductions_entry=array_filter($payroll_deductions, 'strlen');
            $payroll_deductions_unique=array_unique($payroll_deductions_entry);
            if(count($payroll_deductions_entry)>count($payroll_deductions_unique))
            {
                return redirect()->back()->withErrors(Lang::get('messages.Deductions are unique'));
            }  
            //............check unique end...........
            
            foreach ($payroll_types as $key => $payroll_type) {
                if($payroll_type==1)
                {
                    //....allowance
                    if(empty($payroll_allowances[$key]))
                    {
                        return redirect()->back()->withErrors(Lang::get('messages.All allowance are required'));
                    }
                    //$allowance_key++;
                }
                else
                {
                    //....deductions
                    //$payroll_deductions[$deduction_key];
                    if(empty($payroll_deductions[$key]))
                    {
                        return redirect()->back()->withErrors(Lang::get('messages.All deductions are required'));
                    }

                }
            }
            // $messsages = array(
            //     'emp_id.unique'=>Lang::get('messages.This Rab is already assigned to this Pay Scale')
            // );
            //$table_name,$unique_field,$dependent_field,$dependent_input,$edit_field,$edit_id=null
            // $rules = array(
            //     'emp_id' => CommonHelper::twoFieldUniqueValidation('payroll_hrm','emp_id','pay_scale_id','pay_scale_id','id'),
            // );
            
            // $validator = Validator::make($request->all(), $rules,$messsages);
            // if ($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }

            $employees=$request->emp_id;
           
            foreach ($employees as $key => $employee) {
                $v_effective_date=CommonHelper::databseDateFormat($request->effective_date);
                $payroll_hrm_info=Payroll_Hrm::where('emp_id',$employee)
                ->where('pay_scale_id',$request->pay_scale_id)
                ->where('basic_salary',$request->basic_salary)
                ->first();
                if(empty($payroll_hrm_info))
                {
                    
                    //..............prev status update start...........
                    $payroll_hrm_info_prev=Payroll_Hrm::where('emp_id',$employee)
                    ->where('payroll_hrm_status',1)
                    ->whereDate('effective_date','<',$v_effective_date)
                    ->first();
                    //print_r($payroll_hrm_info);die();
                    if(!empty($payroll_hrm_info_prev))
                    {
                        $v_end_date = Carbon::parse($v_effective_date)->subDays(1);

                        $payroll_hrm_prev=Payroll_Hrm::find($payroll_hrm_info_prev->id);
                        $payroll_hrm_prev->payroll_hrm_status=0;
                        $payroll_hrm_prev->end_date=$v_end_date;
                        $payroll_hrm_prev->save();
                    }
                    //..............prev status update end...........



                    $payroll_hrm=new Payroll_Hrm;
                }
                else
                {
                    $payroll_hrm=Payroll_Hrm::find($payroll_hrm_info->id);
                }
                
                $payroll_hrm->emp_id=$employee; 
                $payroll_hrm->pay_scale_id=$request->pay_scale_id; 
                $payroll_hrm->basic_salary=$request->basic_salary; 
                $payroll_hrm->effective_date=$request->effective_date ? CommonHelper::databseDateFormat($request->effective_date) : Null;

                //..............next status update start...........
                $payroll_hrm_info_next=Payroll_Hrm::where('emp_id',$employee)
                ->whereDate('effective_date','>',$v_effective_date)
                ->orderBY('effective_date','asc')
                ->first();
                if(!empty($payroll_hrm_info_next))
                {
                    $v_end_date = Carbon::parse($payroll_hrm_info_next->effective_date)->subDays(1);
                    $payroll_hrm->payroll_hrm_status=0;
                    $payroll_hrm->end_date=$request->end_date ? CommonHelper::databseDateFormat($request->end_date) : $v_end_date;
                }
                else
                {
                    $payroll_hrm->end_date=$request->end_date ? CommonHelper::databseDateFormat($request->end_date) : Null;
                }
                //..............next status update end...........
                



                $payroll_hrm->created_by=$v_posting_rec_id; 
                $payroll_hrm->save();

                $payrollHrmId= $payroll_hrm->id;

                
               
                //.................delete start.............
                $payroll_hrm_detail_all=Payroll_Hrm_Detail::where('payroll_hrm_id',$payrollHrmId)->get();
                if(!empty($payroll_hrm_detail_all))
                {
                    foreach ($payroll_hrm_detail_all as $key => $value) {
                        $v_delete=0;
                        foreach ($request->payroll_allowance_id as $payroll_allowance_id)
                        {
                            if($payroll_allowance_id>0)
                            {
                                if($value->payroll_allowance_id==$payroll_allowance_id)
                                {
                                    $v_delete=1;
                                }
                            }
                            
                        }
                        foreach ($request->payroll_deduction_id as $payroll_deduction_id)
                        {
                            if($payroll_deduction_id>0)
                            {
                                if($value->payroll_deduction_id==$payroll_deduction_id)
                                {
                                    $v_delete=1;
                                }
                            }
                            
                        }
                        if($v_delete==0)
                        {
                            Payroll_Hrm_Detail::find($value->id)->delete();
                        }
                    }
                }
                //.................delete done.............

                $effective_from_date=$request->effective_from_date;
                $effective_to_date=$request->effective_to_date;
                $status=$request->status;
                $i=0;
                foreach ($payroll_types as $payroll_type) {
                    if($payroll_type==1)
                    {
                        //.....allowance.....
                        $payroll_hrm_info=Payroll_Hrm_Detail::where('payroll_hrm_id',$payrollHrmId)
                        ->where('payroll_allowance_id',$payroll_allowances[$i])
                        ->first();
                    }
                    else
                    {
                        //.....Deduction.....
                        $payroll_hrm_info=Payroll_Hrm_Detail::where('payroll_hrm_id',$payrollHrmId)
                        ->where('payroll_deduction_id',$payroll_deductions[$i])
                        ->first();
                    }

                    if(empty($payroll_hrm_info))
                    {
                       $payroll_hrm_detail=new Payroll_Hrm_Detail;
                    }    
                    else
                    {
                        $payroll_hrm_detail=Payroll_Hrm_Detail::find($payroll_hrm_info->id); 
                    }

                    $payroll_hrm_detail->payroll_hrm_id=$payrollHrmId;
                    $payroll_hrm_detail->payroll_type=$payroll_type;
                    $payroll_hrm_detail->status=$status[$i];
                    if($payroll_type==1)
                    {
                        //....allowance
                        $payroll_hrm_detail->payroll_allowance_id=$payroll_allowances[$i];
                    }
                    else
                    {
                        //....deductions
                        $payroll_hrm_detail->payroll_deduction_id=$payroll_deductions[$i];
                    }
                    if(!empty($effective_from_date[$i]))
                    {
                        $payroll_hrm_detail->effective_from_date=CommonHelper::databseDateFormat($effective_from_date[$i]);
                    }
                    if(!empty($effective_to_date[$i]))
                    {
                        $payroll_hrm_detail->effective_to_date=CommonHelper::databseDateFormat($effective_to_date[$i]);
                    }
                    
                    $payroll_hrm_detail->save();
                    $i++;
                }
            }

            return redirect()->route(config('laraadmin.adminRoute') . '.payroll_hrm.index');

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

            $v_posting_rec_id=Session::get('posting_rec_id');

            $payroll_types=$request->payroll_type;
            $payroll_allowances=$request->payroll_allowance_id;
            $payroll_deductions=$request->payroll_deduction_id;

            //............check unique start...........
            $payroll_allowances_entry=array_filter($payroll_allowances, 'strlen');
            $payroll_allowances_unique=array_unique($payroll_allowances_entry);
            if(count($payroll_allowances_entry)>count($payroll_allowances_unique))
            {
                return redirect()->back()->withErrors(Lang::get('messages.Allowances are unique'));
            }

            $payroll_deductions_entry=array_filter($payroll_deductions, 'strlen');
            //print_r($payroll_deductions_entry);die();

            $payroll_deductions_unique=array_unique($payroll_deductions_entry);
            // echo count($payroll_deductions_entry).'<br>';
            // echo count($payroll_deductions_unique).'<br>';
            // die();
            if(count($payroll_deductions_entry)>count($payroll_deductions_unique))
            {
                return redirect()->back()->withErrors(Lang::get('messages.Deductions are unique'));
            }  
            //............check unique end...........  
            
            foreach ($payroll_types as $key => $payroll_type) {
                if($payroll_type==1)
                {
                    //....allowance
                    if(empty($payroll_allowances[$key]))
                    {
                        return redirect()->back()->withErrors(Lang::get('messages.All allowance are required'));
                    }
                }
                else
                {
                    //....deductions
                    if(empty($payroll_deductions[$key]))
                    {
                        return redirect()->back()->withErrors(Lang::get('messages.All deductions are required'));
                    }

                }
            }

            // $messsages = array(
            //     'emp_id.unique'=>Lang::get('messages.This Rab is already assigned to this Pay Scale')
            // );
            //$table_name,$unique_field,$dependent_field,$dependent_input,$edit_field,$edit_id=null
            // $rules = array(
            //     'emp_id' => CommonHelper::twoFieldUniqueValidation('payroll_hrm','emp_id','pay_scale_id','pay_scale_id','id',$id),
            // );
            
            // $validator = Validator::make($request->all(), $rules,$messsages);
            // if ($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }
           //print_r($request->payroll_allowance_id);die();
            //.................delete start.............
            $payroll_hrm_detail_all=Payroll_Hrm_Detail::where('payroll_hrm_id',$id)->get();
            foreach ($payroll_hrm_detail_all as $key => $value) {
                $v_delete=0;
                foreach ($request->payroll_allowance_id as $payroll_allowance_id)
                {
                    if($payroll_allowance_id>0)
                    {
                        if($value->payroll_allowance_id==$payroll_allowance_id)
                        {
                            $v_delete=1;
                        }
                    }
                    
                }
                foreach ($request->payroll_deduction_id as $payroll_deduction_id)
                {
                    if($payroll_deduction_id>0)
                    {
                        if($value->payroll_deduction_id==$payroll_deduction_id)
                        {
                            $v_delete=1;
                        }
                    }
                    
                }
                if($v_delete==0)
                {
                    Payroll_Hrm_Detail::find($value->id)->delete();
                }
            }
            //.................delete done.............


            //..............prev status update start...........
            $v_effective_date=CommonHelper::databseDateFormat($request->effective_date);
            $payroll_hrm_info=Payroll_Hrm::where('emp_id',$request->emp_id)
            ->where('payroll_hrm_status',1)
            ->whereDate('effective_date','<',$v_effective_date)
            ->first();
            if(!empty($payroll_hrm_info))
            {
                $v_end_date = Carbon::parse($v_effective_date)->subDays(1);
                if($payroll_hrm_info->id!=$id)
                {
                    $payroll_hrm=Payroll_Hrm::find($payroll_hrm_info->id);
                    $payroll_hrm->payroll_hrm_status=0;
                    if(!isset($payroll_hrm_info->end_date))
                    {
                        $payroll_hrm->end_date=$v_end_date;
                    }
                    
                    $payroll_hrm->save();
                }
                
            }
            //..............prev status update end...........

            $payroll_hrm=Payroll_Hrm::find($id);
            $payroll_hrm->emp_id=$request->emp_id; 
            $payroll_hrm->pay_scale_id=$request->pay_scale_id; 
            $payroll_hrm->basic_salary=$request->basic_salary; 
            $payroll_hrm->effective_date=$request->effective_date ? CommonHelper::databseDateFormat($request->effective_date) : Null;
            $payroll_hrm->end_date=$request->end_date ? CommonHelper::databseDateFormat($request->end_date) : Null;  
            //..............next status update start...........
            //echo $v_effective_date;die();
            // $payroll_hrm_info_next=Payroll_Hrm::where('emp_id',$request->emp_id)
            // ->whereDate('effective_date','>','2017-10-11')
            // ->orderBY('effective_date','asc')
            // ->first();
            // print_r($payroll_hrm_info_next);die();
            // if(!empty($payroll_hrm_info_next))
            // {
            //     $v_end_date = Carbon::parse($payroll_hrm_info_next->effective_date)->subDays(1);
            //     $payroll_hrm->payroll_hrm_status=0;
            //     $payroll_hrm->end_date=$request->end_date ? CommonHelper::databseDateFormat($request->end_date) : $v_end_date;
            // }
            // else
            // {
            //     $payroll_hrm->end_date=$request->end_date ? CommonHelper::databseDateFormat($request->end_date) : Null;
            // }
            //..............next status update end...........



            $payroll_hrm->updated_by=$v_posting_rec_id; 
            $payroll_hrm->save();

            $payrollHrmId= $payroll_hrm->id;

            $effective_from_date=$request->effective_from_date;
            $effective_to_date=$request->effective_to_date;
            $status=$request->status;
            $i=0;
            foreach ($payroll_types as $payroll_type) {

                if($payroll_type==1)
                {
                    //.....allowance.....
                    $payroll_hrm_info=Payroll_Hrm_Detail::where('payroll_hrm_id',$payrollHrmId)
                    ->where('payroll_allowance_id',$payroll_allowances[$i])
                    ->first();
                }
                else
                {
                    //.....Deduction.....
                    $payroll_hrm_info=Payroll_Hrm_Detail::where('payroll_hrm_id',$payrollHrmId)
                    ->where('payroll_deduction_id',$payroll_deductions[$i])
                    ->first();
                }

                if(empty($payroll_hrm_info))
                {
                   $payroll_hrm_detail=new Payroll_Hrm_Detail;
                }    
                else
                {
                    $payroll_hrm_detail=Payroll_Hrm_Detail::find($payroll_hrm_info->id); 
                }
                $payroll_hrm_detail->payroll_hrm_id=$payrollHrmId;
                $payroll_hrm_detail->status=$status[$i];
                $payroll_hrm_detail->payroll_type=$payroll_type;
                if($payroll_type==1)
                {
                    //....allowance
                    $payroll_hrm_detail->payroll_allowance_id=$payroll_allowances[$i];
                }
                else
                {
                    //....deductions
                    $payroll_hrm_detail->payroll_deduction_id=$payroll_deductions[$i];
                }
                if(!empty($effective_from_date[$i]))
                {
                    $payroll_hrm_detail->effective_from_date=CommonHelper::databseDateFormat($effective_from_date[$i]);
                }
                if(!empty($effective_to_date[$i]))
                {
                    $payroll_hrm_detail->effective_to_date=CommonHelper::databseDateFormat($effective_to_date[$i]);
                }
                
                $payroll_hrm_detail->save();
                $i++;
            }


            return redirect()->route(config('laraadmin.adminRoute') . '.payroll_hrm.index');

        }
        else
        {
            return View('error');
        }
    }
    
    public function destroy($id){
        if(Menu::hasAccess("Payroll_Hrm", "delete")) {
            //..............prev status update start...........
            //echo $id;die();
            $payroll_hrm = Payroll_Hrm::find($id);
            $dt = Carbon::parse($payroll_hrm->effective_date)->subDays(1);
            $v_end_date=$dt->toDateString();
            $payroll_hrm_info=Payroll_Hrm::where('emp_id',$payroll_hrm->emp_id)
            ->where('payroll_hrm_status',0)
            ->whereDate('effective_date','<',$v_end_date)
            ->first();
            //print_r($payroll_hrm_info);die();
            if(!empty($payroll_hrm_info))
            {
                $payroll_hrm=Payroll_Hrm::find($payroll_hrm_info->id);
                $payroll_hrm->payroll_hrm_status=1;
                $payroll_hrm->end_date=Null;
                $payroll_hrm->save();
            }
            //..............prev status update end...........

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

    public function payroll_allowance_rule(Request $request)
    {
        $payroll_allowance_id=$request->payroll_allowance_id;
        //echo $payroll_allowance_id;die();
        $v_result=DB::SELECT("SELECT pa.*,ph.name as payroll_head_name,phs.name as salary_head_name,
        case
        when pa.`type`='1' then 'Fixed'
        when pa.`type`='2' then 'Percentage'
        end as payroll_allowance_type,
        case
        when pa.`time_interval`='1' then 'Monthly'
        when pa.`time_interval`='2' then 'Daily'
        when pa.`time_interval`='3' then 'Weekly'
        when pa.`time_interval`='4' then 'Quarterly'
        end as payroll_allowance_interval

        FROM `payroll_allowances` pa
        inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
        left join  payroll_heads phs on(phs.id=pa.`salary_head_id`)
        WHERE pa.`deleted_at` is null
        and pa.id='$payroll_allowance_id'
        ");
        if(!empty($v_result))
        {
            $result=$v_result[0];
            return Response::json($result);
        }
    }
    public function payroll_deduction_rule(Request $request)
    {
        $payroll_deduction_id=$request->payroll_deduction_id;
        $v_result=DB::SELECT("SELECT pa.*,ph.name as payroll_head_name,phs.allowance_name as salary_head_name,
        case
        when pa.`type`='1' then 'Fixed'
        when pa.`type`='2' then 'Percentage'
        end as payroll_deduction_type,
        case
        when pa.`time_interval`='1' then 'Monthly'
        when pa.`time_interval`='2' then 'Daily'
        when pa.`time_interval`='3' then 'Weekly'
        when pa.`time_interval`='4' then 'Quarterly'
        end as payroll_deduction_interval

        FROM `payroll_deductions` pa
        inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
        left join  payroll_allowances phs on(phs.id=pa.`salary_head_id`)
        WHERE pa.`deleted_at` is null
        and pa.id='$payroll_deduction_id'
        ");
        if(!empty($v_result))
        {
            $result=$v_result[0];
            return Response::json($result);
        }
    }

}