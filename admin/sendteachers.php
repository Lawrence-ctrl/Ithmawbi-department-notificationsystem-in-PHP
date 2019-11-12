<?php 
include('adminauth.php');
include ('includes/header.php'); 
include('function.php');
include('database/connection.php');
$errMsg = "";
$succMsg = "";
if(isset($_POST['noti'])){
  if(empty($_POST['post_content'])){
    $errMsg = 'Post content is required';
  }else{
    $post_content = clean($_POST['post_content']);
  }
  if(!empty($_FILES['post_photo']['name'])){
              $cover = $_FILES['post_photo']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['post_photo']['tmp_name'];
              $type = $_FILES['post_photo']['type'];
              $size = $_FILES['post_photo']['size'];
              if($type=="image/jpg" || $type == "image/png" || $type=="image/jpeg" || $type=="image/gif")
              {
                if($size < '1000000') {
                move_uploaded_file($tmp, "posts/$filename");
                }else{
                  $errMsg.= "Image size is too big<br>";
                }
              }else{
                $errMsg .= "jpg,png,gif နှင့် jpeg type များသာလက်ခံသည်။<br>";
              }            
            }
            if(empty($errMsg)) {
              if(!empty($_FILES['post_photo']['name'])){
              $query = $conn->query("INSERT INTO posts (post_adminid,post_content,post_photo,post_year,post_status,created_date,updated_date)VALUES('".$_SESSION['admin_id']."','$post_content','$filename','0','1',now(),now())");
            }else{
              $query = $conn->query("INSERT INTO posts (post_adminid,post_content,post_year,post_status,created_date,updated_date)VALUES('".$_SESSION['admin_id']."','$post_content','0','1',now(),now())");
            }
            if($query){
              $succMsg = 'Added Successfully';
            }
           }
}
?>
<style type="text/css">
   .rush {
    border: 2px solid lightgray;
    border-radius: 5px;
    padding: 15px;
   }
</style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>To Teachers</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>To Teachers <small>sub title</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <div class="rush"> 
                    <form class="form-horizontal form-label-left" method="POST" action="sendteachers.php" enctype="multipart/form-data">
                       <?php if($errMsg){
                          echo "<div class='alert alert-danger'>$errMsg</div>";
                       }?>
                       <?php if($succMsg){
                          echo "<div class='alert alert-success'>$succMsg</div>";
                       }?>
                    <div class="form-group">
                      <textarea name="post_content" rows="10" class="form-control" placeholder="Enter Post Content"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="post_photo" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" name="noti" value="Send">
                  </form>
                </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
   
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <?php include('includes/footer.php'); ?>
