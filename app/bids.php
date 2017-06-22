<?php

session_start();
include_once('include/config.php');

$pageID = "";

  $logout_path = "logout.php";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:404/pg.error.php");      
  }  else {
      
      $username = getUser($connection, $pageID);
      
      if(!$username){          
          header_remove();
          header("location:404/pg.error.php");          
      }else{          
          //Get User Type
          $userType = getUserType($connection, $username);
          
          //Set Company Name
          $CompName = getCompName($connection, $username, $userType);

$userAvatar = getAvatar($connection, $username);

$counts_bids = 0;
$counts_latest = 0;

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
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
      
    <link href="assets/css/main.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>


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
                
                <p class="centered">
                      <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID?>">                           
                          <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
                      </a>
                  </p>
              	  <h5 class="centered"><?php echo $CompName ?></h5>
              	  	
                <li class="mt">
                    <a href="index.php?page_id=<?php echo $pageID; ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>

                <li class="mt">
                    <a class="active" href="bids.php?page_id=<?php echo $pageID?>">
                        <i class="fa fa-tasks"></i>
                        <span>BIDS</span>
                    </a>
                </li>

                <li class="mt">
                    <a href="newslet.php?page_id=<?php echo $pageID?>">
                        <i class="fa fa-envelope-o"></i>
                        <span>NEWSLETTERS</span>
                    </a>
                </li>

                <li class="mt">
                    <a href="profile_cl.php?page_id=<?php echo $pageID?>">
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
                    <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                        <h1 class="text-center">JMB Online: Bids</h1>
                    </div>                  
                <div class="row">
                        <!-- dashboard header -->
                        <div class="col-md-12">
                            <div class="dash-head clearfix mt15 mb20 ">
                                <!-- tab style -->
                                <div class="clearfix">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-bids" data-toggle="tab"><span class="ion ion-person">&nbsp;&nbsp;</span>Latest Bids</a></li>
                                        <li><a href="#tab-history" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>Job History</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active fadeInDown animated" id="tab-bids">
                                            <div class="clearfix">
                                                <!-- Basic Table -->
                                                <div class="col-md-12">

                                                 <?php 

                                                        $myJobs = $connection->query("SELECT * FROM jobs WHERE EMAILADDRESS='$username' ORDER BY JOB_ID DESC");

                                                         if($myJobs-> num_rows == 0){ ?>

                                                         <div class="panel-group">                                                        
                                                        <div class="panel-primary panel-hovered panel-stacked mb20">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title text-center text-uppercase">
                                                                  NOTHING TO SHOW HERE
                                                                </h4>
                                                                </div>
                                                            </div>
                                                        </div>


                                                         <?php

                                                        }else{
                                                            
                                                            $bidSta = 0;
                                                            foreach ($myJobs as $job) {
                                                            # code...
                                                                $job_id = $job['JOB_ID'];
                                                                $jobTitle = $job['JOB_TITLE'];
                                                                $thisBids = $connection->query("SELECT * FROM bids WHERE JOB_ID=$job_id AND BID_STATUS=1");                                                                             
                                                                
                                                                if ($thisBids-> num_rows == 0){
                                                                    $bidSta = 1;
                                                        ?>
                                                   
                                                    <div class="panel-group" id="accordionDemo">                                                        
                                                        <div class="panel-primary panel-hovered panel-stacked mb20">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a href="#collapse<?php echo $job_id; ?>" class="accordion-toggle centered" data-toggle="collapse" data-parent="#accordionDemo">
                                                                        <?php echo $jobTitle; ?>
                                                                    </a>
                                                                </h4>
                                                            </div>
							<div class="panel-collapse collapse" id="collapse<?php echo $job_id; ?>">
								<div class="panel-body">
                                                                    <?php 
                                                                    $bidders = $connection->query("SELECT * FROM bids
                                                                                                    INNER JOIN serviceprovider on bids.BIDDER = serviceprovider.EMAILADDRESS                                                                                                    
                                                                                                    WHERE JOB_ID = '$job_id' ORDER BY bids.BID_ID DESC");
                                                                    if($bidders-> num_rows ==0 ){
                                                                        echo '<table class="table"><thead><tr><td class="text-center text-uppercase"><strong>Nothing to show here.</strong></td></tr></thead></table>';
                                                                        }else{?>
                                                                    
                                                                    <table class="table" id="table_vivio<?php echo $counts_bids; ?>">
                                                                        <thead>
                                                                            <tr><td class="text-center"><strong>BIDDER</strong></td>
                                                                                <td class="text-center"><strong>PRICE</strong></td>
                                                                                <td class="text-center" id="search<?php echo $counts_bids; ?>_id"></td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody><?php
                                                                        $counts_bids = $counts_bids + 1;
                                                                        foreach ($bidders as $bidder) {
                                                                            $bidderEmail = $bidder['BIDDER'];
                                                                            $bidderName = $bidder['TRADEAS'];
                                                                            $bidID = $bidder['BID_ID'];
                                                                            $jobID = $bidder['JOB_ID'];
                                                                            $bidStatus = $bidder['BID_STATUS'];
                                                                            
                                                                            if ($bidStatus == '2'){?>
                                                                                <tr class="alert alert-danger text-center text-uppercase">
                                                                            <?php }else{?><tr class="alert alert-warning text-center text-uppercase"><?php } ?>
                                                                 
                                                                                <td class="col-md-6">
                                                                <div>
                                                                    <a href=""><strong><?php echo $bidderName;?></strong></a>
                                                            </div></td>
                                                            <td><div>
                                                                    <strong><?php echo "R".$bidder['BID_AMOUNT']; ?></strong>
                                                                </div></td>
                                                            <td class="col-md-2"><div class="list-group centered" style="">
                                                                    <a href="bid_full.php?page_id=<?php echo md5($bidID);?>" class="list-group-item active">VIEW</a>
                                                                </div></td>           
                                                    </tr>
                                                         <?php } } ?>
                                                                        </tbody>
                                                                    </table>
								</div>
							</div>
						</div>

                                                    </div>
                                                            <?php }else{
                                                                // Do Nothing
                                                                 } } 
                                                                 
                                                                 if ($bidSta == 0){ ?>
                                                                     <div class="panel-group">                                                        
                                                        <div class="panel-primary panel-hovered panel-stacked mb20">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title text-center text-uppercase">
                                                                  You're Done Here. Check your history.
                                                                </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                 <?php }
                                                                 
                                                            } ?>
                                                </div>
                                                <!-- #end todo-list -->
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane fadeInDown animated" id="tab-history">
                                            <div class="clearfix">
                                                <!-- Basic Table -->
                                                <div class="col-md-12">

                                                 <?php
                                                 
                                                 $myJobs = $connection->query("SELECT * FROM jobs
                                                                                INNER JOIN bids on jobs.JOB_ID = bids.JOB_ID 
                                                                                WHERE jobs.EMAILADDRESS='$username' AND bids.BID_STATUS=1
                                                                                ORDER BY bids.BID_ID DESC");

                                                         if($myJobs-> num_rows == 0){ ?>

                                                         <div class="panel-group">                                                        
                                                        <div class="panel-primary panel-hovered panel-stacked mb20">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title text-center text-uppercase">
                                                                  NOTHING TO SHOW HERE
                                                                </h4>
                                                                </div>
                                                            </div>
                                                        </div>


                                                         <?php

                                                        }else{
                                                            
                                                            foreach ($myJobs as $job) {
                                                                $job_id = $job['JOB_ID'];?>
                                                   
                                                    <div class="panel-group" id="accordionDemo">                                                        
                                                        <div class="panel-primary panel-hovered panel-stacked mb20">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title text-uppercase">
                                                                    <a href="#collapse<?php echo $job_id;?>" class="accordion-toggle centered" data-toggle="collapse" data-parent="#accordionDemo">
                                                                        <?php echo $job['JOB_TITLE']; ?>
                                                                    </a>
                                                                </h4>
                                                            </div>
							<div class="panel-collapse collapse" id="collapse<?php echo $job_id;?>">
								<div class="panel-body">
                                        
                                            <table class="table" id="table_vivioj<?php echo $counts_latest; ?>">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                            <strong>BIDDER</strong>
                                                    </th>
                                                    <th class="text-center">
                                                            <strong>PRICE</strong>
                                                    </th>
                                                    <th class="text-center" id="searchj<?php echo $counts_latest; ?>_id">
                                                    </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $bidders = $connection->query("SELECT * FROM bids
                                                                                INNER JOIN serviceprovider on bids.BIDDER=serviceprovider.EMAILADDRESS
                                                                                WHERE JOB_ID = '$job_id'");
                                                $counts_latest = $counts_latest + 1;
                                                foreach ($bidders as $bidder) {
                                                    $bidderEmail = $bidder['BIDDER'];
                                                    $bidderName  = $bidder['TRADEAS'];
                                                    $bidID = $bidder['BID_ID'];
                                                    $jobID = $bidder['JOB_ID'];
                                                    $bidStatus = $bidder['BID_STATUS'];
                                                    
                                                    if($bidStatus == '2'){
                                                        ?>
                                                        <tr class="alert alert-danger text-center text-uppercase">
                                                       <?php }else{ ?>
                                                        <tr class="alert alert-success text-center text-uppercase">
                                                       <?php }?>
                                                            <td class="col-md-6">
                                                                <div>
                                                                    <a href="">
                                                                    <strong><?php echo $bidderName;?></strong>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div><strong><?php echo "R".$bidder['BID_AMOUNT']; ?></strong>
                                                                </div>
                                                            </td>
                                                            <td class="col-md-2">
                                                                <div class="list-group centered text-uppercase">
                                                                    <a href="bid_full.php?page_id=<?php echo md5($bidID) ?> " class="list-group-item active">VIEW</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }?>
                                            </tbody>
                                            </table>
                                                                </div>
                                                        </div>
						</div>

                                                    </div>
                                                            <?php  } } ?>
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
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type='text/javascript' src="assets/js/table_search.js"></script>
</body>
</html>
  <?php }}