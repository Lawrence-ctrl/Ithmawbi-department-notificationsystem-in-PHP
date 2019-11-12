<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
$query = $conn->query("SELECT * FROM posts");
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Posts <small> Admin</small> </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Posts <small> Admin </small></h2>
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

                    <div class="row">

                      <p>Your Posts</p>
                      <?php while($row = $query->fetch_assoc()): 
                         if(!empty($row['post_photo'])) : 
                        ?>
                      <div class="col-md-3 col-xs-12">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="posts/<?php echo $row['post_photo']?>" alt="image" />
                            <div class="mask">
                              <p><?php echo $row['post_id']?></p>
                              <div class="tools tools-bottom">
                                <a href="#"><i class="fa fa-link"></i></a>
                                <a href="#"><i class="fa fa-pencil"></i></a>
                                <a href="#"><i class="fa fa-times"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><?php echo $row['post_content']?></p>
                              <div class="table">
                            <table width="140%">
                              <td><i class="fa fa-thumbs-up text-primary fa-lg"></i></td>
                              <td><i class="fa fa-comment text-primary fa-lg"></i></td>
                              <td><i class="fa fa-share text-primary fa-lg"></i></td>
                            </table>
                          </div>
                          </div>
                          <hr>
                        
                        </div>
                      </div>
                      <?php else: ?>
                        <div class="col-md-3 col-xs-12">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="posts/download.png" alt="image"/>
                            <div class="mask">
                              <p><?php echo $row['post_id']?></p>
                              <div class="tools tools-bottom">
                                <a href="#"><i class="fa fa-link"></i></a>
                                <a href="edit-adminpost.php?post_id=<?php echo $row['post_id']?>"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Are you sure you want to delete this post?')" href="delete-admin-post.php?post_id=<?php echo $row['post_id']?>"><i class="fa fa-times"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><?php echo $row['post_content']?></p>
                              <div class="table">
                            <table width="140%">
                              <td><i class="fa fa-thumbs-up text-primary fa-lg"></i></td>
                              <td><i class="fa fa-comment text-primary fa-lg"></i></td>
                              <td><i class="fa fa-share text-primary fa-lg"></i></td>
                            </table>
                          </div>
                          </div>
                          <hr>
                        
                        </div>
                      </div>
                    <?php endif;?>
                    <?php endwhile; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>