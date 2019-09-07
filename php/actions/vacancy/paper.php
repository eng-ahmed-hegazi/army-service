<?php
  session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
/*if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
*/
$vacancyID = $_GET['id'];
// connect to database
include "../../../includes/controls/db/connection.php";
// query & result
$query = "SELECT soldier.id as soilderID,soldier.name,soldier.punit,soldier.sarya,soldier.degree,vacancy.back_date FROM  soldier INNER JOIN vacancy WHERE soldier.vacancy_id = $vacancyID AND vacancy.vacancy_number = $vacancyID ORDER BY soldier.punit ";
$result = mysqli_query( $conn, $query );


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

 // close the connection
// mysqli_close($conn);
include "../../../includes/header/header/header.php";

$vNumber="";
		switch($vacancyID){
			case 1:
				$vNumber = 'الأولى';
			break;
			case 2:
				$vNumber = 'الثانية';
			break;
			case 3:
				$vNumber = 'الثالثة';
			break;
			case 4:
				$vNumber = 'الرابعة';
			break;
			case 5:
				$vNumber = 'الخامسة';
			break;
			case 6:
				$vNumber = 'السادسة';
			break;
			case 7:
				$vNumber = 'السابعة';
			break;
		}
		echo  " <h1>الميدانية".$vNumber."</h1>";
?>
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
  <table class="table table-bordered text-center">
      <tr>
		<th rowspan="2">م</th>
		<td rowspan="2">درجة</td>
		<td rowspan="2">الإسم</td>
		<td rowspan="2">وحدة فرعية</td>
		<td rowspan="2">أخر عودة</td>
		<td colspan="2">المدة</td>
		<td rowspan="2">ملاحظات</td>
      </tr>
	  <tr>
		<td>من</td>
		<td>إلى</td>
	  </tr>
      <?php
	  
      if( mysqli_num_rows($result) > 0){
	  
	   
		$i=0;
     while ($row = mysqli_fetch_assoc($result)) {
	    
		$i++;
		$date=date_create($row['back_date']);
		$punit="";
		if($row['punit']==1){
			$punit = $row['sarya'];
			switch($punit){
				case 1:
				$punit = '<label> أفراد </label>';
				break;
				case 2:
				$punit = '<label> تدريب </label>';
				break;
				case 3:
				$punit = '<label> عمليات </label>';
				break;
				case 4:
				$punit = '<label> عق سلبى </label>';
				break;
				case 5:
				$punit = '<label> إشارة </label>';
				break;
				case 6:
				$punit = '<label> ش.ف </label>';
				break;
				case 7:
				$punit = '<label> ش.أ </label>';
				break;
				case 8:
				$punit = '<label> حملة </label>';
				break;	
			}
		}else{
		$punit = $row['punit'];
		
			switch($punit){
				case 1:
				$punit = '<label>قيادة الفوج</label>';
				break;
				case 2:
				$punit = '<label>الكتيبة الأولى </label>';
				break;
				case 3:
				$punit = '<label> الكتيبة الثانية</label>';
				break;
				case 4:
				$punit = '<label> مستجد</label>';
				break;
			}
			
		}
		$name = $row['name'];
		$backdate = $row['back_date'];
		
		$soilderID = $row['soilderID'];
		$query3 = "SELECT * FROM soldierpunishment WHERE soldier_id=$soilderID LIMIT 1";
		$result1 = mysqli_query( $conn, $query3 );
		
		$punishment = '-';
		$peroid='';
		if( mysqli_num_rows($result1) > 0){
			while ($row = mysqli_fetch_assoc($result1)) {
				
				switch($row['punishment']){
					case 1:
					$punishment = ' عزل ';
					break;
					case 2:
					$punishment = ' حجز ';
					break;
					case 3:
					$punishment = ' حبس ';
					break;
				}
				$degree='';
				$peroid = $row['period'];
				$Newdate = '';
				if($peroid==0){
					$peroid = '';
					$query4 = "SELECT * FROM soldier WHERE id=$soilderID LIMIT 1";
					$result2 = mysqli_query( $conn, $query4 );
					$row1 = mysqli_fetch_assoc($result2);
					switch($row1['degree']){
						case 1:
						$degree = 'لدرجة جندى';
						break;
						case 2:
						$degree = 'لدرجة عريف م ';
						break;
					}
				}
			}
		}
		
        //Display the data
			echo "<tr>";
		# `id`, `vacancy_number`, `back_date`, `number_of_soilder`
        echo"<td style='line-height:10px'>".$i."</td><td style='line-height:10px'>"
				  ."جندى</td><td style='line-height:10px'>"
				  .$name."</td><td style='line-height:10px'>"
				  .$punit."</td><td style='line-height:10px'>"
				  .$backdate."</td><td></td><td></td><td  style='line-height:10px'>"."<label  style='line-height:10px'>".$peroid."</label style='line-height:10px'> ".$punishment.$degree."</td>";
        echo "</tr>";
		
	}
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }


  ?>
  
  </table>
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
  myWindow.document.write("<html><head>"+head+"<style>body{padding:5px;font-family:Cairo}@media print {.printbtn {display:none;}}</style></head><body onload='window.print()'><div class='container'><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-print'></span>   طباعة   </button><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-download'></span>   تحميل   </button></div><br><h3 class='text-center'>مسير أجازات</h3>"+content);
}
</script>

<?php
  include "../../../includes/footer/footer/footer.php";
?>