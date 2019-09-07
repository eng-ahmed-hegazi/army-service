<?php
session_start();
?>
<html>
<head>
    <title>منظومة خدمة وأجازات</title>
    <meta charset="utf-8">
    <!--meta for media query to responsive app-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--meta for internet explorar-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/style.css">

</head>
  <body style="direction:rtl"> 
		<nav class="navbar navbar-default"  style="background: #fff">
		  <div class="container" style="background: rgb(255, 255, 255);">
			<div class="navbar-header">
			  <a class="navbar-brand" href="../../../includes/controls/controls/dashboard.php" style="font-size:25px">المنـ<span style="color:rgb(146, 0, 0);font-size:25px">ظو</span>مة</a>
			</div>
			
			<?php if(isset($_SESSION['loggedInUser'])){
				?>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="../../../includes/controls/controls/logout.php" style="font-size: 12px"><span class="glyphicon glyphicon-log-in"></span> خــــروج</a></li>
				</ul>
				<?php }else{ ?>
				<ul class="nav navbar-nav navbar-right">
				  <li><a href="index.php" style="font-size: 12px"><span class="glyphicon glyphicon-log-in"></span> دخــــول</a></li>
				</ul>
			<?php } ?>
				<div class="clearfix"></div>
				<?php if(isset($_SESSION['loggedInUser'])){
				?>
				</div>
				<div class="container-fluid"  style="background: #ddd;">
			<ul class="nav navbar-nav pull-right text-right">
				<li><a href="../../../php/actions/periodicals/service.php" class="text-right" style="font-size: 12px">الخدمات</a></li> 
				<li class="dropdown">
				<a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">النماذج
					<span class="caret  text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/soldiers/prototypes/soldiers.php" class="text-right">نماذج الضباط</a></li>
						<li><a href="../../../php/assistants/prototypes/assistants.php" class="text-right">نماذج الصف ضباط</a></li>
						<li><a href="../../../php/officers/prototypes/officers.php" class="text-right">نماذج المجندين</a></li>	
					</ul>
				</li>
				<li class="dropdown">
				<a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">الوظائف
					<span class="caret  text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/officers/jobs/officers.php" class="text-right">وظائف الضباط</a></li>
						<li><a href="../../../php/assistants/jobs/assistants.php" class="text-right">وظائف الصف ضباط</a></li>
						<li><a href="../../../php/soldiers/jobs/soldiers.php" class="text-right">وظائف المجندين</a></li>	
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">النوبتجيات
					<span class="caret  text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/assistants/periodical/assistants.php" class="text-right">نوبتجيات صف ضباط</a></li>
						<li><a href="../../../php/officers/periodical/officers.php"  class="text-right">نوبتجيات ضباط</a></li>
						<li><a href="../../../php/actions/periodicals/orders.php" class="text-right" style="font-size: 12px">ورقة الأوامر</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">العقوبات
					<span class="caret  text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/officers/punishment/officers.php"  class="text-right">عقوبات ضباط</a></li>
						<li><a href="../../../php/soldiers/punishment/soldiers.php" class="text-right">عقوبات جنود</a></li>
						<li><a href="../../../php/assistants/punishment/assistants.php" class="text-right">عقوبات صف ضباط</a></li>
						<li><a href="../../../php/actions/punishment/punishment.php" class="text-right">كشف العقوبات</a></li>
						<li><a href="../../../php/soldiers/absent/soldiers.php" class="text-right">غياب وسجن حربى مجندين</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">التمامات
					<span class="caret  text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/actions/tamam/officers.php"  class="text-right">تمام الضباط</a></li>
						<li><a href="../../../php/actions/tamam/assistants.php"  class="text-right">تمام الصف ضباط</a></li>
						<li><a href="../../../php/actions/tamam/soldiers.php"  class="text-right">تمام المجندين</a></li>
						<li><a href="../../../php/actions/tamam/morning.php"  class="text-right">التمام الصباحى</a></li>
						<li><a href="../../../php/actions/tamam/partial.php"  class="text-right">تمام الوحدات الفرعية</a></li>
						<li><a href="../../../php/actions/tamam/administration.php"  class="text-right">تمام الإدارة</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">المأموريات والفرق
					<span class="caret  text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/officers/outs/officers.php" class="text-right">مأموريات وفرق ضباط</a></</li>
						<li><a href="../../../php/assistants/outs/assistants.php"  class="text-right">مأموريات وفرق صف </a></li>
						<li><a href="../../../php/soldiers/outs/soldiers.php" class="text-right">مأموريات وفرق جنود</a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" style="font-size: 12px" data-toggle="dropdown" href="#">الأجازات
					<span class="caret text-left"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../../../php/officers/vacancy/officers.php" class="text-right"> أجازات ضباط</a></li>
						<li><a href="../../../php/assistants/vacancy/assistants.php" class="text-right"> أجازات صف ضباط</a></li>
						<li><a href="../../../php/soldiers/vacancy/soldiers.php" class="text-right"> أجازات جنود</a></li>
						<li><a href="../../../php/actions/vacancy/vacancy.php" class="text-right">الميدانيات</a></li>

					</ul>
				</li>
				
				<li><a href="../../../php/officers/officers/officers.php" class="text-right">الضباط</a></li>
				<li><a href="../../../php/assistants/assistants/assistants.php"  class="text-right">الصف ضباط</a></li>
				<li><a href="../../../php/soldiers/soldiers/soldiers.php" class="text-right">الجنود</a></li>
				
				<?php } ?>
				</ul>
			
		  </div>
		</nav> 
		<div class="container-fluid"> 
		<?php if(isset($_SESSION['loggedInUser'])){
				?>
		
		  <?php } ?>
		  <div class="btn-group pull-right text-right">
		  </div>
		</div>
		<div style="min-height:450px">
 