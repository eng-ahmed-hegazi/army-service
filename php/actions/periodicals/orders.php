<?php
   session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
  include "../../../includes/controls/db/connection.php";
  
	$d=strtotime("+1 day");
	$today = date("Y-m-d", $d);
  
    $d=strtotime("+1 day");
	$dayname = date("l", $d);
	
	$query1 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=5 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
	$result1 = mysqli_query( $conn, $query1 );
	
	$query2 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=2 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
	$result2 = mysqli_query( $conn, $query2 );
	
	$query3 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=1 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
	$result3 = mysqli_query( $conn, $query3 );
	
	$query4 = "SELECT  assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=1 WHERE assistantperiodical.date >= '$today' ORDER BY assistantperiodical.date LIMIT 3 ";
	$result4 = mysqli_query( $conn, $query4 );
	
	$query5 = "SELECT  assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=4 WHERE assistantperiodical.date >= '$today' ORDER BY assistantperiodical.date LIMIT 3 ";
	$result5 = mysqli_query( $conn, $query5 );
	
	$query6 = "SELECT  assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=3 WHERE assistantperiodical.date >= '$today' ORDER BY assistantperiodical.date LIMIT 3 ";
	$result6 = mysqli_query( $conn, $query6 );
	

	

	if ( isset( $_GET['alert'] ) ){
	  if ( $_GET['alert'] == 'success' ){
		$alertMessage = "<div class='alert alert-success'>تمت الإضافة بنجاح<a href='' data-dismiss='alert' class='close'>&times;</a></div>";
	  }
	  else if( $_GET['alert'] == 'updatesuccess' ){
		$alertMessage = "<div class='alert alert-info'>تم التعديل بنجاح<a href='' data-dismiss='alert' class='close'>&times;</a></div>";
	  } else if( $_GET['alert'] == 'deleted' ){
		$alertMessage = "<div class='alert alert-info'>تم الحذف بنجاح<a href='' data-dismiss='alert' class='close'>&times;</a></div>";
	  }
	}
	
	mysqli_close($conn);
	include "../../../includes/header/header/header.php";
