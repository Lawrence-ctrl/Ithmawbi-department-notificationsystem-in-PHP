<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
   if(isset($_POST)){
   	  $id = mysqli_real_escape_string($conn,$_POST['remove_id']);
   	  $cool = $conn->query("DELETE FROM examdates WHERE examdates_id = '$id'");
   }
?>