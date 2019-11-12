<?php
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
  $query = $conn->query("SELECT users.*, years.* FROM users join years ON users.year_id = years.years_id WHERE status = '2' OR status= '3'");
?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Students</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Students <small>sub title</small></h2>
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
                    <table id="datatable" class="table table-striped table-bordered">
                       <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Year</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php foreach ($query as $row) : ?>
                               <tr>
                                 <td><?php echo $row['username']?></td>
                                 <td><?php echo $row['useremail']?></td>
                                 <td><?php echo ($row['status'] == '2')?"Student":"Ec";?></td>
                                 <td><?php echo $row['years_name']?></td>
                                 <td style="text-align: center;"><?php echo ($row['user_status'] == '1')?"<button class='btn btn-success btn-sm change' id=".$row['userid']."><i class='fa fa-check' aria-hidden='true'></i></button>":"<button class='btn btn-danger btn-sm remove' id=".$row['userid']."><i class='fa fa-ban' aria-hidden='true'></i></button>";?>
                                </td>
                                 <td style="text-align: center;">
                                    <a class="btn btn-danger trash" data-id="<?php echo $row['userid']?>"><i class="fa fa-trash fa-lg"></i></a>
                                 </td>
                               </tr>
                            <?php endforeach; ?>
                      </tbody>
                    </table>
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
    <script type="text/javascript">
      $(document).ready(function(){
          $('.trash').on('click',function() {
           var trashid = $(this).data('id');
           $clicked = $(this).parent().parent();
            if(confirm('Are you sure you want to delete this user?')) {
              $.ajax({
                  url: "deleteusers.php",
                  method : "POST",
                  dataType : "json",
                  data: {trashid:trashid},
                  success: function(data){
                   if(data.code = 100) {
                   $clicked.css({'background':'red'});
                   $clicked.fadeTo('slow',0.7,function() {
                   $(this).remove();
                  });
                 }
               }
              });
            };
          });
          $('.change').on('click',function(){
            var changeid = $(this).attr('id');
            var action = 'ban';
            $check = $(this).parent();
            if(confirm('Are you sure you want to ban this user?')) {
              $.ajax({
                url : "dosomething.php",
                method : "POST",
                data : {action:action, changeid:changeid},
                success: function(data){
                    $check.html(data);
                    location.reload();
                }
              });
            }
          });
          $('.remove').on('click',function(){
            var removeid = $(this).attr('id');
            var action = 'remove';
            $rmove = $(this).parent();
            if(confirm('Are you sure you want to stop banning this user?')) {
              $.ajax({
                url : "dosomething.php",
                method : "POST",
                data : {action:action, removeid:removeid},
                success: function(data){
                    $rmove.html(data);
                    location.reload();
                }
              });
            }
          });
      });
    </script>