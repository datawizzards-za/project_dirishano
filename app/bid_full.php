<?php
    session_start();
    include_once('include/config.php');
    
    $bid_num = $pageID = "";
  $logout_path = "logout.php";
    
    if (!($pageID = stripcslashes($_GET['page_id'])))
        {
            header("location:404/pg.error.php");            
        }else { 
            $bid_num = getBidID($connection, $pageID);
        }
        
    if($bid_num){
        
        $username = $_SESSION['username'];
        
        if($username){
            
            $userType = getUserType($connection, $username);
            
            $pageID = md5(strtolower($username));
        
        //Set Company Name
        $CompName = getCompName($connection, $username, $userType);    
        
    $bidTitle = "";
    $bidDesc = "";
    $bidLocation = "";
    $bidCompletion = "";
    $bidPrice = "";
    $detailedPrice = "";
    $jobBidder = "";
    $jobNum = '';
    
    $theBids = $connection->query("SELECT bids.BID_AMOUNT, bids.BID_LOCATION, bids.PROJ_LEN, bids.DETAILED_PRICE, 
                                          jobs.JOB_TITLE, jobs.JOB_DESC, jobs.JOB_ID, serviceprovider.TRADEAS, clients.REGNAME FROM bids 
                                    INNER JOIN jobs ON bids.JOB_ID=jobs.JOB_ID 
                                    INNER JOIN serviceprovider ON bids.BIDDER=serviceprovider.EMAILADDRESS
                                    INNER JOIN clients ON jobs.EMAILADDRESS=clients.EMAILADDRESS
                                   WHERE bids.BID_ID='$bid_num'");
    
    foreach ($theBids as $bid)
    {
        $bidTitle = $bid['JOB_TITLE'];
        $bidDesc = $bid['JOB_DESC'];
        $bidLocation = $bid['BID_LOCATION'];
        $bidCompletion = $bid['PROJ_LEN'];
        $bidPrice = $bid['BID_AMOUNT'];
        $detailedPrice = $bid['DETAILED_PRICE'];
        $jobBidder = $bid['TRADEAS'];
        $jobClient = $bid['REGNAME'];
        $jobNum = $bid['JOB_ID'];
    }
    
    $spDetails = $connection->query("SELECT bids.BIDDER, bids.JOB_ID, serviceprovider.TRADEAS, jobs.EMAILADDRESS, jobs.JOB_ID, jobs.JOB_TITLE, clients.EMAILADDRESS, clients.REGNAME FROM bids
                                        INNER JOIN jobs ON bids.JOB_ID=jobs.JOB_ID
                                        INNER JOIN clients ON jobs.EMAILADDRESS=clients.EMAILADDRESS
                                        INNER JOIN serviceprovider ON bids.BIDDER=serviceprovider.EMAILADDRESS
                                    WHERE BID_ID=$bid_num");
    
    if(isset($_POST['btnApprove'])){
        $connection->query("UPDATE `bids` SET `BID_STATUS`=2 WHERE `JOB_ID`=$jobNum");
        $updateQuery = $connection->query("UPDATE `bids` SET `BID_STATUS`=1 WHERE `JOB_ID`=$jobNum AND `BID_ID`=$bid_num");
        if($updateQuery){
            $bidStatus = 1;
            notifySP($spDetails, $bidStatus, $username, $connection);
        }
    }

    if(isset($_POST['btnReject'])){
        $updateQuery = $connection->query("UPDATE `bids` SET `BID_STATUS`=2 WHERE `JOB_ID`=$jobNum AND`BID_ID`=$bid_num");        
        if($updateQuery){
            $bidStatus = 0;
            notifySP($spDetails, $bidStatus, $username, $connection);
        }
    }
    
    $userAvatar = getAvatar($connection, $username);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    
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
                <p class="centered">
                      <?php if($userType == 'client'){?> <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID ?>"> <?php }
                               elseif($userType == 'service'){ ?> <a class="logout" href="profile_sp.php?page_id=<?php echo $pageID ?>"><?php }
                               else{?> <a class="logout" href="profile_sup.php?page_id=<?php echo $pageID ?>"> <?php } ?>                                                    
                          <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
                      </a>
                  </p>
              	  <h5 class="centered"><?php echo $CompName ?></h5>
              	  	
                <li class="mt hvr-grow">
                    <a href="index.php?page_id=<?php echo $pageID ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>

                <?php
                        
                        if($userType == 'client' ){
                            echo "<li class='mt hvr-grow'><a class='active' href='bids.php?page_id=$pageID'><i class='fa fa-tasks'></i><span>BIDS</span></a></li>";
                        }elseif($userType == 'service' ){
                            echo "<li class='mt hvr-grow'><a class='active' href='jobs.php?page_id=$pageID'><i class='fa fa-book'></i><span>JOBS</span></a></li>";
                            echo "<li class='mt hvr-grow'><a href='portfolio.php?page_id=$pageID'><i class='fa fa-archive'></i><span>PORTFOLIO</span></a></li>";
                        }                        
                    ?>

                <li class="mt hvr-grow">
                    <a href="newslet.php?page_id=<?php echo $pageID ?>">
                        <i class="fa fa-envelope-o"></i>
                        <span>NEWSLETTERS</span>
                    </a>
                </li>

                <li class="mt hvr-grow">
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
                <div class="col-lg-9 main-chart animated fadeInDown">
                    <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                        <h1 class="text-center text-uppercase"><?php echo $bidTitle ?></h1>
                    </div>                  
                <div class="row">
                    <!-- dashboard header -->
                    <div class="col-md-12">
                        <div class="dash-head clearfix mt15 mb20 ">
                            <!-- tab style -->
                            <div class="clearfix">
                                    <div class="panel-body panel-hovered mb20 table-responsive basic-table">
                                        <div class="col-md-12">
                                            <div class="alert alert-info text-uppercase text-center">
                                                <strong><?php echo $bidDesc ?></strong>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table" style="background-color: #bce8f1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase">Price</th>
                                                        <th class="text-center text-uppercase">Job Completion</th>
                                                        <th class="text-center text-uppercase">Location</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><div class="alert alert-info text-uppercase text-center"><strong>R<?php echo $bidPrice;?></strong></div></td>
                                                        <td><div class="alert alert-info text-uppercase text-center"><strong><?php echo $bidCompletion;?></strong></div></td>
                                                        <td><div class="alert alert-info text-uppercase text-center"><strong><?php echo $bidLocation;?></strong></div></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="alert alert-info text-uppercase text-center">
                                                <strong><?php echo $detailedPrice ?></strong>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-8">
                                                <div class="alert alert-info text-uppercase">
                                                    <?php if($userType == 'client'){?>
                                                    <strong>BIDDER: <?php echo $jobBidder;?></strong>
                                                    <?php }else{ ?>
                                                    <strong>CLIENT: <?php echo $jobClient;?></strong>
                                                   <?php } ?>
                                                </div>                                                
                                            </div>
                                           
                                            <div class="col-md-4">

                                            <?php 
                                                $bidStatus = ""; 
                                                $bidsStatus = $connection->query("SELECT BID_STATUS FROM bids WHERE JOB_ID=$jobNum AND BID_ID=$bid_num");
                                                foreach($bidsStatus as $status) { $bidStatus = $status['BID_STATUS']; }
                                                if($userType == 'client'){
                                                //echo "Job: $jobNum, BID: $bid_num";
                                                
                                                if ($bidStatus == '0'){
                                            ?>
                                                <form method="POST">
                                            <div class="col-lg-6">
                                                    <div class="form-container">
                                                        <button name="btnReject" type="submit" class="btn btn-primary text-uppercase">
                                                            Reject
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-container">
                                                        <button name="btnApprove" type="submit" class="btn btn-primary text-uppercase">
                                                            Approve
                                                        </button>
                                                    </div>
                                                </div></form>

                                                        <?php }
                                                        elseif($bidStatus == '1'){ ?>
                                                        <div class="col-lg-12">
                                                    <div class="alert alert-success text-uppercase text-center">
                                                        <strong>BID Accepted</strong>
                                                </div></div>    
                                                           <?php   } else { ?>

                                                           <div class="col-lg-12">
                                                    <div class="alert alert-danger text-uppercase text-center">
                                                        <strong>BID Rejected</strong>
                                                </div></div>    

                                                    <?php } } elseif($userType == 'service'){

                                                        if ($bidStatus == '0'){
                                                        ?>                                                    
                                                            <div class="col-lg-12">
                                                    <div class="alert alert-warning text-uppercase text-center">
                                                        <strong>Pending</strong>
                                                </div></div>                                                

                                                        <?php } elseif($bidStatus == '1'){?>                                                    
                                                            <div class="col-lg-12">
                                                            <div class="alert alert-success text-uppercase text-center">
                                                            <strong>BID Approved</strong>
                                                            </div></div><?php
                                                            } else { ?>

                                                           <div class="col-lg-12">
                                                    <div class="alert alert-danger text-uppercase text-center">
                                                        <strong>BID Rejected</strong>
                                                </div></div>    

                                                    <?php } }?>
                                                
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
                    <?php include 'suplist.php'; ?>
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

<!-- Vendors -->
<script src="assets/js/plugins/select2.min.js"></script>

<script src="scripts/plugins/vendors.js"></script>
<script src="scripts/plugins/screenfull.js"></script>
<script src="scripts/plugins/perfect-scrollbar.min.js"></script>
<script src="scripts/plugins/waves.min.js"></script>
<script src="scripts/plugins/select2.min.js"></script>
<script src="scripts/plugins/bootstrap-colorpicker.min.js"></script>
<script src="scripts/plugins/bootstrap-slider.min.js"></script>
<script src="scripts/plugins/summernote.min.js"></script>
<script src="scripts/plugins/bootstrap-datepicker.min.js"></script>
<script src="scripts/plugins/app.js"></script>
<script src="scripts/plugins/form-elements.init.js"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>
    
<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>


</body>
</html>
        <?php }else{
            header_remove();
            header("location:404/pg.error.php");}
        
        }else{
            header_remove();
            header("location:404/pg.error.php");
        }
    