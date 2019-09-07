<?php
// start the session
 session_start();
// disable notification & warning
 error_reporting(E_ALL & ~E_NOTICE && ~E_WARNING); 
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}
########################################
# get the ID send by the GET collection 
########################################
$soldierID = $_GET['id'];

// connect to database
include ("../../../includes/controls/db/connection.php");
// include functions.php
include ("../../../includes/controls/controls/functions.php");

//query the data using the reseved clientID
$query = "SELECT * FROM  soldier WHERE id='$soldierID'";
$result = mysqli_query($conn, $query);

// if the result is re4turned
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        
        $mNumber    = $row['mNumber'];
        $name   = $row['name'];
        $degree   = $row['degree'];
        $punit = $row['punit'];
        $sarya = $row['sarya']; 
        $taskeen   = $row['taskeen'];
        $vacancy_id   = $row['vacancy_id'];
        $availability   = $row['availability'];
        $title   = $row['title'];
        $startDate   = $row['startDate'];
        $endDate   = $row['endDate'];
    }
    
}else{
    // no result returned
    $alertMessage = "<div class='alert alert-success'>لا توجد نتيجة<a href='' data-dismiss='alert' class='close pull-left'>&times;</a></div>";
}

// if the update buttom is pressed
if( isset( $_POST['update'] ) ){

    $mNumber = validateFormData($_POST['mNumber']); 
    $name = validateFormData($_POST['name']); 
    $degree   = validateFormData($_POST['degree']);
    $punit = validateFormData($_POST['punit']);
    $sarya = validateFormData($_POST['sarya']); 
    $taskeen   = validateFormData($_POST['taskeen']);
    $vacancy_id   = $_POST['vacancy_id'];
    $availability   = validateFormData($_POST['availability']);
    $title   = validateFormData($_POST['title']);
    $startDate   = validateFormData($_POST['startDate']);
    $endDate   = validateFormData($_POST['endDate']);
    
       // new database query & result
       $query = "UPDATE soldier SET name = '$name',"
       ."mNumber = '$mNumber',"
       ."degree = '$degree',"
       ."punit = '$punit',"
       ."sarya = '$sarya',"
       ."taskeen = '$taskeen' ,"
       ."vacancy_id = '$vacancy_id',"
       ."title = '$title' ,"
       ."startDate = '$startDate',"
       ."endDate = '$endDate' WHERE id = $soldierID";
       
    if(mysqli_query($conn,$query)){
        header("Location: soldiers.php");
    }else{
        echo mysqli_error($conn);
    }
    //header("Location: soldiers.php");
}

// if the update buttom is pressed
if( isset($_POST['delete'] ) ){
    $alertMessage = "<div class='alert alert-danger'>
        <h5>هل أنت متأكد من حذف العنصر ...</h5>
        <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=$soldierID' method='post'>
            <input type='submit' class='btn btn-danger' name='confirm-delete' value='مسح '>
            <a type='button' class='btn btn-primary' data-dismiss='alert'>لا شكرا</a>
        </form>
    </div>";
    
}
if(isset( $_POST['confirm-delete'] )){
           // new database query & result
            $query = "DELETE FROM soldier WHERE id='$soldierID'";
            $result = mysqli_query($conn,$query);
            if($result){
                header("Location: soldiers.php");
            }else{
                echo "<div class='alert alert-danger'>خطــــــأ </div>";
            }
          //header("Location: clients.php");
      }


 // close the connection 
 // include the header
 include ("../../../includes/header/header/header.php");
    ?>
