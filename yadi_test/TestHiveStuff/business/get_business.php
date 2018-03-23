
<?php
header("Access-Control-Allow-Origin: *");
require 'config.php';
 
/*
 * Following code will get single product details
 * A product is identified by product id (businessId)
 */
 
// array for JSON response
$response = array();

 
// check for post data
if (isset($_GET["businessId"])) {
     $businessId = $_GET['businessId'];
    // // get a business from businesss table
     //turn to int
     //intval($businessId);
     $result = $con->query("SELECT * FROM business WHERE businessId = $businessId");

 
    if (!empty($result)) {
        // check for empty result
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $business = array();
            $business["businessId"] = $row["businessId"];
            $business["name"] = $row["name"];
            $business["location"] = $row["location"];
            $business["hours"] = $row["hours"];

            // success
            $response["success"] = 1;
 
            // business node
            $response["business"] = array();
 
            array_push($response["business"], $business);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no business found
            $response["success"] = 0;
            $response["message"] = "No business found";
 
            // echo no businesss JSON
            echo json_encode($response);
        }
    } else {
        // no business found
        $response["success"] = 0;
        $response["message"] = "No business found";
 
        // echo no businesss JSON
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