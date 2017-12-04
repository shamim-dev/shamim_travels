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
		<u><?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?> ইং মাসের নিয়মিত বেতন ভাতা বিল </u>
	</p>
	<p>দপ্তরের নামঃ <u>{{ $battalion->battalion_name or null }}</u></p>
	<div style="width: 100%">
		<br>
		<div style="width: 10%; float: left;">
			<span>কোড নং </span>
		</div>
		<div style="padding-left: 20px; width: 5%; float: left;">
			<table style="width:100%" class=""><tr><td>৩</td></tr></table>
		</div>
		<div style="padding-left: 20px; width: 20%; float: left;">
			<table class="">
				<tr>
					<td>২</td>
					<td>২</td>
					<td>১</td>
					<td>১</td>
				</tr>
			</table>
		</div>
		<div style="padding-left: 20px; width: 20%; float: left;">
			<table class="">
				<tr>
					<td>০</td>
					<td>০</td>
					<td>০</td>
					<td>৮</td>
				</tr>
			</table>
		</div>
		<div style="padding-left: 20px; width: 20%; float: left;">
			<table class="">
				<tr>
					<td>৪</td>
					<td>৬</td>
					<td>০</td>
					<td>১</td>
				</tr>
			</table>
		</div>
	</div>
	<div style="width:100%">টোকেন নং ........................  তারিখ  ..................... ভাউচার নং ............... তারিখ ........................ </p>
	<table>
		<tr>
			<td></td>
			<td style="text-align: center;">নির্দেশাবলী</td>
			<td  colspan="3" style="text-align: center;">বিবরণ</td>
			<td style="text-align: center;">টাকা</td>
			<td style="text-align: center;">পঃ</td>
		</tr>
		<?php
		$v_allowance_heads=count($allowance_heads);
		$v_allowances=count($allowances);
		$rowspan_allowance=$v_allowances+$v_allowance_heads+1;
		
		$v_allowance_head_total=0;
		?>

		<tr>
			<td style="width:3%">১.</td>
			<td style="width:25%">অবিলিকৃত/স্থগিত টাকা যথাযথ কলামে লাল কালিতে লিখিত হইবে এবং যোগ দেওয়ার সময় উহা বাদ রাখিতে হইবে</td>
			<td  colspan="3" style="width:40%" >* ৪৬০১ সংস্থাপন কর্মচারীদের বেতন</td>
			<td  align="right"><?php if(isset($basic_salary->basic_salary)){echo App\Helpers\CommonHelper::en2bnNumber($basic_salary->basic_salary);} ?></td>
			<td style="width:10%"></td>
		</tr>


		<tr>
			<td rowspan="{{ $rowspan_allowance }}" >২.</td>
			<td rowspan="{{ $rowspan_allowance }}" >বেতন বৃদ্ধির সার্টিফিকেট বা অনুপস্থিত কর্মচারীগনের তালিকায় স্থান পায় নাই এমন ঘটনাসমূহ যথা- মূত্যু, অবসর গ্রহন, স্থাযী বদলী ও প্রথম নিয়োগ 'মন্তব্য' কলামে লিখতে হইবে।'</td>
			<!-- <td>* ৪৭৫৫ টিফিন ভাতা </td>
			<td></td>
			<td></td> -->
		</tr>

		@foreach($allowance_heads as $allowance_head)
		<tr>
			<td colspan="3">*{{ $allowance_head->code }} {{ $allowance_head->name }}</td>
			<td align="right"><?php if(isset($allowance_head->sum_amount)){echo App\Helpers\CommonHelper::en2bnNumber($allowance_head->sum_amount);} ?></td>
			<td align="right"></td>
		</tr>
		<?php $v_allowance_head_total+=$allowance_head->sum_amount?>
		@endforeach


		@foreach($allowances as $allowance)
		<tr>
			<td>{{ $allowance->allowance_name }}</td>
			<td align="center">-</td>
			<td align="right"><?php if(isset($allowance->sum_amount)){echo App\Helpers\CommonHelper::en2bnNumber($allowance->sum_amount);} ?></td>
			<td align="right"></td>
			<td align="right"></td>
		</tr>
		@endforeach

		<tr>
			<td></td>
			<td></td>
			<td colspan="3">মোট দাবী (ক) </td>
			<td align="right"><?php 
			$v_total_income=$v_allowance_head_total+$basic_salary->basic_salary;
			$v_total_income = number_format($v_total_income, 2);
			echo App\Helpers\CommonHelper::en2bnNumber($v_total_income);?></td>
			<td></td>
		</tr>

		<tr>
			<td rowspan="4">৩.</td>
			<td rowspan="4">কোন দাবিকৃত বেতন বৃদ্ধি সরকারী কর্মচারীর দক্ষতার সীমা অতিক্রম করার আওতায় পড়িলে সংশ্লিষ্ট কর্মচারী উক্ত সীমা অতিক্রম করার উপযুক্ত এই মর্মে কর্তৃপক্ষের ...</td>
			<td colspan="3">কর্তন ও আদায়ঃ </td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">** ৬-০৯৩৭-০০০০-৮১০১ সাধারণ ভবিষৎ তহবিল </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3"></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3"></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td rowspan="2">৪.</td>
			<td rowspan="2">অধঃস্তন সরকারী কর্মচারী এবং এস আর ১৫২-তে উল্লিখিত সরকারী ... </td>
			<td colspan="3">** ৬-০৯৩৭-০০০০-৮১০১ সাধারণ ভবিষৎ তহবিলঃ </td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td rowspan="6">৫.</td>
			<td rowspan="6">সেরেস্তার প্রত্যেক শাখার পর পাতায় আড়াআড়ি লাল রেখা টানিতে হইবে এবং উহার নীচে বেতন ও ভাতার সমষ্টি বেতন ও ভাতার কলামে লাল কালিতে প্রদর্শন করিতে হইবে। </td>
			<td colspan="3">** ৬-০৭৭১-০০০১-৮২৪৭ সরকারী কর্মচারীগণের কল্যাণ তহবিল</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3"></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ৬-০৭৭১-০০০১-৮২৪৭ সরকারী কর্মচারীগণের গোষ্ঠি বীমা</td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ৬-০৭৭১-০০০১-৮২৪৭ সরকারী কর্মচারীগণের বীম কিস্তি </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3"> </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td rowspan="5">৬.</td>
			<td rowspan="5">স্থায়ী পদে নিযুক্ত ব্যক্তিদের নাম স্থায়ী পদের বেতন গ্রহণের মাপ কাঠিতে জ্যেষ্টত্বের ক্রম অনুসারে লিখিতে হইবে এবং খালি পদসমূহ স্থানাপন্ন লোকদিগকে দেখাইতে হইবে </td>
			<td colspan="3">** ১-৩২৩৭-০০০১-২১১১ বাড়ী ভাড়া</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">** ১-৩২৩৭-০০০১-২১১৫ গ্যাস </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-৩২৩৭-০০০১-২১২৩ পানি ও পয়ঃপ্রনালী </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-২২১১-০০০০-২৬৭১ অতিরিক্ত গৃহীত কর্তন </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-৩২৩৭-০০০০-২১২৭ পৌর কর কর্তন </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td rowspan="11">৭.</td>
			<td rowspan="11">স্থায়ী পদে নিযুক্ত ব্যক্তিদের নাম স্থায়ী পদের বেতন গ্রহণের মাপ কাঠিতে জ্যেষ্টত্বের ক্রম অনুসারে লিখিতে হইবে এবং খালি পদসমূহ স্থানাপন্ন লোকদিগকে দেখাইতে হইবে </td>
			<td colspan="3">** ১-০৯৬৫-০০০১-৩৯০১ গৃহ নির্মান অগ্রিমের কিস্তি পরিশোধ </td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"> </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-০৯৬৫-০০০১-৩৯১১ মোটর গাড়ী অগ্রিমের কিস্তি পরিশোধ  </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-০৯৬৫-০০০১-৩৯২১ মোটর সাইকেলের অগ্রিমের কিস্তি পরিশোধ </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-০৯৬৫-০০০১-৩৯৩১ বাই  সাইকেলের অগ্রিমের কিস্তি পরিশোধ </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">** ১-০৯৬৫-০০০১-১৬৩১ কর্মচারীদের প্রদত্ত ঋনের কিস্তি পরিশোধ </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3"></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">মোট কর্তন আদায় (খ)  </td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">নীট দাবী (ক-খ)  </td>
			<td align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_total_income);?></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">প্রদানের জন্য নীট টাকার প্রয়োজন  </td>
			<td align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_total_income);?></td>
			<td></td>
		</tr>

		

	</table>

	<pagebreak>
		<p>
			১. (ক) বিলের টাকা বুঝিয়া পাইলাম।  <br>
				(খ) প্রত্যায়ন করিতেছি যে, নিম্নে বশিদভাবে বর্ণিত টাকা (যাহা এই বিল হইতে কর্তন করাযা দেওয়া হইয়াছে ) ব্যতীত এই তারিখের ১* মাস/২ মাস/৩ মাস পূর্বে উত্তোলিত বিলের অন্তর্ভুত্ত টাকা প্রযোজ্য ক্ষেত্রে টিক চিহ্ন () দিন।
				(গ)  প্রত্যায়ন করেতেছি যে, এই কার্যালয়ের সকল নিয়োগ, স্থাযী ও অস্থায়ী পদোন্নতি সংক্রান্ত তথ্যাদি সংশ্লিষ্ট কর্মচারীগনের নিজ নিজ চাকুরী বহিতে আমার সত্যাযনে লিপিবদ্ধ হইয়াছে।
		 </p>
		<p>২.বিলের সাথে একটি অনুপস্থিতির তালিকা প্রদান করা হইল।</p>
		<p>৩. প্রত্যায়ন করা যাইতেছে যে, এই কার্যালয়ের সক্ল নিয়োগ, স্থায়ী ও অস্থায়ী পদোন্নতি সংক্রান্ত তথ্যাদি সংশ্লিষ্ট কর্মচারীগনের নিজ নিজ চাকুরী বহিতে আমার সত্যায়নে লিপিবদ্ধ হয়যাছে</p>
		<p>৪. প্রত্যায়ন করা যাইতেছে যে, চাকুরী বহিতে রক্ষিত ছুটির হিসাব এবং প্রযোজ্য ছুটির বিধি অনুযায়ী প্রাপ্য ছুটি ছাড়া কাহাকেও কোন ছুটি মঞ্জুর করা হয় নাকি। আমি নিশ্চিত যে তাহাদের ছুটি পাওনা ছিল এবং সকল ছুটির মঞ্জুর ও ছুটিতে বা ছুটি
		 হইতে ফিরিয়া আসা, সাময়িক কর্মচ্যুতি ও অন্য কাজে পাওয়া ও</p>
		<p>৫. প্রত্যায়ন করা যাইতেছে যে, যে সকল সরকারী কর্মচারীর নাম উল্লেখ করা হয় নাই, কিন্তু এই বিলে বেওতন দাবী করা হইয়াছে চলতি মাসে তাহারা যথার্থই সরকারী চাকুরীতে নিয়োজিত ছিলেন</p>
		<p>৬. প্রত্যায়ন করা যাইতেছে যে, যে সকল সরকারী কর্মচারীর বাড়ী ভারা ভাতা এই বিলে দাবী করা হইয়াছে, তাহারা সরকারী কোন বাসস্থানে বসবাস করেন নাই।</p>
		<p>৭. প্রত্যায়ন করা যাইতেছে যে, যে ক্ষেত্রে ছুটির/অস্থাযী বদলী কালীন সময়ের জন্য ক্ষতিপূরণ ভাতা দাবী করা হইয়াছে, সেই ক্ষেত্রে কর্মচারীর একই বা স্বপদে ফিরিয়েয়া আসার সম্ভাব্যচা ছুটি/অস্থায়ী বদলীর মুল।। </p>
		<p>৮. প্রত্যায়ন করা যাইতেছে যে, কর্মচারীদের ছুটি কালীন বেওতন, ছুটিতে যাওয়ার সময় যে হারে বেতন গ্রহণ করিতেছিলেন, সেই হারে দাবী করা হইয়াছে। </p>
		<p>৯. প্রত্যায়ন করা যাইতেছে যে, অবসর গ্রহণ করিয়াছেন এমন কোন কর্মচারীর নাম এই বিলে অন্তর্ভুক্ত করা "সনদ প্রদান করা যাচ্ছে যে, এই বিলে অতিরিক্ত কোন দাবী করা হয়নি। অতিরিক্ত দাবী করা হলে সরকারী দাবী করা হলে সরকারী কোষাগারে  জমা করা হবে।" </p>
		<p style="text-align:center; font-size:18px;">অনুপস্থিত ব্যক্তিদের ফেরত দেওয়া বেতনের বিবরণ</p>
		<table>
			<tr>
				<td rowspan="2" style="width:15%">সেকসন</td>
				<td rowspan="2" style="width:40%" colspan="3">নাম</td>
				<td rowspan="2" style="width:20%">সময়</td>
				<td colspan="2" style="width:25%">টাকার অংক</td>
			</tr>
			<tr>
				<td>টা.</td>
				<td>প.</td>
			</tr>
			<?php 
			$rowspan_count_designation=count($designations);
			$rowspan_count_designation+=1;
			$v_sum_designation=0;
			?>
			@foreach($designations as $key=>$designation)
			<tr>
				@if($key==0)
				<td rowspan="{{ $rowspan_count_designation }}"></td>
				@endif
				<td>{{ $designation->designation_name or null }}</td>
				<td>=</td>
				<td><?php echo App\Helpers\CommonHelper::en2bnNumber($designation->sum_designation).' জন';
				$v_sum_designation+=$designation->sum_designation;
				?></td>
				@if($key==0)
				<td rowspan="{{ $rowspan_count_designation }}">{{ $salary_date }} ইং মাসের নিয়মিত বেতন ও ভাতা বিল </td>
				<td style="text-align:center;"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_total_income);?></td>
				<td rowspan="{{ $rowspan_count_designation }}"></td>
				@endif

			</tr>
			@endforeach

			<tr>
				<td>সর্বমোট</td>
				<td>=</td>
				<td><?php echo App\Helpers\CommonHelper::en2bnNumber($v_sum_designation);?> জন</td>
				<td style="text-align:center;"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_total_income);?></td>
			</tr>

		</table>
		<div class="row">
				<div style="width:60%; float:left;">
						<p>তারিখ .......................................</p>
				</div>

				<div style="width:40%; float:right;">
						<p>আয়ন কর্মকর্তার স্বাক্ষর <br> নাম <br> পদবী <br> সীল </p>
				</div>
		</div>
		<hr>
		<p style="text-align:center; font-size:18px;">হিসাব রক্ষণ অফিসের ব্যবহারের জন্য।</p>
		<p>টাকা  ................................................................................................... (কথায়) ................................................................................................. প্রদানের জন্য।  </p>
		<br>
		<br>
		<div class="row">
				<div style="width:35%; float:left;">
						<p>অডিটর <br> নাম ..........................................</p>
				</div>

				<div style="width:35%; float:right;">
						<p>সুপার <br> নাম  </p>
				</div>

				<div style="width:30%; float:right;">
						<p>হিসাব রক্ষণ অফিসার <br> নাম </p>
				</div>
		</div>
		<p>বাঃসঃমুঃ- ২০০৬/০৭-১০০৩৬এফ-১০,০০,০০০ কপি, (মুদ্রণাদেশ-৭০) ২০০৭।  </p>
	</pagebreak>
</body>
</html>
