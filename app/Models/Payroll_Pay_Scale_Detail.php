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

class Payroll_Pay_Scale_Detail extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_pay_scale_details';
	
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

    public static function payroll_pay_scale_detail($id)
    {
        return DB::SELECT("SELECT * 
        FROM `payroll_pay_scale_details` ppsd
        WHERE ppsd.`pay_scale_id`='$id'
        and ppsd.`deleted_at` is null");
    }

}
