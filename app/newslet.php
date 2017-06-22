<?php

    include_once('include/config.php');    
    session_start();
    $pageID = "";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:404/pg.error.php");      
  }  else {
      
      $username = $username_session = getUser($connection, $pageID);
      
      if(!$username_session){          
          header_remove();
          header("location:404/pg.error.php");              
      }else{
      
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      
      $userAvatar = getAvatar($connection, $username_session);
      
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JMB Online | Newsletters</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    
    <link href="assets/css/main.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>
    
    

    <script src="assets/js/chart-master/Chart.js"></script>

    <!--external css-->
    <link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                      <?php if($userType == 'client'){?> <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID?>"> <?php }
                               elseif($userType == 'service'){ ?> <a class="logout" href="profile_sp.php?page_id=<?php echo $pageID?>"><?php }
                               else{?> <a class="logout" href="profile_sup.php?page_id=<?php echo $pageID?>"> <?php } ?>                                 
                     
                          <img src="<?php echo $userAvatar;?>" class="img-circle" width="60">
                      </a>
                  </p>
              	  <h5 class="centered"><?php echo $CompName ?></h5>  

                    <li class="mt">
                        <a href="index.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-dashboard"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>

                    <?php
                        
                        if($userType == 'client' ){
                            echo "<li class='mt'><a href='bids.php?page_id=$pageID'><i class='fa fa-tasks'></i><span>BIDS</span></a></li>";
                        }elseif($userType == 'service' ){
                            echo "<li class='mt'><a href='jobs.php?page_id=$pageID'><i class='fa fa-book'></i><span>JOBS</span></a></li>";
                            echo "<li class='mt'><a href='portfolio.php?page_id=$pageID'><i class='fa fa-archive'></i><span>PORTFOLIO</span></a></li>";
                        }else{ ?>
                            <li class="mt">
                        <a href="catalogue.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-archive"></i>
                            <span>MY CATALOGUE</span>
                        </a>
                    </li>
                       <?php }?>

                    <li class="mt">
                        <a class="active" href="newslet.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-envelope-o"></i>
                            <span>NEWSLETTERS</span>
                        </a>
                    </li>
                    
                    <li class="mt">
                        <?php
                            if($userType == 'client' ){echo "<a href='profile_cl.php?page_id=$pageID'>";}elseif($userType == 'service' ){echo "<a href='profile_sp.php?page_id=$pageID'>";}
                            elseif($userType == 'supplier' ){echo "<a href='profile_sup.php?page_id=$pageID'>";}
                        ?>
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
                            <h1 class="text-center text-uppercase">JMB Online: Newsletters</h1>
                        </div>
                        <div class="row">
                            <!-- dashboard header -->
                            <div class="col-md-12">
                                
                                <div class="row mt">
                                <br />
                                    <?php

                                    $directory = "files/newsletters/";
                                    $open = opendir($directory);
                                    while(($files = readdir($open)) != FALSE)
                                    {

                                        if($files !="." && $files !=".." && $files!="Thumbs.db")
                                        {
                                            $ext = pathinfo($files, PATHINFO_EXTENSION);

                                            if ($ext == "pdf" )
                                            {
                                                echo "<a href='files/newsletters/$files' style='margin-right:8px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                                <img src='images/pdf.png' height='80' >
                                                                <br /><b><center>$files</center></b>
                                                        </div>
                                                        </a>";
                                            }
                                            elseif($ext =="jpg" || $ext =="png" || $ext =="gif" || $ext =="svg" || $ext == "tiff" || $ext == "rif" || $ext == "bmp")
                                            {
                                                echo "<div class='col-lg-3 col-md-4 col-sm-4 col-xs-12 desc'>
                                                    <div class='project-wrapper'>
                                                        <div class='project'>
                                                            <div class='photo-wrapper'>
                                                            <div class='photo'>
                                                            <a class='fancybox' href='$directory$files'>
                                                                <img class='img-responsive' src='$directory$files' alt=''></a>
                                                            </div>
                                                            <div class='overlay'></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div><!-- col-lg-4 -->";
                                            }
                                            elseif($ext =="ppt" || $ext == "pptx" )
                                            {
                                                echo "<a href='files/newsletters/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                                <div style='float:left;margin-right:8px;'>
                                                                        <img src='images/ppt.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";

                                            }
                                            elseif($ext =="doc" || $ext == "docx" || $ext =="odt")
                                            {
                                                echo "<a href='files/newsletters/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
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

                                            }
                                            else
                                            {
                                                echo "<a href='files/newsletters/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;>
                                                                <img src='images/word.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";
                                            }
                                        }


                                    }

                                    ?>

			</div><!-- /row -->
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
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <script src="assets/js/fancybox/jquery.fancybox.js"></script>    
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>
    <script src="assets/js/zabuto_calendar.js"></script>

    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>


    <!--script for this page-->
  
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