<div class="container">

        <h2 class="page-header">تعديل جندى</h2>
		<?php echo $alertMessage; ?>
		<?php
			echo $usedBefore;
			echo $requiredError;
			echo $invalidEmail;
			
		?>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
            <div class="form-group">
						
				<div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control" id="mNumber" name="mNumber" placeholder="الرقم العسكرى" value="<?php echo $mNumber; ?>">
			    </div>
				<label for="mNumber" class="col-sm-1 control-label">رقم عسكرى</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
					<select class="form-control" name="degree" id="degree" value="<?php echo $degree; ?>">
						<option value="">الدرجة</option>
						<option value="1" <?php if ($degree==1) echo "selected" ?> >جندى</option>
						<option value="2" <?php if ($degree==2) echo "selected" ?> >عريف مجند</option>
						<option value="3" <?php if ($degree==3) echo "selected" ?> >رقيب مجند</option>
					</select>  
				</div>
				<label for="degree" class="col-sm-1 control-label">درجة</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control" id="name" name="name" placeholder="الأسم" value="<?php echo $name; ?>">
			    </div>
				<label for="name" class="col-sm-1 control-label">الأسم</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="punit" id="punit" >
			      	<option value="">الوحدة الفرعية</option>
			      	<option value="1" <?php if ($punit==1) echo "selected" ?> >قيادة الفوج</option>
			      	<option value="2" <?php if ($punit==2) echo "selected" ?> >الكتيبة الأولى</option>
			      	<option value="3" <?php if ($punit==3) echo "selected" ?> >الكتيبةالثانية</option>
			      	<option value="4" <?php if ($punit==4) echo "selected" ?> >مستجد</option>
			      </select>  
					</div>
					<label for="punit" class="col-sm-1 control-label">الوحدة الفرعية</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="sarya" id="sarya">
			      	<option value="">السرية</option>
			      	<option value="1" <?php if ($sarya==1) echo "selected" ?> >أفراد</option>
			      	<option value="2" <?php if ($sarya==2) echo "selected" ?> >تدريب</option>
			      	<option value="3" <?php if ($sarya==3) echo "selected" ?> >عمليات</option>
			      	<option value="4" <?php if ($sarya==4) echo "selected" ?> >عق سلبى</option>
			      	<option value="5" <?php if ($sarya==5) echo "selected" ?> >إشارة</option>
			      	<option value="6" <?php if ($sarya==6) echo "selected" ?> >ش.ف</option>
			      	<option value="7" <?php if ($sarya==7) echo "selected" ?> >ش.أ</option>
			      	<option value="8" <?php if ($sarya==8) echo "selected" ?> >حملة</option>
			      	<option value="9" <?php if ($sarya==9) echo "selected" ?> >منوب</option>
			      </select>  
					</div>
					<label for="sarya" class="col-sm-1 control-label" >السرية</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="taskeen" id="taskeen">
			      	<option value="">التسكين</option>
			      	<option value="1" <?php if ($taskeen==1) echo "selected" ?> >قيادة الفوج</option>
			      	<option value="2" <?php if ($taskeen==2) echo "selected" ?> >الكتيبة الأولى</option>
			      	<option value="3" <?php if ($taskeen==3) echo "selected" ?> >الكتيبةالثانية</option>
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
					$query = "SELECT * FROM vacancy ORDER BY vacancy_number";
					$result = mysqli_query( $conn, $query );
					if( mysqli_num_rows($result) > 0){
	  
						$i=0;
					 while ($row = mysqli_fetch_assoc($result)) {
						$i++;
						$date=date_create($row['back_date']);
						
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
						if ($vacancy_id==$row['vacancy_number']) {
						echo "<option value=".$row['vacancy_number']." selected >".$vNumber."</option>";
						}else{
						echo "<option value=".$row['vacancy_number'].">".$vNumber."</option>";
						}
						}
						}
					?>
			      	
			      </select>   
					</div>
					<label for="vacancy_id" class="col-sm-1 control-label">الميدانية</label>
				</div>
				<div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="title" name="title" placeholder="العنوان" value="<?php echo $title; ?>">
			    </div>
				<label for="title" class="col-sm-1 control-label">العنوان</label>
			  </div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="startDate" name="startDate" placeholder="الأسم" value="<?php echo $startDate; ?>">
					</div>
					<label for="startDate" class="col-sm-1 control-label">تاريح التجنيد</label>
			  </div>
				<div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="endDate" name="endDate" placeholder="الأسم" value="<?php echo $endDate; ?>">
					</div>
					<label for="endDate" class="col-sm-1 control-label">تاريخ التسريح</label>
			  </div>
			   <div class="form-group">        
				  <div class="col-sm-10">
                    <a href="soldiers.php" type="button" class="btn btn-default">إلغاء</a>
                    <button type="submit" class="btn btn-success " name="update">تعديل</button>
					<button type="submit" class="btn btn-danger" name="delete" >حذف</button>
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