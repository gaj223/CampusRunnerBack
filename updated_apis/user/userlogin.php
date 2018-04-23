<?php
//needed to be able to pass data between different sources
header("Access-Control-Allow-Origin: *");
/*
* userLogin.php will log in a existing user to the Database
*
*/

// array for JSON response
  $response = array();
//get the data that was sent
  $json = file_get_contents('php://input');
//decode it,akes a JSON encoded string and converts it into a PHP variable.
  $phpVar = json_decode($json);

//place in $_POST array, and use for testing, to ensure values
  foreach ($phpVar as $key => $value) {
//remove comment for testing on http bar    echo "$key => $value\n";
    $_POST[$key] = $value;
  }//Check for a valid, abc123, and password,
  // Collect username and password from the database, and comepare the
  //values set in.
  if (isset($_POST['abc123']) && isset($_POST['password'])) {
    $abc   = $_POST['abc123'];
    $pasWd = $_POST['password'];
//    echo "your in";

    // include db connect class
    require_once '../config.php';

//    $result = mysqli_query($con,"SELECT abc123,password FROM users WHERE abc123 = '$abc' AND password = '$pasWd' ");
    $result = mysqli_query($con,"SELECT abc123,password,userId,user_role FROM users WHERE abc123 = '$abc' AND password = '$pasWd' ");
	// sloopy way of checking to see what was return. 
    if(mysqli_num_fields($result) > 0 ){
      //open to the default page of the user
      $response["success"] = 1;
      $response["message"] = "User Logged in";
	//the resutls from the query
	$queryResults = array();
 	$row = mysqli_fetch_assoc($result);
        //var_dump($row);
	$queryResults["userId"] = $row["userId"];
	$queryResults["role"]   = $row["user_role"];
	//var_dump($queryResults);
	$response["user"] = array();
	array_push( $response["user"],$queryResults);
      // echoing JSON response,Returns the JSON representation of a value to my java file 
      echo json_encode($response);
    }
    if($result ==FALSE ){
      //kick back and ask to retype
      $response["success"] = 0;
      $response["message"] = "User was not logged in, or not found";
      // echoing JSON response,Returns the JSON representation of a value
      echo json_encode($response);
    }
    mysqli_free_result($result);
  }else{
    $response["success"] = 0;
    $response["message"] = "Incorrect Data given, check input";
    echo json_encode($response);
  }
//Run a mysqli_query with that info, validate username and password, if not found handle it, offer to reset password with given email...maybe

//

?>

