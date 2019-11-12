<?php
 session_start();
 unset($_SESSION['userid']);
 unset($_SESSION['useremail']);
 unset($_SESSION['login_id']);
 header("location: userlogin.php");
 exit;
?>