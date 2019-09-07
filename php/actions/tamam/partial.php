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
$query = "SELECT * FROM soldier";
$soldiers = mysqli_query( $conn, $query );
$query = "SELECT * FROM assistant";
$assistants = mysqli_query( $conn, $query );
$power = mysqli_num_rows($soldiers) + mysqli_num_rows($assistants);

// query & مأموريات
$query5 = "SELECT soldierout.id,soldier.name,soldier.punit,soldierout.destination,soldierout.start_date,soldierout.end_date,soldierout.type FROM soldierout  JOIN soldier ON  soldier.id=soldier_id ORDER BY soldier.degree";
$result5 = mysqli_query( $conn, $query5 );
		$vlead=0;
		$vk1=0;
		$vk2=0;
		$vnew=0;
		$flead=0;
		$fk1=0;
		$fk2=0;
		$fnew=0;
		$hlead=0;
		$hk1=0;
		$hk2=0;
		$hnew=0;
		
if( mysqli_num_rows($result5) > 0){
		

	
	   while ($row = mysqli_fetch_assoc($result5)) {
			switch($row['punit']){
				case 1:
					switch($row['type']){
					case 1:
					$vlead++;
					break;
					case 2:
					$flead++;
					break;
					case 3:
					$hlead++;
					break;
					
				}
				break;
				case 2:
					switch($row['type']){
					case 1:
					$vk1++;
					break;
					case 2:
					$fk1++;
					break;
					case 3:
					$hk1++;
					break;
				}
				break;
				case 3:
				    switch($row['type']){
					case 1:
					$vk2++;
					break;
					case 2:
					$fk2++;
					break;
					case 3:
					$hk2++;
					break;
				}
				break;
				case 4:
				    switch($row['type']){
					case 1:
					$vnew2++;
					break;
					case 2:
					$fnew++;
					break;
					case 3:
					$hnew++;
					break;
				}
				break;
			}
			
	   }	   
}
$query4 = "SELECT assistantout.id,assistant.punit,assistant.degree,assistantout.destination,assistantout.start_date,assistantout.end_date,assistantout.type FROM assistantout  JOIN assistant ON  assistant.id=assistant_id ORDER BY assistant.degree";
$result4 = mysqli_query( $conn, $query4 );
if( mysqli_num_rows($result4) > 0){
	   while ($row = mysqli_fetch_assoc($result4)) {
			switch($row['punit']){
				case 1:
					switch($row['type']){
					case 1:
					$vlead++;
					break;
					case 2:
					$flead++;
					break;
					case 3:
					$hlead++;
					break;
				}
				break;
				case 2:
					switch($row['type']){
					case 1:
					$vk1++;
					break;
					case 2:
					$fk1++;
					break;
					case 3:
					$hk1++;
					break;
				}
				break;
				case 3:
				    switch($row['type']){
					case 1:
					$vk2++;
					break;
					case 2:
					$fk2++;
					break;
					case 3:
					$hk2++;
					break;
				}
				break;
				case 4:
				    switch($row['type']){
					case 1:
					$vnew2++;
					break;
					case 2:
					$fnew++;
					break;
					case 3:
					$hnew++;
					break;
				}
				break;
			}
			
	   }	   
}


$query1 = "SELECT soldiervacancy.id,soldier.punit,soldier.name,soldier.degree,soldiervacancy.start_date,soldiervacancy.end_date,soldiervacancy.type FROM soldiervacancy  JOIN soldier ON  soldier.id=soldier_id ORDER BY soldier.degree";
$result1 = mysqli_query( $conn, $query1 );
	$vacancylead=0;
	$vacancyk1=0;
	$vacancyk2=0;
	$vacancynew=0;
if( mysqli_num_rows($result1) > 0){
		

	
	   while ($row = mysqli_fetch_assoc($result1)) {
			switch($row['punit']){
				case 1:
				$vacancylead++;
				break;
				case 2:
				$vacancyk1++;
				break;
				case 3:
				$vacancyk2++;
				break;
				case 4:
				$vacancynew++;
				break;
			}
			
	   }	   
}
$query1 = "SELECT assistantvacancy.id,assistant.punit,assistant.name,assistant.degree,assistantvacancy.start_date,assistantvacancy.end_date,assistantvacancy.type FROM assistantvacancy  JOIN assistant ON  assistant.id=assistant_id ORDER BY assistant.degree";
$result1 = mysqli_query( $conn, $query1 );
if( mysqli_num_rows($result1) > 0){
	   while ($row = mysqli_fetch_assoc($result1)) {
			switch($row['punit']){
				case 1:
				$vacancylead++;
				break;
				case 2:
				$vacancyk1++;
				break;
				case 3:
				$vacancyk2++;
				break;
				case 4:
				$vacancynew++;
				break;
			}
			
	   }	   
}

