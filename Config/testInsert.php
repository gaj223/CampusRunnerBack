<?php
  require 'creds.php';
  //http://13.59.142.19/CampusRunnerBack/testInsert.php/addUserTest{var}{var2}
  function addUserTest(){

  $testSql = "INSERT INTO users (userId, abc123, email, name,
    user_role,street_address, phone_number, user_rating, password) VALUES('Test',tes123
    test@me.com, Testrone, testRole,)";
    if($conn->query($testSql) == TRUE){
      echo "Record Test is good";
    }else {
      echo "Error: test did not pass";
      echo "Error: ". $testSql . "<br>" . $conn->error;
    }
  }
  addUserTest();
?>
