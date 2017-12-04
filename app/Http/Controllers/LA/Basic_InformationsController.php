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
use Illuminate\Support\Facades\Input;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\Menu;
use Dwij\Laraadmin\Models\ModuleFields;
use Session;
use App\Models\Basic_Information;
use App\Models\Employee_Info;
use App\Models\District;
use App\Models\Academy_Course;

class Basic_InformationsController extends Controller
{
	public $show_action = true;
	public $view_col = 'emp_id';
	public $listing_cols = ['id', 'emp_id', 'nationality', 'religion', 'gender', 'marital_status', 'dob', 'blood_group', 'id_card_no', 'job_join_date'];
	
	public function __construct() {

		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Basic_Informations', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Basic_Informations', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Basic_Informations.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		/*$values = DB::table('basic_informations as bi')
        ->select('bi.*', 'ei.rab_id')
        ->leftJoin('employees_info as ei', 'bi.emp_id', '=', 'ei.emp_id')
        ->whereNull('bi.deleted_at')
		->orderBy('bi.id','desc')
        ->paginate(10);*/

        $values = Employee_info::dtajax_rab_after_join_list_pagination('basic_informations',$this->listing_cols);

		$module = Module::get('Basic_Informations');
		
		if(Menu::hasAccess('Basic_Informations')) {
			$employees =Employee_Info::dropdown_after_joining_in_rab();
			$districts = District::all();
			$academy_courses = Academy_Course::all();
			return View('la.basic_informations.index', [
				'show_actions' => $this->show_action,
				// 'listing_cols' => $this->listing_cols,
				'values' => $values,
				'module' => $module,
				'employees' => $employees,
				'districts' => $districts,
				'academy_courses' => $academy_courses
			]);
		} else {
			return View('error');
        }
	}

	/**
	 * Show the form for creating a new basic_information.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created basic_information in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Menu::hasAccess("Basic_Informations", "create")) {

			$rules = array(
                'emp_id' => 'unique:basic_informations,emp_id,NULL,id,deleted_at,NULL'
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
		
			// $rules = Module::validateRules("Basic_Informations", $request);
			
			// $validator = Validator::make($request->all(), $rules);
			
			// if ($validator->fails()) {
			// 	return redirect()->back()->withErrors($validator)->withInput();
			// }
			
			$insert_id = Module::insert("Basic_Informations", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.basic_informations.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Display the specified basic_information.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Basic_Informations", "view")) {
			
			$basic_information = Basic_Information::find($id);
			if(isset($basic_information->id)) {
				$module = Module::get('Basic_Informations');
				$module->row = $basic_information;

				$show_info = Basic_Information::get_basic_info_by_id($id);
				
				return view('la.basic_informations.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding",
					'show_info' => $show_info
				])->with('basic_information', $basic_information);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("basic_information"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Show the form for editing the specified basic_information.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Menu::hasAccess("Basic_Informations", "edit")) {			
			$basic_information = Basic_Information::find($id);
			if(isset($basic_information->id)) {	
				$module = Module::get('Basic_Informations');
				$employees =Employee_Info::dropdown_after_joining_in_rab();
				$show_info = Basic_Information::get_basic_info_by_id($id);
				$module->row = $basic_information;
				$academy_courses = Academy_Course::all();

				// print_r($show_info);
				// die();
			
				return view('la.basic_informations.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
					'employees' => $employees,
					'show_info' => $show_info,
					'academy_courses' => $academy_courses
				])->with('basic_information', $basic_information);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("basic_information"),
				]);
			}
		} else {
			return View('error');
		}
	}

	/**
	 * Update the specified basic_information in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Menu::hasAccess("Basic_Informations", "edit")) {
			
			$rules = Module::validateRules("Basic_Informations", $request, true);
			$rules = array(
                'emp_id' => 'unique:basic_informations,emp_id,'.$id.',id,deleted_at,NULL'
            );
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Basic_Informations", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.basic_informations.index');
			
		} else {
			return View('error');
		}
	}

	/**
	 * Remove the specified basic_information from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		// echo 'ashche'; die();
		if(Menu::hasAccess("Basic_Informations", "delete")) {
			Basic_Information::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.basic_informations.index');
		} else {
			return View('error');
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	// public function dtajax()
	// {
	// 	$values = Employee_info::dtajax_rab_after_join_list('basic_informations',$this->listing_cols);
	// 	$out = Datatables::of($values)->make();
	// 	$data = $out->getData();

	// 	$fields_popup = ModuleFields::getModuleFields('Basic_Informations');
		
	// 	for($i=0; $i < count($data->data); $i++) {
	// 		for ($j=0; $j < count($this->listing_cols); $j++) { 
	// 			$col = $this->listing_cols[$j];
	// 			if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
	// 				$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
	// 			}
	// 			if($col == $this->view_col) {
	// 				$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/basic_informations/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
	// 			}
	// 		}
			
	// 		if($this->show_action) {
	// 			$output = '';
	// 			if(Menu::hasAccess("Basic_Informations", "edit")) {
	// 				$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/basic_informations/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
	// 			}
				
	// 			if(Menu::hasAccess("Basic_Informations", "delete")) {
	// 				$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.basic_informations.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
	// 				$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
	// 				$output .= Form::close();
	// 			}
	// 			$data->data[$i][] = (string)$output;
	// 		}
	// 	}
	// 	$out->setData($data);
	// 	return $out;

	// }

	public function filter_basic_informations(Request $request){
		Input::merge(array_map('trim', Input::all()));  

		$battalion_id=Session::get('battalion_id');
        $wing_id=Session::get('wing_id');
        $branch_id=Session::get('branch_id');
        $sub_branch_id=Session::get('sub_branch_id');
        $section_id=Session::get('section_id');
        $sub_section_id=Session::get('sub_section_id'); 

		$keyword = $request->search_keyword;
        $data = DB::table('basic_informations as bi')
            ->select(DB::raw("ei.rab_id, ei.personal_no, ei.emp_name, r.rank_short_name, bi.id, bi.emp_id, ifnull(bi.religion, '') as religion, ifnull(bi.gender, '') as gender, ifnull(bi.marital_status, '') as marital_status, ifnull(DATE_FORMAT(bi.dob,'%d/%m/%Y'), '') as dob, ifnull(bi.blood_group, '') as blood_group, ifnull(DATE_FORMAT(bi.job_join_date,'%d/%m/%Y'), '') as job_join_date "))
            ->leftJoin('employees_info as ei', 'bi.emp_id', '=', 'ei.emp_id')
            ->leftJoin('posting_record', 'posting_record.posting_rec_id', '=', 'ei.posting_rec_id')
            ->leftJoin('ranks as r', 'ei.rank_id', '=', 'r.id')
            ->whereNull('bi.deleted_at')
            ->where('ei.rab_id', 'like', "%$keyword%")
            ->where(function ($query) use ($battalion_id,$wing_id,$branch_id,$sub_branch_id,$section_id,$sub_section_id) {
                if(Session::get('user_level')>1)
                {
                    $query->where('posting_record.battalion_id', '=',$battalion_id);
                    $query->where('posting_record.wing_id', '=',$wing_id);
                    $query->where('posting_record.branch_id', '=',$branch_id);
                    $query->where('posting_record.sub_branch_id', '=',$sub_branch_id);
                    $query->where('posting_record.section_id', '=',$section_id);
                    $query->where('posting_record.sub_section_id', '=',$sub_section_id);
                }
            })
            ->get();
        echo json_encode($data);
    }
}
