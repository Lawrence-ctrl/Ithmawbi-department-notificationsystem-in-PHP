<?php 
   include('../admin/database/connection.php');
   include('userauth.php');
   include('functions.php');
   $errMsg = '';
   $succMsg = '';
    $ll = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
    $lll =  $ll->fetch_assoc(); 
   
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
                move_uploaded_file($tmp, "../admin/userprofiles/$filename");
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
            }
            elseif(checker($_POST['username'],$userid)==false) {
            $errMsg .="Username is already exist<br>";
            }else{
            $username = clean($_POST['username']);
            }

           if(empty($_POST['useraddress'])){
            $errMsg .= "Address is required<br>";
           }else{
           $useraddress =clean($_POST['useraddress']);
           }

           if(empty($_POST['userphone'])){
           $errMsg .= "Phone is required<br>";
           }else{
           $userphone =clean($_POST['userphone']);
           }

           if(empty($errMsg)) {
              if(!empty($_FILES['userphoto']['name'])) {
            $add = $conn->query("UPDATE users SET username='$username',userphoto='$filename',userphone='$userphone',useraddress='$useraddress',modified_date = now() WHERE userid = $userid"); 
                   
             }else{
              $add = $conn->query("UPDATE users SET username='$username',userphone='$userphone',useraddress='$useraddress',modified_date=now() WHERE userid='$userid'");
             
           if($add){
              header("location:profile.php?succMsg");
          }
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
           }elseif(checkingemail($_POST['useremail'],$userid)==false) {
            $errMsg.= "Email already exists<br>";
           }else{
            $useremail = clean($_POST['useremail']);
           }
           if(empty($errMsg)) {
            $edit = $conn->query("UPDATE users SET useremail = '$useremail' WHERE userid='$userid'");
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
            <a href="profile.php" style="text-decoration: none;">Profile</a>
          </li>       
        </ol>
        <div class="text-left" style="border: 5px solid lightgray; border-radius: 5px;padding: 10px;margin-top: 5rem;">
            
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content">
                                <form method="POST" action="profile.php" enctype="multipart/form-data">
                                    <?php if($errMsg) { 
                                              echo"<div class='alert alert-danger alert-dismissible fade show'>$errMsg
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                         </div>";
                                    } ?>
                                      <?php if(isset($_GET['succMsg'])) { 
                                              echo"<div class='alert alert-success alert-dismissible fade show'>Updated Successfully
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                         </div>";
                                    } ?>
                                    <?php if(isset($_GET['sucemail'])){
 echo"<div class='alert alert-success alert-dismissible fade show'>Email Changed Successfully. You have to login back in 3 seconds.
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                         </div>";
                                    } ?>

                                   <input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $lll['userid']?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username"placeholder="Username" value="<?php echo $lll['username']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                    <img src="../admin/userprofiles/<?php echo $lll['userphoto']?>" alt="" height="150">
                                    <label for="cover">Change Photo</label>
                                    <input type="file" name="userphoto" id="userphoto">
                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="useraddress" placeholder="Home Address" value="<?php echo $lll['useraddress']?>">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="userphone"placeholder="Phone Number" value="<?php echo $lll['userphone']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <?php if($lll['status'] == '1') { ?>
                                                <input type="text" class="form-control" disabled="" placeholder="password" value="Teacher">
                                                <?php }elseif($lll['status'] == '2') { ?>
                                                  <input type="text" class="form-control" disabled="" placeholder="password" value="Student">
                                                  <?php }else{ ?>
                                                    <input type="text" class="form-control" disabled="" placeholder="password" value="Ec">
                                                  <?php } ?>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>My ID</label>
                                                <input type="text-white-50" disabled class="form-control" value="<?php echo $lll['userid']?>">
                                            </div>
                                        </div>
                                    </div>

                                  

                                    <button type="submit" name="uprofile" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <form action="profile.php" method="post">
                        <input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $law['member_id']?>">
                                  <div class="form-group col-md-6">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" name="useremail" placeholder="Email" value="<?php echo $lll['useremail']?>">
                                  </div>
                                  <div class="col-md-6">
                                  <input type="submit" name="echange" class="btn btn-info" value="Change Email">
                                </div>
                          </form>
                      </div>
                       
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
