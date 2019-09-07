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
  
	$d=strtotime("today");
	$today = date("Y-m-d", $d);
	
	$sql = "SELECT * FROM soldier";
	$result = mysqli_query($conn,$sql);
	$row1 = mysqli_num_rows($result);
	
	$sql = "SELECT * FROM assistant";
	$result = mysqli_query($conn,$sql);
	$row2 = mysqli_num_rows($result);
	
	$sql = "SELECT * FROM soldier WHERE availability=0";
	$result = mysqli_query($conn,$sql);
	$row3 = mysqli_num_rows($result);
	
	$sql = "SELECT * FROM assistant WHERE availability=0";
	$result = mysqli_query($conn,$sql);
	$row4 = mysqli_num_rows($result);
	
	$sql = "SELECT * FROM soldier WHERE availability=1";
	$result = mysqli_query($conn,$sql);
	$row5 = mysqli_num_rows($result);
	
	$sql = "SELECT * FROM assistant WHERE availability=1";
	$result = mysqli_query($conn,$sql);
	$row6 = mysqli_num_rows($result);
	
	$power = $row1+$row2;
	$exist = $row3+$row4;
	$out = $row5+$row6;

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
	
	//mysqli_close($conn);
	include "../../../includes/header/header/header.php";
?>

  <?php echo $alertMessage; ?>
  <style>
	table tr{
		padding:0;
	}
	
  </style>
  
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
  <div class="row text-center">
  <span>
	  يومية تمام طابور الصباح عن يوم  
	<?php
	$d=strtotime("today");
	$today = date("Y-m-d", $d);
  
    $d=strtotime("today");
	$dayname = date("l", $d);	
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
	?></span>
	  <div class="col-md-12">
	  
		<table class="table table-bar table-bordered table-border" style="border:2px solid #000;">
		  <tr style='' class="text-center">
			<td rowspan="2" >البيان</td>
			<td rowspan="2" class="x-size">القوة</td>
			<td rowspan="2" class="x-size">خارج الفوج</td>
			<td rowspan="2" class="x-size">داخل الفوج</td>
			<td rowspan="2" class="x-size">موجود</td>
			<td rowspan="2" class="x-size">خارج</td>
			<td colspan="14" class="x-size">تمام الخوارج</td>
		</tr>
		<tr class="text-center">
			<td class="x-size">خدمة</td>
			
			<td class="x-size">عيادة</td>
			<td class="x-size">مطبخ</td>
			<td class="x-size">أمن</td>
			<td class="x-size">عمل</td>
			<td class="x-size">كانتين</td>
			<td class="x-size">بوليس</td>
			<td class="x-size">مأ</td>
			<td class="x-size">خط</td>
			<td class="x-size">منوب</td>
			<td class="x-size">غياب</td>
			<td class="x-size">مرضى</td>
			<td class="x-size">سجن</td>
			<td class="x-size">تخلف</td>
		</tr>
		<?php 
		$sarya = 1;
		while($sarya<12){
		
			
		?>
		<tr>
			<td>
			<?php 
			switch($sarya){
			case 1:
			$print = '<span>أفراد</span>';
			break;
			case 2:
			$print = '<span>تدريب</span>';
			break;
			case 3:
			$print = '<span>منوب</span>';
			break;
			case 4:
			$print = '<span>ع سلبى</span>';
			break;
			case 5:
			$print = '<span>إشارة</span>';
			break;
			case 6:
			$print = '<span>ش.ف</span>';
			break;
			case 7:
			$print = '<span>ش.أ</span>';
			break;
			case 8:
			$print = '<span>حملة</span>';
			break;	
			case 9:
			$print = '<span>ك1</span>';
			break;	
			case 10:
			$print = '<span>ك2</span>';
			break;	
			case 11:
			$print = '<span>مستجد</span>';
			break;	
			
			
		}
			echo $print
			?></td>
			<?php
			if($sarya<9){
				
				$sql = "SELECT * FROM soldier WHERE sarya=$sarya AND punit=1";
				$result1 = mysqli_query($conn,$sql);
				$row1 = mysqli_num_rows($result1);
				
				$sql = "SELECT * FROM soldier WHERE sarya=$sarya AND punit=1 AND availability=1";
				$result1 = mysqli_query($conn,$sql);
				$row3 = mysqli_num_rows($result1);
				
				$sql = "SELECT * FROM soldier WHERE  sarya=$sarya AND punit=1 AND availability=0";
				$result1 = mysqli_query($conn,$sql);
				$row5 = mysqli_num_rows($result1);
				
				$sql = "SELECT * FROM assistant WHERE sarya=$sarya AND punit=1";
				$result2 = mysqli_query($conn,$sql);
				$row2 = mysqli_num_rows($result2);
				
				$sql = "SELECT * FROM assistant WHERE sarya=$sarya AND punit=1 AND availability=1";
				$result2 = mysqli_query($conn,$sql);
				$row4 = mysqli_num_rows($result2);
				
				$sql = "SELECT * FROM assistant WHERE sarya=$sarya AND punit=1 AND availability=0";
				$result2 = mysqli_query($conn,$sql);
				$row6 = mysqli_num_rows($result2);
				
				$powers=$row1+$row2;
				$exists=$row3+$row4;
				$outs=$row5+$row6;
				echo"<td>".$powers."</td>
					<td>".$outs."</td>
					<td>".$exists."</td>";
			}else{
			
				$index=$sarya-7;
				$sql = "SELECT * FROM soldier WHERE punit=$index";
				$result1 = mysqli_query($conn,$sql);
				$row1 = mysqli_num_rows($result1);
				
				$sql = "SELECT * FROM soldier WHERE punit=$index AND availability=1";
				$result1 = mysqli_query($conn,$sql);
				$row3 = mysqli_num_rows($result1);
				
				$sql = "SELECT * FROM soldier WHERE punit=$index AND availability=0";
				$result1 = mysqli_query($conn,$sql);
				$row5 = mysqli_num_rows($result1);
				
				$sql = "SELECT * FROM assistant WHERE punit=$index";
				$result2 = mysqli_query($conn,$sql);
				$row2 = mysqli_num_rows($result2);
				
				$sql = "SELECT * FROM assistant WHERE punit=$index AND availability=1";
				$result2 = mysqli_query($conn,$sql);
				$row4 = mysqli_num_rows($result2);
				
				$sql = "SELECT * FROM assistant WHERE punit=$index AND availability=0";
				$result2 = mysqli_query($conn,$sql);
				$row6 = mysqli_num_rows($result2);
				
				$powers=$row1+$row2;
				$exists=$row3+$row4;
				$outs=$row5+$row6;
				echo"<td>".$powers."</td>
					<td>".$outs."</td>
					<td>".$exists."</td>";
			}
			$sarya++;
			?>
			
			<?php 
			$i=0;
			while($i<16){
				$i++;
				echo "<td class='x-size'></td>";
			}
			
		}
		?>
		</tr>
		<tr>
		<td>الإجمالى</td>
		<td><?php echo $power?></td>
		<td><?php echo $exist?></td>
		<td><?php echo $out?></td>
		<?php 
			$i=0;
			while($i<16){
				$i++;
				echo "<td class='x-size'></td>";
			}
			?>
		</tr>
		</table>
		
		
	  </div>
	  </div>
	  <div class="row">
	   <div class="col-md-3 pull-right" style="margin:0;padding:2px;padding-right:12px">
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >الخدمة</td>
			</tr>
			<tr>
				<td rowspan="2" width=60 >بوابة</td>
				<td ></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td rowspan="2" width=60>سلاح</td>
				<td ></td>
			</tr>
			<tr>
				<td ></td>
			</tr>
			<tr>
				<td rowspan="2" width=60>ذخيرة</td>
				<td ></td>	
			</tr>
			<tr>
				<td ></td>
			</tr>
			<tr>
				<td width=60 style="padding:0">برج ق</td>
				<td ></td>
			</tr>
			<tr>
				<td width=60 style="padding:0">برج ك2</td>
				<td ></td>
			</tr>
			<tr>
				<td width=60 style="padding:0">خفيف</td>
				<td td style='width:160px'></td>
			</tr>
			<tr>
				<td width=60 style="padding:0">دروة</td>
				<td ></td>
			</tr>
			<tr style="max-height:10px;margin:0;padding:0">
				<td width=60 style="padding:0">حكمدار</td>
				<td ></td>
			</tr>
			<tr>
				<td width=60 style="padding:0">سجن</td>
				<td ></td>	
			</tr>
		
		</table>
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >مأمورية</td>
			</tr>
			<?php
			$i=0;
			while($i<15){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
	  
	</div>
	<div class="col-md-3 pull-right" style="margin:0;padding:2px">
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >مطبخ</td>
			</tr>
			<?php
			
			$i=0;
			while($i<3){
				echo "<tr><td style='width:160px;'></td></tr>";
				$i++;
			}
			?>

		
		</table>
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >مندوب /كانتين</td>
			</tr>
			<?php
			$sql = "SELECT soldier.name,soldier.sarya,soldier.punit,soldier.id,soldiersjobs.type,soldiersjobs.soldier_id FROM soldier JOIN soldiersjobs WHERE soldier.id=soldier_id AND type=4 AND soldier.availability=1";
			$result = mysqli_query($conn,$sql);
			$sarya = '';
		
			$i=0;
			while($row = mysqli_fetch_assoc($result)){
		if($row['punit']==1){
			$sarya = $row['sarya'];
			switch($sarya){
				case 1:
				$sarya = 'أفراد';
				break;
				case 2:
				$sarya = 'تدريب';
				break;
				case 3:
				$sarya = 'عمليات';
				break;
				case 4:
				$sarya = 'عق سلبى';
				break;
				case 5:
				$sarya = 'إشارة';
				break;
				case 6:
				$sarya = 'ش.ف';
				break;
				case 7:
				$sarya = 'ش.أ ';
				break;
				case 8:
				$sarya = 'حملة';
				break;	
			}
		}else{
			$sarya = $row['punit'];
		
			switch($sarya){
				case 1:
				$sarya = 'ق';
				break;
				case 2:
				$sarya = 'ك1';
				break;
				case 3:
				$sarya = 'ك2';
				break;
			}
			
		}
				echo "<tr class='data'><td style='padding:0;width:75%'>".$row['name']."</td><td style='padding:0;'>".$sarya."</td></tr>";
				$i++;
			}
			while($i<4){
				echo "<tr><td></td><td></td></tr>";
				$i++;
			}
			?>

		
		</table>
	  <table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >منوب</td>
			</tr>
			<?php
			$sql = "SELECT soldier.name,soldier.sarya,soldier.punit,soldier.id,soldiersjobs.type,soldiersjobs.soldier_id FROM soldier JOIN soldiersjobs WHERE soldier.id=soldier_id AND type=5 AND soldier.availability=1";
			$result = mysqli_query($conn,$sql);
			$sarya = '';
		
			$i=0;
			while($row = mysqli_fetch_assoc($result)){
		if($row['punit']==1){
			$sarya = $row['sarya'];
			switch($sarya){
				case 1:
				$sarya = 'أفراد';
				break;
				case 2:
				$sarya = 'تدريب';
				break;
				case 3:
				$sarya = 'عمليات';
				break;
				case 4:
				$sarya = 'عق سلبى';
				break;
				case 5:
				$sarya = 'إشارة';
				break;
				case 6:
				$sarya = 'ش.ف';
				break;
				case 7:
				$sarya = 'ش.أ ';
				break;
				case 8:
				$sarya = 'حملة';
				break;	
			}
		}else{
			$sarya = $row['punit'];
		
			switch($sarya){
				case 1:
				$sarya = 'ق';
				break;
				case 2:
				$sarya = 'ك1';
				break;
				case 3:
				$sarya = 'ك2';
				break;
			}
			
		}
				echo "<tr class='data'><td style='padding:0'>".$row['name']."</td><td style='padding:0'>".$sarya."</td></tr>";
				$i++;
			}
			while($i<2){
				echo "<tr><td></td><td></td></tr>";
				$i++;
			}
			?>

		
		</table>
		 <table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >عمل</td>
			</tr>
			<?php
			$i=0;
			while($i<12){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
	  
	</div>
	<div class="col-md-3 pull-right" style="margin:0;padding:2px">
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >أمن</td>
			</tr>
			<?php
			$i=0;
			while($i<3){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
	  <table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >بوليس</td>
			</tr>
			<?php
			$sql = "SELECT soldier.name,soldier.sarya,soldier.punit,soldier.id,soldiersjobs.type,soldiersjobs.soldier_id FROM soldier JOIN soldiersjobs WHERE soldier.id=soldier_id AND type=1 AND soldier.availability=1";
			$result = mysqli_query($conn,$sql);
			$sarya = '';
		
			$i=0;
			while($row = mysqli_fetch_assoc($result)){
		if($row['punit']==1){
			$sarya = $row['sarya'];
			switch($sarya){
				case 1:
				$sarya = 'أفراد';
				break;
				case 2:
				$sarya = 'تدريب';
				break;
				case 3:
				$sarya = 'عمليات';
				break;
				case 4:
				$sarya = 'عق سلبى';
				break;
				case 5:
				$sarya = 'إشارة';
				break;
				case 6:
				$sarya = 'ش.ف';
				break;
				case 7:
				$sarya = 'ش.أ ';
				break;
				case 8:
				$sarya = 'حملة';
				break;	
			}
		}else{
			$sarya = $row['punit'];
		
			switch($sarya){
				case 1:
				$sarya = 'ق';
				break;
				case 2:
				$sarya = 'ك1';
				break;
				case 3:
				$sarya = 'ك2';
				break;
			}
			
		}
				echo "<tr class='data'><td style='padding:0'>".$row['name']."</td><td style='padding:0'>".$sarya."</td></tr>";
				$i++;
			}
			while($i<9){
				echo "<tr><td></td><td></td></tr>";
				$i++;
			}
			?>

		
		</table>
		<table class="table table-bordered table-border text-center" style="margin-bottom"10px">
			<tr>
				<td colspan="2" >خط</td>
			</tr>
			<?php
			$sql = "SELECT soldier.name,soldier.sarya,soldier.punit,soldier.id,soldiersjobs.type,soldiersjobs.soldier_id FROM soldier JOIN soldiersjobs WHERE soldier.id=soldier_id AND type=2 AND soldier.availability=1";
			$result = mysqli_query($conn,$sql);
			$punit = '';
		
			$i=0;
			while($row = mysqli_fetch_assoc($result)){
			$sarya = '';
			switch($row['sarya']){
				case 1:
				$sarya = 'أفراد';
				break;
				case 2:
				$sarya = 'تدريب';
				break;
				case 3:
				$sarya = 'عمليات';
				break;
				case 4:
				$sarya = 'عق سلبى';
				break;
				case 5:
				$sarya = 'إشارة';
				break;
				case 6:
				$sarya = 'ش.ف';
				break;
				case 7:
				$sarya = 'ش.أ';
				break;
				case 8:
				$sarya = 'حملة';
				break;
				case 9:
				$sarya = 'منوب';
				break;
				case 10:
				$sarya = 'ك1';
				break;	
				case 11:
				$sarya = 'ك2';
				break;				
			}	
				echo "<tr class='data'><td style='padding:0'>".$row['name']."</td><td style='padding:0'>".$sarya."</td></tr>";
				$i++;
			}
			while($i<4){
				echo "<tr><td></td><td></td></tr>";
				$i++;
			}
			?>

		
		</table>
		<table class="table table-bordered table-border text-center">
			<tr>
				<td colspan="2" >سجن</td>
			</tr>
			<?php
			$i=0;
			while($i<6){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
	</div>
	<div class="col-md-3 pull-right" style="margin:0;padding:2px;padding-left:2px;width:21%">
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >غياب</td>
			</tr>
			<?php
			$i=0;
			while($i<3){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
	  
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >مرضى</td>
			</tr>
			<?php
			$i=0;
			while($i<3){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >عيادة</td>
			</tr>
			<?php
			$i=0;
			while($i<3){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
		<table class="table table-bordered table-border text-center" style="margin-bottom:17px">
			<tr>
				<td colspan="2" >محاضرة</td>
			</tr>
			<?php
			$i=0;
			while($i<3){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
		<table class="table table-bordered table-border text-center" >
			<tr>
				<td colspan="2" >تخلف</td>
			</tr>
			<?php
			$i=0;
			while($i<6){
				echo "<tr><td style='width:160px'></td></tr>";
				$i++;
			}
			?>

		
		</table>
	</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bar table-bordered table-border" style="border:2px solid #000;">
				<tr style='' class="text-center">
					<td>ألقوة</td>
					<td>موجود</td>
					<td>خارج</td>
					<td>خدمة</td>
					<td>خدمة جهاز</td>
					<td>مطبخ</td>
					<td>أمن</td>
					<td>عمل</td>
					<td>كانتيبن</td>
					<td>بوليس</td>
					<td>مأمورية</td>
					<td>خط</td>
					<td>سجن</td>
					<td>منوب</td>
					<td>غياب</td>
					<td>عيادة</td>
					<td>تخلف</td>
				</tr>
				<tr>
					<?php
						$i=0;
						while($i<17){
							echo "<td style='padding:10px 0'></td>";
							$i++;
						}
						
					?>
				</tr>
		</div>
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
