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

use App\Models\Designation;

class DesignationsController extends Controller
{
	public $show_action = true;
	public $view_col = 'designation_name';
	public $listing_cols = ['id', 'designation_name', 'desig_short_name',];
	
	public function __construct() {

		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Designations', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Designations', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Designations.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Designations');
		
		if(Menu::hasAccess('Designations')) {
			return View('la.designations.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
			return View('error');
        }
	}

	/**
	 * Show the form for creating a new designation.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created designation in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Menu::hasAccess("Designations", "create")) {
		
			$rules = Module::validateRules("Designations", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Designations", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.designations.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Display the specified designation.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Designations", "view")) {
			
			$designation = Designation::find($id);
			if(isset($designation->id)) {
				$module = Module::get('Designations');
				$module->row = $designation;
				
				return view('la.designations.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('designation', $designation);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("designation"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Show the form for editing the specified designation.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Menu::hasAccess("Designations", "edit")) {			
			$designation = Designation::find($id);
			if(isset($designation->id)) {	
				$module = Module::get('Designations');
				
				$module->row = $designation;
				
				return view('la.designations.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('designation', $designation);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("designation"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Update the specified designation in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Menu::hasAccess("Designations", "edit")) {
			
			$rules = Module::validateRules("Designations", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Designations", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.designations.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Remove the specified designation from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Menu::hasAccess("Designations", "delete")) {
			Designation::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.designations.index');
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
		$values = DB::table('designations')
			->select($this->listing_cols)
			->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Designations');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/designations/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Menu::hasAccess("Designations", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/designations/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Menu::hasAccess("Designations", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.designations.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
