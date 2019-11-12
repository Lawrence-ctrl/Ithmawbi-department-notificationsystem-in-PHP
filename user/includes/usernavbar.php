<?php 
function coucou($userid) 
  {
    global $conn;
    $neon = $conn->query("SELECT viewers.*, posts.* FROM viewers LEFT JOIN posts ON viewers.post_id = posts.post_id WHERE user_id = '$userid' AND posts.post_userid != '$userid'");
    $nose = $neon->num_rows;
    return $nose;
  } 
  function checksoul($post_id,$userid) 
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
 $rr = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $rrr =  $rr->fetch_assoc();
  if($rrr['status'] == '1') {
    $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE post_status = '1' OR post_status = '4'  ORDER BY posts.created_date DESC");
   }elseif($rrr['status'] == '2'){
        if($rrr['year_id'] == '1'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '2'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '3'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '4'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '5'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }else{
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }
   }else{
        if($rrr['year_id'] == '1'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '2'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '3'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '4'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }elseif($rrr['year_id'] == '5'){
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }else{
          $great = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4')  ORDER BY posts.created_date DESC");
        }
   }
    $cou = $great->num_rows;
    $cpic = coucou($_SESSION['userid']);
?>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img style="width: 25px; height: 25px" class="rounded-circle" src="../admin/adminprofiles/images.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="index.php" method="POST">
      <div class="input-group">
        <input type="text" class="form-control" <?php if(isset($_POST['search'])) { ?>  value="<?php echo $search;?>" <?php } ?> id="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="nasearch">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="d-none d-sm-block nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="d-none d-sm-block fas fa-bell fa-fw hidden-sm"></i>
           <?php if($cou-$cpic > 0) : ?>
            <span class="d-none d-sm-block badge badge-danger"><?php echo $cou-$cpic;?></span>
          <?php endif; ?>
        </a>
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <?php while ($oww = $great->fetch_assoc()) : ?>
               <?php if($oww['post_adminid'] == '0') { ?>
                     <?php if(checksoul($oww['post_id'],$_SESSION['userid']) == false) { ?>
                 <a class="dropdown-item d-flex align-items-center" href="noti_details.php?noti_id=<?php echo $oww['post_id']?>">
                <div class="mr-3" style="opacity: 0.6">
                    <div class="icon-circle bg-primary">
                      <img style="width: 25px; height: 25px" class="rounded-circle" src="../admin/userprofiles/<?php echo $oww['userphoto']?>">
                    </div>
                  </div>
                  <div style="opacity: 0.6">
                    <div class="small text-gray-500"><?php echo $oww['username']?></div>
                    <span class="font-weight-bold">Send New Notification</span>
                  </div>
                   </a>
                    <?php }else{ ?>
                         <a class="dropdown-item d-flex align-items-center" href="noti_details.php?noti_id=<?php echo $oww['post_id']?>">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <img style="width: 25px; height: 25px" class="rounded-circle" src="../admin/userprofiles/<?php echo $oww['userphoto']?>">
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo $oww['username']?></div>
                    <span class="font-weight-bold">Send New Notification</span>
                  </div>
                   </a>
                 <?php } ?>
                <?php }else{ ?>
                   <?php if(checksoul($oww['post_id'],$_SESSION['userid']) == false) { ?>
                   <a class="dropdown-item d-flex align-items-center" href="noti_details.php?noti_id=<?php echo $oww['post_id']?>">
                  <div class="mr-3" style="opacity: 0.6">
                    <div class="icon-circle bg-primary">
                      <img src="../admin/adminprofiles/<?php echo $oww['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle">
                    </div>
                  </div>
                  <div style="opacity: 0.6">
                    <div class="small text-gray-500"><?php echo $oww['admin_name']?></div>
                    <span class="font-weight-bold">Send New Notification</span>
                  </div>
                </a>
              <?php }else{ ?>
                <a class="dropdown-item d-flex align-items-center" href="noti_details.php?noti_id=<?php echo $oww['post_id']?>">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <img src="../admin/adminprofiles/<?php echo $oww['admin_photo']?>" style="width: 25px;height: 25px;"  class="rounded-circle">
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo $oww['admin_name']?></div>
                    <span class="font-weight-bold">Send New Notification</span>
                  </div>
                </a>
              <?php } } ?>
              <?php endwhile; ?>
              <a class="dropdown-item text-center small text-gray-500" href="notifications.php">Show All Notifications</a>
              </div>
      </li>
   
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img style="width: 25px; height: 25px" class="rounded-circle" src="../admin/userprofiles/<?php echo $rrr['userphoto']?>">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i>Profile</a>
          <a class="dropdown-item" href="changepassword.php"><i class="fas fa-key"></i>Change Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-power-off"></i>Logout</a>
        </div>
      </li>
    </ul>

  </nav>
