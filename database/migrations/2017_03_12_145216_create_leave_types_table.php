<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This Module has been deleted.
        // You can remove this file after migrate:reset
        
		if (Schema::hasTable('leave_types')) {
            Schema::drop('leave_types');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('leave_types')) {
            Schema::drop('leave_types');
        }
    }
}
