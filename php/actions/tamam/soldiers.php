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

$query = "SELECT * FROM  soldier";
$result = mysqli_query( $conn, $query );

$query = "SELECT * FROM  soldier WHERE availability=1";
$Exists = mysqli_query( $conn, $query );

$query = "SELECT * FROM  soldier WHERE availability=0";
$Out = mysqli_query( $conn, $query );

// query & مأموريات
$query1 = "SELECT soldierout.id,soldier.name,soldier.degree,soldierout.destination,soldierout.start_date,soldierout.end_date,soldierout.type FROM soldierout  JOIN soldier ON  soldier.id=soldier_id AND type=1 ORDER BY soldier.degree";
$result1 = mysqli_query( $conn, $query1 );

// query & فرق
$query2 = "SELECT soldierout.id,soldier.name,soldier.degree,soldierout.destination,soldierout.start_date,soldierout.end_date,soldierout.type FROM soldierout  JOIN soldier ON  soldier.id=soldier_id AND type=2 ORDER BY soldier.degree";
$result2 = mysqli_query( $conn, $query2 );
// query & مستشفى
$query3 = "SELECT soldierout.id,soldier.name,soldier.degree,soldierout.destination,soldierout.start_date,soldierout.end_date,soldierout.type FROM soldierout  JOIN soldier ON  soldier.id=soldier_id AND type=4 ORDER BY soldier.degree";
$result3 = mysqli_query( $conn, $query3 );
// query & غياب
$query4 = "SELECT soldierabsent.id,soldier.name,soldier.degree,soldierabsent.start_date,soldierabsent.end_date,soldierabsent.type FROM soldierabsent  JOIN soldier ON  soldier.id=soldier_id AND type=1 ORDER BY soldier.degree";
$result4 = mysqli_query( $conn, $query4 );
// query & سجن حربى
$query10 = "SELECT soldierabsent.id,soldier.name,soldier.degree,soldierabsent.start_date,soldierabsent.end_date,soldierabsent.type FROM soldierabsent  JOIN soldier ON  soldier.id=soldier_id AND type=2 ORDER BY soldier.degree";
$result10 = mysqli_query( $conn, $query10 );
// query & لأجازات
$query5 = "SELECT soldiervacancy.id,soldier.name,soldier.degree,soldiervacancy.start_date,soldiervacancy.end_date,soldiervacancy.type FROM soldiervacancy  JOIN soldier ON  soldier.id=soldier_id ORDER BY soldier.degree";
$result5 = mysqli_query( $conn, $query5);
$result6 = mysqli_query( $conn, $query5);

