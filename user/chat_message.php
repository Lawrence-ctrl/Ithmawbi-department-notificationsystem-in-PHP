<?php
	include_once('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   date_default_timezone_set('Asia/Rangoon');
     if(isset($_POST['to_user_id'])) {
     	$from = $_SESSION['userid'];
     	$to = $_POST['to_user_id'];
     	$messages = clean($_POST['message']);
     $quar = $conn->query("INSERT INTO chat_message(from_user_id,to_user_id,messages,status,timee) VALUES ('$from','$to','$messages','1',now())");
         echo fetch_user_chat_history($from,$to);
      }

    if(isset($_POST['action']) && $_POST['action'] == 'insert')
    {
      $from = clean($_SESSION['userid']);
      $message = clean($_POST['message']);
      $quar = $conn->query("INSERT INTO chat_message(from_user_id,to_user_id,messages,status,timee) VALUES ('$from','0','$message','1',now())");
      echo fetch_group_chat_history($from);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'fetch_history')
    {
      $from = clean($_SESSION['userid']);
      echo fetch_group_chat_history($from);
    }
?>