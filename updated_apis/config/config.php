<?php
$servername = "18.188.229.178";
$username = "yadi";
$password = "abc123";
$dbname = "campus_runner";
global $con;

$con = new mysqli($servername, $username, $password, $dbname);
if($con->connect_error){
	echo"fail";
  die("Connection failed: " . $con->connect_error);
}
?>