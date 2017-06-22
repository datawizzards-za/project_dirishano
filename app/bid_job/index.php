<?php
session_start();
require_once('../include/config.php');

$jobNum = stripcslashes($_GET['x']);
$logout_path = "../logout.php";
$index = "../";
    
    $job_num = getJobID($connection, $jobNum);
    
    if($job_num){
    
    $pageID = md5(strtolower($_SESSION['username']));
    
    $username = getUser($connection, $pageID) ;
        
        if($username){
            
            $userType = getUserType($connection, $username);
            
            //Set Company Name
            $CompName = getCompName($connection, $username, $userType);
      
            $userAvatar = getDIRAvatar($connection, $username);
            
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
<link rel="shortcut icon" type="image/png" href="../../img/icon.png"/>

<title>JMB Online | Bid Job </title> 
<?php require_once('../commons/css.php') ?>
</head>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
        <?php require '../commons/header.php'; ?>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
      <aside>
        <?php require '../commons/aside.php'; ?>
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
                                        <th class="col-lg-4 text-uppercase text-center">
                                            What?: <?php echo $details['JOB_TITLE']; ?>
                                        </th>
                                        <th class="col-md-4 text-uppercase text-center">
                                            Where?: <?php echo $details['JOB_LOCATION']; ?></th>
                                        <th class="col-lg-4 text-uppercase text-center">
                                            For Who?: <?php echo $details['REGNAME']; ?></th>
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
                                                    <img src="../images/preloader.gif" height="64" width="64" alt="">
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
                        <?php require '../commons/suplist.php'; ?>      
                    </div>      
                  </div><!-- /col-lg-3 -->
            </section>
        </section>
        <!--main content end-->
      
        <!--footer start-->
        <?php require_once('../footer.php') ?>
        <!--footer end-->
    </section>



<!-- js placed at the end of the document so the pages load faster -->

<?php require_once('../commons/js.php') ?>

</body>
</html>
<?php }else{
    header_remove();
    header("location:$logout_path");
    }
}else{
    header_remove();
    header("location:$logout_path");
    }