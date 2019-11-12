<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   $errMsg = '';
   $succMsg = '';
   if(isset($_POST['noti'])){
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
              $post_year = $_POST['useryear'];
            }
            if(empty($errMsg)) {
              if(!empty($_FILES['noti_photo']['name'])){
                    foreach ($post_year as $q) {
              $query = $conn->query("INSERT INTO posts (post_adminid,post_userid,post_content,post_photo,post_year,post_status,created_date,updated_date)VALUES('0','".$_SESSION['userid']."','$noti_content','$filename','$q','3',now(),now())");
               }
            }else{
               foreach ($post_year as $q) {
              $query = $conn->query("INSERT INTO posts (post_adminid,post_userid,post_content,post_year,post_status,created_date,updated_date)VALUES('0','".$_SESSION['userid']."','$noti_content','$q','3',now(),now())");
              }
           }
           if($query){
              $succMsg = 'Added Successfully';
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
          <li class="breadcrumb-item active"><a href="addecnoti.php" style="text-decoration: none;">To Ec</a></li>
        </ol>
        <div class="text-center">
          <div class="col-md-8 nice">
          <form class="addecnoti.php" method="POST" enctype="multipart/form-data">
            <?php if($errMsg){
             echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
          }?>
          <?php if($succMsg){
             echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $succMsg</div>";
          }?>
               <div class="form-group">
                      <textarea name="noti_content" rows="10" class="form-control" placeholder="Enter Noti Content"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="noti_photo" class="form-control">
                    </div>
                  <div class="form-group">
                   <select name="useryear[]" class="form-control" multiple="multiple">
                    <option value="0" selected="">--SELECT--</option>
                  <?php 
                  $select = $conn->query('SELECT * FROM years ORDER BY years_id ASC');
                  ?>
                   <?php foreach ($select as $row) : ?>
                    <option value="<?php echo $row['years_id']?>"><?php echo $row['years_name']?></option>
                  <?php endforeach; ?>
                 </select>
                </div>
                    <input type="submit" class="btn btn-primary" name="noti" value="Send">
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
