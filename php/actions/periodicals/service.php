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
	
	$query1 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=5 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
	
	$result1 = mysqli_query( $conn, $query1 );
	
	
	$query2 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=2 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
	$result2 = mysqli_query( $conn, $query2 );
	if($result2 = mysqli_query( $conn, $query2 ))
	$row2 = mysqli_fetch_assoc($result2);
	
	$query3 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=1 WHERE officerperiodical.date >= '$today' ORDER BY officerperiodical.date LIMIT 3 ";
	$result3 = mysqli_query( $conn, $query3 );
	if($result3 = mysqli_query( $conn, $query3 ))
	$row3 = mysqli_fetch_assoc($result3);
	
	$query4 = "SELECT  assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=1 WHERE assistantperiodical.date >= '$today' ORDER BY assistantperiodical.date LIMIT 3 ";
	$result4 = mysqli_query( $conn, $query4 );
	if($result4 = mysqli_query( $conn, $query1 ))
	$row4 = mysqli_fetch_assoc($result4);
	
	$query5 = "SELECT  assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=2 WHERE assistantperiodical.date >= '$today' ORDER BY assistantperiodical.date LIMIT 3 ";
	$result5 = mysqli_query( $conn, $query5 );
	if($result5 = mysqli_query( $conn, $query5 ))
	$row5 = mysqli_fetch_assoc($result5);
	
	$query6 = "SELECT  assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id AND assistant.crew=3 WHERE assistantperiodical.date >= '$today' ORDER BY assistantperiodical.date LIMIT 3 ";
	$result6 = mysqli_query( $conn, $query6 );
	if($result6 = mysqli_query( $conn, $query6 ))
	$row6 = mysqli_fetch_assoc($result6);
	

	

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
  <div class="row" style="padding:25px;">
  
  <div class="col-md-12">
				<table class="table table-bordered text-right" style="border:2px solid #000;margin-top:25px">
				  <tr style='border:2px solid #000;'>
					<td width="450" style='border:2px solid #000;line-height:23px'>
			
						قائد مـــنوب : <?php
						if($result1 = mysqli_query( $conn, $query1 )){
							$degree = '';
							switch($row1['degree']){
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
							
							echo $degree;
						}
					    ?>  /   <?php echo $row1['name'];?>
						<br>
						ض عظـــيم  :
						<?php
						$degree = '';
						switch($row2['degree']){
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
						echo $degree
					    ?>  /   <?php echo $row2['name']?>
						<br>
						ض نوبتجى   :
						<?php
						$degree = '';
						switch($row3['degree']){
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
						echo $degree
					    ?>  /   <?php echo $row3['name']?><br>
						بيان خدمة الفوج عن يوم 
						
						<?php 
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
							?>
						<br>
					</td>
					<td width="450" style='border:2px solid #000;line-height:28px '>
						مساعد ض ن :
						<?php
						$degree = '';
						switch($row4['degree']){
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
						echo $degree
					    ?>  /   <?php echo $row4['name']?>
						<br>
						رقيب نوبتجى    /<br>
						كلمة سر الليل  /<br>
						بتاريخ  :  <?php $dd=strtotime("today");
						$today1 = date("d / m / Y", $dd);
						
						echo $today1;
						?><br>
					</td>
				  </tr>
				  </table>
				<table class="table table-bordered text-center" style="border:2px solid #000 ">
				  <tr style='border:2px solid #000 '>
					<td>البيان</td>
					<td width="450" style='border:2px solid #000;'>الغفرة الأولى</td>
					<td width="450" style='border:2px solid #000 '>الغفرة الثانية</td>
					<td width="450" style='border:2px solid #000 '>الغفرة الثالثة</td>
					<td width="100" style='border:2px solid #000 ' style='border:2px solid #000 '>الحكمدار</td>
				  </tr>
				<tr class="text-center">
					<td rowspan="2" width="100" style='border:2px solid #000;line-height:64px'>البوابــــــة</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td rowspan="3" width="100" style='border:2px solid #000;border:2px solid #000;padding:25px 10px' >
					<?php
						$degree = '';
						switch($row6['degree']){
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
						echo $degree
					    ?>  /   <?php echo $row6['name']?>
					</td>
				</tr>
				<tr class="text-center">
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>السجـــــــن</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td rowspan="2" width="100" style='border:2px solid #000 ;line-height:64px'>السلاح</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td rowspan="5" width="100" style='border:2px solid #000;border:2px solid #000;padding:55px 10px' >
					<?php
						$degree = '';
						switch($row5['degree']){
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
						echo $degree
					    ?>  /   <?php echo $row5['name']?>
					</td>
				</tr>
				<tr class="text-center">
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td rowspan="2" width="100" style='border:2px solid #000 ;line-height:64px'>الذخيرة</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>الوقود</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>برج قيادة</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td rowspan="2" width="100" style='border:2px solid #000 ' style='border:2px solid #000 '>
					<label>رقيب م</label>/ محمد حمادة عبد الشافى
					</td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>برج ك2</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>طلبة ميس</td>
					<td width="450" style='border:2px solid #000;padding:22px 0'></td>
					<td width="450" style='border:2px solid #000 '></td>
					<td colspan="2" width="450" style='border:2px solid #000 '></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>تأمين فنى</td>
					<td colspan="4" width="450" style='border:2px solid #000;padding:22px 0'></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>بوليس عنبر</td>
					<td colspan="4" width="450" style='border:2px solid #000;padding:22px 0'></td>
				</tr>
				<tr class="text-center">
					<td width="100" style='border:2px solid #000 '>أمن ليلى</td>
					<td colspan="4" width="450" style='border:2px solid #000;padding:22px 0'></td>
				</tr>

			  </table>
			
	
	</div>
	</div>
	<div class="row">
			<div style="font-weight:bold;line-height:18px" class="col-lg-6 pull-left text-left">
			التوقيع "<span style="padding:0 70px">  </span>"<br>

			<?php 
			$query = "SELECT * FROM officer WHERE job=22 LIMIT 1";
			$result = mysqli_query( $conn, $query);
			if(mysqli_num_rows($result)>0){
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
					</div>
				<?php
				}else{
				?>
					 <?php echo $degree." أح / ".$row['name']?><br>
				قائد الفوج 715 حرب إلك بالإنابة
					</div>
					
				<?php
				break;
				}
			 }
			 }else{
				echo"</div>";
			 }
			?>
			<div style="font-weight:bold;line-height:18px" class="col-lg-6 pull-right">
			التوقيع "<span style="padding:0 70px">  </span>"<br>

			<?php 
			$query = "SELECT * FROM officer WHERE job=22 LIMIT 1";
			$result = mysqli_query( $conn, $query);
			if(mysqli_num_rows($result)>0){
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
					</div>
				<?php
				}else{
				?>
					 <?php echo $degree." أح / ".$row['name']?><br>
				قائد الفوج 715 حرب إلك بالإنابة
					</div>
					
				<?php
				break;
				}
			 }
			 }else{
				echo "</div>";
			 }
			?>
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
