<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   $errMsg = '';
    $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
    $lll =  $ll->fetch_assoc(); 
    $useremail = clean($lll['useremail']);
    $userid = clean($lll['userid']);
    if(isset($_POST['change'])) {
          if(empty($_POST['oldpass'])){
           $errMsg = "Current password is required<br>";
           }elseif(passcheck(md5($_POST['oldpass']),$userid,$useremail)==false){
            $errMsg .= "Current password is wrong!<br>";
           }else{
            $currentpass = clean(md5($_POST['oldpass']));
           }
          if(empty($_POST['newpass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['newpass']!=$_POST['repeatpass']){
            $errMsg .= "New passwords must be equal!<br>";
           }else{
            $newpass = clean(md5($_POST['newpass']));
           }
           if(empty($_POST['repeatpass'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

           if(empty($errMsg)) {
          $add = $conn->query("UPDATE users SET userpass='$newpass' WHERE useremail='$useremail' AND userid='$userid'");
           if($add){
            header("location:changepassword.php?success");
            exit();
          }
         }
 }

         if(isset($_GET['success'])){
          header("Refresh:3");
          session_destroy();
         }         
?>

<?php include('includes/userheader.php'); ?>
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
            <a href="changepassword.php" style="text-decoration: none;">Change Password</a>
          </li>       
        </ol>
        <div class="text-left" style="border: 5px solid lightgray; border-radius: 5px;padding: 10px;margin-top: 5rem;">
          <form method="POST" action="changepassword.php">
              <?php if($errMsg) {
                      echo "<div class='alert alert-danger'>$errMsg</div>";
                    } ?>
                    <?php if(isset($_GET['success'])) {
                      echo "<div class='alert alert-success'>Password changed successfully. You have to login in back after 3seconds</div>";
                    } ?>
            <div class="form-group">
            <label for="oldpass">Old Password</label>
            <input type="password" class="form-control" id="oldpass" name="oldpass">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="newpass">New Password</label>
              <input type="password" class="form-control" id="newpass" name="newpass">
            </div>
            <div class="form-group col-md-6">
              <label for="repeatpass">Retype New Password</label>
              <input type="password" class="form-control" id="repeatpass" name="repeatpass">
            </div>
          </div>
          <input type="submit" class="btn btn-primary" name="change" value="Change">
        </form>
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
  <!-- Logout Modal-->
 <?php include('includes/logoutmodal.php'); ?>

<?php include('includes/userfooter.php');?>
