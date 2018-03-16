<?php
class Database{
 
    // specify your own database credentials
    private $host = "13.59.142.19";
    private $db_name = "migsTest";
    private $username = "migs";
    private $password = "abc123";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
//Database db = new Database();
getConnection();
?>

<?php
// connect to the mysql database
// mysqli_connect(host,username,password,dbname,port,socket);
//	$conn = mysqli_connect('13.59.142.9', 'migs', 'abc123', 'migsTest');
//	mysqli_set_charset($conn,'utf8');
//	if ($conn->connect_error) {//version 5.2.9
  //  		die("Connection failed: google, " . $conn->connect_error);
//	}	
//	echo "Connected successfully,you did something correct, now do more";
//dont forget to close connection when you dont need it, $conn->close();

// Check connection for version 5.3.0
//if (mysqli_connect_error()) {
//    die("Database connection failed: " . mysqli_connect_error());
//}
//?>
