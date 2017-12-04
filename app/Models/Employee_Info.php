<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Session;
use App\Helpers\CommonHelper;

class Employee_Info extends Model
{
    use SoftDeletes;
	
	protected $table = 'employees_info';
	protected $primaryKey = 'emp_id';
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

    public static function emp_session_data($p_user_id)
    {
        return DB::SELECT("SELECT ei.`emp_id`,ei.`rab_id`,ei.`personal_no`,ei.`rank_id`,
            ei.`mother_force_id`,ei.`core_id`,
            ei.`trade_id`,ei.`mother_unit_id`,ei.`emp_name`,ei.`joining_date`,
            ei.`replacement_emp_id`,ei.user_id,u.user_level,ei.`posting_rec_id`,
            pr.battalion_id,pr.wing_id,pr.branch_id,
            pr.sub_branch_id,pr.section_id,pr.sub_section_id,
            pr.posting_order_no,pr.post_joining_date
            from employees_info ei
            inner join posting_record pr on(pr.`posting_rec_id`=ei.`posting_rec_id`)
            inner join users u on(u.id=ei.user_id)
            WHERE ei.user_id=$p_user_id
            and ei.`deleted_at` is null 
            and pr.`deleted_at` is null")[0];
    }

    //.....................join order start.......................
	public static function get_emp_info($id){
        //.....get individual employee info...............
        $employee_info = DB::SELECT("SELECT ei.*,mf.mf_name,c.core_name,t.trade_name,mu.mu_name,r.rank_name ,ei2.rab_id as rep_rab_id,ei2.personal_no as rep_personal_no,ei2.emp_name as rep_emp_name,mf2.mf_name rep_mf_name,c2.core_name as rep_core_name,t2.trade_name as rep_trade_name,mu2.mu_name as rep_mu_name,r2.rank_name as rep_rank_name
            FROM `employees_info` ei
            left join mother_forces mf on(mf.id=ei.`mother_force_id`)
            left join cores c on(c.id=ei.`core_id`)
            left join trades t on(t.id=ei.`trade_id`)
            left join mother_units mu on(mu.id=ei.`mother_unit_id`)
            left join ranks r on(r.id=ei.`rank_id`)
            left join `employees_info` ei2 on(ei2.emp_id=ei.replacement_emp_id)
            left join mother_forces mf2 on(mf2.id=ei2.`mother_force_id`)
            left join cores c2 on(c2.id=ei2.`core_id`)
            left join trades t2 on(t2.id=ei2.`trade_id`)
            left join mother_units mu2 on(mu2.id=ei2.`mother_unit_id`)
            left join ranks r2 on(r2.id=ei2.`rank_id`)
            WHERE ei.`emp_id`=$id")[0];
                            
        return $employee_info;
    }
    public static function get_emp_list(){
        //......join order list for data table.......
        $employee_list = DB::SELECT("SELECT ei.emp_id,ei.rab_id,ei.personal_no,ei.emp_name,ei.joining_order_date,ei.joining_date,ei.release_date,
            mf.mf_name,r.rank_name,d.designation_name,ei2.personal_no as rep_personal_no
            FROM `employees_info` ei
            left join mother_forces mf on(mf.id=ei.`mother_force_id`)
            left join ranks r on(r.id=ei.`rank_id`)
            left join designations d on(d.id=ei.`designation_id`)
            left join `employees_info` ei2 on(ei2.emp_id=ei.`replacement_emp_id`)
            where ei.deleted_at is null and mf.deleted_at is null
            order by emp_id desc");
                            
        return $employee_list;
    }
    public static function replacement_emp_list($editId=null){
        //......replacement emp list for dropdown.......
        if(!isset($editId)){
            $editId=0;
        }
        
        // return DB::SELECT("SELECT ei.`emp_id`,ei.`personal_no`
        //     FROM `employees_info` ei
        //     WHERE ei.`joining_date` is not null
        //     and ei.`deleted_at` is null and ei.emp_id not in 
        //     (SELECT ei2.`emp_id` FROM `employees_info` ei
        //     inner join  `employees_info` ei2 on(ei2.emp_id=ei.replacement_emp_id)
        //     where ei2.`joining_date` is not null and ei2.`release_date` is null 
        //     and ei2.`deleted_at` is null
        //     union
        //     SELECT ei.`emp_id` FROM `employees_info` ei 
        //     where ei.`emp_id`=$editId and
        //     ei.`joining_date` is not null and ei.`release_date` is null 
        //     and ei.`deleted_at` is null
        //     )
        //     union
        //     SELECT ei2.`emp_id`,ei2.`personal_no` 
        //     FROM `employees_info` ei 
        //     inner join `employees_info` ei2 on(ei2.emp_id=ei.`replacement_emp_id`) 
        //     WHERE ei.`emp_id`=$editId
        //     ");


        return DB::SELECT("SELECT ei.`emp_id`,ei.`personal_no`
            FROM `employees_info` ei
            WHERE ei.`joining_date` is not null and ei.release_date is null
            and ei.`deleted_at` is null and ei.emp_id not in 
            (
            SELECT ei.`emp_id` FROM `employees_info` ei 
            where ei.`emp_id`=$editId and
            ei.`joining_date` is not null and ei.`release_date` is null 
            and ei.`deleted_at` is null
            )
            union
            SELECT ei2.`emp_id`,ei2.`personal_no` 
            FROM `employees_info` ei 
            inner join `employees_info` ei2 on(ei2.emp_id=ei.`replacement_emp_id`) 
            WHERE ei.`emp_id`=$editId
            ");
    }
    //.....................join order end.......................

    //.....................posting start.......................
    public static function get_posting_list()
    {
        //......posting list for data table.......
        if(Session::get('user_level')<2)
        {
            //$v_query=NULL;
            $battalion_id=Session::get('battalion_id');
            if(isset($battalion_id))
            {
                $v_query="and pr.`battalion_id`=$battalion_id";
            }
            else
            {
                $v_query=NULL;
            }
            
        }
        else
        {
           $v_query=CommonHelper::org_wise_filter(); 
        }

        return DB::SELECT("SELECT * from
        (
        SELECT pr.*,ei.rab_id,ei.personal_no,ei.emp_name,r.rank_short_name,ei.user_id,u.user_level,b.battalion_name,w.wing_name,br.branch_name,sb.sb_name,s.section_name,ss.sub_section_name
        FROM `posting_record` pr 
        inner join employees_info ei on(pr.emp_id=ei.emp_id) 
                    left join users u on(u.emp_id=ei.emp_id) 
                    left join ranks r on(r.id=ei.rank_id) 
                    left join battalions b on(b.id=pr.`battalion_id`) 
                    left join wings w on(w.id=pr.`wing_id`) 
                    left join branches br on(br.id=pr.`branch_id`) 
                    left join sub_branches sb on(sb.id=pr.`sub_branch_id`)
                    left join sections s on(s.id=pr.`section_id`)
                    left join sub_sections ss on(ss.id=pr.`sub_section_id`)
                    where pr.deleted_at is null and ei.deleted_at is null and r.deleted_at is null and b.deleted_at is null
                    and w.deleted_at is null and br.deleted_at is null
                    and sb.deleted_at is null and s.deleted_at is null and ss.deleted_at is null
                    $v_query
        order by pr.`posting_rec_id` desc
        ) a
        group by a.emp_id
        order by a.posting_rec_id desc
        ");
    }
	//group by a.emp_id
        
     public static function get_join_waiting_list($is_officer)
    {
        //......posting list for data table.......
        if(Session::get('user_level')<2)
        {
            $v_query=NULL;
        }
        else
        {
           $v_query=CommonHelper::org_wise_filter(); 
        }

        if($is_officer == 'both'){
            $isOfficer = " ";
        }else{
            $isOfficer = "and r.is_officer = '$is_officer'";
        }
        return DB::SELECT("SELECT * from
        (
        SELECT pr.*,ei.rab_id,ei.user_id,  ei.personal_no, r.rank_name, ei.emp_name, d.dis_name as own_district, wd.dis_name as wife_district, u.user_level,b.battalion_name,w.wing_name,br.branch_name,sb.sb_name,s.section_name,ss.sub_section_name, mu.mu_name, bi.job_join_date, DATE_FORMAT(ei.joining_order_date,'%d/%m/%Y') as joining_order_date, DATE_FORMAT(ei.joining_date,'%d/%m/%Y') as joining_date, ei.joining_order_no 
            FROM `posting_record` pr 
            inner join employees_info ei on(pr.emp_id=ei.emp_id) 
            left join users u on(u.emp_id=ei.emp_id) 
            left join battalions b on(b.id=pr.`battalion_id`) 
            left join wings w on(w.id=pr.`wing_id`) 
            left join branches br on(br.id=pr.`branch_id`) 
            left join sub_branches sb on(sb.id=pr.`sub_branch_id`)
            left join sections s on(s.id=pr.`section_id`)
            left join sub_sections ss on(ss.id=pr.`sub_section_id`)
            left join ranks r on ei.rank_id = r.id
            left join mother_units mu on ei.mother_unit_id = mu.id
            left join basic_informations bi on bi.emp_id = ei.emp_id
            left join family_informations fi on fi.emp_id = ei.emp_id
            left join districts d on bi.birth_place = d.id
            left join districts wd on wd.id = fi.district_id

        where pr.deleted_at is null and ei.deleted_at is null and b.deleted_at is null
            and pr.is_joined =0  $isOfficer
            and w.deleted_at is null and br.deleted_at is null
            and sb.deleted_at is null and s.deleted_at is null and ss.deleted_at is null
            $v_query
        order by pr.`posting_rec_id` desc
        ) a
        group by a.emp_id
        order by a.posting_rec_id desc
        ");
    }

    public static function get_posting_emp_list()
    {   
        //......posting emp list for dropdown.......
        if(Session::get('user_level')<2)
        {
            return DB::SELECT("SELECT ei.`emp_id`,ei.`rab_id` 
            FROM `employees_info` ei 
            WHERE ei.`joining_date` is not null 
            and ei.`release_date` is null
            and ei.`deleted_at` is null
            order by ei.emp_id desc
            ");

        }
        else
        {
            //......stakeholderwise posting emp list.......
            $v_query=CommonHelper::org_wise_filter();
            
            return DB::SELECT("SELECT ei.`emp_id`,ei.`rab_id`
            FROM `posting_record` pr
            inner join employees_info ei on(ei.`posting_rec_id`=pr.`posting_rec_id`)
            WHERE ei.`deleted_at` is null 
            and ei.release_date is null
            and pr.`deleted_at` is null
            $v_query
            order by ei.emp_id desc
            ");

        }    

    }
    //.....................posting end.......................
    
    public static function dropdown_after_joining_in_rab()
    {
        if(Session::get('user_level')<2)
        {
            $v_query = NULL;
        }
        else
        {
            //......stakeholderwise rab joining list.......
            $v_query = CommonHelper::org_wise_filter();
        }
        return DB::SELECT("SELECT ei.emp_id, ei.rab_id, ei.emp_name, ei.personal_no, r.rank_short_name
                    FROM employees_info ei
                    LEFT JOIN ranks r ON ei.rank_id = r.id
                    LEFT JOIN posting_record pr ON(ei.posting_rec_id = pr.posting_rec_id)
                    WHERE ei.joining_date IS NOT NULL
                    AND ei.release_date IS NULL
                    AND ei.deleted_at IS NULL
                    AND pr.deleted_at IS NULL
                    AND r.deleted_at IS NULL
                    $v_query
                    ORDER BY ei.emp_id DESC");
    }


    public static function dropdown_rab_officer()
    {
        if(Session::get('user_level')<2)
        {
            $v_query=Null;
        }
        else
        {
            //......stakeholderwise rab joining list.......
            $v_query=CommonHelper::org_wise_filter();
        }
        return DB::SELECT("SELECT ei.`emp_id`,ei.`rab_id`, ei.emp_name, ei.personal_no, r.rank_short_name
        FROM `employees_info` ei
        inner join ranks r on ei.rank_id = r.id
        left join posting_record pr on(ei.`posting_rec_id`=pr.`posting_rec_id`)
        WHERE ei.`joining_date` is not null
        and ei.`release_date` is null
        and ei.`deleted_at` is null
        and pr.`deleted_at` is null
        and r.deleted_at is null
        and r.is_officer='Yes'
        $v_query
        order by ei.emp_id desc
        ");
    }
    public static function dropdown_rab_without_officer()
    {
        if(Session::get('user_level')<2)
        {
            $v_query=Null;
        }
        else
        {
            //......stakeholderwise rab joining list.......
            $v_query=CommonHelper::org_wise_filter();
        }
        return DB::SELECT("SELECT ei.`emp_id`,ei.`rab_id`, ei.emp_name, ei.personal_no, r.rank_short_name
        FROM `employees_info` ei
        inner join ranks r on ei.rank_id = r.id
        left join posting_record pr on(ei.`posting_rec_id`=pr.`posting_rec_id`)
        WHERE ei.`joining_date` is not null
        and ei.`release_date` is null
        and ei.`deleted_at` is null
        and pr.`deleted_at` is null
        and r.deleted_at is null
        and r.is_officer='No'
        $v_query
        order by ei.emp_id desc
        ");
    }

    
    public static function dtajax_rab_after_join_list($p_table_name,$p_listing_col)
    {
        $listing_col=array();
        foreach($p_listing_col as $value)
        {
            $v_new=$p_table_name.'.'.$value;
            array_push($listing_col, $v_new);
        }
        
        $battalion_id=Session::get('battalion_id');
        $wing_id=Session::get('wing_id');
        $branch_id=Session::get('branch_id');
        $sub_branch_id=Session::get('sub_branch_id');
        $section_id=Session::get('section_id');
        $sub_section_id=Session::get('sub_section_id');

        return DB::table($p_table_name)
            ->join('employees_info', 'employees_info.emp_id', '=', $p_table_name.'.emp_id')
            ->leftJoin('posting_record', 'posting_record.posting_rec_id', '=', 'employees_info.posting_rec_id')
            ->select($listing_col)
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
            ->whereNull($p_table_name.'.deleted_at')
            ->whereNull('employees_info.deleted_at')
            ->orderBy('id','desc');
    }


    public static function dtajax_rab_after_join_list_pagination($p_table_name,$p_listing_col)
    {
        $listing_col=array();
        foreach($p_listing_col as $value)
        {
            $v_new=$p_table_name.'.'.$value;
            array_push($listing_col, $v_new);
        }
        //print_r($listing_col);
        array_push($listing_col, 'employees_info.rab_id', 'employees_info.personal_no', 'employees_info.emp_name', 'ranks.rank_short_name');

        $battalion_id=Session::get('battalion_id');
        $wing_id=Session::get('wing_id');
        $branch_id=Session::get('branch_id');
        $sub_branch_id=Session::get('sub_branch_id');
        $section_id=Session::get('section_id');
        $sub_section_id=Session::get('sub_section_id');

        return DB::table($p_table_name)
            ->join('employees_info', 'employees_info.emp_id', '=', $p_table_name.'.emp_id')
            ->leftJoin('ranks', 'employees_info.rank_id', '=', 'ranks.id')
            ->leftJoin('posting_record', 'posting_record.posting_rec_id', '=', 'employees_info.posting_rec_id')
            ->select($listing_col)
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
            ->whereNull($p_table_name.'.deleted_at')
            ->whereNull('employees_info.deleted_at')
            ->whereNull('ranks.deleted_at')
            ->orderBy('id','desc')
            ->paginate(10);
    }

    public static function dropdown_after_posting_in_rab_but_before_join_in_position()
    {
        return DB::SELECT("SELECT ei.`emp_id` , ei.`rab_id` 
        FROM  `employees_info` ei
        INNER JOIN posting_record pr ON ( pr.`emp_id` = ei.`emp_id` ) 
        WHERE ei.`joining_date` IS NOT NULL 
        AND ei.`release_date` IS NULL 
        AND ei.`deleted_at` IS NULL 
        AND pr.`is_joined` =0
        AND pr.`deleted_at` IS NULL
        and ei.`emp_id` not in
        (
        SELECT `emp_id` 
        FROM  `posting_record` pr
        WHERE  pr.`emp_id` =ei.`emp_id` 
        and pr.`deleted_at` is null
        and pr.`is_joined`=1
        )"
        );
    }
    public static function data_table_pre_training_emp_list()
    {
        return DB::SELECT("SELECT pt . * , ei.rab_id, CONCAT( DATE_FORMAT( tw.from_date,  '%d/%m/%Y' ) ,  ' to ', DATE_FORMAT( tw.to_date,  '%d/%m/%Y' ) ) as training_week_date, tw.traning_week
            FROM pre_trainings pt
            INNER JOIN employees_info ei ON ( ei.emp_id = pt.emp_id ) 
            INNER JOIN training_weeks tw ON ( tw.id = pt.training_week_id )
            where pt.deleted_at is null
            and ei.deleted_at is null
            and tw.deleted_at is null
            ");
    }
    public static function dropdown_rab_employee()
    {
        if(Session::get('user_level')<2)
        {
            $v_query=Null;
        }
        else
        {
            //......stakeholderwise rab joining list.......
            $v_query=CommonHelper::org_wise_filter();
        }
        return DB::SELECT("SELECT ei.`emp_id`, ei.`posting_rec_id`, ei.`rab_id` 
        FROM  `employees_info` ei
        INNER JOIN posting_record pr ON ( pr.`posting_rec_id` = ei.`posting_rec_id` ) 
        WHERE ei.`joining_date` IS NOT NULL 
        AND ei.`release_date` IS NULL 
        AND ei.`deleted_at` IS NULL 
        AND pr.`is_joined` =1
        AND pr.`deleted_at` IS NULL
        $v_query
        order by ei.emp_id desc
        ");
    }
     //......stakeholderwise rab joining list....... 

    public static function release_emp_list()
    {
        if(Session::get('user_level')<2)
        {
            $v_query=Null;
        }
        else
        {
            //......stakeholderwise rab joining list.......
            $v_query=CommonHelper::org_wise_filter();
        }
        return DB::SELECT("SELECT a.*,
            (
            SELECT b.battalion_name
            FROM  `posting_record` pr
            inner join battalions b on(b.id=pr.battalion_id)
            WHERE pr.`posting_rec_id`>a.posting_rec_id
            and pr.`emp_id`=a.emp_id
            and pr.`is_joined`='0'
            order by pr.`posting_rec_id` desc
            limit 1
            ) as posted_battalion
            from 
            (
            SELECT ei.`emp_id` , ei.`rab_id`,ei.personal_no, r.rank_name, ei.emp_name,pr.posting_rec_id,b.battalion_name,w.wing_name,br.branch_name,sb.sb_name,s.section_name,ss.sub_section_name,pr.post_release_date
            FROM  `employees_info` ei
            INNER JOIN posting_record pr ON ( pr.`posting_rec_id` = ei.`posting_rec_id` )
            left join ranks r on(r.id=ei.rank_id) 
            left join battalions b on(b.id=pr.`battalion_id`) 
            left join wings w on(w.id=pr.`wing_id`) 
            left join branches br on(br.id=pr.`branch_id`) 
            left join sub_branches sb on(sb.id=pr.`sub_branch_id`)
            left join sections s on(s.id=pr.`section_id`)
            left join sub_sections ss on(ss.id=pr.`sub_section_id`)
            WHERE ei.`joining_date` IS NOT NULL 
            AND ei.`release_date` IS NULL 
            AND ei.`deleted_at` IS NULL 
            AND pr.`is_joined` =1
            AND pr.`deleted_at` IS NULL
            and pr.deleted_at is null and ei.deleted_at is null and b.deleted_at is null
            and w.deleted_at is null and br.deleted_at is null
            and sb.deleted_at is null and s.deleted_at is null and ss.deleted_at is null 
            $v_query
            )a
        ");
    }
   

    

    //...............user start.................
    public static function get_user_list()
    {
        return DB::table('users')
                ->whereNull('deleted_at')
                ->get();
    }
    public static function dropdown_rab_user()
    {
        if(Session::get('user_level')<2)
        {
            $v_query=Null;
        }
        else
        {
            //......stakeholderwise rab joining list.......
            $v_query=CommonHelper::org_wise_filter();
        }
        return DB::SELECT("SELECT u.`id` , u.`user_name` 
        FROM  `employees_info` ei
        INNER JOIN posting_record pr ON ( pr.`posting_rec_id` = ei.`posting_rec_id` ) 
        inner join users u on(u.id=ei.user_id)
        WHERE ei.`joining_date` IS NOT NULL 
        AND ei.`release_date` IS NULL
        AND ei.`deleted_at` IS NULL 
        AND pr.`is_joined` =1
        AND pr.`deleted_at` IS NULL
        $v_query
        order by ei.emp_id desc
        ");
    }
    //...............user end.................

    public static function officerSalaryEmployee($employee){
        //print_r($employee);       
        if(in_array('all', $employee)){
            $sql = '';
        }else{
            $emp = implode(',', $employee);
            $sql = " AND ei.emp_id in ($emp)";

        }
        return DB::SELECT("
            SELECT ei.emp_id, ei.rab_id, ei.emp_name, ei.personal_no, r.rank_short_name, bt.battalion_name, bt.battalion_address,r.rank_name, desig.designation_name
            FROM employees_info ei
            LEFT JOIN ranks r ON ei.rank_id = r.id
            LEFT JOIN designations desig ON ei.designation_id = desig.id
            LEFT JOIN posting_record pr ON(ei.posting_rec_id = pr.posting_rec_id)
            LEFT JOIN battalions bt ON (bt.id = pr.battalion_id)
            WHERE ei.joining_date IS NOT NULL
                AND ei.release_date IS NULL
                AND ei.deleted_at IS NULL
                AND pr.deleted_at IS NULL
                AND r.deleted_at IS NULL
                and r.is_officer='Yes'
                $sql 
            ORDER BY ei.emp_id DESC
            ");
    }
}
