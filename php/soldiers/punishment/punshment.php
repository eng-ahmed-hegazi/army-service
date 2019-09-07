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
	$sarya = $_POST['sarya'];
	  header("Location: add.php?id=$sarya");
}
 // close the connection

 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
        <h2 class="page-header">من فضلك أختار السرية</h2>
		<?php
			echo $usedBefore;
			echo $requiredError;
			echo $_GET['id'];
		?>		
		<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="sarya" id="sarya">
					<option value="">السرية</option>
			      	<option value="1">أفراد</option>
			      	<option value="2">تدريب</option>
			      	<option value="3">عمليات</option>
			      	<option value="4">عق سلبى</option>
			      	<option value="5">إشارة</option>
			      	<option value="6">ش.ف</option>
			      	<option value="7">ش.أ</option>
			      	<option value="8">حملة</option>
			      	<option value="9">الكتيبة الأولى</option>
			      	<option value="10">الكتيبة الثانية</option>
			      	<option value="11">مستجد</option>
			      </select>  
					</div>
					<label for="sarya" class="col-sm-1 control-label">أختيار السرية أو الكتيبة</label>
			  </div>	
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="soldiers.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">أختيار </button>
				  </div>
				</div>
            </form>
     </div>
	  <?php include "../../../includes/footer/footer/footer.php"; ?>
  </body>
</html>