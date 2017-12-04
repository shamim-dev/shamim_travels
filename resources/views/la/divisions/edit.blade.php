@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/divisions') }}">@lang('messages.Division')</a> :
@endsection
@section("contentheader_description", $division->$view_col)
@section("section", trans("messages.Divisions"))
@section("section_url", url(config('laraadmin.adminRoute') . '/divisions'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Divisions Edit : ".$division->$view_col)

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
			
				{!! Form::model($division, ['route' => [config('laraadmin.adminRoute') . '.divisions.update', $division->id ], 'method'=>'PUT', 'id' => 'division-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'div_name')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/divisions') }}">@lang('messages.Cancel')</a></button>
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
	$("#division-edit-form").validate({
		
	});
});
</script>
@endpush
