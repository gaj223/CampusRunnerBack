<?php
header("Access-Control-Allow-Origin: *");
require '../config/config.php';
// array for JSON response
$response = array();
//get the data that was sent

//decode it
//var_dump($obj);
$received_data = parseData();
//var_dump($received_data);
if(checkData($received_data) < 0){
	sendError("Required fields missing");
}
echo "parsed data";
echo "<br>";

initialCreate($received_data, $con);
function parseData(){
	$json = file_get_contents('php://input');
	$obj = json_decode($json);
		//place in $_POST array, kinda cheating but whatever
	foreach ($obj as $key => $value) {
	    //echo "$key => $value\n";
	    $_POST[$key] = $value;
	}
		$data = array(
			"buyerId"=> $_POST['buyerId'],
			"status"=> $_POST['status'],
			"businessId"=> $_POST['businessId'],
			"buyerNote" => $_POST['buyerNote'],
			"buyerLocation" => $_POST['buyerLocation'],
			"itemList" => $_POST['itemList'],
			);
		return $data;
}
function checkData($data){
	foreach ($data as $key => $value) {
		echo "<br>Check Data: <br>$key => $value";
		if(
			($value==NULL) || (!isset($value))
			){
			if ($key == "buyerNote")
				{continue;}
			echo"empty: ".empty($key[$value]);
		var_dump(empty($key[$value]));
			echo "\n not set ".!isset($key[$value]);
			echo "fail $key => $value";
			var_dump(!isset($key[$value]));
			return -1;
		}
	}
	return 1;

}
function initialCreate($data, $con){
	//var_dump($data);
	//echo"id: ". $data["buyerId"];
	//echo "status:". $data["status"];
	//query to create order with id and status
	if($con->query("INSERT INTO orders(buyerId, status) VALUES(".$data["buyerId"].",' ".$data["status"]."');") == TRUE){
		$last_id = $con->insert_id;
    	//echo "New record created successfully. Last inserted ID is: " . $last_id;}
		//function call
		addItemInfo($con, $last_id, $data);

	}
	else{
		//echo "row = $result->num_rows";
		//echo "Error: " . $sql . "<br>" . $con->error;
		sendError("there was an error with initial query $con->error");
		
	}
   

}
function addItemInfo($con,$last_id, $data){
	//$order = new stdclass();
	//Start to build order
	$order = array();
	$order["orderId"]= $last_id;
	$order["buyerId"]= $data["buyerId"];
	$order["businessId"]= $data["businessId"];
	$order["buyerNote"] = $data["buyerNote"];
	$order["buyerLocation"] = $data["buyerLocation"];

	var_dump($data["itemList"] );
	echo"<br><br>";
	// $size = count($data["itemList"]);
	// for($i =0; $i< $size; $i++){
	// 	$itemId = $data["itemList"][i]["id"];
	// 	echo "id = $itemId";
	// }
	//get items ordered
	$order["itemList"] = array();
	//$order->itemList = array();
	$item = new stdclass();
	foreach($data["itemList"] as $it){
		// echo "item: $item["id"]";
		//  echo "q: $item["quantity"]";
		$itemId = $it->id;
		$quantity= $it->quantity;
		if(!$addItems = $con->query("INSERT INTO order_item (orderId, itemId, quantity) VALUES($last_id, $itemId, $quantity);")){
			sendError("There was an Error with Items query $con->error");
		}
		else{
			if(!$getItemInfo = $con->query("SELECT itemId, name, price FROM item WHERE itemId =$itemId;")){
			sendError("There was an Error with Items query $con->error");
			}
			else{
				if($getItemInfo->num_rows >0){
					$row = $getItemInfo->fetch_assoc();
					$item->name =$row["name"];
					$item->price = $row["price"];
					$item->quantity = $quantity;
				}
				
			}

		}
		//add item into array itemList
		array_push($order["itemList"], $item);
		//var_dump($order);	
		
	}
	
		//pretty print
		$json_string = json_encode($order, JSON_PRETTY_PRINT);
		echo "<br><br>$json_string";
	sendResponse($order);	
}



function sendResponse($order){
	$response["order"]= array();
	$response["success"] = 1;
    $response["order"] = $order;
	echo json_encode($response);
}
function sendError($message){
	$response["success"] = 0;
    $response["message"] = "$message";
	echo json_encode($response);
	exit();
}
// array for JSON response


//query 
//create order
//CHECK BUYERID 
//check all the same business id also 
//check quantity 
// if(isset($_POST['buyerId']) && isset($_POST['status'])){
// 	  //For initial create
// 	$buyerId = $_POST['buyerId'];
// 	$status = $_POST['status'];
// 	$businessId = $_POST['businessId'];
// 	$buyerNote = $_POST['buyerNote'];
// 	$buyerLocation = $_POST['buyerLocation'];
    
//     //query to create order with id and status
// 	if(!$initialCreate = $con->query("INSERT INTO orders (buyerId, status) VALUES(1, "open");
// SET @OrderId = LAST_INSERT_ID();")){
//    // die('There was an error running the query [' . $con->error . ']');
// 		echo "there was an error with query";
// 	}

// if ($initialCreate) {
// 	echo"Created initial order";
// 	$order = array();
// 	//$order["orderId"]= $row["orderId"];


//     //get items
//     foreach ($_POST['itemList'] as $item => $value) {
//     	//json_decode(item);
//     	foreach($item as )
// 	    	//query to create order with id and status
// 				if(!$addItems = $con->query("INSERT INTO order_item (orderId, itemId, quantity) VALUES(@OrderId, 2, 1);")){
			 
// 					echo "there was an error with query";
// 				}
	    		
// 	    }
	
	

	

	

// }
// else{echo"Failed to create initial order";}
// // check for empty result
// if ($result->num_rows > 0) {
// 	$row = $result->fetch_assoc();
// 	$order = array();
// 	$order["orderId"]= $row["orderId"];

// 	if($orderId){

// 	    //get items
// 	    foreach ($_POST['itemList'] as $key => $value){

// 	    	//query to create order with id and status
// 				if(!$initialCreate = $con->query("INSERT INTO order_item (orderId, itemId, quantity) VALUES(@OrderId, 2, 1);")){
			 
// 					echo "there was an error with query";
// 				}
	    		
// 	    }
// 	}
// }


  

//     //mysql
// }
// INSERT INTO orders (buyerId, status) VALUES(1, "open");
// SET @OrderId = LAST_INSERT_ID();
// //onlyworks for one order
// INSERT INTO order_item (orderId, itemId, quantity) VALUES(@OrderId, 2, 1);

// //Thinking of adding an aggerated function to compute total because we would need that to show history.
// //something like this
// SELECT orders.orderId, users.userid, item.itemId, SUM(price * order_item.quantity) AS total FROM item, order_item INNER JOIN orders ON orders.orderId = order_item.orderId INNER JOIN users ON users.userId = orders.buyerId WHERE order_item.orderId = 6 GROUP BY users.userId ORDER BY total DESC LIMIT 5

// // ^^if i add that I would need to return total and get fees.

// //get total
// SELECT 
// 	*,
// 	sum(order_item.quantity * item.price) as total
// FROM order_item
// INNER JOIN item
// ON order_item.itemId= item.itemId
// INNER JOIN orders
// ON order_item.orderId = orders.orderId

// WHERE orders.orderId = 1;

?>