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
   // create the varribles
   $assistant_id = $date = "" ;
   // check to see if input are  empty 
   // create the varrible with form data
   // wrap the data with our dunction
   
   if(!$_POST['soldier_id']){
       $soldierError = "من فضلك أختار الصف ضابط <br>";
   }else {
       $soldier_id = validateFormData($_POST['soldier_id']); 
   }
   
   if(!$_POST['type']){
       $typeError = "من فضلك حدد تاريخ النوبتجية<br>";
   }else {
       $type = validateFormData($_POST['type']); 
   }
  
   
   if(!$_POST['start_date']){
       $start_dateError = "من فضلك حدد تاريخ النوبتجية<br>";
   }else {
       $start_date = validateFormData($_POST['start_date']); 
   }
   

       $end_date = validateFormData($_POST['end_date']); 
  


   //if required filed have data 
   if( $soldier_id && $type && $start_date ){

            $query = "INSERT INTO  soldierabsent (soldier_id,type,start_date,end_date)
			VALUES ('$soldier_id','$type','$start_date','$end_date')";
	
            $result = mysqli_query($conn, $query); 
			$sql = "UPDATE soldier SET availability=0 WHERE id='$soldier_id'";
			$update = mysqli_query($conn, $sql); 
           
       // if the query is success 
       if( $result ){
           // refresh page with query string
           header("Location: soldiers.php?alert=success");
       }else{
           echo "Error: ".$query."<br>".mysqli_error($conn);
       } 
   }
   else{
       $requiredError = "<div class='alert alert-danger a' style='font-size: 20px'>من فضلك أدخل كل البيانات المطلوبة  *<a class='close' data-dismiss='alert'>&times;</a></div>";
   }
}
 // close the connection

 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
		<?php
		$sarya = '';
		switch($_GET['id']){
			case 1:
			$sarya = '<label style="font-size:20px"> أفراد </label>';
			break;
			case 2:
			$sarya = '<label style="font-size:20px"> تدريب </label>';
			break;
			case 3:
			$sarya = '<label style="font-size:20px"> عمليات </label>';
			break;
			case 4:
			$sarya = '<label style="font-size:20px"> عق سلبى </label>';
			break;
			case 5:
			$sarya = '<label style="font-size:20px"> إشارة </label>';
			break;
			case 6:
			$sarya = '<label style="font-size:20px"> ش.ف </label>';
			break;
			case 7:
			$sarya = '<label style="font-size:20px"> ش.أ </label>';
			break;
			case 8:
			$sarya = '<label style="font-size:20px"> حملة </label>';
			break;
			case 9:
			$sarya = '<label style="font-size:20px"> منوب </label>';
			break;
			case 10:
			$sarya = '<label style="font-size:20px"> الكتيبة الأولى </label>';
			break;	
			case 11:
			$sarya = '<label style="font-size:20px"> الكتيبة الثانية  </label>';
			break;				
		}
		?>
        <h2 class="page-header">غياب / سجن حربى [<?php echo $sarya?>]</h2>
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
						<option value="">الإسم</option>
				<?php
				$sarya =  $_GET['id'];
				if($sarya <10){
					$query = "SELECT * FROM  soldier WHERE availability=1 AND sarya=$sarya AND punit=1";
				}else{
					$sarya -=7;
					$query = "SELECT * FROM  soldier WHERE availability=1 AND punit=$sarya";
				}
			    $result = mysqli_query($conn , $query);
			    if( mysqli_num_rows($result) > 0){
				$i=0;
			    while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value=".$row['id'].">".$row['name']."</option>";
				}
				} else {
					// if no entires
					echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
				  }				?>
				</select>  
				</div>
				<label for="soldier_id" class="col-sm-1 control-label">الإسم</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="type" id="type">
			      	<option value="">أختار النوع</option>
			      	<option value="1">غياب</option>
			      	<option value="2">سجن حربى</option>
			      </select>  
					</div>
					<label for="type" class="col-sm-1 control-label">النوع</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="start_date" name="start_date" >
					</div>
					<label for="start_date" class="col-sm-1 control-label" >تاريخ البداية</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="end_date" name="end_date" >
					</div>
					<label for="end_date" class="col-sm-1 control-label" >تاريخ النهاية </label>
			  </div>
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="soldiers.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">تسجيل</button>
				  </div>
				</div>
            <div class="col-md-push-1 col-md-9">
                
            </div>
        </form>
     </div>
		 <?php include "../../../includes/footer/footer/footer.php";?>
  </body>
</html>