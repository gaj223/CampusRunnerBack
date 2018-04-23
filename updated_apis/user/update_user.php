<?php
 header("Access-Control-Allow-Origin: *");
//var_dump($_POST);
 echo json_encode($_POST);
/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */
 
array for JSON response
$response = array();


//get the data that was sent
$json = file_get_contents('php://input');
//var_dump($json);
//decode it
$obj = json_decode($json);

//place in $_POST array, kinda cheating but whatever
// foreach ($obj as $key => $value) {
//    // echo "$key => $value\n";
//     $_POST[$key] = $value;
// }

 
// check for required fields
if (isset($_POST['userId'])) {
    require '../config.php';

    $userId = $_POST['userId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $street_address = $_POST['street_address'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
 
    // include db connect class
    //require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    //$db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = $con->query("UPDATE users SET name = '$name', email = '$email', phone_number = '$phone_number', password = '$password', street_address = '$street_address' WHERE userId = $userId");
 
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