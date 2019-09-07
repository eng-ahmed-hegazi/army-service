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
   $back_date = $vacancy_number = "" ;
   // check to see if input are  empty 
   // create the varrible with form data
   // wrap the data with our dunction
   
   if(!$_POST['back_date']){
       $back_dateError = "من فضلك حدد تاريخ النوبتجية<br>";
   }else {
       $back_date = validateFormData($_POST['back_date']); 
   }
  
   if(!$_POST['vacancy_number']){
       $vacancy_numberError = "من فضلك حدد تاريخ النوبتجية<br>";
   }else {
       $vacancy_number = validateFormData($_POST['vacancy_number']); 
   }
   

   //if required filed have data 
   if( $vacancy_number && $back_date ){
	
		$query = "INSERT INTO  vacancy (vacancy_number,back_date)
		VALUES ('$vacancy_number','$back_date')";
		$result = mysqli_query($conn, $query); 

       // if the query is success 
       if( $result ){
           // refresh page with query string
           header("Location: index.php?alert=success");
       }else{
          $usedBefore = "<div class='alert alert-danger a' style='font-size: 18px'>رقم الميدانية مستخدم مسبقا *<a class='close' data-dismiss='alert'>&times;</a></div>";
   
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
        <h2 class="page-header">إنشاء ميدانية</h2>
				
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
				<?php
					echo $usedBefore;
					echo $requiredError;
					echo $invalidEmail;
				?>

			<div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="vacancy_number" name="vacancy_number" placeholder="رقم الميدانية">
			    </div>
				<label for="vacancy_number" class="col-sm-1 control-label">رقم الميدانية</label>
				</div>
			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="date" class="form-control1" id="back_date" name="back_date" >
				</div>
				<label for="back_date" class="col-sm-1 control-label" >تاريخ العودة</label>
			</div>
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="index.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">إضافة أجازة </button>
				  </div>
				</div>
            <div class="col-md-push-1 col-md-9">
                
            </div>
        </form>
     </div>
		  <?php include "../../../includes/footer/footer/footer.php"; ?>
  </body>
</html>
