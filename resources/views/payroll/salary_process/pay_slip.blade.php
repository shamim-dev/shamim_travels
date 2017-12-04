
<html>
<head>	
	<title>@hasSection('htmlheader_title')@yield('htmlheader_title') - @endif{{ LAConfigs::getByKey('sitename') }}</title>    
</head>
<style type="text/css">
	table {
	    width: 100%;
	    border-collapse: collapse;
	}
	table.blank, table.blank td, table.blank td {
		width: 70%;
	    padding: 5px;
	    border:0;
	}
	table, td, th {
	    border: 1px solid black;
	    padding: 3px;
	}
	.text-center {
		text-align: center;
	}
	.text-left {
		text-align: left;
	}
	.text-right {
		text-align: right;
	}
	.active {
		background-color: #CCC;
	}
</style>
<body>

<p style="text-align: center"><u><b>@lang('messages.Pay Scale') of {{ $salary_emp_info->salary_date or null }}</b></u></p>

<div>
	<div style="width: 50%;float: left">
		<table class="blank">
			<tr>
				<td>@lang('messages.Personal No.')</td>
				<td>{{ $salary_emp_info->personal_no or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.RAB ID') </td>
				<td>{{ $salary_emp_info->rab_id or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Name')</td>
				<td>{{ $salary_emp_info->emp_name or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Rank')</td>
				<td>{{ $salary_emp_info->rank_short_name or null }}</td>
			</tr>
			<tr class="active">
				<td>@lang('messages.Salary')</td>
				<td><b>{{ $salary_emp_info->salary_amount or null }} Taka</b></td>
			</tr>
		</table>
	</div>

	<div style="width: 50%;float: right">
		<table class="blank">
			<tr>
				<td>@lang('messages.Battalion')</td>
				<td>{{ $salary_emp_info->battalion_name or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Wing') </td>
				<td>{{ $salary_emp_info->wing_name or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Branch')</td>
				<td>{{ $salary_emp_info->branch_name or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Sub Branch')</td>
				<td>{{ $salary_emp_info->sb_name or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Section') </td>
				<td>{{ $salary_emp_info->section_name or null }}</td>
			</tr>
			<tr>
				<td>@lang('messages.Sub Section')</td>
				<td>{{ $salary_emp_info->sub_section_name or null }}</td>
			</tr>
		</table>
	</div>	
</div>
	
	<?php $total_earnings=0;
	$total_deductions=0;
	?>
	<br>
	<table>
		<caption style="color: green"><h3>Monthly Earnings</h3></caption>
		<tr>
			<th>@lang('messages.Serial No.')</th>
			<th>@lang('messages.Payroll Head')</th>
			<th>@lang('messages.Pay Scale')</th>
			<th>@lang('messages.Allowance')</th>
			<th>@lang('messages.From')</th>
			<th>@lang('messages.To')</th>
			<th>@lang('messages.Amount')</th>
		</tr>
		@foreach($earnings as $key=>$earning)	
		<tr>
			<td>{{ ++$key }}</td>
			<td>
			@if($earning->process_type==3)
				{{ $earning->pay_scale_head_name }} ({{ $earning->basic_salary }})
			@else
				{{ $earning->payroll_head_name }}
			@endif
			</td>
			<td>{{ $earning->pay_scale_name }}</td>
			<td>{{ $earning->allowance_name }}</td>
			<td>{{ $earning->from_date }}</td>
			<td>{{ $earning->to_date }}</td>
			<td align="right"><b>{{ $earning->amount }}</b></td>
		</tr>
		<?php $total_earnings+=$earning->amount ;?>
		@endforeach
		<tr class="active">
			<td colspan="6"><b>@lang('messages.Total Earnings')</b></td>
			<td align="right"><b><?php echo number_format($total_earnings,2)?></b></td>
		</tr>
	</table>

	<table>
		<caption style="color: red"><h3>Monthly Deductions</h3></caption>
		<tr>
			<th>@lang('messages.Serial No.')</th>
			<th>@lang('messages.Payroll Head')</th>
			<th>@lang('messages.Deduction')</th>
			<th>@lang('messages.From')</th>
			<th>@lang('messages.To')</th>
			<th>@lang('messages.Amount')</th>
		</tr>
		@foreach($deductions as $key=>$deduction)	
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $deduction->payroll_head_name or null }}</td>
			
			<td>{{ $deduction->deduction_name or null}}</td>
			<td>{{ $deduction->from_date }}</td>
			<td>{{ $deduction->to_date }}</td>
			<td align="right">{{ $deduction->amount }}</td>
		</tr>
		<?php $total_deductions+=$deduction->amount ;?>
		@endforeach
		<tr class="active">
			<td colspan="5"><b>@lang('messages.Total Deductions')</b></td>
			<td align="right"><b><?php echo number_format($total_deductions,2)?></b></td>
		</tr>
	</table>

	<br>
	<table>
		<tr>
			<td>@lang('messages.Total Earnings')</td>
			<td align="right"><b><?php echo number_format($total_earnings,2)?></b></td>
		</tr>
		<tr>
			<td>@lang('messages.Total Deductions')</td>
			<td align="right"><b>- <?php echo number_format($total_deductions,2)?></b></td>
		</tr>
		<tr class="active">
			<td><b>@lang('messages.Net Payable')</b></td>
			<td align="right"><u><b><?php echo number_format($salary_emp_info->salary_amount,2)?></b></u></td>
		</tr>
	</table>
	

</body>
</html>	



