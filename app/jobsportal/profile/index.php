<?php
session_start();
include_once('../../include/config.php');

$username = $_SESSION['username'];
$index = "../../jobsportal";
$logout_path = "../login/logout.php";        

if (!$username){          
    header_remove();
    header("location:$logout_path");
}else{      
    
//Get User Type
$userType = getUserType($connection, $username);

//Set Company Name
$CompName = getCompName($connection, $username, $userType);

$userAvatar = getDIRAvatar($connection, $username);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include '../commons/head.php'; ?>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
        <?php include '../../header.php'; ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      
        
      <aside>
          <?php include '../views/aside.php'; ?>
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
                          <h1 class="text-center">
                              JMB Jobs Portal: Profile
                          </h1>
                      </div>                  
                    <div class="row">
                    <!-- dashboard header -->
                    <div class="col-md-12">
                    <div class="dash-head clearfix mt15 mb20 ">
                        <?php 
                            if( $userType == "JOBSEEKER" ){
                                include '../views/jobseeker_pro.php';
                            }else{
                                include '../views/employer_pro.php';                                
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
                      <?php require '../commons/jobslist.php'; ?>
                  </div><!-- /col-lg-3 -->
              </div>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <?php require '../../footer.php'; ?>
      <!--footer end-->
  </section>
      
     
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="job_full" class="modal fade">    
    <div class="modal-dialog animated bounceIn" role="document">
        <div class="modal-content" >
        </div>
    </div>
</div>
      
      <!-- Import JS -->
      <?php include '../commons/js.php'; ?>
      
    <script type="text/javascript">
        
      $("#uploadFilec").click(
              function(e){
                  $("#uploadFile").click();
                  $('#previewing').attr('src', e.target.result);
              });
        $("#previewing").click(function(e){

          $("#file").click();
      });
    
    //MODAL
    $(document).ready(function() {
        $('#job_full').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    } );
    </script>
    
    
  </body>
</html>
  <?php }