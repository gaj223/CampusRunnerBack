<?php
 header("Access-Control-Allow-Origin: *");
//var_dump($_POST);
 echo json_encode($_POST);
/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */
 
//array for JSON response
$response = array();


//get the data that was sent
$json = file_get_contents('php://input');
//var_dump($json);
//decode it
$obj = json_decode($json);

//place in $_POST array, kinda cheating but whatever
foreach ($obj as $key => $value) {
   // echo "$key => $value\n";
    $_POST[$key] = $value;
}

 
// check for required fields
if (isset($_POST['orderId'])) {
    require '../config/config.php';

    $orderId = $_POST['orderId'];
    $runnerId = $_POST['runnerId'];
    $time_started = date(h:m);
    $status = $_POST['status']

 switch ($status) {
 	case 'pending':
 		//get format later
 		$time_started = date(h:m);
        $result = $con->query("UPDATE orders SET status = '$status',
            time_started ='$time_started' WHERE orderId ="1";");
 		break;
 	case 'complete'
	 	$time_completed = date(h:m);
	 	$result = $con->query("UPDATE orders SET status = '$status',
	 		time_completed ='$time_completed' WHERE orderId ="1";");
 		break;
 	case 'canceled'	
 		$runnerId ="null";
        $result = $con->query("UPDATE orders SET status = '$status',
            time_completed ='$time_completed' WHERE orderId ="1";");
 		break;
 	default:
 		# code...
 		break;
 }
    // mysql update row with matched pid
    
 
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