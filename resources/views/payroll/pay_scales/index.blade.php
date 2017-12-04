@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Pay Scales"))
@section("contentheader_description", trans("messages.Pay Scales listing"))
@section("section", trans("messages.Pay Scales"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Pay Scales listing"))

@section("headerElems")
@la_access("Pay_Scales", "create")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll/pay_scales/create') }}" class="btn btn-success btn-sm pull-right">@lang("messages.Add Pay Scales")</a>
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
			<th>@lang('messages.Pay Scale Name')</th>
			<th>@lang('messages.Pay Scale Amounts')</th>
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		
		</thead>
		<tbody>
			@foreach($values as $key=>$value)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->pay_scale_name or null }}</td>
				<td><b>{{ $value->pay_scale_amounts or null }}</b></td>
				<td>
					@la_access("Pay_Scales", "edit")
					<a href="{{ url(config('laraadmin.adminRoute') .'/payroll/pay_scales/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
					@endla_access
					@la_access("Pay_Scales", "delete")
					{!! Form::open(['action' => ['Payroll\Pay_ScalesController@destroy',$value->id],'method' => 'delete','style'=>'display:inline']) !!}
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
