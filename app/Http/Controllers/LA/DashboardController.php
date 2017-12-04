<?php

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

use URL;
use Cookie;
use Auth;
use DB;
use Lang;

use App\Models\Employee_Info;
use App\Models\Mother_Force;
use App\Models\Battalion;


/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $id=Auth::id();
        //$count = Employee_Info::where('user_id',$id)->count();
        $count =DB::table('employees_info')
            ->where('user_id',$id)
            ->count();
        //echo $count;die();   
        if($count>0)
        {
            $v_user_data=Employee_Info::emp_session_data($id);
            $v_session_data = (array) $v_user_data;
            Session::put($v_session_data);
        }
        else
        {
            $user = DB::table('users')
                ->select('id','user_name','user_level')
                ->where('id',$id)->first();
            $v_session_data = (array) $user;
            Session::put($v_session_data);
        }
            
        $back_url = url(config('laraadmin.adminRoute') .'/manpower_state_rab_battalions');
        
        return view('la.dashboard',[
            'back_url' => $back_url,
            'header' => Lang::get('messages.MSORB'),
            ]);
    }

    public function module($id){
        Session::set('parent_menu_id', $id);
        //return view('la.dashboard');
        //$this->index($id);
        return redirect(config('laraadmin.adminRoute')."/dashboard");
    }

    public function language($language)
    {
        Cookie::queue('locale', $language);
        return redirect(url(URL::previous()));
    }
    public function session_info()
    {
        print_r(Session::all());die();
    }

}