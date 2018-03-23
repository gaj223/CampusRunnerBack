<?php
$servername = "13.59.142.19";
$username = "yadi";
$password = "abc123";
$dbname = "yadiTest";
global $con;
echo"echo in here";
$con = new mysqli($servername, $username, $password, $dbname);
if($con->connect_error){
	echo"fail";
  die("Connection failed: " . $con->connect_error);
}
?>