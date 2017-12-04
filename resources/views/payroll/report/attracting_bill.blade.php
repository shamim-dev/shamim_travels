<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
    <table>
    	<tr>
    		<td style="text-align: center; width:20%">প্রমাণক সংখ্যা</td>
    		<td style="text-align: center; width:60%" colspan="2">জ্ঞাতব্য বিবরণ <br> উপযোজনের বিশদ বিবরণ যথাসম্ভব লিপিবদ্ধ করিতে হইতে</td>
    		<td style="text-align: center; width:30%">টাকার পরিমান</td>
    	</tr>
    	<tr>
    		<td rowspan="10"></td>
    		<td rowspan="10"><p>{{ $battalion->battalion_name or null }}, {{ $battalion->battalion_address or null }} কর্মরত <?php echo
        App\Helpers\CommonHelper::en2bnNumber($manpower->manpower);?> জন র‍্যাব সদস্যদের <?php echo App\Helpers\CommonHelper::en2bnNumber(Carbon\Carbon::parse($salary_date)->format('F Y')); ?> মাসের নিয়মিত বেতন ভাতা বিল ।
          </p>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <p>বিল নং ______________/<?php echo App\Helpers\CommonHelper::en2bnNumber(App\Helpers\CommonHelper::fiscalYear($salary_date)); ?></p>
        </td>
        <td>মূল বেতন</td>
        <td align="right"><?php if(isset($basic_salary->basic_salary)){echo App\Helpers\CommonHelper::en2bnNumber($basic_salary->basic_salary);} ?></td>
    	</tr>
      <?php $v_allowance_head_total=0;?>
      @foreach($allowance_heads as $allowance_head)
      <tr>
        <td>*{{ $allowance_head->code }} {{ $allowance_head->name }}</td>
        <td align="right"><?php if(isset($allowance_head->sum_amount)){echo App\Helpers\CommonHelper::en2bnNumber($allowance_head->sum_amount);} ?></td>
      </tr>
      <?php $v_allowance_head_total+=$allowance_head->sum_amount?>
      @endforeach
     
      <tr>
        <td>সর্বমোট </td>
        <td align="right"><?php 
        $v_total_income=$v_allowance_head_total+$basic_salary->basic_salary;
        $v_total_income = number_format($v_total_income, 2);
        echo App\Helpers\CommonHelper::en2bnNumber($v_total_income);?></td>
      </tr>

    </table>
    <br>
    <br>
    <br>
    <div style="width: 60%;float: left; text-align: left;">
    	তারিখঃ ........................ <br>
    	পরিশোধকৃত  .................. কোষাগার <br>
    	তারিখঃ .........................<br>
    	<span>সওব বি/ফ-১৩২/৭৬-২৪১২ তারিখ ২০-১২-৭৬ </span>
    </div>
    <div style="width: 40%;float: left; text-align: left;">
    	স্বাক্ষরঃ ....................................... <br>
    	পদবীঃ  ........................................</br>
    </div>
  </body>
</html>
