<?php

  session_start();

  include_once('../../include/config.php');
  
  $pageID = "";
  $index = "../home";
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
        <?php include 'head.php'; ?>
    </head>    
  <body>

  <section id="container" >
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
                  
                  <?php include 'people.php' ?>
              
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
      <footer class="site-footer">
          <div class="text-center">
              <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2016
          </div>
      </footer>
      <!--footer end-->
  </section>
      
      <!-- Import JS -->
      <?php include 'js.php'; ?>
      
      
      <script>
        $(document).ready(
                function search()
        {
            alert("WE HERE");
        }
      </script>
      
      <script>
      
        $(function(){
              $('select.styled').customSelect();
          });
                
      </script>
      
  </body>
</html>