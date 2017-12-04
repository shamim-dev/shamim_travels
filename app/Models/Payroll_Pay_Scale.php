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

class Payroll_Pay_Scale extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_pay_scales';
	
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
    public static function payroll_pay_scale_list()
    {
        return DB::SELECT("select * from
        (
        SELECT pps.*,GROUP_CONCAT(ppsd.pay_scale_amount ORDER BY ppsd.pay_scale_amount ASC) as pay_scale_amounts
        FROM  `payroll_pay_scales` pps
        INNER JOIN payroll_pay_scale_details ppsd ON ( ppsd.pay_scale_id = pps.id ) 
        WHERE pps.`deleted_at` IS NULL 
        AND ppsd.`deleted_at` IS NULL 
        GROUP BY pps.id
        ) a
        order by a.id desc");
    }

}
