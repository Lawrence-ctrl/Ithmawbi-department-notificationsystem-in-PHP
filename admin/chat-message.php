<?php
	include_once('database/connection.php');
   include('adminauth.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
     if(isset($_POST['to_user_id'])) {
     	$from = $_SESSION['admin_id'];
     	$to = $_POST['to_user_id'];
     	$messages = clean($_POST['message']);
     $quar = $conn->query("INSERT INTO chat_message(chat_admin_id,to_user_id,messages,status,timee) VALUES ('$from','$to','$messages','1',now())");
         echo fetch_user_chat_history($from,$to);
      }
?>