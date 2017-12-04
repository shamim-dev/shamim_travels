@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/daily_attendences') }}">@lang('messages.Daily Attendence')</a> :
@endsection
@section("contentheader_description", $daily_attendence->$view_col)
@section("section", trans("messages.Daily Attendences"))
@section("section_url", url(config('laraadmin.adminRoute') . '/daily_attendences'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Daily Attendences Edit : ".$daily_attendence->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			
				{!! Form::model($daily_attendence, ['route' => [config('laraadmin.adminRoute') . '.daily_attendences.update', $daily_attendence->id ], 'method'=>'PUT', 'id' => 'daily_attendence-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					{{-- @la_edit_input($module, 'emp_id') --}}
					<div class="col-md-2">
						<div class="form-group">
						<label for="emp_id">RAB ID* :</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select name="emp_id" rel="select2" data-placeholder="Enter RAB ID" class="form-control">
							@foreach($employees as $employee)
			        		<option value="{{ $employee->emp_id }}"
			        			@if(isset($daily_attendence->emp_id))
				        			@if($daily_attendence->emp_id==$employee->emp_id)
				        				selected="selected"
				        			@endif
				        		@endif
				        		 >{{ $employee->rab_id }}</option>
				        	@endforeach	
							</select>
						</div>
					</div>
					@la_edit_input($module, 'date')
					@la_edit_input($module, 'in_time')
					@la_edit_input($module, 'out_time')
					@la_edit_input($module, 'attend_status')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/daily_attendences') }}">@lang('messages.Cancel')</a></button>
					</div>
					</div>
				{!! Form::close() !!}
			
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#daily_attendence-edit-form").validate({
		
	});
});
</script>
@endpush
