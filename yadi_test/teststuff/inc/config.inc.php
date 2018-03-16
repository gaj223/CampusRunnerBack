<?php

$servername = "13.59.142.19";
$username = "yadi";
$password = "abc123";
$dbname = "yadiTest";

try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	echo "fail";
    	die("OOPs something went wrong");
    }
    echo "Success";

?>