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
$query1 = "SELECT * from officerout WHERE type=1";
$result1 = mysqli_query( $conn, $query1 );

$query2 = "SELECT * from officerout WHERE type=2";
$result2 = mysqli_query( $conn, $query2 );

$query = "SELECT * from officer";
$result = mysqli_query( $conn, $query);

$query3 = "SELECT * from assistant";
$result3 = mysqli_query( $conn, $query3);

$query4= "SELECT * from soldier";
$result4 = mysqli_query( $conn, $query4);




 include ("../../../includes/header/header/header.php");
?>

  <body style="direction:rtl">
      <div class="container" style="min-height:444px">
		<div class="row">
			<div class="col-md-2">
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<span style="font-size:16px;font-weight:bold">القوة</span>
						</div>
						<div class="panel-body text-center">
							<h3><?php echo mysqli_num_rows($result3)+mysqli_num_rows($result4)?></h3>
						</div>
					</div>
			</div>
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<span style="font-size:16px;font-weight:bold">الضباط</span>
					</div>
					<div class="panel-body text-center">
						<h3><?php echo mysqli_num_rows($result)?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<span style="font-size:16px;font-weight:bold">الصف ضباط</span>
					</div>
					<div class="panel-body text-center">
						<h3><?php echo mysqli_num_rows($result3)?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<span style="font-size:16px;font-weight:bold">الجنود</span>
					</div>
					<div class="panel-body text-center">
						<h3><?php echo mysqli_num_rows($result4)?></h3>
					</div>
				</div>
			</div>
			
      </div>
      <?php include "../../../includes/footer/footer/footer.php";?>
  </body>
</html>