
@extends("la.layouts.app")


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/vehicle/vehicle_damage') }}">@lang('messages.Back To List')</a>
@endsection
@section("main-content")
<div class="box box-success">
	<div class="box-header">
	</div>
	
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="receive_voucher_no">@lang('messages.reference_no')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $vehicle_damage_info->reference_no or null }}
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="receive_voucher_no">@lang('messages.Date')*</label>
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
		               <?php 
		                if(isset($vehicle_damage_info->damage_date)){
		                	echo App\Helpers\CommonHelper::showDateFormat($vehicle_damage_info->damage_date);
		                }?>
		            </div>
	            </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="item_id">@lang('messages.committe_members')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $vehicle_damage_info->committee_members or null }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="damage_reason">@lang('messages.damage_reason')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $vehicle_damage_info->damage_reason or null }}
				</div>
			</div>
		</div>
	</div>

	<table class="table table-bordered">
		<thead>
			<tr class="success">
				<th>@lang('messages.Serial No.')</th>
				<th>@lang('messages.Vehicle')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($damage_vehicle as $key=>$vehicle)	
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $vehicle->chassis_no }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection




