@extends("la.layouts.app")

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/salary_process') }}">@lang('messages.Salary Process')</a>
@endsection
@section("contentheader_description")
@section("section", trans("messages.Salary Process"))
@section("section_url", url(config('laraadmin.adminRoute') . '/salary_process'))
@section("sub_section", trans("messages.Add"))

@section("htmlheader_title", "Salary Process")

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

	//$battalion_options='<option value="">'.Lang::get('messages.Select Battalion').'</option>';
	$wing_options='<option value="">'.Lang::get('messages.Select Wing').'</option>';
	$branch_options='<option value="">'.Lang::get('messages.Select Branch').'</option>';
	$sub_branch_options='<option value="">'.Lang::get('messages.Select Sub-branch').'</option>';
	$section_options='<option value="">'.Lang::get('messages.Select Section').'</option>';
	$sub_section_options='<option value="">'.Lang::get('messages.Select Sub-section').'</option>';
	
	// foreach($battalions as $battalion){ 
	// 	$battalion_options.='<option value="'.$battalion->id.'">'.$battalion->battalion_name.'</option>';
	// }
	
	
?>


<div class="box box-success">
	<div class="box-header">
	</div>
	{!! Form::open(['action' => 'Payroll\Salary_ProcessController@store', 'id' => 'process-add-form']) !!}
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="battalion_id">@lang('messages.Battalion')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" rel="select2" name="battalion_id" id="battalion_id" required="1"
						@if(Session::get('user_level')>1  && Session::get('battalion_id')>0)
			        		disabled=""
			        	@else
			        		onchange="battalionChildDropdownLoad()"
			        	@endif
						>
						<option value="">@lang('messages.Select Battalion')</option>
			        	@foreach($battalions as $battalion)
			        		<option value="{{ $battalion->id }}" 
			        		@if(Session::get('user_level')>1)
				        		@if(Session::get('battalion_id')==$battalion->id)
			        				selected="selected"
			        			@endif
		        			@endif
			        		 >{{ $battalion->battalion_name }}</option>
			        	@endforeach	
					</select>
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="wing_id">@lang('messages.Wing')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" rel="select2"  name="wing_id" id="wing_id"
						@if(Session::get('user_level')>1 && Session::get('wing_id')>0)
			        		disabled=""
			        	@else
			        		onchange="wingChildDropdownLoad()"
			        	@endif>
						<?php echo $wing_options;?>
					</select>
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="branch_id">@lang('messages.Branch')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" rel="select2" name="branch_id" id="branch_id" 
						@if(Session::get('user_level')>1  && Session::get('branch_id')>0)
			        		disabled=""
			        	@else
			        		onchange="branchChildDropdownLoad()"
			        	@endif>
						<?php echo $branch_options;?>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="sub_branch_id">@lang('messages.Sub-branch')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" rel="select2" name="sub_branch_id" id="sub_branch_id" 
						@if(Session::get('user_level')>1  && Session::get('sub_branch_id')>0)
			        		disabled=""
			        	@else
			        		onchange="subBranchChildDropdownLoad()"
			        	@endif>
						<?php echo $sub_branch_options;?>
					</select>
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="section_id">@lang('messages.Section')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" rel="select2" name="section_id" id="section_id"
						@if(Session::get('user_level')>1  && Session::get('section_id')>0)
			        		disabled=""
			        	@else
			        		onchange="sectionChildDropdownLoad()"
			        	@endif
			        	>
						<?php echo $section_options;?>
					</select>
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="sub_section_id">@lang('messages.Sub-section')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" rel="select2" name="sub_section_id" id="sub_section_id"
						@if(Session::get('user_level')>1  && Session::get('sub_section_id')>0)
			        		disabled=""
			        	@else
			        		onchange="battalion_wise_emp_list()"
			        	@endif
					>
						<?php echo $sub_section_options;?>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
				    <label for="is_officer">@lang('messages.Officer')</label>
				</div>
			</div>	    
			<div class="col-md-3">
			    <div class="form-group">
				    <select class="form-control" data-placeholder="@lang('messages.Select')" rel="select2" name="is_officer" id="is_officer" onchange="battalion_wise_emp_list()">
			    		<option value="Yes">Yes</option>
				    	<option value="No">No</option>
			    	</select>
			    </div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="rab_id">@lang('messages.RAB ID')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="form-group">
					<select class="form-control"  rel="select2" name="posting_rec_id[]" id="posting_rec_id" required="1" multiple="true" data-placeholder="@lang('messages.Select')">
		        	</select>
	        	</div>
			</div>


			<div class="col-md-1">
				<div class="form-group">
					<label for="rab_id">@lang('messages.Salary Month')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class='input-group' id='datetimepicker1'>
		                <input type='text' class="form-control" name="salary_date" id="salary_date" required="1">
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-calendar"></span>
		                </span>
		            </div>
	        	</div>
			</div>

		</div>


		@la_access("Salary_Process", "create")
			<div style="text-align: center;">
				<div id="buttons">
					{!! Form::submit( Lang::get('messages.Process'), ['class'=>'btn btn-success confirm','id'=>'submitbtn']) !!}
					@endla_access
					<a href="{{ url(config('laraadmin.adminRoute') . '/salary_process') }}" class="btn btn-default">@lang('messages.Cancel')</a>
				</div>
				<div id="processing_msg" style="display: none;">
					<div class="loader" style="margin: auto;"></div>
				</div>
			</div>
			
		</div>
		
	</div>
	{!! Form::close() !!}
