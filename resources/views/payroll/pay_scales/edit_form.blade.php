@extends("la.layouts.app")


@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/payroll/pay_scales') }}">@lang('messages.Pay Scale')</a>
@endsection
@section("contentheader_description")
@section("section", trans("messages.Pay Scale"))
@section("section_url", url(config('laraadmin.adminRoute') . '/payroll/pay_scales'))
@section("sub_section", trans("messages.Edit"))

@section("htmlheader_title", trans("messages.Pay Scale"))

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

	{!! Form::open(['route' => [config('laraadmin.adminRoute') . '.payroll.pay_scales.update', $payroll_pay_scale->id ], 'method'=>'PUT', 'id' => 'payroll_pay_scale-edit-form']) !!}

	<input type="hidden" name="policy_type" value="1">
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="receive_voucher_no">@lang('messages.Pay Scale Name')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<input type="text" name="pay_scale_name" id="pay_scale_name" class="form-control" required="1" placeholder="@lang('messages.Enter Pay Scale Name')" maxlength="100" value="{{ $payroll_pay_scale->pay_scale_name or null }}">
				</div>
			</div>
			
		</div>


	@foreach($payroll_pay_scale_details as $key=>$payroll_pay_scale_detail)		
	<div class="reference reference{{ ++$key }}">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label style="text-decoration:underline">Payroll Head {{ $key }}</label>
				</div>
			</div>

			
			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Year')<span class="la-required">*</span></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<input class="form-control" type="text" name="pay_scale_year[]" min="1" required="1" value="{{ $payroll_pay_scale_detail->pay_scale_year }}" readonly="">
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					<label for="item_id">@lang('messages.Amount')&nbsp</span><span id="span-tk-1">(Tk.)</span><span class="la-required">*</span></label>
					
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
		        	<input class="form-control" type="number" name="amount[]" min="1" required="1" value="{{ $payroll_pay_scale_detail->pay_scale_amount }}">
				</div>
			</div>
			

		</div>
	</div>
	@endforeach
	
		<div class="row">
			<div class="col-md-12 text-right">
			<p><a class="add_more_reference btn btn-primary" style="cursor:pointer" id="{{ $key }}" onclick="add_reference()">@lang('messages.Add More')</a></p><input type="hidden" name="n" id="{{ $key }}" value="{{ $key }}" />
			</div>
		</div>


	<div>
		{!! Form::submit( Lang::get('messages.Save'), ['class'=>'btn btn-success']) !!}
		 <a href="{{ url(config('laraadmin.adminRoute') . '/payroll/pay_scales') }}" class="btn btn-default">@lang('messages.Cancel')</a>
	</div>
	{!! Form::close() !!}
</div>



@endsection


@push('scripts')
<script type="text/javascript">
	$(function () {
		$("#payroll_pay_scale-edit-form").validate({
			
		});
	});



function add_reference()
{ 
	var i = parseInt(jQuery("a.add_more_reference").attr("id"));
	var i_add = i+1;

	var add_reference = '<div class="reference reference'+i_add+'" style="display:none;" >';
	add_reference += '<div class="row">';
	add_reference += '<div class="col-md-12">';
	add_reference += '<div class="form-group">';
	add_reference += '<label style="text-decoration:underline">Pay Scale '+i_add+'</label>';
	add_reference += '</div>';
	add_reference += '</div>';

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Year')<span class="la-required">*</span></label>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<input class="form-control" type="text" name="pay_scale_year[]" min="1" required="1"  readonly="" value="'+i_add+'">';
				add_reference += '</div>';
			add_reference += '</div>';

			add_reference += '<div class="col-md-1">';
				add_reference += '<div class="form-group">';
					add_reference += '<label for="item_id">@lang('messages.Amount')&nbsp</span><span id="span-tk-'+i_add+'">(Tk.)</span><span class="la-required">*</span>';
				add_reference += '</div>';
			add_reference += '</div>';
			add_reference += '<div class="col-md-2">';
				add_reference += '<div class="form-group">';
		        	add_reference += '<input class="form-control" type="number" name="amount[]" min="1" required="1">';
				add_reference += '</div>';
			add_reference += '</div>';

			add_reference +='<div class="col-md-12 text-right">';
			add_reference +='<div class="form-group">';
			add_reference +='<a id="del_reference'+i_add+'" class="btn btn-primary" style="cursor:pointer" onclick="delete_reference('+i_add+')">@lang('messages.Remove')</a>';
			add_reference +='</div>';
			add_reference +='</div>';

		add_reference += '</div>';		
	add_reference += '</div>';
		
	jQuery("#n").val(i_add);
	jQuery("a.add_more_reference").attr("id",i_add);
	jQuery('div.reference').last().after(add_reference);
	jQuery('div.reference'+i_add).slideToggle();
	$("select.form-control").select2();		
}

function delete_reference(n){
	jQuery("div.reference"+n).slideToggle(function(){jQuery(this).remove()});
	jQuery("a.add_more_reference").attr("id",n-1);
}
</script>
@endpush
