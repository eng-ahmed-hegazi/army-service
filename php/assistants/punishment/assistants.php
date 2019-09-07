<?php
  session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
if( isset( $_POST["add"])){
	$sarya = $_POST['sarya'];
	  header("Location: assistants.php?month=$sarya");
}
// connect to database
include "../../../includes/controls/db/connection.php";
if($_GET['month'] == NULL){
	$query1 = "SELECT assistant.mNumber,assistant.sarya,assistant.degree,assistant.name,assistant.taskeen,
	assistantpunishment.id,assistantpunishment.date,assistantpunishment.crime,assistantpunishment.punishment,assistantpunishment.period,assistantpunishment.officer_id,
	assistantpunishment.crime_content,assistantpunishment.order_number,assistantpunishment.period FROM assistantpunishment  JOIN assistant ON  assistant.id=assistantpunishment.assistant_id ORDER BY assistant.taskeen";
	$result1 = mysqli_query( $conn, $query1 );
}else{
	$sarya = $_GET['month'];
	$query1 = "SELECT assistant.mNumber,assistant.sarya,assistant.degree,assistant.name,assistant.taskeen,
	assistantpunishment.id,assistantpunishment.date,assistantpunishment.crime,assistantpunishment.punishment,assistantpunishment.period,assistantpunishment.officer_id,
	assistantpunishment.crime_content,assistantpunishment.order_number,assistantpunishment.period FROM assistantpunishment  JOIN assistant ON  assistant.id=assistantpunishment.assistant_id AND month(assistantpunishment.date)='$month' ORDER BY assistant.taskeen";
	$result1 = mysqli_query( $conn, $query1 );
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
  <h1>كشف عقوبات الصف ضباط</h1>
  <div class="container">
		<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
			  <div class="form-group">
			  <div class="col-sm-2">
					<button type="submit" class="btn btn-success" name="add">أختيار </button>
				  </div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="sarya" id="sarya">
			      	<option value="">الشهر</option>
			      	<option value="1">يناير</option>
			      	<option value="2">فبراير</option>
			      	<option value="3">مارس</option>
			      	<option value="4">أبريل</option>
			      	<option value="5">مايو</option>
			      	<option value="6">يونيو</option>
			      	<option value="7">يوليو</option>
			      	<option value="8">أغسطس</option>
			      	<option value="10">أكتوبر</option>
			      	<option value="11">نوفمبر</option>
			      	<option value="11">سبتمبر </option>
			      	<option value="12">ديسمبر</option>
			      </select>  
					</div>
					<label for="sarya" class="col-sm-1 control-label">أختار الشهر</label>
			  </div>	
			   <div class="form-group">        
				  
				</div>
            </form>
     </div>
  <div class="container">
  
      <?php
      if( mysqli_num_rows($result1) > 0){
	  ?>
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
		
		$crime = '';
		switch($row['crime']){
			case 1:
			$crime = '<label> السلوك </label> ';
			break;
			case 2:
			$crime = '<label> الإهمال</label> ';
			break;
			case 3:
			$crime = '<label> الغياب</label> ';
			break;
		}
		
		$punishment = '';
		switch($row['punishment']){
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
				$Newdegree = $row['degree']-=1;
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
					  .$degree."</td><td>"
					  .$row['name']."</td><td>"
					  .$taskeen."</td><td>"
					  .date_format($date,"Y/m/d ")."</td><td>"
					  .$crime.$row['crime_content']."</td><td>"
					  ."تجازى المذكور بـ "
					  .$Period.$punishment.$Newdegree."</td><td>"
					  .$Officerdegree." / ".$officer['name']."</td><td>"
					  .date_format($date,"Y/m/d ")."</td><td>"
					  .$row['order_number']."</td><td>";
			echo '<a href="edit.php?id='.$row['id'].'&&sarya='.$row['sarya'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px" >تعديل</a></td>';

			echo "</tr>";

      }
  

  ?>
  <tr>
      <td colspan="12">
          <div class="text-center"><a href="punshment.php" type="button" class="btn btn-sm btn-success"> إضافة عقوبة</a>
</td>
  </tr>
  </table>  
  </div>
<?php
} else {?>
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
		<tr class="text-center">
			<td colspan="12" class="text-center">لا يكـــــــــــــــــــــــــــــــــــــــــن</td>
		</tr>
		<tr>
      <td colspan="12">
          <div class="text-center"><a href="punshment.php" type="button" class="btn btn-sm btn-success"> إضافة عقوبة</a>
</td>
  </tr>
	</table>
  <?php }} ?>
  <!-----**--------*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-->

<?php
  include "../../../includes/footer/footer/footer.php";
?>