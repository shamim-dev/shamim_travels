@extends("la.layouts.app")


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll_hrm') }}">@lang('messages.Payroll Hrm')</a>
@endsection
@section("contentheader_description")
@section("section", trans("messages.Payroll Hrm"))
@section("section_url", url(config('laraadmin.adminRoute') . '/payroll_hrm'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", trans("messages.Payroll Hrm"))

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

	// $payroll_allowance_options='<option value="">'.Lang::get('messages.Select Allowance').'</option>';
	// $payroll_deduction_options='<option value="">'.Lang::get('messages.Select Deduction').'</option>';

	// foreach($payroll_allowances as $payroll_allowance){ 
	// 	$payroll_allowance_options.='<option value="'.$payroll_allowance->id.'">'.$payroll_allowance->allowance_name.'</option>';
	// }
	// foreach($payroll_deductions as $payroll_deduction){ 
	// 	$payroll_deduction_options.='<option value="'.$payroll_deduction->id.'">'.$payroll_deduction->deduction_name.'</option>';
	// }

?>

<div class="box box-success">
	<div class="box-header">
	</div>

	{!! Form::open(['route' => [config('laraadmin.adminRoute') . '.payroll_hrm.update', $payroll_hrm->id ], 'method'=>'PUT', 'id' => 'payroll_hrm-edit-form']) !!}

	<div class="box-body">
			<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="mother_force_id"  class="col-md-3">@lang('messages.RAB ID')<span class="la-required">*</span> :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id_text" id="emp_id_text" required="" disabled="1">
		        	<option value="">@lang('messages.Select')</option>
		        	@foreach($employees as $employee)
		        		<option value="{{ $employee->emp_id }}" 
		        		@if($employee->emp_id==$payroll_hrm->emp_id) selected @endif
		        		 >{{ $employee->rab_id }}</option>
		        	@endforeach	
		        	</select>	
				</div>

				<input type="hidden" name="emp_id" value="{{ $payroll_hrm->emp_id }}">

			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="mother_force_id"  class="col-md-3">@lang('messages.Pay Scale')<span class="la-required">*</span> :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="pay_scale_id" id="pay_scale_id" required="" >
		        	<option value="">@lang('messages.Select')</option>
		        	@foreach($payroll_pay_scales as $payroll_pay_scale)
		        		<option value="{{ $payroll_pay_scale->id }}" 
		        		@if($payroll_pay_scale->id==$payroll_hrm->pay_scale_id) selected @endif
		        		 >{{ $payroll_pay_scale->pay_scale_name }}</option>
		        	@endforeach	
		        	</select>	
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="mother_force_id"  class="col-md-3">@lang('messages.Basic Salary')<span class="la-required">*</span> :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<input class="form-control" type="number" name="basic_salary" id="basic_salary" value="{{ $payroll_hrm->basic_salary or null }}">
				</div>
			</div>


			
			
		</div>

		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="mother_force_id"  class="col-md-3">@lang('messages.Effective Date')<span class="la-required">*</span> :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class='input-group date' id='dp_effective_date'>
		                <input type='text' class="form-control" name="effective_date" id="effective_date" required="1" value="<?php 
		                if(isset($payroll_hrm->effective_date)){
		                	echo App\Helpers\CommonHelper::showDateFormat($payroll_hrm->effective_date);
		                }?>">
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-calendar"></span>
		                </span>
		            </div>	
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="mother_force_id"  class="col-md-3">@lang('messages.End Date') :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class='input-group date' id='dp_end_date'>
		                <input type='text' class="form-control" name="end_date" id="end_date" value="<?php 
		                if(isset($payroll_hrm->end_date)){
		                	echo App\Helpers\CommonHelper::showDateFormat($payroll_hrm->end_date);
		                }?>">
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-calendar"></span>
		                </span>
		            </div>	
				</div>
			</div>
			
		</div>


	@foreach($payroll_hrm_details as $key=>$payroll_hrm_detail)		
	<div class="reference reference{{ ++$key }}">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label style="text-decoration:underline">Allowance or Deduction {{ $key }}</label>
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<select class="form-control" rel="select2" id="payroll_type-{{ $key }}" name="payroll_type[]" required="1" onchange="loadType(this.id)">
						<option value="1" @if($payroll_hrm_detail->payroll_type==1) selected @endif>@lang('messages.Allowance')</option>
  						<option value="2" @if($payroll_hrm_detail->payroll_type==2) selected @endif>@lang('messages.Deduction')</option>
					</select>
				</div>
			</div>

			<div id="allowance-div-{{ $key }}" @if($payroll_hrm_detail->payroll_type==2) style="display: none;" @endif>
				<div class="col-md-1">
					<div class="form-group">
						<label for="item_id">@lang('messages.Allowance')<span class="la-required">*</span></label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
			        	<select class="form-control" rel="select2"  required="1" id="payroll_allowance_id-{{ $key }}" name="payroll_allowance_id[]" onchange="allowance_rule(this.id)">
						<?php 
						$payroll_allowance_options='<option value="">'.Lang::get('messages.Select Allowance').'</option>';
						foreach($payroll_allowances as $payroll_allowance){ 
	
							if($payroll_allowance->id==$payroll_hrm_detail->payroll_allowance_id)
							{
								$payroll_allowance_options.='<option value="'.$payroll_allowance->id.'"  selected="selected">'.$payroll_allowance->allowance_name.'</option>';
							}
							else
							{
								$payroll_allowance_options.='<option value="'.$payroll_allowance->id.'">'.$payroll_allowance->allowance_name.'</option>';
							}
							
						}
						echo $payroll_allowance_options;
						?>
						</select>
					</div>
				</div>
			</div>
			
			
			<div id="deduction-div-{{ $key }}" @if($payroll_hrm_detail->payroll_type==1) style="display: none;" @endif>
				<div class="col-md-1">
					<div class="form-group">
						<label for="item_id">@lang('messages.Deduction')<span class="la-required">*</span></label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
			        	<select class="form-control" rel="select2"  required="1" id="payroll_deduction_id-{{ $key }}" name="payroll_deduction_id[]" onchange="deduction_rule(this.id)">
						<?php 
						$payroll_deduction_options='<option value="">'.Lang::get('messages.Select Deduction').'</option>';
						foreach($payroll_deductions as $payroll_deduction){ 
							if($payroll_deduction->id==$payroll_hrm_detail->payroll_deduction_id)
							{
								$payroll_deduction_options.='<option value="'.$payroll_deduction->id.'"  selected="selected">'.$payroll_deduction->deduction_name.'</option>';
							}
							else
							{
								$payroll_deduction_options.='<option value="'.$payroll_deduction->id.'">'.$payroll_deduction->deduction_name.'</option>';
							}
							
						}
						echo $payroll_deduction_options;
						?>
						</select>
					</div>
				</div>
			</div>
			

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.From Date')</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class='input-group date from-date-to-date' id='dp_from_date-{{ $key }}'>
	                <input type='text' class="form-control" name="effective_from_date[]" id="effective_from_date-{{ $key }}" value="<?php 
	                if(isset($payroll_hrm_detail->effective_from_date)){
	                	echo App\Helpers\CommonHelper::showDateFormat($payroll_hrm_detail->effective_from_date);
	                }?>">
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.To Date')</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class='input-group date from-date-to-date' id='dp_to_date-{{ $key }}'>
	                <input type='text' class="form-control" name="effective_to_date[]" id="effective_to_date-{{ $key }}" value="<?php 
	                if(isset($payroll_hrm_detail->effective_to_date)){
	                	echo App\Helpers\CommonHelper::showDateFormat($payroll_hrm_detail->effective_to_date);
	                }?>"/>
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Status')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<select class="form-control" rel="select2" id="status-{{ $key }}" name="status[]" required="1">
						<option value="1" @if($payroll_hrm_detail->status==1) selected @endif>@lang('messages.Active')</option>
						<option value="2" @if($payroll_hrm_detail->status==2) selected @endif>@lang('messages.Inactive')</option>
					</select>
				</div>
			</div>


			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Rules')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<?php
					if($payroll_hrm_detail->payroll_type==1)
					{
						$v_allowances=DB::SELECT("SELECT pa.*,ph.name as payroll_head_name,phs.name as salary_head_name,
				        case
				        when pa.`type`='1' then 'Fixed'
				        when pa.`type`='2' then 'Percentage'
				        end as payroll_allowance_type,
				        case
				        when pa.`time_interval`='1' then 'Monthly'
				        when pa.`time_interval`='2' then 'Daily'
				        when pa.`time_interval`='3' then 'Weekly'
				        when pa.`time_interval`='4' then 'Quarterly'
				        end as payroll_allowance_interval

				        FROM `payroll_allowances` pa
				        inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
				        left join  payroll_heads phs on(phs.id=pa.`salary_head_id`)
				        WHERE pa.`deleted_at` is null
				        and pa.id='$payroll_hrm_detail->payroll_allowance_id'
				        ");
				        if(!empty($v_allowances))
				        {
				        	$v_allowance=$v_allowances[0];
				        	$v_type=$v_allowance->payroll_allowance_type;
				        	if($v_allowance->type==1)
				        	{
				        		$v_amount=$v_allowance->allowance_amount;
				        	}
				        	else
				        	{
				        		$v_amount=$v_allowance->salary_head_name.' * '.$v_allowance->allowance_amount.' %';
				        	}
				        	
				        	$v_interval=$v_allowance->payroll_allowance_interval;
				        	$v_max_amount=$v_allowance->allowance_max_amount;
				        	$v_min_amount=$v_allowance->allowance_min_amount;
				        }
					}
					else if($payroll_hrm_detail->payroll_type==2)
					{
						$v_deductions=DB::SELECT("SELECT pa.*,ph.name as payroll_head_name,phs.allowance_name as salary_head_name,
				        case
				        when pa.`type`='1' then 'Fixed'
				        when pa.`type`='2' then 'Percentage'
				        end as payroll_deduction_type,
				        case
				        when pa.`time_interval`='1' then 'Monthly'
				        when pa.`time_interval`='2' then 'Daily'
				        when pa.`time_interval`='3' then 'Weekly'
				        when pa.`time_interval`='4' then 'Quarterly'
				        end as payroll_deduction_interval

				        FROM `payroll_deductions` pa
				        inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
				        left join  payroll_allowances phs on(phs.id=pa.`salary_head_id`)
				        WHERE pa.`deleted_at` is null
				        and pa.id='$payroll_hrm_detail->payroll_deduction_id'
				        ");


				        if(!empty($v_deductions))
				        {
				        	$v_deduction=$v_deductions[0];
				        	$v_type=$v_deduction->payroll_deduction_type;
				        	if($v_deduction->type==1)
				        	{
				        		$v_amount=$v_deduction->deduction_amount;
				        	}
				        	else
				        	{
				        		if($v_deduction->salary_head_id==0)
				        		{
				        			$v_salary_head_name='মূল বেতন';
				        		}
				        		else
				        		{
				        			$v_salary_head_name=$v_deduction->salary_head_name;
				        		}
				        		$v_amount=$v_salary_head_name.' * '.$v_deduction->deduction_amount.' %';
				        	}
				        	
				        	$v_interval=$v_deduction->payroll_deduction_interval;
				        	$v_max_amount=$v_deduction->deduction_max_amount;
				        	$v_min_amount=$v_deduction->deduction_min_amount;
				        }
					} 
					?>
					<textarea class="form-control" id="allowance_rule-{{ $key }}" readonly="1" style="font-weight: bold">Type : {{ $v_type or null }} , Amount : {{ $v_amount or null }} , Interval : {{ $v_interval or null }} , Max Amount : {{ $v_max_amount or null }} , Min Amount : {{ $v_min_amount or null }}
					</textarea>
				</div>
			</div>


		</div>

		<div class="col-md-12 text-right">
			<div class="form-group">
			<a id="del_reference'+i_add+'" class="btn btn-primary" style="cursor:pointer" onclick="delete_reference({{ $key }})">@lang('messages.Remove')</a>
			</div>
		</div>


	</div>



	@endforeach
	
		<div class="row">
			<div class="col-md-12 text-right">
			<p><a class="add_more_reference btn btn-primary" style="cursor:pointer" id="{{ $key }}" onclick="add_reference()">@lang('messages.Add More')</a></p><input type="hidden" name="n" id="{{ $key }}" value="{{ $key }}" />
			</div>
		</div>


	<div>
		{!! Form::submit( Lang::get('messages.Save'), ['class'=>'btn btn-success']) !!}
		 <a href="{{ url(config('laraadmin.adminRoute') . '/payroll_hrm') }}" class="btn btn-default">@lang('messages.Cancel')</a>
	</div>
	{!! Form::close() !!}
</div>


<?php
	$payroll_allowance_options='<option value="">'.Lang::get('messages.Select Allowance').'</option>';
	$payroll_deduction_options='<option value="">'.Lang::get('messages.Select Deduction').'</option>';
	foreach($payroll_allowances as $payroll_allowance){ 
		$payroll_allowance_options.='<option value="'.$payroll_allowance->id.'">'.$payroll_allowance->allowance_name.'</option>';
	}
	foreach($payroll_deductions as $payroll_deduction){ 
		$payroll_deduction_options.='<option value="'.$payroll_deduction->id.'">'.$payroll_deduction->deduction_name.'</option>';
	}

?>


@endsection


@push('scripts')
<script type="text/javascript">
	$(function () {
		$("#payroll_hrm-edit-form").validate({
			
		});

		$("#dp_effective_date").on("dp.change",function (e) {
		    var check=commonFromDateToDateValidation('effective_date','end_date');
		    if(check==false)
		    {
		    	$.alert({
		            title: '@lang('messages.Warning')',
		            content: '@lang('messages.effectiveDateEndDate')',
		        });		    }
		}); 
		$("#dp_end_date").on("dp.change",function (e) {
		    var check=commonFromDateToDateValidation('effective_date','end_date');
		    if(check==false)
		    {
		    	$.alert({
		            title: '@lang('messages.Warning')',
		            content: '@lang('messages.effectiveDateEndDate')',
		        });
		    }
		});

		$('.from-date-to-date').click(function(event) {
		    var id = $(this).attr('id');
		    var n = id.split('-');
		    $("#dp_from_date-"+n[1]).on("dp.change",function (e) {
			    var check=commonFromDateToDateValidation('effective_from_date-'+n[1],'effective_to_date-'+n[1]);
			    if(check==false)
			    {
			    	$.alert({
			            title: '@lang('messages.Warning')',
			            content: '@lang('messages.fromDateToDate')',
			        });
			    }
			});

			$("#dp_to_date-"+n[1]).on("dp.change",function (e) {
			    var check=commonFromDateToDateValidation('effective_from_date-'+n[1],'effective_to_date-'+n[1]);
			    if(check==false)
			    {
			    	$.alert({
			            title: '@lang('messages.Warning')',
			            content: '@lang('messages.fromDateToDate')',
			        });
			    }
			});
		});




	});
	function loadType(id)
	{
		var n = id.split('-');
		var payroll_type = $('#payroll_type-'+n[1]).val();

		if(payroll_type==2)
		{
			$('#payroll_allowance_id-'+n[1]).val($('#payroll_allowance_id-'+n[1]+' option:first-child').val()).trigger('change');
			$('#payroll_deduction_id-'+n[1]).val($('#payroll_deduction_id-'+n[1]+' option:first-child').val()).trigger('change');

			$('#allowance-div-'+n[1]).hide();
			$('#deduction-div-'+n[1]).show();
		}
		else
		{
			$('#payroll_allowance_id-'+n[1]).val($('#payroll_allowance_id-'+n[1]+' option:first-child').val()).trigger('change');
			$('#payroll_deduction_id-'+n[1]).val($('#payroll_deduction_id-'+n[1]+' option:first-child').val()).trigger('change');
			$('#deduction-div-'+n[1]).hide();
			$('#allowance-div-'+n[1]).show();
		}

	}

	function allowance_rule(id)
	{
		var n = id.split('-');
		var payroll_allowance_id = $('#payroll_allowance_id-'+n[1]).val();
		if(payroll_allowance_id)
		{
			var url="{{ url(config('laraadmin.adminRoute') .'/payroll_allowance_rule') }}";
			$.post(url,{'payroll_allowance_id':payroll_allowance_id},function( data ) {

				if(data.type==1)
				{
					var amount=data.allowance_amount;
				}
				else
				{
					var amount=data.salary_head_name+' * '+data.allowance_amount+' %';
				}
				$( "#allowance_rule-"+n[1] ).text( "Type : "+ data.payroll_allowance_type+" , Amount : "+amount+" , Interval : "+data.payroll_allowance_interval+" , Max Amount : "+data.allowance_max_amount+" , Min Amount : "+data.allowance_min_amount);
			});
		}
		else
		{
			$( "#allowance_rule-"+n[1] ).text("");
		}
	}
	function deduction_rule(id)
	{
		var n = id.split('-');
		var payroll_deduction_id = $('#payroll_deduction_id-'+n[1]).val();
		if(payroll_deduction_id)
		{
			var url="{{ url(config('laraadmin.adminRoute') .'/payroll_deduction_rule') }}";
			$.post(url,{'payroll_deduction_id':payroll_deduction_id},function( data ) {

				if(data.type==1)
				{
					var amount=data.deduction_amount;
				}
				else
				{
					if(data.salary_head_id==0)
					{
						var salary_head_name='মূল বেতন';
					}
					else
					{
						var salary_head_name=data.salary_head_name;
					}
					var amount=salary_head_name+' * '+data.deduction_amount+' %';
				}
				$( "#allowance_rule-"+n[1] ).text( "Type : "+ data.payroll_deduction_type+" , Amount : "+amount+" , Interval : "+data.payroll_deduction_interval+" , Max Amount : "+data.deduction_max_amount+" , Min Amount : "+data.deduction_min_amount);
			});
		}
		else
		{
			$( "#allowance_rule-"+n[1] ).text("");
		}
	}



function add_reference()
{ 
	var i = parseInt(jQuery("a.add_more_reference").attr("id"));
	var i_add = i+1;

	var add_reference = '<div class="reference reference'+i_add+'" style="display:none;" >';
	add_reference += '<div class="row">';
	add_reference += '<div class="col-md-12">';
	add_reference += '<div class="form-group">';
	add_reference += '<label style="text-decoration:underline">Allowance or Deduction '+i_add+'</label>';
	add_reference += '</div>';
	add_reference += '</div>';

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<select class="form-control" rel="select2" id="payroll_type-'+i_add+'" name="payroll_type[]" required="1" onchange="loadType(this.id)">';
						add_reference += '<option value="1">@lang('messages.Allowance')</option>';
  						add_reference += '<option value="2">@lang('messages.Deduction')</option>';
					add_reference += '</select>';
				add_reference += '</div>';
			add_reference += '</div>';

			add_reference += '<div id="allowance-div-'+i_add+'">';
				add_reference += '<div class="col-md-1">';
					add_reference += '<div class="form-group">';
						add_reference += '<label for="item_id">@lang('messages.Allowance')<span class="la-required">*</span></label>';
					add_reference += '</div>';
				add_reference += '</div>';
				add_reference += '<div class="col-md-2">';
					add_reference += '<div class="form-group">';
			        	add_reference += '<select class="form-control" rel="select2"  required="" id="payroll_allowance_id-'+i_add+'" name="payroll_allowance_id[]" onchange="allowance_rule(this.id)">';
						add_reference += '<?php echo $payroll_allowance_options;?>';
						add_reference += '</select>';
					add_reference += '</div>';
				add_reference += '</div>';
			add_reference += '</div>';
			
			
			add_reference += '<div id="deduction-div-'+i_add+'" style="display: none;">';
				add_reference += '<div class="col-md-1">';
					add_reference += '<div class="form-group">';
						add_reference += '<label for="item_id">@lang('messages.Deduction')<span class="la-required">*</span></label>';
					add_reference += '</div>';
				add_reference += '</div>';
				add_reference += '<div class="col-md-2">';
					add_reference += '<div class="form-group">';
			        	add_reference += '<select class="form-control" rel="select2"  required="1" id="payroll_deduction_id-'+i_add+'" name="payroll_deduction_id[]"  onchange="deduction_rule(this.id)">';
						add_reference += '<?php echo $payroll_deduction_options;?>';
						add_reference += '</select>';
					add_reference += '</div>';
				add_reference += '</div>';
			add_reference += '</div>';
			

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label>@lang('messages.From Date')</label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="input-group date from-date-to-date"  id="dp_from_date-'+i_add+'"">';
	                add_reference += '<input type="text" class="form-control" name="effective_from_date[]" id="effective_from_date-'+i_add+'" >';
	                add_reference += '<span class="input-group-addon">';
	                    add_reference += '<span class="glyphicon glyphicon-calendar"></span>';
	                add_reference += '</span>';
	            add_reference += '</div>';
			add_reference += '</div>';

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.To Date')</label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="input-group date from-date-to-date" id="dp_to_date-'+i_add+'">';
	                add_reference += '<input type="text" class="form-control" name="effective_to_date[]" id="effective_to_date-'+i_add+'" >';
	                add_reference += '<span class="input-group-addon">';
	                    add_reference += '<span class="glyphicon glyphicon-calendar"></span>';
	                add_reference += '</span>';
	            add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '</div>';

			add_reference +='<div class="row">';
				add_reference += '<div class="col-md-1">';
					add_reference += '<div class="form-group">';
						add_reference += '<label for="item_id">@lang('messages.Status')<span class="la-required">*</span></label>';
					add_reference += '</div>';
				add_reference += '</div>';
				add_reference += '<div class="col-md-2">';
					add_reference += '<div class="form-group">';
			        	add_reference += '<select class="form-control" rel="select2" id="status-'+i_add+'" name="status[]" required="1">';
							add_reference += '<option value="1">@lang('messages.Active')</option>';
	  						add_reference += '<option value="2">@lang('messages.Inactive')</option>';
						add_reference += '</select>';
					add_reference += '</div>';
				add_reference += '</div>';
				add_reference +='<div class="col-md-1">';
					add_reference +='<div class="form-group">';
						add_reference +='<label for="item_id">@lang('messages.Rules')<span class="la-required">*</span></label>';
					add_reference +='</div>';
				add_reference +='</div>';
				add_reference +='<div class="col-md-8">';
					add_reference +='<div class="form-group">';
						add_reference +='<textarea class="form-control" id="allowance_rule-'+i_add+'" readonly="1" style="font-weight: bold"></textarea>';
					add_reference +='</div>';
				add_reference +='</div>';
			add_reference += '</div>';

			add_reference +='<div class="col-md-12 text-right">';
			add_reference +='<div class="form-group">';
			add_reference +='<a id="del_reference'+i_add+'" class="btn btn-primary" style="cursor:pointer" onclick="delete_reference('+i_add+')">@lang('messages.Remove')</a>';
			add_reference +='</div>';
			add_reference +='</div>';

		add_reference += '</div>';		
	add_reference += '</div>';
		
	jQuery("#n").val(i_add);
	jQuery("a.add_more_reference").attr("id",i_add);
	jQuery('div.reference').last().after(add_reference);
	jQuery('div.reference'+i_add).slideToggle();
	$("select.form-control").select2();	

	jQuery('div.reference'+i_add).find(".date").datetimepicker({
         format: 'DD/MM/YYYY' 
    }); 

    $('.from-date-to-date').click(function(event) {
	    var id = $(this).attr('id');
	    var n = id.split('-');
	    $("#dp_from_date-"+n[1]).on("dp.change",function (e) {
		    var check=commonFromDateToDateValidation('effective_from_date-'+n[1],'effective_to_date-'+n[1]);
		    if(check==false)
		    {
		    	$.alert({
		            title: '@lang('messages.Warning')',
		            content: '@lang('messages.fromDateToDate')',
		        });
		    }
		});

		$("#dp_to_date-"+n[1]).on("dp.change",function (e) {
		    var check=commonFromDateToDateValidation('effective_from_date-'+n[1],'effective_to_date-'+n[1]);
		    if(check==false)
		    {
		    	$.alert({
		            title: '@lang('messages.Warning')',
		            content: '@lang('messages.fromDateToDate')',
		        });
		    }
		});
	});

}

function delete_reference(n){
	jQuery("div.reference"+n).slideToggle(function(){jQuery(this).remove()});
	jQuery("a.add_more_reference").attr("id",n-1);
}
</script>
@endpush
