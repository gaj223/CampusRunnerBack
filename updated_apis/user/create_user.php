<?php
//needed to be able to pass data between different sources
header("Access-Control-Allow-Origin: *");
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();
//get the data that was sent
$json = file_get_contents('php://input');

//decode it
$obj = json_decode($json);

//place in $_POST array, kinda cheating but whatever
foreach ($obj as $key => $value) {
    echo "$key => $value\n";
    $_POST[$key] = $value;
}
 
// check for required fields
//if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['abc123']) && isset($_POST['user_role']) 
//    && isset($_POST['street_address'])&& isset($_POST['phone_number'])&& isset($_POST['password'])) {
if (isset($_POST['email']) && isset($_POST['abc123']) && isset($_POST['password'])) {

    //echo "in if";
    //made a new config file could not get object oriented one working
    require 'config.php';
    //set variables to send to query 
    $name      = $_POST['first_name'];
    $lastName  = $_POST['last_name'];
    $email     = $_POST['email'];
    $abc123    = $_POST['abc123'];
    $user_role = $_POST['user_role'];
    $gender    = $_POST['gender'];
    //$street_address = $_POST['street_address'];
    $phone_number   = $_POST['phone_number'];
    $password       = $_POST['password'];



    
    // connecting to db
    //$db = new DB_CONNECT();
//////////////////////////////////////////CHECK MY LOGIC PLEASE///////////////////////////////////////////////////////////////
        $result = $con->query("INSERT INTO users(first_name, last_name ,email, abc123, user_role,  phone_number, password,gender) 
                       VALUES('$name', '$lastName','$email', '$abc123','$user_role','$phone_number','$password','$gender')");
   // mysql inserting a new row
    
//	$result = $con->query("INSERT INTO users(email, abc123, password) 
//                          VALUES('$email', '$abc123','$password')");

	//echo "after query";
 
   // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    
// required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    // echoing JSON response
    echo json_encode($response);
}
?>
