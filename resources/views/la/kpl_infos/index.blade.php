@extends("la.layouts.app")

@section("contentheader_title", trans("messages.KPL Infos"))
@section("contentheader_description", trans("messages.KPL Infos listing"))
@section("section", trans("messages.KPL Infos"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.KPL Infos listing"))

@section("headerElems")
@la_access("KPL_Infos", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">@lang("messages.Add KPL Info")</button>
@endla_access
@endsection

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
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			<th>@lang('messages.Serial No.')</th>
			<th>@lang('messages.Vehicle')</th>
			<th>@lang('messages.Fuel Type')</th>
			<th>@lang('messages.KMPL')</th>
			<th>@lang('messages.Date')</th>
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@foreach($values as $key=>$value)
				<tr>
					<td>{{ ++$key }}</td>
					<td>{{ $value->chassis_no }}</td>
					<td>{{ $value->fuel_type }}</td>
					<td>{{ $value->kpl }}</td>
					<td>
					<?php 
						if(isset($value->kpl_date)){
							echo App\Helpers\CommonHelper::showDateFormat($value->kpl_date);
						}
					?>
					</td>

					<td>
						@la_access("KPL_Infos", "edit")
						<a href="{{ url(config('laraadmin.adminRoute') .'/kpl_infos/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>										
						@endla_access
						@la_access("KPL_Infos", "delete")	
						{!! Form::open(['route' => [config('laraadmin.adminRoute') . '.kpl_infos.destroy', $value->id],'method' => 'delete','style'=>'display:inline']) !!}
						<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
						{!! Form::close() !!}
						@endla_access
					
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>

@la_access("KPL_Infos", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang("messages.Add KPL Info")</h4>
			</div>
			{!! Form::open(['action' => 'LA\KPL_InfosController@store', 'id' => 'kpl_info-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
          {{--
          @la_form($module)					
					@la_input($module, 'vehicle_id')
					--}}
					<div class="form-group">
						<label for="vehicle_id">@lang('messages.Vehicle')<span class="la-required">*</span> :</label>
						<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="vehicle_record_id"
						id="vehicle_record_id" required="" >
						<option value="">@lang('messages.Select')</option>
						@foreach($vehicles as $vehicle)
						<option value="{{ $vehicle->id }}"
						>{{ $vehicle->chassis_no }}</option>
						@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="kpl">@lang('messages.KMPL')<span class="la-required">*</span> :</label>
						<input type="text" name="kpl" class="form-control" id="kpl" placeholder="Enter KPL">
					</div>
					@la_input($module, 'fuel_type_id')
					@la_input($module, 'kpl_date')
					@la_input($module, 'kp_ref')
					@la_input($module, 'member_1')
					@la_input($module, 'member_2')
					@la_input($module, 'chairman')
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.Close')</button>
				{!! Form::submit( Lang::get('messages.Save'), ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$('#example1').DataTable( {
		responsive: false,
		columnDefs: [ { orderable: false, targets: [-1] }],
	} );
	$("#kpl_info-add-form").validate({

	});
});
</script>
@endpush
