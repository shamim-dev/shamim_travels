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
  		/*margin: 0;*/
	}
	table, td, td {
	    border: 1px solid black;
	    padding: 3px;
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
	.blank tr td.bottom-border {
		/*border-left: 1px solid black;*/
		border-bottom: 1px solid black;
	}
</style>
<body>
<?php  foreach($employees as $emp): ?>
<!-- 1st Page -->
<p style="text-align: left">বাংলাদেশ ফরম সংখ্যা- ২৬০৪</p>
<p style="text-align: center">
	"আদায়কের বিলের উদ্ধৃতি-ক" <br>
	(টাকা প্রদানকারী কর্মকর্তার আদায়ক/বিল এবং হিসাবে সাথে সংযুক্ত করিতে হইবে)
</p>
<div style="width: 40%;float: left; text-align: right;">
	হিসাবের খাত_মূখ্য খাত<br>
	গৌণ খাত <br>
	উপ খাত <br>
	নিয়ন্ত্রক কর্মকর্তা 
</div>
<div style="width: 60%;float: left;">
	............................................................... <br>
	............................................................... <br>
	............................................................... <br>
	................................................................................
</div>
<?php 
	$allowance_head_amount=0;
	$allowance_amount=0;
	$deduction_amount=0;
?>

<table>
	<tr>
		<td style="text-align: center;">প্রমাণক সংখ্যা</td>
		<td style="text-align: center;" colspan="2">জ্ঞাতব্য বিবরণ <br> উপযোজনের বিশদ বিবরণ যথাসম্ভব লিপিবদ্ধ করিতে হইতে</td>
		<td style="text-align: center;">টাকার পরিমান</td>
	</tr>
	<tr>
		<td>
			<table class="blank">
				<tr><td>কর্তন সমূহঃ</td></tr>
				@foreach($deduction_heads as $deduction_head)
				<tr><td>{{$deduction_head->name or null}} - <?php echo App\Helpers\CommonHelper::en2bnNumber($deduction_head->sum_amount);
				$deduction_amount+=$deduction_head->sum_amount;
				?></td>
				</tr>
				@endforeach
				<!-- <tr><td>সঃগাঃ ব্যঃ - <hr style="padding-bottom: 0px;"></td></tr> -->
				<tr style="padding-bottom: 0px;"><td>মোট টাকা = <?php echo App\Helpers\CommonHelper::en2bnNumber($deduction_amount);?></td></tr>
			</table>			
		</td>
		<td colspan="2">
			<table class="blank main">
				<tr>
					<td colspan="2">
						<p><?php echo $emp->emp_name.', '. $emp->rank_name; ?>  <br>
							<?php echo $emp->designation_name; ?>  <br>
							<?php echo $emp->battalion_name.', '.$emp->battalion_address; ?> 
						</p> <br>
						<p><?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?> মাসের নিয়মিত বেতন বিল। </p>

					</td>
					<td>
						<table class="blank">
							<tr>
								<td class="column">মূল বেতন</td> 
							</tr>
							@foreach($allowance_heads as $allowance_head)
								@if($allowance_head->id!='22')
								<tr>
									<td class="column">{{ $allowance_head->name or null}}</td> 
								</tr>
								@endif 
							@endforeach

							@foreach($allowances as $allowance)
							<tr>
							<td class="column">{{ $allowance->allowance_name or null}}</td>
							</tr>
							@endforeach
							<tr>
								<td class="column">সর্বমোট বেতন ও ভাতা</td>
							</tr>
							<tr>
								<td style="border-left: 1px solid black;">মোট কর্তন (-)</td>
							</tr>
						</table>
					</td>
				</tr>

			</table>
			
		</td>
		<td style="width: 15%">
			<table class="blank">
				<tr>
					<!-- Basic start -->
					<?php
						//echo $emp->id;die();
						$v_basic_amount=DB::SELECT("SELECT sum(pspd.`amount`) as basic_amount
						FROM payroll_salary_process_details pspd
						where pspd.salary_process_id='$emp->id'
						and pspd.process_type='3'
						and pspd.deleted_at is null
						")[0];
					?>
					<td class="bottom-border" align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($v_basic_amount->basic_amount);?></td>
					<!-- Basic end -->
				</tr>
				
				@foreach($allowance_heads as $allowance_head)
					@if($allowance_head->id!='22')
					<tr>
						
						<td class="bottom-border" align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($allowance_head->sum_amount);
							$allowance_head_amount+=$allowance_head->sum_amount;
						?></td>
						
					</tr>
					@endif 
				@endforeach

				@foreach($allowances as $allowance)
				<tr>
					<td class="bottom-border" align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($allowance->sum_amount);
						$allowance_amount+=$allowance->sum_amount;
					?></td> 
				</tr>
				@endforeach

				<tr>
					<td class="bottom-border" align="right"><?php 
					$v_total_salary=$v_basic_amount->basic_amount+$allowance_head_amount+$allowance_amount;
					$v_total_salary = number_format($v_total_salary, 2);
					echo App\Helpers\CommonHelper::en2bnNumber($v_total_salary);
					?></td>
				</tr>

				<tr>
					<td  class="bottom-border" align="right"><?php 
					echo App\Helpers\CommonHelper::en2bnNumber($deduction_amount);
					?></td>
				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">কথায়- {{ (new \App\Helpers\BanglaNumber)->numToWord($emp->salary_amount) }} (মাত্র)</td>
		<td style="width: 18%"> নীট টাকা</td>
		<td style="width: 15%" align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($emp->salary_amount);?></td>
	</tr>
</table>
<br>
<div style="width: 50%;float: left; text-align: left;">
	তারিখঃ ........................ <br>
	পরিশোধকৃত  .................. কোষাগার <br>
	তারিখঃ .........................<br>
	<span>সওব বি/ফ-১৩২/৭৬-২৪১২ তারিখ ২০-১২-৭৬ </span>
</div>
<div style="width: 40%;float: left; text-align: left;">
	স্বাক্ষরঃ ..................... <br>
	পদবীঃ  ......................</br>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- 2nd Page -->
<p style="text-align: left">টি আর ফরম নং-১৩ <br> [এস আর-১৩৯ (১) দ্রষ্টব্য] </p>

<div style="width: 70%;float: left; text-align: center;">
	<br>
	গেজেটেড সরকারী কর্মকর্তার বেতন বিল <br>
	<!-- <div style="text-align: center;">
		
	</div> -->
	<?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?>
	
	
</div>

<div style="width: 20%;float: right;">
	আইডিঃ <br>
	ভলিয়মঃ <br>
	পৃষ্ঠাঃ 
</div>

<div style="width: 20%"> </div>
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
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
		</table>
	</div>
</div>
<div style="width: 100%">
	<p>
		নামঃ <u><?php echo $emp->emp_name.', '. $emp->rank_name; ?> </u> পদবীঃ <u><?php echo $emp->designation_name; ?></u> দপ্তরঃ <u> <?php echo $emp->battalion_name.', '.$emp->battalion_address; ?> ।</u> ভবিষ্য তহবিল নং <u> পুঃ-৩৯৩৯৯ </u> ডাক জীবন বীমা নং ......... করদাতা সনাক্ত করণ নম্বর (টি আই এন) ১৬০-১০২--২৯৩৯ টোকেন নং ............ তারিখ ......... ভাউচার নং ......... তারিখ ............
	</p>
</div>
<div style="width: 100%">
	<table>
		<tr>
			<td style="text-align: center;" rowspan="2">কোড নং</td>
			<td style="text-align: center;" rowspan="2">বিবরণ </td>
			<td style="text-align: center;" colspan="2">রেট</td>
			<td style="text-align: center;" colspan="2">টাকার অংক</td>
		</tr>
		<tr>
			<td style="text-align: center;">টাকা</td>
			<td style="text-align: center;">পয়সা</td>
			<td style="text-align: center;">টাকা</td>
			<td style="text-align: center;">পয়সা</td>			
		</tr>
		
		<tr>
			<td style="text-align: center;"></td>
			<td style="text-align: center;" colspan="5">টাকা (কথায় লিখিতে হইতে ) - (...........................)  মাত্র</td>		
		</tr>
	</table>
	<br>
	<p>যাহাকে টাকা বা চেক প্রদান করিতে হইবে, সেই বাহক/ব্যাংক/এজেন্টের নাম ...........................</p>
</div>
<div style="width: 40%;float: left; text-align: left;">
	<br>
	<br>
	তারিখঃ.................
</div>
<div style="width: 40%;float: left; text-align: left;">
	<br>
	কর্মকর্তার <br> স্বাক্ষর ও সীল 
</div>
<div style="width: 20%;float: left;">
	<div class="box-stamp">
		<p>রাজস্ব <br>ষ্ট্যাম্প </p>
	</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- 3rd Page -->
<p style="text-align: center">
	হিসাব রক্ষণ অফিসে ব্যবহারের জন্য
</p>
<p>টাকা ........................  কথায় ............................................................................................................................. ............................. প্রদানের জন্য পাস করা হইল।</p>
<br>
<div style="width: 33.3%;float: left; text-align: left;">
	অডিটর (স্বাক্ষর)<br>
	নাম ......................<br>
	তারিখ ................... <br><br>
	চেক নং ...........................	
</div>
<div style="width: 33.3%;float: left; text-align: left;">
	সুপার (স্বাক্ষর)<br>
	নাম ......................<br>
	তারিখ ................... <br>
	<br>
	তারিখ .............................. 	
</div>
<div style="width: 33.3%;float: left; text-align: left;">
	হিসাব রক্ষক অফিসার (স্বাক্ষর) <br>
	নাম ......................<br>
	তারিখ ................... <br>	
</div>

<div style="float: right; width: 33.3%">
	<p>চেক প্রদানকারীর স্বাক্ষর <br> তারিখ...................... </p>
</div>
<br>
<div style="width: 100%">
	<p style="text-align: center;">নির্দেশাবলী</p>
	<div style="width: 10%; float: left;">
		<p>১.</p><p></p>
		<p>২.</p><p></p>
		<p>৩.</p> <p></p><p></p><p></p>
		<p>৪.</p>
	</div>
	<div style="width: 90%;float: left;">
		<p>যে মাসের কাজের বিনিমনে বেতন অর্জন করা হইয়াছে সেই মাসের শেষ কার্যদিবসের ৫ দিন পূর্বে হিসাব রক্ষণ অফিসে বিল পেশ করিতে হইবে ।</p>
		<p>পেশকৃত প্রতিটি বিলের জন্য একটি করিয়া টোকেন দেওয়া হইবে। চেক/ক্যাশ অথবা আপত্তিসহ ফেরত বিল গ্রহনের প্রাক্কালে উক্ত টোকেন ফেরত দিতে হইবে। ইতদ্ব্যতীত চেক/ক্যাশ গ্রহনকালে একখানা লিখিত রসিদ স্ট্যাম্প (প্রযোজ্য ক্ষেত্রে)  প্রদান করিতে হইবে। </p>
		<p>ব্যাংকার বা এজেন্টকে টাকা প্রদানের জন্য ইচ্ছানুসারে বেতন বিলে নির্দেশ করা যাইবে এবং এইরূপ ক্ষেত্রে ব্যাংক বা এজেন্টের মাধ্যমে টাকা সংগ্রহের জন্য পেশ করা যাইবে । এই জন্য সরকারী কর্মচারীর বা বাহকের ব্যক্তিগত উপস্থিতির প্রয়োজন হইবে না। ব্যাংক বা এজেন্টকে সরাসরি টাকা প্রদান করা হইবে।</p>
		<p>প্রযোজ্য ক্ষেত্রে বিলের সঙ্গে অবশ্যই  কর্তন ও আদায়ের সিডিউল প্রদান করিতে হইবে।</p>
	</div>
	<p>নোট-১: হিসাব রক্ষণ কর্মকর্তাগনকে নিশ্চিত হইতে হইবে যে, সকল বাধ্যতামূলক কর্তন ও আদায়ের সিডিউল যেন বিলের সঙ্গে সংযুক্ত থাকে। </p> <br>
	<p>নোট-২: বাহকের নিকট প্রদত্ত টাকা, চেক অথবা বিলের জালিয়াতি বা আত্নসাৎ সংক্রান্ত কোনরূপ দায়-দায়িত্ব সরকার গ্রাহ্য করিবে না।  </p>
	
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- 4th Page -->
<p style="text-align: left">টি আর-৫৬ (বড়) <br>কোষাগার বিধি ৬০৪</p>
<p style="text-align: center; font-size: 18px;">
	সাধারণ ভবিষ্য তহবিল কর্তনের তফসিল
</p>
<p>এই ফরম ৬০৩ বিধির অর্ন্তগত (যাহার শিরোনাম সুস্পষ্টভাবে বর্ণিত) বিভিন্ন প্রকারের তহবিলের আদান প্রদানের ক্ষেত্রে ব্যবহার করা যাইতে পারে। </p>
<p>কর্মকর্তার নামঃ <?php echo $emp->emp_name.', '. $emp->rank_name; ?><br>
তালিকার নামঃ জি, পি, এম-<?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?> ভবিষ্য তহবিল কর্তন</p>
<div style="width: 100%">
	<table>
		<tr>
			<td style="text-align: center; float: top; width: 8%;">হিসাব সংখ্যা</td>
			<td style="text-align: center;  width: 8%;">খতিয়ান এবং পৃষ্টা</td>
			<td style="text-align: center;  width: 25%;">নাম</td>
			<td style="text-align: center;  width: 10%;">বেতন মূল বেতন </td>
			<td style="text-align: center;  width: 10%;">চাঁদার হার</td>
			<td style="text-align: center;  width: 15%;">আদায়কৃত টাকার পরিমান</td>
			<td style="text-align: center;  width: 8%;">অগ্রীম গৃহীত টাকা প্রদান</td>	
			<td style="text-align: center;  width: 8%;">অগ্রীম গৃহীত টাকার পরিমান </td>	
			<td style="text-align: center;  width: 8%;">মন্তব্য</td>	

		</tr>
		<tr>
			<td><u>পুলিশ</u> ৩৯৩৯৯</td>
			<td></td>
			<td>
				<?php echo $emp->emp_name.', '. $emp->rank_name; ?>  <br>
				<?php echo $emp->designation_name; ?>  <br>
				<?php echo $emp->battalion_name.', '.$emp->battalion_address; ?> 
			</td>
			<td><?php echo App\Helpers\CommonHelper::en2bnNumber($v_basic_amount->basic_amount);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		
		<tr>
			<td style="text-align: center; border-style: none;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;" colspan="2">(মাত্র ............... টাকা)</td>		
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
		</tr>
	</table>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- 5th Page -->
<p style="text-align: center;">ফরম টি, আর, ৫১ 'এ' <br> কল্যাণ তহবিল ও যৌথ বীমার কর্তন তালিকা </p>

<div style="width: 50%;float: left;">
	অফিসঃ <?php echo $emp->battalion_name.', '.$emp->battalion_address;?> 
</div>
<div style="width: 50%;float: left; text-align: right;">
	মাসঃ  <?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?> ইং
</div>
<br>
<div style="width: 100%">
	<table>
		<tr>
			<td rowspan="2" style="text-align: center;  width: 8%;">ক্রমিক নং </td>
			<td rowspan="2" style="text-align: center;  width: 25%;">কর্মকর্তা/কর্মচারীর নাম ও পদবী</td>
			<td rowspan="2" style="text-align: center;  width: 10%;">মূল বেতন  </td>
			<td colspan="2" style="text-align: center;  width: 10%;">কল্যান তহবিল</td>
			<td colspan="2" style="text-align: center;  width: 15%;">যৌথ বীমা</td>
			<td rowspan="2" style="text-align: center;  width: 8%;">মন্তব্য</td>	
		</tr>
		<tr>
			<td>আদায়যোগ্য টাকা</td>
			<td>বিগত মাসের পার্থক্য যদি থাকে (-) অথবা (+)</td>
			<td>আদায়যোগ্য টাকা</td>
			<td>বিগত মাসের পার্থক্য যদি থাকে (-) অথবা (+)</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo $emp->emp_name.', '. $emp->rank_name; ?>  <br>
				<?php echo $emp->designation_name; ?>  <br>
				<?php echo $emp->battalion_name.', '.$emp->battalion_address; ?> 
			</td>
			<td><?php echo App\Helpers\CommonHelper::en2bnNumber($v_basic_amount->basic_amount);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		
		<tr>
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;">মোট = </td>
			<td style="text-align: center;">(...............)</td>		
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
			<td style="text-align: center;"></td>
		</tr>
	</table>
</div>

<pagebreak>
	<p style="text-align: center; font-size: 18px;"><u> বিবিধ কর্তনের সিডিউল<br>র‍্যাব ফোর্সেস সদর দপ্তর, ঢাকা</u></p>
	<p style="text-align: center;">
		নাম ও পদবীঃ <?php echo $emp->emp_name.', '. $emp->rank_name; ?>  <br>
		মূল বেতনঃ <?php echo App\Helpers\CommonHelper::en2bnNumber($v_basic_amount->basic_amount);?><br>
		মাসের নামঃ <?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?><br>
	</p>
	<br>
	<div style="width: 100%">
		<table>
			<tr>
				<td style="width: 15%">ক্রমিক নং</td>	
				<td style="width: 35%">বিলের বিবরণ</td>	
				<td style="width: 35%">কর্তণকৃত টাকার পরিমান</td>	
				<td style="width: 15%">মন্তব্য</td>	
			</tr>
			@foreach($deduction_heads as $key=>$deduction_head)
			<tr>
				<td><?php echo App\Helpers\CommonHelper::en2bnNumber(++$key);?>|</td>
				<td>
					{{ $deduction_head->name or null }}<br>
					কোড নং - {{ $deduction_head->code or null }}
				</td>
				<td align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($deduction_head->sum_amount);?></td>
				<td></td>
			</tr>
			@endforeach
			<tr>
				<td></td>
				<td></td>
				<td>মোট টাকা</td>
				<td align="right"><?php echo App\Helpers\CommonHelper::en2bnNumber($deduction_amount);?></td>
			</tr>
		</table>
	</div>	
</pagebreak>
	
<?php endforeach;?>
</body>
</html>	
