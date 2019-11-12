<?php
  session_start();
  if(empty($_SESSION['admin_id'] && $_SESSION['admin_email'])) {
  	header("location:admin-login.php");
  	exit;
  }
?>