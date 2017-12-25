@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/agent_info') }}">@lang('messages.Agent')</a>
@endsection
@section("contentheader_description")
@section("section", trans("messages.Agent"))
@section("section_url", url(config('laraadmin.adminRoute') . '/agent_info'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", trans("messages.Agent"))

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
	{!! Form::open(['route' => [config('laraadmin.adminRoute') . '.agent_info.update', $agent_info->id ], 'method'=>'PUT', 'id' => 'agent_info-edit-form']) !!}
	<div class="box-body">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="agent_name">@lang('messages.agent_name')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="agent_name" value ="<?php echo $agent_info->agent_name; ?>" id="agent_name" required="1" class="form-control" placeholder="@lang('messages.Enter Name')">
	            </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="mobile_no_1">@lang('messages.mobile_no_1')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="mobile_no_1" value ="<?php echo $agent_info->first_mobile_no; ?>" id="mobile_no_1" required="1" class="form-control" placeholder="@lang('messages.Enter mobile no')">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="mobile_no_2">@lang('messages.mobile_no_2')</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="mobile_no_2" value ="<?php echo $agent_info->second_mobile_no; ?>" id="mobile_no_2" class="form-control" placeholder="@lang('messages.Enter mobile no')">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="email_1">@lang('messages.email_1')</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="email_1" value ="<?php echo $agent_info->first_email; ?>" id="email_1" class="form-control" placeholder="@lang('messages.Enter email')">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="email_2">@lang('messages.email_2')</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="email_2" value ="<?php echo $agent_info->second_email; ?>" id="email_2" class="form-control" placeholder="@lang('messages.Enter email')">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="address">@lang('messages.address')</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<textarea cols="3"  name="address"  id="address"  class="form-control" placeholder="@lang('messages.Enter address')"><?php echo $agent_info->address; ?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-4">
				{!! Form::submit( Lang::get('messages.Update'), ['class'=>'btn btn-success']) !!}
		 		<a href="{{ url(config('laraadmin.adminRoute') . '/agent_info') }}" class="btn btn-default">@lang('messages.Cancel')</a>
			</div>
		</div>

	</div>
	{!! Form::close() !!}
</div>
@endsection