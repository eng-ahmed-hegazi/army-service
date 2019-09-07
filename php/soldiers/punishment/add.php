<?php
// start the session
 session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
// disable notification & warning
 error_reporting(E_ALL & ~E_NOTICE && ~E_WARNING); 

// connect to database
include ("../../../includes/controls/db/connection.php");
// include functions.php
include ("../../../includes/controls/controls/functions.php");

if( isset( $_POST["add"])){
   // create the varribles order_number, crime_content, punishment, crime, period, soldier_id, officer_id, date
   $order_number = $crime_content = $punishment = $crime =  $period = $soldier_id = $officer_id = $date =  "";
   // check to see if input are  empty 
   // create the varrible with form data
   // wrap the data with our dunction
   
   if(!$_POST['soldier_id']){
       $soldier_idError = "من فضلك أدخل الرقم العسكرى <br>";
   }else {
       $soldier_id = validateFormData($_POST['soldier_id']); 
   }
   
   if(!$_POST['officer_id']){
       $officer_idError = "من فضلك أدخل رقم الأقدمية <br>";
   }else {
       $officer_id = validateFormData($_POST['officer_id']); 
   }

   $order_number = validateFormData($_POST['order_number']); 
   $crime_content   = validateFormData($_POST['crime_content']);
   $punishment = validateFormData($_POST['punishment']);
   $crime = validateFormData($_POST['crime']);
   $period   = validateFormData($_POST['period']);
   $date   = validateFormData($_POST['date']);
   

   //if required filed have data 
   if( $officer_id && $soldier_id ){
			$sql = "SELECT * FROM soldier WHERE id=$soldier_id";
			$soldier = mysqli_query($conn, $sql); 
			$row = mysqli_fetch_assoc($soldier);
			if($row['degree']==1&&$_POST['punishment']==1){
				$requiredError = "<div class='alert alert-danger a' style='font-size: 18px'> الدرجة جندى لا يكمن العزل *<a class='close pull-left' data-dismiss='alert'>&times;</a></div>";
			}else{
            //create a query 
			if($_POST['punishment']==1&&$row['degree']!=1){
				$period=0;
				$degree=$row['degree'];
				$Newdegree=$degree-1;
				
				$query1 = "UPDATE soldier SET degree=$Newdegree WHERE id=$soldier_id";
				$result1 = mysqli_query($conn, $query1);
			
			}
            $query = "INSERT INTO soldierpunishment (order_number, crime_content, punishment, crime, period, soldier_id, officer_id, date)
	VALUES ('$order_number','$crime_content','$punishment','$crime','$period','$soldier_id','$officer_id','$date')";
            $result = mysqli_query($conn, $query); 
           }
       // if the query is success 
       if( $result ){
           // refresh page with query string
           header("Location: soldiers.php?alert=success");
       }else{
           echo "Error: ".$query."<br>".mysqli_error($conn);
       }
   }
   else{
       $requiredError = "<div class='alert alert-danger a' style='font-size: 18px'>  الرقم العسكرى والأسم و رقم الأقدمية مطلوبين *<a class='close pull-left' data-dismiss='alert'>&times;</a></div>";
   }
}

 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
        <h2 class="page-header">عقوبة إنضباطية لجندى</h2>
		<?php
			echo $usedBefore;
			echo $requiredError;
			echo $invalidEmail;
		?>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
				<select class="form-control" name="soldier_id" id="soldier_id">
						<option value="">إسم الجندى</option>
				<?php
				$sarya =  $_GET['id'];
				if($sarya <10){
					$query = "SELECT * FROM  soldier WHERE sarya=$sarya AND punit=1";
				}else{
					$sarya -=7;
					$query = "SELECT * FROM  soldier WHERE punit=$sarya";
				}
			    $result = mysqli_query($conn , $query);
			    if( mysqli_num_rows($result) > 0){
				$i=0;
			    while ($row = mysqli_fetch_assoc($result)) {
					$degree = '';
					switch($row['degree']){
						case 1:
						$degree = 'جندى';
						break;
						case 2:
						$degree = 'عريف مجند';
						break;
						case 3:
						$degree = 'رقيب مجند';
						break;
					}
					if($row['availability']==1){
						echo "<option value=".$row['id'].">".$degree." / ".$row['name']."</option>";
					}
				}
				
				} else {
					// if no entires
					echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
				  }				?>
				</select>  
<!--`order_number`, `crime_content`, `punishment`, `crime`, `period`, `soldier_id`, `officer_id`, `date`-->
				</div>
				<label for="soldier_id" class="col-sm-1 control-label">إسم الجندى</label>
			  </div>
			  			
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="crime" id="crime">
			      	<option value="">أختيار نوع الجريمة</option>
			      	<option value="1">سلوك </option>
			      	<option value="2">إهمال</option>
			      	<option value="3">غياب</option>
			      </select>  
					</div>
					<label for="crime" class="col-sm-1 control-label">نوع الجريمة</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="punishment" id="punishment">
			      	<option value="">أختيار نوع العقوبة</option>
			      	<option value="1">عزل</option>
			      	<option value="2">حجز</option>
			      	<option value="3">حبس</option>
			      </select>  
				</div>
				<label for="punishment" class="col-sm-1 control-label">نوع العقوبة</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <textarea rows="4" class="form-control" id="crime_content" name="crime_content" ></textarea>
					</div>
					<label for="crime_content" class="col-sm-1 control-label" >نص الجريمة</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="text" class="form-control1" id="period" name="period" >
					</div>
					<label for="period" class="col-sm-1 control-label" >المدة</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
				  <select class="form-control" name="officer_id" id="officer_id">
							<option value=""> إسم الآمر بالعقوبة</option>
					<?php
					$query = "SELECT * FROM  officer ";
					$result = mysqli_query($conn , $query);
					if( mysqli_num_rows($result) > 0){
					$i=0;
					while ($row = mysqli_fetch_assoc($result)) {
					
						if($row['availability']==1 && $row['job']==20 || $row['job']==22 || $row['job']==19 || $row['job']==18){
							echo "<option value=".$row['id'].">".$row['name']."</option>";
						}
					}

					} else {
						// if no entires
						echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
					  }				?>
					</select> 
				</div>
				<label for="officer_id" class="col-sm-1 control-label"> الآمر بالعقوبة</label>
			  </div>	
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="text" class="form-control1" id="order_number" name="order_number" >
					</div>
					<label for="order_number" class="col-sm-1 control-label" >رقم بند الأوامر</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="date" name="date" >
					</div>
					<label for="date" class="col-sm-1 control-label" >تاريخ الجزاء</label>
			  </div>
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="soldiers.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">توقيع العقوبة</button>
				  </div>
				</div>
            <div class="col-md-push-1 col-md-9">
                
            </div>
        </form>
     </div>
		  <?php include "../../../includes/footer/footer/footer.php";?>
  </body>
</html>