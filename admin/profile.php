<?php 
include ('includes/header.php'); 
include('function.php');
include('database/connection.php');
include('adminauth.php');
 $errMsg = "";
   $hello = $conn->query("SELECT * FROM admin WHERE admin_id='".$_SESSION['admin_id']."' AND admin_email='".$_SESSION['admin_email']."'");
   $hay = $hello->fetch_assoc();
   $admin_id = clean($hay['admin_id']);
   $admin_email = clean($hay['admin_email']);
   if(isset($_POST['uprofile']))
    {   
           $userid = clean($_POST['hiduserid']);

          if(!empty($_FILES['userphoto']['name']))
          {
              $cover = $_FILES['userphoto']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['userphoto']['tmp_name'];
              $type = $_FILES['userphoto']['type'];
              $size = $_FILES['userphoto']['size'];
              if($type=="image/jpg" || $type == "image/png" || $type=="image/jpeg" || $type=="image/gif")
              {
                if($size < '1000000') {
                move_uploaded_file($tmp, "adminprofiles/$filename");
                }else{
                  $errMsg.= "Image size is too big<br>";
                }
              }else{
                $errMsg .= "jpg,png,gif နှင့် jpeg type များသာလက်ခံသည်။<br>";
              }            
          }

           if(empty($_POST['username'])){
            $errMsg = "Username is required<br>";
            }elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['username'])){
            $errMsg .= "Only letters and white space allowed in username<br>";
            }elseif(strlen($_POST['username'])<4)
            {
              $errMsg.= "Type at least 4 letters<br>";
            }
            elseif(strlen($_POST['username'])>=20)
            {
              $errMsg.= "Only 20 letters are allowed<br>";
            }else{
            $username = clean($_POST['username']);
            }

           if(empty($errMsg)) {
              if(!empty($_FILES['userphoto']['name'])) {
            $add = $conn->query("UPDATE admin SET admin_name='$username',admin_photo='$filename',modified_date = now() WHERE admin_id = $userid"); 
                   
             }else{
              $add = $conn->query("UPDATE admin SET admin_name='$username',modified_date=now() WHERE admin_id='$userid'");
             }
           if($add){
              header("location:profile.php?succMsg");
          }
         }    
  }
  if(isset($_POST['echange']))
    {
       $userid = clean($_POST['hiduserid']);

       if(empty($_POST['useremail'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['useremail'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }else{
            $useremail = clean($_POST['useremail']);
           }
           if(empty($errMsg)) {
            $edit = $conn->query("UPDATE admin SET admin_email = '$useremail' WHERE admin_id='$userid'");
            if($edit){
               header("location: profile.php?sucemail");
            }
          }
           }    
     if(isset($_GET['sucemail'])){
      header("Refresh:3");
      session_destroy();
    }
   
?>
<style type="text/css">
  .required {
    color: red;
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
                <h3>Profile</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
            
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content">
                                <form method="POST" action="profile.php" enctype="multipart/form-data">
                                    <?php if($errMsg) { 
                                              echo"<div class='alert alert-danger'> $errMsg
                                                         </div>";
                                    } ?>
                                      <?php if(isset($_GET['succMsg'])) { 
                                              echo"<div class='alert alert-success'> Updated Successfully
                                                         </div>";
                                    } ?>
                                    <?php if(isset($_GET['sucemail'])) {
                                         echo"<div class='alert alert-success'> Email Change Successfully.You have to login back in 3 seconds.
                                                         </div>";
                                    }?>
                                   <input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $hay['admin_id']?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username"placeholder="Username" value="<?php echo $hay['admin_name']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                    <img src="adminprofiles/<?php echo $hay['admin_photo']?>" alt="" height="150">
                                    <label for="cover">Change Photo</label>
                                    <input type="file" name="userphoto" id="userphoto">
                                    </div>
                                    </div>
                                    <div class="col-md-7 text-left">
                                    <button type="submit" name="uprofile" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                  </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <form action="profile.php" method="post">
                        <input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $hay['admin_id']?>">
                                  <div class="form-group col-md-6">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" name="useremail" placeholder="Email" value="<?php echo $hay['admin_email']?>">
                                  </div>
                                  <div class="col-md-8">
                                  <input type="submit" name="echange" class="btn btn-info" value="Change Email">
                                 </div>
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
