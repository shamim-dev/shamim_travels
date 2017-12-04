@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/increment_infos') }}">@lang('messages.Increment Info')</a> :
@endsection
@section("contentheader_description", $increment_info->$view_col)
@section("section", trans("messages.Increment Infos"))
@section("section_url", url(config('laraadmin.adminRoute') . '/increment_infos'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Increment Infos Edit : ".$increment_info->$view_col)

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
			
				{!! Form::model($increment_info, ['route' => [config('laraadmin.adminRoute') . '.increment_infos.update', $increment_info->id ], 'method'=>'PUT', 'id' => 'increment_info-edit-form']) !!}
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
			        			@if(isset($increment_info->emp_id))
				        			@if($increment_info->emp_id==$employee->emp_id)
				        				selected="selected"
				        			@endif
				        		@endif
				        		 >{{ $employee->rab_id }}</option>
				        	@endforeach	
							</select>
						</div>
					</div>
					@la_edit_input($module, 'increment_type')
					@la_edit_input($module, 'increment_date')
					
                    <div class="col-md-12">
						<div class="form-group">
							{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/increment_infos') }}">Cancel</a></button>
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
	$("#increment_info-edit-form").validate({
		
	});
});
</script>
@endpush
