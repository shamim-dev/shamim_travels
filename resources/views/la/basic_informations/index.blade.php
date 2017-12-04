@extends("la.layouts.app")

@section("contentheader_title", trans("messages.Basic Informations"))
@section("contentheader_description", trans("messages.Basic Informations listing"))
@section("section", trans("messages.Basic Informations"))
@section("sub_section", trans("messages.Listing"))
@section("htmlheader_title", trans("messages.Basic Informations listing"))

@section("headerElems")
@la_access("Basic_Informations", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">@lang("messages.Add Basic Information")</button>
@endla_access
@endsection

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
		<div class="col-md-4 pull-right">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search by: RAB ID" aria-describedby="search-addon" name="search" id="search">
			 	<span class="input-group-addon" id="search-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
			</div>
		</div>
	</div>
	<div class="box-body">
		<table id="example1" class="table table-bordered">
			<thead>
				<tr class="success">
					<th>@lang('messages.Serial No.')</th>
					<th>@lang('messages.RAB ID')</th>
					<th>@lang('messages.Personal No.')</th>
					<th>@lang('messages.Name')</th>
					<th>@lang('messages.Rank')</th>
					<th>@lang('messages.Religion')</th>
					<th>@lang('messages.Gender')</th>
					<th>@lang('messages.Marital Status')</th>
					<th>@lang('messages.DOB')</th>
					<th>@lang('messages.Blood Group')</th>
					<th>@lang('messages.Job Joining Date')</th>
					@if($show_actions)
					<th>@lang('messages.Actions')</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($values as $key=>$value)
				<tr>
					<td>{{ $values->firstItem() + $key }}</td>
					<td><a href="{{ url(config('laraadmin.adminRoute').'/basic_informations/'.$value->id) }}">{{ $value->rab_id }}</a></td>
					<td>{{ $value->personal_no }}</td>
					<td>{{ $value->emp_name }}</td>
					<td>{{ $value->rank_short_name }}</td>
					<td>{{ $value->religion }}</td>
					<td>{{ $value->gender }}</td>
					<td>{{ $value->marital_status }}</td>
					<td>{{ $value->dob }}</td>
					<td>{{ $value->blood_group }}</td>
					<td><?php 
						if(isset($value->job_join_date)){
							echo App\Helpers\CommonHelper::showDateFormat($value->job_join_date);
						}?>
					</td>
					<td>
						@la_access("Basic_Informations", "edit")
						<a href="{{ url(config('laraadmin.adminRoute') .'/basic_informations/'.$value->id.'/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>										
						@endla_access
						@la_access("Basic_Informations", "delete")	
						{!! Form::open(['route' => [config('laraadmin.adminRoute') . '.basic_informations.destroy', $value->id],'method' => 'delete','style'=>'display:inline']) !!}
						<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
						{!! Form::close() !!}
						@endla_access
					
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<?php echo $values->render();?>
	</div>
</div>

<div style="background: white;padding: 10px">
	Showing {{ $values->perPage() }} entries per page
	Current Page {{ $values->currentPage() }}
	Total Entries {{ $values->total() }}
</div>

@la_access("Basic_Informations", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang("messages.Add Basic Information")</h4>
			</div>
			{!! Form::open(['action' => 'LA\Basic_InformationsController@store', 'id' => 'basic_information-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="emp_id">@lang('messages.RAB ID')*:</label>
								<select class="form-control" required="1" data-placeholder="@lang('messages.Select')"  rel="select2" name="emp_id" id="emp_id" onchange="employeeInfo()">
					        	<option value="">@lang('messages.Select')</option>
					        	@foreach($employees as $employee)
					        		<option value="{{ $employee->emp_id }}" 
					        		 >{{ $employee->rab_id }}</option>
					        	@endforeach	
					        	</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="emp_name">@lang('messages.Name'):</label>
								<input type="text" name="emp_name" class="form-control" id="emp_name" placeholder="@lang('messages.Name')" disabled="">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="bn_name">English Name:</label>
								<input type="text" name="bn_name" class="form-control" id="bn_name" placeholder="Enter English Name">
							</div>
						</div>
						<div class="col-md-3">
							@la_input($module, 'dob')
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'birth_place')
						</div>
						<div class="col-md-3">
							@la_input($module, 'gender')
						</div>
						<div class="col-md-3">
							@la_input($module, 'religion')
						</div>
						<div class="col-md-3">
							@la_input($module, 'marital_status')
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'nationality')
						</div>
						<div class="col-md-3">
							@la_input($module, 'height')
						</div>
						<div class="col-md-3">
							@la_input($module, 'weight')
						</div>
						<div class="col-md-3">
							{{-- @la_input($module, 'blood_group') --}}
							<div class="form-group">
								<label for="blood_group">@lang('messages.Blood Group'):</label>
								<select class="form-control" data-placeholder="@lang('messages.Select')"  rel="select2" name="blood_group" id="blood_group">
					        	<option value="">@lang('messages.Select')</option>
				        		<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
					        	</select>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'national_id')
						</div>
						<div class="col-md-3">
							@la_input($module, 'passport_no')
						</div>
						<div class="col-md-3">
							@la_input($module, 'id_card_no')
						</div>
						<div class="col-md-3">
							@la_input($module, 'punch_card_no')
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'driving_license')
						</div>
						<div class="col-md-3">
							@la_input($module, 'job_join_date')
						</div>
						<div class="col-md-3">
							@la_input($module, 'tribal')
						</div>
						<div class="col-md-3">
							@la_input($module, 'freedom_fighter')
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'tel_ofc')
						</div>
						<div class="col-md-3">
							@la_input($module, 'tel_home')
						</div>
						<div class="col-md-3">
							@la_input($module, 'cell_ofc')
						</div>
						<div class="col-md-3">
							@la_input($module, 'cell_personal_1')
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'cell_personal_2')
						</div>
						<div class="col-md-3">
							@la_input($module, 'email_ofc')
						</div>
						<div class="col-md-3">
							@la_input($module, 'email_personal')
						</div>
						<div class="col-md-3">
							@la_input($module, 'fax_ofc')
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'fax_home')
						</div>
						<div class="col-md-3">
							@la_input($module, 'pabx')
						</div>
						<div class="col-md-3">
							@la_input($module, 'hoby')
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="academy_course_id">@lang('messages.Academy Course'):</label>
								<select class="form-control" rel="select2" name="academy_course_id"
					        	id="academy_course_id">
					        	<option value="">@lang('messages.Select')</option>
					        	@foreach($academy_courses as $academy_course)
					        		<option value="{{ $academy_course->id }}" 
					        		 >{{ $academy_course->academy_course_name }}</option>
					        	@endforeach	
					        	</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							@la_input($module, 'photo')
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.Close')</button>
				{!! Form::submit( Lang::get('messages.Save'), ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>

$(function () {
	$('#example1').DataTable( {
	    responsive: false,
	    columnDefs: [ { orderable: false, targets: [-1] }],
	    //pagination: false,
	    //bPaginate: false,
	    paging: false,
	    bInfo : false,
	    bFilter: false /* Hide default Search Box */
	} );

	var minlength = 2;
	$('#search').keyup( function() {
		// alert('ok');
        // table.draw();
        var that = this,
        value = $(this).val();

        if (value.length >= minlength ) {
            // if (searchRequest != null)
                // searchRequest.abort();

            	// searchRequest = $.ajax({
            $.ajax({
                type: "GET",
                url: "{{ url(config('laraadmin.adminRoute') . '/filter_basic_informations') }}",
                data: {
                    'search_keyword' : value
                },
                dataType: "json",
                success: function(result){
                	// console.log(result);
                	// alert(result.rab_id);
				    var trHTML = '';
				    $.each(result, function(index) {
				    	console.log(result);

					var editlink = "<a href=\"{{ url(config('laraadmin.adminRoute').'/basic_informations') }}" + "/" + result[index].id + "/edit" +
					        "\" class=\"btn btn-warning btn-xs\" style=\"display:inline;padding:2px 5px 3px 5px;\"><i class=\"fa fa-edit\"></i></a>";

				    var deletelink = "<form action=\"{{ url(config('laraadmin.adminRoute').'/basic_informations') }}" + "/" + result[index].id + "\" method='post' style='display:inline'><input type='hidden' name='_method' value='DELETE'><input type='hidden' name='_token' value=\"{{ csrf_token() }}\"><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i></button></form>";

				    trHTML +='<tr>';
				    	trHTML +='<td>';
				    		trHTML += result[index].emp_id;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].rab_id;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].personal_no;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].emp_name;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].rank_short_name;
				    	trHTML +='</td>';				    	
				    	trHTML +='<td>';
				    		trHTML += result[index].religion;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].gender;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].marital_status;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].dob;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].blood_group;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += result[index].job_join_date;
				    	trHTML +='</td>';
				    	trHTML +='<td>';
				    		trHTML += editlink;
				    		trHTML += ' ';
				    		trHTML += deletelink;
				    	trHTML +='</td>';
				    trHTML +='</tr>';

					

				    });
				    $('#example1').find('tbody').empty();
				    $('#example1').find('tbody').html(trHTML);
                }
            });
        }
        else if(value.length == 0 ){
	    	var trHTML = '@foreach($values as $key=>$value)';
				trHTML += '<tr>'
					trHTML += '<td>{{ $values->firstItem() + $key }}</td>';
					trHTML += '<td><a href="{{ url(config("laraadmin.adminRoute")."/basic_informations/".$value->id) }}">{{ $value->rab_id }}</a></td>';
					trHTML += '<td>{{ $value->personal_no }}</td>';
					trHTML += '<td>{{ $value->emp_name }}</td>';
					trHTML += '<td>{{ $value->rank_short_name }}</td>';
					trHTML += '<td>{{ $value->religion }}</td>';
					trHTML += '<td>{{ $value->gender }}</td>';
					trHTML += '<td>{{ $value->marital_status }}</td>';
					trHTML += '<td>{{ $value->dob }}</td>';
					trHTML += '<td>{{ $value->blood_group }}</td>';
					trHTML += '<td><?php 
								if(isset($value->job_join_date)){
									echo App\Helpers\CommonHelper::showDateFormat($value->job_join_date);
								}?></td>';
					trHTML += '<td>';
					trHTML += '@la_access("Basic_Informations", "edit")';
					trHTML += '<a href="{{ url(config("laraadmin.adminRoute") ."/basic_informations/".$value->id."/edit") }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
					trHTML += '@endla_access';
					trHTML += ' ';
					trHTML += '@la_access("Basic_Informations", "delete")';
					trHTML += '{!! Form::open(["route" => [config("laraadmin.adminRoute") . ".basic_informations.destroy", $value->id],"method" => "delete","style"=>"display:inline"]) !!}';
					trHTML += '<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>';
					trHTML += '{!! Form::close() !!}';
					trHTML += '@endla_access';
					trHTML += '</td>';
				trHTML += '</tr>';
				trHTML += '@endforeach';

         	$('#example1').find('tbody').empty();
			$('#example1').find('tbody').html(trHTML);
        }
    } );

});

function employeeInfo(){
	var emp_id=$('#emp_id option:selected').val();
	if(emp_id>0){
		var url="{{ url('/admin/get_emp_info') }}";
		$.post(url,{'emp_id':emp_id},function( data ) {
			$("#emp_name").val(data.emp_name);
		});
	}else{
		$("#emp_name").val('');

	}
}
</script>
@endpush
