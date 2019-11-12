<?php 
include('adminauth.php');
include ('includes/header.php'); 
include('../user/functions.php');
include('database/connection.php');
 if(isset($_POST['message_id'])){
    $message_id = $conn->real_escape_string($_POST['message_id']);
    $wow= $conn->query("DELETE FROM chat_message WHERE chat_message_id = '$message_id'");
 }
?>