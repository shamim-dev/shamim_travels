@extends('la.layouts.app')

@section('htmlheader_title')
	Basic Information View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
	<div class="bg-success clearfix">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-3">
					<div class="profile-icon text-primary"><i class="fa {{ $module->fa_icon }}"></i></div>
				</div>
				<div class="col-md-9">
					<h4 class="name">{{ $show_info->emp_name }}</h4>					
				</div>
			</div>
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-4">			
		</div>
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/basic_informations') }}" data-toggle="tooltip" data-placement="right" title="Back to Basic Informations"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> @lang('messages.General Info')</a></li>		
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>@lang('messages.General Info')</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							@la_display($module, 'photo')
						</div>
						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.RAB ID')</label>
							</div>
							<div class="col-md-4">
								{{ $show_info->rab_id }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Name')</label>
							</div>
							<div class="col-md-4">
								{{ $show_info->emp_name }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Date of Birth')</label>
							</div>
							<div class="col-md-4">
								@if(isset($basic_information->dob))
								{{ App\Helpers\CommonHelper::showDateFormat($basic_information->dob) }}
								@endif
								{{-- $basic_information --}}
								
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Birth Place')</label>
							</div>
							<div class="col-md-4">
								{{ $show_info->dis_name }}
							</div>

						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Gender')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->gender }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Religion')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->religion }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Marital Status')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->marital_status }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Nationality')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->nationality }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Height')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->height }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Weight')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->weight }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Blood Group')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->blood_group }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.National ID')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->national_id }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Passport No.')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->passport_no }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.ID No.')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->id_card_no }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Punch Card No.')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->punch_card_no }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Driving License')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->driving_license }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Job Join Date')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->job_join_date }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Tribal')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->tribal }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Freedom Fighter')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->freedom_fighter }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Telephone Office')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->tel_ofc }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Telephone Home')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->tel_home }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Cell Office')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->cell_ofc }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Cell Personal 1')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->cell_personal_1 }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Cell Personal 2')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->cell_personal_2 }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.Email Office')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->email_ofc }}
							</div>
							<div class="col-md-2">
								<label for="">@lang('messages.Email Personal')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->email_personal }}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<label for="">@lang('messages.hoby')</label>
							</div>
							<div class="col-md-4">
								{{ $basic_information->hoby }}
							</div>
							@la_display($module, 'academy_course_id')
						</div>

					</div>
				</div>
			</div>
		</div>		
	</div>
	</div>
	</div>
</div>
@endsection
