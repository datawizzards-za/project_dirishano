<?php

  session_start();

  include_once('../include/config.php');
  
  $pageID = "";
  $index = "../jobsportal";
  $logout_path = "login/logout.php";             
  
  $username = strtolower($_SESSION['username']);
  
  if($username){
      
      $pageID = md5($username); 
      
      $username_session = $username;
            
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      $userAvatar = getAvatar($connection, $username_session);
      
      
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
                        include 'views/jobseeker.php';
                    }else{
                        include 'views/employer.php';
                    }
                  ?>
              
              </div><! --/row -->
          </section>
      </section>
      <!--main content end-->      

      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2016
          </div>
      </footer>
      <!--footer end-->
  </section>
      
      <!-- Import JS -->
      <?php include 'js.php'; ?>
      
      <!--script for this page-->
    <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    /* table tag 1*/
    $(document).ready(function() {
          $("#table_vivio").DataTable();
          $("#search_id").append($("#table_vivio_filter"));
          $("input").attr('placeholder','Search Keyword');
          $("#table_vivio_length").remove();
      } );
      
      
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
          header("location:login/logout.php");      
      }