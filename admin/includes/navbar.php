<?php 
   $pp = $conn->query("SELECT * FROM admin WHERE admin_id = '".$_SESSION['admin_id']."'");
   $ppp = $pp->fetch_assoc();
?>
<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="adminprofiles/<?php echo $ppp['admin_photo']?>" alt="">
                    <?php echo $ppp['admin_name']?><span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="adminpassword.php">Change Password</a></li>
                    <li><a onclick="return confirm('Are you sure you want to logout?')" href="adminlogout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>