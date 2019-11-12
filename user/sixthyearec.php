<?php 
 include('../admin/database/connection.php');
 include('userauth.php');
 include('includes/userheader.php');
 include('functions.php');
     $hi = $conn->query("SELECT * FROM users WHERE year_id = '6'");
     $wow = $conn->query("SELECT * FROM users WHERE year_id = '6' AND status = '3'");
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
            <a style="text-decoration: none;" href="sixthyearec.php">Select Ec</a>
          </li>
          <li class="breadcrumb-item active">Sixth Year</li>
        </ol>
        <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
                         <table class="table table-bordered hello" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                                <tr>
                                   <td>Student Image</td>
                                   <td>Student Name</td>
                                   <td>Status</td>
                                   <td>Mark as Ec</td>
                                </tr>
                          </thead>
                          <tbody>
                            <?php
                              if($wow->num_rows > 0) { 
                              foreach($hi as $hii) : ?>
                              <tr>
                                 <td><img src="../admin/userprofiles/<?php echo $hii['userphoto']?>" style="height: 25px; width: 25px;"></td>
                                 <td><?php echo $hii['username']?></td>
                                 <td class="cha"><?php if($hii['status'] == '2') : ?>
                                     Student
                                     <?php else: ?>
                                      Ec
                                    <?php endif; ?>
                                  </td>
                                  <td><?php if($hii['status'] == '2') : ?>
                                         -
                                        <?php else: ?>
                                        <button class="btn btn-danger remove"  data-id="<?php echo $hii['userid']?>"><i class="fas fa-window-close fa-lg text-secondary"></i> Remove </button>
                                      <?php endif; ?>
                                  </td>
                                </tr>
                               <?php endforeach; ?>
                                <?php }else{ 
                                foreach($hi as $hii) : ?>
                                <tr>
                                 <td><img src="../admin/userprofiles/<?php echo $hii['userphoto']?>" style="height: 25px; width: 25px;"></td>
                                 <td><?php echo $hii['username']?></td>
                                 <td class="chakra"><?php if($hii['status'] == '2') : ?>
                                     Student
                                     <?php else: ?>
                                      Ec
                                    <?php endif; ?>
                                  </td>
                                  <td><button class="btn btn-success checkec"  data-id="<?php echo $hii['userid']?>"><i class="fas fa-check text-secondary fa-lg "></i> Mark</button></td>
                                </tr>
                               <?php endforeach; ?>
                            <?php } ?>
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
<?php include('includes/script.php'); ?>