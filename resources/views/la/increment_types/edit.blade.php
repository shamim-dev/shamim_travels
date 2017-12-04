@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/increment_types') }}">@lang('messages.Increment Type')</a> :
@endsection
@section("contentheader_description", $increment_type->$view_col)
@section("section", trans("messages.Increment Types"))
@section("section_url", url(config('laraadmin.adminRoute') . '/increment_types'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Increment Types Edit : ".$increment_type->$view_col)

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
			
				{!! Form::model($increment_type, ['route' => [config('laraadmin.adminRoute') . '.increment_types.update', $increment_type->id ], 'method'=>'PUT', 'id' => 'increment_type-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'increment_type')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/increment_types') }}">@lang('messages.Cancel')</a></button>
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
	$("#increment_type-edit-form").validate({
		
	});
});
</script>
@endpush
