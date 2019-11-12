<?php 
   include_once('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   date_default_timezone_set('Asia/Rangoon');
   $rea = $conn->query("SELECT users.*, years.* FROM users LEFT JOIN years ON users.year_id = years.years_id WHERE userid!='".$_SESSION['userid']."' ORDER BY userid ASC");	
   foreach ($rea as $king => $react) {
     $status = '';
     $current_time = strtotime(date('Y-m-d H:i:s').'-10 second');
     $current = date('Y-m-d H:i:s',$current_time);
     $user_last_activity = fetch_user_last_activity($react['userid']);
     if($user_last_activity > $current) {
      $status = '<button class="btn btn-success">Online</button>';
     }else{
      $status = '<button class="btn btn-danger">Offline</button>';
     }
     $out = '';
     if($react['status'] == 1){
      $out.= "Teacher";
     }elseif($react['status'] == 2){
      $out.= $react['years_name'];
     }else{
      $out.= $react['years_name']." (EC)";
     }
    $output = '<tr>
              <td><img src="../admin/userprofiles/'.$react['userphoto'].'" style="height:25px; width:25px"></td>
    				  <td>'.$react['username'].'<i style="text-align:right"> &nbsp;'.count_unseen_message($react['userid'],$_SESSION['userid']).'</i></td>
              <td>'.$out.'</td>
    				  <td>'.$status.'</td>
    				  <td><a href="chat-private.php?userid='.$react['userid'].'" name="chat" data-id='.$react['userid'].' id="chatt" class="btn btn-info chatt"><i class="fas fa-location-arrow"></i> &nbsp;Start Chat</a>
    				  </td>
    				  </tr>';
            echo $output;
   } 
?>   