<?php
  error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 error_reporting(E_ALL & ~E_WARNING);


  if(isset($_COOKIE[session_name()])){
    //empty the cookies
    setcookie(session_name(),'',time()-86400,'/');
  }
    //clear all session varribles
    session_unset();
    //destroy all session varribles
    session_destroy();
?>
<html lang="en">
<head>
        <meta charset="utf-8">
    <!--meta for media query to responsive app-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--meta for internet explorar-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
  <body>
  <nav class="navbar navbar-default">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">نظام الخدمة والأجازات</a>
			</div>
			<?php if(isset($_SESSION['loggedInUser'])){
				?>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="register.php" style="font-size: 18px"><span class="glyphicon glyphicon-user"></span>أدمــــن</a></li>
					<li><a href="logout.php" style="font-size: 18px"><span class="glyphicon glyphicon-log-in"></span>خــــروج</a></li>
				</ul>
	
			<?php } ?>
		  </div>
		</nav> 
    <div class="container">
         <h2 class="page-header">تم الخروج من النظام</h2>
         <p><span class="glyphicon glyphicon-globe"></span>  شكرا لك</p>
		 <a href="../../../index.php" class="btn btn-primary">دخــــول</a>
         <?php 
           header("Location=index.php");
         ?>
         <!--JQUERY JS FILE LINK-->
         <script src="../../../js/jquery.min.js"></script>
         <!--BOOTSTRAP JS LINK FILE-->
         <script src="../../../js/bootstrap.min.js"></script>
    </div>
  </body>
</html>