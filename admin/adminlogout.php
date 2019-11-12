<?php
 session_start();
 unset($_SESSION['admin_id']);
 unset($_SESSION['admin_email']);
 header("location:admin-login.php");
 exit;
?>