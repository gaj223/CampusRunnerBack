<?php
	header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
	require 'migs_config.php';
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
	$response = array();

	$json = file_get_contents('php://input');
	var_dump($json);
	$phpObj = json_decode($json);
	var_dump($json);
	foreach ($phpObj as $key => $value) {
    	echo "echo $key => $value\n";
    	$_POST[$key] = $value;
	}


// check for required fields
	if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['street_address']) 
    	&& isset($_POST['phone_number']) && isset($_POST['password'] ) && isset($_POST['user_role'] ) ) {

    	    $email     = $_POST['eamil'];
	    $name      = $_POST['name'];
	    $streetAdd = $_POST['street_address'];
    	    $phoNum    = $_POST['phone_number'];
	    $pasWd     = $_POST['password'];
    	    $user_role = $_POST['user_role'];
    // include db connect class
//    require_once __DIR__ . '/db_connect.php';
    // connecting to db
   //trying it out yadi way $db = new DB_CONNECT();
    // mysql inserting a new row
    //$result= $con->query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");
    	$result = mysqli_query ($con,"UPDATE users(email, name, user_role,street_address,phone_number,password)
                                 VALUES('$email', '$name', '$user_role','$streetAdd', '$phone_number','$password') ");

  // check if row inserted or not
  		if ($result) {
      // successfully inserted into database
      	$response["success"] = 1;
      	$response["message"] = "User successfully Edited.";

      // echoing JSON response
      	echo json_encode($response);
  		} else {
      // failed to insert row
      	$response["success"] = 0;
      	$response["message"] = "Oops! An error occurred...failed to insert row";

      // echoing JSON response
    	echo json_encode($response);
  		}
	} else {
  // required field is missing
  		$response["success"] = 0;
  		$response["message"] = "Required field(s) is missing,check edit_user.php";

  // echoing JSON response
  		echo json_encode($response);
	}
?>