/*-------------------------------------------------------------------*/
$query2 = "SELECT * FROM assistantvacancy";
$result2 = mysqli_query( $conn, $query2);
$vacancy = mysqli_num_rows($result1)+ mysqli_num_rows($result2);

$query = "SELECT * FROM soldier";
$result = mysqli_query( $conn, $query );


 if( mysqli_num_rows($result) > 0){
		$lead=0;
		$k1=0;
		$k2=0;
		$new=0;
		$outlead=0;
		$outk1=0;
		$outk2=0;
		$outnew=0;
		$inlead=0;
		$intk1=0;
		$ink2=0;
		$innew=0;
	
	   while ($row = mysqli_fetch_assoc($result)) {
			switch($row['punit']){
				case 1:
				$lead++;
					switch($row['availability']){
					case 0:
					$outlead++;
					break;
					case 1:
					$inlead++;
					break;
				}
				break;
				case 2:
				$k1++;
				switch($row['availability']){
					case 0:
					$outk1++;
					break;
					case 1:
					$ink1++;
					break;
				}
				break;
				case 3:
				$k2++;
				switch($row['availability']){
					case 0:
					$outk2++;
					break;
					case 1:
					$ink2++;
					break;
				}
				break;
				case 4:
				$new++;
				switch($row['availability']){
					case 0:
					$outnew++;
					break;
					case 1:
					$innew++;
					break;
				}
				break;
			}
			
	   }	   
}
$query = "SELECT * FROM assistant";
$result = mysqli_query( $conn, $query );
if( mysqli_num_rows($result) > 0){
	   while ($row = mysqli_fetch_assoc($result)) {
			switch($row['punit']){
				case 1:
				$lead++;
					switch($row['availability']){
					case 0:
					$outlead++;
					break;
					case 1:
					$inlead++;
					break;
				}
				break;
				case 2:
				$k1++;
				switch($row['availability']){
					case 0:
					$outk1++;
					break;
					case 1:
					$ink1++;
					break;
				}
				break;
				case 3:
				$k2++;
				switch($row['availability']){
					case 0:
					$outk2++;
					break;
					case 1:
					$ink2++;
					break;
				}
				break;
				case 4:
				$new++;
				switch($row['availability']){
					case 0:
					$outnew++;
					break;
					case 1:
					$innew++;
					break;
				}
				break;
			}
	   }	   
}

