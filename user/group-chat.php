<?php 
 include('../admin/database/connection.php');
 include('userauth.php');
 include('functions.php');
 date_default_timezone_set('Asia/Rangoon');
?>
 <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> TU!</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="icons/themify-icons/themify-icons.css" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/chat.css" rel="stylesheet">
</head>
<body id="page-top">

   <?php include('includes/usernavbar.php');?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/usersidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="text-decoration: none;" href="chat.php">Chat</a>
          </li>
          <li class="breadcrumb-item">
            Group Chat  
          </li>
        </ol>
        <div class="row">
                    <div class="col-12 col-md-8 col-xl-6 groupchat">
          <div class="card">
            <div class="card-header msg_head">
              <div class="d-flex bd-highlight">
        
                  <!-- <img src="../admin/userprofiles/<?php echo $quer['userphoto']?>" class="rounded-circle user_img"> -->
                  <a href="#" class="btn btn-primary btn-circle">
                    <i class="fas fa-users"></i>
                  </a>
             
             
                <div class="user_info">
                  <span>Group Chat</span>
                </div>
              </div>
            </div>
            <div class="card-body msg_card_body group_chat_history">
              
            </div>
            <div class="card-footer">
              <div class="input-group">
                <textarea name="chat_message"  class="form-control type_msg group_chat_message" placeholder="Type your message..." required=""></textarea>
                <div class="input-group-append">
                  <span class="input-group-text send_btn"><i class="fas fa-location-arrow fa-lg send_group_message"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
     

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 <?php include('includes/logoutmodal.php'); ?>

<?php include('includes/userfooter.php');?>
 <script type="text/javascript">
   $(document).ready(function() {
    setInterval(function(){
     fetch_group_chat_histroy();
    },1000);
    $('.send_group_message').click(function(){
       var message = $('.group_chat_message').val();
       var action = 'insert';
         if(message !=''){
         $.ajax({
          url : "chat_message.php",
          method : "POST",
          data : {message:message,action:action},
          success: function(data){
            $('.group_chat_message').val('');
            $('.group_chat_history').html(data);
          }
       });
     }
    });
     function fetch_group_chat_histroy() {
      var action = 'fetch_history';
        $.ajax({
          url : "chat_message.php",
          method : "POST",
          data : {action:action},
          success: function(data){
            $('.group_chat_history').html(data);
          }
       });    
     }
   });
</script>
<script type="text/javascript">
    $(document).on('mouseover','.mess',function(){
      var message_id = $(this).data('id');
      $('.cross'+message_id).show();
      $co = $('.cross'+message_id);
    });
     $(document).on('click','.ca',function(){
      var message_id = $(this).attr('id');
         if(confirm('Are you sure you want to delete this message?')) {
          $.ajax({
            url: "delete_message.php",
            method: "POST",
            data: {message_id:message_id},
            success: function(data){

            }
          }); 
         }
      });
</script>
