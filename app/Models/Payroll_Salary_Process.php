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

class Payroll_Salary_Process extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_salary_process';
	
	protected $hidden = [];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public $timestamps = true;

	public static function boot() {
        parent::boot();

        static::saving(function($model){
            foreach ($model->attributes as $key => $value) {
                if($value !== 0) {
                $model->{$key} = empty($value) ? null : $value;
                }
            }
        });
    }

    public static function posting_record_list($battalion_id,$wing_id=null,$branch_id=null,$sub_branch_id=null,$section_id=null,$sub_section_id=null)
    {

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

        $posting_record=DB::SELECT("SELECT pr.`posting_rec_id`,pr.emp_id
        FROM `vw_present_employee_location` pr
        inner join payroll_hrm ph oN(ph.emp_id=pr.emp_id)
        where ph.deleted_at is null
        $v_query
        group by pr.posting_rec_id
        ");

        return $posting_record;


    }


    public static function salary_process_info($id,$salary_date,$salary_end_date)
    {
        return DB::SELECT("SELECT phd.id,phd.`payroll_allowance_id`,phd.`payroll_deduction_id`,
            phd.`payroll_type`,phd.`effective_from_date`,phd.`effective_to_date`,

            pa.type as allowance_type,pa.payroll_head_id as allowance_payroll_head_id,
            pa.salary_head_id as allowance_salary_head_id ,pa.allowance_amount,pa.allowance_max_amount,
            pa.allowance_min_amount,pa.time_interval as allowance_time_interval,

            pd.type as deduction_type,pd.payroll_head_id as deduction_payroll_head_id,
            pd.salary_head_id as deduction_salary_head_id ,pd.deduction_amount,pd.deduction_max_amount,
            pd.deduction_min_amount,pd.time_interval as deduction_time_interval

            FROM `payroll_hrm_details` phd
            left join payroll_allowances pa on(pa.id=phd.`payroll_allowance_id`)
            left join payroll_deductions pd on(pd.id=phd.`payroll_deduction_id`)
            WHERE phd.`payroll_hrm_id`=$id
            and phd.id not in(SELECT id FROM `payroll_hrm_details` 
            WHERE `payroll_hrm_id`='$id'
            and `effective_to_date`<'$salary_date'
            and `deleted_at` is null)

            and phd.id not in(SELECT id FROM `payroll_hrm_details` 
            WHERE `payroll_hrm_id`='$id'
            and `effective_from_date`>'$salary_end_date'
            and `deleted_at` is null)

            and phd.status='1'
            and phd.`deleted_at` is null
            and pa.`deleted_at` is null
            and pd.`deleted_at` is null
            order by pa.payroll_head_id asc,pd.payroll_head_id asc");
    }

    public static function dt_info()
    {
        if(Session::get('user_level')<2)
        {
            $v_query=NULL;
        }
        else
        {
           $v_query=CommonHelper::org_wise_filter(); 
        }
        return DB::SELECT("SELECT psp.*,ei.emp_name,ei.rab_id,ei.personal_no,r.rank_short_name
        FROM `payroll_salary_process` psp
        inner join  posting_record pr on(pr.`posting_rec_id`=psp.`posting_rec_id`)
        inner join employees_info ei on(ei.emp_id=pr.emp_id)
        inner join ranks r on(r.id=ei.rank_id)
        WHERE psp.deleted_at is null
        and pr.deleted_at is null
        and ei.deleted_at is null
        and r.deleted_at is null
        $v_query
        order by psp.salary_date desc
        ");
    }

    //....................Pay Scale Start................
    public static function pay_scale_salary_process_info($id)
    {
        $result=DB::SELECT("SELECT psp.*,ei.emp_name,ei.rab_id,ei.personal_no,r.rank_short_name,
        b.battalion_name,w.wing_name,br.branch_name,
        sb.sb_name,s.section_name,ss.sub_section_name
        FROM `payroll_salary_process` psp
        inner join posting_record pr on(pr.`posting_rec_id`=psp.`posting_rec_id`)
        inner join employees_info ei on(ei.emp_id=pr.emp_id)
        inner join ranks r on(r.id=ei.rank_id)

        inner join battalions b on(b.id=pr.battalion_id)
        left join wings w on(w.id=pr.wing_id)
        left join branches br on(br.id=pr.branch_id)
        left join sub_branches sb on(sb.id=pr.sub_branch_id)
        left join sections s on(s.id=pr.section_id)
        left join sub_sections ss on(ss.id=pr.sub_section_id)

        WHERE psp.`id`='$id'
        and psp.deleted_at is null
        and pr.deleted_at is null
        and ei.deleted_at is null
        and r.deleted_at is null
        
        and b.deleted_at is null
        and w.deleted_at is null
        and br.deleted_at is null
        and sb.deleted_at is null
        and s.deleted_at is null
        and ss.deleted_at is null
        ");
        if(!empty($result))
        {
            return $result[0];
        }
    }
    public static function earnings($id)
    {
        return DB::SELECT("SELECT * from
            (SELECT pspd.*,ps.pay_scale_name,pa.allowance_name,ph.name as payroll_head_name,ph_pay_scale.name as pay_scale_head_name,phrm.basic_salary
            FROM  `payroll_salary_process_details` pspd
            inner join payroll_hrm phrm on(phrm.id=pspd.payroll_hrm_id)
            left join payroll_pay_scales ps on(ps.id=pspd.pay_scale_id)
            left join payroll_heads ph_pay_scale on(ph_pay_scale.id=ps.payroll_head_id)
            LEFT JOIN payroll_allowances pa ON ( pa.id = pspd.allowance_id ) 
            left join payroll_heads ph on(ph.id=pa.payroll_head_id)
            WHERE pspd.`salary_process_id` =  '$id'
            and pspd.deleted_at is null
            and ps.deleted_at is null
            and pa.deleted_at is null
            and ph.deleted_at is null
            and phrm.deleted_at is null
            ) a
            where a.`process_type` =  '3'
            OR a.`process_type` =  '1'
            order by a.payroll_hrm_id asc,a.amount desc");
    }
    public static function deductions($id)
    {
        return DB::SELECT("SELECT pspd.*,pd.deduction_name,ph.name as payroll_head_name
            FROM  `payroll_salary_process_details` pspd
            LEFT JOIN payroll_deductions pd ON ( pd.id = pspd.deduction_id ) 
            left join payroll_heads ph on(ph.id=pd.payroll_head_id)
            WHERE pspd.`salary_process_id` =  '$id'
            AND pspd.`process_type` =  '2'
            and pspd.deleted_at is null
            and pd.deleted_at is null
            and ph.deleted_at is null
            order by pspd.payroll_hrm_id asc");
    }
    //....................Pay Scale End................


}
