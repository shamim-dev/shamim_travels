@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Daily Attendences"))
@section("contentheader_description", trans("messages.Daily Attendences listing"))
@section("section", trans("messages.Daily Attendences"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Daily Attendences listing"))

@section("headerElems")
@la_access("Daily_Attendences", "create")
	{!! Form::open(['action' => 'LA\Daily_AttendencesController@store','id'=>'form_attandance_id']) !!}
		<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">@lang("messages.Add Daily Attendence")</button>
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

		<table class="table table-bordered">
		<thead>
		<tr class="success">
			<th>@lang('messages.Serial No.')</th>
			<th>@lang('messages.RAB ID')</th>
			<th>@lang('messages.Personal No.')</th>
			<th>@lang('messages.Name')</th>
			<th>@lang('messages.Rank')</th>
			<th>@lang('messages.Date')</th>
			<th>@lang('messages.Status')</th>
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@php
				$i=0;
			@endphp
			@foreach($values as $key=>$value)
			
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->rab_id }}</td>
				<td>{{ $value->personal_no }}</td>
				<td>{{ $value->emp_name }}</td>
				<td>{{ $value->rank_short_name }}</td>
				<td>{{ $value->attend_date_format }}</td>
				<td>{{ $value->attend_status }}</td>
				<td>
					@if($value->attend_status_id<3)
					<input type="hidden" name="absent_field[{{ $i }}][emp_id]" value="{{ $value->emp_id }}">
					<label>
					
					<input type="checkbox" name="absent_field[{{ $i }}][absent]" value="2"
					onchange="on_check_form_submit()" 
					@if($value->attend_status_id==2)
						checked="checked"
					@endif
					> Absent</label>
					@endif
				</td>
			</tr>
			
			@php
				$i++;
			@endphp
			@endforeach
		</tbody>
		</table>
	</div>
</div>

{!! Form::close() !!}

@la_access("Daily_Attendences", "create")

@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
    $("#example1").DataTable({
		responsive:false
	});
	$("#daily_attendence-add-form").validate({
		
	});
});
function on_check_form_submit()
{
	$("#form_attandance_id").submit();
}
</script>
@endpush