?>

  
  <style>
	table tr{
		padding:0;
	}
  </style>
  <?php echo $alertMessage; ?>
	<div class="container-fluid">
		<table class="table">
		<tbody>
			  <tr>
				<td><a href="javascript:void(0);" class="btn btn-default" onclick="printPage();return false;"><span class="glyphicon glyphicon-print"></span>   طباعة   </a></td>
				</tr>
			<tbody>	
		</table>
	</div>
	<div id='main'>
      <div id='mainLeaderboard' style='overflow:hidden;'>
      <!-- Ezoic - Leaderboard - top_of_page -->
      <div id="ezoic-pub-ad-placeholder-103">
        <!-- MainLeaderboard-->
        <div id='div-gpt-ad-1422003450156-2'>
          <script type='text/javascript'>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422003450156-2'); });</script>
        </div>
      </div>
      <!-- End Ezoic - Leaderboard - top_of_page -->
      </div>
	<div class="container">
  <div class="row">
  
  <div class="col-md-12">
				<table class="table table-bordered text-center" style="border:2px solid #000 ">
				<td colspan="4" style="line-height:18px">
				أوامر الفوج 715 حرب إلكترونية الصادرة بأمر عميد أح / شريف عادل محمد قائد الفوج
	 <br>عن  يوم 
	<?php 
	switch($dayname){
		case "Saturday":
		$dayname = '<label>السبت</label>';
		break;
		case "Sunday":
		$dayname = '<label>الأحد</label>';
		break;
		case "Monday":
		$dayname = '<label>الإثنين</label>';
		break;
		case "Tuesday":
		$dayname = '<label>الثلاثاء</label>';
		break;
		case "Wednesday":
		$dayname = '<label>الأربعاء</label>';
		break;
		case "Thursday":
		$dayname = '<label>الخميس</label>';
		break;
		case "Friday":
		$dayname = '<label>الجمعة</label>';
		break;
	}
		echo $dayname;
	?> الموافق<?php 
	$dd=strtotime("+1 day");
	$today1 = date("d / m / Y", $dd);
	
	echo $today1;
	?>
				</td>
				  <tr style='border:2px solid #000 '>
					<th width="200" class="text-center"style='border:2px solid #000 '>الوظيفة</th>
					<td style='border:2px solid #000 '>اليوم</td>
					<td width="80" style='border:2px solid #000 '>الرتبة</td>
					<td width="450" style='border:2px solid #000 '>الإسم</td>
				  </tr>
				  <?php
			  if( mysqli_num_rows($result1) > 0){
					$i=0;
				   while ($row = mysqli_fetch_assoc($result1)) {
				   $dayname = '';
					switch($row['day']){
						case "Saturday":
						$dayname = '<label>السبت</label>';
						break;
						case "Sunday":
						$dayname = '<label>الأحد</label>';
						break;
						case "Monday":
						$dayname = '<label>الإثنين</label>';
						break;
						case "Tuesday":
						$dayname = '<label>الثلاثاء</label>';
						break;
						case "Wednesday":
						$dayname = '<label>الأربعاء</label>';
						break;
						case "Thursday":
						$dayname = '<label>الخميس</label>';
						break;
						case "Friday":
						$dayname = '<label>الجمعة</label>';
						break;
					}
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = '<label>ملازم</label>';
						break;
						case 2:
						$degree = '<label>ملازم أول</label>';
						break;
						case 3:
						$degree = '<label>نقيب</label>';
						break;
						case 4:
						$degree = '<label>رائد</label>';
						break;
						case 5:
						$degree = '<label>مقدم</label>';
						break;
						case 6:
						$degree = '<label>عقيد</label>';
						break;
						case 7:
						$degree = '<label>عميد</label>';
						break;
						case 8:
						$degree = '<label>لواء</label>';
						break;
					}
					$i++;
					$date=date_create($row['date']);
					
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '>".$degree."</td><td style='border:2px solid #000 '>"
							  .$row['name']."</td></tr>";
				  }
				  $i = mysqli_num_rows($result1);
				  while($i<3){
					$i++;
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '></td><td style='border:2px solid #000 '></td></tr>";
				  }
				  
			  }
			  
			  //*****************************************************
			  if( mysqli_num_rows($result2) > 0){
					$i=0;
				   while ($row = mysqli_fetch_assoc($result2)) {
				   $dayname = '';
					switch($row['day']){
						case "Saturday":
						$dayname = '<label>السبت</label>';
						break;
						case "Sunday":
						$dayname = '<label>الأحد</label>';
						break;
						case "Monday":
						$dayname = '<label>الإثنين</label>';
						break;
						case "Tuesday":
						$dayname = '<label>الثلاثاء</label>';
						break;
						case "Wednesday":
						$dayname = '<label>الأربعاء</label>';
						break;
						case "Thursday":
						$dayname = '<label>الخميس</label>';
						break;
						case "Friday":
						$dayname = '<label>الجمعة</label>';
						break;
					}
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = '<label>ملازم</label>';
						break;
						case 2:
						$degree = '<label>ملازم أول</label>';
						break;
						case 3:
						$degree = '<label>نقيب</label>';
						break;
						case 4:
						$degree = '<label>رائد</label>';
						break;
						case 5:
						$degree = '<label>مقدم</label>';
						break;
						case 6:
						$degree = '<label>عقيد</label>';
						break;
						case 7:
						$degree = '<label>عميد</label>';
						break;
						case 8:
						$degree = '<label>لواء</label>';
						break;
					}
					$i++;
					$date=date_create($row['date']);
					
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000 '>ضابط عظيم وخفيف حركة</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '>".$degree."</td><td style='border:2px solid #000 '>"
							  .$row['name']."</td></tr>";
				  }
				  
				  $i = mysqli_num_rows($result2);
				  while($i<3){
					$i++;
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '></td><td style='border:2px solid #000 '></td></tr>";
				  }
			  }
			  //***********************************************************************
			  if( mysqli_num_rows($result3) > 0){
					$i=0;
				   while ($row = mysqli_fetch_assoc($result3)) {
				   $dayname = '';
					switch($row['day']){
						case "Saturday":
						$dayname = '<label>السبت</label>';
						break;
						case "Sunday":
						$dayname = '<label>الأحد</label>';
						break;
						case "Monday":
						$dayname = '<label>الإثنين</label>';
						break;
						case "Tuesday":
						$dayname = '<label>الثلاثاء</label>';
						break;
						case "Wednesday":
						$dayname = '<label>الأربعاء</label>';
						break;
						case "Thursday":
						$dayname = '<label>الخميس</label>';
						break;
						case "Friday":
						$dayname = '<label>الجمعة</label>';
						break;
					}
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = '<label>ملازم</label>';
						break;
						case 2:
						$degree = '<label>ملازم أول</label>';
						break;
						case 3:
						$degree = '<label>نقيب</label>';
						break;
						case 4:
						$degree = '<label>رائد</label>';
						break;
						case 5:
						$degree = '<label>مقدم</label>';
						break;
						case 6:
						$degree = '<label>عقيد</label>';
						break;
						case 7:
						$degree = '<label>عميد</label>';
						break;
						case 8:
						$degree = '<label>لواء</label>';
						break;
					}
					$i++;
					$date=date_create($row['date']);
					
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000 '>ضابط نوبتجى وحريق</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '>".$degree."</td><td style='border:2px solid #000 '>"
							  .$row['name']."</td></tr>";
				  }
				  $i = mysqli_num_rows($result3);
				  while($i<3){
					$i++;
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '></td><td style='border:2px solid #000 '></td></tr>";
				  }
			  }
			  //********************************************************************
			  if( mysqli_num_rows($result4) > 0){
					$i=0;
				   while ($row = mysqli_fetch_assoc($result4)) {
				   $dayname = '';
					switch($row['day']){
						case "Saturday":
						$dayname = '<label>السبت</label>';
						break;
						case "Sunday":
						$dayname = '<label>الأحد</label>';
						break;
						case "Monday":
						$dayname = '<label>الإثنين</label>';
						break;
						case "Tuesday":
						$dayname = '<label>الثلاثاء</label>';
						break;
						case "Wednesday":
						$dayname = '<label>الأربعاء</label>';
						break;
						case "Thursday":
						$dayname = '<label>الخميس</label>';
						break;
						case "Friday":
						$dayname = '<label>الجمعة</label>';
						break;
					}
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = '<label>عريف</label>';
						break;
						case 2:
						$degree = '<label>رقيب</label>';
						break;
						case 3:
						$degree = '<label>رقيب أول</label>';
						break;
						case 4:
						$degree = '<label> مساعد</label>';
						break;
						case 5:
						$degree = '<label>مساعد أول</label>';
						break;
					}
					$i++;
					$date=date_create($row['date']);
					
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000 '>مساعد ض نوبتجى ورقيب نوبتجى</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '>".$degree."</td><td style='border:2px solid #000 '>"
							  .$row['name']."</td></tr>";
				  }
				  $i = mysqli_num_rows($result4);
				  while($i<3){
					$i++;
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '></td><td style='border:2px solid #000 '></td></tr>";
				  }
			  }
			  //*********************************************************************
			  if( mysqli_num_rows($result5) > 0){
					$i=0;
				   while ($row = mysqli_fetch_assoc($result5)) {
				   $dayname = '';
					switch($row['day']){
						case "Saturday":
						$dayname = '<label>السبت</label>';
						break;
						case "Sunday":
						$dayname = '<label>الأحد</label>';
						break;
						case "Monday":
						$dayname = '<label>الإثنين</label>';
						break;
						case "Tuesday":
						$dayname = '<label>الثلاثاء</label>';
						break;
						case "Wednesday":
						$dayname = '<label>الأربعاء</label>';
						break;
						case "Thursday":
						$dayname = '<label>الخميس</label>';
						break;
						case "Friday":
						$dayname = '<label>الجمعة</label>';
						break;
					}
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = '<label>عريف</label>';
						break;
						case 2:
						$degree = '<label>رقيب</label>';
						break;
						case 3:
						$degree = '<label>رقيب أول</label>';
						break;
						case 4:
						$degree = '<label> مساعد</label>';
						break;
						case 5:
						$degree = '<label>مساعد أول</label>';
						break;
					}
					$i++;
					$date=date_create($row['date']);
					
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000 '>حكمدار خفيف حركة</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '>".$degree."</td><td style='border:2px solid #000 '>"
							  .$row['name']."</td></tr>";
				  }
				  $i = mysqli_num_rows($result5);
				  while($i<3){
					$i++;
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '></td><td style='border:2px solid #000 '></td></tr>";
				  }
			  }
			  //***************************************************************
			  if( mysqli_num_rows($result6) > 0){
					$i=0;
				   while ($row = mysqli_fetch_assoc($result6)) {
				   $dayname = '';
					switch($row['day']){
						case "Saturday":
						$dayname = '<label>السبت</label>';
						break;
						case "Sunday":
						$dayname = '<label>الأحد</label>';
						break;
						case "Monday":
						$dayname = '<label>الإثنين</label>';
						break;
						case "Tuesday":
						$dayname = '<label>الثلاثاء</label>';
						break;
						case "Wednesday":
						$dayname = '<label>الأربعاء</label>';
						break;
						case "Thursday":
						$dayname = '<label>الخميس</label>';
						break;
						case "Friday":
						$dayname = '<label>الجمعة</label>';
						break;
					}
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = '<label>عريف</label>';
						break;
						case 2:
						$degree = '<label>رقيب</label>';
						break;
						case 3:
						$degree = '<label>رقيب أول</label>';
						break;
						case 4:
						$degree = '<label> مساعد</label>';
						break;
						case 5:
						$degree = '<label>مساعد أول</label>';
						break;
					}
					$i++;
					$date=date_create($row['date']);
					
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000 '>حكمدار بوابة وسجن</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000;line-height:10px'>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000;line-height:15px '>".$degree."</td><td style='border:2px solid #000;line-height:15px '>"
							  .$row['name']."</td></tr>";
				  }
				  $i = mysqli_num_rows($result4);
				  while($i<3){
					$i++;
					//Display the data
						echo "<tr style='border:2px solid #000 '>";
					if($i==1){
						echo "<td rowspan='3' style='padding-top:50px;border:2px solid #000'>قائد منوب</td>";
					}
					if($i==1){
						echo"<td style='border:2px solid #000 '>اليوم</td>";
					}elseif($i==2){
						echo"<td style='border:2px solid #000 '>باكر</td>";
					}elseif($i==3){
						echo"<td style='border:2px solid #000 '>منتظر</td>";
					}
					echo"<td style='border:2px solid #000 '></td><td style='border:2px solid #000 '></td></tr>";
				  }
			  }
			  ?>  
			  <tr class="text-right">
				<td colspan="4" style="line-height:15px">
				  أحوال المستشفي : دخول / خروج : لا يكــــــــــــــــــــــــــــــــن<br>
				أحوال التعيين حسب دفتر الأحوال , <br>
				(  الله الوطن )
				</td>
			  </tr>
			  </table>
		
	</div>
	</div>

<script type="text/javascript" language="javascript">

var d = new Date();
var days = ["السبت ","الأحد ","الإثنين ","الثلاثاء ","الأربعاء ","الخميس ","الجمعة "];
var current = days[d.getDay()+2];
var month = d.getMonth()+1;
var day = d.getDate()+1;
function printPage() {
  var content = document.getElementById("main").innerHTML;
  var css = "", i, j, c = document.getElementById("main").cloneNode(true);
  for (i = 0; i < c.childNodes.length; i++) {
    if (c.childNodes[i].nodeType == 1) {
      c.removeChild(c.childNodes[i]);
      content = c.innerHTML;
      break;
    }
  }
  var head = document.getElementsByTagName("head")[0].innerHTML;
  var myWindow=window.open('','','');
  myWindow.document.write("<html><head><title>"+current+" "+day+"/"+month+"/"+d.getFullYear()+"</title>"+head+"<style>body{padding:5px;}@media print {.printbtn {display:none;}}</style></head><body onload='window.print()'><div class='container'><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-print'></span>   طباعة   </button><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-download'></span>   تحميل   </button></div><br>"+content);
}
</script>
<?php
  include "../../../includes/footer/foot/foot.php";
?>