</div>



@endsection



<script type="text/javascript">
	var urlDynamicDropDown="{{ url(config('laraadmin.adminRoute') .'/common_dynamic_load_dropdown') }}";
</script>
@push('scripts')
<script src="{{ asset('js/common_dynamic_load_dropdown.js') }}"></script>
@endpush

@push('scripts')

<script type="text/javascript">
	$(function () {
		$("#process-add-form").validate({
			submitHandler: function(form) {
			    //$("#submitbtn").prop('disabled', true);
			    $("#buttons").hide();
			    $("#processing_msg").show();
			    form.submit();
			}
		});

		$('#datetimepicker1').datetimepicker({
            viewMode: 'years',
        	format: 'YYYY-MM'
        });

        $('.confirm').confirm({
			title: 'Confirm!',
		    content: "Are you sure to process this ?",
		    buttons: {
		        yes: function () {
		            $( "#process-add-form" ).submit();
		        },
		        close: function () {
		        }
		    }
		});

	});


window.onload = function()
{
	var edit_battalion_id=0;
	@if(Session::get('battalion_id'))
		edit_battalion_id={{ Session::get('battalion_id') }};
	@endif
	if(edit_battalion_id>0){
		editChildDropdownLoad();
	}
};
//................edit drop down start..................
function editChildDropdownLoad(){
	var edit_battalion_id=0;
	@if(Session::get('battalion_id'))
		edit_battalion_id={{ Session::get('battalion_id') }};
	@endif
	var edit_wing_id=0;
	@if(Session::get('wing_id'))
		edit_wing_id={{ Session::get('wing_id') }};
	@endif
	var edit_branch_id=0;
	@if(Session::get('branch_id'))
		edit_branch_id={{ Session::get('branch_id') }};
	@endif
	var edit_sub_branch_id=0;
	@if(Session::get('sub_branch_id'))
		edit_sub_branch_id={{ Session::get('sub_branch_id') }};
	@endif
	var edit_section_id=0;
	@if(Session::get('section_id'))
		edit_section_id={{ Session::get('section_id') }};
	@endif
	var edit_sub_section_id=0;
	@if(Session::get('sub_section_id'))
		edit_sub_section_id={{ Session::get('sub_section_id') }};
	@endif

	battalion_wise_emp_list_user_wise(edit_battalion_id,edit_wing_id,edit_branch_id,edit_sub_branch_id,edit_section_id,edit_sub_section_id,'Yes');


	common_dynamic_load_dropdown('battalion_id','wing_id','wings','battalion_id','id','wing_name',edit_wing_id);
	common_dynamic_load_dropdown('battalion_id','branch_id','branches','battalion_id','id','branch_name',edit_branch_id);
	common_dynamic_load_dropdown('branch_id','sub_branch_id','sub_branches','branch_id','id','sb_name',edit_sub_branch_id,edit_branch_id);

	common_dynamic_load_dropdown('sub_branch_id','section_id','sections','sub_branch_id','id','section_name',edit_section_id,edit_sub_branch_id);

	common_dynamic_load_dropdown('section_id','sub_section_id','sub_sections','section_id','id','sub_section_name',edit_sub_section_id,edit_section_id);

}
//................edit drop down end..................
//...............provider filter start.......
function battalionChildDropdownLoad()
{
	common_dynamic_load_dropdown('battalion_id','wing_id','wings','battalion_id','id','wing_name');
	common_dynamic_load_dropdown('battalion_id','branch_id','branches','battalion_id','id','branch_name');
	
	battalion_wise_emp_list();
	$("#sub_branch_id").find("option:not(:first)").remove();
	$("#section_id").find("option:not(:first)").remove();
	$("#sub_section_id").find("option:not(:first)").remove();
}
function wingChildDropdownLoad()
{
	common_dynamic_load_dropdown('wing_id','branch_id','branches','wing_id','id','branch_name');
	$("#sub_branch_id").find("option:not(:first)").remove();
	$("#section_id").find("option:not(:first)").remove();
	$("#sub_section_id").find("option:not(:first)").remove();

	battalion_wise_emp_list();		
}
function branchChildDropdownLoad()
{
	common_dynamic_load_dropdown('branch_id','sub_branch_id','sub_branches','branch_id','id','sb_name');
	$("#section_id").find("option:not(:first)").remove();
	$("#sub_section_id").find("option:not(:first)").remove();

	battalion_wise_emp_list();

}
function subBranchChildDropdownLoad()
{
	common_dynamic_load_dropdown('sub_branch_id','section_id','sections','sub_branch_id','id','section_name');
	$("#sub_section_id").find("option:not(:first)").remove();

	battalion_wise_emp_list();

}
function sectionChildDropdownLoad()
{
	common_dynamic_load_dropdown('section_id','sub_section_id','sub_sections','section_id','id','sub_section_name');
	battalion_wise_emp_list();

}

