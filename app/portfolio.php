<?php
include_once('include/config.php');

session_start();

 $pageID = "";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:404/");      
  }  else {
      
      $username_session = getUser($connection, $pageID);
      
      $username = $username_session;
      
      if(!$username_session){
          header_remove();
          header("location:404/");                
      }else{

        //Get User Type
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      
      $encrypted_dir = md5($username_session);
      $directory = "files/portfolio/$encrypted_dir/files";
      $userAvatar = getAvatar($connection, $username_session);
      
      $portfolioUser = $username_session;
      
      $compDetails = $connection->query("SELECT * FROM serviceprovider where EMAILADDRESS='$portfolioUser'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JMB Online | Portfolio</title>
     <?php include 'head.php'; ?>
<link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    
</head>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
            <?php include 'header.php'; ?>
        </header>
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
                        <a class="logout" href="profile_sp.php?page_id=<?php echo $pageID?>">                           
                          <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
                      </a>
                  </p>
              	  <h5 class="centered"><?php echo $CompName ?></h5>

                    <li class="mt">
                        <a href="index.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-dashboard"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>

                    <li class="mt">
                        <a href="jobs.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-book"></i>
                            <span>JOBS</span>
                        </a>
                    </li>

                    <li class="mt">
                        <a class="active" href="portfolio.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-archive"></i>
                            <span>PORTFOLIO</span>
                        </a>
                    </li>

                    <li class="mt">
                        <a href="newslet.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-envelope-o"></i>
                            <span>NEWSLETTERS</span>
                        </a>
                    </li>

                    <li class="mt">
                        <a href="profile_sp.php?page_id=<?php echo $pageID?>">
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
                    <div class="col-lg-9 main-chart">
                        <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                            <h1 class="text-center text-uppercase">JMB Online: Portfolio</h1>
                        </div>
                        <div class="row">
                            <!-- dashboard header -->
                            <div class="col-md-12">
                                    <div class="row mt">
                                        <br />
                                        <?php
                                        
                                    $open = opendir($directory);
                                    $emptyDIR = TRUE;
                                    
                                    while(($files = readdir($open)) != FALSE)
                                    {
                                        if($files !="." && $files !=".." && $files!="Thumbs.db")
                                        {
                                            $emptyDIR = FALSE;
                                            $ext = pathinfo($files, PATHINFO_EXTENSION);
                                            
                                            if ($ext == "pdf" )
                                            {
                                                echo "<a href='$directory/$files' style='margin-right:8px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                                <img src='images/pdf.png' height='80' >
                                                                <br /><b><center>$files</center></b>
                                                        </div>
                                                        </a>";
                                            }
                                            elseif($ext =="jpg" || $ext =="png" || $ext =="gif" || $ext =="svg" || $ext == "tiff" || $ext == "rif" || $ext == "bmp")
                                            {
                                                echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 desc'>
                                                    <div class='project-wrapper'>
                                                        <div class='project'>
                                                            <div class='photo-wrapper'>
                                                            <div class='photo'>
                                                            <a class='fancybox' href='$directory/$files'>
                                                                <img class='img-responsive' src='$directory/$files' alt=''></a>
                                                            </div>
                                                            <div class='overlay'></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div><!-- col-lg-4 -->";

                                            }
                                            elseif($ext =="ppt" || $ext == "pptx" )
                                            {
                                                echo "<a href='$directory/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                                <div style='float:left;margin-right:8px;'>
                                                                        <img src='images/ppt.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";

                                            }
                                            elseif($ext =="doc" || $ext == "docx" || $ext =="odt")
                                            {
                                                echo "<a href='$directory/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                        <img src='images/word.png' height='80'>
                                                            <br /><b><center>$files</center></b>
                                                        </div>
                                                        </a>";
                                            }
                                            elseif($ext =="xls" || $ext =="xlsx" || $ext == "csv")
                                            {
                                                echo "<a href='files/newsletters/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                                <img src='images/excel.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";

                                            }else{
                                                echo "<a href='$directory/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;>
                                                                <img src='images/word.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";
                                            }
                                        }
                                        else{ $emptyDIR = TRUE;}
                                    }
                                    
                                    if($emptyDIR){?>
                                        
                                        <div class="clearfix">
                                            <!-- Basic Table -->
                                            <div class="col-md-12">
                                                <div class="panel-group">                                                        
                                                    <div class="panel-primary panel-hovered panel-stacked mb20">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title text-center text-uppercase animated fadeInDownBig">
                                                                NOTHING TO SHOW HERE
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <?php
                                    }?>
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
                      <h3>SUPPLIERS</h3>                      
                      <?php 
                      
                      $suppliers = $connection->query("SELECT * FROM supplier");
                      
                      foreach ($suppliers as $supplier){
                          $supName = $supplier['COMPANYNAME'];
                          $supCatalogue = $supplier['WEBADDRESS'];
                          $supEmail = $supplier['EMAILADDRESS'];
                          $supAvatar = getAvatar($connection, $supEmail);?>

                      <!-- Third Member -->
                      <div class="desc">
                          <div class="thumb">
                              <a href="catalogue.php?page_id=<?php echo md5($supEmail)?>">
                                  <img class="img-circle" src="<?php echo $supAvatar ?>" width="35px" height="35px" align="">
                              </a>
                          </div>
                          <div class="details">
                              <p>
                                  <a href="catalogue.php?page_id=<?php echo md5($supEmail)?>">
                                      <?php echo $supName ?><br />
                                  <muted><?php echo $supCatalogue ?></muted>
                                  </a>
                              </p>
                          </div>
                      </div>                      
                      <?php } ?>
                  </div><!-- /col-lg-3 -->
                </div><! --/row -->
            </section>
        </section>

        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2015
                <a href="index.php#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/fancybox/jquery.fancybox.js"></script>    
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
  
  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
  
  <script>
      //custom select box

      $(function(){
          $("select.styled").customSelect();
      });

  </script>

</body>
</html>

  <?php }}