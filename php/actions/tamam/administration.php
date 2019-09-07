<?php
  session_start();
   error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 // if the user not logged in
if(!$_SESSION['loggedInUser']){

  //send them to the login page
  header("Location: ../../../index.php");
}

// connect to database
include "../../../includes/controls/db/connection.php";

	$d=strtotime("+1 day");
	$today = date("Y-m-d", $d);
	$das=strtotime("today");
	$dayafter = date("Y-m-d", $das);
	$d=strtotime("+1 day");
	$dayname = date("l", $d);
	$dayaftername = date("l", $das);
	switch($dayname){
		case "Saturday":
		$dayname = 'السبت';
		break;
		case "Sunday":
		$dayname = 'الأحد';
		break;
		case "Monday":
		$dayname = 'الإثنين';
		break;
		case "Tuesday":
		$dayname = 'الثلاثاء';
		break;
		case "Wednesday":
		$dayname = 'الأربعاء';
		break;
		case "Thursday":
		$dayname = 'الخميس';
		break;
		case "Friday":
		$dayname = 'الجمعة';
		break;
	}
	
	switch($dayaftername){
		case "Saturday":
		$dayaftername = 'السبت';
		break;
		case "Sunday":
		$dayaftername = 'الأحد';
		break;
		case "Monday":
		$dayaftername = 'الإثنين';
		break;
		case "Tuesday":
		$dayaftername = 'الثلاثاء';
		break;
		case "Wednesday":
		$dayaftername = 'الأربعاء';
		break;
		case "Thursday":
		$dayaftername = 'الخميس';
		break;
		case "Friday":
		$dayaftername = 'الجمعة';
		break;
	}
		# nobatgyat
		$query1 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=5 WHERE officerperiodical.date = '$today' LIMIT 1 ";
		$result1 = mysqli_query( $conn, $query1 );
		$officer1 = mysqli_fetch_assoc($result1); 
		
		$query2 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=2 WHERE officerperiodical.date = '$today' LIMIT 1 ";
		$result2 = mysqli_query( $conn, $query2);
		$officer2 = mysqli_fetch_assoc($result2); 
		
		$query3 = "SELECT officerperiodical.id,officer.crew,officer.name,officer.degree,officerperiodical.date,dayname(officerperiodical.date) as day  FROM officerperiodical  JOIN officer ON  officer.id=officer_id AND officer.crew=2 WHERE officerperiodical.date = '$dayafter' LIMIT 1 ";
		$result3 = mysqli_query( $conn, $query3);
		$officer3 = mysqli_fetch_assoc($result3); 
		
		# tamam leaderes and presidant true / false
		$query4 = "SELECT * FROM officer WHERE job=22 LIMIT 1";
		$result4 = mysqli_query( $conn, $query4);
		$leader = mysqli_fetch_assoc($result4); 
		
		$query5 = "SELECT * FROM officer WHERE job=18 LIMIT 1";
		$result5 = mysqli_query( $conn, $query5);
		$leaderk2 = mysqli_fetch_assoc($result5); 
		
		$query6 = "SELECT * FROM officer WHERE job=19 LIMIT 1";
		$result6 = mysqli_query( $conn, $query6);
		$leaderk1 = mysqli_fetch_assoc($result6); 
		
		$query7 = "SELECT * FROM officer WHERE job=20 LIMIT 1";
		$result7 = mysqli_query( $conn, $query7);
		$president = mysqli_fetch_assoc($result7); 
		
		$query8 = "SELECT * FROM officer WHERE job=17 LIMIT 1";
		$result8 = mysqli_query( $conn, $query8);
		$presidentk2 = mysqli_fetch_assoc($result8); 
		
		$query9 = "SELECT * FROM officer WHERE job=16 LIMIT 1";
		$result9 = mysqli_query( $conn, $query9);
		$presidentk1 = mysqli_fetch_assoc($result9); 
		
		# tamam leaderes and presidant [the actual tamam]
		$query10 = "SELECT officervacancy.id,officer.job,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id AND officer.job=22 LIMIT 1";
		$result10 = mysqli_query( $conn, $query10);
		$leadervacancy = mysqli_fetch_assoc($result10); 
		
		$query11 = "SELECT officerout.id,officer.job,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND officer.job=22 LIMIT 1";
		$result11 = mysqli_query( $conn, $query11 );
		$leaderout = mysqli_fetch_assoc($result11); 
		
		$query12 = "SELECT officervacancy.id,officer.job,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id AND officer.job=19 LIMIT 1";
		$result12 = mysqli_query( $conn, $query12);
		$leaderk1vacancy = mysqli_fetch_assoc($result12); 
		
		$query13 = "SELECT officerout.id,officer.job,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND officer.job=19 LIMIT 1";
		$result13 = mysqli_query( $conn, $query13 );
		$leaderk1out = mysqli_fetch_assoc($result13); 
		
		$query14 = "SELECT officervacancy.id,officer.job,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id AND officer.job=18 LIMIT 1";
		$result14 = mysqli_query( $conn, $query14);
		$leaderk2vacancy = mysqli_fetch_assoc($result14);
		
		$query15 = "SELECT officerout.id,officer.job,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND officer.job=18 LIMIT 1";
		$result15 = mysqli_query( $conn, $query15 );
		$leaderk2out = mysqli_fetch_assoc($result15); 		
		
		$query16 = "SELECT officervacancy.id,officer.job,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id AND officer.job=20 LIMIT 1";
		$result16 = mysqli_query( $conn, $query16);
		$presidentvacancy = mysqli_fetch_assoc($result16);  
		
		$query17 = "SELECT officerout.id,officer.job,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND officer.job=20 LIMIT 1";
		$result17 = mysqli_query( $conn, $query17 );
		$presidentout = mysqli_fetch_assoc($result17); 
		
		$query18 = "SELECT officervacancy.id,officer.job,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id AND officer.job=16 LIMIT 1";
		$result18 = mysqli_query( $conn, $query18);
		$presidentk1vacancy = mysqli_fetch_assoc($result18); 
		
		$query19 = "SELECT officerout.id,officer.job,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND officer.job=16 LIMIT 1";
		$result19 = mysqli_query( $conn, $query19 );
		$presidentk1out = mysqli_fetch_assoc($result19); 
	
		$query20 = "SELECT officervacancy.id,officer.job,officervacancy.start_date,officervacancy.end_date,officervacancy.type FROM officervacancy  JOIN officer ON  officer.id=officer_id AND officer.job=17 LIMIT 1";
		$result20 = mysqli_query( $conn, $query20);
		$presidentk2vacancy = mysqli_fetch_assoc($result20); 
		
		$query21 = "SELECT officerout.id,officer.job,officerout.destination,officerout.start_date,officerout.end_date,officerout.type FROM officerout  JOIN officer ON  officer.id=officer_id AND officer.job=17 LIMIT 1";
		$result21 = mysqli_query( $conn, $query21);
		$presidentk2out = mysqli_fetch_assoc($result21); 
		
		$degree1 = '';
		switch($officer1['degree']){
			case 1:
			$degree1 = 'ملازم';
			break;
			case 2:
			$degree1 = 'ملازم أول';
			break;
			case 3:
			$degree1 = 'نقيب';
			break;
			case 4:
			$degree1 = 'رائد';
			break;
			case 5:
			$degree1 = 'مقدم';
			break;
			case 6:
			$degree1 = 'عقيد';
			break;
			case 7:
		}
		
		$degree2 = '';
		switch($officer2['degree']){
			case 1:
			$degree2 = 'ملازم';
			break;
			case 2:
			$degree2 = 'ملازم أول';
			break;
			case 3:
			$degree2 = 'نقيب';
			break;
			case 4:
			$degree2 = 'رائد';
			break;
			case 5:
			$degree2 = 'مقدم';
			break;
			case 6:
			$degree2 = 'عقيد';
			break;
			case 7:
		}
		
		$degree3 = '';
		switch($officer3['degree']){
			case 1:
			$degree3 = 'ملازم';
			break;
			case 2:
			$degree3 = 'ملازم أول';
			break;
			case 3:
			$degree3 = 'نقيب';
			break;
			case 4:
			$degree3 = 'رائد';
			break;
			case 5:
			$degree3 = 'مقدم';
			break;
			case 6:
			$degree3 = 'عقيد';
			break;
			case 7:
		}
 // close the connection
 //mysqli_close($conn);
