
@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Leaves"))
@section("contentheader_description", trans("messages.Leaves listing"))
@section("section", trans("messages.Leaves"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Leaves listing"))

@section("headerElems")
@la_access("Leaves", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">@lang("messages.Add Leaf")</button>
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
			<th>@lang('messages.RAB ID')</th>
			<th>@lang('messages.Personal No.')</th>
			<th>@lang('messages.Name')</th>
			<th>@lang('messages.Rank')</th>
			<th>@lang('messages.Leave Type')</th>
			<th>@lang('messages.From')</th>
			<th>@lang('messages.To')</th>
			<th>@lang('messages.Duration')</th>
			<th>@lang('messages.Contact No.')</th>
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@foreach( $values as $key=>$value )
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->rab_id }}</td>
				<td>{{ $value->personal_no }}</td>
				<td>{{ $value->emp_name }}</td>
				<td>{{ $value->rank_short_name }}</td>
				<td>{{ $value->leave_type }}</td>
				<td>{{ App\Helpers\CommonHelper::showDateFormat($value->from_date) }}</td>
				<td>{{ App\Helpers\CommonHelper::showDateFormat($value->to_date) }}</td>
				<td>{{ $value->duration }}</td>
				<td>{{ $value->contact_no }}</td>	
				<td>
					@if($value->is_process==0)
						@la_access("Leaves", "edit")
							<a href="{{ url(config('laraadmin.adminRoute') .'/leaves/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
						@endla_access
						@la_access("Leaves", "delete")
							{!! Form::open(['action' => ['LA\LeavesController@destroy',$value->id],'method' => 'delete','style'=>'display:inline']) !!}
							<button class="btn btn-danger btn-xs"  style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-times"></i></button>
							{!! Form::close() !!}
						@endla_access

						@la_access("Leaves", "edit")
							<a href="{{ url(config('laraadmin.adminRoute') .'/leaves/process/'.$value->id) }}" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;">Process</a>
						@endla_access
					@else
						Processed
						
					@endif

					<a href="{{ url(config('laraadmin.adminRoute') .'/leaves/leave_certificate/'.$value->id) }}" data-toggle="tooltip" title="Leave Certificate"  class="btn btn-success btn-xs" target="_blank" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-print"></i></a>
				
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>

@la_access("Leaves", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang("messages.Add Leaf")</h4>
			</div>
			{!! Form::open(['action' => 'LA\LeavesController@store', 'id' => 'leaf-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					{{--
                    @la_form($module)
					
					
					@la_input($module, 'emp_id')
					@la_input($module, 'leave_type_id')
					@la_input($module, 'from_date')
					@la_input($module, 'to_date')
					@la_input($module, 'contact_no')
					@la_input($module, 'location')
					--}}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="rab_id">@lang('messages.RAB ID')* :</label>
								<div>
									<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id"
									id="emp_id" onchange="yearlyLeaveCount()">
									<option value="">@lang('messages.Select')</option>
									@foreach($employees as $employee)
										<option value="{{ $employee->emp_id }}" 
										 >{{ $employee->rab_id }}</option>
									@endforeach	
									</select>	
								</div>		
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="rab_id">@lang('messages.Total Leave Enjoyed') : (@lang('messages.Days'))</label>
								<div>
									<input type="text"  class="form-control" name="total_leave_applied" id="total_leave_applied" value="" disabled=""> 
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="rab_id">@lang('messages.Leave Type') :</label>
								<div>
									<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="leave_type_id"
									id="leave_type_id" onchange="leaveTypeWiseYearlyLeaveCount()">
									<option value="">@lang('messages.Select')</option>
									@foreach($leave_types as $leave_type)
										<option value="{{ $leave_type->id }}" 
										 >{{ $leave_type->leave_type }}</option>
									@endforeach	
									</select>	
								</div>		
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="rab_id">@lang('messages.Leave Enjoyed') : (@lang('messages.Days'))</label>
								<div>
									<input type="text"  class="form-control" name="leave_type_wise_total_leave_applied" id="leave_type_wise_total_leave_applied" value="" disabled="">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
					            @la_input($module, 'from_date')
					        </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
					            @la_input($module, 'to_date')
					        </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="rab_id">@lang('messages.Duration') : (@lang('messages.Days'))</label>
								<div>
									<input type="text" class="form-control" name="duration" id="duration" value="" readonly="">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							@la_input($module, 'contact_no')
						</div>
					</div>
					
					@la_input($module, 'location')
					
										
					{{--
					@la_input($module, 'leave_type_id')
					@la_input($module, 'from_date')
					@la_input($module, 'to_date')
					--}}

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.Close')</button>
				<button type="button" class="btn btn-success" onclick="formSubmit()">@lang('messages.Save')</button>
				
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
    $("#example1").DataTable({
		responsive:false,
	    columnDefs: [ { orderable: false, targets: [-1] }],
	});
	$("#leaf-add-form").validate({
		
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
	    	//alert(duration);
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
	    	//alert(duration);
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
	//alradyLeaveAppliedCheck();
	$("#leaf-add-form").submit();
}
function alradyLeaveAppliedCheck()
{
	var emp_id=$('#emp_id').val();
	if(emp_id)
	{
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
				var to_date=$('#to_date').val('');
			}
		});
	}
	else
	{
		$.alert({
            title: '@lang('messages.Warning')',
            content: '@lang('messages.Select RAB ID')',
        });
        var from_date=$('#from_date').val('');
		var to_date=$('#to_date').val('');
	}
	
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
