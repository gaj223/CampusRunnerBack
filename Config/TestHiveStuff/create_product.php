<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();

$json = file_get_contents('php://input');
var_dump($json);
$phpObj = json_decode($json);
var_dump($json);
foreach ($phpObj as $key => $value) {
    echo "echo $key => $value\n";
    $_POST[$key] = $value;
}


    require 'db_config.php';

//Mig added...delete later if you want.
/*
if(count($_POST)){
    $name ='';
    if(isset($_POST['name'])){
        $name = $_POST['user'];
    if ($name==null || !$name)
         echo 'name is null';
     echo strlen($username);
     echo json_encode( $name );
   

 }
*/
//end of mig added 
// check for required fields
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
     
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
 
    // include db connect class
//    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
   //trying it out yadi way $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");
    
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
        $response["message"] = "Oops! An error occurred...failed to insert row";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing::::";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
