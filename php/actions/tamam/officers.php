<?php
  session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}

// connect to database
include "../../../includes/controls/db/connection.php";

	$d=strtotime("+1 day");
	$today = date("Y-m-d", $d);
	$d=strtotime("+1 day");
	$dayname = date("l", $d);

$query = "SELECT * FROM  officer";
$result = mysqli_query( $conn, $query );

$query = "SELECT * FROM  officer WHERE availability=1";
$Exists = mysqli_query( $conn, $query );

$query = "SELECT * FROM  officer WHERE availability=0";
$Out = mysqli_query( $conn, $query );

// query & مأموريات
$query1 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND type=1 ORDER BY officer.degree";
$result1 = mysqli_query( $conn, $query1 );

// query & فرق
$query2 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND type=2 ORDER BY officer.degree";
$result2 = mysqli_query( $conn, $query2 );
// query & مستشفى
$query3 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND type=4 ORDER BY officer.degree";
$result3 = mysqli_query( $conn, $query3 );
// query & أختبارات
$query4 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND type=3 ORDER BY officer.degree";
$result4 = mysqli_query( $conn, $query4 );
// query & لأجازات




$query5 = "SELECT officervacancy.id,officer.name,officer.degree,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id ORDER BY officer.degree";
$result5 = mysqli_query( $conn, $query5);
$result10 = mysqli_query( $conn, $query5);

$query6 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=5 WHERE officerperiodical.date = '$today' LIMIT 1 ";
$result6 = mysqli_query( $conn, $query6 );

$query7 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=2 WHERE officerperiodical.date = '$today' LIMIT 1 ";
$result7 = mysqli_query( $conn, $query7);

$query8 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=1 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
$result8 = mysqli_query( $conn, $query8 );

$query9 = "SELECT assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=1 WHERE assistantperiodical.date >= '$today' LIMIT 1 ";
$result9 = mysqli_query( $conn, $query9 );

$vacancyR = 0;
$vacancyM = 0;
$vacancyI = 0;
$vacancyY = 0;
$vacancyB = 0;
$vacancyE = 0;

	if( mysqli_num_rows($result10)){
		while ($row = mysqli_fetch_assoc($result10)) {
			switch($row['type']){
				case 1:
					$vacancyM++;
				break;
				case 2:
					$vacancyR++;
				break;
				case 3:
					$vacancyB++;
				break;
				case 4:
					$vacancyY++;
				break;
				case 5:
					$vacancyE++;
				break;
				case 6:
					$vacancyI++;
				break;
			}
		}
	}
$countOutM = mysqli_num_rows($result1);
$countOutF = mysqli_num_rows($result2);
$countOutH = mysqli_num_rows($result3);
$countOutT = mysqli_num_rows($result4);
$countOutV = mysqli_num_rows($result5);
$Total= mysqli_num_rows($result);
$totalOut = mysqli_num_rows($Out);
$exists = mysqli_num_rows($Exists);


//check for the query string
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

	
	switch($dayname){
		case "Saturday":
		$dayname = '<span>السبت</span>';
		break;
		case "Sunday":
		$dayname = '<span>الأحد</span>';
		break;
		case "Monday":
		$dayname = '<span>الإثنين</span>';
		break;
		case "Tuesday":
		$dayname = '<span>الثلاثاء</span>';
		break;
		case "Wednesday":
		$dayname = '<span>الأربعاء</span>';
		break;
		case "Thursday":
		$dayname = '<span>الخميس</span>';
		break;
		case "Friday":
		$dayname = '<span>الجمعة</span>';
		break;
	}
		
 // close the connection
 //mysqli_close($conn);
