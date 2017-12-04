@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/designations') }}">@lang('messages.Designation')</a> :
@endsection
@section("contentheader_description", $designation->$view_col)
@section("section", trans("messages.Designations"))
@section("section_url", url(config('laraadmin.adminRoute') . '/designations'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Designations Edit : ".$designation->$view_col)

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
			
				{!! Form::model($designation, ['route' => [config('laraadmin.adminRoute') . '.designations.update', $designation->id ], 'method'=>'PUT', 'id' => 'designation-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'designation_name')
					@la_edit_input($module, 'desig_short_name')
					@la_edit_input($module, 'designation_level')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/designations') }}">@lang('messages.Cancel')</a></button>
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
	$("#designation-edit-form").validate({
		
	});
});
</script>
@endpush
