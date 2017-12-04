@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Payroll Deductions"))
@section("contentheader_description", trans("messages.Payroll Deductions listing"))
@section("section", trans("messages.Payroll Deductions"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Payroll Deductions listing"))

@section("headerElems")
@la_access("Payroll_Deductions", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">@lang("messages.Add Payroll Deduction")</button>
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
			<th>@lang('messages.Name')</th>
			<th>@lang('messages.Payroll Head')</th>
			<th>@lang('messages.Type')</th>
			<th>@lang('messages.Salary Head')</th>
			<th>@lang('messages.Amount')</th>
			<th>@lang('messages.Maximum Amount')</th>
			<th>@lang('messages.Minimum Amount')</th>
			<th>@lang('messages.Interval')</th>
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@foreach($values as $key=>$value)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->deduction_name }}</td>
				<td>{{ $value->payroll_head_name }}</td>
				<td>{{ $value->payroll_deduction_type }}</td>
				<td>@if(isset($value->salary_head_id) && $value->salary_head_id==0) মূল বেতন @else {{ $value->salary_head_name }} @endif</td>
				<td>{{ $value->deduction_amount }} @if($value->type==2) % @else Tk.@endif</td>
				<td>{{ $value->deduction_max_amount }} Tk.</td>
				<td>{{ $value->deduction_min_amount }} Tk.</td>
				<td>{{ $value->payroll_deduction_interval }}</td>
				<td>
					@la_access("Payroll_Deductions", "edit")
					<a href="{{ url(config('laraadmin.adminRoute') .'/payroll_deductions/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
					@endla_access
					@la_access("Payroll_Deductions", "delete")
					{!! Form::open(['action' => ['Payroll\Payroll_DeductionsController@destroy',$value->id],'method' => 'delete','style'=>'display:inline']) !!}
					<button class="btn btn-danger btn-xs"  style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-times"></i></button>
					{!! Form::close() !!}
					@endla_access
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>

<?php
	$salary_head_options='<option value="">'.Lang::get('messages.Select Salary Heads').'</option>';
	//$salary_head_options.='<option value="0">'.Lang::get('messages.Basic').'</option>';

	$payroll_head_options='<option value="">'.Lang::get('messages.Select Payroll Heads').'</option>';

	foreach($salary_heads as $salary_head){ 
		$salary_head_options.='<option value="'.$salary_head->id.'">'.$salary_head->allowance_name.'</option>';
	}
	foreach($payroll_heads as $payroll_head){ 
		$payroll_head_options.='<option value="'.$payroll_head->id.'">'.$payroll_head->name.'</option>';
	}
	

?>


@la_access("Payroll_Deductions", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang("messages.Add Payroll Deduction")</h4>
			</div>
			{!! Form::open(['action' => 'Payroll\Payroll_DeductionsController@store', 'id' => 'payroll_deduction-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					{{--
                    @la_form($module)
                    @la_input($module, 'salary_head_id')
                    @la_input($module, 'deduction_amount')
                    @la_input($module, 'deduction_max_amount')
					@la_input($module, 'deduction_min_amount')
					@la_input($module, 'deduction_name')
					@la_input($module, 'payroll_head_id')

					--}}
					
					
					<label for="item_id">@lang('messages.Name')<span class="la-required">*</span></label>
					<div class="form-group">
			        	<input class="form-control" type="text" name="deduction_name" placeholder="Enter Name" required="1">
					</div>

					<label for="item_id">@lang('messages.Payroll Heads')<span class="la-required">*</span></label>
					<div class="form-group">
			        	<select class="form-control" rel="select2" id="payroll_head_id" name="payroll_head_id" required="1">
						<?php echo $payroll_head_options;?>
						</select>
					</div>

					<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>
					<div class="form-group">
			        	<select class="form-control" rel="select2" id="type" name="type" required="1" onchange="loadType()">
							<option value="1">@lang('messages.Fixed')</option>
	  						<option value="2">@lang('messages.Percentage')</option>
						</select>
					</div>

					<div id="div-salary-head" style="display: none;">
						<label for="item_id">@lang('messages.Allowances')<span class="la-required">*</span></label>
						<div class="form-group">
				        	<select class="form-control" rel="select2" id="salary_head_id" name="salary_head_id" required="1">
							<?php echo $salary_head_options;?>
							</select>
						</div>
					</div>
					
					


					<label for="item_id">@lang('messages.Amount')&nbsp<span id="span-percenatge" style="display: none;">(%)</span></span><span id="span-tk">(Tk.)</span><span class="la-required">*</span></label>
					<div class="form-group">
			        	<input class="form-control" type="number" name="deduction_amount" min="1" required="1">
					</div>

					<div id="div-max-min" style="display: none;">
						<label for="item_id">@lang('messages.Maximum Amount')</label>
						<div class="form-group">
				        	<input class="form-control" type="number" name="deduction_max_amount" min="0">
						</div>
						<label for="item_id">@lang('messages.Minimum Amount')</label>
						<div class="form-group">
				        	<input class="form-control" type="number" name="deduction_min_amount" min="0">
						</div>
					</div>

					
					<label for="item_id">@lang('messages.Interval')<span class="la-required">*</span></label>
					<div class="form-group">
			        	<select class="form-control" rel="select2" id="time_interval" name="time_interval" required="1">
							<option value="1">@lang('messages.Monthly')</option>
	  						<option value="2">@lang('messages.Daily')</option>
	  						<option value="3">@lang('messages.Weekly')</option>
	  						<option value="4">@lang('messages.Quarterly')</option>
						</select>
					</div>

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

	$("#payroll_deduction-add-form").validate({
		
	});

});


	function loadType()
	{
		var type = $('#type').val();
		if(type==2)
		{
			$('#div-salary-head').show();
			$('#div-max-min').show();
			
			$('#span-percenatge').show();

			$('#span-tk').hide();
		}
		else
		{
			$('#div-salary-head').hide();
			$('#div-max-min').hide();
			$('#span-percenatge').hide();

			$('#span-tk').show();
		}

	}

</script>
@endpush