include "../../../includes/header/header/header.php";
// print the alert message
?>
<body>

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
<div class="container" style="border : 5px double #333;padding:10px 30px;min-height:1010px">
	<h5 class="text-center" style="font-weight:bold;line-height:20px">بيان بخوارج ضباط الفوج 715 حرب إلكترونية <br>
		عن اليوم <?php
		echo $dayname;
		echo  "  "; 
		echo  $today ;
	?>
	</h5>
	<div class="row">
		<span class="text-right" style="font-weight:bold;font-size:13px;line-height:20px">بيــــان الخــــوارج :-</span>
		<table class="table  table-bordered text-center ">
			<tr style="background-color: #ccc">
				<th rowspan="3" style="line-height:50px;text-align:center;font-size:10px">البيان</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">القوة</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">موجود</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">خارج</th>
				<th colspan="6" style="line-height:10px;text-align:center;font-size:10px">أجــــــــــــــــــازة</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">مأمورية</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">فرقة</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">مستشفى</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:10px">أختبارات</th>
			</tr>
			<tr style="background-color: #ccc">
				<th style="line-height:10px;text-align:center;font-size:10px">مرضية</th>
				<th style="line-height:10px;text-align:center;font-size:10px">سنوية</th>
				<th style="line-height:10px;text-align:center;font-size:10px">بدل </th>
				<th style="line-height:10px;text-align:center;font-size:10px">راحة</th>
				<th style="line-height:10px;text-align:center;font-size:10px">ميدانية</th>
				<th style="line-height:10px;text-align:center;font-size:10px">عارضة</th>
			</tr>
			<tr>
			<!--# countOutM , countOutF , countOutH , countOutT ,-->
				<td style="line-height:10px"><?php echo $Total ?></td>
				<td style="line-height:10px"><?php echo $exists ?></td>
				<td style="line-height:10px"><?php echo $totalOut ?></td>
				<td style="line-height:10px"><?php echo $vacancyI ?></td>
				<td style="line-height:10px"><?php echo $vacancyY ?></td>
				<td style="line-height:10px"><?php echo $vacancyB ?></td>
				<td style="line-height:10px"><?php echo $vacancyR ?></td>
				<td style="line-height:10px"><?php echo $vacancyM ?></td>
				<td style="line-height:10px"><?php echo $vacancyE ?></td>
				<td style="line-height:10px"><?php echo $countOutM;?></td>
				<td style="line-height:10px"><?php echo $countOutF;?></td>
				<td style="line-height:10px"><?php echo $countOutH;?></td>
				<td style="line-height:10px"><?php echo $countOutT;?></td>
				
			</tr>
		</table>
	</div>
<?php if(mysqli_num_rows($result1) > 0 ) {?>
  <div class="row">
  <h4 class="text-right" style="text-decoration:underline">المأموريات :-</h4>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px;background-color:#ccc">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
		<td rowspan="2" style="line-height:30px">الجهة</td>
		<td colspan="2" style="line-height:10px">المــــــــدة</td>
      </tr>
	  <tr style="line-height:8px;background:#ddd">
		<td style="line-height:8px">من</td>
		<td style="line-height:8px">إلى</td>
	  </tr>
      <?php
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result1)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<span>ملازم</span>';
			break;
			case 2:
			$degree = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree = '<span>نقيب</span>';
			break;
			case 4:
			$degree = '<span>رائد</span>';
			break;
			case 5:
			$degree = '<span>مقدم</span>';
			break;
			case 6:
			$degree = '<span>عقيد</span>';
			break;
			case 7:
			$degree = '<span>عميد</span>';
			break;
			case 8:
			$degree = '<span>لواء</span>';
			break;
		}

		$i++;
		if($row['start_date']!="0000-00-00"){
			$start_date=date_create($row['start_date']);
			$formatStart = date_format($start_date,"Y/m/d ");
		}else{
			$formatStart = '-';
		}
		
		if($row['end_date']!= "0000-00-00"){
			$end_date=date_create($row['end_date']);
			$formatEnd = date_format($end_date,"Y/m/d ");
		}else{
			$formatEnd = '-';
		}
	
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px;font-weight:normal'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$row['destination']."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatStart."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  
  </div>
