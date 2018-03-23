
<?php
header("Access-Control-Allow-Origin: *");
require 'config.php';
 
/*
 * Following code will get single product details
 * A product is identified by product id (userId)
 */
 
// array for JSON response
$response = array();

 
// check for post data
if (isset($_GET["userId"])) {
     $userId = $_GET['userId'];
    // // get a user from users table
     //turn to int
     //intval($userId);
     $result = $con->query("SELECT * FROM users WHERE userId = $userId");

 
    if (!empty($result)) {
        // check for empty result
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = array();
            $user["userId"] = $row["userId"];
            $user["name"] = $row["name"];
            $user["abc123"] = $row["abc123"];
            $user["email"] = $row["email"];
            $user["user_role"] = $row["user_role"];
            $user["street_address"] = $row["street_address"];
            $user["phone_number"] = $row["phone_number"];
            $user["user_rating"] = $row["user_rating"];


            // success
            $response["success"] = 1;
 
            // user node
            $response["user"] = array();
 
            array_push($response["user"], $user);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no user found
            $response["success"] = 0;
            $response["message"] = "No user found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no user found
        $response["success"] = 0;
        $response["message"] = "No user found";
 
        // echo no users JSON
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