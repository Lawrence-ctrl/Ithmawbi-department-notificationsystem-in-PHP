<?php 
include('adminauth.php');
include ('includes/header.php'); 
include('function.php');
include('database/connection.php');
?>
<style type="text/css">
   .rush {
    border: 2px solid lightgray;
    border-radius: 5px;
    padding: 15px;
   }
</style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Chat</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Chat<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
          <!--      <form class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="chat.php" method="POST">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" name="nasearch" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="search">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->
                         <table class="table table-bordered hello" width="100%" cellspacing="0">
                          <thead>
                                <tr>
                                   <td>User Image</td>
                                   <td>Username</td>
                                   <th>Role</th>
                                   <td>Status</td>
                                   <td>Action</td>
                                </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                         </table>
                      </div>
        </div>
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
     $(document).ready(function() {
      fetch_user();
      setInterval(function(){
          fetch_user();
          update_last_activity();
      },5000);
        function fetch_user() {
            $.ajax({
              url : "fetch_admin.php",
              method : "POST",
              success : function(data) {
                $('tbody').html(data);
              }
            });
        }
        function update_last_activity() {
           $.ajax({
            url : "update_adminlast_activity.php",
            success: function(data){
              
            }
           });
        }
     });
</script>
