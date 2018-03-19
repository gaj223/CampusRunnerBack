
<?php
 //needed to be able to pass data between different sources
header("Access-Control-Allow-Origin: *");
/*
 * Following code will delete a product from table
 * A product is identified by product id (pid)
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
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
 
    // include db connect class
    require_once __DIR__ . '/config.php';
 
    // connecting to db
    //$db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = $con->query("DELETE FROM products WHERE pid = $pid");
 
    // check if row deleted or not
    if ($result->num_rows > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully deleted";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";
 
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
