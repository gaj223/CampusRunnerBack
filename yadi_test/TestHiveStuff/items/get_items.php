
<?php
header("Access-Control-Allow-Origin: *");
require 'config.php';
 
/*
 * Following code will get all items associated 
 * to a businessId
 */
 
// array for JSON response
$response = array();

 
// check for post data
if (isset($_GET["businessId"])) {
     $businessId = $_GET['businessId'];
    // // get a item from items table
     //turn to int
     //intval($itemId);
     $result = $con->query("SELECT * FROM item WHERE businessId = $businessId");

 
    if (!empty($result)) {
        // check for empty result
        if ($result->num_rows > 0) {
               $response["items"] = array();
            //loop through all results
            while($row = $result->fetch_assoc()){
                //temp array
                $item = array();
                $item["itemId"] = $row["itemId"];
                $item["name"] = $row["name"];
                $item["price"] = $row["price"];
                $item["businessId"] = $row["businessId"];
                //push item into response array
                array_push($response["items"], $item);
            }
]
            // success
            $response["success"] = 1;
 
            // item node
            $response["item"] = array();
 
            array_push($response["item"], $item);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no item found
            $response["success"] = 0;
            $response["message"] = "No item found";
 
            // echo no items JSON
            echo json_encode($response);
        }
    } else {
        // no item found
        $response["success"] = 0;
        $response["message"] = "No item found";
 
        // echo no items JSON
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