@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/upazillas') }}">@lang('messages.Upazilla')</a> :
@endsection
@section("contentheader_description", $upazilla->$view_col)
@section("section", trans("messages.Upazillas"))
@section("section_url", url(config('laraadmin.adminRoute') . '/upazillas'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Upazillas Edit : ".$upazilla->$view_col)

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
			
				{!! Form::model($upazilla, ['route' => [config('laraadmin.adminRoute') . '.upazillas.update', $upazilla->id ], 'method'=>'PUT', 'id' => 'upazilla-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'district_id')
					@la_edit_input($module, 'upazilla_name')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/upazillas') }}">@lang('messages.Cancel')</a></button>
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
	$("#upazilla-edit-form").validate({
		
	});
});
</script>
@endpush
