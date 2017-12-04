<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Payroll_Head extends Model
{
    use SoftDeletes;
	
	protected $table = 'payroll_heads';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public static function salary_head_dropdown()
	{
		return DB::SELECT("SELECT id,`name` 
		FROM `payroll_heads` 
		WHERE `salary_head`='1'
		and `deleted_at` is null");
	}
	public static function payroll_allowance_heads()
	{
		return DB::SELECT("SELECT id,CONCAT('* ',code,' ',name) as `name` 
		FROM `payroll_heads` 
		WHERE `payroll_type` ='1' || `payroll_type` ='4'
		and `deleted_at` is null");
	}
	public static function payroll_deduction_heads()
	{
		return DB::SELECT("SELECT id,CONCAT('** ',code,' ',name) as `name` 
		FROM `payroll_heads` 
		WHERE `payroll_type` ='2' || `payroll_type` ='3'
		and `deleted_at` is null");
	}
}
