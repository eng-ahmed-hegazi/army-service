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
$query = "SELECT * FROM officer ORDER BY degree DESC";
$result = mysqli_query( $conn, $query );

//check for the query string
if ( isset( $_GET['alert'] ) ){
  if ( $_GET['alert'] == 'success' ){
    $alertMessage = "<div class='alert alert-success'>تمت الإضافة بنجاح<a href='' data-dismiss='alert' class='close pull-left'>&times;</a></div>";
  }
  else if( $_GET['alert'] == 'updatesuccess' ){
    $alertMessage = "<div class='alert alert-info'>تم التعديل بنجاح<a href='' data-dismiss='alert' class='close pull-left'>&times;</a></div>";
  } else if( $_GET['alert'] == 'deleted' ){
    $alertMessage = "<div class='alert alert-info'>تم الحذف بنجاح<a href='' data-dismiss='alert' class='close pull-left'>&times;</a></div>";
  }
}
if( isset($_POST['delete'] ) ){
    $alertMessage = "<div class='alert alert-danger'>
        <h5>هل أنت متأكد من حذف العنصر ...</h5>
        <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=$officerID' method='post'>
            <input type='submit' class='btn btn-danger' name='confirm-delete' value='مسح '>
            <a type='button' class='btn btn-primary' data-dismiss='alert'>لا شكرا</a>
        </form>
    </div>";
    
}
if(isset( $_POST['confirm-delete'] )){
           // new database query & result
            $query = "DELETE FROM officer WHERE id='$officerID'";
            $result = mysqli_query($conn,$query);
            if($result){
                header("Location: officer.php");
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
  <h1> الضباط</h1>
  
  <div class="container">
  <?php echo $alertMessage; ?>
  <table class="table table-striped table-bordered text-center">
      <tr>
		<th >م</th>
		<td>رقم عسكرى</td>
		<td>رقم أقدمية</td>
		<td>رتبة</td>
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
		$punit = '';
		
		switch($row['punit']){
			case 1:
			$punit = '<label>قيادة الغوج</label>';
			break;
			case 2:
			$punit = '<label>الكتيبة الأولى </label>';
			break;
			case 3:
			$punit = '<label> الكتيبة الثانية</label>';
			break;
			case 4:
			$punit = '<label> مستجد</label>';
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
			$crew = '<label>ضابط نوبتجى وحريق</label>';
			break;
			case 2:
			$crew = '<label>ضابط عظيم وخفيف حركة</label>';
			break;
			case 3:
			$crew = '<label>محطة الجبل الأحمر العسكرية</label>';
			break;
			case 4:
			$crew = '<label>ضابط منوب</label>';
			break;
			case 5:
			$crew = '<label>قائد منوب</label>';
			break;
		}
		$job = '';
		switch($row['job']){
			case 1:
			$job = '<label>لا يوجد</label>';
			break;
			case 2:
			$job = '<label>رئيس الشئون الإدارية</label>';
			break;
			case 3:
			$job = '<label>رئيس قسم الإشارة</label>';
			break;
			case 4:
			$job = '<label>رئيس قسم التنظيم والإدارة</label>';
			break;
			case 5:
			$job = '<label>رئيس قسم التأمين الفنى </label>';
			break;
			case 6:
			$job = '<label>رئيس قسم العمليات والتدريب</label>';
			break;
			case 7:
			$job = '<label>قائد مركز العمليات</label>';
			break;
			case 8:
			$job = '<label>قائد سرية عق سلبي</label>';
			break;
			case 9:
			$job = '<label>قائد ف1/عق سلبى</label>';
			break;
			case 10:
			$job = '<label>قائد ورشة إصلاح مركبات</label>';
			break;
			case 11:
			$job = '<label>قائد س1 عق راد</label>';
			break;
			case 12:
			$job = '<label>قائد ف1س1 عق راد</label>';
			break;
			case 13:
			$job = '<label>قا ف3 س1 عق راد</label>';
			break;
			case 14:
			$job = '<label>قائد ف1س2 عق راد</label>';
			break;
			case 15:
			$job = '<label>قائد س 2ك2 عق راد</label>';
			break;
			case 16:
			$job = '<label>رئيس عمليات الكتيبة الأولى</label>';
			break;
			case 17:
			$job = '<label>رئيس عمليات الكتيبة الثانية</label>';
			break;
			case 18:
			$job = '<label>قائد الكتيبة الثانية</label>';
			break;
			case 19:
			$job = '<label>قائد الكتيبة الأولى</label>';
			break;
			case 20:
			$job = '<label>رئيس عمليات الفوج </label>';
			break;
			case 21:
			$job = '<label>قائد ثانى الفوج</label>';
			break;
			case 22:
			$job = '<label>قائد الفوج</label>';
			break;

		}
		$i++;
        //Display the data
			echo "<tr>";

        echo"<td>".$i."</td><td>"
				  .$row['mNumber']."</td><td>"
				  .$row['oNumber']."</td><td>"
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
    echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close pull-left' data-dismiss='alert'>&times;</a></div>";
  }


  ?>
  <tr>
      <td colspan="9">
          <div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success">إضافة ضابط </a></div></td>
  </tr>
  </table>
</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>