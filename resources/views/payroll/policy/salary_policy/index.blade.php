@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Salary Policy"))
@section("contentheader_description", trans("messages.Salary Policy listing"))
@section("section", trans("messages.Salary Policy"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Salary Policy listing"))

@section("headerElems")
@la_access("Salary_Policy", "create")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll/salary_policy/create') }}" class="btn btn-success btn-sm pull-right">@lang("messages.Add Salary Policy")</a>
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
			<th>@lang('messages.Policy Name')</th>
			<th>@lang('messages.Breakdown')</th>
			<th>@lang('messages.Gross Salary') (Tk.)</th>
			<!-- <th rowspan="2">@lang('messages.View')</th> -->
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		
		</thead>
		<tbody>
			@foreach($values as $key=>$value)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->policy_name or null }}</td>

				<td>
					<?php $breakdowns=DB::SELECT("SELECT ppd.*,ph.name as payroll_head_name,ph1.name as salary_head_name 
						FROM 
					`payroll_policy_details` ppd 
					inner join payroll_heads ph on(ph.id=ppd.payroll_head)
					left join payroll_heads ph1 on(ph1.id=ppd.salary_head)
					WHERE ppd.`policy_id`='$value->id'
					and ppd.`deleted_at` is null
					order by ppd.payroll_head asc")?>

					
					
					<table class="table table-hover">
						
						<tr class="danger">
							<th>Payroll</th>
							<th>Formula</th>
							<th>Tk.</th>
						</tr>
						<?php $gross_salary=0;?>
						@foreach($breakdowns as $breakdown)
						<tr>
							<td>{{ $breakdown->payroll_head_name }}</td>
							<td>{{ $breakdown->salary_head_name }} @if($breakdown->type==2) &#x2716 @endif
							<?php
								if($breakdown->type=='2')
								{
									$tk=DB::SELECT("SELECT ppd.`amount` 
									FROM `payroll_policy_details` ppd
									inner join payroll_policy_details ppd1 on(ppd1.salary_head=ppd.`payroll_head`)
									WHERE ppd.`policy_id`='$value->id'
									and ppd.payroll_head='$breakdown->salary_head'
									and ppd.`deleted_at` is null
									and ppd1.`deleted_at` is null")[0];
									//$amount_tk=($tk->amount*$breakdown->amount)/100;
									echo $breakdown->amount.'%';
								}

								$amount_tk=$breakdown->salary_amount;
								// else
								// {
								// 	$amount_tk=$breakdown->amount;
								// }
							?>
							
							</td>
							<td align="right" style="font-weight: bold"><?php echo number_format($amount_tk,2)?></td>
							<?php $gross_salary=$gross_salary+$amount_tk;?>
						</tr>
						@endforeach
						<tr>
							<td colspan="2" align="center">Total</td>
							<td align="right" style="font-weight: bold"><?php echo number_format($gross_salary,2)?></td>
						</tr>
					</table>
					
					

				</td>

				<td align="right" style="font-weight: bold"><?php echo number_format($gross_salary,2)?></td>

				<td>
					@la_access("Salary_Policy", "edit")
					<a href="{{ url(config('laraadmin.adminRoute') .'/payroll/salary_policy/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
					@endla_access
					@la_access("Salary_Policy", "delete")
					{!! Form::open(['action' => ['Payroll\Salary_PolicyController@destroy',$value->id],'method' => 'delete','style'=>'display:inline']) !!}
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
