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
</style>
<body>

	<!-- 2nd Page -->
	<p style="text-align: left">টি। আর ফরম নং ১৫/এ <br> [এস আর ১৫০ (১) দ্রষ্টব্য] এর পরিবর্তে</p>
	<p style="text-align: center">
		<u>সংস্থাপন কর্মকর্তা/কর্মচারীদের বেতন বিল<br>
		অফিসের নামঃ র‍্যাব ফোর্সেস সদর দপ্তর <br>
		ঠিকানাঃ কুর্মিটোলা, ঢাকা । <br>
		নিয়মিত বেতন ও ভাতা বিল- ডিসেম্বর ২০১৬ বৎসর</u>
	</p>
	<table>
		<tr>
			<td rowspan="2">পদের ক্রমিক নং</td>
			<td rowspan="2" style="text-align: center;">সেরেস্তার শাখা ও পদস্থ <br> কর্মকর্তা/কর্মচারীদের নাম</td>
			<td rowspan="2">মুল বেতন *৪৬০১</td>
			<td rowspan="2">বাড়ীভাড়া ভাতা *৪৭০৫ </td>
			<td rowspan="2">চিকিৎসা ভাতা *৪৭১৭ </td>
			<td rowspan="2">টিফিন ভাতা *৪৭৫৫</td>
			<td rowspan="2">যাতায়াত ভাতা *৪৭৬৫ </td>
			<td rowspan="2">শিক্ষা ভাতা *৪৭৭৩ </td>
			<td rowspan="2">বিশেষ ভাতা (র‍্যাব) *৪৭৯৫</td>
			<td rowspan="2">ব্যাটম্যান ভাতা *৪৭৯৫</td>
			<td rowspan="2">ক্ষৌর ও ধৌত ভাতা *৪৭৯৫</td>
			<td rowspan="2">মেট্টো ভাতা *৪৭৯৫</td>
			<td rowspan="2">অস্ত্র ভাতা *৪৭৯৫</td>
			<td rowspan="2">রেশমা ভাতা *৪৭৯৫</td>
			<td rowspan="2">অন্যান্য ভাতা *৪৭৯৫ </td>
			<td rowspan="2">বেতন ও ভাতার মোট দাবী (ক) </td>
			<td colspan="4" style="text-align:center;">কর্তন ও আদায়</td>
			<td rowspan="2">মোট কর্তন ও আদায় (খ) </td>
			<td rowspan="2">নীট দাবী (ক-খ) </td>
			<td rowspan="2">মন্তব্য</td>
			<td rowspan="2" >প্রাপ্তি রশিদ</td>
		</tr>
		<tr>
			<td>জিপিএফ **৬.০৯৩৭-০০০০-৮১০১</td>
			<td>গৃহনিমার্ন অগ্রিমের কিস্তি পরিশোধ</td>
			<td>গ্যাস **১-৩২৩৭-০০০১-১২৫১</td>
			<td>পানি **১-৩২৩৭-০০০১</td>
		</tr>
		<?php  foreach($empoloyee as $key => $emp): ?>
		<tr>
			<td style="width:3%; text-align: right;" ><?php echo App\Helpers\CommonHelper::en2bnNumber($key+1); ?></td>
			<td style="width:10%; text-align: left;" ><?php echo 'নং পাতার  টাকার জের = '; ?></td>
			<td style="width:5%; text-align: right;">২৪,৫২০.০০</td>
			<td style="width:5%; text-align: right;">১৬,৪৮৬.০০</td>
			<td style="width:5%; text-align: right;">১,৫০০.০০</td>
			<td style="width:4%; text-align: right;">-</td>
			<td style="width:4%; text-align: right;">-</td>
			<td style="width:5%; text-align: right;">১,০০০.০০</td>
			<td style="width:5%; text-align: right;">১১,৮১১.০০</td>
			<td style="width:5%; text-align: right;">১,৬৮৫.০০</td>
			<td style="width:4%; text-align: right;">৬৪৯.০০</td>
			<td style="width:4%; text-align: right;">৯০.০০</td>
			<td style="width:4%; text-align: right;">৪৯০.০০</td>
			<td style="width:5%; text-align: right;">-</td>
			<td style="width:5%; text-align: right;">-</td>
			<td style="width:5%; text-align: right;">৫৪,৮৩১.০০</td>
			<td style="width:5%; text-align: right;">-</td>
			<td style="width:5%; text-align: right;">-</td>
			<td style="width:5%; text-align: right;">৫৪,৮৩১.০০</td>
			<td style="width:3%; text-align: right;"></td>
			<td style="width:3%; text-align: right;"></td>
			<td style="width:3%; text-align: right;"></td>
			<td style="width:3%; text-align: right;"></td>
			<td style="width:3%; text-align: right;"></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<p>কথায়ঃ টাকা মাত্র ।</p>
</body>
</html>
