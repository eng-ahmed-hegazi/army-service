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
   $mNumber = $degree = $punit = $sarya = $crew =  $availability = $title = $volunteer_date = $addedDate =  "";
   // check to see if input are  empty 
   // create the varrible with form data
   // wrap the data with our dunction
   
   if(!$_POST['mNumber']){
       $mNumberError = "من فضلك أدخل الرقم العسكرى <br>";
   }else {
       $mNumber = validateFormData($_POST['mNumber']); 
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
   $sarya = validateFormData($_POST['sarya']); 
   $taskeen   = validateFormData($_POST['taskeen']);
   $crew   = validateFormData($_POST['crew']);
   $availability   = validateFormData($_POST['availability']);
   $title   = validateFormData($_POST['title']);
   $volunteer_date   = validateFormData($_POST['volunteer_date']);
   $addedDate   = validateFormData($_POST['addedDate']);
   

   //if required filed have data 
   if( $mNumber && $name ){
       
       $PreventDublication = "SELECT mNumber FROM assistant WHERE mNumber='$mNumber'";
       $data = mysqli_query($conn , $PreventDublication);
       if( mysqli_num_rows($data) == 0) {
           
            //create a query 
            $query = "INSERT INTO assistant (name,mNumber,degree,punit,sarya,taskeen,crew,title,volunteer_date,addedDate)
	VALUES ('$name', '$mNumber', '$degree','$punit','$sarya','$taskeen','$crew','$title','$volunteer_date','$addedDate')";
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
           $usedBefore =  "<div class='alert alert-danger'>هذا الرقم العسكرى مستحدم من قبل </div>";
       }
   }
   else{
       $requiredError = "<div class='alert alert-danger a' style='font-size: 18px'>من فضلك أدخل كل البيانات المطلوبة  *<a class='close' data-dismiss='alert'>&times;</a></div>";
   }
}
 // close the connection
 mysqli_close($conn);
 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
	<?php
		echo $usedBefore;
		echo $requiredError;
		echo $invalidEmail;
	?>
        <h2 class="page-header">إضافـــــة صف ضابط</h2>
				
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
					<select class="form-control" name="degree" id="degree">
						<option value="">الدرجة</option>
						<option value="1">عريف</option>
						<option value="2">رقيب</option>
						<option value="3">رقيب أول</option>
						<option value="4">مساعد</option>
						<option value="5">مساعد أول</option>
					</select>  
				</div>
				<label for="degree" class="col-sm-1 control-label">درجة</label>
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
			      </select>  
					</div>
					<label for="punit" class="col-sm-1 control-label">الوحدة الفرعية</label>
			  </div>
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
			      	<option value="9">منوب</option>
			      </select>  
					</div>
					<label for="sarya" class="col-sm-1 control-label">السرية</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="taskeen" id="taskeen">
			      	<option value="">التسكين</option>
			      	<option value="1">قيادة الفوج</option>
			      	<option value="2">الكتيبة الأولى</option>
			      	<option value="3">الكتيبةالثانية</option>
			      </select>   
					</div>
					<label for="taskeen" class="col-sm-1 control-label">التسكين</label>
			  </div>

				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="crew" id="crew">
			      	<option value="">طقم النوبتجية</option>
			      	<option value="0">لا يوجد</option>
			      	<option value="1">مساعد ض نوبتجى</option>
			      	<option value="2">حكمدار سلاح وذخيرة</option>
			      	<option value="3">حكمدار بوابة وسجن</option>
			      	<option value="4">حكمدار خفيف حركة</option>
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
					<label for="volunteer_date" class="col-sm-1 control-label"> تاريخ التطوع</label>
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
					<a href="assistants.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">إضافة الصف ضابط</button>
				  </div>
				</div>
            <div class="col-md-push-1 col-md-9">
                
            </div>
        </form>
     </div>
		  <?php include "../../../includes/footer/footer/footer.php";?>
  </body>
</html>
