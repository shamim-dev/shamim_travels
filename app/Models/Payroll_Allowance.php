<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Payroll_Allowance extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_allowances';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public static function payroll_allowance_list()
	{
		return DB::SELECT("SELECT pa.*,ph.name as payroll_head_name,phs.name as salary_head_name,
		case
		when pa.`type`='1' then 'Fixed'
		when pa.`type`='2' then 'Percentage'
		end as payroll_allowance_type,
		case
		when pa.`time_interval`='1' then 'Monthly'
		when pa.`time_interval`='2' then 'Daily'
		when pa.`time_interval`='3' then 'Weekly'
		when pa.`time_interval`='4' then 'Quarterly'
		end as payroll_allowance_interval

		FROM `payroll_allowances` pa
		inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
		left join  payroll_heads phs on(phs.id=pa.`salary_head_id`)
		WHERE pa.`deleted_at` is null
		order by pa.id desc
		");
	}

}
