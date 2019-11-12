<?php 
 include('../admin/database/connection.php');
 include('userauth.php');
 include('functions.php');

 date_default_timezone_set('Asia/Rangoon');
    $query = $conn->query("SELECT * FROM admin");
    $quer = $query->fetch_assoc();
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
            <a style="text-decoration: none;" href="chatadmin.php">Chat With Admin</a>
          </li>
        </ol>
        <div class="row">
                    <div class="col-12 col-md-8 col-xl-6 chat">
          <div class="card">
            <div class="card-header msg_head">
              <div class="d-flex bd-highlight">
                <div class="img_cont">
                <img src="../admin/adminprofiles/<?php echo $quer['admin_photo']?>" class="rounded-circle user_img">
                  <span class="online_icon"></span>
                </div>
                <div class="user_info">
                  <span>Chat with <?php echo $quer['admin_name']?></span>
                </div>
              </div>
            </div>
            <div class="card-body msg_card_body chat_history" id="<?php echo $quer['admin_id']?>" >
              
            </div>
            <div class="card-footer">
              <div class="input-group">
                <textarea name="chat_message"  class="form-control type_msg chat_message" placeholder="Type your message..." required=""></textarea>
                <div class="input-group-append">
                  <span class="input-group-text send_btn"><i class="fas fa-location-arrow fa-lg send_message" data-id=<?php echo $quer['admin_id']?>></i></span>
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
      update_chat_history_data();
    },1000);
    $('.send_message').click(function(){
       var to_user_id = $(this).data('id');
       var message = $('.chat_message').val();
         if(message !=''){
       $.ajax({
          url : "chatwithadmin.php",
          method : "POST",
          data : {to_user_id:to_user_id, message:message},
          success: function(data){
            $('.chat_message').val('');
            $('.chat_history').html(data);
          }
       });
     }
    });
     function fetch_user_chat_history(userid) {
        $.ajax({
          url : "fetch_user_adminchat_history.php",
          method : "POST",
          data : {userid:userid},
          success: function(data){
            $('.chat_history').html(data);
          }
       });    
     }
     function update_chat_history_data() {
         $('.chat_history').each(function(){
            var userid = $(this).attr('id');
            fetch_user_chat_history(userid);
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