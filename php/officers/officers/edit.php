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
$officerID = $_GET['id'];

// connect to database
include ("../../../includes/controls/db/connection.php");
// include functions.php
include ("../../../includes/controls/controls/functions.php");

//query the data using the reseved clientID
$query = "SELECT * FROM  officer WHERE id='$officerID'";
$result = mysqli_query($conn, $query);

// if the result is re4turned
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        
        $mNumber    = $row['mNumber'];
        $oNumber    = $row['oNumber'];
        $name   = $row['name'];
        $degree   = $row['degree'];
        $punit = $row['punit']; 
        $job   = $row['job'];
        $crew   = $row['crew'];
        $title   = $row['title'];
        $volunteer_date   = $row['volunteer_date'];
        $addedDate   = $row['addedDate'];
    }
    
}else{
    // no result returned
    $alertMessage = "<div class='alert alert-success'>لا توجد نتيجة<a href='' data-dismiss='alert' class='close pull-left'>&times;</a></div>";
}

// if the update buttom is pressed
if( isset( $_POST['update'] ) ){

    $mNumber = validateFormData($_POST['mNumber']); 
    $oNumber = validateFormData($_POST['oNumber']); 
    $name = validateFormData($_POST['name']); 
    $degree   = validateFormData($_POST['degree']);
    $punit = validateFormData($_POST['punit']);
    $job   = validateFormData($_POST['job']);
    $crew   = validateFormData($_POST['crew']);
    $title   = validateFormData($_POST['title']);
    $volunteer_date   = validateFormData($_POST['volunteer_date']);
    $addedDate   = validateFormData($_POST['addedDate']);
    
       // new database query & result
       $query = "UPDATE officer SET name = '$name',"
       ."mNumber = '$mNumber',"
       ."oNumber = '$oNumber',"
       ."degree = '$degree',"
       ."punit = '$punit',"
       ."job = '$job' ,"
       ."crew = '$crew',"
       ."title = '$title' ,"
       ."volunteer_date = '$volunteer_date',"
       ."addedDate = '$addedDate' WHERE id = $officerID";
       
    if(mysqli_query($conn,$query)){
        header("Location: officers.php");
    }else{
        echo mysqli_error($conn);
    }
    //header("Location: soldiers.php");
}
	
// if the update buttom is pressed
if( isset($_POST['delete'] ) ){
$alertMessage = "<div class='alert alert-danger'>
        <h5>هل أنت متأكد من حذف العنصر ...</h5>
        <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=$officerID' method='post'>
            <input type='submit' class='btn btn-danger' name='confirm-delete' value='مسح '>
            <a type='button' class='btn btn-primary' data-dismiss='alert' name='no-thanks'>لا شكرا</a>
        </form>
    </div>";

    
}
if(isset( $_POST['confirm-delete'] )){
           // new database query & result
            $query = "DELETE FROM officer WHERE id='$officerID'";
            $result = mysqli_query($conn,$query);
            if($result){
                header("Location: officers.php");
            }else{
                echo "<div class='alert alert-danger'>خطــــــأ </div>";
            }
          //header("Location: clients.php");
      }
if(isset( $_POST['no-thanks'] )){
	unset($_POST['delete']);
}

 // close the connection
 mysqli_close($conn);
 // include the header
 include ("../../../includes/header/header/header.php");
    ?>
