<?php

  include_once('include/config.php');
  
  $pageID = "";
  $logout_path = "logout.php";
  $index = "./";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:./login/");      
  }  else {
      
      $user = getUser($connection, $pageID);
      
      if (setSession($user)){
      
      $username = $username_session = $user;
            
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
                  <div class="col-lg-9 main-chart fadeInDown animated">
                      <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                        <h1 class="text-center">JMB Online: Notifications</h1>
                    </div>  
                      <hr /><hr />
                      
                      <div class="row mtbox">
                          <?php 
                            $notifs = $connection->query("SELECT * from notifications WHERE TO_USER = '$username'");
                            
                          ?>
                          
                        <! -- DISMISSABLE ALERT -->
                          <div class="showback hvr-shrink">
                              <?php foreach ($notifs as $notif){ ?>
                              <div class="alert alert-info alert-dismissable text-center hvr-grow-shadow">
                                <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong> <?php echo $notif['MESSAGE']; ?></strong>
                              </div>
                              <?php } ?>
                          </div><!-- /showback -->
                                                
                      </div><!-- /row mt -->	                      
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                    
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                          <?php require_once 'suplist.php'; ?>         
                  </div><!-- /col-lg-3 -->
              
                  </div>><! --/row -->
          </section>
      </section>
      <!--main content end-->      

      <!--footer start-->
      <?php require_once('footer.php') ?>
      <!--footer end-->
  </section>
      
      <?php require_once('js.php') ?>
  </body>
</html>
  <?php   
  }else{
      header_remove();
      header("location:login.php"); 
  }
  }