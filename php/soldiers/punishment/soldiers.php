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

$query1 = "SELECT soldier.mNumber,soldier.sarya,soldier.degree,soldier.name,soldier.taskeen,
soldierpunishment.id,soldierpunishment.date,soldierpunishment.crime,soldierpunishment.punishment,soldierpunishment.period,soldierpunishment.officer_id,
soldierpunishment.crime_content,soldierpunishment.order_number,soldierpunishment.period FROM soldierpunishment  JOIN soldier ON  soldier.id=soldierpunishment.soldier_id ORDER BY soldier.taskeen";
$result1 = mysqli_query( $conn, $query1 );

$d=strtotime("+1 day");
$today = date("Y-m-d", $d);
$query10 = "SELECT * FROM  soldierpunishment";
		$result10 = mysqli_query($conn , $query10);
		if( mysqli_num_rows($result10) > 0){
		$i=0;
		while ($row = mysqli_fetch_assoc($result10)) {
			if($today > $row['date']){
			
			$id=$row['id'];
			
			$query = "DELETE FROM officervacancy WHERE id='$id'";
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


include "../../../includes/header/header/header.php";
// print the alert message
?>
<?php if(count($result1)!=0) {?>
  <h1>كشف عقوبات المجنديين</h1>
  <?php echo $_GET['sarya']; ?>
  <div class="container">
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
		<td>تاريخ بداية العقوبة</td>
		<td>رقم بند الآوامر</td>
		<td width="10">تعديل</td>
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
			$taskeen = '<label>قيادة الغوج</label>';
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
				$Newdegree = $row['degree']+1;
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
					  .$Newdegree."</td><td>"
					  .$row['name']."</td><td>"
					  .$taskeen."</td><td>"
					  .date_format($date,"Y/m/d ")."</td><td>"
					  .$crime.$row['crime_content']."</td><td>"
					  ."تجازى المذكور بـ "
					  .$Period.$punishment.$degree."</td><td>"
					  .$Officerdegree." / ".$officer['name']."</td><td>"
					  .date_format($date,"Y/m/d ")."</td><td>"
					  .$row['order_number']."</td><td>";
			echo '<a href="edit.php?id='.$row['id'].'&&sarya='.$row['sarya'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px" >تعديل</a></td>';

			echo "</tr>";

      }
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }

  ?>
  <tr>
      <td colspan="12">
          <div class="text-center"><a href="punshment.php" type="button" class="btn btn-sm btn-success"> إضافة عقوبة</a>
</td>
  </tr>
  </table>  
  </div>
<?php } ?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->

<?php
  include "../../../includes/footer/footer/footer.php";
?>