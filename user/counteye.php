<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   if(isset($_POST['noti_id']))
   {
   	$noti_id = mysqli_real_escape_string($conn,$_POST['noti_id']);
   	$crow = $conn->query("SELECT viewers.*,users.* FROM viewers LEFT JOIN users ON viewers.user_id = users.userid WHERE post_id = '$noti_id'");
  
   	foreach ($crow as $white) {
   	$output = '<p><img src="../admin/userprofiles/'.$white['userphoto'].'" class="rounded-circle" style="height: 25px; width:25px"> &nbsp; &nbsp;'.$white['username'].'</p>';
   	echo $output;
   }
  }