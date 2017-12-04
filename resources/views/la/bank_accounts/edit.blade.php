@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/bank_accounts') }}">@lang('messages.Bank Account')</a> :
@endsection
@section("contentheader_description", $bank_account->$view_col)
@section("section", trans("messages.Bank Accounts"))
@section("section_url", url(config('laraadmin.adminRoute') . '/bank_accounts'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Bank Accounts Edit : ".$bank_account->$view_col)

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
			
				{!! Form::model($bank_account, ['route' => [config('laraadmin.adminRoute') . '.bank_accounts.update', $bank_account->id ], 'method'=>'PUT', 'id' => 'bank_account-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					<div class="form-group">
				        	<div class="col-md-2">
				        	<label for="emp_id">@lang('messages.RAB ID')* :</label>
				        	</div>
				        	<div class="col-md-4">
					        	<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id"
					        	id="emp_id" required="" disabled="">
					        	<option value="">@lang('messages.Select')</option>
					        	@foreach($employees as $employee)
					        		@if($employee->emp_id == $bank_account->emp_id)
					        		<option value="{{ $employee->emp_id }}" selected="selected" 
					        		 >{{ $employee->rab_id }}</option>
					        		@else
					        		<option value="{{ $employee->emp_id }}" 
					        		 >{{ $employee->rab_id }}</option>
					        		@endif 
					        	@endforeach	
					        	</select>	
				        	</div>		
						</div>
					@la_edit_input($module, 'bank_acc_name')
					@la_edit_input($module, 'bank_acc_no')
					@la_edit_input($module, 'bank_id')
					@la_edit_input($module, 'bank_branch')
					@la_edit_input($module, 'bank_branch_address')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/bank_accounts') }}">@lang('messages.Cancel')</a></button>
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
	$("#bank_account-edit-form").validate({
		
	});
});
</script>
@endpush
