<?php
  session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
if( isset( $_POST["add"])){
	$sarya = $_POST['sarya'];
	  header("Location: punishment.php?month=$sarya");
}
// connect to database
include "../../../includes/controls/db/connection.php";
$query1 = "SELECT * FROM assistant";
$query2 = "SELECT * FROM soldier";
$result1 = mysqli_query( $conn, $query1 );
$result2 = mysqli_query( $conn, $query2 );

$power = mysqli_num_rows($result1)+mysqli_num_rows($result2);
if($_GET['month'] == NULL){
	$query1 = "SELECT assistant.mNumber,assistant.sarya,assistant.degree,assistant.name,assistant.taskeen,
	assistantpunishment.id,assistantpunishment.date,assistantpunishment.crime,assistantpunishment.punishment,assistantpunishment.period,assistantpunishment.officer_id,
	assistantpunishment.crime_content,assistantpunishment.order_number,assistantpunishment.period FROM assistantpunishment  JOIN assistant ON  assistant.id=assistantpunishment.assistant_id ORDER BY assistant.taskeen";
	$result1 = mysqli_query( $conn, $query1 );
	
	$query2 = "SELECT soldier.mNumber,soldier.sarya,soldier.degree,soldier.name,soldier.taskeen,
	soldierpunishment.id,soldierpunishment.date,soldierpunishment.crime,soldierpunishment.punishment,soldierpunishment.period,soldierpunishment.officer_id,
	soldierpunishment.crime_content,soldierpunishment.order_number,soldierpunishment.period FROM soldierpunishment  JOIN soldier ON  soldier.id=soldierpunishment.soldier_id ORDER BY soldier.taskeen";
	$result2 = mysqli_query( $conn, $query2 );

}else{
	$sarya = $_GET['month'];
	$query1 = "SELECT assistant.mNumber,assistant.sarya,assistant.degree,assistant.name,assistant.taskeen,
	assistantpunishment.id,assistantpunishment.date,assistantpunishment.crime,assistantpunishment.punishment,assistantpunishment.period,assistantpunishment.officer_id,
	assistantpunishment.crime_content,assistantpunishment.order_number,assistantpunishment.period FROM assistantpunishment  JOIN assistant ON  assistant.id=assistantpunishment.assistant_id AND month(assistantpunishment.date)='$month' ORDER BY assistant.taskeen";
	$result1 = mysqli_query( $conn, $query1 );
	
	$query2 = "SELECT soldier.mNumber,soldier.sarya,soldier.degree,soldier.name,soldier.taskeen,
	soldierpunishment.id,soldierpunishment.date,soldierpunishment.crime,soldierpunishment.punishment,soldierpunishment.period,soldierpunishment.officer_id,
	soldierpunishment.crime_content,soldierpunishment.order_number,soldierpunishment.period FROM soldierpunishment  JOIN soldier ON  soldier.id=soldierpunishment.soldier_id ORDER BY soldier.taskeen";
	$result2 = mysqli_query( $conn, $query2 );
}

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