<?php } ?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->
<?php if(mysqli_num_rows($result2) > 0 ) {?>
  <div class="row">
  <span class="text-right" style="font-weight:bold;font-size:13px;line-height:20px">الفرق :-</span>
  <table class="table  table-bordered text-center">
	<tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
		<td rowspan="2" style="line-height:30px">الجهة</td>
		<td colspan="2" style="line-height:10px">المــــــــدة</td>
      </tr>
	  <tr style="line-height:8px;background-color: #ccc">
		<td style="line-height:8px">من</td>
		<td style="line-height:8px">إلى</td>
	  </tr>
      <?php
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result2)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<span>ملازم</span>';
			break;
			case 2:
			$degree = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree = '<span>نقيب</span>';
			break;
			case 4:
			$degree = '<span>رائد</span>';
			break;
			case 5:
			$degree = '<span>مقدم</span>';
			break;
			case 6:
			$degree = '<span>عقيد</span>';
			break;
			case 7:
			$degree = '<span>عميد</span>';
			break;
			case 8:
			$degree = '<span>لواء</span>';
			break;
		}

		$i++;
				if($row['start_date']!="0000-00-00"){
			$start_date=date_create($row['start_date']);
			$formatStart = date_format($start_date,"Y/m/d ");
		}else{
			$formatStart = '-';
		}
		
		if($row['end_date']!= "0000-00-00"){
			$end_date=date_create($row['end_date']);
			$formatEnd = date_format($end_date,"Y/m/d ");
		}else{
			$formatEnd = '-';
		}
	
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px;font-weight:normal'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$row['destination']."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatStart."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  
  </div>
<?php } ?>
<!--------------------------------------------------------------------------------------->
<?php if(mysqli_num_rows($result5) > 0 ) {?>
  <div class="row">
  <span class="text-right" style="font-weight:bold;font-size:13px;line-height:20px">أجازات :-</span>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
		<td rowspan="2" style="line-height:30px">نوع الأجازة</td>
		<td colspan="2" style="line-height:10px">المــــــــدة</td>
      </tr >
	  <tr style="line-height:8px;background-color: #ccc">
		<td style="line-height:8px">من</td>
		<td style="line-height:8px">إلى</td>
	  </tr>
      <?php
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result5)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<span>ملازم</span>';
			break;
			case 2:
			$degree = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree = '<span>نقيب</span>';
			break;
			case 4:
			$degree = '<span>رائد</span>';
			break;
			case 5:
			$degree = '<span>مقدم</span>';
			break;
			case 6:
			$degree = '<span>عقيد</span>';
			break;
			case 7:
			$degree = '<span>عميد</span>';
			break;
			case 8:
			$degree = '<span>لواء</span>';
			break;
		}
		$type = '';
		switch($row['type']){
			case 1:
			$type = '<span>ميدانية </span>';
			break;
			case 2:
			$type = '<span>راحة</span>';
			break;
			case 3:
			$type = '<span>بدل راحة</span>';
			break;
			case 4:
			$type = '<span>سنوية</span>';
			break;
			case 5:
			$type = '<span>عارضة</span>';
			break;
			case 6:
			$type = '<span>مرضية</span>';
			break;
		}

		$i++;
				if($row['start_date']!="0000-00-00"){
			$start_date=date_create($row['start_date']);
			$formatStart = date_format($start_date,"Y/m/d ");
		}else{
			$formatStart = '-';
		}
		
		if($row['end_date']!= "0000-00-00"){
			$end_date=date_create($row['end_date']);
			$formatEnd = date_format($end_date,"Y/m/d ");
		}else{
			$formatEnd = '-';
		}
	
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px;font-weight:normal'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$type."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatStart."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  
  <?php } ?>
  <!----------------------------------------------------------------------------------------->
<?php if(mysqli_num_rows($result3) > 0 ) {?>
  <div class="row">
  <h4 class="text-right">مستشفى</h4>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
		<td rowspan="2" style="line-height:30px">الجهة</td>
		<td colspan="2">المــــــــدة</td>
      </tr>
	  <tr style="line-height:8px;background-color: #ccc">
		<td style="line-height:8px">من</td>
		<td style="line-height:8px">إلى</td>
	  </tr>
      <?php
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result3)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<span>ملازم</span>';
			break;
			case 2:
			$degree = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree = '<span>نقيب</span>';
			break;
			case 4:
			$degree = '<span>رائد</span>';
			break;
			case 5:
			$degree = '<span>مقدم</span>';
			break;
			case 6:
			$degree = '<span>عقيد</span>';
			break;
			case 7:
			$degree = '<span>عميد</span>';
			break;
			case 8:
			$degree = '<span>لواء</span>';
			break;
		}

		$i++;
				if($row['start_date']!="0000-00-00"){
			$start_date=date_create($row['start_date']);
			$formatStart = date_format($start_date,"Y/m/d ");
		}else{
			$formatStart = '-';
		}
		
		if($row['end_date']!= "0000-00-00"){
			$end_date=date_create($row['end_date']);
			$formatEnd = date_format($end_date,"Y/m/d ");
		}else{
			$formatEnd = '-';
		}
	
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px;font-weight:normal'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$row['destination']."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatStart."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  
  </div>
