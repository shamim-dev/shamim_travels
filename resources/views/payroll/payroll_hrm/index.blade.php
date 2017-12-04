@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Payroll Hrm"))
@section("contentheader_description", trans("messages.Payroll Hrm listing"))
@section("section", trans("messages.Payroll Hrm"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Payroll Hrm listing"))

@section("headerElems")
@la_access("Payroll_Hrm", "create")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll_hrm/create') }}" class="btn btn-success btn-sm pull-right">@lang("messages.Add Payroll Hrm")</a>
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
			<th>@lang('messages.Pay Scale')</th>
			<th>@lang('messages.Basic Salary')</th>
			<th>@lang('messages.Allowances')</th>
			<th>@lang('messages.Deductions')</th>
			<th>@lang('messages.Effective Date')</th>
			<th>@lang('messages.End Date')</th>
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
				<td>{{ $value->pay_scale_name or null}}</td>
				<td>{{ $value->basic_salary or null}}</td>
				

				<td>
				<?php
				$allowance_info=DB::SELECT("SELECT group_concat(pa.allowance_name) as allowance_name
				FROM  `payroll_hrm_details` phd
				INNER JOIN payroll_allowances pa ON ( pa.id = phd.`payroll_allowance_id` ) 
				WHERE phd.`payroll_hrm_id` =$value->id
				AND phd.`payroll_type` =  '1'
				and phd.deleted_at is null
				and pa.deleted_at is null
				group by phd.`payroll_hrm_id`
				");
				if(!empty($allowance_info))
				{
					$allowance_name=$allowance_info[0];
					if(isset($allowance_name->allowance_name)){
						echo $allowance_name->allowance_name;
					} 
				}
				?></td>

				<td>
				<?php
					$deduction_info=DB::SELECT("SELECT group_concat(pd.deduction_name) as deduction_name
					FROM  `payroll_hrm_details` phd
					INNER JOIN payroll_deductions pd ON ( pd.id = phd.`payroll_deduction_id` ) 
					WHERE phd.`payroll_hrm_id` =$value->id
					AND phd.`payroll_type` =  '2'
					and phd.deleted_at is null
					and pd.deleted_at is null
					group by phd.`payroll_hrm_id`");
					if(!empty($deduction_info))
					{
						$deduction_name=$deduction_info[0];
						if(isset($deduction_name->deduction_name)){
							echo $deduction_name->deduction_name;
						} 
					}
				?>
				</td>

				<td>{{ $value->effective_date or null}}</td>
				<td>{{ $value->end_date or null}}</td>

				<td>
					@if($value->payroll_hrm_status==1)
						@la_access("Payroll_Hrm", "edit")
						<a href="{{ url(config('laraadmin.adminRoute') .'/payroll_hrm/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
						@endla_access
						@la_access("Payroll_Hrm", "delete")
						{!! Form::open(['action' => ['Payroll\Payroll_HrmController@destroy',$value->id],'method' => 'delete','style'=>'display:inline','id'=>"delete-$value->id"]) !!}
						<button class="btn btn-danger btn-xs confirm"><i class="fa fa-times"></i></button>
						{!! Form::close() !!}
						@endla_access
					@endif

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


	// $('.confirm').confirm({
	// 	title: 'Confirm!',
	//     content: "Are you sure to process this ?",
	//     buttons: {
	//         yes: function () {
	//             $( "#delete" ).submit();
	//         },
	//         close: function () {
	//         }
	//     }
	// });

});
</script>
@endpush
