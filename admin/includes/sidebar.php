 <?php 
   $pp = $conn->query("SELECT * FROM admin WHERE admin_id = '".$_SESSION['admin_id']."'");
   $ppp = $pp->fetch_assoc();
?>
  <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-bell"></i> <span><?php echo $ppp['admin_name']?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="adminprofiles/<?php echo $ppp['admin_photo']?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $ppp['admin_name']?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                  
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Send Noti <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sendteachers.php">To Teachers</a></li>
                      <li><a href="sendstudents.php">To Students</a></li>
                      <li><a href="sendec.php">To Ec</a></li>
                      <li><a href="sendall.php">To All</a></li>
                    </ul>
                  </li>
                 
                  <li><a><i class="fa fa-table"></i> Manage <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="manage-teachers.php">Teachers</a></li>
                      <li><a href="manage-students.php">Students</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Add Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="add_teachers.php">Add Teachers</a>
                        </li>
                         <li><a>Add Timetables<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="firstyeartimetable.php">First Year</a></li>
                        <li><a href="secondyeartimetable.php">Second Year</a></li>
                        <li><a href="thirdyeartimetable.php">Third Year</a></li>
                        <li><a href="fourthyeartimetable.php">Fourth Year</a></li>
                        <li><a href="fifthyeartimetable.php">Fifth Year</a></li>
                        <li><a href="sixthyeartimetable.php">Sixth Year</a></li>
                    </ul>
                  </li>
                              <li><a>Exam Dates<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="addexamdates.php">Add</a></li>
                        <li><a href="editexamdates.php">Edit</a></li>
                    </ul>
                  </li> 
                    </ul>
                  </li>
                  <li><a href="chat.php"><i class="fa fa-paper-plane"></i> Chat </a>
                  
                  </li>
                </ul>
              </div>
            
                                    
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>