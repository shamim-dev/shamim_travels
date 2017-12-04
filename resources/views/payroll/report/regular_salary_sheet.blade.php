
<html>
<head>
	<title>@hasSection('htmlheader_title')@yield('htmlheader_title') - @endif{{ LAConfigs::getByKey('sitename') }}</title>
</head>
<!-- @page { sheet-size: L; } -->
<style type="text/css">
	/*@media print {
            tr.page-break  { display: block; page-break-before: always; }
        } */

        table tr.page-break{
  page-break-after:always
} 

	table {
	    width: 100%;
	    border-collapse: collapse;
	}
	table.blank, table.blank td, table.blank td {
	    padding: 5px;
	    border:0;
	    vertical-align: top;
  		text-align: left;
	}
	table, td, td {
	    border: 1px solid black;
	    padding: 3px;
			vertical-align: top;
  		text-align: left;
	}
	table.cat, table.cat tr{
		padding: 5px;
	    border:1;
	}
	.box-stamp{
		width: 80px;
	    height: 80px;
	    border: 1px solid black;
	    text-align: center;
	}
	ul {
		list-style-type: none;
		padding-left: 0px;
	}
	li {
		 padding-left: 0px;
		 text-align: justify;
	}
	.blank tr td.column {
		border-left: 1px solid black;
		border-bottom: 1px solid black;
	}

	/*div.breakNow { page-break-inside:avoid; page-break-after:always; }*/
	
    .break { page-break-before: always; }    


