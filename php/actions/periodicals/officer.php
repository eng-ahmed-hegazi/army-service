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
  
	$query1 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=1 ORDER BY officerperiodical.date";
	$result1 = mysqli_query( $conn, $query1 );


	$query2 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=2 ORDER BY officerperiodical.date";
	$result2 = mysqli_query( $conn, $query2 );


	$query3 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=3 ORDER BY officerperiodical.date";
	$result3 = mysqli_query( $conn, $query3 );


	$query4 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=4 ORDER BY officerperiodical.date";
	$result4 = mysqli_query( $conn, $query4 );


	$query5 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=5 ORDER BY officerperiodical.date";
	$result5 = mysqli_query( $conn, $query5 );

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

  
  <div class="container">
  <div class="row">
	<?php echo $alertMessage; ?>
   <h1>نوبتجيات ضباط</h1>
   	<ul class="nav nav-tabs nav-justified">
	  <li><a class="list-group-item" data-toggle="tab" href="#periodical1">ضابط نوبتجى وحريق</a></li>
	  <li><a class="list-group-item" data-toggle="tab" href="#periodical2">ضابط عظيم وخفيف حركة</a></li>
	  <li><a class="list-group-item" data-toggle="tab" href="#periodical3">محطة الجبل الأحمر العسكرية</a></li>
	  <li><a class="list-group-item" data-toggle="tab" href="#periodical4">ضابط منوب </a></li>
	  <li><a class="list-group-item" data-toggle="tab" href="#periodical5">قائد منوب</a></li>
  <div>
		<div class="tab-content">
		  <div id="periodical1" class="tab-pane fade in active">
			  <h1>ضابط نوبتجى وحريق</h1>
				<table class="table table-striped table-bordered text-center">
				  <tr>
					<th >م</th>
					<td>رتبة</td>
					<td>الإسم</td>
					<td>تاريخ النوبتجية</td>
					<td>اليوم</td>
				  </tr>
				  <?php
				  if( mysqli_num_rows($result1) > 0){
				  
					$i=0;
				  // we have data
				  // output the data
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
						echo "<tr>";

					echo"<td>".$i."</td><td>"
							  .$degree."</td><td>"
							  .$row['name']."</td><td>"
							  .date_format($date,"Y/m/d ")."</td><td>"
							  .$dayname."</td></tr>";
				  }
			  } else {
				// if no entires
				echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
			  }
			  ?>
			  </table>
		  </div>
		  <div id="periodical2" class="tab-pane fade">
			<h1>ضابط عظيم وخفيف حركة</h1>
			<table class="table table-striped table-bordered text-center">
				  <tr>
					<th >م</th>
					<td>رتبة</td>
					<td>الإسم</td>
					<td>تاريخ النوبتجية</td>
					<td>اليوم</td>
				  </tr>
				  <?php
				  if( mysqli_num_rows($result2) > 0){
				  
					$i=0;
				  // we have data
				  // output the data
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
						echo "<tr>";

					echo"<td>".$i."</td><td>"
							  .$degree."</td><td>"
							  .$row['name']."</td><td>"
							  .date_format($date,"Y/m/d ")."</td><td>"
							  .$dayname."</td></tr>";
				  }
			  } else {
				// if no entires
				echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
			  }
			  ?>
			  </table>
		  </div>
		  <div id="periodical3" class="tab-pane fade">
			  <h1>محطة الجبل الأحمر العسكرية</h1>
			  <table class="table table-striped table-bordered text-center">
				  <tr>
					<th >م</th>
					<td>رتبة</td>
					<td>الإسم</td>
					<td>تاريخ النوبتجية</td>
					<td>اليوم</td>
				  </tr>
				  <?php
				  if( mysqli_num_rows($result3) > 0){
				  
					$i=0;
				  // we have data
				  // output the data
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
						echo "<tr>";

					echo"<td>".$i."</td><td>"
							  .$degree."</td><td>"
							  .$row['name']."</td><td>"
							  .date_format($date,"Y/m/d ")."</td><td>"
							  .$dayname."</td></tr>";
				  }
			  } else {
				// if no entires
				echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
			  }
			  ?>
			  </table>
		  </div>
		  <div id="periodical4" class="tab-pane fade">
			  <h1>ضابط منوب</h1>
			  <table class="table table-striped table-bordered text-center">
				  <tr>
					<th >م</th>
					<td>رتبة</td>
					<td>الإسم</td>
					<td>تاريخ النوبتجية</td>
					<td>اليوم</td>
				  </tr>
				  <?php
				  if( mysqli_num_rows($result4) > 0){
				  
					$i=0;
				  // we have data
				  // output the data
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
						echo "<tr>";

					echo"<td>".$i."</td><td>"
							  .$degree."</td><td>"
							  .$row['name']."</td><td>"
							  .date_format($date,"Y/m/d ")."</td><td>"
							  .$dayname."</td></tr>";
				  }
			  } else {
				// if no entires
				echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
			  }
			  ?>
			  </table>
		  </div>
		  <div id="periodical5" class="tab-pane fade">
			  <h1>قائد منوب</h1>
			  <table class="table table-striped table-bordered text-center">
				  <tr>
					<th >م</th>
					<td>رتبة</td>
					<td>الإسم</td>
					<td>تاريخ النوبتجية</td>
					<td>اليوم</td>
				  </tr>
				  <?php
				  if( mysqli_num_rows($result5) > 0){
				  
					$i=0;
				  // we have data
				  // output the data
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
						echo "<tr>";

					echo"<td>".$i."</td><td>"
							  .$degree."</td><td>"
							  .$row['name']."</td><td>"
							  .date_format($date,"Y/m/d ")."</td><td>"
							  .$dayname."</td></tr>";
				  }
			  } else {
				// if no entires
				echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
			  }
			  ?>
			  </table>
		  </div>
		</div>
	</div>
	</div>
	<div class="clearfix visible-lg"></div>
	</div>
</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>