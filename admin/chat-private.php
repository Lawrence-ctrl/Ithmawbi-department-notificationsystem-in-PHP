<?php 
include('adminauth.php');
include ('includes/header.php'); 
include('../user/functions.php');
include('database/connection.php');
date_default_timezone_set('Asia/Rangoon');
   if(isset($_GET['userid'])) {
    $userid =  clean($_GET['userid']);
    $query = $conn->query("SELECT * FROM users WHERE userid=$userid");
    $quer = $query->fetch_assoc();
   }
?>
<link href="css/chat.css" rel="stylesheet">
<style type="text/css">
   .rush {
    border: 2px solid lightgray;
    border-radius: 5px;
    padding: 15px;
   }
</style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Chat</h3>
              </div>

              <div class="title_right">
     
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Chat<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
    <div class="row chat-window col-xs-12 col-md-6" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat - <?php echo $quer['username']?></h3>
                    </div>
                   
                </div>
                <div class="panel-body msg_container_base chat_history" id="<?php echo $quer['userid']?>" style="height: 400px">
                    
                  
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm chat_input chat_message" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm send_message" id="btn-chat" data-id="<?php echo $quer['userid']?>">Send</button>
                        </span>
                    </div>
                </div>
        </div>
        </div>
    </div>
</div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
   
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <?php include('includes/footer.php'); ?>
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
          url : "chat-message.php",
          method : "POST",
          data : {to_user_id:to_user_id, message:message},
          success: function(data){
            $('.chat_message').val('');
            $('.chat_history').html(data);
          }
       });
     }
    });
     function fetch_user_chat_histroy(userid) {
        $.ajax({
          url : "fetch_user_chat_history.php",
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
            fetch_user_chat_histroy(userid);
         });
     }
   });
</script>
<script type="text/javascript">
     $(document).ready(function() {
      fetch_user();
      setInterval(function(){
          fetch_user();
          update_last_activity();
      },5000);
        function fetch_user() {
            $.ajax({
              url : "fetch_admin.php",
              method : "POST",
              success : function(data) {
                $('tbody').html(data);
              }
            });
        }
        function update_last_activity() {
           $.ajax({
            url : "update_last_activity.php",
            success: function(data){
              
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
   
                      
