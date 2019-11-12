<?php 
   include('../admin/database/connection.php');
   if(isset($_POST['deleted']))
   {  
      $notiid = mysqli_real_escape_string($conn,$_POST['notiid']);
      $madara = $conn->query("DELETE FROM posts WHERE post_id = '$notiid'");
      if($madara){
        $mada = $conn->query("DELETE FROM viewers WHERE post_id = '$notiid'");
      }if($mada){
        $mara = $conn->query("DELETE FROM saved WHERE saved_post_id = '$notiid'");
      }

       if($mara)
  		 {
  		 	echo json_encode(array('code' =>101));
  		 	exit;
  		 }
   }
?>