<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
   if(isset($_POST['addexamdates'])) {
       $subjects = clean($_POST['subjects']);
       $yearstu = clean($_POST['yearstu']);
       $datestu = clean($_POST['datestu']);
       $timestu = clean($_POST['timestu']);
       $nice = $conn->query("INSERT INTO examdates (examdates_subjects, examdates_year_id, examdates_date, examdates_times, created_date, updated_date) VALUES ('$subjects','$yearstu','$datestu','$timestu',now(),now())");
       if($nice){
           header("location: addexamdates.php?succ");
       }
   }
  
?>
<style type="text/css">
      .required{
        color: red;
      }
      .error{
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
                <h3>Add Exam Dates</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Exam Dates</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                   
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                     <?php if(isset($_GET['succ'])) {
                echo "<div class='alert alert-success'>Successfully added</div>";
              } ?>
                  </div>
                  <div class="x_content">
                    <form method="POST" class="form-horizontal form-label-left" id="exam" enctype="multipart/form-data" action="addexamdates.php">
                         <div class="form-group">
                    <label class="control-label col-md-3" for="subjects">Subjects<span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <input type="text" id="subjects" name="subjects" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="yearstu">Select Year<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select name="yearstu" class="form-control col-md-7 col-xs-12">
                            <?php $mine=$conn->query("SELECT * FROM years WHERE years_id!='7'"); 
                            while($my = $mine->fetch_assoc()) : ?>
                            <option value="<?php echo $my['years_id']?>"><?php echo $my['years_name']; ?></option>
                          <?php endwhile; ?>
                          </select>
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="control-label col-md-3" for="datestu">Select Date<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <input type="date" name="datestu" class="form-control col-md-7 col-xs-12" id="datestu">
                        </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="timestu">Select Time<span class="required">*</span></label>
                    <div class="col-md-7">
                      <input type="radio" value="1" name="timestu"> 8:30AM-11:30AM &nbsp;&nbsp;
                      <input type="radio" value="2" name="timestu"> 1:00PM-4:00PM
                    </div>
                  </div>
                   <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <button type="submit" class="btn btn-success" name="addexamdates">Submit</button>
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
    </div>
  </body>
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#exam').validate({
          rules: {
            subjects : {
              required: true
            },
            yearstu: {
              required: true
            },
            datestu: {
              required: true
            },
            timestu: {
              required: true
            }
          },
          messages: {

          }
        });
      });
    </script>