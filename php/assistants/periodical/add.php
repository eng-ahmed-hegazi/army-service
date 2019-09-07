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
   
   if(!$_POST['assistant_id']){
       $assistantError = "من فضلك أختار الصف ضابط <br>";
   }else {
       $assistant_id = validateFormData($_POST['assistant_id']); 
   }
   
   if(!$_POST['date']){
       $dateError = "من فضلك حدد تاريخ النوبتجية<br>";
   }else {
       $date = validateFormData($_POST['date']); 
   }


   //if required filed have data 
   if( $assistant_id && $date ){

            $query = "INSERT INTO  assistantperiodical (assistant_id,date)
	VALUES ('$assistant_id', '$date')";
            $result = mysqli_query($conn, $query); 
           
       // if the query is success 
       if( $result ){
           // refresh page with query string
           header("Location: assistants.php?alert=success");
       }else{
           echo "Error: ".$query."<br>".mysqli_error($conn);
       } 
   }
   else{
       $requiredError = "<div class='alert alert-danger a' style='font-size: 18px'>من فضلك أدخل كل البيانات المطلوبة  *<a class='close' data-dismiss='alert'>&times;</a></div>";
   }
}
 // close the connection

 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
        <h2 class="page-header">إضافة نوبتجية لصف ضابط</h2>
		<?php
			echo $usedBefore;
			echo $requiredError;
			echo $invalidEmail;
		?>

        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
				
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
				<select class="form-control" name="assistant_id" id="assistant_id">
						<option value="">الإسم</option>
				<?php
				$query = "SELECT * FROM  assistant";
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
				<label for="assistant_id" class="col-sm-1 control-label">الإسم</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="date" name="date" >
					</div>
					<label for="date" class="col-sm-1 control-label" >تاريخ النوبتجية</label>
			  </div>
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="assistants.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">إضافة نوبتجية </button>
				  </div>
				</div>
            <div class="col-md-push-1 col-md-9">
                
            </div>
        </form>
     </div>
		  <?php include "../../../includes/footer/footer/footer.php";?>
  </body>
</html>
