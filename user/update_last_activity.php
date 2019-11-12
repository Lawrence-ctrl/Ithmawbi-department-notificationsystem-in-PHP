<?php 
   include_once('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   $vv = $conn->query("UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$_SESSION['login_id']."'");
?>