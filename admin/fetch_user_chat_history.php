<?php
	include_once('database/connection.php');
   include('adminauth.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
     if(isset($_POST['userid'])) {
     	$from = $_SESSION['admin_id'];
     	$to = $_POST['userid'];
         echo fetch_user_chat_history($from,$to);
 }
?>