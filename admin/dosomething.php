<?php
include('database/connection.php');
include('function.php'); 
include('adminauth.php');
   if(isset($_POST['action']) && $_POST['action'] == 'ban')
   {
   	$changeid = mysqli_real_escape_string($conn,$_POST['changeid']);
   	$user =  $conn->query("UPDATE users SET user_status = '0' WHERE userid = '$changeid'");
   	if($user){
   		$output = '<button class="btn btn-danger btn-sm remove" id="'.$changeid.'"><i class="fa fa-ban" aria-hidden="true"></i></button>';
   		echo $output;
   	}
   }
   if(isset($_POST['action']) && $_POST['action'] == 'remove')
   {
   	$removeid = mysqli_real_escape_string($conn,$_POST['removeid']);
   	$yasha =  $conn->query("UPDATE users SET user_status = '1' WHERE userid = '$removeid'");
   	if($yasha){
   		$output = '<button class="btn btn-success btn-sm change" id="'.$removeid.'"><i class="fa fa-check" aria-hidden="true"></i></button>';
   		echo $output;
   	}
   }
?>