include "../../../includes/header/header/header.php";
// print the alert message
?>
<head>
  <style>
  .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td{
padding: 2px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ddd;
}
.sfont td{
	font-size:9px
}
  </style>
</head>
<body>

	<div class="container-fluid">
		<table class="table">
		<tbody>
			  <tr>
				<td><a href="javascript:void(0);" class="btn btn-default" onclick="printPage();return false;"><span class="glyphicon glyphicon-print"></span>   طباعة   </a></td>
				</tr>
			<tbody>	
		</table>
	</div>
	<div id='main'>
      <div id='mainLeaderboard' style='overflow:hidden;'>
      <!-- Ezoic - Leaderboard - top_of_page -->
      <div id="ezoic-pub-ad-placeholder-103">
        <!-- MainLeaderboard-->
        <div id='div-gpt-ad-1422003450156-2'>
          <script type='text/javascript'>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422003450156-2'); });</script>
        </div>
      </div>
      <!-- End Ezoic - Leaderboard - top_of_page -->
      </div>
	<div class="container" style="border : 5px double #333;padding:10px 30px;min-height:600px;min-width:1000px">
	<span>
		إدارة الحرب الإلكترونيـــــة <br>
		الفوج 715   حرب إلكترونيـة <br>
	</span>
	<div style="margin:5px 0"></div>
	<table class="table table-bordered text-right">
		<tr>
			<td width="50%">قيد المرسل منه:</td>
			<td width="50%">التاريخ : <?php echo $dayafter;?></td>
		</tr>
		</table>
	<h6 class="text-center" style="font-weight:bold">
	إلى / مركز 250 عمليات حــرب إلكترونية <br>
	يومية تمــــــــام القــــــادة ورؤســـاء العمليـــــــات عن يوم
		<?php
		echo $dayname;
		echo  "  "; 
		echo  $today ;
	?>
	</h6>

		<table class="table table-bordered text-center">
			<tr>
				<td width="50%" colspan="6">تمام القادة</td>
				<td width="50%" colspan="6">تمام رؤساء العمليات</td>
			</tr>
			<tr class="sfont">
				<td width="8%">التمام</td>
				<td width="7%">موجود</td>
				<td width="7%">غير موجود</td>
				<td>التمام</td>
				<td colspan="2">المدة</td>
				<td width="9%">التمام</td>
				<td width="7%">موجود</td>
				<td width="8%">غير موجود</td>
				<td>التمام</td>
				<td colspan="2">المدة</td>
			</tr>	
			<tr class="sfont">
				<td>قائد الفوج</td>
				<?php 
				if($leader){ 
					if($leader['availability']==1){
						echo "<td>&#10004;</td>
						  <td></td>";
					}else{
						echo "<td></td>
						  <td>&#10004;</td>";
					}
				}else{
					echo "<td></td>
						  <td></td>";
				}
				 if($leader){ 
					 if($leader['availability']==0){
						if(mysqli_num_rows($result10)>0){
							$type ='';
							switch($leadervacancy['type']){
								case 1:
									$type='ميدانية';
								break;
								case 2:
									$type='راحة';
								break;
								case 3:
									$type='بدل راحة';
								break;
								case 4:
									$type='سنوية';
								break;
								case 5:
									$type='عارضة';
								break;
								case 6:
									$type='مرضية';
								break;
							}
							$start_date=date_create($leadervacancy['start_date']);
							$end_date=date_create($leadervacancy['end_date']);
							echo "
							<td>".$type."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}else if(mysqli_num_rows($result11)>0){
							$type ='';
							switch($leaderout['type']){
								case 1:
									$type='مأمورية ب';
								break;
								case 2:
									$type=' فرقة فى ';
								break;
								case 3:
									$type='إختبارات';
								break;
								case 4:
									$type='مستشفى';
								break;
							}
							$start_date=date_create($leaderout['start_date']);
							$end_date=date_create($leaderout['end_date']);
							echo "
							<td>".$type."".$leaderout['destination']."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}
					}else{
						echo "
							<td></td>
							<td></td>
							<td></td>
							";
					}
				}else{
						echo "
						<td>لم يتم التنفيذ</td>
						<td></td>
						<td></td>
						";
				}
				?>
				<td>رئيس عمليات الفوج</td>
				<?php 
				  if($president){
					  if($president['availability']==1){
						echo "<td>&#10004;</td>
							  <td></td>";
					 }else{
						echo "<td></td>
							  <td>&#10004;</td>";
					  }
					  }else{
					echo "<td></td>
						  <td></td>";
				}
				   if($president){
					 if($president['availability']==0){
						if(mysqli_num_rows($result16)>0){
							$type ='';
							switch($presidentvacancy['type']){
								case 1:
									$type='ميدانية';
								break;
								case 2:
									$type='راحة';
								break;
								case 3:
									$type='بدل راحة';
								break;
								case 4:
									$type='سنوية';
								break;
								case 5:
									$type='عارضة';
								break;
								case 6:
									$type='مرضية';
								break;
							}
							$start_date=date_create($presidentvacancy['start_date']);
							$end_date=date_create($presidentvacancy['end_date']);
							echo "
							<td>".$type."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}else if(mysqli_num_rows($result17)>0){
							$type ='';
							switch($presidentout['type']){
								case 1:
									$type='مأمورية ب';
								break;
								case 2:
									$type=' فرقة فى ';
								break;
								case 3:
									$type='إختبارات';
								break;
								case 4:
									$type='مستشفى';
								break;
							}
							$start_date=date_create($presidentout['start_date']);
							$end_date=date_create($presidentout['end_date']);
							echo "
							<td>".$type."".$presidentout['destination']."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}
					}else{
						echo "
							<td></td>
							<td></td>
							<td></td>
							";
					}
				}else{
						echo "
						<td>لم يتم التنفيذ</td>
						<td></td>
						<td></td>
						";
				}
				?>
			</tr>
			<tr class="sfont">
				<td>قائد ك2 </td>
				<?php 
				if($leaderk2){
					if($leaderk2['availability']==1){
						echo "<td>&#10004;</td>
						  <td></td>";
					}else{
						echo "<td></td>
						  <td>&#10004;</td>";
					}
				}else{
					echo "<td></td>
					  <td></td>";
				}
				   if($leaderk2){
					 if($leaderk2['availability']==0){
						if(mysqli_num_rows($result14)>0){
							$type ='';
							switch($leaderk2vacancy['type']){
								case 1:
									$type='ميدانية';
								break;
								case 2:
									$type='راحة';
								break;
								case 3:
									$type='بدل راحة';
								break;
								case 4:
									$type='سنوية';
								break;
								case 5:
									$type='عارضة';
								break;
								case 6:
									$type='مرضية';
								break;
							}
							$start_date=date_create($leaderk2vacancy['start_date']);
							$end_date=date_create($leaderk2vacancy['end_date']);
							echo "
							<td>".$type."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}else if(mysqli_num_rows($result15)>0){
							$type ='';
							switch($leaderk2out['type']){
								case 1:
									$type='مأمورية ب';
								break;
								case 2:
									$type=' فرقة فى ';
								break;
								case 3:
									$type='إختبارات';
								break;
								case 4:
									$type='مستشفى';
								break;
							}
							$start_date=date_create($leaderk2out['start_date']);
							$end_date=date_create($leaderk2out['end_date']);
							echo "
							<td>".$type."".$leaderk2out['destination']."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}
					}else{
						echo "
							<td></td>
							<td></td>
							<td></td>
							";
					}
				}else{
						echo "
						<td>لم يتم التنفيذ</td>
						<td></td>
						<td></td>
						";
				}
				?>
				<td>رئيس عمليات ك2</td>
				<?php 
				if($presidentk2){
					if($presidentk2['availability']==1){
						echo "<td>&#10004;</td>
						  <td></td>";
					}else{
						echo "<td></td>
						  <td>&#10004;</td>";
					}
				}else{
					echo "<td></td>
						  <td></td>";
				}
				  if($presidentk2){
					 if($presidentk2['availability']==0){
						if(mysqli_num_rows($result20)>0){
							$type ='';
							switch($presidentk2vacancy['type']){
								case 1:
									$type='ميدانية';
								break;
								case 2:
									$type='راحة';
								break;
								case 3:
									$type='بدل راحة';
								break;
								case 4:
									$type='سنوية';
								break;
								case 5:
									$type='عارضة';
								break;
								case 6:
									$type='مرضية';
								break;
							}
							$start_date=date_create($presidentk2vacancy['start_date']);
							$end_date=date_create($presidentk2vacancy['end_date']);
							echo "
							<td>".$type."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}else if(mysqli_num_rows($result21)>0){
							$type ='';
							switch($presidentk2out['type']){
								case 1:
									$type='مأمورية ب';
								break;
								case 2:
									$type=' فرقة فى ';
								break;
								case 3:
									$type='إختبارات';
								break;
								case 4:
									$type='مستشفى';
								break;
							}
							$start_date=date_create($presidentk2out['start_date']);
							$end_date=date_create($presidentk2out['end_date']);
							echo "
							<td>".$type."".$presidentk2out['destination']."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}
					}else{
						echo "
							<td></td>
							<td></td>
							<td></td>
							";
					}
				}else{
						echo "
						<td>لم يتم التنفيذ</td>
						<td></td>
						<td></td>
						";
				}
				?>
			</tr>
			<tr class="sfont">
				<td>قائد ك1</td>
				<?php 
				if($leaderk1){
					if($leaderk1['availability']==1){
						echo "<td>&#10004;</td>
						  <td></td>";
					}else{
						echo "<td></td>
						  <td>&#10004;</td>";
					}
				}else{
					echo "<td></td>
					  <td></td>";
				}
				 if($leaderk1){
					 if($leaderk1['availability']==0){
						if(mysqli_num_rows($result12)>0){
							$type ='';
							switch($leaderk1vacancy['type']){
								case 1:
									$type='ميدانية';
								break;
								case 2:
									$type='راحة';
								break;
								case 3:
									$type='بدل راحة';
								break;
								case 4:
									$type='سنوية';
								break;
								case 5:
									$type='عارضة';
								break;
								case 6:
									$type='مرضية';
								break;
							}
							$start_date=date_create($leaderk1vacancy['start_date']);
							$end_date=date_create($leaderk1vacancy['end_date']);
							echo "
							<td>".$type."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}else if(mysqli_num_rows($result13)>0){
							$type ='';
							switch($leaderk1out['type']){
								case 1:
									$type='مأمورية ب';
								break;
								case 2:
									$type=' فرقة فى ';
								break;
								case 3:
									$type='إختبارات';
								break;
								case 4:
									$type='مستشفى';
								break;
							}
							$start_date=date_create($leaderk1out['start_date']);
							$end_date=date_create($leaderk1out['end_date']);
							echo "
							<td>".$type."".$leaderk1out['destination']."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}
					}else{
						echo "
							<td></td>
							<td></td>
							<td></td>
							";
					}
				}else{
						echo "
						<td>لم يتم التنفيذ</td>
						<td></td>
						<td></td>
						";
				}
				?>
				<td>رئيس عمليات ك1</td> 
				<?php 
				 if($presidentk1){
				  if($presidentk1['availability']==1){
					echo "<td>&#10004;</td>
					      <td></td>";
				 }else{
					echo "<td></td>
					      <td>&#10004;</td>";
				  }
				  }else{
				  echo "<td></td>
					      <td></td>";
				  }
				  if($presidentk1){
					 if($presidentk1['availability']==0){
						if(mysqli_num_rows($result18)>0){
							$type ='';
							switch($presidentk1vacancy['type']){
								case 1:
									$type='ميدانية';
								break;
								case 2:
									$type='راحة';
								break;
								case 3:
									$type='بدل راحة';
								break;
								case 4:
									$type='سنوية';
								break;
								case 5:
									$type='عارضة';
								break;
								case 6:
									$type='مرضية';
								break;
							}
							$start_date=date_create($presidentk1vacancy['start_date']);
							$end_date=date_create($presidentk1vacancy['end_date']);
							echo "
							<td>".$type."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}else if(mysqli_num_rows($result19)>0){
							$type ='';
							switch($presidentk1out['type']){
								case 1:
									$type='مأمورية ب';
								break;
								case 2:
									$type=' فرقة فى ';
								break;
								case 3:
									$type='إختبارات';
								break;
								case 4:
									$type='مستشفى';
								break;
							}
							$start_date=date_create($presidentk1out['start_date']);
							$end_date=date_create($presidentk1out['end_date']);
							echo "
							<td>".$type."".$presidentk1out['destination']."</td>
							<td>".date_format($start_date,"Y/m/d ")."</td>
							<td>".date_format($end_date,"Y/m/d ")."</td>
							";
						}
						}else{
							echo "
								<td></td>
								<td></td>
								<td></td>
								";
						}
					}else{
							echo "
							<td>لم يتم التنفيذ</td>
							<td></td>
							<td></td>
							";
					}
				?>
			</tr>
		</table>
		<table class="table table-bordered text-center">
			<tr class="sfont">
				<td width="15%">البيان</td>
				<td width="6%">الرتبة</td>
				<td width="25%">إسم</td>
				<td>اليوم</td>
				<td>التاريخ</td>
				<td>ملاحظات</td>
			</tr>
			<tr class="sfont">
				<td>قائد منوب الوحدة</td>
				<td><?php echo $degree1?></td>
				<td><?php echo $officer1['name']?></td>
				<td rowspan="2" style="line-height:30px"><?php echo $dayname;?></td>
				<td><?php echo $today?></td>
				<td></td>
			</tr>
			<tr class="sfont">
				<td>ضابط عظيم الوحدة</td>
				<td><?php echo $degree2 ?></td>
				<td><?php echo $officer2['name']?></td>
				<td><?php echo $today?></td>
				<td></td>
			</tr>
			<tr class="sfont">
				<td>العنصر المناوب</td>
				<td><?php echo $degree3?></td>
				<td><?php echo $officer3['name']?></td>
				<td><?php echo $dayaftername;?></td>
				<td><?php echo $dayafter?></td>
				<td></td>
			</tr>
		</table>
		<h6 class="text-center" style="font-weight:bold;">
		يومية عددية بالضباط والدرجات الأخرى قوة الفوج 715 حرب الكترونية عن يوم  
		<?php
		echo $dayname;
		echo  "  "; 
		echo  $today ;
	?>
	</h6>
	<table class="table table-bordered text-center">
		<tr class="sfont" >
			<td width="10%" rowspan="2" style="line-height:30px">البيان</td>
			<td width="6%" rowspan="2" style="line-height:30px">القوة</td>
			<td width="6%" rowspan="2" style="line-height:30px">الموجود</td>
			<td colspan="4">أجازة</td>
			<td width="6%" rowspan="2" style="line-height:30px">مستشفى</td>
			<td width="6%" rowspan="2" style="line-height:30px">فرقة</td>
			<td width="6%" rowspan="2" style="line-height:30px">مأمورية</td>
			<td width="6%" rowspan="2" style="line-height:30px">عارضة</td>
			<td width="6%" rowspan="2" style="line-height:30px">غياب</td>
			<td width="6%" rowspan="2" style="line-height:30px">نشرة تنقلات</td>
			<td width="6%" rowspan="2" style="line-height:30px">الإجمالى خ</td>
			<td width="6%" rowspan="2" style="line-height:30px">النسبة خ</td>
			<td width="6%" rowspan="2" style="line-height:30px">ملاحظات</td>
		</tr>
		<tr class="sfont">
			<td width="6%">مرضية</td>
			<td width="6%">ميدانية</td>
			<td width="6%">راحة</td>
			<td width="6%">سنوية</td>
		</tr>
		<tr class="sfont">
			<td>ضباط</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="sfont">
			<td>راتب عالى</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr >
		<tr class="sfont">
			<td>مجندين</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="sfont">
			<td>إجمالى د.أ</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="sfont">
			<td>ملاحظات</td>
			<td colspan="8"></td>
			<td colspan="7"></td>
		</tr>
	</table>
	
		<h5 style="font-weight:bold;line-height:18px" class="text-left">
