@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Salary Process"))
@section("contentheader_description", trans("messages.Salary Process listing"))
@section("section", trans("messages.Salary Process"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Salary Process listing"))

@section("headerElems")
@la_access("Salary_Process", "create")
	<!-- <a href="{{ url(config('laraadmin.adminRoute') .'/salary_process/1/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;">Test</a> -->


	<a href="{{ url(config('laraadmin.adminRoute') . '/salary_process/create') }}" class="btn btn-success btn-sm pull-right">@lang("messages.Process")</a>
@endla_access
@endsection

@section("main-content")

@if(session()->has('message'))
	<div class="alert alert-success alert-dismissable">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>{{ session()->get('message') }}</strong>
	</div>
@endif

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
			<th>@lang('messages.RAB ID')</th>
			<th>@lang('messages.Personal No.')</th>
			<th>@lang('messages.Name')</th>
			<th>@lang('messages.Rank')</th>
			<th>@lang('messages.Salary Date')</th>
			<th>@lang('messages.Total Salary')</th>

			


			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		
		</thead>
		<tbody>
			@foreach($values as $key=>$value)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->rab_id or null}}</td>
				<td>{{ $value->personal_no or null}}</td>
				<td>{{ $value->emp_name or null}}</td>
				<td>{{ $value->rank_short_name or null}}</td>
				<td><?php 
					if(isset($value->salary_date)){
						echo App\Helpers\CommonHelper::showDateFormat($value->salary_date);
					}?></td>
				<td>{{ $value->salary_amount or null}}</td>

				<td>
					<a href="{{ url(config('laraadmin.adminRoute') .'/salary_process/'.$value->id) }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;" target="_blank">@lang('messages.Pay Slip')</a>

					<a href="#" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;" target="_blank">@lang('messages.Reprocess')</a>

				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>

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
});
</script>
@endpush
