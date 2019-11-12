<?php 
 include('../admin/database/connection.php');
    if(isset($_POST['action']) && $_POST['action'] == 'removeec'){
    	$userid = mysqli_real_escape_string($conn,$_POST['userid']);
    	$quest = $conn->query("UPDATE users SET status='2' WHERE userid = '$userid'");
    	if($quest){
    		echo json_encode(array('code' => 101));
    	}
    }
?>