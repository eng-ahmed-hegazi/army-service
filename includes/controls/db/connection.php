<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db = "db_clientaddressbook";

$conn = mysqli_connect($hostname , $username  , $password , $db);
if(!$conn)
    die("cannot connect to server ".mysqli_connect_error());

$select =  mysqli_select_db($conn,"db_clientaddressbook");
if(!$select)
    die("cannot select the database");

?>
