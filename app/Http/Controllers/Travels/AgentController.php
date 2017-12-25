<?php

namespace App\Http\Controllers\Travels;

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
use Carbon\Carbon;
use App\Helpers\CommonHelper;

use App\Models\AgentInfo;


class AgentController extends Controller
{
    public $show_action = true;
    
    public function __construct()
    {
        $this->menu_id = Menu::get('Agent_Info');
    }

    public function index()
    {
        if(Menu::hasAccess($this->menu_id)) {
            $user_id=Session::get('id');
            $info = AgentInfo::dtList();   
            return View('travels.agent.index', [
                'show_actions' => $this->show_action,
                'values'=>$info,
            ]);
        } else {
            return View('error');
        }
    }
    public function create()
    {
        return View('travels.agent.add_form');
    }

    public function store(Request $request){
        if(Menu::hasAccess("Agent_Info", "create")) 
        {            
            $user_id=Session::get('id');
            $rules = array(
                'agent_name'=> 'required',
                'mobile_no_1'=> 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }            
            
            $agent_info=new AgentInfo;
            $agent_info->agent_name=$request->agent_name; 
            $agent_info->first_mobile_no=$request->mobile_no_1; 
            $agent_info->second_mobile_no=$request->mobile_no_2; 
            $agent_info->first_email=$request->email_1;
            $agent_info->second_email=$request->email_2;
            $agent_info->address=$request->address;
            $agent_info->created_by=$user_id;
            $agent_info->save();

            return redirect()->route(config('laraadmin.adminRoute') . '.agent_info.index');
        }
        else
        {
            return View('error');
        }
    }

    /**
     * Display the specified vehicle_fuel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Menu::hasAccess("Agent_Info", "view")) {
            
            $agent_info = AgentInfo::find($id);
            return View('travels.agent.show',[
                'agent_info'=>$agent_info
                ]);
        } else {
            return View('error');
        }
    }

    /**
     * Show the form for editing the specified vehicle_fuel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(Menu::hasAccess("Agent_Info", "edit")) {
            $user_id=Session::get('id');
            $agent_info = AgentInfo::find($id);

            //...upper portion dropdown end..............
            return View('travels.agent.edit_form',[
                'agent_info'=>$agent_info
            ]);
        } else {
            return View('error');
        }
    }

    /**
     * Update the specified vehicle_fuel in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Menu::hasAccess("Agent_Info", "edit")) {
            $user_id=Session::get('id');
            $rules = array(
                'agent_name'=> 'required',
                'mobile_no_1'=> 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }       
            $agent_info= AgentInfo::find($id);
            $agent_info->agent_name=$request->agent_name; 
            $agent_info->first_mobile_no=$request->mobile_no_1; 
            $agent_info->second_mobile_no=$request->mobile_no_2; 
            $agent_info->first_email=$request->email_1;
            $agent_info->second_email=$request->email_2;
            $agent_info->address=$request->address;
            $agent_info->updated_by=$user_id;
            $agent_info->save();

            return redirect()->route(config('laraadmin.adminRoute') . '.agent_info.index');
            
        } else {
            return View('error');
        }
    }

    /**
     * Remove the damage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Menu::hasAccess("Agent_Info", "delete")) {
            AgentInfo::find($id)->delete();
           
            // Redirecting to index() method
            return redirect()->route(config('laraadmin.adminRoute') . '.agent_info.index');
        } else {
            return View('error');
        }
    }
}