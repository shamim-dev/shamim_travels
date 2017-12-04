<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\CommonHelper;
use Session;
use DB;
class Daily_Attendence extends Model
{
    use SoftDeletes;
	
	protected $table = 'daily_attendences';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];
	public $timestamps = true;

	protected $dates = ['deleted_at'];
	
	public static function dt_after_posting_in_rab()
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
        return DB::SELECT("SELECT * 
			FROM (
			SELECT ei.`emp_id` , ei.`rab_id` , ei.personal_no, ei.emp_name, r.rank_short_name, DATE_FORMAT( da.date,  '%d/%m/%Y' ) AS attend_date_format,ats.attend_status,da.attend_status_id
			FROM  `daily_attendences` da
			INNER JOIN attendence_statuses ats ON (ats.id = da.attend_status_id ) 
			INNER JOIN employees_info ei ON ( ei.emp_id = da.`emp_id` )
			LEFT JOIN ranks r ON (ei.rank_id = r.id)
			INNER JOIN posting_record pr ON ( ei.`posting_rec_id` = pr.`posting_rec_id` ) 
			WHERE ei.`joining_date` IS NOT NULL 
			AND ei.`release_date` IS NULL 
			AND ei.`deleted_at` IS NULL 
			AND r.deleted_at IS NULL
			AND pr.is_joined =  '1'
			AND pr.`deleted_at` IS NULL
			and da.`date` =CURDATE()
			$v_query
			UNION 
			SELECT ei.`emp_id` , ei.`rab_id` , ei.personal_no, ei.emp_name, r.rank_short_name, NULL AS attend_date_format,Null as attend_status,null as attend_status_id
			FROM  `employees_info` ei
			LEFT JOIN ranks r ON (ei.rank_id = r.id)
			INNER JOIN posting_record pr ON ( ei.`posting_rec_id` = pr.`posting_rec_id` ) 
			WHERE ei.`joining_date` IS NOT NULL 
			AND ei.`release_date` IS NULL 
			AND ei.`deleted_at` IS NULL
			AND r.deleted_at IS NULL 
			AND pr.is_joined =  '1'
			AND pr.`deleted_at` IS NULL
			$v_query
			)a
			GROUP BY a.`emp_id` 
			ORDER BY  `emp_id` DESC
        ");

        

    }
}
