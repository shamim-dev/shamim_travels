@extends('la.layouts.app')

@section('htmlheader_title')
	District View
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
					<h4 class="name">{{ $district->$view_col }}</h4>					
				</div>
			</div>
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-4">			
		</div>
		<!--<div class="col-md-1 actions">
			@la_access("Districts", "edit")
				<a href="{{ url(config('laraadmin.adminRoute') . '/districts/'.$district->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			@endla_access
			
			@la_access("Districts", "delete")
				{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.districts.destroy', $district->id], 'method' => 'delete', 'style'=>'display:inline']) }}
					<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
				{{ Form::close() }}
			@endla_access
		</div>-->
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/districts') }}" data-toggle="tooltip" data-placement="right" title="Back to Districts"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> @lang('messages.General Info')</a></li>		
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>@lang('messages.General Info')</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'division_id')
						@la_display($module, 'dis_name')
					</div>
				</div>
			</div>
		</div>		
	</div>
	</div>
	</div>
</div>
@endsection
