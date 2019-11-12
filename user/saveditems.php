<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   $own = $conn->query("SELECT * FROM admin");
   $ow = $own->fetch_assoc();
    $query = $conn->query("SELECT saved.*,posts.*,users.* FROM saved LEFT JOIN posts ON saved.saved_post_id = posts.post_id LEFT JOIN users ON posts.post_userid = users.userid WHERE saved.saved_user_id = '".$_SESSION['userid']."'");
    $boot = $query->num_rows;
    if(isset($_POST['post_id']))
    {
      $post_id = mysqli_real_escape_string($conn,$_POST['post_id']);
      $nice = $conn->query("DELETE FROM saved WHERE saved_post_id='$post_id' AND saved_user_id='".$_SESSION['userid']."'");
      if($nice){
        exit (json_encode(array('code'=>100)));
      }
    }
 ?>
<?php include('includes/userheader.php'); ?>
<style type="text/css">
  @media(max-width: 575.98px){
    .key{
      position: absolute;
      top:10%;
      right: 25%;
    }
    .breadcrumb{
      display: none;
    }
    .peter{
      position: absolute;
      font-size: 15px;
      font-weight: bold;
      font-style: italic;
      top: 40%;
     left: 40%;
    }
  }
  @media(min-width: 576px){
    .footer{
      display: none;
    }
    .peter{
      position: absolute;
      font-size: 30px;
      font-weight: bold;
      font-style: italic;
      top: 40%;
      right: 37%;
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
          <li class="breadcrumb-item active"><a href="saveditems.php" style="text-decoration: none;">Saved Items</a></li>
        </ol>
      <div class="row">
        <?php if($boot >= 1) : ?>
      <?php foreach ($query as $key => $value) { ?>
        <?php if(!empty($value['post_photo'])) : ?>
        <div class="col-md-3">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <?php if($value['post_userid'] == '0') : ?>
                  <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/adminprofiles/<?php echo $ow['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $ow['admin_name']?></h6>
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
               
                <img src="../admin/posts/<?php echo $value['post_photo']?>" style="height: 200px">
        
                <div class="card-body">
                   <?php if(strlen($value['post_content']) > 30) : 
                          echo substr($value['post_content'],0,30) .'...';
                    else: 
                  echo $value['post_content']; 
                     endif; ?>
                </div>
                <div class="card-footer">
                   <table width="140%">
                       <tr>
                         <td><?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" 444 id="<?php echo $value['post_id']?>"></i></td>
                            <td><i class="fas fa-arrows-alt text-info fa-md" id="<?php echo $value['post_id']?>"></i></td>
                       </tr>
                   </table>
                </div>
              </div>
 
      </div>
       <?php else: ?>
         <div class="col-md-3">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <?php if(empty($value['post_userid'])) : ?>
                  <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/adminprofiles/<?php echo $ow['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $ow['admin_name']?></h6>
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
                          <?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'");  ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><i class="fas fa-arrows-alt text-info fa-md" id="<?php echo $value['post_id']?>"></i></td>
                       </tr>
                   </table>
                </div>
              </div>
 
      </div>
       <?php endif; ?>
     <?php } ?>
     <?php else: ?>
      <center><p class="peter"> Nothing To Show </p></center>
    <?php endif; ?>
   </div>


    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include('includes/viewmodal.php');?>
 <?php include('includes/logoutmodal.php'); ?>

<?php include('includes/userfooter.php');?>
<script>
        $(document).ready(function(){
            $('.heart').on('click', function(){
                var post_id = $(this).attr('id');
                $click_fav = $(this).parent().parent().parent().parent().parent().parent().parent();
                $.ajax({
                    url: "saveditems.php",
                    method : "POST",
                    dataType : 'json',
                    data : {
                        'post_id' : post_id,
                    },
                    success : function(data) {
                      if(data.code == 100){
                        $click_fav.hide('slow');
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
