<?php include "../../header/head/head.php";?>
<div class="container" style="padding:15px 0">
<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Failed To connect to Database" . mysqli_connect_error()."</br>");
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS db_clientaddressbook ";
if (mysqli_query($conn, $sql)) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء قاعدة البيانـــــــــات
	</div>
	";
} else {
    echo "Error , In Database Creation" . mysqli_error($conn)."</br>";
}

$select =  mysqli_select_db($conn,"db_clientaddressbook");
if($select)
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> تحديد البيانـــــــــات
	</div>
	";
else
	echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";

$sql = "CREATE TABLE IF NOT EXISTS `assistant` (
  `id` int(11) NOT NULL auto_increment,
  `mNumber` varchar(14) NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `degree` int(2) NOT NULL,
  `punit` int(2) NOT NULL,
  `sarya` int(2) NOT NULL,
  `taskeen` int(2) NOT NULL,
  `crew` int(2) NOT NULL,
  `availability` int(2) NOT NULL default '1',
  `title` varchar(255) NOT NULL,
  `volunteer_date` date default NULL,
  `addedDate` date default NULL,
  PRIMARY KEY  (`id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول الصف ضباط 
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `assistantout` (
  `id` int(11) NOT NULL auto_increment,
  `assistant_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `assistant_id` (`assistant_id`)
) ";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول مأموريات و فرق صف ضباط	  
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `assistantperiodical` (
  `id` int(11) NOT NULL auto_increment,
  `assistant_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `assistant_id` (`assistant_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول نوبتجيات صف ضباط 
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `assistantvacancy` (
  `id` int(11) NOT NULL auto_increment,
  `assistant_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `assistant_id` (`assistant_id`)
  )";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول أجازات صف ضباط 
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `assistantpunishment` (
  `id` int(11) NOT NULL auto_increment,
  `order_number` varchar(255) NOT NULL,
  `crime_content` text NOT NULL,
  `punishment` int(11) NOT NULL,
  `crime` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `assistant_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `officer_id` (`officer_id`),
  KEY `assistant_id` (`assistant_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول عقوبات صف ضباط  
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `officer` (
  `id` int(11) NOT NULL auto_increment,
  `mNumber` varchar(16) NOT NULL,
  `oNumber` varchar(8) NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `degree` int(2) NOT NULL,
  `punit` int(2) NOT NULL,
  `job` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `crew` int(2) NOT NULL,
  `availability` int(2) NOT NULL default '1',
  `volunteer_date` date default NULL,
  `addedDate` date default NULL,
  PRIMARY KEY  (`id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول الضباط   
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}


$sql = "CREATE TABLE IF NOT EXISTS `officerout` (
  `id` int(11) NOT NULL auto_increment,
  `officer_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `officer_id` (`officer_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول مأموريات و فرق ضباط 
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `officerperiodical` (
  `id` int(11) NOT NULL auto_increment,
  `officer_id` int(11) NOT NULL,
  `date` date NOT NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `officer_id` (`officer_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول نوبتجيات ضباط 
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `officervacancy` (
  `id` int(11) NOT NULL auto_increment,
  `officer_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `officer_id` (`officer_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول أجازات ضباط 
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";;
}

$sql = "CREATE TABLE IF NOT EXISTS `officerpunishment` (
  `id` int(11) NOT NULL auto_increment,
  `order_number` varchar(255) NOT NULL,
  `crime_content` text NOT NULL,
  `punishment` int(11) NOT NULL,
  `crime` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `officer` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `officer` (`officer`),
  KEY `officer_id` (`officer_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول عقوبات ضباط  
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";;
}

$sql = "CREATE TABLE IF NOT EXISTS `soldier` (
  `id` int(11) NOT NULL auto_increment,
  `mNumber` varchar(14) character set utf8 collate utf8_bin NOT NULL,
  `name` varchar(255) NOT NULL,
  `degree` int(2) NOT NULL,
  `punit` int(2) NOT NULL,
  `sarya` int(2) NOT NULL,
  `taskeen` int(2) NOT NULL,
  `vacancy_id` int(2) NOT NULL,
  `availability` int(1) NOT NULL default '1',
  `title` varchar(255) NOT NULL,
  `startDate` date default NULL,
  `endDate` date default NULL,
  PRIMARY KEY  (`id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول المجنديين   
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}


$sql = "CREATE TABLE IF NOT EXISTS `soldierout` (
  `id` int(11) NOT NULL auto_increment,
  `soldier_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `soldier_id` (`soldier_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول  مأموريات و فرق مجنديين  
	</div>";
	
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `soldiervacancy` (
  `id` int(11) NOT NULL auto_increment,
  `soldier_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `soldier_id` (`soldier_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول أجازات مجنديين   
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `soldierabsent` (
  `id` int(11) NOT NULL auto_increment,
  `soldier_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `soldier_id` (`soldier_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول غياب / سجن حربى مجنديين   
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `soldierpunishment` (
  `id` int(11) NOT NULL auto_increment,
  `order_number` varchar(255) NOT NULL,
  `crime_content` text NOT NULL,
  `punishment` int(11) NOT NULL,
  `crime` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `soldier_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `officer_id` (`officer_id`),
  KEY `soldier_id` (`soldier_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول عقوبات مجندين     
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `soldiersjobs` (
  `id` int(11) NOT NULL auto_increment,
  `soldier_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `soldier_id` (`soldier_id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول وظائف المجندين      
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

$sql = "CREATE TABLE IF NOT EXISTS `vacancy` (
  `id` int(11) NOT NULL auto_increment,
  `vacancy_number` int(11) NOT NULL,
  `back_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vacancy_number` (`vacancy_number`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول الميدانيات      
	</div>
	";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}


$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "
	<div class='alert alert-success' style='font-size:14px'>
	  <strong>تم!</strong> إنشاء جدول المستخدميين    
	</";
} else {
    echo "<div class='alert alert-danger' style='font-size:14px'>
    <strong>خطـــأ!</strong> " . $conn->error."
    </div>";
}

mysqli_close($conn);
?>
</div>