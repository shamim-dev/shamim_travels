@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/countries') }}">@lang('messages.Country')</a> :
@endsection
@section("contentheader_description", $country->$view_col)
@section("section", trans("messages.Countries"))
@section("section_url", url(config('laraadmin.adminRoute') . '/countries'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Countries Edit : ".$country->$view_col)

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
			
				{!! Form::model($country, ['route' => [config('laraadmin.adminRoute') . '.countries.update', $country->id ], 'method'=>'PUT', 'id' => 'country-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'country_name')
					@la_edit_input($module, 'short_name')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/countries') }}">@lang('messages.Cancel')</a></button>
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
	$("#country-edit-form").validate({
		
	});
});
</script>
@endpush
