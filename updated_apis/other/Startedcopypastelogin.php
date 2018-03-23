<?php
require 'config.php';
$error=''; // Variable To Store Error Message

// array for JSON response
$response = array();

//get the data that was sent
$json = file_get_contents('php://input');
//var_dump($json);
//decode it
$obj = json_decode($json);

//place in $_POST array, kinda cheating but whatever
foreach ($obj as $key => $value) {
   // echo "$key => $value\n";
    $_POST[$key] = $value;
}

	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else
	{
		
		// Define $username and $password
		$abc123=$_POST['abc123'];
		$password=$_POST['password'];

		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		// $username = $mysqli->real_escape_string($username);
		// $password = $mysqli->real_escape_string($password);

	$query = "SELECT failed_attempts FROM users WHERE username= '$username'";
	  $result = $con->query($query);
	  $array = $result->fetch_assoc();
	  if($array["failed_attempts"] >= 2){
		  echo '<script type ="text/javascript"> alert("Execeded nuber of allowed login attempts")</script>';
		}
		else{
		  
		  $query = "SELECT * FROM users WHERE username= '$username' and password= '$password';";
		  $result = $con->query($query);
		  
		  if ($recordObj = $result->fetch_object()){
			  //valid user
			  $query = "UPDATE users SET failed_attempts = 0 WHERE username= '$username';";
			  $result = $con->query($query);
			  
			  $_SESSION['username']= $username;
			  
			  $query = "SELECT role FROM users WHERE username= '$username'";
			  $result = $con->query($query);
			  $array = $result->fetch_assoc();
			  if($array["role"] == 1){
				  header('location:adminFrontPage.php');
			  }
			  else{
				  header('location: ../parse/gui/jquery/index.php');
			  }
		  }
		  else{
			  //invalid user
			  //myka code
			  $query = "UPDATE users SET failed_attempts = failed_attempts + 1 WHERE username= '$username';";
			  $result = $con->query($query);
		  
			  echo '<script type ="text/javascript"> alert("Invalid Username or Password")</script>';
		  }
	  }
		    

		// mysql_close($connection); // Closing Connection
	}
}
?>