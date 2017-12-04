<?php

namespace App\Http\Controllers\LA;

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

use App\Models\Bank_Account;
use App\Models\Employee_Info;
use App\Helpers\CommonHelper;

class Bank_AccountsController extends Controller
{
	public $show_action = true;
	public $view_col = 'bank_acc_no';
	public $listing_cols = ['id', 'emp_id', 'bank_acc_name', 'bank_acc_no', 'bank_id', 'bank_branch', 'bank_branch_address'];
	
	public function __construct() {

		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Bank_Accounts', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Bank_Accounts', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Bank_Accounts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Bank_Accounts');
		
		if(Menu::hasAccess('Bank_Accounts')) {
			$employees=Employee_Info::dropdown_after_joining_in_rab();
			return View('la.bank_accounts.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'employees' => $employees,
				'module' => $module
			]);
		} else {
			return View('error');
        }
	}

	/**
	 * Show the form for creating a new bank_account.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created bank_account in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Menu::hasAccess("Bank_Accounts", "create")) {
		
			$rules = Module::validateRules("Bank_Accounts", $request);
			$rules = array(
                'bank_acc_no' => CommonHelper::twoFieldUniqueValidation('bank_accounts','bank_acc_no','emp_id','emp_id','id'),
            );
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Bank_Accounts", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.bank_accounts.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Display the specified bank_account.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Bank_Accounts", "view")) {
			
			$bank_account = Bank_Account::find($id);
			if(isset($bank_account->id)) {
				$module = Module::get('Bank_Accounts');
				$module->row = $bank_account;
				
				return view('la.bank_accounts.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('bank_account', $bank_account);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("bank_account"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Show the form for editing the specified bank_account.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Menu::hasAccess("Bank_Accounts", "edit")) {			
			$bank_account = Bank_Account::find($id);
			if(isset($bank_account->id)) {	
				$module = Module::get('Bank_Accounts');
				
				$module->row = $bank_account;
				$employees=Employee_Info::dropdown_after_joining_in_rab();
				
				return view('la.bank_accounts.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
					'employees' => $employees,
				])->with('bank_account', $bank_account);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("bank_account"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Update the specified bank_account in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Menu::hasAccess("Bank_Accounts", "edit")) {
			
			$rules = Module::validateRules("Bank_Accounts", $request, true);
			$rules = array(
                'bank_acc_no' => CommonHelper::twoFieldUniqueValidation('bank_accounts','bank_acc_no','emp_id','emp_id','id',$id),
            );
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Bank_Accounts", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.bank_accounts.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Remove the specified bank_account from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Menu::hasAccess("Bank_Accounts", "delete")) {
			Bank_Account::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.bank_accounts.index');
		} else {
			return View('error');
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		/*$values = DB::table('bank_accounts')
			->select($this->listing_cols)
			->whereNull('deleted_at')
			->orderBy('id','desc');*/
		$values = Employee_Info::dtajax_rab_after_join_list('bank_accounts',$this->listing_cols);
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Bank_Accounts');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/bank_accounts/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Menu::hasAccess("Bank_Accounts", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/bank_accounts/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Menu::hasAccess("Bank_Accounts", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.bank_accounts.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm(\'Are you sure to delete this entry?\')"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
