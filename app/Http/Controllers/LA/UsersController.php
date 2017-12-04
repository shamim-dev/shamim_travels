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
use Dwij\Laraadmin\Models\ModuleFields;
use Dwij\Laraadmin\Models\Menu;
use App\User;

use App\Helpers\CommonHelper;
use App\Models\Employee_Info;

class UsersController extends Controller
{
	public $show_action = false;
	//public $show_action = true;
	//public $view_col = 'name';
	//public $listing_cols = ['id', 'name', 'email', 'type'];
	
	public function __construct() {
		$this->menu_id = Menu::get('Users');
		$this->message=CommonHelper::message();
		// Field Access of Listing Columns
		// if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
		// 	$this->middleware(function ($request, $next) {
		// 		$this->listing_cols = ModuleFields::listingColumnAccessScan('Users', $this->listing_cols);
		// 		return $next($request);
		// 	});
		// } else {
		// 	$this->listing_cols = ModuleFields::listingColumnAccessScan('Users', $this->listing_cols);
		// }
	}
	
	/**
	 * Display a listing of the Users.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		
		$module = Module::get('Users');
		//echo $this->show_action;die();
		if(Menu::hasAccess($this->menu_id)) {
			$users=Employee_Info::get_user_list();
			//print_r($users);die();
			return View('la.users.index', [
				'show_actions' => $this->show_action,
				'values' => $users,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Menu::hasAccess("Users", "view")) {
			$user = User::findOrFail($id);
			if(isset($user->id)) {
				if($user['type'] == "Employee") {
					return redirect(config('laraadmin.adminRoute') . '/employees/'.$user->id);
				} else if($user['type'] == "Client") {
					return redirect(config('laraadmin.adminRoute') . '/clients/'.$user->id);
				}
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	// public function dtajax()
	// {
	// 	$values = DB::table('users')->select($this->listing_cols)->whereNull('deleted_at');
	// 	$out = Datatables::of($values)->make();
	// 	$data = $out->getData();

	// 	$fields_popup = ModuleFields::getModuleFields('Users');
		
	// 	for($i=0; $i < count($data->data); $i++) {
	// 		for ($j=0; $j < count($this->listing_cols); $j++) { 
	// 			$col = $this->listing_cols[$j];
	// 			if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
	// 				$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
	// 			}
	// 			if($col == $this->view_col) {
	// 				$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
	// 			}
	// 			// else if($col == "author") {
	// 			//    $data->data[$i][$j];
	// 			// }
	// 		}
			
	// 		if($this->show_action) {
	// 			$output = '';
	// 			if(Menu::hasAccess("Users", "edit")) {
	// 				$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
	// 			}
				
	// 			if(Menu::hasAccess("Users", "delete")) {
	// 				$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.users.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
	// 				$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
	// 				$output .= Form::close();
	// 			}
	// 			$data->data[$i][] = (string)$output;
	// 		}
	// 	}
	// 	$out->setData($data);
	// 	return $out;
	// }


	//..................create user start......
	// public function store(Request $request)
	// {
	// 	if(Menu::hasAccess("Users", "create")) {
		
	// 		$rules = Module::validateRules("Users", $request);
			
	// 		$validator = Validator::make($request->all(), $rules);
			
	// 		if ($validator->fails()) {
	// 			return redirect()->back()->withErrors($validator)->withInput();
	// 		}
			
	// 		$insert_id = Module::insert("Users", $request);
			
	// 		return redirect()->route(config('laraadmin.adminRoute') . '.users.index');
			
	// 	} else {
	// 		return redirect(config('laraadmin.adminRoute')."/");
	// 	}
	// }

	public function store(Request $request)
	{
		if(Menu::hasAccess("Users", "create")) {
            if($request->user_id)
            {
            	$rules = array(
	                'emp_id' => 'required',
	                'user_name' => 'required|max:100|unique:users,user_name,'.$request->user_id.',id,deleted_at,NULL',
	                'password' => 'min:6|same:retype_password',
	                'retype_password' => 'min:6',
	            );
	            $validator = Validator::make($request->all(), $rules);
	            if ($validator->fails()) 
	            {
	                return redirect()->back()->withErrors($validator)->withInput();
	            }

            	$user=User::find($request->user_id);
            	if($request->password)
            	$user->password=bcrypt($request->password);
            	$user->user_level=$request->user_level;
	            $user->save();
	            return redirect()->route(config('laraadmin.adminRoute') . '.join.index')->with('message', $this->message['update_success']);
            }
            else
            {
            	$rules = array(
	                'emp_id' => 'required',
	                'user_name' => 'required|max:100|unique:users,user_name,NULL,id,deleted_at,NULL',
	                'password' => 'required|min:6|same:retype_password',
	                'retype_password' => 'required|min:6',
	            );
	            $validator = Validator::make($request->all(), $rules);
	            if ($validator->fails()) 
	            {
	                return redirect()->back()->withErrors($validator)->withInput();
	            }
            	$user=new User;
	            $user->emp_id=$request->emp_id;
	            $user->user_name=$request->user_name;
	            $user->password=bcrypt($request->password);
	            $user->user_level=$request->user_level;
	            $user->save();
	            $last_user_id=$user->id;

	            $employee_info=Employee_Info::find($request->emp_id);
	            $employee_info->user_id=$last_user_id;
	            $employee_info->save();

	            return redirect()->route(config('laraadmin.adminRoute') . '.join.index')->with('message', $this->message['add_success']);

            }
            
		} else {
			return View('error');
		}
	}
	//..................create user end......


}
