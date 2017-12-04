@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/attendence_statuses') }}">@lang('messages.Attendence Status')</a> :
@endsection
@section("contentheader_description", $attendence_status->$view_col)
@section("section", trans("messages.Attendence Statuses"))
@section("section_url", url(config('laraadmin.adminRoute') . '/attendence_statuses'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Attendence Statuses Edit : ".$attendence_status->$view_col)

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
			
				{!! Form::model($attendence_status, ['route' => [config('laraadmin.adminRoute') . '.attendence_statuses.update', $attendence_status->id ], 'method'=>'PUT', 'id' => 'attendence_status-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'attend_status')
					@la_edit_input($module, 'as_short_code')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/attendence_statuses') }}">@lang('messages.Cancel')</a></button>
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
	$("#attendence_status-edit-form").validate({
		
	});
});
</script>
@endpush