<?php } ?>
<!----------------------------------------------------------------------------------------------->
<?php if(mysqli_num_rows($result4) > 0 ) {?>
  <div class="container">
  <h4 class="text-right">أختبارات</h4>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
		<td rowspan="2" style="line-height:10px">الجهة</td>
		<td colspan="2">المــــــــدة</td>
      </tr style="background-color: #ccc">
	  <tr style="line-height:8px">
		<td style="line-height:8px">من</td>
		<td style="line-height:8px">إلى</td>
	  </tr>
      <?php
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result4)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<span>ملازم</span>';
			break;
			case 2:
			$degree = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree = '<span>نقيب</span>';
			break;
			case 4:
			$degree = '<span>رائد</span>';
			break;
			case 5:
			$degree = '<span>مقدم</span>';
			break;
			case 6:
			$degree = '<span>عقيد</span>';
			break;
			case 7:
			$degree = '<span>عميد</span>';
			break;
			case 8:
			$degree = '<span>لواء</span>';
			break;
		}

		$i++;
				if($row['start_date']!="0000-00-00"){
			$start_date=date_create($row['start_date']);
			$formatStart = date_format($start_date,"Y/m/d ");
		}else{
			$formatStart = '-';
		}
		
		if($row['end_date']!= "0000-00-00"){
			$end_date=date_create($row['end_date']);
			$formatEnd = date_format($end_date,"Y/m/d ");
		}else{
			$formatEnd = '-';
		}
	
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px;font-weight:normal'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$row['destination']."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatStart."</td><td style='line-height:8px;font-weight:normal'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  
  </div>
