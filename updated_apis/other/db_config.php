<?php
$servername = "localhost";
$username = "yadi";
$password = "abc123";
$dbname = "yadiTest";
$con = new mysqli($servername, $username, $password, $dbname);
if($con->connect_error){
        echo"fail";
  die("Connection failed: " . $con->connect_error);
}