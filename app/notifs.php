<?php

include 'session.php';
$username_session = $_SESSION['username'];
include_once('include/config.php');

//Get User Type
$userTypeResults = $connection->query("SELECT TYPE from clients WHERE EMAILADDRESS='$username_session' UNION SELECT TYPE from supplier WHERE EMAILADDRESS='$username_session' UNION SELECT TYPE from serviceprovider WHERE EMAILADDRESS='$username_session'");
while($row=$userTypeResults->fetch_assoc()){ $userType = $row['TYPE']; }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Fast Bid | Notifications</title>

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

    <script src="assets/js/chart-master/Chart.js"></script>

    <!--external css-->
    <link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <script src="assets/js/jquery.js"></script>

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
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>FASTBID</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu"><!-- settings start --><li class="dropdown"><ul class="dropdown-menu extended tasks-bar"></li><li class="external"><a href="#">See All Tasks</a></li>
                </ul>
                </li>
                <!-- settings end -->
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-theme">5</span>
                    </a>
                    <ul class="dropdown-menu extended inbox">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">You have 5 new messages</p>
                        </li>
                        <li>
                            <a href="index.php#">
                                <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hi mate, how is everything?
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="index.php#">See all messages</a>
                        </li>
                    </ul>
                </li>
                <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <aside>
                      <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">              	  	
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>DASHBOARD</span>
                      </a>
                  </li>

                  <?php
                  
                  if($userType == 'client' ){
                      echo "<li class='mt'><a href='bids.php'><i class='fa fa-tasks'></i><span>BIDS</span></a></li>";
                  }elseif($userType == 'service' ){
                      echo "<li class='mt'><a href='jobs.php'><i class='fa fa-book'></i><span>JOBS</span></a></li>";
                      echo "<li class='mt'><a href='portfolio.php'><i class='fa fa-archive'></i><span>PORTFOLIO</span></a></li>";
                  }                        
                  ?>
                  
                  <li class="mt">
                      <a href="newslet.php">
                          <i class="fa fa-envelope-o"></i>
                          <span>NEWSLETTERS</span>
                      </a>
                  </li>

                  <li class="mt">
                      <?php
                      if($userType == 'client'){ echo "<a href='profile_cl.php'>";}
                      elseif($userType == 'service'){ echo "<a href='profile_sp.php'>";}
                      elseif($userType == 'supplier'){ echo "<a href='profile_sup.php'>";}
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
                            <h1 class="text-center text-uppercase">Fast Bid: Notifications</h1>
                        </div>
                        <div class="row">
                            <!-- dashboard header -->
                            <div class="col-md-12">
                                    
                            </div>
                        </div> <!-- #end row -->
                        <!-- #end row -->
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->
                    <!-- **********************************************************************************************************************************************************
                    RIGHT SIDEBAR CONTENT
                    *********************************************************************************************************************************************************** -->
                    <div class="col-lg-3 ds">
                        <!-- USERS ONLINE SECTION -->
                        <h3>LATEST BIDS</h3>
                        <!-- Third Member -->
                        <div class="desc">
                            <div class="thumb">
                                <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                            </div>
                            <div class="details">
                                <p>
                                    <a href="#">Client</a><br />
                                    <muted>Location</muted>
                                </p>
                            </div>
                        </div>

                        <div class="desc">
                            <div class="thumb">
                                <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                            </div>
                            <div class="details">
                                <p>
                                    <a href="#">Client</a><br />
                                    <muted>Location</muted>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <div class="thumb">
                                <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                            </div>
                            <div class="details">
                                <p>
                                    <a href="#">Client</a><br />
                                    <muted>Location</muted>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <div class="thumb">
                                <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                            </div>
                            <div class="details">
                                <p>
                                    <a href="#">Client</a><br />
                                    <muted>Location</muted>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <div class="thumb">
                                <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                            </div>
                            <div class="details">
                                <p>
                                    <a href="#">Client</a><br />
                                    <muted>Location</muted>
                                </p>
                            </div>
                        </div>
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