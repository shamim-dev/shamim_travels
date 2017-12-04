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

class Payroll_Deduction extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_deductions';
	
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

    public static function payroll_deduction_list()
    {
        return DB::SELECT("SELECT pa.*,ph.name as payroll_head_name,phs.allowance_name as salary_head_name,
        case
        when pa.`type`='1' then 'Fixed'
        when pa.`type`='2' then 'Percentage'
        end as payroll_deduction_type,
        case
        when pa.`time_interval`='1' then 'Monthly'
        when pa.`time_interval`='2' then 'Daily'
        when pa.`time_interval`='3' then 'Weekly'
        when pa.`time_interval`='4' then 'Quarterly'
        end as payroll_deduction_interval

        FROM `payroll_deductions` pa
        inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
        left join  payroll_allowances phs on(phs.id=pa.`salary_head_id`)
        WHERE pa.`deleted_at` is null
        order by pa.id desc
        ");
    }

    public static function salary_heads()
    {
        return DB::SELECT("SELECT 0 AS id, 'মূল বেতন' AS allowance_name
        union
        SELECT id,`allowance_name` FROM `payroll_allowances` WHERE `deleted_at` is null
        ");
    }

}
