<?php
/* ================== Language ================== */
Route::get('language/{locale}','LA\DashboardController@language');

/* ================== Homepage ================== */
Route::get('/', 'LA\DashboardController@index');

/* ================== Homepage ================== */
Route::get('/session_info', 'LA\DashboardController@session_info');

//Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');


/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';

	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth','locale','revalidate']], function () {

	/* ================== Common controller ================== */
	Route::post(config('laraadmin.adminRoute'). '/common_dropdown', 'CommonController@common_dropdown');
	Route::post(config('laraadmin.adminRoute'). '/common_dynamic_load_dropdown', 'CommonController@common_dynamic_load_dropdown');
	Route::post(config('laraadmin.adminRoute'). '/common_dynamic_load_dropdown_from_date_to_to_date','CommonController@common_dynamic_load_dropdown_from_date_to_to_date');

	Route::post(config('laraadmin.adminRoute'). '/get_emp_info', 'CommonController@get_emp_info');
		/* ================== Parent menu to sub menu ================== */
	Route::get(config('laraadmin.adminRoute'). '/module/{id}', 'LA\DashboardController@module');
	/* ================== Dashboard ================== */
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');

	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');

	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');

	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');

	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Countries ================== */
	Route::resource(config('laraadmin.adminRoute') . '/countries', 'LA\CountriesController');
	Route::get(config('laraadmin.adminRoute') . '/country_dt_ajax', 'LA\CountriesController@dtajax');
	
	/* ================== Divisions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/divisions', 'LA\DivisionsController');
	Route::get(config('laraadmin.adminRoute') . '/division_dt_ajax', 'LA\DivisionsController@dtajax');

	/* ================== Districts ================== */
	Route::resource(config('laraadmin.adminRoute') . '/districts', 'LA\DistrictsController');
	Route::get(config('laraadmin.adminRoute') . '/district_dt_ajax', 'LA\DistrictsController@dtajax');

	/* ================== Upazillas ================== */
	Route::resource(config('laraadmin.adminRoute') . '/upazillas', 'LA\UpazillasController');
	Route::get(config('laraadmin.adminRoute') . '/upazilla_dt_ajax', 'LA\UpazillasController@dtajax');


	/* ================== Role_Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/role_users', 'LA\Role_UsersController');
	Route::get(config('laraadmin.adminRoute') . '/role_user_dt_ajax', 'LA\Role_UsersController@dtajax');

	/* ================== Menu_Pemissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/menu_permissions', 'Configuration\MenuPermissionController@index');
	Route::post(config('laraadmin.adminRoute') . '/store_role_permission', 'Configuration\MenuPermissionController@store');
	Route::post(config('laraadmin.adminRoute') . '/edit_role_permissions', 'Configuration\MenuPermissionController@action');

	/* ================== Designations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/designations', 'LA\DesignationsController');
	Route::get(config('laraadmin.adminRoute') . '/designation_dt_ajax', 'LA\DesignationsController@dtajax');
	
	/* ================== Banks ================== */
	Route::resource(config('laraadmin.adminRoute') . '/banks', 'LA\BanksController');
	Route::get(config('laraadmin.adminRoute') . '/bank_dt_ajax', 'LA\BanksController@dtajax');

	/* ================== Bank_Branches ================== */
	Route::resource(config('laraadmin.adminRoute') . '/bank_branches', 'LA\Bank_BranchesController');
	Route::get(config('laraadmin.adminRoute') . '/bank_branch_dt_ajax', 'LA\Bank_BranchesController@dtajax');

	/* ================== Agents ================== */
	Route::resource(config('laraadmin.adminRoute') . '/agent_info', 'Travels\AgentController');
	Route::get(config('laraadmin.adminRoute') . '/agent_dt_ajax', 'Travels\AgentController@dtajax');


});
