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
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
    //made a new config file could not get object oriented one working
    require 'config.php';
    //set variables to send to query 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
 
    // connecting to db
    //$db = new DB_CONNECT();

    // mysql inserting a new row
    $result = $con->query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
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
