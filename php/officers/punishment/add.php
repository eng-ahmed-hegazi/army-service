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
   // create the varribles order_number, crime_content, punishment, crime, period, officer_id, officer, date
   $order_number = $crime_content = $punishment = $crime =  $period = $officer_id = $officer = $date =  "";
   // check to see if input are  empty 
   // create the varrible with form data
   // wrap the data with our dunction
   
   if(!$_POST['officer_id']){
       $officer_idError = "من فضلك أدخل الرقم العسكرى <br>";
   }else {
       $officer_id = validateFormData($_POST['officer_id']); 
   }
   
   if(!$_POST['officer']){
       $officerError = "من فضلك أدخل رقم الأقدمية <br>";
   }else {
       $officer = validateFormData($_POST['officer']); 
   }

   $order_number = validateFormData($_POST['order_number']); 
   $crime_content   = validateFormData($_POST['crime_content']);
   $punishment = validateFormData($_POST['punishment']);
   $crime = validateFormData($_POST['crime']);
   $period   = validateFormData($_POST['period']);
   $date   = validateFormData($_POST['date']);
   

   //if required filed have data 
   if( $officer && $officer_id ){
     
            //create a query 
            $query = "INSERT INTO officerpunishment (order_number, crime_content, punishment, crime, period, officer_id, officer, date)
	VALUES ('$order_number','$crime_content','$punishment','$crime','$period','$officer_id','$officer','$date')";
            $result = mysqli_query($conn, $query); 
           
       // if the query is success 
       if( $result ){
           // refresh page with query string
           header("Location: officers.php?alert=success");
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
				<select class="form-control" name="officer_id" id="officer_id">
						<option value="">إسم الظابط</option>
				<?php
			    $query = "SELECT * FROM  officer";
			    $result = mysqli_query($conn , $query);
			    if( mysqli_num_rows($result) > 0){
				$i=0;
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
					if($row['availability']==1){
						echo "<option value=".$row['id'].">".$degree." / ".$row['name']."</option>";
					}
				}
				} else {
					// if no entires
					echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
				  }				?>
				</select>  
<!--`order_number`, `crime_content`, `punishment`, `crime`, `period`, `officer_id`, `officer`, `date`-->
				</div>
				<label for="officer_id" class="col-sm-1 control-label">إسم الجندى</label>
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
			      	<option value="1">نوبتجيات زيادة</option>
			      	<option value="2">حجز</option>
			      	<option value="3">حرمان شهر من علاوة</option>
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
				  <select class="form-control" name="officer" id="officer">
							<option value=""> إسم الآمر بالعقوبة</option>
					<?php
					$query = "SELECT * FROM  officer";
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
				<label for="officer" class="col-sm-1 control-label"> الآمر بالعقوبة</label>
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
					<a href="officers.php" type="button" class="btn btn-default">إلغاء</a>
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