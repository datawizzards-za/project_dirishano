<?php

  session_start();

  include_once('../../include/config.php');
  
  $pageID = "";
  $index = "../";
  $logout_path = "../login/logout.php";             
  
  $username = $username_session = $userType = $CompName = $userAvatar = "";
  
  $activeSession = FALSE;
  
  if(isset($_SESSION['username'])){
      $activeSession = TRUE;
      
      $username = strtolower($_SESSION['username']);
      
      $pageID = md5($username); 
      
      $username_session = $username;
            
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      $userAvatar = getAvatar($connection, $username_session);
  }
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
          <?php require '../commons/aside.php'; ?>          
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  
                  <?php require 'people.php' ?>
              
              </div><! --/row -->
          </section>
          
      </section>
      <!--main content end-->      
      
      
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="search_res" class="modal fade">    
    <div class="modal-dialog animated bounceIn" role="document">
        <div class="modal-content" >
        </div>
    </div>
</div>
      
      <!--footer start-->
          <?php require '../commons/footer.php'; ?>
      <!--footer end-->
  </section>
      
      <!-- Import JS -->
      <?php require '../commons/js.php'; ?>
      
      <script>
      
        $(function(){
              $('select.styled').customSelect();
          });
                
      </script>
      
  </body>
</html>