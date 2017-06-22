<?php
session_start();
include_once('include/config.php');

$jobNum = "";
  $logout_path = "logout.php";

if (!($jobNum = stripcslashes($_GET['page_id']))){header("location:404/pg.error.php");}

else{
    
    $job_num = getJobID($connection, $jobNum);
    
    if($job_num){
    
    $pageID = md5(strtolower($_SESSION['username']));
    
    $username = getUser($connection, $pageID) ;
        
        if($username){
            
            $userType = getUserType($connection, $username);
            
            //Set Company Name
            $CompName = getCompName($connection, $username, $userType);
      
            $userAvatar = getAvatar($connection, $username);
            
            $servProv = "";
            $projLen = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

<title>JMB Online | Bids</title>

<!--external css-->
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    
<!-- Custom styles for this template -->
<link href="assets/css/animate.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/main.min.css" rel="stylesheet">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

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
                        <a class="active" href="jobs.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-book"></i>
                            <span>JOBS</span>
                        </a>
                    </li>

                    <li class="mt">
                        <a href="portfolio.php?page_id=<?php echo $pageID?>">
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
                    <div class="col-lg-9 main-chart animated fadeInDown">

                        <?php 

                        $job_details = $connection->query("SELECT * FROM jobs 
                                                            INNER JOIN clients ON jobs.EMAILADDRESS=clients.EMAILADDRESS
                                                            WHERE JOB_ID = '$job_num'");
                        foreach ($job_details as $details) {?>
                        <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="col-lg-6 text-uppercase text-center"><?php echo $details['JOB_TITLE']; ?></th>
                                        <th class="col-md-3 text-uppercase text-center"><?php echo $details['JOB_LOCATION']; ?></th>
                                        <th class="col-lg-3 text-uppercase text-center"><?php echo $details['REGNAME']; ?></th>
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
                                        <form id="bidJobForm" method="POST">                                            
                                            
                                            <div class="panel panel-primary panel-hovered mb20 table-responsive basic-table">
                                                
                                                <div id="loading" class="text-center" hidden>
                                                    <br />
                                                    <img src="images/preloader.gif" height="64" width="64" alt="">
                                                    <br />
                                                    <br />
                                                </div>
                                                
                                                <div id="success_div" class='col-lg-12 fadeInUpBig animated centered' hidden>
                                                    <br />
                                                    <div id="success_msg" class="alert alert-success text-center text-bold text-desc"></div>
                                                </div>
                                                                                               
                                                <div id="error_div" class='col-lg-12 centered fadeInDownBig animated' hidden>
                                                    <br />
                                                    <div id="error_msg" class="alert alert-danger text-center text-bold text-desc"></div>
                                                </div>
                                            
                                                <input type="hidden" name="job_ref" value="<?php echo $details['JOB_ID']; ?>">
                                                <input type="hidden" name="job_bidder" value="<?php echo $username; ?>">
                                                <div class="panel-body">
                                                    <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="has-success focus">
                                                                            <input class="form-control centered focus" type="text" name="price" placeholder="Price">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="has-success focus">
                                                                            <input class="form-control centered focus" type="text" name="location" placeholder="Location: Suburb, City" required>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="alert alert-info text-uppercase text-right"><strong>Complete Job in?</strong></div></td>
                                                                    <td>
                                                                    <div class="has-success focus">
                                                                            <input class="form-control centered focus" name="proj_len" type="text" placeholder="Please enter No. of Weeks" required>                                                    
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
<div class="form-group has-success">
    <textarea class="form-control centered" name="priceBreakdown" placeholder="Please Provide a Detailed Price Breakdown" required>
        
    </textarea>
</div>                                                
        <div class="col-md-12">
            <div class="col-md-6">
            </div> 
            <?php 
            
            $alreadyPlacedBid = $connection->query("SELECT * FROM jobs
                                                    INNER JOIN bids on jobs.JOB_ID = bids.JOB_ID
                                                    WHERE jobs.JOB_ID = '$job_num' AND bids.BIDDER = '$username'");
            
            if ($alreadyPlacedBid->num_rows){}else{
            
            ?>
            
            <div class="col-md-6">
                <div class="form-container">
                    <button name="bid_job" type="submit" class="btn btn-primary btn-block text-uppercase btn-lg">
                        PLACE BID
                    </button>
                </div>
            </div>
            
            <?php }?>
        </div>
    </div>
                                            </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- #end row -->
                        <?php } ?>
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
                <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2016
            </div>
        </footer>
        <!--footer end-->
    </section>



<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/submit.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

</body>
</html>
<?php }else{header_remove();header("location:404/pg.error.php");} }else{header_remove();header("location:404/pg.error.php");}}