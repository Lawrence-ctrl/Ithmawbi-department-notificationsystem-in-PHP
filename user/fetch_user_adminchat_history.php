<?php
	include_once('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   date_default_timezone_set('Asia/Rangoon');
     if(isset($_POST['userid'])) {
     	$from = $_SESSION['userid'];
     	$to = $_POST['userid'];
         echo fetch_user_adminchat_history($from,$to);
 }
?>