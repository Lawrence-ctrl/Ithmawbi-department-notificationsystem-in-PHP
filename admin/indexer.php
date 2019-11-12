<?php
include('database/connection.php');
include('adminauth.php');
if(isset($_POST['action']) && $_POST['action'] == 'deletenoti')
   {
      $delete_id = mysqli_real_escape_string($conn,$_POST['trashid']);
      $hoho = $conn->query("DELETE FROM posts WHERE post_id = '$delete_id'");
      if($hoho){
        $mada = $conn->query("DELETE FROM viewers WHERE post_id = '$delete_id'");
      }if($mada){
        $mara = $conn->query("DELETE FROM saved WHERE saved_post_id = '$delete_id'");
      }
       if($mara) {
        echo json_encode(array('code' => 100));
    	}
   }
?>