التوقيع "&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;"<br>

<?php 
$query = "SELECT * FROM officer WHERE job=22 LIMIT 1";
$result = mysqli_query( $conn, $query);

 while ($row = mysqli_fetch_assoc($result)) {
	if($row['job']==22 && $row['availability']==1){
	?>
		عمــيد أح /شـريف عادل محمد<br>
	قائد الفوج 715 حرب إلكترونية
		</h5>
	<?php
	}else{
	?>
			عقيد أح / هشام السعيد السعيد<br>
	قائد الفوج 715 حرب إلك بالإنابة
		</h5>
		
	<?php
	break;
	}
 }
?>
</div>
<script type="text/javascript" language="javascript">

function printPage() {
  var content = document.getElementById("main").innerHTML;
  var css = "", i, j, c = document.getElementById("main").cloneNode(true);
  for (i = 0; i < c.childNodes.length; i++) {
    if (c.childNodes[i].nodeType == 1) {
      c.removeChild(c.childNodes[i]);
      content = c.innerHTML;
      break;
    }
  }
  var head = document.getElementsByTagName("head")[0].innerHTML;
  var myWindow=window.open('','','');
  myWindow.document.write("<html><head>"+head+"<style>  .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td{padding: 2px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;}.sfont td{font-size:9px}body{padding:5px;}@media print {.printbtn {display:none;}}</style></head><body onload='window.print()'><div class='container'><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-print'></span>   طباعة   </button><button class='printbtn btn btn-default' onclick='window.print()'><span class='glyphicon glyphicon-download'></span>   تحميل   </button></div><br>"+content);
}
</script>
<?php
  include "../../../includes/footer/foot/foot.php";
?>