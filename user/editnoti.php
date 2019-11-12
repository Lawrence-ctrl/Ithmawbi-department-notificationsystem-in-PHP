<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   if(isset($_GET['noti_id'])){
    $noti_id = clean($_GET['noti_id']);
    $echo = $conn->query("SELECT * FROM posts WHERE post_id = '$noti_id'");
    $row = $echo->fetch_assoc();
   }
   $errMsg = '';
   $succMsg = '';
   if(isset($_POST['edit_noti'])){
    $hidnoti_id = clean($_POST['hidnoti_id']);
  if(empty($_POST['noti_content'])){
    $errMsg = 'Noti content is required';
  }else{
    $noti_content = clean($_POST['noti_content']);
  }
  if(!empty($_FILES['noti_photo']['name'])){
              $cover = $_FILES['noti_photo']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['noti_photo']['tmp_name'];
              $type = $_FILES['noti_photo']['type'];
              $size = $_FILES['noti_photo']['size'];
              if($type=="image/jpg" || $type == "image/png" || $type=="image/jpeg" || $type=="image/gif")
              {
                if($size < '3000000') {
                move_uploaded_file($tmp, "../admin/posts/$filename");
                }else{
                  $errMsg.= "Image size is too big<br>";
                }
              }else{
                $errMsg .= "jpg,png,gif နှင့် jpeg type များသာလက်ခံသည်။<br>";
              }            
            }
            if(empty($_POST['useryear'])) {
              $post_year = 7;
            }else{
              $post_year = clean($_POST['useryear']);
            }
            if(empty($_POST['usertype'])){
              $errMsg .="Usertype is required";
            }else{
              $usertype = clean($_POST['usertype']);
            }
            if(empty($errMsg)) {
              if(!empty($_FILES['noti_photo']['name'])){
              $query = $conn->query("UPDATE posts SET post_content='$noti_content',post_photo='$filename',post_year='$post_year',post_status='$usertype', updated_date=now() WHERE post_id = '$hidnoti_id'");
            }else{
            $query = $conn->query("UPDATE posts SET post_content ='$noti_content',post_year='$post_year',post_status='$usertype', updated_date=now() WHERE post_id = '$hidnoti_id'");
            }

            if($query){
               header("location:editnoti.php?action=success&&noti_id=$hidnoti_id");
            }
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
  @media(min-width: 600px) {
    .nice{
      position: absolute;
      top: 25%;
      left: 20%;
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
 .nice{
   padding:30px;
   border: 5px solid lightgray;
   border-radius: 5px;
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
          <li class="breadcrumb-item active">
            <a href="wall.php" style="text-decoration: none;">Wall</a>
          </li>
            <li class="breadcrumb-item active">Edit Notifications</li>
        </ol>
        <div class="text-center">
          <div class="col-md-8 nice">
          <form class="editnoti.php" method="POST" enctype="multipart/form-data">
            <?php if($errMsg){
             echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
          }?>
          <?php if(isset($_GET['action']) && ($_GET['action'] == 'success')) { 
             echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Successfully Updated</div>";
          }?>  
               <input type="hidden" name="hidnoti_id" value="<?php echo $row['post_id']?>">
               <div class="form-group">
                 <div class="form-group">
                      <input type="file" name="noti_photo">
                      <img src="../admin/posts/<?php echo $row['post_photo']?>" style="height: 200px; width: 200px">
                    </div>
                      <textarea name="noti_content" class="form-control" placeholder="Enter Noti Content"><?php echo $row['post_content']?>
                      </textarea>
                    </div>
                  <div class="form-group">
                   <select name="useryear" class="form-control">
                  <?php 
                  $select = $conn->query('SELECT * FROM years ORDER BY years_id ASC');
                    foreach ($select as $roww) : ?>
                    <option value="<?php echo $roww['years_id']?>"
                      <?php if($roww['years_id'] == $row['post_year']) echo "selected";?>
                      ><?php echo $roww['years_name']?></option>
                  <?php endforeach; ?>
                 </select>
                </div>
                 <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="usertype"  value="3" <?php if($row['post_status'] == '3') echo "checked";?>>
                        <label class="form-check-label">Ec</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="usertype"  value="2" <?php  if($row['post_status'] == '2') echo "checked";?>>
                        <label class="form-check-label">Student</label>
                      </div>
                </div>
                    <input type="submit" class="btn btn-primary" name="edit_noti" value="Send">
          </form>
        </div>
        </div>
   </div>
   


  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
   
  <!-- Logout Modal-->
 <?php include('includes/logoutmodal.php'); ?>

<?php include('includes/userfooter.php');?>
