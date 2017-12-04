<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Input;
use DB;
use Log;
use App;
use Session;
use DateTime;
use Lang;
use Carbon\Carbon;

class CommonHelper
{
	// $names = LAHelper::generateModuleNames($module_name);
    public static function databseDateFormat($date) {     //convert input date in DB date format
    	if(empty($date)){
    		return null;
    	}else{
	    	$d2 = date_parse_from_format("d/m/Y",$date);
			return date("Y-m-d", strtotime($d2['year']."-".$d2['month']."-".$d2['day']));
    		
    	}
    	
	}
	public static function databseDateTimeFormat($date) { //convert input datetime in DB date format 
		if(empty($date)){
    		return null;
    	}else{
    		$d2 = date_parse_from_format("d/m/Y h:i A",$date);
			return date("Y-m-d H:i:s", strtotime($d2['year']."-".$d2['month']."-".$d2['day']." ".substr($date, 11)));
    	}
		
	}
    public static function databseDateTimeFormatWithCurrentTime($date) { 
    //convert input date in DB date format with currennt time
        if(empty($date)){
            return null;
        }else{
            $date=$date.' '.date('H:i:s');
            $d2 = date_parse_from_format("d/m/Y H:i:s",$date);
            return date("Y-m-d H:i:s", strtotime($d2['year']."-".$d2['month']."-".$d2['day']." ".substr($date, 11)));
        }
    }

	public static function showDateFormat($date) {  	  //convert Db date to user format
		if(empty($date)){
    		return null;
    	}else{
    		/*$d2 = date_parse_from_format("Y-m-d h:i:s",$date);
			return $d2['day']."/".$d2['month']."/".$d2['year'];*/
            $d2 = date("d/m/Y",strtotime($date));
            return $d2;
    	}
		
	}
    public static function showDateTimeFormat($date) {        //convert Db date to user format
        if(empty($date)){
            return null;
        }else{
            /*$d2 = date_parse_from_format("Y-m-d h:i:s",$date);
            return $d2['day']."/".$d2['month']."/".$d2['year'];*/
            $d2 = date("d/m/Y g:i A",strtotime($date));
            return $d2;
        }
        
    }

    public static function twoDateDiffInYearMonthDay($date1,$date2)
    {
        if(isset($date1) && isset($date2))
        {
            $date1 = new DateTime($date1);
            $date2 = new DateTime($date2);
            
            $diff = $date1->diff($date2);

            $year=null;
            $month=null;
            $day=null;
            if($diff->y>0)
            {
                $label=($diff->y>1) ? Lang::get('messages.years') : Lang::get('messages.year');
                $year=Lang::get('messages.'.$diff->y) .' '.$label.' ';
            }
            if($diff->m>0)
            {
                $label=($diff->m>1) ? Lang::get('messages.months') : Lang::get('messages.month');
                $month=Lang::get('messages.'.$diff->m) .' '.$label.' ';
            }
            if($diff->d>0)
            {
                $label=($diff->d>1) ? Lang::get('messages.days') : Lang::get('messages.day');
                $day=Lang::get('messages.'.$diff->d) .' '.$label.' ';
            }
            return $year.$month.$day;
        }
        else
        {
            return null;
        }
        
    }

    public static function en2bnNumber ($number){
        
    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "/", "-", ".","January","February","March","April","May","June","July","August","September","October","November","December","am","AM","pm","PM");
    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০","/","-",".","জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর","সকাল","সকাল","বিকাল","বিকাল");
    $bn_number = str_replace($search_array, $replace_array, $number);

    return $bn_number;
    }

    public static function message(){
        if (App::isLocale('bn')) {
            return 
            [
                'add_success'=>'সঠিকভাবে সম্পাদন হয়েছে',
                'update_success'=>'সঠিকভাবে Updated !',
                'delete_success'=>'সঠিকভাবে Deleted !',
            ];
        }else{
            return 
            [
                'add_success'=>'Successfully Saved !',
                'update_success'=>'Successfully Updated !',
                'delete_success'=>'Successfully Deleted !',
            ];
        }
        
    }

    public static function twoFieldUniqueValidation($table_name,$unique_field,$dependent_field,$dependent_input,$edit_field,$edit_id=null)
    {
        /*
        unique_field like user_id,dependent_field like role_user,dependent_input like role_user,
        $edit_field=PK of the table,edit_id=edit id
        */
        $all = Input::all();
        if(!array_key_exists($dependent_input, $all)) {
          return 'required';
        }
        $hasId = isset($edit_id) ? $edit_id : 'NULL';
        $result = 'required|unique:'.$table_name.','.$unique_field.',' . $hasId . ','.$edit_field.','.$dependent_field.','. $all[$dependent_input] . ',deleted_at,NULL';
        return $result;
    }

    public static function org_wise_filter()
    {
        $battalion_id=Session::get('battalion_id');
        $wing_id=Session::get('wing_id');
        $branch_id=Session::get('branch_id');
        $sub_branch_id=Session::get('sub_branch_id');
        $section_id=Session::get('section_id');
        $sub_section_id=Session::get('sub_section_id');
        if($battalion_id>0 && $wing_id>0 && $branch_id>0 && $sub_branch_id>0 && $section_id>0 && $sub_section_id>0)
        {
            $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
        and pr.branch_id=$branch_id and pr.sub_branch_id=$sub_branch_id
        and pr.section_id=$section_id and pr.sub_section_id=$sub_section_id";
        }
        elseif($battalion_id>0 && $wing_id>0 && $branch_id>0 && $sub_branch_id>0 && $section_id>0)
        {
            $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
        and pr.branch_id=$branch_id and pr.sub_branch_id=$sub_branch_id
        and pr.section_id=$section_id";

        }
        elseif($battalion_id>0 && $wing_id>0 && $branch_id>0 && $sub_branch_id>0)
        {
            $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
        and pr.branch_id=$branch_id and pr.sub_branch_id=$sub_branch_id";
        }
        elseif($battalion_id>0 && $wing_id>0 && $branch_id>0)
        {
            $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id 
        and pr.branch_id=$branch_id";
        }
        elseif($battalion_id>0 && $wing_id>0)
        {
            $v_query="and pr.`battalion_id`=$battalion_id and pr.wing_id=$wing_id";
        }
        elseif($battalion_id>0)
        {
            $v_query="and pr.`battalion_id`=$battalion_id";
        }
        else
        {
            $v_query=NULL;
        }
        return $v_query;
    }

    public static function round_number_format($p_number)
    {
        return round($p_number);
    }

    public static function fiscalYear($p_date=null)
    {
        if(isset($p_date))
        {
            $v_date=Carbon::parse($p_date);
        }
        else
        {
            $v_date=Carbon::now();
        }

        if ($v_date->month <= 6) {//Upto June 2014-2015
            $financial_year = ($v_date->year-1) . '-' . $v_date->year;
        } else {//After June 2015-2016
            $financial_year = $v_date->year . '-' . ($v_date->year + 1);
        }
        return $financial_year;
    }

	

}
