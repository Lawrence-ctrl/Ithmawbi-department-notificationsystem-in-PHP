<?php
   function passcheck($password,$adminid,$email) {
    global $conn;
    $check = $conn->query("SELECT * FROM admin WHERE admin_pass='$password' AND admin_id ='$adminid' AND admin_email='$email'");
    if($check->num_rows>0){
      return true;
    }else{
      return false;
    }
   }
   
   function clean($string) {
   	    global $conn;
   		return mysqli_real_escape_string($conn,$string);
   }
   function checkemail($email){
   		global $conn;
   		$check = $conn->query("SELECT * FROM users WHERE useremail = '$email'");
   		if($check->num_rows>0){
   			return false;
   		}else{
   			return true;
   		}
   }
   function checker($username,$userid){
         global $conn;
         $check = $conn->query("SELECT * FROM users WHERE username='$username' AND userid != $userid");
         if($check->num_rows>0){
            return false;
         }else{
            return true;
         }
   }
   function count_unseen_message($from,$to){
    global $conn;
    $king = $conn->query("SELECT * FROM chat_message WHERE chat_admin_id=$from AND to_user_id=$to AND status='1'");
    $king_count = $king->num_rows;
    $output= '';
    if($king_count > 0){
      $output .='<button class="btn btn-success btn-sm">'.$king_count.'</button>';
    }
    return $output;
  }
   function checkingemailid($email,$userid){
         global $conn;
         $check = $conn->query("SELECT * FROM users WHERE useremail='$email' AND userid !='$userid'");
          if($check->num_rows > 0){
            return false;
         }else{
            return true;
         }
   }
   function fetch_user_chat_history($from,$to){
         global $conn;
         $check = $conn->query("SELECT * FROM chat_message WHERE (chat_admin_id = $from AND to_user_id = $to) OR (chat_admin_id = $to AND to_user_id ='$from')");
            $output = '';
   foreach ($check as $key => $value) {
         if($value['chat_admin_id'] == $from) {
            $output .= '<div class="row msg_container base_sent">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent mess" data-id='.$value['chat_message_id'].'>
                                <p>'.$value['messages'].'</p><i class="fa fa-times text-danger ca cross'.$value['chat_message_id'].'" id='.$value['chat_message_id'].' style="display:none;"></i>
                                <time>'.date('H:i A',strtotime($value['timee'])).'</time>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar text-right">
                            <img src="adminprofiles/'.getadmin($from).'" class=" img-responsive ">
                        </div>
                    </div>';
         }else{
            $output .= '<div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="userprofiles/'.getuser($to).'" class=" img-responsive ">
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <p>'.$value['messages'].'</p>
                                <time>'.date('H:i A',strtotime($value['timee'])).'</time>
                            </div>
                        </div>
                    </div>';
         }     
   }
   $output .= '</div>';
    $korea = $conn->query("UPDATE chat_message SET status='0' WHERE chat_admin_id='$to' AND to_user_id ='$from' AND status='1'");
   return $output;
   }

   function getuser($userid){
   global $conn;
   $king = $conn->query("SELECT * FROM users WHERE userid = $userid");
   foreach ($king as $key => $value) {
      return $value['userphoto'];
   }
  }

   function getadmin($userid){
    global $conn;
    $king = $conn->query("SELECT * FROM admin WHERE admin_id = $userid");
    $value = $king->fetch_array();
      return $value['admin_photo'];
    }

    function fetch_user_last_activity($userid){
   global $conn;
   $kara = $conn->query("SELECT * FROM login_details WHERE user_id = '$userid' ORDER BY last_activity DESC");
   foreach ($kara as $key => $value) {
      return $value['last_activity'];
   }
  }
?>