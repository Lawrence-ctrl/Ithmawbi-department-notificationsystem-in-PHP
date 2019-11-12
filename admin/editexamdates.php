<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
         if(isset($_POST['change'])){
          $yearofuser = clean($_POST['yearstu']);
           $do = $conn->query("SELECT * FROM examdates WHERE examdates_year_id = '$yearofuser' ORDER BY examdates_date ASC");
        }else{
           $yearofuser ='1';
           $do = $conn->query("SELECT * FROM examdates WHERE examdates_year_id = '$yearofuser' ORDER BY examdates_date ASC");
         }
        
?>
<style type="text/css">
      .required{
        color: red;
      }
      .error{
        color: red;
      }

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
                <h3>Exam Dates</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Exam Dates</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                   
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                   
                  <div class="x_content">
                    <div class="text-center nice">
                      <form action="editexamdates.php" method="POST">
                    <div class="col-md-7 col-xs-12 text-center" style="margin-bottom: 10px;margin-top: 10px">
                        <div class="col-md-7">
                          <select name="yearstu" class="form-control col-md-7 col-xs-12">
                            <?php $mine=$conn->query("SELECT * FROM years WHERE years_id!='7'"); 
                            while($my = $mine->fetch_assoc()) : ?>
                            <option value="<?php echo $my['years_id']?>"
                              <?php if($my['years_id']==$yearofuser) echo "selected";?>><?php echo $my['years_name']; ?></option>
                          <?php endwhile; ?>

                          </select>
                          <button class="btn btn-primary btn-sm" name="change">Change</button>
                        </div>
                  </div>
                </form>
                    </div> 
                    <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <td>Date (YYYY-MM-DD)</td>
                              <td>Time</td>
                              <td>Subjects</td>
                              <td>Action</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while($does = $do->fetch_assoc()): ?>
                            <tr>
                              <td><?php echo $does['examdates_date']?></td>
                             <td> <?php echo (($does['examdates_times']=='1')?'8:30AM to 11:30AM':'1:00PM to 4:00PM');?></td>
                             <td><?php echo $does['examdates_subjects']?></td>
                             <td><a href="editexambyid.php?exam_id=<?php echo $does['examdates_id']?>"><i class="fa fa-edit text-info fa-lg"></i></a>
                              <i class="fa fa-trash text-danger fa-lg ll" id="<?php echo $does['examdates_id']?>"></i></td>
                            </tr>
                          <?php endwhile; ?>
                          </tbody>
                      </table>
                </div>
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
      $(document).ready(function(){
        $('.ll').on('click',function(){
          var remove_id = $(this).attr('id');
          $hi = $(this);
          $.ajax({
            url: 'remove.php',
            method: 'POST',
            data: {remove_id:remove_id},
            success: function(data){
              $hi.parent().parent().remove();
              alert('DELETE Successfully');
            }
          });
        });
      });
    </script>