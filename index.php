<?php
// start the session
 session_start();
// disable notification & warning
 error_reporting(E_ALL & ~E_NOTICE && ~E_WARNING); 

// connect to database
include ("./includes/controls/db/connection.php");
// include functions.php
include ("./includes/controls/controls/functions.php");

if( isset( $_POST["login"])){
   // create the varribles
   // wrap data to validate function
   
   $formEmail = validateFormData($_POST['email']);
   $formPass  = validateFormData($_POST['password']);
   //create SQL query
   $query = "SELECT name, password FROM users
   WHERE email='$formEmail'";
   //store the result
   $result = mysqli_query($conn,$query);
   if (mysqli_num_rows($result) > 0){
     //store basic user data in varrible
       while( $row = mysqli_fetch_assoc($result) ){
         $name           = $row['name'];
         $hasedpassword  = $row['password'];
       }
     if($formPass == $hasedpassword){
         //correct login details
        //store data in session varribles
        $_SESSION['loggedInUser'] = $name;
        // redirect the user to client page
        header("Location: includes/controls/controls/dashboard.php");
     }else{
        // hashed password didn't verify 
         $loginError = "<div class='alert alert-danger'>wrong username / password combination .<a class='close' data-dismiss='alert'>&times;</a></div>";
     }
     //verify hashed password with the typed password
     /*if(password_verify($formPass , $hasedpassword)){
        //correct login details
        //store data in session varribles
        $_SESSION['loggedInUser'] = $name;
        // redirect the user to client page
        header("Location: clients.php");
     }else{
        // hashed password didn't verify 
         $loginError = "<div class='alert alert-danger'>wrong username / password combination .<a class='close' data-dismiss='alert'>&times;</a></div>";
     }*/
   }else{
       // there are no result in database
       $loginError = "<div class='alert alert-danger'>no such user in database pleaze try again .<a class='close' data-dismiss='alert'>&times;</a></div>"; 
   }
 }
 // close the connection
 mysqli_close($conn);
 // include the header
 include ("./includes/header.php");
?>
<html lang="en">
<head>
    <title>Client Address Book</title>
    <meta charset="utf-8">
    <!--meta for meadia query to responsive app-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--meta for internet explorar-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
  <body style="direction:rtl">
      <div class="container">
        <div class="row">
			<div class="col-md-push-4 text-center col-md-4">
			<h2>دخــــــــــــول</h2>
			
			<img src="img/Picture.gif" class="img-responsive">
			
		</div>  
		</div>
        
		
        <div class="row">
			<div class="col-md-push-4 col-md-4 text-center">
			
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" class="form" method="post"> 
			<div class="form-group">
                <?php echo $loginError; ?>
                <label for="login-email" class="sr-only"></label>
                <input type="text" id="login-email" style="text-align:center" class="form-control" name="email" placeholder="أدخل أسم المستخدم" value="<?php echo $formEmail?>"/>
            </div>
            <div class="form-group">
                <label for="login-password" class="sr-only">كلمة السر</label>
                <input type="password" id="login-password" style="text-align:center" class="form-control" name="password" placeholder="أدخل كلمة السر"/>
            </div>
            <input type="submit" class="btn btn-primary btn-sm" 
			style="margin-top:15px auto;" name="login" value="دخــــول" />
        </form>
			</div>
		</div>
      </div>
      
      <!--JQUERY JS FILE LINK-->
      <script src="js/jquery.min.js"></script>
      <!--BOOTSTRAP JS LINK FILE-->
      <script src="js/bootstrap.min.js"></script>
  </body>
</html>