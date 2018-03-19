<?php
// array for JSON response
   $response = array();
//Collect username and password
   if (isset($_POST['abc123']) && isset($_POST['password'])) {
      $result = mysqli_query($con,"SELECT abc123,password FROM users WHERE abc123 ='$_POST['abc123']'AND password = $_POST['password'] ");
   }
//Run a mysqli_query with that info, validate username and password, if not found handle it, offer to reset password with given email...maybe

//	

?>
