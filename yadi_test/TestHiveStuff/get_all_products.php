<?php
header("Access-Control-Allow-Origin: *");
echo "hello";
/*
 * Following code will list all the products
 */
 
// array for JSON response
// $response = array();
 
// // include db connect class
// //require_once __DIR__ . '/db_connect.php';
 
// // connecting to db
// //$db = new DB_CONNECT();
// //  require 'config.php';
 
// // get all products from products table
// $result = $con->query("SELECT *FROM products") or die($con->error());
 
// // check for empty result
// if ($result->num_rows() > 0) {
//     // looping through all results
//     // products node
//     $response["products"] = array();
 
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
}
?>
