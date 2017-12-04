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

class Payroll_Hrm extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_hrm';
	
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

    public static function dtList()
    {
        return DB::SELECT("SELECT ph.*,ei.emp_name,ei.rab_id,ei.personal_no,r.rank_short_name,ps.pay_scale_name
        FROM `payroll_hrm` ph
        inner join employees_info ei on(ei.emp_id=ph.`emp_id`)
        inner join ranks r on(r.id=ei.rank_id)
        inner join payroll_pay_scales ps on(ps.id=ph.pay_scale_id)
        where ph.`deleted_at` is null
        and ei.`deleted_at` is null
        and ps.`deleted_at` is null
        order by ph.id desc");
    }

}
