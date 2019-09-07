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
$query1 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id ORDER BY officer.degree";
$result1 = mysqli_query( $conn, $query1 );
// query & فرق
$query2 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id ORDER BY officer.degree";
$result2 = mysqli_query( $conn, $query2 );
// query & غياب
$query3 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id ORDER BY officer.degree";
$result3 = mysqli_query( $conn, $query3 );
// query & مستشفى
$query4 = "SELECT officerout.id,officer.name,officer.degree,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id ORDER BY officer.degree";
$result4 = mysqli_query( $conn, $query4 );

$d=strtotime("+1 day");
$today = date("Y-m-d", $d);
$query10 = "SELECT * FROM  officerout";
		$result10 = mysqli_query($conn , $query10);
		if( mysqli_num_rows($result10) > 0){
		$i=0;
		while ($row = mysqli_fetch_assoc($result10)) {
			if($today > $row['end_date'] && $row['start_date']!="0000-00-00"){
			
			$id=$row['id'];
			$officer_id=$row['officer_id'];
			$query = "UPDATE officer SET `availability`=1 WHERE id='$officer_id'";
			$result = mysqli_query($conn,$query);
			$query = "DELETE FROM officerout WHERE id='$id'";
			$result = mysqli_query($conn,$query);
			
		}
	}
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

 // close the connection
 mysqli_close($conn);
include "../../../includes/header/header/header.php";
// print the alert message
?>
<?php if(count($result1)!=0) {?>
  <h1>  مأموريات / فرق ضباط</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table  table-bordered text-center">
      <tr>
		<th rowspan="2" style="line-height:60px">م</th>
		<td rowspan="2" style="line-height:60px">درجة</td>
		<td rowspan="2" style="line-height:60px">الإسم</td>
		<td rowspan="2" style="line-height:60px">الجهة</td>
		<td rowspan="2" style="line-height:60px">النوع</td>
		<td colspan="2">المــــــــدة</td>
		<td width="10" rowspan="2" style="line-height:60px">تعديل</td>
      </tr>
	  <tr>
		<td>من</td>
		<td>إلى</td>
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
		$type = '';
		switch($row['type']){
			case 1:
			$type = '<label>مأمورية </label>';
			break;
			case 2:
			$type = '<label>فرقة</label>';
			break;
			case 3:
			$type = '<label>أختبارات</label>';
			break;
			case 4:
			$type = '<label>مستشفى</label>';
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
			echo "<tr>";

			echo"<td>".$i."</td><td>"
					  .$degree."</td><td>"
					  .$row['name']."</td><td>"
					  .$row['destination']."</td><td>"
					  .$type."</td><td>"
					  .$formatStart."</td><td>"
					  .$formatEnd."</td><td>";
			echo '<a href="edit.php?id='.$row['id'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px" >تعديل</a></td>';

			echo "</tr>";
			}
      }
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }

  ?>
  <tr>
      <td colspan="8">
          <div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"> إضافة مأمورية / فرقة</a>
         <a href="../../actions/tamam/officers.php" type="button" class="btn btn-sm btn-danger"> تمام الضباط</a></div>
</td>
  </tr>
  </table>  
  </div>
<?php } ?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->

<?php
  include "../../../includes/footer/footer/footer.php";
?>