<?php

  session_start();

  include_once('../../include/config.php');
  
  $pageID = "";
  $index = "../../jobsportal";
  $logout_path = "../login/logout.php";             
  
  $username = strtolower($_SESSION['username']);
  
  if($username){
      
      $pageID = md5($username); 
      
      $username_session = $username;
            
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      $userAvatar = getDIRAvatar($connection, $username_session);
      ?>
<!DOCTYPE html> 
<html lang="en">
    <head>
        <?php require '../commons/head.php'; ?>
    </head>    
  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <?php require '../commons/header.php'; ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <?php include '../views/aside.php'; ?>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  
                  <?php 
                    if ($userType == "JOBSEEKER"){
                        include '../views/mycv.php';
                    }else{
                        include '../views/employer.php';
                    }
                  ?>
                
                  <div class="col-lg-3 ds">
                    <!-- USERS ONLINE SECTION -->
                    <?php require '../commons/jobslist.php'; ?>                      
                  </div><!-- /col-lg-3 -->
              
              </div><! --/row -->
          </section>
      </section>
      <!--main content end-->      

      <!--footer start-->
      <?php require '../../footer.php'; ?>
      <!--footer end-->
  </section>
      
      <!-- Import JS -->
      <?php require '../commons/js_1.php'; ?>
      
      <!--script for this page-->
    <script type="text/javascript" src="../../assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">        
    $(document).ready(function() {
          $("#table_vivio").DataTable();
          $("#search_id").append($("#table_vivio_filter"));
          $("#table_vivio_length").remove();
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
      <?php }else {
          header("location:$logout_path");      
      }