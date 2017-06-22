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
      
      if(!$username){          
          header_remove();
          header("location:404/pg.error.php");          
      }else{
          
          //Get User Type
          $userType = getUserType($connection, $username);
          
          //Set Company Name
$CompName = getCompName($connection, $username, $userType);

$userAvatar = getAvatar($connection, $username);

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
                        <a class="logout" href="profile_sup.php?page_id=<?php echo $pageID?>">                           
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
                        <a href="catalogue.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-archive"></i>
                            <span> CATALOGUE</span>
                        </a>
                    </li>
                    
                    <li class="mt hvr-grow">
                      <a href="newslet.php?page_id=<?php echo $pageID?>">
                          <i class="fa fa-envelope-o"></i>
                          <span>NEWSLETTERS</span>
                      </a>
                  </li>
                    
                    <li class="mt hvr-grow">
                        <a class="active" href="profile_sup.php?page_id=<?php echo $pageID?>">
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
                            <h1 class="text-center text-uppercase">JMB Online: Profile</h1>
                        </div>
                        <div class="row">
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
                                                    <!-- #end profile-picture -->
                                                    <!-- Basic Table -->
                                                    <div class="col-md-12">
                                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                            <div class="panel-body" style="font-size:10pt;">
                                                                <table class="table">
                                                                    <?php
                                                                    $results = $connection->query("SELECT * FROM supplier where EMAILADDRESS='$username'");
                                                                    foreach($results as $item){?>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Name</td>
                                                                            <td><?php echo $item['COMPANYNAME']; ?></td>
                                                                        </tr>
                                <tr>
                                    <td>Web Address</td>
                                    <td><?php echo $item['WEBADDRESS']; ?></td>
                                </tr>
                                <tr>
                                    <td>Physical Address</td>
                                    <td><?php echo $item['PADDRESS']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tell Number</td>
                                    <td><?php echo $item['TELLNUMBER']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email Address</td>
                                    <td><?php echo $item['EMAILADDRESS']; ?></td>
                                </tr>
                            </tbody>
                            </table>
                            </div>
                            </div>
                            </div>
                            </div>
                                            </div>

                                            <div class="tab-pane animated fadeInDown" id="tab-editprofile">
                                            <div class="clearfix">
                                            <!-- Basic Table -->
                                            <div class="col-md-12">
                                                
                                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                
                                                <div id="pro_loading" class="text-center" hidden>
                                                    <br />
                                                    <img src="images/preloader.gif" height="64" width="64" alt="">
                                                    <br />
                                                    <br />
                                                </div>

                                                <div id="pro_success" class='col-lg-12 fadeInDownBig animated centered' hidden>
                                                    <br />
                                                    <div id="pro_success_msg" class="alert alert-success text-center text-bold text-desc"></div>
                                                </div>

                                                <div id="pro_error" class='col-lg-12 centered fadeInUpBig animated' hidden>
                                                    <br />
                                                    <div id="pro_error_msg" class="alert alert-danger text-center text-bold text-desc"></div>
                                                </div>
                                                
                                            <div class="panel-body">
                                            <form method="POST" id="editSUP">                                                                    
                                            <table class="table">
                                            <tbody>
                                            <tr>
                                            <td>
                                                <div class="has-success focus centered">
                                                    <?php echo $item['COMPANYNAME']; ?>
                                                </div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="has-success focus centered">
                                                    <?php echo $item['EMAILADDRESS']; } ?>
                                                </div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="has-success focus centered">
                                                    <input class="form-control centered" type="text" name="webAddress" value="<?php echo $item['WEBADDRESS']; ?>" required>
                                                </div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="has-success focus">
                                                    <input class="form-control centered" type="text" name="pAddress" value="<?php echo $item['PADDRESS']; ?>" required>
                                                </div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="has-success focus">
                                                    <input class="form-control centered" type="text" name="telNum" value="<?php echo $item['TELLNUMBER']; ?>" required>
                                                </div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="form-container col-md-6"></div>
                                                <div class="form-container col-md-6">
                                                    <button name="update_pro" type="submit" class="btn btn-primary btn-block text-uppercase btn-lg">
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
                                            </div> <!-- #end todo-list -->
                                            </div>
                                            </div>
                                            
                                            <div class="tab-pane animated fadeInDown" id="tab-avatar">
                                <div class="row mt clearfix">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        
                                        <div class="row">
                                            
                                            <div class="col-lg-3">
                                                <br />
                                            </div>
                                            
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
                                          <div class="col-md-12">
                                              
                                              <div id="loading" class="text-center" hidden>
                                                        <img src="images/preloader.gif" height="64" width="64" alt="">
                                                        <br />
                                                        <br />
                                                    </div>
                                                    
                                                    <div id="pass_error" class="col-lg-12 centered" hidden>
                                                        <div id="pass_error_msg" class="alert alert-danger text-center text-bold text-desc fadeInUpBig animated "></div>                                                            
                                                    </div>
                                                    
                                                    <div id="pass_success" class='col-lg-12 centered' hidden>
                                                        <div id="pass_success_msg" class="alert alert-success text-center text-bold text-desc fadeInDownBig animated"></div>
                                                    </div>
                                              
                                              <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                  <div class="panel-body">
                                                      <form method="POST" id="changePass">
                                                          
                                                          <div class="col-md-2">
                                                              <br />
                                                          </div>
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
                    </div>
                    </div> <!-- #end row -->
                  <!-- #end row -->                      
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                      <?php include 'suplist.php'; ?>
                  </div><!-- /col-lg-3 -->
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
  <?php }}