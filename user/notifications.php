<?php 
include('../admin/database/connection.php');
include('userauth.php');
include('functions.php');

 $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $lll =  $ll->fetch_assoc();
   if($lll['status'] == '1') {
    $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE post_status = '1' OR post_status = '4' ORDER BY posts.created_date DESC");
   }elseif($lll['status'] == '2'){
        if($lll['year_id'] == '1'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '2'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '3'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '4'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '5'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }else{
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }
   }else{
        if($lll['year_id'] == '1'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '2'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '3'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '4'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '5'){
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }else{
          $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }
   }
  $count = $query->num_rows;
 ?>
<?php include('includes/userheader.php'); ?>
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
            <a href="notifications.php" style="text-decoration: none;">Alerts</a>
          </li>
         <!--  <li class="breadcrumb-item active ">Notifications</li> -->
        </ol>
      <div class="row">
        <?php while($row = $query->fetch_assoc()) :
           if(empty($row['post_userid'])) { 
                if(checksea($row['post_id'],$_SESSION['userid']) == false) {  ?>
         <div class="col-lg-12 mb-4" style="opacity: 0.6">
          <a href="noti_details.php?noti_id=<?php echo $row['post_id']?>" style="text-decoration: none">
                  <div class="card text-info shadow" style="margin: 0; ">
                    <div class="card-body">
                      <img src="../admin/adminprofiles/<?php echo $row['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle">
                        &nbsp; &nbsp; <b><?php echo $row['admin_name']?></b> Send New Notification
                    </div>
                  </div>
          </a>
        </div>
         <?php }else{ ?>
            <div class="col-lg-12 mb-4">
          <a href="noti_details.php?noti_id=<?php echo $row['post_id']?>" style="text-decoration: none;">
                  <div class="card text-info shadow" style="margin: 0; ">
                    <div class="card-body">
                      <img src="../admin/adminprofiles/<?php echo $row['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle">
                        &nbsp; &nbsp; <b><?php echo $row['admin_name']?></b> Send New Notification
                    </div>
                  </div>
           </a>
        </div>
      <?php } ?>
      <?php }else{ ?>
       <?php if(checksea($row['post_id'],$_SESSION['userid']) == false) { ?>
         <div class="col-lg-12 mb-4" style="opacity: 0.6">
          <a href="noti_details.php?noti_id=<?php echo $row['post_id']?>" style="text-decoration: none;">
                  <div class="card text-info shadow" style="margin: 0; ">
                    <div class="card-body">
                       <img src="../admin/userprofiles/<?php echo $row['userphoto']?>" style="width: 25px; height: 25px;">
                        &nbsp; &nbsp; <b><?php echo $row['username']?></b> Send New Notification
                    </div>
        </div>
         </a>
        </div>
      <?php }else{ ?>
        <div class="col-lg-12 mb-4">
          <a href="noti_details.php?noti_id=<?php echo $row['post_id']?>" style="text-decoration: none;">
                  <div class="card text-info shadow" style="margin: 0; ">
                    <div class="card-body">
                       <img src="../admin/userprofiles/<?php echo $row['userphoto']?>" style="width: 25px; height: 25px;">
                        &nbsp; &nbsp; <b><?php echo $row['username']?></b> Send New Notification
                    </div>
            </div>
          </a>
        </div>
      <?php } } ?>
        <?php endwhile; ?>
      </div>
    <footer class="navbar footer fixed-bottom footer-light footer-shadow content container-fluid">
         <table width="100%">
             <tr>
                <td><a href="index.php"><i class="fas fa-book text-info"></i></td></a>
              <td>
               <a href="notifications.php">
                <?php if($count-countcount($_SESSION['userid']) <= 0) { ?>
                <i class="fas fa-bell fa-fw text-info"></i>
              
              <?php }else{ ?>
               
                  <i class="fas fa-bell fa-fw text-info"></i>
                  <span class="badge badge-danger key"><small><?php echo $count-countcount($_SESSION['userid']);?> <?php } ?></small></span>
                </a>
              </td>
              
             </tr>
         </table>
    </footer>

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
 
