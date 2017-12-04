@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Bank Accounts"))
@section("contentheader_description", trans("messages.Bank Accounts listing"))
@section("section", trans("messages.Bank Accounts"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Bank Accounts listing"))

@section("headerElems")
@la_access("Bank_Accounts", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">@lang("messages.Add Bank Account")</button>
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
			@foreach( $listing_cols as $col )
				@if($col=='id')
					<th>@lang('messages.Serial No.')</th>
				@else
					<th>
					@php 
						if(isset($module->fields[$col]['label']))
						{
							$v_col=$module->fields[$col]['label'];
						}
						else
						{
							$v_col=ucfirst($col);
						}						
					@endphp
					{{ Lang::get('messages.'.$v_col) }}
					</th>
				@endif
			@endforeach
			@if($show_actions)
			<th>@lang('messages.Actions')</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Bank_Accounts", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang("messages.Add Bank Account")</h4>
			</div>
			{!! Form::open(['action' => 'LA\Bank_AccountsController@store', 'id' => 'bank_account-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    <div class="col-md-12">
						<div class="form-group">
				        	<label for="emp_id">@lang('messages.RAB ID')* :</label>
				        	<div>
					        	<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id"
					        	id="emp_id" required="" >
					        	<option value="">@lang('messages.Select')</option>
					        	@foreach($employees as $employee)
					        		<option value="{{ $employee->emp_id }}" 
					        		 >{{ $employee->rab_id }}</option>
					        	@endforeach	
					        	</select>	
				        	</div>		
						</div>

					@la_input($module, 'bank_acc_name')
					@la_input($module, 'bank_acc_no')
					@la_input($module, 'bank_id')
					@la_input($module, 'bank_branch')
					@la_input($module, 'bank_branch_address')
					
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
	var t=$("#example1").DataTable({
		processing: true,
        //serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/bank_account_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	t.on( 'order.dt search.dt', function () 
	{
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) 
        {
            cell.innerHTML = i+1;
        } );
    }).draw();
	$("#bank_account-add-form").validate({
		
	});
});
</script>
@endpush
