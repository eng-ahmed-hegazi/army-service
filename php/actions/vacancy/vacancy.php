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
$query = "SELECT * FROM vacancy ORDER BY vacancy_number";
$result = mysqli_query( $conn, $query );
$query1 = "SELECT * FROM vacancy ORDER BY vacancy_number";
$result1 = mysqli_query( $conn, $query1);


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
 // mysqli_close($conn);
include "../../../includes/header/header/header.php";
// print the alert message
?>
  <h1>الميدانيات </h1>
  
	<div class="container">
	<?php echo $alertMessage; ?>
		<div class="row" style="margin-bottom:10px">
			<div class="col-lg-12">
				<a href="add.php" class="btn btn-default">إضافة ميدانية</a>
				<a href="index.php"  class="btn btn-default">عرض التحكم فى الميدانيات</a>
			</div>
		</div>
		<div class="row">
		
		<?php 
			while ($row = mysqli_fetch_assoc($result1)) {
				if( mysqli_num_rows($result) > 0){
				 while ($row = mysqli_fetch_assoc($result)) {
				?>
				<div class="col-md-4 pull-right">
					<div class="panel panel-primary">
					  <div class="panel-heading" style="font-size:19px">
					  <?php 
					  $vNumber = $row['vacancy_number'];
					  $id = $row['vacancy_number'];
					  
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
						echo "<a href='paper.php?id=$id' style='color:#fff'> الميدانية ".$vNumber."</a>";
						
						?>
					  </div>
				<div class="panel-body" style="font-size:19px">
					  <label style="font-size:17px">عدد الجنود:  
					   <?php
					  $vNumber = $row['vacancy_number'];
					    $query4= "SELECT * from soldier WHERE vacancy_id=$vNumber";
						if($result4 = mysqli_query( $conn, $query4)){
						$result4 = mysqli_query( $conn, $query4);
							echo  mysqli_num_rows($result4);
						}else{
							echo "0";
						}
					  ?>
					  
					  </label>
						<ul class="list-group" style="padding: 0;width: 100%;">
							<li class="list-group-item"><span class="badge pull-left">
							<?php
							  $vNumber = $row['vacancy_number'];
								$query4= "SELECT * from soldier WHERE vacancy_id=$vNumber AND punit=1";
								if($result4 = mysqli_query( $conn, $query4)){
								$result4 = mysqli_query( $conn, $query4);
								echo  mysqli_num_rows($result4);
								}else{
									echo "0";
								}
			
							  ?>
							</span> قيادة الفوج </li>
							<li class="list-group-item"><span class="badge pull-left">
							<?php
							  $vNumber = $row['vacancy_number'];
								$query4= "SELECT * from soldier WHERE vacancy_id=$vNumber AND punit=2";
								if($result4 = mysqli_query( $conn, $query4)){
								$result4 = mysqli_query( $conn, $query4);
								echo  mysqli_num_rows($result4);
								}else{
									echo "0";
								}
			
							  ?>
							</span> الكتيبة الأولى  </li>
							<li class="list-group-item"><span class="badge pull-left">
							<?php
							  $vNumber = $row['vacancy_number'];
								$query4= "SELECT * from soldier WHERE vacancy_id=$vNumber AND punit=3";
								if($result4 = mysqli_query( $conn, $query4)){
								$result4 = mysqli_query( $conn, $query4);
								echo  mysqli_num_rows($result4);
								}else{
									echo "0";
								}
			
							  ?>
							</span> الكتيبة الثانية </li>
						</ul>
						<label>أخر عودة : </label>
						<?php echo $row['back_date']?>
						</div>
					</div>
				</div>
				
				<?php
				}
			  } else {
				
			  }

		  }
		  ?>
		</div>
		<div class="text-center">
		<a href="add.php" class="btn btn-success ">إضافة ميدانية</a>
		</div>
	</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>