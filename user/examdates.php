<?php 
 include('../admin/database/connection.php');
 include('userauth.php');
 include('functions.php');
 date_default_timezone_set('Asia/Rangoon');
        if(isset($_POST['change'])){
          $yearofuser = clean($_POST['useryear']);
           $do = $conn->query("SELECT * FROM examdates WHERE examdates_year_id = '$yearofuser' ORDER BY examdates_date ASC");
        }else{
           $user = $conn->query("SELECT * FROM users WHERE userid = '".$_SESSION['userid']."'");
           $userow = $user->fetch_assoc();
           if($userow['status'] == '2' OR $userow['status'] == '3') {
           $yearofuser = $userow['year_id'];
           $do = $conn->query("SELECT * FROM examdates WHERE examdates_year_id = '$yearofuser' ORDER BY examdates_date ASC");
         }else{
           $yearofuser ='1';
           $do = $conn->query("SELECT * FROM examdates WHERE examdates_year_id = '$yearofuser' ORDER BY examdates_date ASC");
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

  <title> TU!</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="icons/themify-icons/themify-icons.css" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <style type="text/css">
      table,tr,td{
        text-align: center;
        line-height: 35px;
      } 
  </style>
</head>
<body id="page-top">

   <?php include('includes/usernavbar.php');?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/usersidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="text-decoration: none;" href="examdates.php">Exam Dates</a>
          </li>
        </ol>
        <div style="padding-bottom: 5rem;">
          <center> 
            <form action="examdates.php" method="POST">
            <div class="col-md-12">
                       <select name="useryear" class="form-control-lg">
                  <?php 
                  $select = $conn->query("SELECT * FROM years WHERE years_id !='7' ORDER BY years_id ASC");
                  ?>
                   <?php foreach ($select as $row) : ?>
                    <option value="<?php echo $row['years_id']?>"
                    <?php if($row['years_id'] == $yearofuser) echo "selected";?>><?php echo $row['years_name']?></option>
                  <?php endforeach; ?>
              </select>
                      <button class="btn btn-primary btn-sm" name="change">Change</button>
                    </div>
                  </form>
              </center>
          </div>
                 <?php if($do->num_rows > 0) : ?>
                      <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <td>Date (YYYY-MM-DD)</td>
                              <td>Time</td>
                              <td>Subjects</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while($does = $do->fetch_assoc()): ?>
                            <tr>
                              <td><?php echo $does['examdates_date']?></td>
                             <td> <?php echo (($does['examdates_times']=='1')?'8:30AM to 11:30AM':'1:00PM to 4:00PM');?></td>
                             <td><?php echo $does['examdates_subjects']?></td>
                            </tr>
                          <?php endwhile; ?>
                          </tbody>
                      </table>
                  <?php endif; ?>
           </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 <?php include('includes/logoutmodal.php'); ?>

<?php include('includes/userfooter.php');?>
