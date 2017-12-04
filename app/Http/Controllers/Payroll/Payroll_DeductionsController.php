<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\Menu;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Payroll_Deduction;
use App\Models\Payroll_Head;
use App\Models\Payroll_Allowance;

class Payroll_DeductionsController extends Controller
{
	public $show_action = true;
	
	public function __construct() {

	}
	
	/**
	 * Display a listing of the Payroll_Deductions.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if(Menu::hasAccess('Payroll_Deductions')) {
			//$salary_heads=Payroll_Head::salary_head_dropdown();
			//$salary_heads=Payroll_Allowance::all();
			$salary_heads=Payroll_Deduction::salary_heads();
			$payroll_heads=Payroll_Head::payroll_deduction_heads();
			$values=Payroll_Deduction::payroll_deduction_list();
			return View('payroll.payroll_deductions.index', [
				'show_actions' => $this->show_action,
				'salary_heads'=>$salary_heads,
				'payroll_heads'=>$payroll_heads,
				'values'=>$values
			]);
		} else {
			return View('error');
        }
	}

	/**
	 * Show the form for creating a new Payroll_Deduction.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created Payroll_Deduction in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Menu::hasAccess("Payroll_Deductions", "create")) {
		
			$rules = Module::validateRules("Payroll_Deductions", $request);
			$rules = array(
                'deduction_name' => 'required|max:100|unique:payroll_deductions,deduction_name,NULL,id,deleted_at,NULL',
                'payroll_head_id' => 'required',
                'deduction_amount' => 'required',
                'time_interval' => 'required',
                'type' => 'required',
            );
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			//$insert_id = Module::insert("Payroll_Deductions", $request);
			$payroll_deduction=new Payroll_Deduction;
			$payroll_deduction->deduction_name=$request->deduction_name;
			$payroll_deduction->type=$request->type;
			$payroll_deduction->payroll_head_id	=$request->payroll_head_id;
			if($request->type==2)
            {
            	//..........percentage......
                if(empty($request->salary_head_id) && $request->salary_head_id<0)
            	{
            		$payroll_deduction->salary_head_id=Null;
            	}
            	else
            	{
            		if($request->salary_head_id==0)
            		{
            			$salry_head=0;
            		}
            		else
            		{
            			$salry_head=$request->salary_head_id;
            		}
            		$payroll_deduction->salary_head_id=$salry_head;
            	}
            }
            else
            {
            	$payroll_deduction->salary_head_id=Null;
            }	
			$payroll_deduction->deduction_amount=$request->deduction_amount;

			if($request->type==2)
			{
				if($request->deduction_max_amount>0)
				{
					$payroll_deduction->deduction_max_amount=$request->deduction_max_amount;
				}
				else
				{
					$payroll_deduction->deduction_max_amount=0;
				}
				
				
				if($request->deduction_min_amount>0)
				{
					$payroll_deduction->deduction_min_amount=$request->deduction_min_amount;
				}
				else
				{
					$payroll_deduction->deduction_min_amount=0;
				}
			}
			else
			{
				$payroll_deduction->deduction_max_amount=0;
				$payroll_deduction->deduction_min_amount=0;
			}
			
			$payroll_deduction->time_interval=$request->time_interval;
			$payroll_deduction->save();
			
			return redirect()->route(config('laraadmin.adminRoute') . '.payroll_deductions.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Display the specified Payroll_Deduction.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Payroll_Deductions", "view")) {
			
			$Payroll_Deduction = Payroll_Deduction::find($id);
			if(isset($Payroll_Deduction->id)) {
				$module = Module::get('Payroll_Deductions');
				$module->row = $Payroll_Deduction;
				
				return view('la.Payroll_Deductions.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('Payroll_Deduction', $Payroll_Deduction);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("Payroll_Deduction"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Show the form for editing the specified Payroll_Deduction.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Menu::hasAccess("Payroll_Deductions", "edit")) {			
			$payroll_deduction = Payroll_Deduction::find($id);
			if(isset($payroll_deduction->id)) {
				//$salary_heads=Payroll_Head::salary_head_dropdown();
				//$salary_heads=Payroll_Allowance::all();
				$salary_heads=Payroll_Deduction::salary_heads();

				$payroll_heads=Payroll_Head::payroll_deduction_heads();
				return view('payroll.payroll_deductions.edit', [
					'salary_heads'=>$salary_heads,
					'payroll_heads'=>$payroll_heads
				])->with('payroll_deduction', $payroll_deduction);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("Payroll_Deduction"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Update the specified Payroll_Deduction in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Menu::hasAccess("Payroll_Deductions", "edit")) {
			//echo 'munna';die();
			//$rules = Module::validateRules("Payroll_Deductions", $request, true);
			$rules = Module::validateRules("Payroll_Deductions", $request);
			$rules = array(
                'deduction_name' => 'required|max:100|unique:payroll_deductions,deduction_name,'.$id.',id,deleted_at,NULL',
                'payroll_head_id' => 'required',
                'deduction_amount' => 'required',
                'time_interval' => 'required',
                'type' => 'required',
            );
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			//$insert_id = Module::updateRow("Payroll_Deductions", $request, $id);
			$payroll_deduction=Payroll_Deduction::find($id);
			$payroll_deduction->deduction_name=$request->deduction_name;
			$payroll_deduction->type=$request->type;
			$payroll_deduction->payroll_head_id	=$request->payroll_head_id;
			if($request->type==2)
            {
            	//..........percentage......
                if(empty($request->salary_head_id) && $request->salary_head_id<0)
            	{
            		$payroll_deduction->salary_head_id=Null;
            	}
            	else
            	{
            		if($request->salary_head_id==0)
            		{
            			$salry_head=0;
            		}
            		else
            		{
            			$salry_head=$request->salary_head_id;
            		}
            		$payroll_deduction->salary_head_id=$salry_head;
            	}
            }
            else
            {
            	$payroll_deduction->salary_head_id=Null;
            }	
			$payroll_deduction->deduction_amount=$request->deduction_amount;

			if($request->type==2)
			{
				if($request->deduction_max_amount>0)
				{
					$payroll_deduction->deduction_max_amount=$request->deduction_max_amount;
				}
				else
				{
					$payroll_deduction->deduction_max_amount=0;
				}
				
				
				if($request->deduction_min_amount>0)
				{
					$payroll_deduction->deduction_min_amount=$request->deduction_min_amount;
				}
				else
				{
					$payroll_deduction->deduction_min_amount=0;
				}
			}
			else
			{
				$payroll_deduction->deduction_max_amount=0;
				$payroll_deduction->deduction_min_amount=0;
			}
			
			$payroll_deduction->time_interval=$request->time_interval;
			$payroll_deduction->save();

			
			return redirect()->route(config('laraadmin.adminRoute') . '.payroll_deductions.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Remove the specified Payroll_Deduction from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Menu::hasAccess("Payroll_Deductions", "delete")) {
			Payroll_Deduction::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.payroll_deductions.index');
		} else {
			return View('error');
		}
	}
	

}
