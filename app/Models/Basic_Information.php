<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Basic_Information extends Model
{
    use SoftDeletes;
	
	protected $table = 'basic_informations';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public static function get_basic_info_by_id($id)
	{
		$basicinfo = DB::table('basic_informations')
							->leftJoin('employees_info', 'basic_informations.emp_id', '=', 'employees_info.emp_id')
				            ->leftJoin('districts', 'basic_informations.birth_place', '=', 'districts.id')
				            ->leftJoin('uploads', 'basic_informations.photo', '=', 'uploads.id')
				            ->where('basic_informations.id', $id)
				            ->select('basic_informations.*', 'employees_info.rab_id', 'employees_info.emp_name', 'uploads.name', 'uploads.hash', 'districts.dis_name')
				            ->first();
		return $basicinfo;
	}
}
