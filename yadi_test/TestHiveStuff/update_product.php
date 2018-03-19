<?php
 header("Access-Control-Allow-Origin: *");

/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();

// array for JSON response
$response = array();
//get the data that was sent
$json = file_get_contents('php://input');

//decode it
$obj = json_decode($json);

//place in $_POST array, kinda cheating but whatever
foreach ($obj as $key => $value) {
   // echo "$key => $value\n";
    $_POST[$key] = $value;
}

 
// check for required fields
if (isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
    require 'config.php';

 
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
 
    // include db connect class
    //require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    //$db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = $con->query("UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE pid = $pid");
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>