$vacancyR = 0;
$vacancyM = 0;
$vacancyI = 0;
	if( mysqli_num_rows($result6)){
		while ($row = mysqli_fetch_assoc($result6)) {
			switch($row['type']){
				case 1:
					$vacancyM++;
				break;
				case 2:
					$vacancyR++;
				break;
				case 3:
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
$countOutG = mysqli_num_rows($result10);
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
		$dayname = 'السبت';
		break;
		case "Sunday":
		$dayname = 'الأحد';
		break;
		case "Monday":
		$dayname = 'الإثنين';
		break;
		case "Tuesday":
		$dayname = 'الثلاثاء';
		break;
		case "Wednesday":
		$dayname = 'الأربعاء';
		break;
		case "Thursday":
		$dayname = 'الخميس';
		break;
		case "Friday":
		$dayname = 'الجمعة';
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
	<h5 class="text-center" style="font-weight:bold;">بيان بخوارج المجندين بالفوج 715 حرب إلكترونية<br>
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
				<th rowspan="3" style="line-height:50px;text-align:center;font-size:13px">البيان</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">القوة</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">موجود</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">خارج</th>
				<th colspan="3" style="line-height:10px;text-align:center;font-size:13px">أجــــــــــــــــــازة</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">مأمورية</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">فرقة</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">مستشفى</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">سجن حربي</th>
				<th rowspan="2" style="line-height:25px;text-align:center;font-size:13px">غياب</th>
			</tr>
			<tr style="background-color: #ccc">
				<th style="line-height:10px;text-align:center;font-size:13px">مرضية</th>
				<th style="line-height:10px;text-align:center;font-size:13px">راحة</th>
				<th style="line-height:10px;text-align:center;font-size:13px">ميدانية</th>
			</tr>
			<tr>
			<!--# countOutM , countOutF , countOutH , countOutT ,-->
				<td style="line-height:10px"><?php echo $Total ?></td>
				<td style="line-height:10px"><?php echo $exists ?></td>
				<td style="line-height:10px"><?php echo $totalOut ?></td>
				<td style="line-height:10px"><?php echo $vacancyI ?></td>
				<td style="line-height:10px"><?php echo $vacancyR ?></td>
				<td style="line-height:10px"><?php echo $vacancyM ?></td>
				<td style="line-height:10px"><?php echo $countOutM;?></td>
				<td style="line-height:10px"><?php echo $countOutF;?></td>
				<td style="line-height:10px"><?php echo $countOutH;?></td>
				<td style="line-height:10px"><?php echo $countOutG;?></td>
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
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
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
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
			break;
		}

		$i++;
		$start_date=date_create($row['start_date']);
		$end_date=date_create($row['end_date']);
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px;background-color: #ccc'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$row['destination']."</td><td style='line-height:8px;'>"
					  .date_format($start_date,"Y/m/d ")."</td><td style='line-height:8px;'>"
					  .date_format($end_date,"Y/m/d ")."</td></tr>";
			}
      }

  ?>
  </table>  
  </div>
<?php } ?>
<!--------------------------------------------------------------------------------------->
<?php if(mysqli_num_rows($result5) > 0 ) {?>

  <h4 class="text-right">أجازات:-</h4>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
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
	   while ($row = mysqli_fetch_assoc($result5)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
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

			echo"<td style='line-height:8px'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$formatStart."</td><td style='line-height:8px;'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  

<?php } ?>
<!-------------------------------------------------------------------------------->
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
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
			break;
		}

		$i++;
		$start_date=date_create($row['start_date']);
		$end_date=date_create($row['end_date']);
		
        if($row['type']){
			//Display the data
			echo "<tr style='line-height:8px;'>";

			echo"<td style='line-height:8px'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$row['destination']."</td><td style='line-height:8px;'>"
					  .date_format($start_date,"Y/m/d ")."</td><td style='line-height:8px;'>"
					  .date_format($end_date,"Y/m/d ")."</td></tr>";
			}
      }

  ?>
  </table>  
  </div>
<?php } ?>
<!----------------------------------------------------------------------------------------------->
<?php if(mysqli_num_rows($result4) > 0 ) {?>

  <h4 class="text-right">غياب:-</h4>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
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
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
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

			echo"<td style='line-height:8px'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$formatStart."</td><td style='line-height:8px;'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  

<?php } ?>
<!----------------------------------------------------------------------------------------------->
<?php if(mysqli_num_rows($result10) > 0 ) {?>

  <h4 class="text-right">سجن حربى:-</h4>
  <table class="table  table-bordered text-center">
      <tr style="background-color: #ccc">
		<th rowspan="2" style="line-height:30px">م</th>
		<td rowspan="2" style="line-height:30px">رتبة</td>
		<td rowspan="2" style="line-height:30px">الإسم</td>
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
	   while ($row = mysqli_fetch_assoc($result10)) {
		$degree = '';
		switch($row['degree']){
			case 1:
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
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

			echo"<td style='line-height:8px'>".$i."</td><td style='line-height:8px;'>"
					  .$degree."</td><td style='line-height:8px;'>"
					  .$row['name']."</td><td style='line-height:8px;'>"
					  .$formatStart."</td><td style='line-height:8px;'>"
					  .$formatEnd."</td></tr>";
			}
      }

  ?>
  </table>  

<?php } ?>
<!-------------------------------------------------------------------------------------------------------------->


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