@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/basic_informations') }}">@lang('messages.Basic Information')</a> :
@endsection
@section("contentheader_description", $basic_information->$view_col)
@section("section", trans("messages.Basic Informations"))
@section("section_url", url(config('laraadmin.adminRoute') . '/basic_informations'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Basic Informations Edit : ".$basic_information->$view_col)

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
		<!-- <div class="row"> -->
			
				{!! Form::model($basic_information, ['route' => [config('laraadmin.adminRoute') . '.basic_informations.update', $basic_information->id ], 'method'=>'PUT', 'id' => 'basic_information-edit-form']) !!}
					<div class="row">
						<div class="col-md-2">
							<label for="emp_id">@lang('messages.RAB ID')*</label>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id" id="emp_id" disabled="">
					        	<option value="">@lang('messages.Select')</option>
					        	@foreach($employees as $employee)
					        		<option value="{{ $employee->emp_id }}"
					        		@if(isset($basic_information->emp_id))
					        			@if($basic_information->emp_id==$employee->emp_id)
					        			selected="selected"
					        			@endif
					        		@endif 
					        		 >{{ $employee->rab_id }}</option>
					        	@endforeach	
					        	</select>
							</div>
						</div>
						<div class="col-md-1">
							<label for="emp_name">@lang('messages.Name')</label>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="text" name="emp_name" class="form-control" id="emp_name" placeholder="@lang('messages.Name')" value="{{ $show_info->emp_name }}" disabled="">
							</div>
						</div>
						<div class="col-md-1">
							<label for="bn_name">@lang('messages.English Name')</label>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="text" name="bn_name" class="form-control" id="bn_name" placeholder="@lang('messages.English Name')" value="{{ $show_info->bn_name }}">
							</div>
						</div>
					</div>

					<div class="row">
						@la_edit_input($module, 'dob')
						@la_edit_input($module, 'birth_place')
					</div>

					<div class="row">
						@la_edit_input($module, 'gender')
						@la_edit_input($module, 'religion')
						
					</div>

					<div class="row">
						@la_edit_input($module, 'marital_status')
						@la_edit_input($module, 'nationality')
					</div>

					<div class="row">
						@la_edit_input($module, 'height')
						@la_edit_input($module, 'weight')
					</div>

					<div class="row">
						@la_edit_input($module, 'blood_group')
						<!-- <div class="form-group">
							<label for="blood_group">@lang('messages.Blood Group')*:</label>
							<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="blood_group" id="blood_group">
				        	<option value="">@lang('messages.Select')</option>
			        		<option value="O+">O+</option>
							<option value="O-">O-</option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
				        	</select>
						</div> -->
						@la_edit_input($module, 'national_id')
					</div>

					<div class="row">
						@la_edit_input($module, 'passport_no')
						@la_edit_input($module, 'id_card_no')
					</div>

					<div class="row">
						@la_edit_input($module, 'punch_card_no')
						@la_edit_input($module, 'driving_license')
					</div>

					<div class="row">
						@la_edit_input($module, 'job_join_date')
						@la_edit_input($module, 'tribal')
					</div>

					<div class="row">
						@la_edit_input($module, 'freedom_fighter')
						@la_edit_input($module, 'tel_ofc')
					</div>

					<div class="row">
						@la_edit_input($module, 'tel_home')
						@la_edit_input($module, 'cell_ofc')
					</div>

					<div class="row">
						@la_edit_input($module, 'cell_personal_1')
						@la_edit_input($module, 'cell_personal_2')
					</div>

					<div class="row">
						@la_edit_input($module, 'fax_ofc')
						@la_edit_input($module, 'fax_home')
					</div>

					<div class="row">
						@la_edit_input($module, 'email_ofc')
						@la_edit_input($module, 'email_personal')
					</div>

					<div class="row">
						@la_edit_input($module, 'pabx')
						@la_edit_input($module, 'hoby')
					</div>
					<div class="row">

						<div class="col-md-2">
							<div class="form-group">
								<label for="academy_course_id">@lang('messages.Academy Course'):</label>
							</div>
						</div>		
						<div class="col-md-4">
							<div class="form-group">
								<select class="form-control" rel="select2" name="academy_course_id"
					        	id="academy_course_id">
					        	<option value="">@lang('messages.Select')</option>
					        	@foreach($academy_courses as $academy_course)
					        		<option value="{{ $academy_course->id }}"
					        		@if(isset($basic_information->emp_id))
					        			@if($basic_information->academy_course_id==$academy_course->id)
					        			selected="selected"
					        			@endif
					        		@endif					        		 
					        		 >{{ $academy_course->academy_course_name }}</option>
					        	@endforeach	
					        	</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								@la_edit_input($module, 'photo')
							</div>
						</div>
					</div>

					<div class="row">
	                    <div class="col-md-12">
							<div class="form-group">
								{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/basic_informations') }}">@lang('messages.Cancel')</a></button>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			
		<!-- </div> -->
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#basic_information-edit-form").validate({
		
	});
});
</script>
@endpush
