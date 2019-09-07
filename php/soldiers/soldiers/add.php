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
   $mNumber = $degree = $punit = $sarya = $vacancy_id =  $availability = $title = $startDate = $endDate =  "";
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
   $vacancy_id   = validateFormData($_POST['vacancy_id']);
   $availability   = validateFormData($_POST['availability']);
   $title   = validateFormData($_POST['title']);
   $startDate   = validateFormData($_POST['startDate']);
   $endDate   = validateFormData($_POST['endDate']);
   

   //if required filed have data 
   if( $mNumber && $name ){
       
       $PreventDublication = "SELECT mNumber FROM soldier WHERE mNumber='$mNumber'";
       $data = mysqli_query($conn , $PreventDublication);
       if( mysqli_num_rows($data) == 0) {
           
            //create a query 
            $query = "INSERT INTO soldier (name,mNumber,degree,punit,sarya,taskeen,vacancy_id,title,startDate,endDate)
	VALUES ('$name', '$mNumber', '$degree','$punit','$sarya','$taskeen','$vacancy_id','$title','$startDate','$endDate')";
            $result = mysqli_query($conn, $query); 
           
       // if the query is success 
       if( $result ){
           // refresh page with query string
           header("Location: soldiers.php?alert=success");
       }else{
           echo "Error: ".$query."<br>".mysqli_error($conn);
       }
       }
       else{
           $usedBefore =  "<div class='alert alert-danger'>هذا الرقم العسكرى مستحدم من قبل </div>";
       }
   }
   else{
       $requiredError = "<div class='alert alert-danger a' style='font-size: 18px'>Name & Email fildes are required .<a class='close' data-dismiss='alert'>&times;</a></div>";
   }
}
 // close the connection

 // include the header
 include ("../../../includes/header/header/header.php");
       
    ?>
<div class="container">
        <h2 class="page-header">إضافـــــة جندى</h2>
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
					<select class="form-control" name="degree" id="degree">
						<option value="">الدرجة</option>
						<option value="1">جندى</option>
						<option value="2">عريف مجند</option>
						<option value="3">رقيب مجند</option>
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
				<span class=text-danger"><?php echo $nameError;?></span>
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
			    <select class="form-control" name="vacancy_id" id="vacancy_id">
			      	<option value="">الميدانية</option>
			      	<?php
					$query2 = "SELECT * FROM  vacancy";
					$result2 = mysqli_query($conn , $query2);
					if( mysqli_num_rows($result2) > 0){
						
						while ($row = mysqli_fetch_assoc($result2)) {
						$vNumber = $row['vacancy_number'];
							switch($vNumber){
								case 1:
									$vNumber = 'الأولى';
								break;
								case 2:
									$vNumber = 'الثانية';
								break;
								case 3:
									$vNumber = 'الثالثة';
								break;
								case 4:
									$vNumber = 'الرابعة';
								break;
								case 5:
									$vNumber = 'الخامسة';
								break;
								case 6:
									$vNumber = 'السادسة';
								break;
								case 7:
									$vNumber = 'السابعة';
								break;
							}
							echo "<option value=".$row['vacancy_number'].">".$vNumber."</option>";
						}		
					}
					mysqli_close($conn);					
					?>
			      </select>   
					</div>
					<label for="vacancy_id" class="col-sm-1 control-label">الميدانية</label>
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
					  <input type="date" class="form-control1" id="startDate" name="startDate" placeholder="الأسم">
					</div>
					<label for="startDate" class="col-sm-1 control-label">تاريح التجنيد</label>
			  </div>
				<div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="endDate" name="endDate" placeholder="الأسم">
					</div>
					<label for="endDate" class="col-sm-1 control-label">تاريخ التسريح</label>
			  </div>
			   <div class="form-group">        
				  <div class="col-sm-10">
					<a href="soldiers.php" type="button" class="btn btn-default">إلغاء</a>
					<button type="submit" class="btn btn-success" name="add">إضافـــــة الجندى</button>
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
