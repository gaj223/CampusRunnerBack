<?php 
	$email = $_POST['email'];
	$name  = $_POST['name'];
	print_r(json_encode($_POST));
	echo "Connection made,$email and $name";
?>
