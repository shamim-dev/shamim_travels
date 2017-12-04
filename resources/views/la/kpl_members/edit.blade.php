@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/kpl_members') }}">@lang('messages.KPL Member')</a> :
@endsection
@section("contentheader_description", $kpl_member->$view_col)
@section("section", trans("messages.KPL Members"))
@section("section_url", url(config('laraadmin.adminRoute') . '/kpl_members'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", "KPL Members Edit : ".$kpl_member->$view_col)

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
			
				{!! Form::model($kpl_member, ['route' => [config('laraadmin.adminRoute') . '.kpl_members.update', $kpl_member->id ], 'method'=>'PUT', 'id' => 'kpl_member-edit-form']) !!}
					{{--@ la_form($module) --}}
					
					
					@la_edit_input($module, 'kpl_id')
					@la_edit_input($module, 'chairman')
					@la_edit_input($module, 'member_1')
					@la_edit_input($module, 'member_2')
					
                    <div class="col-md-12">
					<div class="form-group">
						{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/kpl_members') }}">@lang('messages.Cancel')</a></button>
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
	$("#kpl_member-edit-form").validate({
		
	});
});
</script>
@endpush
