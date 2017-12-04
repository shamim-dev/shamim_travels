@extends('la.layouts.app')

@section('htmlheader_title')
	Bank Branch View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
	<div class="bg-success clearfix">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-3">
					<div class="profile-icon text-primary"><i class="fa {{ $module->fa_icon }}"></i></div>
				</div>
				<div class="col-md-9">
					<h4 class="name">{{ $bank_branch->$view_col }}</h4>					
				</div>
			</div>
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-4">			
		</div>
		<!--<div class="col-md-1 actions">
			@la_access("Bank_Branches", "edit")
				<a href="{{ url(config('laraadmin.adminRoute') . '/bank_branches/'.$bank_branch->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			@endla_access
			
			@la_access("Bank_Branches", "delete")
				{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.bank_branches.destroy', $bank_branch->id], 'method' => 'delete', 'style'=>'display:inline']) }}
					<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
				{{ Form::close() }}
			@endla_access
		</div>-->
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/bank_branches') }}" data-toggle="tooltip" data-placement="right" title="Back to Bank Branches"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>		
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'bank_branch_name')
						@la_display($module, 'bank_id')
						@la_display($module, 'bank_branch_address')
						@la_display($module, 'bank_branch_cell')
						@la_display($module, 'bank_branch_mobile')
						@la_display($module, 'bank_branch_email')
					</div>
				</div>
			</div>
		</div>		
	</div>
	</div>
	</div>
</div>
@endsection
