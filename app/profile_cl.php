<?php
  session_start();
  include_once('include/config.php');
  
  $pageID = "";
  $logout_path = "logout.php";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:404/pg.error.php");      
  }  else {
      
      $username = getUser($connection, $pageID);
      
      if($username){
      $index = "index.php?page_id=".$pageID;      
      
      //Get User Type
      $userType = getUserType($connection, $username);
      
      //Set Company Name
      $CompName = getCompName($connection, $username, $userType);
      
      $userAvatar = getAvatar($connection, $username);

  if(isset($_POST['update_pro'])){
    $paddress = sanitize_post($_POST['paddress']);
    $telephone = sanitize_post($_POST['telephone']);
  $connection->query("UPDATE clients SET ADDRESS='$paddress',CONTACTNO='$telephone' WHERE EMAILADDRESS='$username'");
}

  $error = "";
?>
<!DOCTYPE html>
<html lang="en">

  <head>
      <?php include 'head.php'; ?>
  </head>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
            <?php include 'header.php'; ?>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    
                    <p class="centered">
                      <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID?>">                           
                          <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
                      </a>
                  </p>
              	  <h5 class="centered"><?php echo $CompName ?></h5>

                    <li class="mt hvr-grow">
                        <a href="index.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-dashboard"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>

                    <li class="mt hvr-grow">
                        <a href="bids.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-tasks"></i>
                            <span>BIDS</span>
                        </a>
                    </li>

                    <li class="mt hvr-grow">
                        <a href="newslet.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-envelope-o"></i>
                            <span>NEWSLETTERS</span>
                        </a>
                    </li>

                    <li class="mt hvr-grow">
                        <a class="active" href="profile_cl.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-user"></i>
                            <span>PROFILE</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-9 main-chart animated fadeInDown">
                        <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                            <h1 class="text-center text-uppercase">
                                JMB Online: Profile
                            </h1>
                        </div>
                        <div class="row">
                            
                                <?php echo $userAvatar ?>
                            <!-- dashboard header -->
                            <div class="col-md-12">
                                <div class="dash-head clearfix mt15 mb20 ">
                                    <!-- tab style -->
                                    <div class="clearfix">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-myprofile" data-toggle="tab"><span class="ion ion-person">&nbsp;&nbsp;</span>MY PROFILE</a></li>
                                            <li><a href="#tab-editprofile" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>EDIT PROFILE</a></li>
                                            <li><a href="#tab-avatar" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>PROFILE PHOTO</a></li>
                                            <li><a href="#tab-changepass" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>CHANGE PASSWORD</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active animated fadeInDown" id="tab-myprofile">
                                                <div class="clearfix">
                                                    <!-- Basic Table -->
                                                            <div class="panel-body panel-lined panel-hovered mb20 table-responsive basic-table">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <?php
                                                                            
                                                                            $results = $connection->query("SELECT * FROM clients where EMAILADDRESS='$username'");
                                                                            
                                                                            foreach($results as $item){
                                                                                echo "<tr><td>Name</td><td> ".$item['REGNAME']."</td></tr>";
                                                                                echo "<tr><td>Physical Address</td><td>".$item['ADDRESS']."</td></tr>";
                                                                                echo "<tr><td>Tell Number</td><td>".$item['CONTACTNO']."</td></tr>";
                                                                                echo "<tr><td>Email Address</td><td>".$item['EMAILADDRESS']."</td></tr>";
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane animated fadeInDown" id="tab-editprofile">
                                                <div class="clearfix">
                                                 <div class="panel-body panel-lined panel-hovered mb20 table-responsive basic-table">
                                                     
                                                     <div id="pro_loading" class="text-center" hidden>
                                                         <img src="images/preloader.gif" height="64" width="64" alt="">
                                                         <br />
                                                         <br />
                                                     </div>
                                                     
                                                     <div id="pro_success" class='col-lg-12 centered animated fadeInDownBig' hidden>
                                                        <div id="pro_success_msg" class="alert alert-success text-center text-bold text-desc"></div>                                                        
                                                    </div>
                                                
                                                    <div id="pro_error" class='col-lg-12 centered animated fadeInUpBig' hidden>
                                                        <div id="pro_error_msg" class="alert alert-danger text-center text-bold text-desc"></div>                                                        
                                                    </div>
                                                     
                                                    <form id="editCl" method="POST">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <?php echo $item["REGNAME"];?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="text" name="paddress" value='<?php echo $item["ADDRESS"];?>' pattern=".{8,}" title="a valid Address should be at least 8 charaters" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <?php echo $item["EMAILADDRESS"];?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="tel" name="telephone" value='<?php echo $item["CONTACTNO"];?>' pattern="^\d{3}-\d{3}-\d{4}$" title="e.g. 081-718-9287" required>
                                                                    </div>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="col-md-6 form-container">
                                                                        <button type="submit"
                                                                                class="btn btn-danger btn-block text-uppercase btn-lg" name="remove_pro">
                                                                            remove profile
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-md-6 form-container">
                                                                        <button class="btn btn-primary btn-block text-uppercase btn-lg" name="update_pro">
                                                                            UPDATE
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                                        </tbody>
                                                        </table>
                                                    </form>
                                                 </div>                                                        
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane animated fadeInDown" id="tab-avatar">
                                                <div class="row mt clearfix">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-lg-3"> <br /> </div>                                            
                                            <! -- PROFILE 02 PANEL -->                                            
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb">
                                                
                                                <div id="pic_success" class='col-lg-12 centered' hidden>
                                                    <br />
                                                    <div id="success_msg" class="alert alert-success text-center text-bold text-desc"></div>                                                        
                                                </div>
                                                
                                                <div id="pic_error" class='col-lg-12 centered' hidden>
                                                    <br />
                                                    <div id="error_msg" class="alert alert-danger text-center text-bold text-desc"></div>                                                        
                                                </div>
                                                
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <img height="250px" width="100%" id="previewing" src="<?php echo $userAvatar; ?>" />
                                                    <div id="selectImage">
                                                        <input type="file" name="file" class="hidden" id="file" required />
                                                        <div class="col-lg-4"> <br /> </div>
                                                        <div id="btnSave" class="col-lg-4">
                                                            <br />
                                                            <input type="submit" value="Save" class="btn btn-lg btn-primary" />                                                            
                                                        </div>
                                                  </div>
                                                </form>
                                            </div><!--/ col-md-4 -->                                            
                                            <div class="col-lg-3"></div>
                                        </div>
                                    </div>
                                </div>
                                            </div>
                                            
                                            <div class="tab-pane animated fadeInDown" id="tab-changepass">
                                                <div class="clearfix">
                                                    <!-- Basic Table -->
                                                    <div class="panel-body panel-lined panel-hovered mb20 table-responsive basic-table">

                                            <form id="changePass" method="POST">
                                                <div id="loading" class="text-center" hidden>
                                                    <img src="images/preloader.gif" height="64" width="64" alt="">
                                                    <br />
                                                    <br />
                                                </div>

                                                <div id="pass_success" class='col-lg-12 centered animated fadeInDownBig' hidden>
                                                    <br />
                                                    <div id="pass_success_msg" class="alert alert-success text-center text-bold text-desc"></div>                                                        
                                                </div>

                                                <div id="pass_error" class='col-lg-12 centered animated fadeInUpBig' hidden>
                                                    <br />
                                                    <div id="pass_error_msg" class="alert alert-danger text-center text-bold text-desc"></div>                                                            
                                                </div>

                                                <div class="col-md-2"> <br > </div>
                                                    <div class="col-md-8">
                                            <table class="table">
                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="password" id="old_password" name="old_password" placeholder="Enter Existing Password" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="password" id="password" name="password" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
                                                    <p id="passError" class="text-danger text-center" hidden><br /> Oops! Passwords do not match.</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-container">
                                                                        <button name="update_pass" id="update_pass" type="submit" class="btn btn-primary btn-block text-uppercase">
                                                                            Change
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                                    <div class="col-md-2"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- #end todo-list -->
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>               
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                      <?php include 'suplist.php'; ?>
                  </div><!-- /col-lg-3 -->
                </div>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2015
              <a href="index.php" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
      
      <!-- Import JS  -->
      <?php include 'js.php'; ?>   
    <script src="assets/js/script.js"></script>
    

    <script type="text/javascript">
      $("#uploadFilec").click(function(e){

          $("#uploadFile").click();
          $('#previewing').attr('src', e.target.result);
      });
        $("#previewing").click(function(e){

          $("#file").click();
      });
    </script>
    
</body>
</html>
  <?php 
      }else{
          header_remove();
          header("location:404/pg.error.php");
      }
  }