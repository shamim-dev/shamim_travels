@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Agent"))
@section("contentheader_description", trans("messages.Agent listing"))
@section("section", trans("messages.Agent"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Agent"))

@section("headerElems")
@la_access("Agent_Info", "create")
	<a href="{{ url(config('laraadmin.adminRoute') . '/agent_info/create') }}" class="btn btn-success btn-sm pull-right">@lang("messages.Add Agent")</a>
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
			<th>@lang('messages.agent_name')</th>
			<th>@lang('messages.mobile_no')</th>
			<th>@lang('messages.email')</th>
			<th>@lang('messages.address')</th>
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@if(!empty($values))
				@foreach($values as $key=>$value)
				<tr>
					<td>{{ ++$key }}</td>
					<td>{{ $value->agent_name }}</td>
					<td>{{ $value->first_mobile_no }} @if(!empty($value->second_mobile_no)) {{ ', '.$value->second_mobile_no }} @endif</td>
					<td>{{ $value->first_email }} @if(!empty($value->second_email)) {{ ', '.$value->second_email }} @endif</td>
					<td>{{ $value->address }}</td>

					<td>
						
						@la_access("Agent_Info", "edit")
						<a href="{{ url(config('laraadmin.adminRoute') .'/agent_info/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
						@endla_access
						<a href="{{ url(config('laraadmin.adminRoute') .'/agent_info/'.$value->id) }}" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>

						@la_access("Agent_Info", "delete")
						{!! Form::open(['action' => ['Travels\AgentController@destroy',$value->id],'method' => 'delete','style'=>'display:inline']) !!}
						<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
						{!! Form::close() !!}
						@endla_access						

					</td>
				</tr>
				@endforeach
			@endif
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
	    columnDefs: [ { orderable: false, targets: [-1] }]
	} );
});
</script>
@endpush
