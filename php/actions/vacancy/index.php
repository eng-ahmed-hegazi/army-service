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
// query & result
$query = "SELECT * FROM vacancy ORDER BY back_date";
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
  <h1>الميدانيات</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table table-striped table-bordered text-center">
      <tr>
		<th >م</th>
		<td>رقم الميدانية</td>
		<td>تاريخ العودة</td>
		<td width="10">تعديل</td>
      </tr>
      <?php
      if( mysqli_num_rows($result) > 0){
	  
		$i=0;
     while ($row = mysqli_fetch_assoc($result)) {
		$i++;
		$date=date_create($row['back_date']);
		
		$vNumber = $row['vacancy_number'];
		switch($vNumber){
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
        //Display the data
			echo "<tr>";
		# `id`, `vacancy_number`, `back_date`, `number_of_soilder`
        echo"<td>".$i."</td><td>"
				  .$vNumber."</td><td>"
                  .date_format($date,"Y/m/d ")."</td><td>";
				  
        echo '<a href="edit.php?id='.$row['id'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px" >تعديل</a></td>';

        echo "</tr>";
	}
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }


  ?>
  <tr>
      <td colspan="4">
          <div class="text-center">
			<a href="add.php" type="button" class="btn btn-sm btn-success">إضافة ميدانية</a>
			<a href="vacancy.php" type="button" class="btn btn-sm btn-default">ذهاب للمخطط</a>
		  </div>
	  </td>
  </tr>
  </table>
</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>