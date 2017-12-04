@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/districts') }}">@lang('messages.District')</a> :
@endsection
@section("contentheader_description", $district->$view_col)
@section("section", trans("messages.Districts"))
@section("section_url", url(config('laraadmin.adminRoute') . '/districts'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Districts Edit : ".$district->$view_col)

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
			
				{!! Form::model($district, ['route' => [config('laraadmin.adminRoute') . '.districts.update', $district->id ], 'method'=>'PUT', 'id' => 'district-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'division_id')
					@la_edit_input($module, 'dis_name')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/districts') }}">@lang('messages.Cancel')</a></button>
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
	$("#district-edit-form").validate({
		
	});
});
</script>
@endpush
