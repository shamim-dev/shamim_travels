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

	$payroll_allowance_options='<option value="">'.Lang::get('messages.Select Allowance').'</option>';
	$payroll_deduction_options='<option value="">'.Lang::get('messages.Select Deduction').'</option>';

	foreach($payroll_allowances as $payroll_allowance){ 
		$payroll_allowance_options.='<option value="'.$payroll_allowance->id.'">'.$payroll_allowance->allowance_name.'</option>';
	}
	foreach($payroll_deductions as $payroll_deduction){ 
		$payroll_deduction_options.='<option value="'.$payroll_deduction->id.'">'.$payroll_deduction->deduction_name.'</option>';
	}

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
					<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id" id="emp_id" required="" >
		        	<option value="">@lang('messages.Select')</option>
		        	@foreach($employees as $employee)
		        		<option value="{{ $employee->emp_id }}" 
		        		@if($employee->emp_id==$payroll_hrm->emp_id) selected @endif
		        		 >{{ $employee->rab_id }}</option>
		        	@endforeach	
		        	</select>	
				</div>
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
					<label for="mother_force_id"  class="col-md-3">@lang('messages.Effective Date')<span class="la-required">*</span> :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
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
			        	<select class="form-control" rel="select2"  required="1" id="payroll_allowance_id-{{ $key }}" name="payroll_allowance_id[]">
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
			        	<select class="form-control" rel="select2"  required="1" id="payroll_deduction_id-{{ $key }}" name="payroll_deduction_id[]">
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
				<div class='input-group date' id='datetimepicker1'>
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
				<div class='input-group date' id='datetimepicker1'>
	                <input type='text' class="form-control" name="effective_to_date[]" id="effective_to_date-{{ $key }}" value="<?php 
	                if(isset($payroll_hrm_detail->effective_to_date)){
	                	echo App\Helpers\CommonHelper::showDateFormat($payroll_hrm_detail->effective_to_date);
	                }?>"/>
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
			</div>
			<div class="col-md-12 text-right">
				<div class="form-group">
				<a id="del_reference'+i_add+'" class="btn btn-primary" style="cursor:pointer" onclick="delete_reference({{ $key }})">@lang('messages.Remove')</a>
				</div>
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



@endsection


@push('scripts')
<script type="text/javascript">
	$(function () {
		$("#payroll_hrm-edit-form").validate({
			
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
			        	add_reference += '<select class="form-control" rel="select2"  required="" id="payroll_allowance_id-'+i_add+'" name="payroll_allowance_id[]">';
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
			        	add_reference += '<select class="form-control" rel="select2"  required="1" id="payroll_deduction_id-'+i_add+'" name="payroll_deduction_id[]">';
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
				add_reference += '<div class="input-group date" id="datetimepicker1">';
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
				add_reference += '<div class="input-group date" id="datetimepicker1">';
	                add_reference += '<input type="text" class="form-control" name="effective_to_date[]" id="effective_to_date-'+i_add+'" >';
	                add_reference += '<span class="input-group-addon">';
	                    add_reference += '<span class="glyphicon glyphicon-calendar"></span>';
	                add_reference += '</span>';
	            add_reference += '</div>';
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

}

function delete_reference(n){
	jQuery("div.reference"+n).slideToggle(function(){jQuery(this).remove()});
	jQuery("a.add_more_reference").attr("id",n-1);
}
</script>
@endpush
