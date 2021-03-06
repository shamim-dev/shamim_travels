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

use App\Models\Role;

class RolesController extends Controller
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name', 'display_name', 'description'];
	
	public function __construct() {

		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Roles', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Roles', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Roles.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Roles');
		
		if(Menu::hasAccess('Roles')) {
			return View('la.roles.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
			return View('error');
        }
	}

	/**
	 * Show the form for creating a new role.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created role in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Menu::hasAccess("Roles", "create")) {
		
			$rules = Module::validateRules("Roles", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Roles", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.roles.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Display the specified role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Roles", "view")) {
			
			$role = Role::find($id);
			if(isset($role->id)) {
				$module = Module::get('Roles');
				$module->row = $role;
				
				return view('la.roles.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('role', $role);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("role"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Show the form for editing the specified role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Menu::hasAccess("Roles", "edit")) {			
			$role = Role::find($id);
			if(isset($role->id)) {	
				$module = Module::get('Roles');
				
				$module->row = $role;
				
				return view('la.roles.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('role', $role);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("role"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Update the specified role in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Menu::hasAccess("Roles", "edit")) {
			
			$rules = Module::validateRules("Roles", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Roles", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.roles.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Remove the specified role from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Menu::hasAccess("Roles", "delete")) {
			Role::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.roles.index');
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
		$values = DB::table('roles')
			->select($this->listing_cols)
			->whereNull('deleted_at')
			->orderBy('id','desc');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Roles');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/roles/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Menu::hasAccess("Roles", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/roles/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Menu::hasAccess("Roles", "delete")) {
					/*
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.roles.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm(\'Are you sure to delete this entry?\')"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
					*/
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
