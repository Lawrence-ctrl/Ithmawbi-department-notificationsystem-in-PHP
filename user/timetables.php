<?php 
 include('../admin/database/connection.php');
 include('userauth.php');
 include('functions.php');
 date_default_timezone_set('Asia/Rangoon');


        if(isset($_POST['change'])){
          $yearofuser = clean($_POST['useryear']);
           $do = $conn->query("SELECT * FROM timetable WHERE timetable_year_id = '$yearofuser' ORDER BY timetable_day_id");
        }else{
           $user = $conn->query("SELECT * FROM users WHERE userid = '".$_SESSION['userid']."'");
           $userow = $user->fetch_assoc();
           if($userow['status'] == '2' OR $userow['status'] == '3') {
           $yearofuser = $userow['year_id'];
           $do = $conn->query("SELECT * FROM timetable WHERE timetable_year_id = '$yearofuser' ORDER BY timetable_day_id");
         }else{
           $yearofuser ='1';
           $do = $conn->query("SELECT * FROM timetable WHERE timetable_year_id = '$yearofuser' ORDER BY timetable_day_id");
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
            <a style="text-decoration: none;" href="timetables.php">Timetables</a>
          </li>
        </ol>
        <div style="padding-bottom: 5rem;">
          <center> 
            <form action="timetables.php" method="POST">
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
        <div class="row">
          <div class="table-responsive">
             <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Day</th>
                    <th>9:00-9:50 AM</th>
                    <th>10:00-10:50 AM</th>
                    <th>11:00-11:50 AM</th>
                    <th>Lunch Break</th>
                    <th>1:00-1:50 AM</th>
                    <th>2:00-2:50 AM</th>
                    <th>3:00-3:50 AM</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($do as $key => $value) : ?>
                  <tr>
                      <td><?php if($value['timetable_day_id'] == '1') echo "Monday";
                           elseif($value['timetable_day_id'] == '2') echo "Tuesday";
                           elseif($value['timetable_day_id'] == '3') echo "Wednesday";
                           elseif($value['timetable_day_id'] == '4') echo "Thursday";
                           elseif($value['timetable_day_id'] == '5') echo "Friday";
                      ?>
                      </td>
                      <td><?php echo $value['timeone']?></td>
                      <td><?php echo $value['timetwo']?></td>
                      <td><?php echo $value['timethree']?></td>
                      <td>-</td>
                      <td><?php echo $value['timefour']?></td>
                      <td><?php echo $value['timefive']?></td>
                      <td><?php echo $value['timesix']?></td>
                  </tr> 
                <?php endforeach; ?>
                </tbody>
             </table>
          </div>
        </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
     

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
