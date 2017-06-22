<?php
session_start();
include_once('../include/config.php');

$username = $_SESSION['username'];
$index = "../jobsportal";
$logout_path = "login/logout.php";        

if (!$username){          
    header_remove();
    header("location:$logout_path");
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

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
        <?php include '../header.php'; ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      
        
      <aside>
          <?php include 'aside.php'; ?>
      </aside>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-9 main-chart animated fadeInDown"> 
                      <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                          <h1 class="text-center">JMB Jobs Portal: Profile</h1>
                      </div>                  
                    <div class="row">
                    <!-- dashboard header -->
                    <div class="col-md-12">
                    <div class="dash-head clearfix mt15 mb20 ">
                        <?php 
                            if( $userType == "JOBSEEKER" ){
                                include 'views/jobseeker_pro.php';
                            }else{
                                include 'views/employer_pro.php';                                
                            }?>
                    </div>
                    </div>
                    </div> <!-- #end row -->          
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                      <?php include 'views/jobslist.php'; ?>
                  </div><!-- /col-lg-3 -->
              </div>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2015
              <a href="profile.php" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
      
      <!-- Import JS -->
      <?php include 'js.php'; ?>
      
      <script src="../assets/js/script.js"></script>

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
  <?php }