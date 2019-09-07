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
$sarya = $_GET['sarya'];

// connect to database
include ("../../../includes/controls/db/connection.php");
// include functions.php
include ("../../../includes/controls/controls/functions.php");

//query the data using the reseved clientID
$query = "SELECT * FROM  soldierpunishment WHERE id='$soldierID'";
$result = mysqli_query($conn, $query);

// if the result is re4turned
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        $soldier_id    = $row['soldier_id'];
        $officer_id    = $row['officer_id'];
        $order_number    = $row['order_number'];
        $crime_content    = $row['crime_content'];
        $punishment    = $row['punishment'];
        $crime    = $row['crime'];
        $period    = $row['period'];
        $date    = $row['date'];
		
		
    }
    
}else{
    // no result returned
    $alertMessage = "<div class='alert alert-success'>لا توجد نتيجة<a href='' data-dismiss='alert' class='close pull-left'>&times;</a></div>";
}

// if the update buttom is pressed
if( isset( $_POST['update'] ) ){

    $soldier_id = validateFormData($_POST['soldier_id']); 
    $officer_id   = validateFormData($_POST['officer_id']);
    $order_number = validateFormData($_POST['order_number']); 
	$crime_content   = validateFormData($_POST['crime_content']);
	$punishment = validateFormData($_POST['punishment']);
	$crime = validateFormData($_POST['crime']);
	$period   = validateFormData($_POST['period']);
	$date   = validateFormData($_POST['date']);
    
       // new database query & result
       $query = "UPDATE soldierpunishment SET soldier_id = '$soldier_id',"
       ."officer_id = '$officer_id',order_number='$order_number',crime_content='$crime_content',punishment='$punishment',
	   crime='$crime',period='$period',date='$date' WHERE id = $soldierID";
       
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
            <a type='button' class='btn btn-primary' data-dismiss='alert' name='no-thanks'>لا شكرا</a>
        </form>
    </div>";

    
}
if(isset( $_POST['confirm-delete'] )){
			/*$query1 = "SELECT * FROM soldierpunishment WHERE id='$soldierID' LIMIT 1";
            $result1 = mysqli_query($conn,$query1);
			$soldierId = '';
			if( mysqli_num_rows($result1) > 0){
				$i=0;
				while ($row = mysqli_fetch_assoc($result1)) {
					$soldierId = $row['soldier_id'];
				}
			}
			gal
			$sql = "UPDATE soldier SET availability=1 WHERE id='$soldierId'";
			$update = mysqli_query($conn, $sql);
			*/
           // new database query & result
            $query = "DELETE FROM soldierpunishment WHERE id='$soldierID'";
            $result = mysqli_query($conn,$query);
			
			
            if($result){
                header("Location: soldiers.php");
            }else{
                echo "<div class='alert alert-danger'>خطــــــأ </div>";
            }
          //header("Location: clients.php");
      }
if(isset( $_POST['no-thanks'] )){
	unset($_POST['delete']);
}

 // close the connection

 // include the header
 include ("../../../includes/header/header/header.php");
 
    ?>
<div class="container">

        <h2 class="page-header">
		تعديل عقوبة إنضباطية للجندى 
		/
		<?php
		$query1 = "SELECT * FROM  soldier WHERE id=$soldier_id LIMIT 1";
		$result1 = mysqli_query($conn , $query1);
		$row1 = mysqli_fetch_assoc($result1);
		
		echo $row1['name'];
		?>
		</h2>
		<?php echo $alertMessage; ?>
		<?php
			echo $requiredError;
			echo $invalidEmail;
			
		?>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" class="form-horizontal">
            
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
					<select class="form-control" name="soldier_id" id="soldier_id">
						<option value="">الإسم</option>
						<?php
						$query = "SELECT * FROM  soldier WHERE sarya=$sarya";
						$result = mysqli_query($conn , $query);
						if( mysqli_num_rows($result) > 0){
						$i=0;
						while ($row = mysqli_fetch_assoc($result)) {
							
							if($soldier_id==$row['id']){
								echo "<option value=".$row['id']." selected>".$row['name']."</option>";
							}else{
								echo "<option value=".$row['id'].">".$row['name']."</option>";
							}
							
						}
						} else {
							// if no entires
							echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
						  }				
						?>
					</select>  
				</div>
				<label for="soldier_id" class="col-sm-1 control-label">الأسم</label>
				</div>
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="crime" id="crime">
			      	<option value="">أختيار نوع الجريمة</option>
			      	<option value="1" <?php if ($crime==1) echo "selected" ?>>سلوك </option>
			      	<option value="2" <?php if ($crime==2) echo "selected" ?>>إهمال</option>
			      	<option value="3" <?php if ($crime==3) echo "selected" ?>>غياب</option>
			      </select>  
					</div>
					<label for="crime" class="col-sm-1 control-label">نوع الجريمة</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-2"></div>
			    <div class="col-sm-8"> 
			    <select class="form-control" name="punishment" id="punishment">
			      	<option value="">أختيار نوع العقوبة</option>
			      	<option value="1" <?php if ($punishment==1) echo "selected" ?>>عزل</option>
			      	<option value="2" <?php if ($punishment==2) echo "selected" ?>>حجز</option>
			      	<option value="3" <?php if ($punishment==3) echo "selected" ?>>حبس</option>
			      </select>  
				</div>
				<label for="punishment" class="col-sm-1 control-label">نوع العقوبة</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <textarea rows="4" class="form-control" id="crime_content" name="crime_content" ><?php echo $crime_content;?></textarea>
					</div>
					<label for="crime_content" class="col-sm-1 control-label" >نص الجريمة</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="text" class="form-control1" id="period" name="period" value="<?php echo $period;?>" >
					</div>
					<label for="period" class="col-sm-1 control-label" >المدة</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
			    <div class="col-sm-8">
				  <select class="form-control" name="officer_id" id="officer_id">
							<option value=""> إسم الآمر بالعقوبة</option>
					<?php
					$query = "SELECT * FROM  officer ";
					$result = mysqli_query($conn , $query);
					if( mysqli_num_rows($result) > 0){
					$i=0;
					while ($row = mysqli_fetch_assoc($result)) {
					
						if($row['availability']==1 && $row['job']==20 || $row['job']==22 || $row['job']==19 || $row['job']==18){
							if($row['id']==$officer_id)
								echo "<option value=".$row['id']." selected>".$row['name']."</option>";
							else
								echo "<option value=".$row['id']." selected>".$row['name']."</option>";
						}
					}
					} else {
						// if no entires
						echo "<div class='alert alert-warning'>لا يوجد بيانات<a class='close' data-dismiss='alert'>&times;</a></div>";
					  }				?>
					</select> 
				</div>
				<label for="officer_id" class="col-sm-1 control-label"> الآمر بالعقوبة</label>
			  </div>	
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="text" class="form-control1" id="order_number" name="order_number" value="<?php echo $order_number;?>" >
					</div>
					<label for="order_number" class="col-sm-1 control-label" >رقم بند الأوامر</label>
			  </div>
			  <div class="form-group">
				<div class="col-sm-2"></div>
					<div class="col-sm-8">
					  <input type="date" class="form-control1" id="date" name="date" value="<?php echo $date;?>">
					</div>
					<label for="date" class="col-sm-1 control-label" >تاريخ الجزاء</label>
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
            </div>
        </form>
     </div>
	  <?php include "../../../includes/footer/footer/footer.php"; ?>

  </body>
</html>