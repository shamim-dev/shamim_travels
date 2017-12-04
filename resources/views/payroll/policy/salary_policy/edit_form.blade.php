@extends("la.layouts.app")


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll/salary_policy') }}">@lang('messages.Salary Policy')</a>
@endsection
@section("contentheader_description")
@section("section", trans("messages.Salary Policy"))
@section("section_url", url(config('laraadmin.adminRoute') . '/payroll/salary_policy'))
@section("sub_section", trans("messages.Add"))

@section("htmlheader_title", trans("messages.Salary Policy"))

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

	$payroll_head_options='<option value="">'.Lang::get('messages.Select Payroll Heads').'</option>';
	$salary_head_options='<option value="">'.Lang::get('messages.Select Salary Heads').'</option>';

	foreach($payroll_heads as $payroll_head){ 
		$payroll_head_options.='<option value="'.$payroll_head->id.'">'.$payroll_head->name.'</option>';
	}
	foreach($salary_heads as $salary_head){ 
		$salary_head_options.='<option value="'.$salary_head->id.'">'.$salary_head->name.'</option>';
	}

?>


<div class="box box-success">
	<div class="box-header">
	</div>

	{!! Form::open(['route' => [config('laraadmin.adminRoute') . '.payroll.salary_policy.update', $payroll_policy->id ], 'method'=>'PUT', 'id' => 'salary_policy-edit-form']) !!}

	<input type="hidden" name="policy_type" value="1">
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="receive_voucher_no">@lang('messages.Policy Name')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<input type="text" name="policy_name" id="policy_name" class="form-control" required="1" placeholder="@lang('messages.Enter Policy Name')" maxlength="100" value="{{ $payroll_policy->policy_name or null }}">
				</div>
			</div>
			
		</div>


	@foreach($payroll_policy_details as $key=>$payroll_policy_detail)		
	<div class="reference reference{{ ++$key }}">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label style="text-decoration:underline">Payroll Head {{ $key }}</label>
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Payroll Heads')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<select class="form-control" rel="select2"  required="1" id="payroll_head_id-{{ $key }}" name="payroll_head_id[]">
					<?php echo $payroll_head_options;?>
					<?php 
						$payroll_head_options=App\Models\Common_Model::common_dropdown('payroll_heads','id','name',$payroll_policy_detail->payroll_head,'Payroll Heads');
						echo $payroll_head_options;
						?>
					</select>
					
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<select class="form-control" rel="select2" id="type_id-{{ $key }}" name="type_id[]" required="1" onchange="loadType(this.id)">
						<option value="1" @if($payroll_policy_detail->type==1) selected @endif>@lang('messages.Fixed')</option>
  						<option value="2" @if($payroll_policy_detail->type==2) selected @endif>@lang('messages.Percentage')</option>
					</select>
				</div>
			</div>

			<div id="div-slary-head-{{ $key }}" @if($payroll_policy_detail->type==1) style="display: none;" @endif>
				<div class="col-md-1">
					<div class="form-group">
						<label for="item_id">@lang('messages.Salary Heads')<span class="la-required">*</span></label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
			        	<select class="form-control" rel="select2" id="salary_head_id-{{ $key }}" name="salary_head_id[]" required="1">
						<?php 
						foreach($salary_heads as $salary_head){ 
							if($salary_head->id==$payroll_policy_detail->salary_head)
							{
								$salary_head_options.='<option value="'.$salary_head->id.'"  selected="selected">'.$salary_head->name.'</option>';
							}
							else
							{
								$salary_head_options.='<option value="'.$salary_head->id.'">'.$salary_head->name.'</option>';
							}
							
						}

						echo $salary_head_options;?>
						</select>
					</div>
				</div>
			</div>
			

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Amount')&nbsp<span id="span-percenatge-{{ $key }}" @if($payroll_policy_detail->type==1) style="display: none;" @endif>(%)</span></span><span id="span-tk-{{ $key }}" @if($payroll_policy_detail->type==2) style="display: none;" @endif>(Tk.)</span><span class="la-required">*</span>
					</label>
					
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<input class="form-control" type="number" id="amount-{{ $key }}" name="amount[]" min="1" required="1" value="{{ $payroll_policy_detail->amount or null }}">
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
		 <a href="{{ url(config('laraadmin.adminRoute') . '/payroll/salary_policy') }}" class="btn btn-default">@lang('messages.Cancel')</a>
	</div>
	{!! Form::close() !!}
</div>



@endsection


@push('scripts')
<script type="text/javascript">
	$(function () {
		$("#salary_policy-edit-form").validate({
			
		});
	});
	function loadType(id)
	{
		var n = id.split('-');
		var type = $('#type_id-'+n[1]).val();

		if(type==2)
		{
			$('#div-slary-head-'+n[1]).show();
			$('#span-percenatge-'+n[1]).show();

			$('#span-tk-'+n[1]).hide();
		}
		else
		{
			$('#div-slary-head-'+n[1]).hide();
			$('#span-percenatge-'+n[1]).hide();

			$('#span-tk-'+n[1]).show();
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
	add_reference += '<label style="text-decoration:underline">Payroll Head '+i_add+'</label>';
	add_reference += '</div>';
	add_reference += '</div>';

			

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Payroll Heads')<span class="la-required">*</span></label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<select class="form-control" rel="select2" id="payroll_head_id-'+i_add+'" name="payroll_head_id[]"  required="1">';
					add_reference += '<?php echo $payroll_head_options;?>';
					add_reference += '</select>';
				add_reference += '</div>';
			add_reference += '</div>';

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<select class="form-control" rel="select2" id="type_id-'+i_add+'" name="type_id[]" required="1" onchange="loadType(this.id)">';
						add_reference += '<option value="1">@lang('messages.Fixed')</option>';
  						add_reference += '<option value="2">@lang('messages.Percentage')</option>';
					add_reference += '</select>';
				add_reference += '</div>';
			add_reference += '</div>';


			add_reference += '<div id="div-slary-head-'+i_add+'" style="display: none;">';
			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Salary Heads')<span class="la-required">*</span></label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<select class="form-control" rel="select2" id="salary_head_id-'+i_add+'" name="salary_head_id[]"  required="1">';
					add_reference += '<?php echo $salary_head_options;?>';
					add_reference += '</select>';
				add_reference += '</div>';
			add_reference += '</div>';

			add_reference += '</div>';

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Amount')&nbsp<span id="span-percenatge-'+i_add+'" style="display: none;">(%)</span></span><span id="span-tk-'+i_add+'">(Tk.)</span><span class="la-required">*</span>';
					
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<input class="form-control" type="number" id="amount-'+i_add+'" name="amount[]" min="1" required="1">';
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
}

function delete_reference(n){
	jQuery("div.reference"+n).slideToggle(function(){jQuery(this).remove()});
	jQuery("a.add_more_reference").attr("id",n-1);
}
</script>
@endpush
