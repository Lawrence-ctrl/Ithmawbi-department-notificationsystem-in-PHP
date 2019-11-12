<?php 
 include('../admin/database/connection.php');
 include('userauth.php');
 include('includes/userheader.php');
 include('functions.php');
 ?>
<body id="page-top">

   <?php include('includes/usernavbar.php');?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/usersidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="text-decoration: none;" href="chat.php">Chat</a>
          </li>
          <!-- <li class="breadcrumb-item active">Chat</li> -->
        </ol>

         <?php if($rrr['status']=='1' OR $rrr['status'] == '3') { ?>
          <div style="padding-bottom: 10px;">
          <center><a href="group-chat.php" class="btn btn-info groupchat"><i class="fas fa-users"></i> &nbsp;Group Chat</a></center>
          </div>
        <?php } ?>
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
                                   <td>Role</td>
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
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

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
 <script type="text/javascript">
     $(document).ready(function() {
      fetch_user();
      setInterval(function(){
          fetch_user();
          update_last_activity();
      },5000);
        function fetch_user() {
            $.ajax({
              url : "fetch_user.php",
              method : "POST",
              success : function(data) {
                $('tbody').html(data);
              }
            });
        }
        function update_last_activity() {
           $.ajax({
            url : "update_last_activity.php",
            success: function(data){
              
            }
           });
        }
     });
</script>
