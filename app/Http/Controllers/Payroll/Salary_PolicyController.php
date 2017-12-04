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

use App\Models\Payroll_Policy;
use App\Models\Payroll_Policy_Detail;
use App\Models\Payroll_Head;



class Salary_PolicyController extends Controller
{
    public $show_action = true;
    
    public function __construct()
    {
        $this->menu_id = Menu::get('Salary_Policy');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            
            $list_values = Payroll_Policy::dtList(1);
            return View('payroll.policy.salary_policy.index', [
                'show_actions' => $this->show_action,
                'values'=>$list_values,
            ]);
        } else {
            return View('error');
        }
    }
    public function create()
    {
        $payroll_heads=Payroll_Head::all();
        $salary_heads=Payroll_Head::salary_head_dropdown();
        return View('payroll.policy.salary_policy.add_form',[
            'payroll_heads'=>$payroll_heads,
            'salary_heads'=>$salary_heads
            ]);
    }
    public function edit($id)
    {
        //echo 'munna';die();
        $payroll_heads=Payroll_Head::all();
        $salary_heads=Payroll_Head::salary_head_dropdown();

        $payroll_policy=Payroll_Policy::find($id);
        $payroll_policy_details=Payroll_Policy_Detail::policy_detail($id);
        //print_r($payroll_policy_details);die();

        return View('payroll.policy.salary_policy.edit_form',[
            'payroll_heads'=>$payroll_heads,
            'salary_heads'=>$salary_heads,
            'payroll_policy'=>$payroll_policy,
            'payroll_policy_details'=>$payroll_policy_details
            ]);
    }
    public function store(Request $request){
        if(Menu::hasAccess("Salary_Policy", "create")) 
        {       

            $all_item_id=$request->payroll_head_id;
            $messsages = array(
                'payroll_head_id.0.required'=>Lang::get('messages.Please select at least one payroll head')
            );
            
            $rules = array(
                'policy_name'=> 'required|unique:payroll_policy,policy_name,NULL,id,deleted_at,NULL',
            );
            
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //..............item unique validation start.............
            $unique_item_id=array_unique($all_item_id);
            if(count($all_item_id)>count($unique_item_id))
            {
                return redirect()->back()->withErrors(Lang::get('messages.Payroll Heads are unique'));
            }
            //..............item unique validation end.............

            //.............total qty validation check start..............
            foreach ($request->amount as $key => $value) {
                if($value==0){
                    return redirect()->back()->withErrors(Lang::get('messages.All payroll heads amount must be greater than 0'));
                }
            }
            //.............total qty validation check end..............

            $payroll_policy=new Payroll_Policy;
            $payroll_policy->policy_type=$request->policy_type; 
            $payroll_policy->policy_name=$request->policy_name;   
            $payroll_policy->save();

            $payrollPolicyId= $payroll_policy->id;

            $type_id=$request->type_id;
            $salary_head_id=$request->salary_head_id;
            $amount=$request->amount;
            
            $i=0;
            foreach ($request->payroll_head_id as $value) 
            {   
                $payroll_policy_detail=new Payroll_Policy_Detail;
                $payroll_policy_detail->policy_id=$payrollPolicyId;
                $payroll_policy_detail->payroll_head=$value;
                $payroll_policy_detail->type=$type_id[$i];
                $payroll_policy_detail->amount=$amount[$i];

                if($type_id[$i]==2)
                {
                    if(empty($salary_head_id[$i]))
                    {
                        $payroll_policy_detail->salary_head=Null;
                    }
                    else
                    {
                        $payroll_policy_detail->salary_head=$salary_head_id[$i];
                    }
                }
                
                $payroll_policy_detail->save();

                $i++;

            }

            $this->salary_amount_process($payrollPolicyId);

            return redirect()->route(config('laraadmin.adminRoute') . '.payroll.salary_policy.index');

        }
        else
        {
            return View('error');
        }
    }
    public function update(Request $request, $id)
    {
        if(Menu::hasAccess("Salary_Policy", "edit")) 
        {
            $all_item_id=$request->payroll_head_id;
            $messsages = array(
                'payroll_head_id.0.required'=>Lang::get('messages.Please select at least one payroll head')
            );
            
            $rules = array(
                'policy_name'=> 'required|unique:payroll_policy,policy_name,'.$id.',id,deleted_at,NULL',
            );
            
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //..............item unique validation start.............
            $unique_item_id=array_unique($all_item_id);
            if(count($all_item_id)>count($unique_item_id))
            {
                return redirect()->back()->withErrors(Lang::get('messages.Payroll Heads are unique'));
            }
            //..............item unique validation end.............

            //.............total qty validation check start..............
            foreach ($request->amount as $key => $value) {
                if($value==0){
                    return redirect()->back()->withErrors(Lang::get('messages.All payroll heads amount must be greater than 0'));
                }
            }
            //.............total qty validation check end..............

            //.........delete issue item start...........
            $policy_detail_all=Payroll_Policy_Detail::where('policy_id',$id)->get();
            foreach ($policy_detail_all as $key => $value) {
                Payroll_Policy_Detail::find($value->id)->delete();
            }
            //.........delete issue item start...........

            $payroll_policy=Payroll_Policy::find($id);
            $payroll_policy->policy_type=$request->policy_type; 
            $payroll_policy->policy_name=$request->policy_name;   
            $payroll_policy->save();

            $payrollPolicyId= $payroll_policy->id;

            $type_id=$request->type_id;
            $salary_head_id=$request->salary_head_id;
            $amount=$request->amount;
            
            $i=0;
            foreach ($request->payroll_head_id as $value) 
            {   
                $payroll_policy_detail=new Payroll_Policy_Detail;
                $payroll_policy_detail->policy_id=$payrollPolicyId;
                $payroll_policy_detail->payroll_head=$value;
                $payroll_policy_detail->type=$type_id[$i];
                $payroll_policy_detail->amount=$amount[$i];

                if($type_id[$i]==2)
                {
                    if(empty($salary_head_id[$i]))
                    {
                        $payroll_policy_detail->salary_head=Null;
                    }
                    else
                    {
                        $payroll_policy_detail->salary_head=$salary_head_id[$i];
                    }
                }
                
                $payroll_policy_detail->save();

                $i++;

            }

            $this->salary_amount_process($payrollPolicyId);
            
            return redirect()->route(config('laraadmin.adminRoute') . '.payroll.salary_policy.index');
        }
        else
        {
            return View('error');
        }
    }
    
    public function destroy($id){
        if(Menu::hasAccess("Salary_Policy", "delete")) {
            $policy_detail_all=Payroll_Policy_Detail::where('policy_id',$id)->get();
            foreach ($policy_detail_all as $key => $value) {
                Payroll_Policy_Detail::find($value->id)->delete();
            }

            $payroll_policy = Payroll_Policy::find($id);
            $payroll_policy->delete();

            return redirect()->route(config('laraadmin.adminRoute') . '.payroll.salary_policy.index');
        }else{
            return View('error');
        }
    }


    public function salary_amount_process($p_policy_id)
    {
        $policy_details=DB::SELECT("SELECT * 
        FROM  `payroll_policy_details` ppd
        WHERE  ppd.`policy_id` ='$p_policy_id'
        and ppd.`deleted_at` is null
        order by ppd.`salary_head` asc");

        foreach ($policy_details as $policy_detail) {
            if($policy_detail->type=='1')
            {
                $payroll_policy_detail=Payroll_Policy_Detail::find($policy_detail->id);
                $payroll_policy_detail->salary_amount=$policy_detail->amount;
                $payroll_policy_detail->save();
            }
            else if($policy_detail->type=='2')
            {
                $tk=DB::SELECT("SELECT ppd.`salary_amount` 
                FROM `payroll_policy_details` ppd
                inner join payroll_policy_details ppd1 on(ppd1.salary_head=ppd.`payroll_head`)
                WHERE ppd.`policy_id`='$p_policy_id'
                and ppd.payroll_head='$policy_detail->salary_head'
                and ppd.`deleted_at` is null
                and ppd1.`deleted_at` is null")[0];
                $salary_amount=($tk->salary_amount*$policy_detail->amount)/100;

                $payroll_policy_detail=Payroll_Policy_Detail::find($policy_detail->id);
                $payroll_policy_detail->salary_amount=$salary_amount;
                $payroll_policy_detail->save();

            }
                
        }



    }


}