<div class="container">

        <h2 class="page-header">تعديل بيانات ضابط</h2>
		<?php echo $alertMessage; ?>	
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
            <?php
					echo $usedBefore;
					echo $requiredError;
                    echo $invalidEmail;
                    
			?>
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
			      <input type="text" class="form-control" id="oNumber" name="oNumber" placeholder="رقم الأقدمية" value="<?php echo $oNumber; ?>">
			    </div>
				<label for="oNumber" class="col-sm-1 control-label">رقم أقدمية</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
					<select class="form-control" name="degree" id="degree">
						<option value="">الرتبة</option>
						<option value="1" <?php if ($degree==1) echo "selected" ?>>ملازم </option>
						<option value="2" <?php if ($degree==2) echo "selected" ?>>ملازم أول</option>
						<option value="3" <?php if ($degree==3) echo "selected" ?>>نقيب</option>
						<option value="4" <?php if ($degree==4) echo "selected" ?>>رائد</option>
						<option value="5" <?php if ($degree==5) echo "selected" ?>>مقدم</option>
						<option value="6" <?php if ($degree==6) echo "selected" ?>>عقيد</option>
						<option value="7" <?php if ($degree==7) echo "selected" ?>>عميد</option>
						<option value="8" <?php if ($degree==8) echo "selected" ?>>لواء</option>
					</select>  
				</div>
				<label for="degree" class="col-sm-1 control-label">رتبة</label>
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
			      	<option value="3" <?php if ($punit==4) echo "selected" ?> >مستجد</option>
			      </select>  
					</div>
					<label for="punit" class="col-sm-1 control-label">الوحدة الفرعية</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="job" id="job">
			      	<option value="">الوظيفة</option>
			      	<option value="1" <?php if ($job==1) echo "selected" ?>>لا يوجد</option>
			      	<option value="2" <?php if ($job==2) echo "selected" ?>>رئيس الشئون الإدارية</option>
			      	<option value="3" <?php if ($job==3) echo "selected" ?>>رئيس قسم الإشارة</option>
			      	<option value="4" <?php if ($job==4) echo "selected" ?>>رئيس قسم التنظيم والإدارة</option>
			      	<option value="5" <?php if ($job==5) echo "selected" ?>>رئيس قسم التأمين الفنى </option>
			      	<option value="6" <?php if ($job==6) echo "selected" ?>>رئيس قسم العمليات والتدريب</option>
			      	<option value="7" <?php if ($job==7) echo "selected" ?>>قائد مركز العمليات</option>
			      	<option value="8" <?php if ($job==8) echo "selected" ?>>قائد سرية عق سلبي</option>
			      	<option value="9" <?php if ($job==9) echo "selected" ?>>قائد ف1/عق سلبى</option>
			      	<option value="10"<?php if ($job==10) echo "selected" ?>>قائد ورشة إصلاح مركبات</option>
			      	<option value="11"<?php if ($job==11) echo "selected" ?>>قائد س1 عق راد</option>
			      	<option value="12"<?php if ($job==12) echo "selected" ?>>قائد ف1س1 عق راد</option>
			      	<option value="13"<?php if ($job==13) echo "selected" ?>>قا ف3 س1 عق راد</option>
			      	<option value="14"<?php if ($job==14) echo "selected" ?>>قائد ف1س2 عق راد</option>
			      	<option value="15"<?php if ($job==15) echo "selected" ?>>قائد س 2ك2 عق راد</option>
			      	<option value="16"<?php if ($job==16) echo "selected" ?>>رئيس عمليات الكتيبة الأولى</option>
					<option value="17"<?php if ($job==17) echo "selected" ?>>رئيس عمليات الكتيبة الثانية</option>
					<option value="18"<?php if ($job==18) echo "selected" ?>>قائد الكتيبة الثانية</option>
					<option value="19"<?php if ($job==19) echo "selected" ?>>قائد الكتيبة الأولى</option>
					<option value="20"<?php if ($job==20) echo "selected" ?>>رئيس عمليات الفوج </option>
					<option value="21"<?php if ($job==21) echo "selected" ?>>قائد ثانى الفوج</option>
					<option value="22"<?php if ($job==22) echo "selected" ?>>قائد الفوج</option>
			      </select>   
					</div>
					<label for="job" class="col-sm-1 control-label">الوظيفة</label>
			  </div>
				<div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8">
			    <select class="form-control" name="crew" id="crew">
			      	<option value="">طقم النوبتجية</option>
			      	<option value="0" <?php if ($crew==0) echo "selected" ?> >لا يوجد</option>
			      	<option value="1" <?php if ($crew==1) echo "selected" ?> >ضابط نوبتجى وحريق</option>
			      	<option value="2" <?php if ($crew==2) echo "selected" ?> >ضابط عظيم وخفيف حركة</option>
			      	<option value="3" <?php if ($crew==3) echo "selected" ?> >محطة الجبل الأحمر العسكرية</option>
			      	<option value="4" <?php if ($crew==4) echo "selected" ?> >ضابط منوب</option>
			      	<option value="5" <?php if ($crew==5) echo "selected" ?> >قائد منوب</option>
			      </select>   
					</div>
					<label for="crew" class="col-sm-1 control-label">طقم النوبتجية</label>
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
					  <input type="date" class="form-control1" id="volunteer_date" name="volunteer_date" placeholder="الأسم" value="<?php echo $volunteer_date; ?>">
					</div>
					<label for="volunteer_date" class="col-sm-1 control-label">تاريح بداية الخدمة</label>
			  </div>
				<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
				  <input type="date" class="form-control1" id="addedDate" name="addedDate" placeholder="الأسم" value="<?php echo $addedDate; ?>">
				</div>
				<label for="addedDate" class="col-sm-1 control-label">تاريخ الضم على الوحدة</label>
			  </div>
				
			   <div class="form-group">        
				  <div class="col-sm-10">
                    <a href="officers.php" type="button" class="btn btn-default">إلغاء</a>
                    <button type="submit" class="btn btn-success " name="update">تعديل</button>
					<button type="submit" class="btn btn-danger" name="delete" >حذف</button>
                </div>
				</div>
            <div class="col-md-push-1 col-md-9">
			</div>
            </div>
        </form>
     </div>
	  <?php include "../../../includes/footer/footer/footer.php";?>
  </body>
</html>