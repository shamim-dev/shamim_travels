<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentInfo extends Model
{
    use SoftDeletes;
	
	protected $table = 'agent_info';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public static function dtList(){

		$agent_info = DB::SELECT("SELECT * FROM agent_info WHERE deleted_at is null");
		return $agent_info;
    }
}
