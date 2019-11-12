<?php 
include ('includes/header.php'); 
include('function.php');
include('database/connection.php');
include('adminauth.php');
$errMsg = '';
   if(isset($_POST['add_t'])) {
 
            if(!empty($_FILES['t_photo']['name'])){
              $cover = $_FILES['t_photo']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['t_photo']['tmp_name'];
              $type = $_FILES['t_photo']['type'];
              $size = $_FILES['t_photo']['size'];
              if($type=="image/jpg" || $type == "image/png" || $type=="image/jpeg" || $type=="image/gif")
              {
                if($size < '3000000') {
                move_uploaded_file($tmp, "userprofiles/$filename");
                }else{
                  $errMsg.= "Image size is too big<br>";
                }
              }else{
                $errMsg .= "jpg,png,gif နှင့် jpeg type များသာလက်ခံသည်။<br>";
              }            
            }

           if(empty($_POST['t_name'])){
            $errMsg .= "Name is required<br>";
            }elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['t_name'])){
            $errMsg .= "Only letters and white space allowed in First name<br>";
            }else{
            $t_name = clean($_POST['t_name']);
            }


           if(empty($_POST['t_email'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['t_email'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }elseif(checkemail($_POST['t_email'])==false) {
            $errMsg.= "Email already exists<br>";
           }else{
           $t_email = clean($_POST['t_email']);
           }

          if(empty($_POST['t_pass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['t_pass']!=$_POST['repeat_pass']){
            $errMsg .= "Passwords must be equal<br>";
           }else{
           $t_pass = clean(md5($_POST['t_pass']));
           }

           if(empty($_POST['repeat_pass'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

          if(empty($_POST['t_address'])){
            $errMsg .= "Address is required<br>";
           }else{
           $t_address = clean($_POST['t_address']);
           }

           if(empty($_POST['t_phone'])){
           $errMsg .= "Phone is required<br>";
           }else{
           $t_phone = clean($_POST['t_phone']);
           }

           if(empty($errMsg)) {         
             $addmember = $conn->query("INSERT INTO users (userphoto,username,useremail,userpass,year_id,userphone,useraddress,status,user_status,created_dates,modified_date) VALUES ('$filename','$t_name','$t_email','$t_pass', '0','$t_phone','$t_address','1','1',now(),now())");
             
           if($addmember){
          header("location:add_teachers.php?success");
            exit();
          }
         }
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
                <h3>Add Teachers</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Teachers<small>sub title</small></h2>
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
                         <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                          <?php if($errMsg) {
                      echo "<div class='alert alert-danger'>
                              $errMsg</div>";
                   }?>
                       <?php if(isset($_GET['success'])){
                        echo "<div class='alert alert-success'>Added Successfully</div>";
                       } ?>
                            <div class="alert alert-danger"> * Fields are required!</div>
                            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Photo <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="first-name"  name="t_photo" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name"  name="t_name" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="last-name" name="t_email" r class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="last-name" name="t_pass"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Repeat Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="last-name" name="repeat_pass"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="t_phone"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                         <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="t_address" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                   
                          <button type="submit" class="btn btn-success" name="add_t">Submit</button>
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
