<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

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

use App\Models\Upazilla;

class UpazillasController extends Controller
{
	public $show_action = true;
	public $view_col = 'upazilla_name';
	public $listing_cols = ['id', 'district_id', 'upazilla_name'];
	
	public function __construct() {

		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Upazillas', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Upazillas', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Upazillas.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Upazillas');
		
		if(Menu::hasAccess('Upazillas')) {
			return View('la.upazillas.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
			return View('error');
        }
	}

	/**
	 * Show the form for creating a new upazilla.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created upazilla in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Menu::hasAccess("Upazillas", "create")) {
		
			$rules = Module::validateRules("Upazillas", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Upazillas", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.upazillas.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Display the specified upazilla.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Upazillas", "view")) {
			
			$upazilla = Upazilla::find($id);
			if(isset($upazilla->id)) {
				$module = Module::get('Upazillas');
				$module->row = $upazilla;
				
				return view('la.upazillas.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('upazilla', $upazilla);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("upazilla"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Show the form for editing the specified upazilla.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Menu::hasAccess("Upazillas", "edit")) {			
			$upazilla = Upazilla::find($id);
			if(isset($upazilla->id)) {	
				$module = Module::get('Upazillas');
				
				$module->row = $upazilla;
				
				return view('la.upazillas.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('upazilla', $upazilla);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("upazilla"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Update the specified upazilla in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Menu::hasAccess("Upazillas", "edit")) {
			
			$rules = Module::validateRules("Upazillas", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Upazillas", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.upazillas.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Remove the specified upazilla from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Menu::hasAccess("Upazillas", "delete")) {
			Upazilla::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.upazillas.index');
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
		$values = DB::table('upazillas')
			->select($this->listing_cols)
			->whereNull('deleted_at')
			->orderBy('id','desc');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Upazillas');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/upazillas/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Menu::hasAccess("Upazillas", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/upazillas/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Menu::hasAccess("Upazillas", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.upazillas.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
