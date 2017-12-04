@extends("la.layouts.app")


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll_hrm') }}">@lang('messages.Payroll Hrm')</a>
@endsection
@section("contentheader_description")
@section("section", trans("messages.Payroll Hrm"))
@section("section_url", url(config('laraadmin.adminRoute') . '/payroll_hrm'))
@section("sub_section", trans("messages.Add"))

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
	{!! Form::open(['action' => 'Payroll\Payroll_HrmController@store', 'id' => 'payroll_hrm-add-form']) !!}
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="mother_force_id"  class="col-md-3">@lang('messages.RAB ID')<span class="la-required">*</span> :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id[]" id="emp_id" required="1" multiple="1">
		        	<option value="">@lang('messages.Select')</option>
		        	@foreach($employees as $employee)
		        		<option value="{{ $employee->emp_id }}" 
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
					<input class="form-control" type="number" name="basic_salary" id="basic_salary">
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
		                <input type='text' class="form-control" name="effective_date" id="effective_date" required="1">
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
		                <input type='text' class="form-control" name="end_date" id="end_date">
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-calendar"></span>
		                </span>
		            </div>	
				</div>
			</div>
			
		</div>

	<div class="reference reference1">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label style="text-decoration:underline">Allowance or Deduction 1</label>
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<select class="form-control" rel="select2" id="payroll_type-1" name="payroll_type[]" required="1" onchange="loadType(this.id)">
						<option value="1">@lang('messages.Allowance')</option>
  						<option value="2">@lang('messages.Deduction')</option>
					</select>
				</div>
			</div>

			<div id="allowance-div-1">
				<div class="col-md-1">
					<div class="form-group">
						<label for="item_id">@lang('messages.Allowance')<span class="la-required">*</span></label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
			        	<select class="form-control" rel="select2"  required="1" id="payroll_allowance_id-1" name="payroll_allowance_id[]" onchange="allowance_rule(this.id)">
						<?php echo $payroll_allowance_options;?>
						</select>
					</div>
				</div>
			</div>
			
			
			<div id="deduction-div-1" style="display: none;">
				<div class="col-md-1">
					<div class="form-group">
						<label for="item_id">@lang('messages.Deduction')<span class="la-required">*</span></label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
			        	<select class="form-control" rel="select2"  required="1" id="payroll_deduction_id-1" name="payroll_deduction_id[]"  onchange="deduction_rule(this.id)">
						<?php echo $payroll_deduction_options;?>
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
				<div class='input-group date from-date-to-date' id='dp_from_date-1' >
	                <input type='text' class="form-control" name="effective_from_date[]" id="effective_from_date-1">
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
				<div class='input-group date from-date-to-date' id='dp_to_date-1'>
	                <input type='text' class="form-control" name="effective_to_date[]" id="effective_to_date-1" >
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
		        	<select class="form-control" rel="select2" id="status-1" name="status[]" required="1">
						<option value="1">@lang('messages.Active')</option>
  						<option value="2">@lang('messages.Inactive')</option>
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
					<textarea class="form-control" id="allowance_rule-1" readonly="1" style="font-weight: bold"></textarea>
				</div>
			</div>



		</div>
	
	</div>
			
		<div class="row">
			<div class="col-md-12 text-right">
			<p><a class="add_more_reference btn btn-primary" style="cursor:pointer" id="1" onclick="add_reference()">@lang('messages.Add More')</a></p><input type="hidden" name="n" id="n" value="1" />
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
		$("#payroll_hrm-add-form").validate({
			
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
			$('#allowance-div-'+n[1]).hide();
			$('#deduction-div-'+n[1]).show();
		}
		else
		{
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
			        	add_reference += '<select class="form-control" rel="select2"  required="" id="payroll_allowance_id-'+i_add+'" name="payroll_allowance_id[]"  onchange="allowance_rule(this.id)">';
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
			        	add_reference += '<select class="form-control" rel="select2"  required="1" id="payroll_deduction_id-'+i_add+'" name="payroll_deduction_id[]"   onchange="deduction_rule(this.id)">';
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
				add_reference += '<div class="input-group date from-date-to-date" id="dp_from_date-'+i_add+'">';
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
