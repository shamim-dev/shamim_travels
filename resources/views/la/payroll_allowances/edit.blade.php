@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll_allowances') }}">@lang('messages.Payroll Allowance')</a> :
@endsection
@section("contentheader_description", $payroll_allowance->$view_col)
@section("section", trans("messages.Payroll Allowances"))
@section("section_url", url(config('laraadmin.adminRoute') . '/payroll_allowances'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Payroll Allowances Edit : ".$payroll_allowance->$view_col)

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
	$salary_head_options='<option value="">'.Lang::get('messages.Select Salary Heads').'</option>';
	$payroll_head_options='<option value="">'.Lang::get('messages.Select Payroll Heads').'</option>';
?>

<div class="box box-success">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			
				{!! Form::model($payroll_allowance, ['route' => [config('laraadmin.adminRoute') . '.payroll_allowances.update', $payroll_allowance->id ], 'method'=>'PUT', 'id' => 'payroll_allowance-edit-form']) !!}
					{{--@ la_form($module) --}}
					{{--
					@la_edit_input($module, 'salary_head_id')
					@la_edit_input($module, 'allowance_amount')
					@la_edit_input($module, 'allowance_max_amount')
					@la_edit_input($module, 'allowance_min_amount')
					@la_edit_input($module, 'payroll_head_id')
					--}}
					

					@la_edit_input($module, 'allowance_name')
					
					
					<div class="col-md-2">
						<label for="item_id">@lang('messages.Payroll Heads')<span class="la-required">*</span></label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
				        	<select class="form-control" rel="select2" id="payroll_head_id" name="payroll_head_id" required="1">
							<?php 
							foreach($payroll_heads as $payroll_head){ 
								if($payroll_head->id==$payroll_allowance->payroll_head_id)
								{
									$payroll_head_options.='<option value="'.$payroll_head->id.'" selected="selected">'.$payroll_head->name.'</option>';
								}
								else
								{
									$payroll_head_options.='<option value="'.$payroll_head->id.'">'.$payroll_head->name.'</option>';
								}
								
							}
							echo $payroll_head_options;?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label for="item_id">@lang('messages.Types')<span class="la-required">*</span></label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
				        	<select class="form-control" rel="select2" id="type" name="type" required="1" onchange="loadType()">
								<option value="1" @if($payroll_allowance->type==1) selected="selected" @endif>@lang('messages.Fixed')</option>
		  						<option value="2" @if($payroll_allowance->type==2) selected="selected" @endif>@lang('messages.Percentage')</option>
							</select>
						</div>
					</div>


					<div id="div-salary-head" @if($payroll_allowance->type==1) style="display: none;" @endif>
						<div class="col-md-2">
							<label for="item_id">@lang('messages.Salary Heads')<span class="la-required">*</span></label>
						</div>
						<div class="col-md-4">
							<div class="form-group">
					        	<select class="form-control" rel="select2" id="salary_head_id-1" name="salary_head_id" required="1">
								<?php 
								foreach($salary_heads as $salary_head){ 
									if($salary_head->id==$payroll_allowance->salary_head_id)
									{
										$salary_head_options.='<option value="'.$salary_head->id.'" selected="selected">'.$salary_head->name.'</option>';
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

					<div class="col-md-2">
						<label for="item_id">@lang('messages.Amount')&nbsp<span id="span-percenatge" style="display: none;">(%)</span></span><span id="span-tk">(Tk.)</span><span class="la-required">*</span></label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
				        	<input class="form-control" type="number" name="allowance_amount" min="1" required="1" value="{{ $payroll_allowance->allowance_amount or null}}">
						</div>
					</div>

					<div id="div-max-min" @if($payroll_allowance->type==1) style="display: none;"  @endif>
						<div class="col-md-2">
							<label for="item_id">@lang('messages.Maximum Amount')</label>
						</div>
						<div class="col-md-4">
							<div class="form-group">
					        	<input class="form-control" type="number" name="allowance_max_amount" min="0" value="{{ $payroll_allowance->allowance_max_amount or null }}">
							</div>
						</div>
						<div class="col-md-2">
							<label for="item_id">@lang('messages.Minimum Amount')</label>
						</div>
						<div class="col-md-4">
							<div class="form-group">
					        	<input class="form-control" type="number" name="allowance_min_amount" min="0" value="{{ $payroll_allowance->allowance_min_amount or null }}">
							</div>
						</div>
					</div>

					<div class="col-md-2">
						<label for="item_id">@lang('messages.Interval')<span class="la-required">*</span></label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
				        	<select class="form-control" rel="select2" id="time_interval" name="time_interval" required="1">
								<option value="1" @if($payroll_allowance->time_interval==1) selected="selected" @endif>@lang('messages.Monthly')</option>
		  						<option value="2" @if($payroll_allowance->time_interval==2) selected="selected" @endif>@lang('messages.Daily')</option>
		  						<option value="3" @if($payroll_allowance->time_interval==3) selected="selected" @endif>@lang('messages.Weekly')</option>
		  						<option value="4" @if($payroll_allowance->time_interval==4) selected="selected" @endif>@lang('messages.Quarterly')</option>
							</select>
						</div>
					</div>

					
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/payroll_allowances') }}">@lang('messages.Cancel')</a></button>
					</div>
					</div>
				{!! Form::close() !!}
			
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#payroll_allowance-edit-form").validate({
		
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
