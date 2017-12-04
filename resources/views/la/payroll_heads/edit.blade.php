@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll_heads') }}">@lang('messages.Payroll Head')</a> :
@endsection
@section("contentheader_description", $payroll_head->$view_col)
@section("section", trans("messages.Payroll Heads"))
@section("section_url", url(config('laraadmin.adminRoute') . '/payroll_heads'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Payroll Heads Edit : ".$payroll_head->$view_col)

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
			
				{!! Form::model($payroll_head, ['route' => [config('laraadmin.adminRoute') . '.payroll_heads.update', $payroll_head->id ], 'method'=>'PUT', 'id' => 'payroll_head-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'name')
					@la_edit_input($module, 'code')
					@la_edit_input($module, 'payroll_type')
					@la_edit_input($module, 'salary_head')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/payroll_heads') }}">@lang('messages.Cancel')</a></button>
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
	$("#payroll_head-edit-form").validate({
		
	});
});
</script>
@endpush
