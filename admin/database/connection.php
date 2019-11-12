<?php
   $conn = mysqli_connect('localhost','root','','fortu');
   if ($conn->connect_error) 
   {
    die("Connection failed: " . $conn->connect_error);
   }
?>