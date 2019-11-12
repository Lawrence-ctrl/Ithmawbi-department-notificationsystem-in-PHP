<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
  $errMsg ='';
   if(isset($_POST['add'])){
      $day_id = clean($_POST['selectday']);
      $timeone = clean($_POST['timeone']);
      $timetwo = clean($_POST['timetwo']);
      $timethree = clean($_POST['timethree']);
      $timefour = clean($_POST['timefour']);
      $timefive = clean($_POST['timefive']);
      $timesix = clean($_POST['timesix']);
      if($day_id=$timeone=$timetwo=$timethree=$timefour=$timefive=$timesix!='') {
      $year_id = '3';
      $do = $conn->query("INSERT INTO timetable (timetable_year_id,timetable_day_id,timeone,timetwo,timethree,timefour,timefive,timesix,created_date,updated_date) VALUES ('$year_id','$day_id','$timeone','$timetwo','$timethree','$timefour','$timefive','$timesix',now(),now())");
     }else{
      $errMsg = "All fields are required";
     } 
 }
?>
<style type="text/css">
      .required{
        color: red;
      }
</style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
           <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Third Year Timetable</h3>
              </div>
               <div class="text-right">
                <a href="editthirdyeartimetable.php"><button class="btn btn-primary">Edit</button></a>
              </div>
          
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Third Year Timetable</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                   
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form class="form-horizontal form-label-left" action="thirdyeartimetable.php" method="POST">
                      <?php if($errMsg) {
                      echo "<div class='alert alert-danger text-center'>$errMsg</div>";
                    } ?>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="selectday">Select Day<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <select name="selectday" class="form-control col-md-7 col-xs-12">
                          <option value="1">Monday</option>
                          <option value="2">Tuesday</option>
                          <option value="3">Wednesday</option>
                          <option value="4">Thursday</option>
                          <option value="5">Friday</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timeone">9:00-9:10 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timeone" name="timeone" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timetwo">10:00-10:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timetwo" name="timetwo" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timethree">11:00-11:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timethree" name="timethree" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timefour">1:00-1:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timefour" name="timefour" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timefive">2:00-2:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timefive" name="timefive" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timesix">3:00-3:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timesix" name="timesix" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <button type="submit" class="btn btn-success" name="add">Submit</button>
                        </div>
                      </div>
                </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
    <?php include('includes/footer.php'); ?>