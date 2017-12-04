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

class Payroll_Hrm_Detail extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_hrm_details';
	
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

    public static function payroll_hrm_detail_infos($id)
    {
        return DB::SELECT("SELECT * FROM `payroll_hrm_details` phd
        WHERE phd.`payroll_hrm_id`=$id
        and phd.`deleted_at` is null");
    }


}
