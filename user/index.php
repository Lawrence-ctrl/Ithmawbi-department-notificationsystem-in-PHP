<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   if(isset($_POST['search']))
   { 
   if(strlen($_POST['nasearch']) >= 0) {
     $search = clean($_POST['nasearch']);
   $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $lll = $ll->fetch_assoc();
   if($lll['status'] == '1') {
    $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_status = '1' OR post_status = '4') ORDER BY posts.created_date DESC");
   }elseif($lll['status'] == '2'){
        if($lll['year_id'] == '1'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '2'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '3'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '4'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '5'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }else{
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status = '4') ORDER BY posts.created_date DESC");
        }
   }else{
        if($lll['year_id'] == '1'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='1' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '2'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='2' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '3'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='3' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '4'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='4' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }elseif($lll['year_id'] == '5'){
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='5' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }else{
          $boo = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE (users.username LIKE '%".$search."%' OR posts.post_content LIKE '%".$search."%' OR admin.admin_name LIKE '%".$search."%') AND (post_year='6' OR post_year='7' OR post_year='0') AND (post_status='2' OR post_status='3' OR post_status = '4') ORDER BY posts.created_date DESC");
        }
      }
   }
 }

  $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
  $lll =  $ll->fetch_assoc();
  if($lll['status'] == '1') {
    $query = $conn->query("SELECT posts.*,users.*,admin.* FROM posts LEFT JOIN admin ON posts.post_adminid = admin.admin_id LEFT JOIN users ON posts.post_userid=users.userid WHERE post_status = '1' OR post_status = '4' ORDER BY posts.created_date DESC");
  }elseif($lll['status'] == '2') {
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
                break;
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
          <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Notifications</a></li>
        </ol>
      <div class="row">
      <?php if(isset($boo)) { ?>
         <?php foreach ($boo as $key => $value) { ?>
        <?php if(!empty($value['post_photo'])) : ?>
        <div class="col-md-3">
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
                         <td><?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                          <?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="noti_details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus text-info fa-md" title="Zoom In"></i></a></td>
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
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i><?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="noti_details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus text-info fa-md" title="Zoom In"></i></a></td>
                       </tr>
                   </table>
                </div>
              </div>
      </div>
       <?php endif; ?>
     <?php } ?>
      <?php  }else{ ?>
      <?php foreach ($query as $key => $value) { ?>
        <?php if(!empty($value['post_photo'])) : ?>
        <div class="col-md-3">
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
                         <td><?php $result=$conn->query("SELECT * FROM saved WHERE saved_post_id='".$value['post_id']."' AND saved_user_id='".$_SESSION['userid']."'"); 
                         if($result->num_rows > 0) : ?>
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i>
                          <?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" title="Add to Favourites" id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="noti_details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus text-info fa-md" title="Zoom In"></i></a></td>
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
                          <i class="fas fa-heart text-info fa-md heart" id="<?php echo $value['post_id']?>"></i><?php else: ?>
                          <i class="far fa-heart text-info fa-md heart" title="Add to Favourites"> id="<?php echo $value['post_id']?>"></i>
                          <?php endif; ?>
                        </td>
                          <td><i class="fas fa-eye text-info fa-md eye" title="Watch Viewers" data-toggle="modal" data-target="#viewModal" id="<?php echo $value['post_id']?>"></i></td>
                            <td><a href="noti_details.php?noti_id=<?php echo $value['post_id']?>"><i class="fas fa-search-plus text-info fa-md" title="Zoom In"></i></a></td>
                       </tr>
                   </table>
                </div>
              </div>
      </div>
       <?php endif; ?>
     <?php } } ?>
   </div>
   <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewexamplemodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewexamplemodal">Viewers of this notification</h5>
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
    <footer class="navbar footer fixed-bottom footer-light footer-shadow content container-fluid">
         <table width="100%">
             <tr>
                    <a href="index.php">
                <td><i class="fas fa-book text-info"></i></td>
                  </a>
              <td>
                 <a href="notifications.php">
                <?php if($count-countcount($_SESSION['userid']) <= 0) { ?>
                <i class="fas fa-bell fa-fw text-info"></i>
              <?php }else{ ?>
                  <i class="fas fa-bell fa-fw text-info"></i>
                  <span class="badge badge-danger key"><small><?php echo $count-countcount($_SESSION['userid']);?> </small></span>
                <?php } ?> 
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
                    url: "index.php",
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
   <script type="text/javascript">
     $(document).ready(function() {
    var input = $("#search");
    var len = input.val().length;
    input[0].focus();
    input[0].setSelectionRange(len, len);
});
   </script>
  