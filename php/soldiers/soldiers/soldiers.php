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
$query = "SELECT * FROM soldier ORDER BY punit,sarya,degree";
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
        <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=$soldierID' method='post'>
            <input type='submit' class='btn btn-danger' name='confirm-delete' value='مسح '>
            <a type='button' class='btn btn-primary' data-dismiss='alert'>لا شكرا</a>
        </form>
    </div>";
    
}
if(isset( $_POST['confirm-delete'] )){
           // new database query & result
            $query = "DELETE FROM soldier WHERE id='$soldierID'";
            $result = mysqli_query($conn,$query);
            if($result){
                header("Location: soldiers.php");
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
  <style>
  .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td{
padding: 2px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ddd;
}
. sfont td{
	font-size:9px
}
  </style>
  <h1>الجنــــــــــــــود</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table table-bordered text-center">
      <tr >
		<th class="text-center">م</th>
		<th class="text-center">رقم عسكرى</th>
		<th class="text-center">درجة</th>
		<th class="text-center">الأسم</th>
		<th class="text-center">الوحدة الفرعية</th>
		<th class="text-center">السرية</th>
		<th class="text-center">العنوان</th>
		<th width="10" class="text-center">تعديل</th>
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
			$degree = '<label>جندى</label>';
			break;
			case 2:
			$degree = '<label>عريف مجند</label>';
			break;
			case 3:
			$degree = '<label>رقيب مجند</label>';
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
			case 4:
			$punit = '<label> مستجد </label>';
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
		
		$taskeen = '';
		switch($row['taskeen']){
			case 1:
			$taskeen = '<label>قيادة الفوج</label>';
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
                  .$sarya."</td><td>"
				  .$row['title']."</td><td>";
        echo '<a href="edit.php?id='.$row['id'].'" type="button" class="btn btn-primary btn-xs" style="margin-left:5px">تعديل</a></td>';

        echo "</tr>";
      }
  } else {
    // if no entires
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
  }


  ?>
  <tr>
      <td colspan="8">
          <div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success">
              <span class="glyphicon glyphicon-plus"></span>إضافة جندى</a></div></td>
  </tr>
  </table>
</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>