function battalion_wise_emp_list()
{
	// $("#posting_rec_id").find("option:not(:first)").remove();
	$("#posting_rec_id").find("option").remove();

	var battalion_id=$('#battalion_id').val();
	var wing_id=$('#wing_id').val();
	var branch_id=$('#branch_id').val();
	var sub_branch_id=$('#sub_branch_id').val();
	var section_id=$('#section_id').val();
	var sub_section_id=$('#sub_section_id').val();
	var is_officer=$('#is_officer').val();

	var url="{{ url(config('laraadmin.adminRoute') .'/payroll_hrm_employee_list') }}";

	var options = $("#posting_rec_id");
	options.append($("<option />").val('all').text('All'));
	
	$.post(url,{'battalion_id':battalion_id,'wing_id':wing_id,'branch_id':branch_id,'sub_branch_id':sub_branch_id,'section_id':section_id,'sub_section_id':sub_section_id,'is_officer':is_officer},function( data ) {
		
		$.each(data, function() {
			options.append($("<option />").val(this.posting_rec_id).text(this.rab_id));					
		});

		var length=$('select#posting_rec_id option').length;
		if(length==1)
		{
			$("#posting_rec_id").find("option").remove();
		}

	});
}

function battalion_wise_emp_list_user_wise(battalion_id=null,wing_id=null,branch_id=null,sub_branch_id=null,section_id=null,sub_section_id=null,is_officer=null)
{
	$("#posting_rec_id").find("option").remove();

	var url="{{ url(config('laraadmin.adminRoute') .'/payroll_hrm_employee_list') }}";

	var options = $("#posting_rec_id");
	options.append($("<option />").val('all').text('All'));
	
	$.post(url,{'battalion_id':battalion_id,'wing_id':wing_id,'branch_id':branch_id,'sub_branch_id':sub_branch_id,'section_id':section_id,'sub_section_id':sub_section_id,'is_officer':is_officer},function( data ) {
		
		$.each(data, function() {
			options.append($("<option />").val(this.posting_rec_id).text(this.rab_id));					
		});

		var length=$('select#posting_rec_id option').length;
		if(length==1)
		{
			$("#posting_rec_id").find("option").remove();
		}

	});
}


			
</script>
@endpush
