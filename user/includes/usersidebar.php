<ul class="sidebar navbar-nav">
  <?php if($rrr['status'] == '1') : ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-bell"></i>
          <span>Notifications</span>
        </a>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-step-forward"></i>
          <span>Send Notifications</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">    
          <a class="dropdown-item" href="addecnoti.php"><i class="fa fa-plus"></i> To Ec</a>
          <a class="dropdown-item" href="addstnoti.php"><i class="fas fa-plus"></i> To Students</a>
        </div>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="wall.php">
          <i class="fas fa-fw fa-plus-circle"></i>
          <span>Wall</span>
        </a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-check"></i>
          <span>Select Ec</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">    
          <a class="dropdown-item" href="firstyearec.php"><i class="fa fa-dice-one"></i> &nbsp;First Year</a>
          <a class="dropdown-item" href="secondyearec.php"><i class="fa fa-dice-two"></i> &nbsp;Second Year</a>
          <a class="dropdown-item" href="thirdyearec.php"><i class="fa fa-dice-three"></i> &nbsp;Third Year</a>
          <a class="dropdown-item" href="fourthyearec.php"><i class="fa fa-dice-four"></i> &nbsp;Fourth Year</a>
          <a class="dropdown-item" href="fifthyearec.php"><i class="fa fa-dice-five"></i> &nbsp;Fifth Year</a>
          <a class="dropdown-item" href="sixthyearec.php"><i class="fa fa-dice-six"></i> &nbsp;Sixth Year</a>
        </div>
      </li>
      <?php else: ?>
           <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-bell"></i>
          <span>Notifications</span>
        </a>
      </li>
    <?php endif; ?>
        <li class="nav-item">
        <a class="nav-link" href="saveditems.php">
          <i class="fas fa-fw fa-heart"></i>
          <span>Favourites</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="timetables.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Timetables</span>
        </a>
      </li>
    <!--   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-table"></i>
          <span>Time Tables</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">    
          <a class="dropdown-item" href="404.html">Yours</a>
        </div>
      </li> -->
        <li class="nav-item">
        <a class="nav-link" href="examdates.php">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Exam Dates</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="chat.php">
          <i class="fa fa-fw fa-paper-plane"></i>
          <span>Chat</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chatadmin.php">
          <i class="fa fa-fw fa-comment-dots"></i>
          <span>Chat With ADMIN</span>
        </a>
      </li>  
    </ul>