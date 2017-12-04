@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/leaves') }}">@lang('messages.Leaf')</a> :
@endsection
@section("contentheader_description", $leaf->$view_col)
@section("section", trans("messages.Leaves"))
@section("section_url", url(config('laraadmin.adminRoute') . '/leaves'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Leaves Edit : ".$leaf->$view_col)

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
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			
				{!! Form::model($leaf, ['route' => [config('laraadmin.adminRoute') . '.leaves.update', $leaf->id ], 'method'=>'PUT', 'id' => 'leaf-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					{{--@la_edit_input($module, 'emp_id')--}}
					<div class="col-md-2">
						<label for="rab_id">@lang('messages.RAB ID')* :</label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id"
							id="emp_id" disabled="">
							<option value="">@lang('messages.Select')</option>
							@foreach($employees as $employee)
								<option value="{{ $employee->emp_id }}" 
								@if($leaf->emp_id==$employee->emp_id)
									selected="selected"
								@endif
								 >{{ $employee->rab_id }}</option>
							@endforeach	
							</select>	
						</div>
					</div>
					<div class="col-md-2">
						<label for="rab_id">@lang('messages.Total Leave Enjoyed') : (@lang('messages.Days'))</label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text"  class="form-control" name="total_leave_applied" id="total_leave_applied" value="" disabled=""> 
						</div>
					</div>
					@la_edit_input($module, 'leave_type_id')
					<div class="col-md-2">
						<label for="rab_id">@lang('messages.Leave Enjoyed') : (@lang('messages.Days'))</label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text"  class="form-control" name="leave_type_wise_total_leave_applied" id="leave_type_wise_total_leave_applied" value="" disabled="">
						</div>
					</div>
					@la_edit_input($module, 'from_date')
					@la_edit_input($module, 'to_date')
					<div class="col-md-2">
						<label for="rab_id">@lang('messages.Duration') : (@lang('messages.Days'))</label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" name="duration" id="duration" readonly="" 
							 value="{{ $leaf->duration }}">
						</div>
					</div>
					
					@la_edit_input($module, 'contact_no')
					@la_edit_input($module, 'location')
					
                    <div class="col-md-12">
					<div class="form-group">
						<button type="button" class="btn btn-success" onclick="formSubmit()">@lang('messages.Update')</button>
						<button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/leaves') }}">@lang('messages.Cancel')</a></button>
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
	editLeaveLoad();
	$("#leaf-edit-form").validate({
		
	});
	$("#dp_from_date").on("dp.change",function (e) {
	    var check=commonFromDateToDateValidation('from_date','to_date');
	    if(check==false)
	    {
	    	$.alert({
	            title: '@lang('messages.Warning')',
	            content: '@lang('messages.fromDateToDate')',
	        });
	        $('#duration').val('');
	    }
	    else
	    {
	    	var duration=dateDiff('from_date','to_date');
	    	if(duration>=0)
	    	{
	    		$('#duration').val(duration+1);
	    		alradyLeaveAppliedCheck();
	    	}	
	    	
	    }	
	}); 
	$("#dp_to_date").on("dp.change",function (e) {
	    var check=commonFromDateToDateValidation('from_date','to_date');
	    if(check==false)
	    {
	    	$.alert({
	            title: '@lang('messages.Warning')',
	            content: '@lang('messages.fromDateToDate')',
	        });
	        $('#duration').val('');
	    }
	    else
	    {
	    	var duration=dateDiff('from_date','to_date');
	    	if(duration>=0)
	    	{
	    		$('#duration').val(duration+1);
	    		alradyLeaveAppliedCheck();
	    	}	
	    }
	});
});

function formSubmit()
{
	$("#leaf-edit-form").submit();
}
// function formSubmit()
// {
// 	alradyLeaveAppliedCheck();
// }
function alradyLeaveAppliedCheck()
{
	var emp_id=$('#emp_id').val();
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	var url="{{ url(config('laraadmin.adminRoute') .'/leaves/aj_already_leave_applied_check') }}";
	$.post(url,{'emp_id':emp_id,'from_date':from_date,'to_date':to_date},function( data ) {
		if(data.applied>0)
		{
			$.alert({
	            title: '@lang('messages.Warning')',
	            content: '@lang('messages.Already Applied')',
	        });
		}
	});
}

function editLeaveLoad()
{
	yearlyLeaveCount();
	leaveTypeWiseYearlyLeaveCount();
}
function yearlyLeaveCount()
{
	var emp_id=$('#emp_id').val();
	var url="{{ url(config('laraadmin.adminRoute') .'/leaves/aj_yearly_leave_count') }}";
	$.post(url,{'emp_id':emp_id},function( data ) {
		$('#total_leave_applied').val(data);
	});
}
function leaveTypeWiseYearlyLeaveCount()
{
	var emp_id=$('#emp_id').val();
	var leave_type_id=$('#leave_type_id').val();
	var url="{{ url(config('laraadmin.adminRoute') .'/leaves/aj_leave_type_wise_yearly_leave_Count') }}";
	$.post(url,{'emp_id':emp_id,'leave_type_id':leave_type_id},function( data ) {
		if(data>0)
		{
			$('#leave_type_wise_total_leave_applied').val(data);
		}
		else
		{
			$('#leave_type_wise_total_leave_applied').val(0);
		}	
		
	});
}
</script>
@endpush