<?php } ?>
<!-------------------------------------------------------------------------------------------------------------->

    <span class="text-right" style="font-weight:bold;font-size:13px;line-height:20px">النوبتجية :-</span>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th  style="line-height:10px;text-align:center">م</th>
		<th  style="line-height:10px;text-align:center">رتبة</th>
		<th  style="line-height:10px;text-align:center">الإسم</th>
		<th  style="line-height:10px;text-align:center">النوبتجية</th>
      </tr>
	  <?php
	  
	  if( mysqli_num_rows($result6) > 0 &&  mysqli_num_rows($result7) > 0 &&  mysqli_num_rows($result8) > 0 &&  mysqli_num_rows($result9) > 0){
			$i=0;
		  $leader = mysqli_fetch_assoc($result6);
		  $greet = mysqli_fetch_assoc($result7);
		  $nopatgy = mysqli_fetch_assoc($result8);
		  $assistant = mysqli_fetch_assoc($result9);
		  
		  $degree = '';
		switch($leader['degree']){
			case 1:
			$degree = '<span>ملازم</span>';
			break;
			case 2:
			$degree = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree = '<span>نقيب</span>';
			break;
			case 4:
			$degree = '<span>رائد</span>';
			break;
			case 5:
			$degree = '<span>مقدم</span>';
			break;
			case 6:
			$degree = '<span>عقيد</span>';
			break;
			case 7:
			$degree = '<span>عميد</span>';
			break;
			case 8:
			$degree = '<span>لواء</span>';
			break;
		}
		
		$degree2 = '';
		switch($greet['degree']){
			case 1:
			$degree2 = '<span>ملازم</span>';
			break;
			case 2:
			$degree2 = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree2 = '<span>نقيب</span>';
			break;
			case 4:
			$degree2 = '<span>رائد</span>';
			break;
			case 5:
			$degree2 = '<span>مقدم</span>';
			break;
			case 6:
			$degree2 = '<span>عقيد</span>';
			break;
			case 7:
			$degree2 = '<span>عميد</span>';
			break;
			case 8:
			$degree2 = '<span>لواء</span>';
			break;
		}
		
		$degree3 = '';
		switch($nopatgy['degree']){
			case 1:
			$degree3 = '<span>ملازم</span>';
			break;
			case 2:
			$degree3 = '<span>ملازم أول</span>';
			break;
			case 3:
			$degree3 = '<span>نقيب</span>';
			break;
			case 4:
			$degree3 = '<span>رائد</span>';
			break;
			case 5:
			$degree3 = '<span>مقدم</span>';
			break;
			case 6:
			$degree3 = '<span>عقيد</span>';
			break;
			case 7:
			$degree3 = '<span>عميد</span>';
			break;
			case 8:
			$degree3 = '<span>لواء</span>';
			break;
		}
		
		$degree1= '';
		switch($assistant['degree']){
			case 1:
			$degree1 = '<span>عريف</span>';
			break;
			case 2:
			$degree1 = '<span>رقيب</span>';
			break;
			case 3:
			$degree1 = '<span>رقيب أول</span>';
			break;
			case 4:
			$degree1 = '<span> مساعد</span>';
			break;
			case 5:
			$degree1 = '<span>مساعد أول</span>';
			break;
		}

		  		echo"<tr><td style='line-height:8px;background-color: #ccc'>1</td><td style='line-height:8px;'>"
				  .$degree."</td><td style='line-height:8px;'>"
				  .$leader['name']."</td><td style='line-height:8px;'>قائد منوب</td></tr>";
				  
				  echo"<tr><td style='line-height:8px;background-color: #ccc'>2</td><td style='line-height:8px;'>"
				  .$degree2."</td><td style='line-height:8px;'>"
				  .$greet['name']."</td><td style='line-height:8px;'>ضابط عظيم وخفيف حركة </td></tr>";
				  
				  echo"<tr><td style='line-height:8px;background-color: #ccc'>3</td><td style='line-height:8px;'>"
				  .$degree3."</td><td style='line-height:8px;'>"
				  .$nopatgy['name']."</td><td style='line-height:8px;'>ضابط نوبتجى</td></tr>";
				  
				  echo"<tr><td style='line-height:8px;background-color: #ccc'>4</td><td style='line-height:8px;'>"
				  .$degree1."</td><td style='line-height:8px;'>"
				  .$assistant['name']."</td><td style='line-height:8px;'>مساعد ض نوبتجى</td></tr>";
				  
	   }
	  
	  ?>
  </table>

	<h5 style="font-weight:bold;line-height:18px" class="text-left">
التوقيع "&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;"<br>

<?php 
$query = "SELECT * FROM officer WHERE job=22 LIMIT 1";
$result = mysqli_query( $conn, $query);

 while ($row = mysqli_fetch_assoc($result)) {
	if($row['job']==22 && $row['availability']==1){
	switch($row['degree']){
			case 1:
			$degree = 'ملازم';
			break;
			case 2:
			$degree = 'ملازم أول';
			break;
			case 3:
			$degree = 'نقيب';
			break;
			case 4:
			$degree = 'رائد';
			break;
			case 5:
			$degree = 'مقدم';
			break;
			case 6:
			$degree = 'عقيد';
			break;
			case 7:
			$degree = 'عميد';
			break;
			case 8:
			$degree = 'لواء';
			break;
		}
	?>
    <?php echo $degree." أح /  ".$row['name']?><br>
	
	قائد الفوج 715 حـــــــرب إلك
		</h5>
	<?php
	}else{
	?>
		 <?php echo $degree." أح / ".$row['name']?><br>
	قائد الفوج 715 حرب إلك بالإنابة
		</h5>
		
	<?php
	break;
	}
 }
?>
 </div>

	</div>
	</div>
<script type="text/javascript" language="javascript">

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
  myWindow.document.write("<html><head>"+head+"<style>body{padding:5px;}@media print {.printbtn {display:none;}}</style></head><body onload='window.print()'><div class='container'><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-print'></span>   طباعة   </button><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-download'></span>   تحميل   </button></div><br>"+content);
}
</script>
<?php
  include "../../../includes/footer/foot/foot.php";
?>