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

class Payroll_Policy_Detail extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_policy_details';
	
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

    public static function policy_detail($id)
    {
        return DB::SELECT("SELECT * FROM `payroll_policy_details`
        WHERE `deleted_at` is null
        and policy_id='$id'");
    }

}
