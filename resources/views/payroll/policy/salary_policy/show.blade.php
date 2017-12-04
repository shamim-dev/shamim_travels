
@extends("la.layouts.app")


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/issues/store_issues') }}">@lang('messages.Back To List')</a>
@endsection
@section("main-content")
<div class="box box-success">
	<div class="box-header">
	</div>
	
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="receive_voucher_no">@lang('messages.Voucher No')*</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->issue_voucher_no or null }}
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="receive_voucher_no">@lang('messages.Date')*</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
		               <?php 
		                if(isset($issue_info->issue_date)){
		                	echo App\Helpers\CommonHelper::showDateFormat($issue_info->issue_date);
		                }?>
		            </div>
	            </div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.From')*</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->from_store or null }}
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-md-1">
				<div class="form-group">
					<label for="battalion_id">@lang('messages.Battalion')*</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_battalion_name or null }}
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="wing_id">@lang('messages.Wing')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_wing_name or null }}
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="branch_id">@lang('messages.Branch')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_branch_name or null }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="sub_branch_id">@lang('messages.Sub-branch')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_sb_name or null }}
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="section_id">@lang('messages.Section')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_section_name or null }}
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="sub_section_id">@lang('messages.Sub-section')</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_sub_section_name or null }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="org_store_id">@lang('messages.To')*</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->to_store or null }}
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group">
					<label for="org_store_id">@lang('messages.Recipient')*</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ $issue_info->rab_id or null }}
				</div>
			</div>
			
		</div>

	<table class="table table-bordered">
		<thead>
			<tr class="success">
				<th>@lang('messages.Serial No.')</th>
				<th>@lang('messages.Item')</th>
				<th>@lang('messages.Category')</th>
				<th>@lang('messages.Group')</th>
				<th>@lang('messages.Unit')</th>
				<th>@lang('messages.Svc')</th>
				<th>@lang('messages.Un Svc')</th>
				<th>@lang('messages.Repairable')</th>
				<th>@lang('messages.Un Repairable')</th>
				<th>@lang('messages.Brand')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($issue_items as $key=>$issue_item)	
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $issue_item->item_name }}</td>
				<td>{{ $issue_item->item_cat_name }}</td>
				<td>{{ $issue_item->item_group_name }}</td>
				<td>{{ $issue_item->mm_unit_name }}</td>
				<td align="right">{{ App\Helpers\CommonHelper::round_number_format($issue_item->svc_qty) }}</td>
				<td align="right">{{ App\Helpers\CommonHelper::round_number_format($issue_item->unsvc_qty) }}</td>
				<td align="right">{{ App\Helpers\CommonHelper::round_number_format($issue_item->repairable_qty) }}</td>
				<td align="right">{{ App\Helpers\CommonHelper::round_number_format($issue_item->unrepairable_qty) }}</td>
				<td>{{ $issue_item->brand_name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection




