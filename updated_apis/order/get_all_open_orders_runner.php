<?php
header("Access-Control-Allow-Origin: *");
require '../config/config.php';
// array for JSON response
$response = array();


// check for post data
if (isset($_GET["userId"])) {
     $orderId = $_GET['userId'];

     $result = $con->query("Select orderId, status, runnerId
		FROM orders
		WHERE
		status = 'open'
		AND userId !=runnerId;");

 
    if (!empty($result)) {
        // check for empty result
        if ($result->num_rows > 0) {
        	//get date
               $response["open_orders"] = array();
            //loop through all results
            while($row = $result->fetch_assoc()){
                //temp array
                $order = array();
                $order["orderId"] = $row["orderId"];
                $order["runnerId"] = $row["runnerId"];
                $order["businessId"] = $row["businessId"];
                $order["itemId"] = $row["itemId"];
                $order["price"]= $row["price"];
                $order["status"]= $row["status"];
                $order["date"]= $date;

                //push item into response array
                array_push($response["order"], $order);
            }

            // success
            $response["success"] = 1;
 
            // item node
            $response["order"] = array();
 
            array_push($response["order"], $order);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no order found
            $response["success"] = 0;
            $response["message"] = "No order found";
 
            // echo no orders JSON
            echo json_encode($response);
        }
    } else {
        // no order found
        $response["success"] = 0;
        $response["message"] = "No order found";
 
        // echo no orders JSON
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