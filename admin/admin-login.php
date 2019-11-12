<?php
include('database/connection.php');
include('function.php');
session_start();
$errMsg = '';
 if(isset($_POST['submit'])) {
    $email = clean($_POST['admin_email']);
    $pass = clean(md5($_POST['admin_pass']));
    $query = $conn->query("SELECT * FROM admin WHERE admin_email = '$email' AND admin_pass='$pass'");
     if($query->num_rows == 1){
        $row= $query->fetch_assoc();
        $_SESSION['admin_id'] =$row['admin_id'];
        $_SESSION['admin_email'] = $row['admin_email'];
        header('location:index.php');
     }else{
       $errMsg = 'Email and password do not match';
     }
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TU! </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .submit{
        position: absolute;
        left: 30%;
      }
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="admin-login.php">
              <h1>Admin Login Form</h1>
               <?php if($errMsg){
                  echo "<div class='alert alert-danger'>$errMsg</div>";
               } ?>
              <div>
                <input type="email" class="form-control" name="admin_email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" id="password" name="admin_pass" placeholder="Password" required="" />
              </div>
                <div class="form-group text-left">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me" onclick="myFunction();">
                  Show Password
              </label>
            </div>
          </div>
              <div>
                <div class="text-center">
                <input type="submit"  class="btn btn-default submit btn-md" name="submit" value="Login">
              </div>
              </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>

       <!--  <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div> -->
      </div>
    </div>
  </body>
</html>
<script>
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>