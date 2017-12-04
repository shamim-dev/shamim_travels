@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/kpl_infos') }}">@lang('messages.KPL Info')</a> :
@endsection
@section("contentheader_description", $kpl_info->$view_col)
@section("section", trans("messages.KPL Infos"))
@section("section_url", url(config('laraadmin.adminRoute') . '/kpl_infos'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "KPL Infos Edit : ".$kpl_info->$view_col)

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

<?php
// echo "<pre>"; print_r($kpl_info);
?>
<div class="box box-success">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			
				{!! Form::model($kpl_info, ['route' => [config('laraadmin.adminRoute') . '.kpl_infos.update', $kpl_info->id ], 'method'=>'PUT', 'id' => 'kpl_info-edit-form']) !!}
					{{--
					@la_form($module)
					@la_edit_input($module, 'vehicle_id')
					--}}

					<div class="col-md-2">
						<div class="form-group">
							<label for="vehicle_id">@lang('messages.Vehicle')<span class="la-required">*</span> :</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="vehicle_record_id"
							id="vehicle_record_id" required="" >
							<option value="">@lang('messages.Select')</option>
							@foreach($vehicles as $vehicle)
							<option value="{{ $vehicle->id }}"
							@if(isset($kpl_info->vehicle_record_id))
							@if($kpl_info->vehicle_record_id == $vehicle->id)
							selected="selected"
							@endif
							@endif
							>{{ $vehicle->chassis_no }}</option>
							@endforeach	
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="kpl">@lang('messages.KMPL')</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" name="kpl" class="form-control" id="kpl" placeholder="@lang('messages.Name')" value="{{ $kpl_info->kpl }}">
						</div>
					</div>
					@la_edit_input($module, 'fuel_type_id')
					@la_edit_input($module, 'kpl_date')
					@la_edit_input($module, 'kp_ref')
					@la_edit_input($module, 'member_1')
					@la_edit_input($module, 'member_2')
					@la_edit_input($module, 'chairman')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/kpl_infos') }}">@lang('messages.Cancel')</a></button>
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
	$("#kpl_info-edit-form").validate({
		
	});
});
</script>
@endpush
