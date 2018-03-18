
<?php
require_once __DIR__ . '/db_config.php';
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables


        // Connecting to mysql database
        $con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

 
            // $con = mysqli_connect("13.59.142.19","yadi","abc123","yadiTest");
     
   
        if($con->connect_error){
            die("Connection failed: " . $con->connect_error);
    
        }
       else{echo"Successful connection";}
 
        // Selecing database
        // $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
 
        // returing connection cursor
        return $con;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        //mysql_close();
        mysqli_close($con);
    }
 
}
// $connection = new DB_CONNECT();
 
?>