@extends("la.layouts.app")

@section("contentheader_title", trans("messages.regular salary est afd"))
@section("contentheader_description", trans("messages.regular salary est afd desc"))
@section("htmlheader_title", trans("messages.regular salary est afd"))
@section("headerElems")
@endsection

@section("main-content")
	<div class="box box-success">
		<div class="box-body">
			<form id="print-form" class="" action="{{ $print_url }}" method="post">
				{{ csrf_field() }}
				<div class="row">
				    <div class="col-md-2">
						<div class="form-group">
							<label for="rab_id" class="pull-right">@lang('messages.RAB ID')<span class="la-required"> *</span></label>
					    </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
					        <select class="form-control" required="1" multiple="true" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id[]" id="emp_id" >
					        	<option value="">@lang('messages.Select')</option>
					        	<option value="all">@lang('messages.All')</option>
					        	@foreach($employees as $employee)
					        		<option value="{{ $employee->emp_id }}" 
					        		 >{{ $employee->rab_id }}</option>
					        	@endforeach	
					        </select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<div class="col-md-2">
							    <button type="submit" class="btn btn-success ">@lang('messages.Submit')</button>
						    </div>
						</div>
					</div>    
				</div>
			</form>
		</div>
	</div>
@endsection

<script type="text/javascript">
	
</script>