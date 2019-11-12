<?php include('../admin/database/connection.php'); 
session_start();
$errMsg = '';
  if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn,$_POST['useremail']);
    $pass = mysqli_real_escape_string($conn,md5($_POST['userpass']));
    $query = $conn->query("SELECT * FROM users WHERE useremail = '$email' AND userpass='$pass'");
     if($query->num_rows == 1) {
        $row= $query->fetch_assoc();
        if($row['user_status'] == '1') {
        $_SESSION['userid'] =$row['userid'];
        $_SESSION['useremail'] = $row['useremail'];
        $nice = $conn->query("INSERT INTO login_details (user_id) VALUES ('".$row['userid']."')");
        $_SESSION['login_id'] = $conn->insert_id;
        header('location:index.php');
        }else{
          $errMsg = "You are banned by ADMIN";
        }
     }else{
       $errMsg .= 'Email and password do not match';
     }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TU - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="POST" action="userlogin.php">
          <?php if($errMsg){
             echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
          }?>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" name="useremail" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" class="form-control" name="userpass" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me" onclick="myFunction();">
                  Show Password
              </label>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="userregister.php" style="text-decoration: none;">Register an Account</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

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
