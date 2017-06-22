<?php

session_start();
include_once('../include/config.php');

if(isset($_SESSION['username'])){
    $username = $username_session = $_SESSION['username'];
    
    if (!($pageID = stripcslashes($_GET['page_id'])))
        {
            header("location:login/logout.php");            
        }else { 
            $job_num = getJobAd($connection, $pageID);
        }
            
    $userType = getUserType($connection, $username_session);

    //Set Company Name
    $CompName = getCompName($connection, $username_session, $userType);
    $userAvatar = getAvatar($connection, $username_session);
    
    $adTitle = $adDesc = $adLocation = $adContactPerson = $adCellNo = $adEmail = $adPostDate = $adClosinDate = $adPoster = "";
    
    $theAds = $connection->query("SELECT * from jobadverts WHERE ID='$job_num'");
    
    foreach ($theAds as $jobAd){
        $adTitle = $jobAd["TITLE"];
        $adDesc = $jobAd["DESCRIPTION"];
        $adLocation = $jobAd["LOCATION"];
        $adContactPerson = $jobAd["CONTACT"];
        $adCellNo = $jobAd["CELL"];
        $adEmail = $jobAd["EMAIL"];
        $adClosinDate = $jobAd["CLOSINGDATE"];
    }
    
    
    
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
        <?php include '../header.php'; ?>
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
                <div class="col-lg-9 main-chart animated fadeInDown">
                    <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                        <h1 class="text-center text-uppercase"><?php echo $adTitle ?></h1>
                    </div>                  
                <div class="row hvr-grow">
                        <div class="panel-body panel-hovered mb20 table-responsive basic-table">
                            <div class="col-md-12 alert alert-info text-uppercase text-center">
                                <strong><?php echo $adDesc  ?></strong>
                            </div>
                            <div class="col-md-12 alert alert-info">
                                <div class="col-md-6 text-uppercase text-center">
                                    Where? <strong> <?php echo $adLocation ?> </strong>
                                </div>
                                <div class="col-md-6 text-uppercase text-center">
                                    Closing? <strong> <?php echo $adClosinDate ?> </strong>
                                </div>
                            </div>
                            <div class="col-lg-12 alert alert-info text-uppercase text-center">
                                <div class="col-md-4">
                                    Contact: <strong> <?php echo $adContactPerson ?> </strong>
                                </div>
                                <div class="col-md-4">
                                    On: <strong> <?php echo $adCellNo ?> </strong>
                                </div>
                                <div class="col-md-4">
                                    Email: <strong> <?php echo $adEmail ?> </strong>
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
                    <?php include 'views/jobslist.php'; ?>       
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

<!-- Import JS -->
<?php include 'js.php'; ?>

</body>
</html>
<?php }else{
    header("location:login/logout.php");   
}