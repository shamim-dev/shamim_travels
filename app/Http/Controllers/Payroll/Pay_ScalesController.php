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

use App\Models\Payroll_Pay_Scale;
use App\Models\Payroll_Pay_Scale_Detail;


class Pay_ScalesController extends Controller
{
    public $show_action = true;
    
    public function __construct()
    {
        $this->menu_id = Menu::get('Pay_Scales');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            //echo 'munna';die();
            $list_values = Payroll_Pay_Scale::payroll_pay_scale_list();
            return View('payroll.pay_scales.index', [
                'show_actions' => $this->show_action,
                'values'=>$list_values,
            ]);
        } else {
            return View('error');
        }
    }
    public function create()
    {
        return View('payroll.pay_scales.add_form',[]);
    }
    public function edit($id)
    {
        $payroll_pay_scale=Payroll_Pay_Scale::find($id);
        $payroll_pay_scale_details=Payroll_Pay_Scale_Detail::payroll_pay_scale_detail($id);
        return View('payroll.pay_scales.edit_form',[
            'payroll_pay_scale'=>$payroll_pay_scale,
            'payroll_pay_scale_details'=>$payroll_pay_scale_details
            ]);
    }
    public function store(Request $request){
        if(Menu::hasAccess("Pay_Scales", "create")) 
        {       
            $messsages = array(
                'amount.0.required'=>Lang::get('messages.Please Enter at least one pay scale')
            );
            
            $rules = array(
                'pay_scale_name'=> 'required|unique:payroll_pay_scales,pay_scale_name,NULL,id,deleted_at,NULL',
            );
            
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //.............total qty validation check start..............
            foreach ($request->amount as $key => $value) {
                if($value==0){
                    return redirect()->back()->withErrors(Lang::get('messages.All pay scales amount must be greater than 0'));
                }
            }
            //.............total qty validation check end..............

            $payroll_pay_scale=new Payroll_Pay_Scale;
            $payroll_pay_scale->pay_scale_name=$request->pay_scale_name; 
            $payroll_pay_scale->save();

            $payrollPayScaleId=$payroll_pay_scale->id;

            $amount=$request->amount;

            $i=0;
            foreach ($request->pay_scale_year as $value) 
            {   
                $payroll_pay_scale_detail=new Payroll_Pay_Scale_Detail;
                $payroll_pay_scale_detail->pay_scale_id=$payrollPayScaleId;
                $payroll_pay_scale_detail->pay_scale_year=$value;
                $payroll_pay_scale_detail->pay_scale_amount=$amount[$i];
                
                $payroll_pay_scale_detail->save();

                $i++;

            }

            return redirect()->route(config('laraadmin.adminRoute') . '.payroll.pay_scales.index');

        }
        else
        {
            return View('error');
        }
    }
    public function update(Request $request, $id)
    {
        if(Menu::hasAccess("Pay_Scales", "edit")) 
        {
            $messsages = array(
                'amount.0.required'=>Lang::get('messages.Please Enter at least one pay scale')
            );
            
            $rules = array(
                'pay_scale_name'=> 'required|unique:payroll_pay_scales,pay_scale_name,'.$id.',id,deleted_at,NULL',
            );
            
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //.............total qty validation check start..............
            foreach ($request->amount as $key => $value) {
                if($value==0){
                    return redirect()->back()->withErrors(Lang::get('messages.All pay scales amount must be greater than 0'));
                }
            }
            //.............total qty validation check end..............

            //.........delete issue item start...........
            $payroll_pay_scale_detail_all=Payroll_Pay_Scale_Detail::where('pay_scale_id',$id)->get();
            foreach ($payroll_pay_scale_detail_all as $key => $value) {
                Payroll_Pay_Scale_Detail::find($value->id)->delete();
            }
            //.........delete issue item start...........

            $payroll_pay_scale=Payroll_Pay_Scale::find($id);
            $payroll_pay_scale->pay_scale_name=$request->pay_scale_name; 
            $payroll_pay_scale->save();

            $payrollPayScaleId=$payroll_pay_scale->id;

            $amount=$request->amount;

            $i=0;
            foreach ($request->pay_scale_year as $value) 
            {   
                $payroll_pay_scale_detail=new Payroll_Pay_Scale_Detail;
                $payroll_pay_scale_detail->pay_scale_id=$payrollPayScaleId;
                $payroll_pay_scale_detail->pay_scale_year=$value;
                $payroll_pay_scale_detail->pay_scale_amount=$amount[$i];
                
                $payroll_pay_scale_detail->save();

                $i++;

            }
            
            return redirect()->route(config('laraadmin.adminRoute') . '.payroll.pay_scales.index');
        }
        else
        {
            return View('error');
        }
    }
    
    public function destroy($id){
        if(Menu::hasAccess("Pay_Scales", "delete")) {
           $payroll_pay_scale_detail_all=Payroll_Pay_Scale_Detail::where('pay_scale_id',$id)->get();
            foreach ($payroll_pay_scale_detail_all as $key => $value) {
                Payroll_Pay_Scale_Detail::find($value->id)->delete();
            }

            $payroll_pay_scale=Payroll_Pay_Scale::find($id);
            $payroll_pay_scale->delete();

            return redirect()->route(config('laraadmin.adminRoute') . '.payroll.pay_scales.index');
        }else{
            return View('error');
        }
    }





}