<?php
 
/*
 * All database connection variables
 */
 
//define('DB_USER', "migs"); // db user
//define('DB_PASSWORD', "abc123"); // db password (mention your db password here)
//define('DB_DATABASE', "yadiTest"); // database name
//define('DB_SERVER', "13.59.142.19"); // db server


	$servername = "13.59.142.19";
	$username   = "migs";
	$password   = "abc123";
	$dbname     = "migsTest";
	$con = new mysqli($servername, $username, $password, $dbname);
	if($con->connect_error){
		echo"fail,connection failed in..";
	  die("Connection failed: " . $con->connect_error);
	}else{
            echo"connection is good";
        }
?>
