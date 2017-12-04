@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/relations') }}">@lang('messages.Relation')</a> :
@endsection
@section("contentheader_description", $relation->$view_col)
@section("section", trans("messages.Relations"))
@section("section_url", url(config('laraadmin.adminRoute') . '/relations'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "Relations Edit : ".$relation->$view_col)

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
			
				{!! Form::model($relation, ['route' => [config('laraadmin.adminRoute') . '.relations.update', $relation->id ], 'method'=>'PUT', 'id' => 'relation-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'name')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/relations') }}">@lang('messages.Cancel')</a></button>
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
	$("#relation-edit-form").validate({
		
	});
});
</script>
@endpush
