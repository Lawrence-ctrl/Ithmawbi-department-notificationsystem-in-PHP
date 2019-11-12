<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
   $do = $conn->query("SELECT posts.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id WHERE post_userid = '0' ORDER BY posts.created_date DESC");
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
           <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Notifications</h3>
              </div>

          
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Notifications</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                   
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewexamplemodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewexamplemodal">Vieweres of this notification</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body viewers">
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
                    <div class="row">
                  <?php while($value = $do->fetch_assoc()): ?>
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <?php if(empty($value['post_photo'])) : ?>
                            <img style="width: 100%; display: block;" src="posts/download.png" alt="image" />
                            <?php else: ?>
                            <img style="width: 100%; display: block;" src="posts/<?php echo $value['post_photo']?>">
                          <?php endif; ?>
                            <div class="mask">
                              <div class="tools tools-bottom">
                                <i class="fa fa-eye eye" data-id="<?php echo $value['post_id']?>" data-toggle="modal" data-target="#viewModal"></i>
                                <a href="editadminpost.php?edit_id=<?php echo $value['post_id']?>"><i class="fa fa-pencil text-info"></i></a>
                                <i class="fa fa-times text-danger trash" data-id="<?php echo $value['post_id']?>"></i>
                              </div>
                            </div>
                          </div>

                          <div class="caption">
                            <p><?php if(strlen($value['post_content']) > 20) : 
                                 echo substr($value['post_content'],0,20).'...'; 
                                else :
                                  echo $value['post_content'];
                                endif;
                                 ?>
                            </p>
                            <p class="text-info">Send To 
                              <?php if($value['post_status'] == '1') :
                                echo "Teachers";
                              elseif($value['post_status'] == '2') :
                                echo "Students";
                              elseif($value['post_status'] == '3') :
                                echo "Ec";
                              else :
                                echo "All";
                              endif;?>
                            </p>
                          </div>
                        </div>
                      </div>
                  <?php endwhile; ?>                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

    <!-- jQuery -->
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
      $(document).ready(function() {
          $('.eye').click(function() {
            var noti_id = $(this).data('id');
              $.ajax({
                url : 'counteye.php',
                method : 'POST',
                data : {noti_id : noti_id},
                success : function(data){
                  $('.viewers').html(data);
                }
              });
          });
          $('.trash').on('click',function() {
           var trashid = $(this).data('id');
           var action = 'deletenoti';
           $clicked = $(this).parent().parent().parent().parent();
            if(confirm('Are you sure you want to delete this notification?')) {
              $.ajax({
                  url: "indexer.php",
                  method : "POST",
                  dataType : "json",
                  data: {trashid:trashid,action:action},
                  success: function(data){
                     if(data.code = 100) {
                   $clicked.css({'background':'red'});
                   $clicked.fadeTo('slow',0.7,function() {
                     $(this).remove();
                  });
                 }
               }
              });
            };
          });
      });
    </script>