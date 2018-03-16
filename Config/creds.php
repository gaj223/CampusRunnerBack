<?php
// connect to the mysql database
// mysqli_connect(host,username,password,dbname,port,socket);
$conn = mysqli_connect('13.59.142.9', 'migs', 'abc123', 'migsTest');
mysqli_set_charset($conn,'utf8');
if ($conn->connect_error) {//version 5.2.9
    die("Connection failed: google, " . $conn->connect_error);
}
echo "Connected successfully,you did something correct, now do more";
//dont forget to close connection when you dont need it, $conn->close();

// Check connection for version 5.3.0
//if (mysqli_connect_error()) {
//    die("Database connection failed: " . mysqli_connect_error());
//}
?>
