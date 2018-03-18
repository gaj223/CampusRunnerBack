<?php
// include db connect class
//require_once __DIR__ . '/db_connect.php';
require "config.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
$json = file_get_contents('php://input');
$obj = json_decode($json);
//echo $test;
echo "get: \n";
var_dump($obj);
echo "print: ";
foreach ($obj as $key => $value) {

    echo "$key => $value\n";
    $_POST[$key] = $value;
}
 
// check for required fields
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
 

 echo"before query";
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = $con->query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");
 
    // check if row inserted or not
    echo "after query\n";
    var_dump($result);
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
    //array for Post variables
    
// required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
