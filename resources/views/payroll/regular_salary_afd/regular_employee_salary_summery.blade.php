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
			<td>পদের ক্রমিক নং </td>
			<td style="width:15%; text-align: center;">সেরেস্তার শাখা ও পদস্থ <br> কর্মকর্তা/কর্মচারীদের নাম</td>
			<td>মুল বেতন *৪৬০১</td>
			<td>বাড়ীভাড়া ভাতা *৪৭০৫ </td>
			<td>মেডিক্যাল ভাতা *৪৭১৭ </td>
			<td>টিফিন ভাতা *৪৭৫৫</td>
			<td>যাতায়াত ভাতা *৪৭৬৫ </td>
			<td>শিক্ষা ভাতা *৪৭৭৩ </td>
			<td>বিশেষ ভাতা (র‍্যাব) *৪৭৯৫</td>
			<td>ব্যাটম্যান ভাতা *৪৭৯৫</td>
			<td>দক্ষতা ভাতা *৪৭৯৫</td>
			<td>সূ-আচরন বেতন *৪৭৯৫</td>
			<td>ক্ষৌর ও ধৌত ভাতা *৪৭৯৫</td>
			<td>যোগ্যতা ভাতা *৪৭৯৫</td>
			<td>অন্যান্য ভাতা *৪৭৯৫ </td>
			<td>বেতন ও ভাতার মোট দাবী (ক) </td>
			<td>কর্তন সাধারণ ভবিষ্য তহবিল </td>
			<td>মোট কর্তন ও আদায় (খ) </td>
			<td>নীট দাবী (ক-খ) </td>
			<td>মন্তব্য</td>
			<td>প্রাপ্তি রশিদ</td>
		</tr>
		<?php  foreach($empoloyee as $key => $emp): ?>
		<tr>
			<td style="width:3%; text-align: right;" ><?php echo App\Helpers\CommonHelper::en2bnNumber($key+1); ?></td>
			<td  style="width:15%; text-align: left;" ><?php echo 'নং পাতার  টাকার জের = '; ?></td>
			<td style="width:5.5%; text-align: right;">২৪,৫২০.০০</td>
			<td style="width:5.5%; text-align: right;">১৬,৪৮৬.০০</td>
			<td style="width:5.5%; text-align: right;">১,৫০০.০০</td>
			<td style="width:4%; text-align: right;">-</td>
			<td style="width:4%; text-align: right;">-</td>
			<td style="width:5.5%; text-align: right;">১,০০০.০০</td>
			<td style="width:5.5%; text-align: right;">১১,৮১১.০০</td>
			<td style="width:5.5%; text-align: right;">১,৬৮৫.০০</td>
			<td style="width:4%; text-align: right;">৬৪৯.০০</td>
			<td style="width:4%; text-align: right;">৯০.০০</td>
			<td style="width:4%; text-align: right;">৪৯০.০০</td>
			<td style="width:3%; text-align: right;">-</td>
			<td style="width:3%; text-align: right;">-</td>
			<td style="width:5.5%; text-align: right;">৫৪,৮৩১.০০</td>
			<td style="width:3%; text-align: right;">-</td>
			<td style="width:3%; text-align: right;">-</td>
			<td style="width:5.5%; text-align: right;">৫৪,৮৩১.০০</td>
			<td style="width:3%; text-align: right;"></td>
			<td style="width:3%; text-align: right;"></td>
		</tr>
	<?php endforeach; ?>
	</table>
</body>
</html>
