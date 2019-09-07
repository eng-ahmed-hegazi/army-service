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
   $mNumber = $degree = $punit = $oNumber = $crew =  $job = $title = $volunteer_date = $addedDate =  "";
   // check to see if input are  empty 
   // create the varrible with form data
   // wrap the data with our dunction
   
   if(!$_POST['mNumber']){
       $mNumberError = "من فضلك أدخل الرقم العسكرى <br>";
   }else {
       $mNumber = validateFormData($_POST['mNumber']); 
   }
   
   if(!$_POST['oNumber']){
       $oNumberError = "من فضلك أدخل رقم الأقدمية <br>";
   }else {
       $oNumber = validateFormData($_POST['mNumber']); 
   }
   
   if(!$_POST['name']){
       $nameError = "من فضلك أدخل الأســـم<br>";
   }else {
       $name = validateFormData($_POST['name']); 
   }
   
   // thes inputs are not required 
   // so we will just store whate ever has been entered
   $degree   = validateFormData($_POST['degree']);
   $punit = validateFormData($_POST['punit']);
   $job = validateFormData($_POST['job']);
   $crew   = validateFormData($_POST['crew']);
   $title   = validateFormData($_POST['title']);
   $volunteer_date   = validateFormData($_POST['volunteer_date']);
   $addedDate   = validateFormData($_POST['addedDate']);
   

   //if required filed have data 
   if( $mNumber && $oNumber && $name ){
       
       $PreventDublicationmNumber = "SELECT mNumber FROM officer WHERE mNumber='$mNumber'";
       $PreventDublicationoNumber = "SELECT oNumber FROM officer WHERE oNumber='$oNumber'";
       $datamNumber = mysqli_query($conn , $PreventDublicationmNumber);
       $dataoNumber = mysqli_query($conn , $PreventDublicationoNumber);
       if( mysqli_num_rows($datamNumber) == 0 && mysqli_num_rows($dataoNumber) == 0) {
           
            //create a query 
            $query = "INSERT INTO officer (name,mNumber,oNumber,degree,punit,job,crew,title,volunteer_date,addedDate)
	VALUES ('$name', '$mNumber', '$oNumber', '$degree','$punit','$job','$crew','$title','$volunteer_date','$addedDate')";
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
           $usedBefore =  "<div class='alert alert-danger'>هذا الرقم العسكرى مستحدم من قبل </div>";
       }
   }
   else{
       $requiredError = "<div class='alert alert-danger a' style='font-size: 18px'>  الرقم العسكرى والأسم و رقم الأقدمية مطلوبين *<a class='close pull-left' data-dismiss='alert'>&times;</a></div>";
   }
}
 // close the connection
 mysqli_close($conn);
 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
        <h2 class="page-header"> إضافة ضابط </h2>
		<?php
			echo $usedBefore;
			echo $requiredError;
			echo $invalidEmail;
		?>		
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
				
			  <div class="form-group">	
				<div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control" id="mNumber" name="mNumber" placeholder="الرقم العسكرى">
			    </div>
				<label for="mNumber" class="col-sm-1 control-label">رقم عسكرى</label>
			  </div>
			  <div class="form-group">	
				<div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control" id="oNumber" name="oNumber" placeholder="رقم الأقدمية">
			    </div>
				<label for="oNumber" class="col-sm-1 control-label">رقم الأقدمية</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
					<select class="form-control" name="degree" id="degree">
						<option value="">الرتبة</option>
						<option value="1">ملازم </option>
						<option value="2">ملازم أول</option>
						<option value="3">نقيب</option>
						<option value="4">رائد</option>
						<option value="5">مقدم</option>
						<option value="6">عقيد</option>
						<option value="7">عميد</option>
						<option value="8">لواء</option>
					</select>  
				</div>
				<label for="degree" class="col-sm-1 control-label">رتبة</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control" id="name" name="name" placeholder="الأسم">
			    </div>
				<label for="name" class="col-sm-1 control-label">الأسم</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="punit" id="punit">
			      	<option value="">الوحدة الفرعية</option>
			      	<option value="1">قيادة الفوج</option>
			      	<option value="2">الكتيبة الأولى</option>
			      	<option value="3">الكتيبةالثانية</option>
			      	<option value="4">مستجد</option>
			      </select>  
					</div>
					<label for="punit" class="col-sm-1 control-label">الوحدة الفرعية</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="job" id="job">
			      	<option value="">الوظيفة</option>
			      	<option value="1">لا يوجد</option>
			      	<option value="2">رئيس الشئون الإدارية</option>
			      	<option value="3">رئيس قسم الإشارة</option>
			      	<option value="4">رئيس قسم التنظيم والإدارة</option>
			      	<option value="5">رئيس قسم التأمين الفنى </option>
			      	<option value="6">رئيس قسم العمليات والتدريب</option>
			      	<option value="7">قائد مركز العمليات</option>
			      	<option value="8">قائد سرية عق سلبي</option>
			      	<option value="9">قائد ف1/عق سلبى</option>
			      	<option value="10">قائد ورشة إصلاح مركبات</option>
			      	<option value="11">قائد س1 عق راد</option>
			      	<option value="12">قائد ف1س1 عق راد</option>
			      	<option value="13">قا ف3 س1 عق راد</option>
			      	<option value="14">قائد ف1س2 عق راد</option>
			      	<option value="15">قائد س 2ك2 عق راد</option>
			      	<option value="16">رئيس عمليات الكتيبة الأولى</option>
					<option value="17">رئيس عمليات الكتيبة الثانية</option>
					<option value="18">قائد الكتيبة الثانية</option>
					<option value="19">قائد الكتيبة الأولى</option>
					<option value="20">رئيس عمليات الفوج </option>
					<option value="21">قائد ثانى الفوج</option>
					<option value="22">قائد الفوج</option>
			      </select>   
					</div>
					<label for="job" class="col-sm-1 control-label">الوظيفة</label>
			  </div>

				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="crew" id="crew">
			      	<option value="">طقم النوبتجية</option>
			      	<option value="0">لا يوجد</option>
			      	<option value="1">ضابط نوبتجى وحريق</option>
			      	<option value="2">ضابط عظيم وخفيف حركة</option>
			      	<option value="3">محطة الجبل الأحمر العسكرية</option>
			      	<option value="4">ضابط منوب</option>
			      	<option value="5">قائد منوب</option>
			      </select>   
					</div>
					<label for="crew" class="col-sm-1 control-label">طقم النوبتجية</label>
				</div>
				<div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="title" name="title" placeholder="العنوان">
			    </div>
				<label for="title" class="col-sm-1 control-label">العنوان</label>
			  </div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="volunteer_date" name="volunteer_date" placeholder="الأسم">
					</div>
					<label for="volunteer_date" class="col-sm-1 control-label"> تاريخ بداية الخدمة</label>
			  </div>
				<div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="addedDate" name="addedDate" placeholder="الأسم">
					</div>
					<label for="addedDate" class="col-sm-1 control-label">تاريخ الضم على الوحدة</label>
			  </div>
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="officers.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">إضافة ضابط</button>
				  </div>
				</div>
            <div class="col-md-push-1 col-md-9">
                
            </div>
        </form>
     </div>
		  <?php
				include "../../../includes/footer/footer/footer.php";
			?>
      <!--JQUERY JS FILE LINK-->
      <script src="../js/jquery.min.js"></script>
      <!--BOOTSTRAP JS LINK FILE-->
      <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
