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
$query1 = "SELECT assistantvacancy.id,assistant.name,assistant.degree,assistantvacancy.start_date,assistantvacancy.end_date,assistantvacancy.type FROM assistantvacancy  JOIN assistant ON  assistant.id=assistant_id ORDER BY assistant.degree";
$result1 = mysqli_query( $conn, $query1 );

$d=strtotime("+1 day");
$today = date("Y-m-d", $d);
$query10 = "SELECT * FROM  assistantvacancy";
		$result10 = mysqli_query($conn , $query10);
		if( mysqli_num_rows($result10) > 0){
		$i=0;
		while ($row = mysqli_fetch_assoc($result10)) {
			if($today > $row['end_date'] && $row['end_date']!= "0000-00-00"){
			
			$id=$row['id'];
			$assistant_id=$row['assistant_id'];
			$query = "UPDATE assistant SET `availability`=1 WHERE id='$assistant_id'";
			$result = mysqli_query($conn,$query);
			$query = "DELETE FROM assistantvacancy WHERE id='$id'";
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
  <h1>أجازات صف ضباط</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table  table-bordered text-center">
      <tr>
		<th rowspan="2" style="line-height:60px">م</th>
		<td rowspan="2" style="line-height:60px">رتبة</td>
		<td rowspan="2" style="line-height:60px">الإسم</td>
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
		$type = '';
		switch($row['type']){
			case 1:
			$type = '<label>ميدانية </label>';
			break;
			case 2:
			$type = '<label>راحة</label>';
			break;
			case 3:
			$type = '<label>بدل راحة</label>';
			break;
			case 4:
			$type = '<label>سنوية</label>';
			break;
			case 4:
			$type = '<label>عارضة</label>';
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
          <div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"> أضافة أجازة</a>
         <a href="../../actions/tamam/assistants.php" type="button" class="btn btn-sm btn-danger"> تمام ضباط الصف </a></div>
</td>
  </tr>
  </table>  
  </div>
<?php } ?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->

<?php
  include "../../../includes/footer/footer/footer.php";
?>