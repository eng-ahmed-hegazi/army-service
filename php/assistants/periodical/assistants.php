<?php
  session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
/*if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
*/
// connect to database
include "../../../includes/controls/db/connection.php";
// query & result assistantperiodical
$query = "SELECT assistantperiodical.id,assistant.crew,assistant.name,assistant.degree,assistantperiodical.date,dayname(assistantperiodical.date) as day  FROM assistantperiodical  JOIN assistant ON  assistant.id=assistant_id ORDER BY assistantperiodical.date";
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
 mysqli_close($conn);
include "../../../includes/header/header/header.php";
// print the alert message
?>
  <h1>نوبتجيات صف ضباط</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table table-striped table-bordered text-center">
      <tr>
		<th >م</th>
		<td>درجة</td>
		<td>الأسم</td>
		<td>طقم النوبتجية</td>
		<td>تاريخ النوبتجية</td>
		<td>اليوم</td>
		<td width="10">تعديل</td>
      </tr>
      <?php
      if( mysqli_num_rows($result) > 0){
	  
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result)) {
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
		$crew = '';
		switch($row['crew']){
			case 0:
			$crew = '<label>لا يوجد </label>';
			break;
			case 1:
			$crew = '<label>مساعد ض نوبتجى </label>';
			break;
			case 2:
			$crew = '<label>حكمدار سلاح وذخيرة</label>';
			break;
			case 3:
			$crew = '<label>حكمدار بوابة وسجن</label>';
			break;
			case 4:
			$crew = '<label>حكمدار خفيف حركة</label>';
			break;
		}
		$i++;
		$date=date_create($row['date']);
		
        //Display the data
			echo "<tr>";

        echo"<td>".$i."</td><td>"
				  .$degree."</td><td>"
				  .$row['name']."</td><td>"
				  .$crew."</td><td>"
                  .date_format($date,"Y/m/d ")."</td><td>"
                  .$dayname."</td><td>";
        echo '<a href="edit.php?id='.$row['id'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px" >تعديل</a></td>';

        echo "</tr>";
      }
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }


  ?>
  <tr>
      <td colspan="8">
          <div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success">إضافة صف ضابط </a></div></td>
  </tr>
  </table>
</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>