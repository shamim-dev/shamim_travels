<html>
<head>
	<title>@hasSection('htmlheader_title')@yield('htmlheader_title') - @endif{{ LAConfigs::getByKey('sitename') }}</title>
</head>
@page { sheet-size: L; }
<style type="text/css">
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
  		text-align: center;
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
</style>
	<body>
		<p style="text-align: center">
    	<u>
				ভবিষ্যত তহবিল কর্তনের তালিকা - জানুয়ারি ২০১৭ ইং <br>
				র‍্যাব ফোর্সেস সদর দপ্তর <br>
				পুলিশ
			</u>
    </p>
		<div style="width:100%">
			<table>
				<tr>
					<td rowspan="2" style="width: 10%">ক্র/নং</td>
					<td rowspan="2" style="width: 10%">হিসাব নং</td>
					<td rowspan="2" style="width: 25%">পদবী ও নাম</td>
					<td rowspan="2" style="width: 15%">আদায়কৃত টাকা</td>
					<td colspan="3" style="width: 40%">অগ্রিম গৃহীত সুদ কর্তনের টাকার পরিমান</td>
				</tr>
				<tr>
					<td>১ম লোন</td>
					<td>২য় লোন</td>
					<td>৩য় লোন</td>
				</tr>
				<?php  foreach($empoloyee as $key => $emp): ?>
				<tr>
					<td><?php echo App\Helpers\CommonHelper::en2bnNumber($key+1);	?></td>
					<td>৬৫০৩৫</td>
					<td style="text-align:left;"><?php echo $emp->rab_id, ', '.$emp->rank_name.', '.$emp->emp_name; ?></td>
					<td>৩০০০০</td>
					<td>৩০০০</td>
					<td>১০০০</td>
					<td>৫০০</td>
				</tr>
			<?php endforeach; ?>
				<tr>
					<td colspan="3">১ নং পাতার মোট টাকার পরিমান</td>
					<td>১১৮৩৫০</td>
					<td>১১১১২৫৪</td>
					<td>৩৬৫২১৪</td>
					<td>-</td>
				</tr>
			</table>
			<p style="text-align:center">কথায়ঃ তের লক্ষ তিন হাজার একশ সত্তর টাকা মাত্র।</p>
		</div>

		<br>
		<div style="width:100%">
			<p style="text-align:center"><u>সামারী</u></p>
			<table>
				<tr>
					<td style="width: 40%">১ নং পাতার মোট টাকার পরিমান</td>
					<td style="width: 30%"></td>
					<td style="width: 15%">২০৪,৮০৮.০০ </td>
					<td style="width: 15%"></td>
				</tr>

				<tr>
					<td>২ নং পাতার মোট টাকার পরিমান</td>
					<td></td>
					<td>২০৪,৮০৮.০০ </td>
					<td></td>
				</tr>

				<tr>
					<td>৩ নং পাতার মোট টাকার পরিমান</td>
					<td></td>
					<td>২০৪,৮০৮.০০ </td>
					<td></td>
				</tr>

				<tr>
					<td>৪ নং পাতার মোট টাকার পরিমান</td>
					<td></td>
					<td>২০৪,৮০৮.০০ </td>
					<td></td>
				</tr>

				<tr>
					<td>৫ নং পাতার মোট টাকার পরিমান</td>
					<td></td>
					<td>২০৪,৮০৮.০০ </td>
					<td></td>
				</tr>

				<tr>
					<td>৬ নং পাতার মোট টাকার পরিমান</td>
					<td></td>
					<td>২০৪,৮০৮.০০ </td>
					<td></td>
				</tr>

				<tr>
					<td>সর্বমোট টাকা = </td>
					<td></td>
					<td>৩,০৩,১৭০.০০ </td>
					<td></td>
				</tr>

			</table>
			<p style="text-align:center">কথায়ঃ তিন লক্ষ তিন হাজার একশ সত্তর টাকা মাত্র।</p>
		</div>
	</body>
</html>
