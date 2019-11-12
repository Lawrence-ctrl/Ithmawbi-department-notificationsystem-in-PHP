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
   if(isset($_POST['change'])) {
          if(empty($_POST['oldpass'])){
           $errMsg = "Current password is required<br>";
           }elseif(passcheck(md5($_POST['oldpass']),$admin_id,$admin_email)==false){
            $errMsg .= "Current password is wrong!<br>";
           }else{
            $currentpass = clean(md5($_POST['oldpass']));
           }
          if(empty($_POST['newpass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['newpass']!=$_POST['retypenew']){
            $errMsg .= "New passwords must be equal!<br>";
           }else{
            $newpass = clean(md5($_POST['newpass']));
           }
           if(empty($_POST['retypenew'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

           if(empty($errMsg)) {
          $add = $conn->query("UPDATE admin SET admin_pass='$newpass' WHERE admin_email='$admin_email' AND admin_id='$admin_id'");
           if($add){
            header("location:adminpassword.php?success");
            exit();
          }
         }
 }

         if(isset($_GET['success'])){
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
                <h3>Change Password</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change Password<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form class="form-horizontal form-label-left input_mask" method="POST">
                    <?php if($errMsg) {
                      echo "<div class='alert alert-danger'>$errMsg</div>";
                    } ?>
                    <?php if(isset($_GET['success'])) {
                      echo "<div class='alert alert-success'>Password changed successfully. You have to login in back after 3seconds</div>";
                    } ?>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="password" class="form-control has-feedback-left" name="oldpass" id="inputSuccess2" placeholder="Enter Old Password">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="password" class="form-control has-feedback-left" name="newpass" id="inputSuccess2" placeholder="Enter New Password">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="password" class="form-control has-feedback-left" name="retypenew" id="inputSuccess4" placeholder="Retype New password">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
               <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name="change">Submit</button>
                        </div>
                      </div>

                    </form>
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
