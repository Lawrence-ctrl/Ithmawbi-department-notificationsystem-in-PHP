<?php
  function fetch_user_last_activity($userid){
  	global $conn;
  	$kara = $conn->query("SELECT * FROM login_details WHERE user_id = '$userid' ORDER BY last_activity DESC");
  	foreach ($kara as $key => $value) {
  		return $value['last_activity'];
  	}
  }
  function fetch_user_chat_history($from,$to){
  	global $conn;
  	$kara = $conn->query("SELECT * FROM chat_message WHERE (from_user_id = $from AND to_user_id = $to) || (from_user_id = $to AND to_user_id = $from)");
  	$output = '';
  	foreach ($kara as $key => $value) {
  
      	if($value['from_user_id'] == $from) {
      		$output .= '<div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send mess" data-id="'.$value['chat_message_id'].'">
                   '.$value['messages'].'
                   <i class="fas fa-times text-danger ca cross'.$value['chat_message_id'].'" id='.$value['chat_message_id'].' style="display:none;"></i>
                </div>
                  <div class="img_cont_msg">
                  <img class="rounded-circle" src="../admin/userprofiles/'.getusername($value['from_user_id']).'" style="height:20px; width:20px;">
                </div>
              </div>';
      	}else{
      		$output .= '<div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg" style="padding-left:20px;">
                  <img class="rounded-circle" src="../admin/userprofiles/'.getusername($value['from_user_id']).'" style="height:20px; width:20px;">
                </div>
                <div class="msg_cotainer">
                    '.$value['messages'].'
                </div>
              </div>';
      	}     
  	}
  	$output .= '</div>';
    $korea = $conn->query("UPDATE chat_message SET status='0' WHERE from_user_id = '$to' AND to_user_id ='$from' AND status='1'");
  	return $output;
  }
  function fetch_user_adminchat_history($from,$to) {
      global $conn;
    $kara = $conn->query("SELECT * FROM chat_message WHERE (chat_admin_id = $from AND to_user_id = $to) || (chat_admin_id = $to AND to_user_id = $from)");
    $output = '';
    foreach ($kara as $key => $value) {
  
        if($value['chat_admin_id'] == $from) {
          $output .= '<div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send mess" data-id='.$value['chat_message_id'].'>
                   '.$value['messages'].'
                    <i class="fas fa-times text-danger ca cross'.$value['chat_message_id'].'" id='.$value['chat_message_id'].' style="display:none;"></i>
                </div>
                  <div class="img_cont_msg">
                  <img class="rounded-circle" src="../admin/userprofiles/'.getusername($value['chat_admin_id']).'" style="height:20px; width:20px;">
                </div>
              </div>';
        }else{
          $output .= '<div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg" style="padding-left:20px;">
                  <img class="rounded-circle" src="../admin/adminprofiles/'.getadmin($to).'" style="height:20px; width:20px;">
                </div>
                <div class="msg_cotainer">
                    '.$value['messages'].'
                </div>
              </div>';
        }     
    }
    $output .= '</div>';
    return $output;
  }
  function getusername($userid){
  	global $conn;
  	$king = $conn->query("SELECT * FROM users WHERE userid=$userid");
  	foreach ($king as $key => $value) {
  		return $value['userphoto'];
  	}
  }

  function getadmin($userid){
    global $conn;
    $king = $conn->query("SELECT * FROM admin WHERE admin_id=$userid");
    $value = $king->fetch_array();
      return $value['admin_photo'];
    }

   function count_unseen_message($from,$to){
    global $conn;
    $king = $conn->query("SELECT * FROM chat_message WHERE from_user_id=$from AND to_user_id=$to AND status='1'");
    $king_count = $king->num_rows;
    $output= '';
    if($king_count > 0){
      $output .='<button class="btn btn-success btn-sm">'.$king_count.'</button>';
    }
    return $output;
  }
  function clean($string)
  {
    global $conn;
    return mysqli_real_escape_string($conn,$string);
  }
  function checksea($post_id,$userid) 
  {
    global $conn;
    $ninja = $conn->query("SELECT * FROM viewers WHERE post_id = '$post_id' AND user_id = '$userid'");
    $ninja_count = $ninja->num_rows;
    if($ninja_count > 0){
      return false;
    }else{
      return true;
    }
  } 
  function countcount($userid) 
  {
    global $conn;
    $neon = $conn->query("SELECT viewers.*, posts.* FROM viewers LEFT JOIN posts ON viewers.post_id = posts.post_id WHERE user_id = '$userid' AND posts.post_userid != '$userid'");
    $nose = $neon->num_rows;
    $nose = $neon->num_rows;
    return $nose;
  } 
  function fetch_group_chat_history($from){
    global $conn;
    $kara = $conn->query("SELECT * FROM chat_message WHERE to_user_id = '0'");
    $output = '';
    foreach ($kara as $key => $value) {
        if($value['from_user_id'] == $from) {
          $output .= '<div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send mess" data-id='.$value['chat_message_id'].'>
                   '.$value['messages'].'
                    <i class="fas fa-times text-danger ca cross'.$value['chat_message_id'].'" id='.$value['chat_message_id'].' style="display:none;"></i>
        
                </div>
                  <div class="img_cont_msg">
                  <img class="rounded-circle" src="../admin/userprofiles/'.getusername($value['from_user_id']).'" style="height:20px; width:20px;">
                </div>
              </div>';
        }else{
          $output .= '<div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg" style="padding-left:20px;">
                  <img class="rounded-circle" src="../admin/userprofiles/'.getusername($value['from_user_id']).'" style="height:20px; width:20px;">
                </div>
                <div class="msg_cotainer">
                    '.$value['messages'].'
                </div>
              </div>';
        }     
    }
    $output .= '</div>';
    return $output;
  }
  function checkusername($username)
  {
    global $conn;
    $nice = $conn->query("SELECT * FROM users WHERE username LIKE '%".$username."%'");
    if($nice->num_rows>0) {
      return false;
    }else{
      return true;
    }
  }
  function checkemail($email)
  {
    global $conn;
    $res = $conn->query("SELECT * FROM users WHERE useremail='$email'");
    if($res->num_rows >0){
      return false;
    }else{
      return true;
    }
  }
  function passcheck($password,$id,$email){
    global $conn;
    $res = $conn->query("SELECT * FROM users WHERE useremail = '$email' AND userid = '$id' AND userpass = '$password'");
    if($res->num_rows > 0){
      return true;
    }else{
      return false;
    }
  }
  function checker($name,$id){
    global $conn;
    $res = $conn->query("SELECT * FROM users WHERE username LIKE '%".$name."%' AND userid !='$id'");
      if($res->num_rows > 0) {
        return false;
      }else{
        return true;
      }
  }
  function checkingemail($email,$id){
    global $conn;
    $res = $conn->query("SELECT * FROM users WHERE useremail='$email' AND userid!='$id'");
     if($res->num_rows > 0) {
        return false;
      }else{
        return true;
      }
  }

?>
 <!-- <span class="msg_time" style="margin-bottom:-15px;">'.$value['timee'].'</span> -->