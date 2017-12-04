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
	<!-- 1st Page -->
	<p style="text-align: center">
		<u>র‍্যাব ফোর্সের সদর দপ্তর। <br>
		এডমিন উইং <br>
		ফেব্রুয়ারী মাস, ২০১৭ বৎসর</u>
	</p>
	<p style="text-align: left">বাংলাদেশ ফরম সংখ্যা- ২৬০৪</p>
	<p style="text-align: left">
		............... জেলার ............ষ্টেশনের ............... মাস ,
	</p>
	<p style="text-align: center;">
		(পি,আর,বি,ফরম নং ১৫৮-১২৪৫ নিয়ম দ্রষ্টব্য)
	</p>
	<p style="text-align: justify;">
		দ্রষ্টব্য-১,২,৩ নং কলাম স্থানীয় অফিসার পূরণ করিয়া প্রত্যেক মাসের শেষের দিকে সত্বের পুলিশ সুপারের অফিসে পাঠাইবেন। ৪ হইতে ৯ পর্যন্ত পুলিশ সুপার অফিসে পূরণ করা হইবে। টাকা প্রাপ্তির পর প্রত্যক কর্মচারী কলামে স্বাক্ষর করিতে হইবে এবং তৎপর এই পরিশোধপত্রে লিপিবদ্ধকরণের জন্য পুলিষ সুপারের অফিসে প্রেরণ করিতে হইবে। যদি কোন টাকা অপরিশোধকৃত থাকে, তবে তাহার কারণ ১১ নং কলামে দর্শাইতে হইবে ।
	</p>
	<table>
		<tr>
			<td style="text-align: center; width:5%; " rowspan="2">জিলার নং</td>
			<td style="text-align: center; width:20%; " rowspan="2">নাম</td>
			<td style="text-align: center; width:10%; " rowspan="2">পদ এবং পর্য্যায়</td>
			<td style="text-align: center; width:10%; " rowspan="2">বেতন</td>
			<td style="text-align: center; width:40%; " colspan="4">কর্তন</td>
			<td style="text-align: center; width:8%; " rowspan="2">অবশিষ্ট দেয় টাকার পরিমাণ</td>
			<td style="text-align: center; width:12%;" rowspan="2">প্রাপকের স্বাক্ষর</td>
		</tr>
		<tr>
			<td>সাধারণ ভবিষ্য তহবিল **৬-০৯৩৭-০০০০-</td>
			<td>বাড়ীভাড়া **১-৩২৩৭-০০০১-২১১১ </td>
			<td>গ্যাস **১৩২৩৭-০০০১-২১২১ </td>
			<td>পানি ও পয়প্রণালী **১-৩২৩৭-০০০১-২১২৩</td>
		</tr>

		<tr>
			<td>১</td>
			<td>২</td>
			<td>৩</td>
			<td>৪</td>
			<td>৫</td>
			<td>৬</td>
			<td>৭</td>
			<td>৮</td>
			<td>৯</td>
			<td>১০</td>
		</tr>

		<?php  foreach($empoloyee as $key => $emp): ?>
			<tr>
				<td><?php echo App\Helpers\CommonHelper::en2bnNumber($key+1);	?></td>
				<td><?php echo $emp->rab_id, ', '.$emp->rank_name.', '.$emp->emp_name; ?></td>
				<td></td>
				<td rowspan="13" style="text-align: right;">৩৮,০৩৩.০০</td>
				<td rowspan="13" style="text-align: right;">-</td>
				<td rowspan="13" style="text-align: right;">-</td>
				<td rowspan="13" style="text-align: right;">-</td>
				<td rowspan="13" style="text-align: right;">-</td>
				<td rowspan="13" style="text-align: right;">৩৮,০৩৩.০০</td>
				<td rowspan="13" style="text-align: right;"></td>
			</tr>
			<tr>
				<td></td>
				<td>মূল বেতন</td>
				<td style="text-align: right;">১৩,০২০.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>মহার্ঘ ভাতা</td>
				<td style="text-align: right;">২,৬০৪.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>বাড়ীভাড়া ভাতা</td>
				<td style="text-align: right;">৭,১৬১.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>মেডিকেল ভাতা</td>
				<td style="text-align: right;">৭০০.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>যাতায়াত ভাতা</td>
				<td style="text-align: right;">১৫০.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>বিশেস ভাতা (র‍্যাব) </td>
				<td style="text-align: right;">৯,১১৮.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>ব্যাটম্যান ভাতা</td>
				<td style="text-align: right;">১,২৯৭</td>
			</tr>

			<tr>
				<td></td>
				<td>প্রতিরক্ষা ভাতা</td>
				<td style="text-align: right;">২,৮৫১.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>ক্ষেঈর ও ধৌত ভাতা </td>
				<td style="text-align: right;">৪৯০.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>দক্ষতা ভাতা</td>
				<td style="text-align: right;">২৮০.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>সু-আচারন বেতন</td>
				<td style="text-align: right;">৬৬.০০</td>
			</tr>

			<tr>
				<td></td>
				<td>শিক্ষা ভাতা</td>
				<td style="text-align: right;">৩০০.০০</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
