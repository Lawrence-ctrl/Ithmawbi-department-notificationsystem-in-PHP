<?php 
include('../admin/database/connection.php');
include('userauth.php');
include('includes/userheader.php');
include('functions.php');
  if(isset($_GET['noti_id'])) {
    $noti_id = clean($_GET['noti_id']);
    $query = $conn->query("SELECT posts.*,users.*,admin.*  FROM posts LEFT JOIN users ON posts.post_userid=users.userid LEFT JOIN admin ON posts.post_adminid = admin.admin_id WHERE posts.post_id = '$noti_id'");
    $niw = $conn->query("SELECT * FROM viewers WHERE post_id = '$noti_id' AND user_id='".$_SESSION['userid']."'");
    if($niw->num_rows == 0) {
    $nice = $conn->query("INSERT INTO viewers (post_id,user_id,created_date,updated_date) VALUES ('$noti_id','".$_SESSION['userid']."',now(),now())");
    }
}
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
<style type="text/css">
  @media(max-width: 575.98px){
    .key{
      position: absolute;
      top:10%;
      right: 25%;
    }
  }
  @media(min-width: 576px){
    .footer{
      display: none;
    }
    .crazy {
      position: absolute;
      top: 20%;
      right: 10%;
    }
  }
  footer {
  border-top: 4px solid lightblue;
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #fff;
  color: white;
  text-align: center;
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
            <li class="breadcrumb-item active">Details</li>
        </ol>
      <div class="row">
       <?php foreach ($query as $key => $value) { ?>
        <?php if(!empty($value['post_photo'])) : ?>
        <div class="col-md-8 crazy">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <?php if($value['post_userid'] == '0') : ?>
                  <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/adminprofiles/<?php echo $value['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $value['admin_name']?></h6>
                  <?php else: ?>
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/userprofiles/<?php echo $value['userphoto']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $value['username']?></h6>
                  <?php endif; ?>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <?php if($value['post_userid'] == '0') : ?>
                      <a class="dropdown-item" href="profilesofpost.php">Profile</a>
                       <?php else: ?>
                        <a class="dropdown-item" href="profilesofpost.php?post_user_id=<?php echo $value['userid']?>">Profile</a>
                         <?php endif; ?>
                    </div>
                  </div>
                </div>
               
                <img src="../admin/posts/<?php echo $value['post_photo']?>" style="height: 350px">
        
                <div class="card-body">
                   <?php 
                  echo $value['post_content']; 
                   ?>
                </div>
                <div class="card-footer">
                   <table width="140%">
                       <tr>
                         <td><?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                          <?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="wall.php" style="text-decoration:none;"><i class="fas fa-search-minus text-info fa-md" title="Zoom Out" id="<?php echo $value['post_id']?>"></i></a></td>
                       </tr>
                   </table>
                </div>
              </div>
 
      </div>
       <?php else: ?>
         <div class="col-md-8 crazy">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <?php if(empty($value['post_userid'])) : ?>
                  <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/adminprofiles/<?php echo $value['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $value['admin_name']?></h6>
                  <?php else: ?>
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/userprofiles/<?php echo $value['userphoto']?>" style="width: 25px;height: 25px;" class="rounded-circle"> &nbsp;<?php echo $value['username']?></h6>
                  <?php endif; ?>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <?php if($value['post_userid'] == '0') : ?>
                      <a class="dropdown-item" href="profilesofpost.php">Profile</a>
                       <?php else: ?>
                        <a class="dropdown-item" href="profilesofpost.php?post_user_id=<?php echo $value['userid']?>">Profile</a>
                         <?php endif; ?>
                    </div>
                  </div>
                </div>
               
                <img class="d-none d-sm-block" src="../admin/posts/download.png" style="height: 350px">
        
                <div class="card-body">
                   <?php 
                   echo $value['post_content'];
                   ?>
                </div>
                <div class="card-footer">
                   <table width="141%">
                       <tr>
                         <td>
                          <?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i><?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="wall.php" style="text-decoration:none;"><i class="fas fa-search-minus text-info fa-md" title="Zoom Out" id="<?php echo $value['post_id']?>"></i></a></td>
                       </tr>
                   </table>
                </div>
              </div>
 
      </div>
       <?php endif; ?>
     <?php } ?>
      </div>
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
  <?php include('includes/viewmodal.php'); ?>
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
                    url: "noti_details.php",
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