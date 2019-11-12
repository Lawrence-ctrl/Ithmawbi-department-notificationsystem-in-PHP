<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
    if(isset($_POST['change'])) {
      $day = clean($_POST['selectday']);
    $do = $conn->query("SELECT * FROM timetable WHERE timetable_year_id = '5' AND timetable_day_id = '$day'");
    $query = $do->fetch_assoc();
    }else{
    $do = $conn->query("SELECT * FROM timetable WHERE timetable_year_id = '5' AND timetable_day_id = '1'");
    $day = 1;
    $query = $do->fetch_assoc();
    }
     if(isset($_POST['add'])){
      $hiddenid = clean($_POST['hiddenid']);
      $timeone = clean($_POST['timeone']);
      $timetwo = clean($_POST['timetwo']);
      $timethree = clean($_POST['timethree']);
      $timefour = clean($_POST['timefour']);
      $timefive = clean($_POST['timefive']);
      $timesix = clean($_POST['timesix']);
      $ee = $conn->query("UPDATE timetable SET timeone='$timeone',timetwo='$timetwo',timethree='$timethree',timefour ='$timefour', timefive='$timefive',timesix = '$timesix' WHERE timetable_id = '$hiddenid'");
       if($ee){
         header("location:editfifthyeartimetable.php?succ");
       }
     }
?>
  <style type="text/css">
    @media(min-width: 576px){
      .nice {
        position: relative;
        left: 25%;
      }
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
                <h3>Edit Fifth Year Timetable</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Fifth Year Timetable</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                   
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

              <?php if(isset($_GET['succ'])){
                  echo "<div class='alert alert-success'>Successfully updated</div>";
               } ?>  
                
            <div class="text-center nice">
            <form action="editfifthyeartimetable.php" method="POST">
              
            <div class="col-md-7 col-xs-12 text-center" style="margin-bottom: 10px;">
                      <select name="selectday" class="form-control col-md-7 col-xs-12">
                          <option value="1" <?php if($day == '1') echo "selected";?>>Monday</option>
                          <option value="2" <?php if($day == '2') echo "selected";?>>Tuesday</option>
                          <option value="3" <?php if($day == '3') echo "selected";?>>Wednesday</option>
                          <option value="4" <?php if($day == '4') echo "selected";?>>Thursday</option>
                          <option value="5" <?php if($day == '5') echo "selected";?>>Friday</option>
                      </select>
                      <button class="btn btn-primary btn-sm" name="change">Change</button>
                </div>
                
                </form>
              </div>
               
                  
                  <form class="form-horizontal form-label-left" action="editfifthyeartimetable.php" method="POST">
              
                  <input type="hidden" name="hiddenid" value="<?php echo $query['timetable_id']?>">
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timeone">9:00-9:10 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timeone" name="timeone" value="<?php echo $query['timeone']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timetwo">10:00-10:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timetwo" name="timetwo" value="<?php echo $query['timetwo']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timethree">11:00-11:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timethree" name="timethree" value="<?php echo $query['timethree']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timefour">1:00-1:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timefour" name="timefour" value="<?php echo $query['timefour']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timefive">2:00-2:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timefive" name="timefive" value="<?php echo $query['timefive']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timesix">3:00-3:50 AM<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="timesix" name="timesix" value="<?php echo $query['timesix']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <button type="submit" class="btn btn-success" name="add">Submit</button>
                          <a href="fifthyeartimetable.php" class="btn btn-info" name="back">Back</a>
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