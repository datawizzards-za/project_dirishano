<?php  
  session_start();
  include_once('include/config.php');
  
  $username = $username_session = $_SESSION['username'];
  $pageID = md5($username_session);

  $logout_path = "logout.php";
  $index = "../app/";

  if (!isset($username_session))
  {
      header("location:404/");      
  }else{
            
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
      <?php require 'header.php'; ?>
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
                        <h1 class="text-center">
                            <?php    if($userType == 'client'){ ?> 
                                Hi 
                            <?php echo $CompName?>, <br /> Welcome to JMB Online  <?php }else{?>
                                Welcome to JMB Online <br /> 
                            <?php echo $CompName; }?>
                          </h1>
                      </div>
                      <hr /><hr />
                      
                      <div class="row mtbox">
                      <br />
                      <?php 
                      if($userType == 'client')
                      { ?>
                          <div class='col-md-4 hvr-grow'>
                                  <div class='box1'><span class='li_news'></span><h3><a href='bids.php?page_id=<?php echo $pageID?>'>View Bids</a></h3>
                                  </div>
                          </div>
                          
                          <div class='col-md-4 hvr-grow'>
                              <div class='box1'><span class='li_data'></span><h3><a href='logjob.php?page_id=<?php echo $pageID?>'>Log a Job</a></h3>
                              </div>
                          </div>                    
                                       
                            <div class="col-md-4 hvr-grow">
                              <div class="box1">
                                  <span class="li_user"></span>
                                  <h3>
                                      <a href='profile_cl.php?page_id=<?php echo $pageID?>'> Profile</a>
                                  </h3>
                              </div>
                          </div>  
                            
                            <?php
                      }elseif($userType == 'service'){ ?>
                          <a href="./jobs">
                          <div class='col-md-4 hvr-grow'>
                            <div class='box1'><span class='li_news'></span><h3>View Jobs</h3>
                            </div></div>
                          </a>
                          
                          <a href='sp/'>
                            <div class="col-md-4 hvr-grow">
                              <div class="box1">
                                  <span class="li_user"></span>
                                  <h3>
                                      Profile
                                  </h3>
                              </div>
                          </div>
                          </a>
                          <a href="drive/">
                            <div class='col-md-4 hvr-grow'>
                            <div class='box1'><span class='li_settings'></span><h3>Upload</h3></div></div>
                          </a>
                            
                            <?php }else{ ?>
                          <div class="col-md-2 hvr-grow">
                            <br />
                          </div>
                          <div class="col-md-4 hvr-grow">
                              <div class="box1">
                                  <span class="li_user"></span>
                                  <h3>
                                      <a href='profile_sup.php?page_id=<?php echo $pageID ?>'>Profile</a>
                                  </h3>
                              </div>
                          </div>
                          <div class="col-md-1">
                              <br />
                          </div>
                            <div class="col-md-4 hvr-grow">
                              <div class="box1">
                                  <span class="li_settings"> </span>
                                  <h3>
                                      <a href='drive/'>Catalogue</a>
                                  </h3>
                              </div>
                          </div>
                          <div class="col-md-2 hvr-grow">
                            <br />
                          </div>
                            
                            <div class="col-md-2"></div>                          
                     <?php } ?>

                                          	
                  	</div><!-- /row mt -->	                      
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                    
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                      <?php require_once 'suplist.php'; ?>                      
                  </div><!-- /col-lg-3 -->
              
                  </div><! --/row -->
          </section>
      </section>
      <!--main content end-->      

      <!--footer start-->
      <?php require_once('footer.php') ?>
      <!--footer end-->
  </section>
      
      <!-- Import JS  -->
      <?php include 'js.php'; ?>   
  </body>
</html>
  <?php }