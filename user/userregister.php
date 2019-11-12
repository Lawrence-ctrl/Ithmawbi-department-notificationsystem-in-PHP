<?php 
   include('../admin/database/connection.php');
   include('functions.php');
   $errMsg = '';
      if(isset($_POST['register'])) {
          if(empty($_FILES['userphoto']['name'])){
              $errMsg .= "ပုံထည့်ပါ။<br>";
             }else{
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
              $errMsg.= "Only 15 letters are allowed<br>";
            }
            elseif(checkusername($_POST['username'])==false) {
            $errMsg .="Username already exists<br>";
            }else{
            $username = clean($_POST['username']);
            }

           if(empty($_POST['useremail'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['useremail'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }elseif(checkemail($_POST['useremail'])==false) {
            $errMsg.= "Email already exists<br>";
           }else{
            $useremail = clean($_POST['useremail']);
           }

          if(empty($_POST['userpass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['userpass']!=$_POST['confirmpass']){
            $errMsg .= "Passwords must be equal<br>";
           }else{
            $userpass = clean(md5($_POST['userpass']));
           }

           if(empty($_POST['confirmpass'])){
           $errMsg .= "Repeatpassword is required<br>";
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
           if(empty($_POST['useryear'])) {
              $errMsg.= "Attending Year is required<br>";
            }else{
              $post_year = clean($_POST['useryear']);
            }

           if(empty($errMsg)) {
            $add = $conn->query("INSERT INTO users(userphoto,username,useremail,userpass,year_id,userphone,useraddress,status,user_status,created_dates,modified_date) VALUES ('$filename','$username','$useremail','$userpass','$post_year','$userphone','$useraddress','2','1',now(),now())"); 
             
           if($add){
             echo "<script>window.alert('Successfully Created');
                window.location.href ='userlogin.php';
             </script>";
          }
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

  <title>SB Admin - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style>
    .error {
      color: red;
      font-size: 12px;  
    }
 </style>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="userregister.php" method="post" enctype="multipart/form-data" id="register">
            <?php if($errMsg) {
              echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
            }?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Name" id="username" name="username">
              </div>
              <div class="col-md-6">
                  <input type="file" class="form-control" id="userphoto" name="userphoto">                  
              </div>
            </div>
          </div>
          <div class="form-group">
              <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Email address">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                  <input type="password" class="form-control" id="userpass" name="userpass" placeholder="Password">
              </div>
              <div class="col-md-6">
                  <input type="password"  class="form-control" id="confirmpass" name="confirmpass" placeholder="Confirm password">
              </div>
            </div>
          </div>
            <div class="form-group">
              <select name="useryear" id="useryear" class="form-control">
                  <option value="" selected="">--SELECT--</option>
                  <?php 
                  $select = $conn->query("SELECT * FROM years WHERE years_id !='7' ORDER BY years_id ASC");
                  ?>
                   <?php foreach ($select as $row) : ?>
                    <option value="<?php echo $row['years_id']?>"><?php echo $row['years_name']?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="useraddress" id="useraddress" placeholder="Enter address"></textarea>
          </div>
         <div class="form-group">
              <input type="text" class="form-control" id="userphone" name="userphone" placeholder="09963437433" name="userphone">
         </div>
          <input type="submit" name="register" class="btn btn-success btn-block" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="userlogin.php">Login Page</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#register').validate({
      rules : {
        username:{
          required: true,
          minlength : 4
        },
        userphoto:{
          required: true
        },
        useremail: {
          required: true,
          email : true
        },
        userpass: {
          required: true,
          minlength: 4
        },
        confirmpass: {
          required: true,
          minlength: 4,
          equalTo: "#userpass"
        },
        useryear: {
          required:true
        },
        useraddress: {
          required: true
        },
        userphone: {
          number : true,
          minlength: 6,
          maxlength: 11,
          required: true
        }
      },
      messages : {
               username : {
              required : "Name is required!",
              minlength : "Please enter at least 4 characters"
        },
        userphoto: {
          required: "Photo is required"
        },
        useremail: {
          required: "Email is required!",
          email : "Please type correct email format"
        },
        userpass: {
          required: "Password is required!",
          minlength: "Enter at least 4 characters"
        },
        confrimpass: {
          required: "Confirm Password is required!",
          minlength: "Enter at least 4 characters",
        },
        userphone: {
          number : "Only numbers are allowed",
          minlength: "Input at least 6 numbers",
          maxlength: "Input at most 11 numbers",
          required: "Phone Number is required!"
        }
      }
    });
  });
</script>

