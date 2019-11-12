<?php
include('database/connection.php');
include('function.php'); 
include('adminauth.php');
   if(isset($_POST['trashid'])) {
      $trashid = mysqli_real_escape_string($conn,$_POST['trashid']);
      $shwe = $conn->query("DELETE FROM users WHERE userid = '$trashid'");
      $array = ['code' => 100];
      exit (json_encode($array));  
   }
?>