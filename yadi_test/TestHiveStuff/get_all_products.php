<?php
header("Access-Control-Allow-Origin: *");
echo "hello";
/*
 * Following code will list all the products
 */
 
// array for JSON response
 $response = array();
 
// include db connect class
// //require_once __DIR__ . '/db_connect.php';
 
// // connecting to db
require 'config.php';
 echo "made it past config";

// get all products from products table
// $result = $con->query("SELECT *FROM products") or die($con->error());
 //$result = $con->query("SELECT *FROM products");
 //echo "after query";
 //echo $con->error();
 //echo "I guess no errors"

//erase after
// echo $result->num_rows();
// check for empty result
//if ($result->num_rows() > 0) {
    // looping through all results
    // products node
   // $response["products"] = array();
 //}
echo "\nCon var: \n";
//var_dump($con);
if(!$result = $con->query("SELECT * FROM products")){
   // die('There was an error running the query [' . $con->error . ']');
	echo "there was an error with query";
}
var_dump($con);
echo"\n\n\nResult dump: \n"
//var_dump($result);
 // fot now
//     while ($row = $result->fetch_assoc() {
//         // temp user array
//         $product = array();
//         $product["pid"] = $row["pid"];
//         $product["name"] = $row["name"];
//         $product["price"] = $row["price"];
//         $product["created_at"] = $row["created_at"];
//         $product["updated_at"] = $row["updated_at"];
 
//         // push single product into final response array
//         array_push($response["products"], $product);
//     }
//     // success
//     $response["success"] = 1;
 
//     // echoing JSON response
//     echo json_encode($response);
// } else {
//     // no products found
//     $response["success"] = 0;
//     $response["message"] = "No products found";
 
//     // echo no users JSON
//     echo json_encode($response);
//}
?>
