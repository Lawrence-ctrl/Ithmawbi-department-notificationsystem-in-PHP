<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
    $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
    $lll =  $ll->fetch_assoc();
    $do = $conn->query("SELECT * FROM posts WHERE post_userid = '".$lll['userid']."'");
$plus = $do->num_rows;
    if(isset($_POST['action']))  {
        $post_id = mysqli_real_escape_string($conn,$_POST['post_id']);
        $saved_user_id = $_SESSION['userid'];
        $action = $_POST['action'];
        switch ($action) {
            case 'fav':
                 mysqli_query($conn, "INSERT INTO saved(saved_post_id,saved_user_id,created_date,updated_date) VALUES ('$post_id','$saved_user_id',now(),now())");
                break;
            case 'unfav':
            mysqli_query($conn, "DELETE FROM saved WHERE saved_post_id=$post_id AND saved_user_id=$saved_user_id");
            break;
            
            default:
                # code...
                break;
        }
       }
           
?>

<?php include('includes/userheader.php'); ?>
 <style type="text/css">
  @media(min-width: 575.98px){
    .cool {
      position: relative;
      top: 10%;
      left: 34%;
    }
    
 }
 @media(max-width: 575.98px){
  
 }
 .hold {
  border: 4px solid lightblue;
  border-radius: 5px;
  display: inline-block;
  padding: 10px;
  margin-bottom: 10px;
 }
</style>
<body id="page-top">

   <?php include('includes/usernavbar.php');?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/usersidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="wall.php" style="text-decoration: none;">Wall</a>
          </li>
      
          <li class="breadcrumb-item active"><?php echo $lll['username']?></li>
          
        </ol>
      <div class="row">
      
          <div class="col-lg-4 col-xlg-3 col-md-5 cool">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../admin/userprofiles/<?php echo $lll['userphoto']?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $lll['username']?></h4>
                                    <h6 class="card-subtitle">Teacher</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-12 text-center"><i class="fas fa-window-maximize"></i> <?php echo $plus?></div>
                                        
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
      </div>
      <hr> 
      <center>
      
            <div class="text-center hold">
            NOTIFICATIONS of <b>YOU</b>
     
       </center>
      <div class="next">
      <div class="row">
        <?php foreach ($do as $key => $value) { ?>
          <?php if(!empty($value['post_photo'])) : ?>
         <div class="col-md-3" id="todo<?php echo $value['post_id']?>">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/userprofiles/<?php echo $lll['userphoto']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $lll['username']?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="editnoti.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-edit"></i> Edit</a>
                        <a data-id="<?php echo $value['post_id']?>" class="dropdown-item trash"><i class="fas fa-trash text-danger"> Delete</i></a>
                    </div>
                  </div>
                </div>
                
                <img src="../admin/posts/<?php echo $value['post_photo']?>" style="height: 200px">
                  
                <div class="card-body">
              <?php if(strlen($value['post_content']) > 30) :
                       echo substr($value['post_content'],0,30).'...'; 
                     else: 
                    echo $value['post_content']; 
                 endif; ?>
                </div>
                <div class="card-footer">
                   <table width="140%">
                       <tr>
                         <td><?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart fa-md heart text-info" id="<?php echo $value['post_id']?>"></i>
                          <?php else: ?>
                          <i class="far fa-heart fa-md heart text-info" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye fa-md eye text-info" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="wall-details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus fa-md" title="Zoom In" id="<?php echo $value['post_id']?>"></i></a></td>
                       </tr>
                   </table>
                </div>
              </div>
 
      </div>
         <?php else: ?>
         <div class="col-md-3" id="todo<?php echo $value['post_id']?>">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/userprofiles/<?php echo $lll['userphoto']?>" style="width: 25px;height: 25px;" class="rounded-circle"> &nbsp;<?php echo $lll['username']?></h6>
                        <div class="dropdown no-arrow">
                    <a class="dropdown-toggle"  role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="editnoti.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-edit"></i> Edit</a>
                        <a class="dropdown-item trash" data-id="<?php echo $value['post_id']?>"><i class="fas fa-trash text-danger"> Delete</i></a>
                    </div>
                  </div>
                </div>
               
                <img class="d-none d-sm-block" src="../admin/posts/download.png" style="height: 200px">
        
                <div class="card-body">
                  <?php if(strlen($value['post_content']) > 30) :
                       echo substr($value['post_content'],0,30).'...'; 
                     else: 
                    echo $value['post_content']; 
                 endif; ?>
                </div>
                <div class="card-footer">
                   <table width="141%">
                       <tr>
                         <td>
                          <?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart fa-md heart text-info" id="<?php echo $value['post_id']?>"></i><?php else: ?>
                          <i class="far fa-heart fa-md heart text-info" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye fa-md eye text-info" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="wall-details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus fa-md" title="Zoom In" id="<?php echo $value['post_id']?>"></i></a></td>
                       </tr>
                   </table>
                </div>
              </div>
 
      </div>
       <?php endif; ?>
    <?php } ?>
      </div>
 
    </div>
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <?php include('includes/viewmodal.php'); ?>
  <!-- Logout Modal-->
 <?php include('includes/logoutmodal.php'); ?>

<?php include('includes/userfooter.php');?>
<script>
        $(document).ready(function(){
            $('.heart').on('click', function(){
                var post_id = $(this).attr('id');
                $click_fav = $(this);

                if ($click_fav.hasClass('far fa-heart')) {
                    action = 'fav';
                    
                }else if($click_fav.hasClass('fas fa-heart')) {
                    action = 'unfav';
                }
              
                $.ajax({
                    url: "wall.php",
                    method : "POST",
                    data : {
                        'post_id' : post_id,
                        'action' : action
                    },
                    success : function(data) {
                        if(action == 'fav') {
                            $click_fav.removeClass('far fa-heart');
                            $click_fav.addClass('fas fa-heart');
                        }else if(action == 'unfav') {
                            $click_fav.removeClass('fas fa-heart');
                            $click_fav.addClass('far fa-heart');
                        }
                    }
                });
            });
        });
  </script>
  <script>
     $(document).ready(function(){
        $('.trash').on('click',function(){
           var notiid = $(this).data('id');
          // $clicked = $(this).parent().parent().parent().parent();
          swal({
             title: "Are you sure you want to delete this notification?",
              text: "That can't be recovered",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Confirm",
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if(isConfirm) {
            $.ajax({
                 url: 'deletenotibyuser.php',
                 method : 'POST',
                 dataType : 'json',
                 data : {
                  'deleted' : 1,
                  'notiid' : notiid
                 },
                 success: function(data) {
                   if(data.code == '101') 
                   { 
                    $('#todo'+ notiid).css({'background': 'tomato'});
                     $('#todo'+ notiid).fadeTo('slow',0.7,function() {
                     $(this).remove();
                     swal("Deleted!", "Successfully Deleted", "success");
                   });
                   }else{
                    swal("Error","Can't delete that row","error");
                   }
                 }
            });
          }else{
    swal("Cancelled", "You clicked Cancel!", "error");
  }
});
        });
     });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('.eye').click(function() {
            var noti_id = $(this).attr('id');
              $.ajax({
                url : 'counteye.php',
                method : 'POST',
                data : {noti_id : noti_id},
                success : function(data){
                  $('.viewers').html(data);
                }
              });
          });
      });
    </script>