$query2 = "SELECT soldierabsent.soldier_id,soldierabsent.type,soldier.id,soldier.punit FROM soldierabsent JOIN soldier WHERE soldier.id=soldier_id";
$result2 = mysqli_query( $conn, $query2);
$Alead=0;
$Ak1=0;
$Ak2=0;
$Anew=0;
$Glead=0;
$Gk1=0;
$Gk2=0;
$Gnew=0;
if( mysqli_num_rows($result2) > 0){
        
	   while ($row = mysqli_fetch_assoc($result2)) {
			switch($row['punit']){
				case 1:
				switch($row['type']){
				case 1:
				$Alead++;
				break;
				case 2:
				$Glead++;
				break;
				}
				break;
				case 2:
				switch($row['type']){
					case 1:
					$Ak1++;
					break;
					case 2:
					$Gk1++;
					break;
				}
				break;
				case 3:
				switch($row['type']){
					case 1:
					$Ak2++;
					break;
					case 2:
					$Gk2++;
					break;
				}
				break;
				case 4:
				switch($row['type']){
					case 1:
					$Anew++;
					break;
					case 2:
					$Gnew++;
					break;
				}
				break;
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


include "../../../includes/header/header/header.php";
// print the alert message
?>
  <style>

. sfont td{
	font-size:9px
}
  </style>
  <h1>تمام الوحدات الفرعية</h1>
  <?php echo $alertMessage; ?>
  <div class="container">
	<h2>القوة :
	<?php echo $power?>
	</h2>
<h3 style="text-decoration:underline">قيادة الفوج</h3>
<h4>القوة : <?php echo $lead?></h4>
<h4>موجود : <?php echo $inlead?></h4>
<h4>خارج : <?php echo $outlead?></h4>
<h5>تمام الخوارج :-</h5>
  <table class="table table-bordered text-center">
		<tr>
			<td class="text-center" width="16.6666%">مأمورية</td>
			<td class="text-center" width="16.6666%">فرقة</td>
			<td class="text-center" width="16.6666%">أجازة</td>
			<td class="text-center" width="16.6666%">غياب</td>
			<td class="text-center" width="16.6666%">سجن </td>
			<td class="text-center" width="16.6666%">مستشفى</td>
		</tr>
		<tr class="sfont">

			<td class="text-center "><?php echo $vlead?>
			<td class="text-center "><?php echo $flead?>
			<td class="text-center "><?php echo $vacancylead ?></td>
			<td class="text-center "><?php echo $Alead ?></td>
			<td class="text-center "><?php echo $Glead ?></td>
			<td class="text-center "><?php echo $hlead ?></td>
		</tr>
  </table>
   <hr>
<h3 style="text-decoration:underline">الكتيبة الأولى</h3>
<h4>القوة : <?php echo $k1?></h4>
<h4>موجود : <?php echo $ink1?></h4>
<h4>خارج : <?php echo $outk1?></h4>
<h5>تمام الخوارج :-</h5>
  <table class="table table-bordered text-center">

		<tr>
			<td class="text-center" width="16.6666%">مأمورية</td>
			<td class="text-center" width="16.6666%">فرقة</td>
			<td class="text-center" width="16.6666%">أجازة</td>
			<td class="text-center" width="16.6666%">غياب</td>
			<td class="text-center" width="16.6666%">سجن </td>
			<td class="text-center" width="16.6666%">مستشفى</td>
		</tr>
		<tr>

			<td class="text-center "><?php echo $vk1?>
			<td class="text-center "><?php echo $fk1?>
			<td class="text-center "><?php echo $vacancyk1 ?></td>
			<td class="text-center "><?php echo $Ak1 ?></td>
			<td class="text-center "><?php echo $Gk1 ?></td>
			<td class="text-center "><?php echo $hk1 ?></td>
		</tr>
  </table>
   <hr>
<h3 style="text-decoration:underline">الكتيبة الثانية</h3>
<h4>القوة : <?php echo $k2?></h4>
<h4>موجود : <?php echo $ink2?></h4>
<h4>خارج : <?php echo $outk2?></h4>
<h5>تمام الخوارج :-</h5>
  <table class="table table-bordered text-center">

		<tr class="sfont">
			<td class="text-center" width="16.6666%">مأمورية</td>
			<td class="text-center" width="16.6666%">فرقة</td>
			<td class="text-center" width="16.6666%">أجازة</td>
			<td class="text-center" width="16.6666%">غياب</td>
			<td class="text-center" width="16.6666%">سجن </td>
			<td class="text-center" width="16.6666%">مستشفى</td>
		</tr>
		<tr class="sfont">

			<td class="text-center "><?php echo $vk2?>
			<td class="text-center "><?php echo $fk2?>
			<td class="text-center "><?php echo $vacancyk2 ?></td>
			<td class="text-center "><?php echo $Ak2 ?></td>
			<td class="text-center "><?php echo $Gk2 ?></td>
			<td class="text-center "><?php echo $hk2 ?></td>
		</tr>
  </table>
  <hr>
  <h3 style="text-decoration:underline">المستجدين</h3>
<h4>القوة : <?php echo $new?></h4>
<h4>موجود : <?php echo $innew?></h4>
<h4>خارج : <?php echo $outnew?></h4>
<h5>تمام الخوارج :-</h5>
  <table class="table table-bordered text-center">

		<tr class="sfont">
			<td class="text-center" width="16.6666%">مأمورية</td>
			<td class="text-center" width="16.6666%">فرقة</td>
			<td class="text-center" width="16.6666%">أجازة</td>
			<td class="text-center" width="16.6666%">غياب</td>
			<td class="text-center" width="16.6666%">سجن </td>
			<td class="text-center" width="16.6666%">مستشفى</td>
		</tr>
		<tr class="sfont">

			<td class="text-center "><?php echo $vnew?>
			<td class="text-center "><?php echo $fnew?>
			<td class="text-center "><?php echo $vacancynew ?></td>
			<td class="text-center "><?php echo $Anew ?></td>
			<td class="text-center "><?php echo $Gnew ?></td>
			<td class="text-center "><?php echo $hnew ?></td>
		</tr>
  </table>


</div>

<?php
  include "../../../includes/footer/footer/footer.php";
?>