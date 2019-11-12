<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   $own = $conn->query("SELECT * FROM admin");
   $ow = $own->fetch_assoc();
     if(isset($_GET['post_user_id'])) {
      $post_user_id = clean($_GET['post_user_id']);
       $doo = $conn->query("SELECT * FROM users WHERE userid = '$post_user_id'");
              $did = $doo->fetch_assoc();
      $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $lll =  $ll->fetch_assoc();
   if($lll['status'] == '1') {
    $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE post_status = '1' OR post_status = '4' AND posts.post_userid = '$post_user_id'");
   }elseif($lll['status'] == '2'){
        if($lll['year_id'] == '1'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '2'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '3'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '4'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '5'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }else{
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }
   }else{
        if($lll['year_id'] == '1'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '2'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '3'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '4'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }elseif($lll['year_id'] == '5'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }else{
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '$post_user_id'");
        }
   }
 }else{
      $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $lll =  $ll->fetch_assoc();
   if($lll['status'] == '1') {
    $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE post_status = '1' OR post_status = '4' AND posts.post_userid = '0'");
   }elseif($lll['status'] == '2'){
        if($lll['year_id'] == '1'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '2'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '3'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '4'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '5'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '0'");
        }else{
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') AND posts.post_userid = '0'");
        }
   }else{
        if($lll['year_id'] == '1'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '2'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '3'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '4'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '0'");
        }elseif($lll['year_id'] == '5'){
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '0'");
        }else{
          $do = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id  LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') AND posts.post_userid = '0'");
        }
 }
}
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
            <a href="index.php" style="text-decoration: none;">Notifications</a>
          </li>
            <?php if(isset($_GET['post_user_id'])) : ?>
          <li class="breadcrumb-item active"><?php echo $did['username']?></li>
            <?php else: ?>
              <li class="breadcrumb-item active"><?php echo $ow['admin_name']?></li>
            <?php endif; ?>
        </ol>
      <div class="row">
        <?php if(isset($_GET['post_user_id'])) : ?>
          <div class="col-lg-4 col-xlg-3 col-md-5 cool">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../admin/userprofiles/<?php echo $did['userphoto']?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $did['username']?></h4>
                                    <h6 class="card-subtitle">Teacher</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-12 text-center"><i class="fas fa-window-maximize"></i> <?php echo $plus?></div>
                                        
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
           <?php else: ?>
             <div class="col-lg-4 col-xlg-3 col-md-5 cool">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../admin/adminprofiles/<?php echo $ow['admin_photo']?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $ow['admin_name']?></h4>
                                    <h6 class="card-subtitle">Administrator</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-12 text-center"><i class="fas fa-window-maximize"></i> <?php echo $plus?></div>
                                  
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
               <?php endif; ?>
                          
      </div>
      <hr> 
      <center>
      <?php if(isset($_GET['post_user_id'])) : ?>
        <div class="text-center hold">
         NOTIFICATIONS of <b><?php echo $did['username']?></b>
         </div>
           <?php else: ?>
            <div class="text-center hold">
            NOTIFICATIONS of <b><?php echo $ow['admin_name']?></b>
             </div>
          <?php endif; ?>
       </center>
      <div class="next">
      <div class="row">
        <?php foreach ($do as $key => $value) { ?>
          <?php if(!empty($value['post_photo'])) : ?>
         <div class="col-md-3">
          <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <?php if($value['post_userid'] == '0') : ?>
                  <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/adminprofiles/<?php echo $value['admin_photo']?>" style="width: 25px;height: 25px;" class="rounded-circle"> &nbsp;<?php echo $value['admin_name']?></h6>
                  <?php else: ?>
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/userprofiles/<?php echo $value['userphoto']?>" style="width: 25px;height: 25px;"  class="rounded-circle"> &nbsp;<?php echo $value['username']?></h6>
                  <?php endif; ?>
                </div>
               
                <img src="../admin/posts/<?php echo $value['post_photo']?>" style="height: 200px">
        
                <div class="card-body">
                   <?php if(strlen($value['post_content']) > 30) : ?>
                       <?php echo substr($value['post_content'],0,30).'...'; ?> 
                    <?php else: ?>
                  <?php echo $value['post_content']; ?>
                <?php endif; ?>
                </div>
                <div class="card-footer">
                   <table width="140%">
                         <tr>
                         <td><?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                          <?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="noti_details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus text-info fa-md"></i></a></td>
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
                  <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/adminprofiles/<?php echo $value['admin_photo']?>" style="width: 25px;height: 25px;" class="rounded-circle"> &nbsp;<?php echo $value['admin_name']?></h6>
                  <?php else: ?>
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../admin/userprofiles/<?php echo $value['userphoto']?>" style="width: 25px;height: 25px;" class="rounded-circle"> &nbsp;<?php echo $value['username']?></h6>
                  <?php endif; ?>
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
                          <i class="fas fa-heart fa-md text-info heart" id="<?php echo $value['post_id']?>"></i><?php else: ?>
                          <i class="far fa-heart fa-md text-info heart" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye fa-md text-info eye" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="noti_details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus fa-md text-info"></i></td>
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
                    url: "profilesofpost.php",
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
