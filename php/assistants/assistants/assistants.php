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
// query & result
$query = "SELECT * FROM assistant";
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
if( isset($_POST['delete'] ) ){
    $alertMessage = "<div class='alert alert-danger'>
        <h5>هل أنت متأكد من حذف العنصر ...</h5>
        <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=$assistantID' method='post'>
            <input type='submit' class='btn btn-danger' name='confirm-delete' value='مسح '>
            <a type='button' class='btn btn-primary' data-dismiss='alert'>لا شكرا</a>
        </form>
    </div>";
    
}
if(isset( $_POST['confirm-delete'] )){
           // new database query & result
            $query = "DELETE FROM assistant WHERE id='$assistantID'";
            $result = mysqli_query($conn,$query);
            if($result){
                header("Location: assistants.php");
            }else{
                echo "<div class='alert alert-danger'>خطــــــأ </div>";
            }
          //header("Location: clients.php");
      }

 // close the connection
 mysqli_close($conn);
include "../../../includes/header/header/header.php";
// print the alert message
?>
  <h1>صف الضباط</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table table-striped table-bordered text-center">
      <tr>
		<th >م</th>
		<td>رقم عسكرى</td>
		<td>درجة</td>
		<td>الأسم</td>
		<td>الوحدة الفرعية</td>
		<td>طقم النوبتجية</td>
		<td>العنوان</td>
		<td width="10">مسح</td>
      </tr>
      <?php
      if( mysqli_num_rows($result) > 0){
		$i=0;
      // we have data
      // output the data
	   while ($row = mysqli_fetch_assoc($result)) {
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
		$punit = '';
		
		switch($row['punit']){
			case 1:
			$punit = '<label>قيادة الفوج</label>';
			break;
			case 2:
			$punit = '<label>الكتيبة الأولى </label>';
			break;
			case 3:
			$punit = '<label> الكتيبة الثانية</label>';
			break;
		}
		$availability = '';
		switch($row['availability']){
			case 0:
			$availability = '<label>خارج</label>';
			break;
			case 1:
			$availability = '<label>موجود</label>';
			break;
		}
		$crew = '';
		switch($row['crew']){
			case 0:
			$crew = '<label>لا يوجد</label>';
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
		$sarya = '';
		switch($row['sarya']){
			case 1:
			$sarya = '<label> أفراد </label>';
			break;
			case 2:
			$sarya = '<label> تدريب </label>';
			break;
			case 3:
			$sarya = '<label> عمليات </label>';
			break;
			case 4:
			$sarya = '<label> عق سلبى </label>';
			break;
			case 5:
			$sarya = '<label> إشارة </label>';
			break;
			case 6:
			$sarya = '<label> ش.ف </label>';
			break;
			case 7:
			$sarya = '<label> ش.أ </label>';
			break;
			case 8:
			$sarya = '<label> حملة </label>';
			break;	
			
			
		}
		$i++;
        //Display the data
			echo "<tr>";

        echo"<td>".$i."</td><td>"
				  .$row['mNumber']."</td><td>"
                  .$degree."</td><td>"
                  .$row['name']."</td><td>"
                  .$punit."</td><td>"
                  .$crew."</td><td>"
				  .$row['title']."</td><td>";
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