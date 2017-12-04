@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/bank_branches') }}">Bank Branch</a> :
@endsection
@section("contentheader_description", $bank_branch->$view_col)
@section("section", "Bank Branches")
@section("section_url", url(config('laraadmin.adminRoute') . '/bank_branches'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Bank Branches Edit : ".$bank_branch->$view_col)

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
				{!! Form::model($bank_branch, ['route' => [config('laraadmin.adminRoute') . '.bank_branches.update', $bank_branch->id ], 'method'=>'PUT', 'id' => 'bank_branch-edit-form']) !!}
					{{-- @la_form($module) --}}
					
					@la_edit_input($module, 'bank_branch_name')
					@la_edit_input($module, 'bank_id')
					@la_edit_input($module, 'bank_branch_address')
					@la_edit_input($module, 'bank_branch_cell')
					@la_edit_input($module, 'bank_branch_mobile')
					@la_edit_input($module, 'bank_branch_email')
					
                    <br>
					<div class="col-md-12 text-center">
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default"><a href="{{ url(config('laraadmin.adminRoute') . '/bank_branches') }}">Cancel</a></button>
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
	$("#bank_branch-edit-form").validate({
		
	});
});
</script>
@endpush