include "../../../includes/header/header/header.php";
// print the alert message
?>
<?php if(count($result1)!=0) {?>
<div class="container-fluid">
		<table class="table">
		<tbody>
			  <tr>
				<td><a href="javascript:void(0);" class="btn btn-default" onclick="printPage();return false;"><span class="glyphicon glyphicon-print"></span>   طباعة   </a></td>
				</tr>
			<tbody>	
		</table>
	</div>
	<div class="container">

		<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
			  <div class="form-group">
			  <div class="col-sm-2">
					<button type="submit" class="btn btn-success" name="add">أختيار </button>
				  </div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="sarya" id="sarya">
			      	<option value="">الشهر</option>
			      	<option value="1">يناير</option>
			      	<option value="2">فبراير</option>
			      	<option value="3">مارس</option>
			      	<option value="4">أبريل</option>
			      	<option value="5">مايو</option>
			      	<option value="6">يونيو</option>
			      	<option value="7">يوليو</option>
			      	<option value="8">يونيه</option>
			      	<option value="9">أغسطس</option>
			      	<option value="10">أكتوبر</option>
			      	<option value="11">نوفمبر</option>
			      	<option value="12">ديسمبر</option>
			      </select>  
					</div>
					<label for="sarya" class="col-sm-1 control-label">أختار الشهر</label>
			  </div>	
			   <div class="form-group">        
				  
				</div>
            </form>
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
  	<h3 class="text-center">
	
	 كشف عقوبات 
	 <?php if($_GET['month'] != NULL){?>
	 عن شهر <?php
		$month = $_GET['month'];
		switch($month){
			case 1:
			$month = '<label>يناير</label>';
			break;
			case 2:
			$month = '<label>فبراير</label>';
			break;
			case 3:
			$month = '<label>مارس</label>';
			break;
			case 4:
			$month = '<label>أبريل</label>';
			break;
			case 5:
			$month = '<label>مايو</label>';
			break;
			case 6:
			$month = '<label>يونيو</label>';
			break;
			case 7:
			$month = '<label>يوليو</label>';
			break;
			case 8:
			$month = '<label>يونيه</label>';
			break;
			case 9:
			$month = '<label>أغسطس</label>';
			break;
			case 10:
			$month = '<label>أكتوبر</label>';
			break;
			case 11:
			$month = '<label>نوفمبر</label>';
			break;
			case 12:
			$month = '<label>ديسمبر</label>';
			break;
		}
	 echo $month;
	 }?> </h3>
      <?php 
	  $crime1=0;
	  $crime2=0;
	  $crime3=0;
	  $crime4=0;
	  $totalcrime=0;
	 
	  $punishment1=0;
	  $punishment2=0;
	  $punishment3=0;
	  $punishment4=0;
	  $totalpunishment=0;
	  $persentag=0;

      if( mysqli_num_rows($result1) > 0){
	 
	  
	  ?>
	  <table class="table  table-bordered text-center" style="font-size:12px;font-weight:bold">
      <tr>
		<th>م</th>
		<td width="20">رقم عسكرى</td>
		<td>الدرجة</td>
		<td>الإسم</td>
		<td>الوحدة الفرعية</td>
		<td>تاريخ الجريمة</td>
		<td>الجريمة</td>
		<td width="20">العقوبة</td>
		<td width="20">الآمر بالعقوبة</td>
		<td width="20">رقم بند الآوامر وتاريخه</td>
      </tr>
	  <?php
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result1)) {
		switch($row['crime']){
				case 1:
					$crime1++;
				break;
				case 2:
					$crime2++;
				break;
				case 3:
					$crime3++;
				break;
				case 4:
					$crime4++;
				break;
			}
			switch($row['punishment']){
				case 1:
					$punishment5++;
				break;
				case 2:
					$punishment2++;
				break;
				case 3:
					$punishment3++;
				break;
				case 4:
					$punishment4++;
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
		
		$crime = '';
		switch($row['crime']){
			case 1:
			$crime = '<label> السلوك مادة (166) ق.أ.ع</label> ';
			break;
			case 2:
			$crime = '<label> الإهمال مادة (153) ق.أ.ع</label> ';
			break;
			case 3:
			$crime = '<label> الغياب مادة (153) ق.أ.ع</label> ';
			break;
		}
		
		$punishment = '';
		switch($row['punishment']){
			case 1:
			$punishment = '<label> عزل</label>';
			break;
			case 2:
			$punishment = '<label> حجز</label>';
			break;
			case 3:
			$punishment = '<label> حبس</label>';
			break;
		}
		$taskeen = '';
		switch($row['taskeen']){
			case 1:
			$taskeen = '<label>قيادة الفوج</label>';
			break;
			case 2:
			$taskeen = '<label>الكتيبة الأولى </label>';
			break;
			case 3:
			$taskeen = '<label> الكتيبة الثانية</label>';
			break;
		}
		$i++;
			$Newdegree ='';
			if($row['period']==0 && $row['punishment']==1){
				$Newdegree = $row['degree']-=1;
			  }else{
					  
			}
			
			$Period ='';
			if($row['period']==0){
				$Period = "";
			  }else{
				$Period = $row['period']." أيام ";
			}
			
			switch($Newdegree){
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
		
		$date=date_create($row['date']);
		
			$officer_id=$row['officer_id'];
			$sql = "SELECT * FROM officer WHERE id='$officer_id'";
			$result = mysqli_query( $conn, $sql );
			$officer = mysqli_fetch_assoc($result);
			//Display the data
			$Officerdegree = '';
				switch($officer['degree']){
					case 5:
					$Officerdegree = 'مقدم';
					break;
					case 6:
					$Officerdegree = 'عقيد';
					break;
					case 7:
					$Officerdegree = 'عميد';
					break;

			}
			echo "<tr>";

			echo"<td>".$i."</td><td>"
					  .$row['mNumber']."</td><td>"
					  .$degree."</td><td>"
					  .$row['name']."</td><td>"
					  .$taskeen."</td><td>"
					  .date_format($date,"Y/m/d ")."</td><td>"
					  .$crime.$row['crime_content']."</td><td>"
					  ."تجازى المذكور بـ "
					  .$Period.$punishment.$Newdegree."</td><td>"
					  .$Officerdegree." / ".$officer['name']."</td><td>"
					  .$row['order_number']."<hr style='margin:0;padding:0;height:1px;background: #333;border:0'>".date_format($date,"Y/m/d ")."</td>";
			echo "</tr>";

      }
	  while ($row = mysqli_fetch_assoc($result2)) {
			switch($row['crime']){
				case 1:
					$crime1++;
				break;
				case 2:
					$crime2++;
				break;
				case 3:
					$crime3++;
				break;
				case 4:
					$crime++;
					break;
			}
			switch($row['punishment']){
				case 1:
					$punishment1++;
				break;
				case 2:
					$punishment2++;
				break;
				case 3:
					$punishment3++;
				break;
				case 4:
					$punishment4++;
				break;
			}
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
		
		$crime = '';
		switch($row['crime']){
			case 1:
			$crime = '<label> السلوك </label> ';
			break;
			case 2:
			$crime = '<label> الإهمال</label> ';
			break;
			case 3:
			$crime = '<label> الغياب</label> ';
			break;
		}
		
		$punishment = '';
		switch($row['punishment']){
			case 1:
			$punishment = '<label> عزل </label>';
			break;
			case 2:
			$punishment = '<label> حجز</label>';
			break;
			case 3:
			$punishment = '<label> حبس</label>';
			break;
		}
		$taskeen = '';
		switch($row['taskeen']){
			case 1:
			$taskeen = '<label>قيادة الفوج</label>';
			break;
			case 2:
			$taskeen = '<label>الكتيبة الأولى </label>';
			break;
			case 3:
			$taskeen = '<label> الكتيبة الثانية</label>';
			break;
		}
		$i++;
			$Newdegree ='';
			if($row['period']==0 && $row['punishment']==1){
				$Newdegree = $row['degree']-=1;
			  }else{
					  
			}
			
			$Period ='';
			if($row['period']==0){
				$Period = "";
			  }else{
				$Period = $row['period']." أيام ";
			}
			
			switch($Newdegree){
			case 1:
			$Newdegree = ' لدرجة جندى ';
			break;
			case 2:
			$Newdegree = ' لدرجة عريف مجند ';
			break;
			case 3:
			$Newdegree = ' رقيب مجند ';
			break;
		}
		
		$date=date_create($row['date']);
		
			$officer_id=$row['officer_id'];
			$sql = "SELECT * FROM officer WHERE id='$officer_id'";
			$result = mysqli_query( $conn, $sql );
			$officer = mysqli_fetch_assoc($result);
			//Display the data
			$Officerdegree = '';
				switch($officer['degree']){
					case 5:
					$Officerdegree = 'مقدم';
					break;
					case 6:
					$Officerdegree = 'عقيد';
					break;
					case 7:
					$Officerdegree = 'عميد';
					break;

			}
			echo "<tr>";

			echo"<td>".$i."</td><td>"
					  .$row['mNumber']."</td><td>"
					  .$degree."</td><td>"
					  .$row['name']."</td><td>"
					  .$taskeen."</td><td>"
					  .date_format($date,"Y/m/d ")."</td><td>"
					  .$crime.$row['crime_content']."</td><td>"
					  ."تجازى المذكور بـ "
					  .$Period.$punishment.$Newdegree."</td><td>"
					  .$Officerdegree." / ".$officer['name']."</td><td>"
					  .$row['order_number']."<hr style='margin:0;padding:0;height:1px;background: #333'>".date_format($date,"Y/m/d ")."</td>";

			echo "</tr>";

      }
		$totalcrime = $crime1+$crime2+$crime3+$crime4;
		$totalpunishment = $punishment1 + $punishment2 + $punishment3 + $punishment4;
  ?>
  </table>  
<?php
} else {?>
    <table class="table  table-bordered text-center" style="font-size:12px;font-weight:bold">
	<tr>
		<th>م</th>
		<td>رقم عسكرى</td>
		<td>الدرجة</td>
		<td>الإسم</td>
		<td>الوحدة الفرعية</td>
		<td>تاريخ الجريمة</td>
		<td>الجريمة</td>
		<td>العقوبة</td>
		<td>الآمر بالعقوبة</td>
		<td>رقم بند الآوامر وتاريخه</td>
      </tr>
		<tr class="text-center">
			<td colspan="12" class="text-center">لا يكـــــــــــــــــــــــــــــــــــــــــن</td>
		</tr>
	</table>
	<?php }?>
			<table class="table text-center" style="font-size:12px;font-weight:bold;padding:0;margin:0">
			<tr class="row">
				<td class="col-md-6">
				<table class="table  table-bordered text-center" style="font-size:12px;font-weight:bold">
					<tr>
						<td>القوة</td>
						<td>الساوك</td>
						<td>الإهمال</td>
						<td>الغياب</td>
						<td>الإجمالى</td>
						<td>النسبة</td>
						
					</tr>
					<tr>
						<td><?php echo $power?></td>
						<td><?php echo $crime1?></td>
						<td><?php echo $crime2?></td>
						<td><?php echo $crime3?></td>
						<td><?php echo $totalcrime?></td>
						<td><?php if($power!=0){echo $totalcrime/$power*100;}else{echo 0;}?></td>
					</tr>
				</table>
				</td>
				<td class="col-md-6">
				<table class="table  table-bordered text-center col-md-6" style="font-size:12px;font-weight:bold">
					<tr>
						<td>القوة</td>
						<td>عزل</td>
						<td>حجز</td>
						<td>حبس</td>
						<td>محكمة</td>
						<td>الإجمالى</td>
						<td>النسبة</td>
					</tr>
					<tr>
						<td><?php echo $power;?></td>
						<td><?php echo $punishment1;?></td>
						<td><?php echo $punishment2;?></td>
						<td><?php echo $punishment3;?></td>
						<td><?php echo $punishment4;?></td>
						<td><?php echo $totalpunishment;?></td>
						<td><?php if($power!=0){echo $totalpunishment/$power*100;}else{echo 0;}?></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
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

  <?php } 
  include "../../../includes/footer/foot/foot.php";
?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->