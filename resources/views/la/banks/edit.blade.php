@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/banks') }}">@lang('messages.Bank')</a> :
@endsection
@section("contentheader_description", $bank->$view_col)
@section("section", trans("messages.Banks"))
@section("section_url", url(config('laraadmin.adminRoute') . '/banks'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Banks Edit : ".$bank->$view_col)

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
			
				{!! Form::model($bank, ['route' => [config('laraadmin.adminRoute') . '.banks.update', $bank->id ], 'method'=>'PUT', 'id' => 'bank-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'bank_name')
					@la_edit_input($module, 'bank_short_name')
					@la_edit_input($module, 'bank_address')
					@la_edit_input($module, 'bank_cell_no')
					@la_edit_input($module, 'bank_mobile')
					@la_edit_input($module, 'bank_email')
					@la_edit_input($module, 'bank_website')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/banks') }}">@lang('messages.Cancel')</a></button>
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
	$("#bank-edit-form").validate({
		
	});
});
</script>
@endpush