</style>
<body>

	<!-- 2nd Page -->
	<p style="text-align: left">টি। আর ফরম নং ১৫/এ <br> [এস আর ১৫০ (১) দ্রষ্টব্য] এর পরিবর্তে</p>
	<p style="text-align: center">
		<u>সংস্থাপন কর্মকর্তা/কর্মচারীদের বেতন বিল<br>
		অফিসের নামঃ {{ $battalion->battalion_name or null }} <br>
		{{ $battalion->battalion_address or null }} । <br>
		নিয়মিত বেতন ও ভাতা বিল- <?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?></u>
	</p>
	<table>
		<tbody>
			<!-- heading start -->
			<tr>
				<td rowspan="2">পদের ক্রমিক নং</td>
				<td rowspan="2" style="text-align: center;">সেরেস্তার শাখা ও পদস্থ <br> কর্মকর্তা/কর্মচারীদের নাম</td>
				<?php
					$allowance_except_others=DB::SELECT("SELECT `id`,`name`,`payroll_type`,`salary_head`,`code`
					FROM  `payroll_heads` 
					WHERE  `payroll_type` ='1'
					and `deleted_at` is null
					and id NOT IN (1,22)
					order by id asc");
				?>
				<td rowspan="2">মূল বেতন *৪৬০১ </td>
				@foreach($allowance_except_others as $allowance_except_other)
				<td rowspan="2">{{ $allowance_except_other->name or null}} *{{ $allowance_except_other->code or null}}</td>
				@endforeach

				<?php
					$allowance_others=DB::SELECT("SELECT pa.id,pa.allowance_name,ph.name,ph.code,ph.payroll_type,pa.salary_head_id
					FROM  `payroll_allowances` pa
					inner join payroll_heads ph on(ph.id=pa.payroll_head_id)
					WHERE  pa.`payroll_head_id` =  '22'
					and pa.`deleted_at` is null
					and ph.`deleted_at` is null
					order by pa.id asc");
				?>
				@foreach($allowance_others as $allowance_other)
				<td rowspan="2">{{ $allowance_other->allowance_name or null}} *{{ $allowance_other->code or null}}</td>
				@endforeach

				<td rowspan="2">বেতন ও ভাতার মোট দাবী (ক) </td> 

				<!-- <td colspan="4" style="text-align:center;">কর্তন ও আদায়</td> -->
				<td style="text-align:center;">কর্তন ও আদায়</td>
				<td rowspan="2">মোট কর্তন ও আদায় (খ) </td>
				<td rowspan="2">নীট দাবী (ক-খ) </td>
				<td rowspan="2">মন্তব্য</td>
				<td rowspan="2" >প্রাপ্তি রশিদ</td>
			</tr>
			<tr>
				<td>জিপিএফ **৬.০৯৩৭-০০০০-৮১০১</td>
			</tr>
			<!-- heading end -->

		<?php $i=0 ?>

		<?php  foreach($employees as $key => $emp): ?>
		<?php $i++ ?>
		<?php
		// if( $i % 1 == 0 ){ echo '<div class="breakNow">Munna</div>'; }
		// if( $i % 1 == 0 ){ echo '<tr class="break"><td>munna</td></tr>'; }


		//if( $i % 1 == 0 ){ echo '<h1 class="break">text of Heading 1 on page 2</h1>'; }
		
		?>

		<!-- <h1 class="break">text of Heading 1 on page 2</h1> -->
		<tr class="page-break"><td>Hello</td></tr>
		<!-- <tr class="page-break"> -->

		<tr>
			<td style="text-align: right;" ><?php echo App\Helpers\CommonHelper::en2bnNumber($key+1); ?></td>
			<td style="text-align: left;white-space: nowrap;" ><?php echo $emp->personal_no, ', '.$emp->rab_id, ', '.$emp->rank_name.', '.$emp->emp_name; ?></td>
			<!-- Basic start -->
			<?php
				$v_basic_amount=DB::SELECT("SELECT sum(pspd.`amount`) as basic_amount
				FROM payroll_salary_process_details pspd
				where pspd.salary_process_id='$emp->id'
				and pspd.process_type='3'
				and pspd.deleted_at is null
				")[0];
			?>
			<td style="text-align: right;"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_basic_amount->basic_amount);?></td>
			<!-- Basic end -->

			<!-- allowance except other start -->
			@foreach($allowance_except_others as $allowance_except_other)
			<?php
				$v_allowance_except_other_amount=DB::SELECT("SELECT sum(pspd.`amount`) as amount
				FROM payroll_allowances pa
				inner join payroll_salary_process_details pspd on(pspd.allowance_id=pa.id)
				WHERE pa.payroll_head_id='$allowance_except_other->id'
				and pspd.salary_process_id='$emp->id'
				and pspd.process_type='1'
				and pa.deleted_at is null
				and pspd.deleted_at is null
				")[0];
			?>
				@if(isset($v_allowance_except_other_amount->amount))
				<td style="text-align: right;"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_allowance_except_other_amount->amount);?></td>
				@else
				<td style="text-align: center;">-</td>
				@endif
			@endforeach
			<!-- allowance except other end -->


			<!-- allowance other start -->
			@foreach($allowance_others as $allowance_other)
			<?php
				$v_allowance_other_amount=DB::SELECT("SELECT sum(pspd.`amount`) as amount
				FROM payroll_salary_process_details pspd 
				WHERE pspd.allowance_id='$allowance_other->id'
				and pspd.salary_process_id='$emp->id'
				and pspd.process_type='1'
				and pspd.deleted_at is null
				")[0];
			?>
				@if(isset($v_allowance_other_amount->amount))
				<td style="text-align: right;"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_allowance_other_amount->amount);?></td>
				@else
				<td style="text-align: center;">-</td>
				@endif
			@endforeach
			<!-- allowance other end -->

			<td style="text-align: right;"><?php echo App\Helpers\CommonHelper::en2bnNumber($emp->salary_amount);?></td>
			<td style="text-align: center;">-</td>
			<td style=" text-align: center;">-</td>
			<td style="text-align: right;"><?php echo App\Helpers\CommonHelper::en2bnNumber($emp->salary_amount);?></td> 
			<td style="text-align: left;"></td>
			<td style="text-align: left;"></td>

		</tr>

		
		

		<?php endforeach; ?>
		</tbody>
	</table>


	<h1 class="break">text of Heading 1 on page 2</h1>
	content on page 2...
	<h1 class="break">text of Heading 1 on page 3</h1>
	content on page 3...
	<p class="break">content on top of page 4</p>


	<p>কথায়ঃ টাকা মাত্র ।</p>
</body>
</html>
