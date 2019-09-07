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
// query & مأموريات
$query1 = "SELECT soldiersjobs.id,soldier.sarya,soldier.name,soldier.degree,soldiersjobs.type FROM soldiersjobs  JOIN soldier ON  soldier.id=soldier_id ORDER BY soldier.degree";
$result1 = mysqli_query( $conn, $query1 );

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
<?php if(count($result1)!=0) {?>
  <h1>وظائف مجندين</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table  table-bordered text-center">
      <tr>
		<th style="line-height:30px" width="25">م</th>
		<td style="line-height:30px" width="150">درجة</td>
		<td style="line-height:30px">الإسم</td>
		<td style="line-height:30px" width="200">النوع</td>
		<td width="10" style="line-height:30px">تعديل</td>
      </tr>
      <?php
      if( mysqli_num_rows($result1) > 0){
	  
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
		$type = '';
		switch($row['type']){
			case 1:
			$type = '<label>بوليس </label>';
			break;
			case 2:
			$type = '<label>خط</label>';
			break;
			case 3:
			$type = '<label>كانتين</label>';
			break;
			case 4:
			$type = '<label>مندوب</label>';
			break;
			case 5:
			$type = '<label>منوب</label>';
			break;
			case 6:
			$type = '<label>أمن</label>';
			break;
			case 7:
			$type = '<label>مطبخ</label>';
			break;
		}

		$i++;
		
        if($row['type']){
			//Display the data
			echo "<tr>";

			echo"<td>".$i."</td><td>"
					  .$degree."</td><td>"
					  .$row['name']."</td><td>"
					  .$type."</td><td>";
			echo '<a href="edit.php?id='.$row['id'].'&&sarya='.$row['sarya'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px" >تعديل</a></td>';

			echo "</tr>";
			}
      }
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }

  ?>
  <tr>
      <td colspan="5">
          <div class="text-center"><a href="jobs.php" type="button" class="btn btn-sm btn-success"> أضافة وظيفة</a>
        
</td>
  </tr>
  </table>  
  </div>
<?php } ?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->

<?php
  include "../../../includes/footer/footer/footer.php";
?>