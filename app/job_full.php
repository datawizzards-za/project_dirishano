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

<title>Fast Bid | Bids</title>

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

<!-- Plugins -->
<link rel="stylesheet" href="styles/plugins/waves.css">
<link rel="stylesheet" href="styles/plugins/perfect-scrollbar.css">
<link rel="stylesheet" href="styles/plugins/select2.css">
<link rel="stylesheet" href="styles/plugins/bootstrap-colorpicker.css">
<link rel="stylesheet" href="styles/plugins/bootstrap-slider.css">
<link rel="stylesheet" href="styles/plugins/bootstrap-datepicker.css">
<link rel="stylesheet" href="styles/plugins/summernote.css">

<link href="assets/css/main.min.css" rel="stylesheet">

<!-- Plugins -->
<link rel="stylesheet" href="assets/css/plugins/select2.css">

<script src="assets/js/chart-master/Chart.js"></script>
    
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
              	  	
                <li class="mt">
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>

                <li class="mt">
                    <a class="active" href="jobs.php">
                        <i class="fa fa-book"></i>
                        <span>JOBS</span>
                    </a>
                </li>

                <li class="mt">
                    <a href="portfolio.php">
                        <i class="fa fa-archive"></i>
                        <span>PORTFOLIO</span>
                    </a>
                </li>
                
                <li class="mt">
                    <a href="newslet.php">
                        <i class="fa fa-envelope-o"></i>
                        <span>NEWSLETTERS</span>
                    </a>
                </li>

                <li class="mt">
                    <a href="profile_sp.php">
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
            <?php 
                $results = $connection->query(" SELECT * FROM jobs");
                foreach ($results as $value) {
                    
            ?>
            <div class="row">
                <div class="col-lg-9 main-chart">
                    <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th class="col-md-8"><?php echo $value['JOB_TITLE']; ?></th>
                                    <th class="col-lg-4">Centurion, Gauteng</th>
                                </tr>
                            </thead>
                        </table>                               
                    </div>
                <div class="row">
                    <!-- dashboard header -->
                    <div class="col-md-12">
                        <div class="dash-head clearfix mt15 mb20 ">
                            <!-- tab style -->
                            <div class="clearfix">
                                <div class="panel panel-primary panel-hovered mb20 table-responsive basic-table">
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="alert alert-info text-capitalize text-center">
                                                <strong>Detailed Summary</strong>
                                            </div>
                                        </div>
                            
                                        <div class="col-md-12">
                                            <table class="table" style="background-color: #bce8f1">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">Expected Availability</td>
                                                        <td class="text-center">Job Completion</td>
                                                        <td class="text-center">Reference</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><div class="alert alert-info text-capitalize text-center"><strong><?php echo $value['JOB_AVAILABLE']; ?></strong></div></td>
                                                        <td><div class="alert alert-info text-capitalize text-center"><strong><?php echo $value['JOB_MONTH']." months and ".$value['JOB_WEEK']." weeks"; ?></strong></div></td>
                                                        <td><div class="alert alert-info text-capitalize text-center"><strong><?php echo $value['JOB_ID']; ?></strong></div></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="alert alert-info text-capitalize ">
                                                    <?php 

                                                      $clientid = $value['EMAILADDRESS'];
                                                      $clientname = $connection->query("SELECT REGNAME from clients where EMAILADDRESS = '$clientid'");
                                                      
                                                      foreach ($clientname as $item) {
                                                          # code...
                                                      
                                                      ?>
                                                    <strong>CLIENT: <a href=""><?php echo $item['REGNAME']; }?></a> </strong>
                                                </div>                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="list-group centered" style="width: 100%">
                                                    <a href="bid_job.php" class="list-group-item active">BID JOB</a>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- #end row -->

                </div><!-- /col-lg-9 END SECTION MIDDLE -->
    <!-- **********************************************************************************************************************************************************
    RIGHT SIDEBAR CONTENT
    *********************************************************************************************************************************************************** -->                  
                  
                <div class="col-lg-3 ds">

                    <!-- USERS ONLINE SECTION -->
                    <h3>SUPPLIERS</h3>

                    <!-- Third Member -->
                    <div class="desc">
                        <div class="thumb">
                            <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p>
                                <a href="#">Supp 1</a><br />
                                <muted>www.supp1.co.za/catalogue</muted>
                            </p>
                        </div>
                    </div>

                    <div class="desc">
                        <div class="thumb">
                            <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p>
                                <a href="#">Supp 1</a><br />
                                <muted>www.supp1.co.za/catalogue</muted>
                            </p>
                        </div>
                    </div>

                    <div class="desc">
                        <div class="thumb">
                            <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p>
                                <a href="#">Supp 1</a><br />
                                <muted>www.supp1.co.za/catalogue</muted>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="thumb">
                            <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p>
                                <a href="#">Supp 1</a><br />
                                <muted>www.supp1.co.za/catalogue</muted>
                            </p>
                        </div>
                    </div>                      
                </div><!-- /col-lg-3 -->
            </div><! --/row -->
            <?php } ?>
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



<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>

<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>  

</body>
</html>
