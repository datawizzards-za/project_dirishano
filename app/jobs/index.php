<?php
require_once('../include/config.php');

session_start();

$logout_path = "../logout.php";
$index = "../";

$username = $username_session = $_SESSION['username'];
$pageID = md5($username);

if(!$username){
    header_remove();
    header("location:$logout_path");
}else{
      
      //Get User Type
      $userType = getUserType($connection, $username);
      
      //Set Company Name
      $CompName = getCompName($connection, $username, $userType);
      $userAvatar = getDIRAvatar($connection, $username);

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

    <title>JMB Online | Jobs </title>    
        <?php require_once('../commons/css.php') ?>
  </head>

  <body>

  <section id="container" >
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
                  <div class="col-lg-9 main-chart fadeInDown animated">
                      <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                          <h1 class="text-center">JMB Online: Jobs</h1>
                      </div>           
                  	<div class="row">
                          <!-- dashboard header -->
                          <div class="col-md-12">
                              <div class="dash-head clearfix mt15 mb20 ">
                                  <!-- tab style -->
                                  <div class="clearfix">
                                      <ul class="nav nav-tabs">
                                          <li class="active">
                                              <a href="#tab-jobs" data-toggle="tab"><span class="ion ion-person">&nbsp;&nbsp;</span>Latest Service Requests
                                              </a>
                                          </li>
                                          <li><a href="#tab-request" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>My Recent Bids</a>
                                          </li>
                                      </ul>
                                      <div class="tab-content">
                                          <div class="tab-pane active" id="tab-jobs">
                                              <div class="clearfix">
                                                  <!-- Basic Table -->
                                                  <div class="col-md-12">

                                                <div class="panel-body panel-hovered fadeInDown animated">                                                            
                                                    <form method="POST" action="">                                                    

                                                        <table class="table" id="table_vivio">
                                                            <thead>
                                                            
                                                            <?php 

                                                                //$bidJobs = $connection->query("SELECT * FROM bids WHERE EMAILADDRESS=$username");

                                                                $allJobs = $connection->query("SELECT * FROM jobs ORDER BY TIMEPOSTED DESC");

                                                                if($allJobs-> num_rows == 0 ){?>
                                                                    <tr><td>
                                                                            <h4 class="panel-title text-center text-uppercase">
                                                                                <strong>nothing to show here.</strong>
                                                                            </h4>
                                                                     </td></tr>
                                                                 <?php } else{ 
                                                                     
                                                                     $myBids = $connection->query("SELECT * FROM bids WHERE BIDDER='$username'");
                                                                     
                                                                     if ($allJobs->num_rows == $myBids->num_rows){?>
                                                                    
                                                                        <tr>
                                                                            <td><h4 class="panel-title text-center text-uppercase">
                                                                                    <strong>nothing new to show. <br><br>
                                                                                        <small>Looks like you've managed to bid all available jobs.</small>
                                                                                    </strong>
                                                                                </h4></td>
                                                                        </tr>
                                                                        
                                                                    <?php }else{
                                                                        
                                                                        $availJobs = $connection->query("SELECT * FROM bids WHERE BID_STATUS='1'");
                                                                        //
                                                                        ////$allBids = $connection->query("SELECT JOB_ID FROM jobs");
                                                                        //$allTheBids = $connection->query("SELECT JOB_ID FROM jobs");
                                                                                
                                                                            if($availJobs -> num_rows == $allJobs -> num_rows ){
                                                                                ?>
                                                                    <tr>
                                                                    <td><h4 class="panel-title text-center text-uppercase">
                                                                            <strong>nothing new to show. <br><br>
                                                                                <small>Looks like all available jobs have already been bid successfully.</small>
                                                                            </strong>
                                                                        </h4></td>
                                                                    </tr><?php                                                                               
                                                                                
                                                                            }  else { 
                                                                                
                                                                                //$thisJobs = $connection->query("SELECT * FROM jobs INNER JOIN bids ON jobs.JOB_ID=bids.JOB_ID WHERE bids.BIDDER='$username'");
                                                                                
                                                                                ?>
                                                                    
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <strong>JOB TITLE</strong>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <strong>LOCATION</strong>
                                                                    </td>
                                                                    <td class="text-center" id="search_id">
                                                                                  
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>     

                                                            <?php
                                                            foreach ($allJobs as  $value_jobs) {
                                                                        # code...
                                                                        $jobID = $value_jobs['JOB_ID'];
                                                                        
                                                                        $hereBids = $connection->query("SELECT * FROM bids WHERE JOB_ID = '$jobID' ");
                                                                        
                                                                        $myHereBids = $connection->query("SELECT * FROM bids WHERE JOB_ID = '$jobID' AND BIDDER='$username'");
                                                                        
                                                                        $approvedBid = TRUE;
                                                                        
                                                                        foreach ($hereBids as $hereBid){ if ( $hereBid['BID_STATUS'] == '1' ) { $approvedBid = FALSE;} }
                                                                        
                                                                        if($approvedBid AND $myHereBids -> num_rows == 0){
                                                                            $sessionJob = $value_jobs['JOB_ID'];
                                                                ?>
                                                                                                                           
                                                                <tr class="alert alert-info text-uppercase text-center hvr-grow">
                                                                    <td class="col-md-5">
                                                                        <div>
                                                                            <strong><?php echo $value_jobs['JOB_TITLE'];?></strong>
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-5">
                                                                        <div>
                                                                            <strong><?php echo $value_jobs['JOB_LOCATION'];?></strong>
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <div>
                                                                            <a href="../bid_job/?x=<?php echo md5($sessionJob); ?>" class="list-group-item active">VIEW</a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                
                                                                <?php }else {}
                                                                }}}} ?>
                                                            </tbody>
                                                        </table>
                                                    </form>                                                              
                                                </div>           
</div>                                       
                                                  <!-- #end todo-list -->
                                              </div>
                                          </div>
                                          
                                          <div class="tab-pane" id="tab-request">
                                              <div class="clearfix">
                                                  <!-- Basic Table -->
                                                  <div class="col-md-12">
                                                      <div class="panel panel-lined panel-hovered fadeInDown animated">
                                                          <div class="panel-body">
                                                <form method="POST">                                                    
                                                        <?php 
                                                            $bids = $connection->query("SELECT * FROM bids WHERE BIDDER = '$username'  ORDER BY TIMEPOST DESC");

                                                                if($bids-> num_rows ==0 ){ ?>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center text-uppercase"><strong>Nothing to show here.</strong>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                                 }else{
                                                          ?>
                                                        <table class="table" id="table_vivioj">
                                                            <thead>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <strong>JOB</strong>
                                                                </td>
                                                                <td class="text-center">
                                                                    <strong>CLIENT</strong>
                                                                </td>
                                                                <td class="text-center" id="searchj_id">
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                                foreach ($bids as  $bid) {
                                                                $theJobs = $bid['JOB_ID'];
                                                                $bidNum = $bid['BID_ID'];
                                                                $jobs = $connection->query("SELECT * FROM jobs WHERE JOB_ID = '$theJobs'");
                                                                
                                                                $bidStatus = $connection->query("SELECT BID_STATUS FROM bids WHERE JOB_ID=$theJobs AND BID_ID=$bidNum");

                                                                foreach ($jobs as $job){
                                                                $email = $job['EMAILADDRESS'];
                                                                $client = $connection->query("SELECT REGNAME FROM clients WHERE EMAILADDRESS = '$email'");
                                                                $clientName = "";
                                                                foreach ($client as $cl){ $clientName = $cl['REGNAME']; }
                                                                
                                                                foreach ($bidStatus as $status)
                                                                {                                                                    
                                                                    if($status['BID_STATUS'] == '0')
                                                                    {?>
                                                            <tr class="alert alert-warning text-center text-uppercase hvr-grow">
                                                                <?php }elseif($status['BID_STATUS'] == '1'){?>
                                                                <tr class="alert alert-info text-center text-uppercase hvr-grow">
                                                                    <?php }else{?>
                                                                <tr class="alert alert-danger text-center text-uppercase hvr-grow">
                                                                    <?php } ?>
                                                                
                                                                <td class="col-md-8">
                                                                    <div>
                                                                        <strong><?php echo $job['JOB_TITLE'];?></strong>
                                                                    </div>
                                                                </td>
                                                                <td class="col-md-4">
                                                                    <div>
                                                                        <a href=""><strong>
                                                                            <?php echo $clientName?>
                                                                        </strong></a>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="list-group centered">
                                                                        <a href="../bid_full/?page_id=<?php echo md5($bidNum) ?>" class="list-group-item active">VIEW</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                                <?php }} }}  ?>
                                                        </tbody>
                                                    </table>
                                                              </form>
                                                          </div>
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
                <?php require '../commons/suplist.php'; ?>                      
            </div><!-- /col-lg-3 -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <?php require_once('../footer.php')  ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
        <?php require_once('../commons/js.php')  ?>
    
    <!--script for this page-->
    <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    /* table tag 1*/
            $(document).ready(function() {
          $("#table_vivio").DataTable();
      } );
            $(document).ready(function(){
              $("#search_id").append($("#table_vivio_filter"));
              //$("label").fisrt().contents().remove();
              $("input").attr('placeholder','Search');
            });

            $(document).ready(function(){
              $("#table_vivio_length").remove();
            });
          /* table tag 2*/
            $(document).ready(function() {
          $("#table_vivioj").DataTable();
            } );
            $(document).ready(function(){
              $("#searchj_id").append($("#table_vivioj_filter"));
              //$("label").fisrt().contents().remove();
              $("input").attr('placeholder','Search');
            });

            $(document).ready(function(){
              $("#table_vivioj_length").remove();
            });
    </script>
    
  </body>
</html>
  <?php }