<?php 
include('database/connection.php');
include('function.php');
include ('includes/header.php'); 
include('adminauth.php');
     if(isset($_GET['edit_id'])) {
       $edit_id = clean($_GET['edit_id']);
       $do = $conn->query("SELECT * FROM posts WHERE post_id = '$edit_id'");
       $did = $do->fetch_assoc();
     }
    $errMsg = '';
   $succMsg = '';
   if(isset($_POST['cle'])){
    $hidnoti_id = clean($_POST['hidnoti_id']);
  if(empty($_POST['noti_content'])){
    $errMsg = 'Noti content is required';
  }else{
    $noti_content = clean($_POST['noti_content']);
  }
  if(!empty($_FILES['noti_photo']['name'])){
              $cover = $_FILES['noti_photo']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['noti_photo']['tmp_name'];
              $type = $_FILES['noti_photo']['type'];
              $size = $_FILES['noti_photo']['size'];
              if($type=="image/jpg" || $type == "image/png" || $type=="image/jpeg" || $type=="image/gif")
              {
                if($size < '3000000') {
                move_uploaded_file($tmp, "../admin/posts/$filename");
                }else{
                  $errMsg.= "Image size is too big<br>";
                }
              }else{
                $errMsg .= "jpg,png,gif နှင့် jpeg type များသာလက်ခံသည်။<br>";
              }            
            }
            if(empty($_POST['usertype'])){
              $errMsg .="Usertype is required";
            }else{
              $usertype = clean($_POST['usertype']);
            }
            if(!empty($_POST['post_year'])) {
                if($userype == '1'){
                  $post_year = '0';
                }elseif($usertype == '2'){
                   if(empty($_POST['post_year'])){
                    $post_year = '7';
                   }else{
                  $post_year = clean($_POST['post_year']);
                  }
                }elseif($usertype == '3'){
                   if(empty($_POST['post_year'])){
                    $post_year = '7';
                   }else{
                  $post_year = clean($_POST['post_year']);
                  }
                }else{
                  $post_year = '0';
                }
            }
          
            if(empty($errMsg)) {
              if(!empty($_FILES['noti_photo']['name'])){
              $query = $conn->query("UPDATE posts SET post_content='$noti_content',post_photo='$filename',post_year='$post_year',post_status='$usertype', updated_date=now() WHERE post_id = '$hidnoti_id'");
            }else{
            $query = $conn->query("UPDATE posts SET post_content ='$noti_content',post_year='$post_year',post_status='$usertype', updated_date=now() WHERE post_id = '$hidnoti_id'");
            }

            if($query){
               header("location:editadminpost.php?action=success&&edit_id=$hidnoti_id");
            }
           }
}
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          <?php include ('includes/sidebar.php'); ?>
          <?php include('includes/navbar.php'); ?>
           <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Notifications</h3>
              </div>

          
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Notifications</h2>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                       
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="editadminpost.php" enctype="multipart/form-data">
                       <?php if($errMsg){
                       echo "<div class='alert alert-danger'>
                                        >
                                        $errMsg</div>";
                    }?>
                    <?php if(isset($_GET['action']) && ($_GET['action'] == 'success')) { 
                       echo "<div class='alert alert-success'>
                                        Successfully Updated</div>";
                    }?>  
                      <input type="hidden" name="hidnoti_id" value="<?php echo $did['post_id']?>">
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo<span class="required"></span>
                        </label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                         <img src="posts/<?php echo $did['post_photo']?>" style="height: 200px; width: 200px;">
                         <input type="file" name="noti_photo">
                       </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Notification Content<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" name="noti_content" rows="3" placeholder="Notification Content"><?php echo $did['post_content']?></textarea>
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Year</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" tabindex="-1" name="post_year">
                            <?php $rhy = $conn->query("SELECT * FROM years");
                              foreach ($rhy as $rhyme) :
                             ?>
                               <option value="<?php echo $rhyme['years_id']?>"
                                <?php if($rhyme['years_id'] == $did['post_year']) echo "selected"; ?>
                                ><?php echo $rhyme['years_name']?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Check
                          <br>
                        </label>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="check">
                            <label>
                              <input type="radio" name="usertype" value="1" <?php if($did['post_status'] == '1') echo "checked";?>>Teachers
                            </label>
                          </div>
                          <div class="check">
                            <label>
                              <input type="radio" name="usertype" value="2" <?php if($did['post_status'] == '2') echo "checked";?>>Students
                            </label>
                          </div>
                            <div class="check">
                            <label>
                              <input type="radio" name="usertype" value="3" <?php if($did['post_status'] == '3') echo "checked";?>>Ecs
                            </label>
                          </div>
                          <div class="check">
                            <label>
                              <input type="radio" name="usertype" value="4" <?php if($did['post_status'] == '4') echo "checked";?>>All
                            </label>
                          </div>
                        </div>
                      </div>

                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                           <input type="submit" name="cle" value="Submit">
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
      </div>
    </div>
  </body>

    <!-- jQuery -->
    <?php include('includes/footer.php'); ?>
   