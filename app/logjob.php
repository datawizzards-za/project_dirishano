<?php

session_start();
include_once('include/config.php');

$pageID = "";

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
    <link href="assets/css/animate.min.css" rel="stylesheet">

    <link href="assets/css/main.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">    
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
                    <a href="index.php?page_id=<?php echo $pageID?>">
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
                        <i class="fa fa-book"></i>
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
                        <h1 class="text-center">JMB Online: Log Service Request</h1>
                    </div>   
                    
                    <div class="row">
                        <!-- dashboard header -->
                        <div class="col-md-12"> 
                            <div class="clearfix">                                        
                                <form id="logJobForm" method="POST" >     
                                <div class="panel-body panel-lined panel-hovered mb20 table-responsive basic-table">
                                    
                                    <div id="loading" class="text-center" hidden>
                                        <img src="images/preloader.gif" height="64" width="64" alt="">
                                        <br />
                                        <br />
                                    </div>
                                    
                                    <div id="error_div" class="col-lg-12 centered" hidden>
                                        <div id="error_msg" class="alert alert-danger text-center text-bold text-desc fadeInDownBig animated "></div>
                                    </div>
                                    
                                    <div id="success_div" class='col-lg-12 centered' hidden>
                                        <div id="success_msg" class="alert alert-success text-center text-bold text-desc fadeInUpBig animated"></div>
                                    </div>
                                    
                                    <div class="form-group form-group-lg has-success">
                                        <input class="form-control centered focus" type="text" name="jobTitle" placeholder="Job Title" required>
                                    </div>

                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="has-success ">
                                                        <input class="form-control centered" type="text" name="jobLocation" placeholder="Location: City, Province" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="has-success ">
                                                        <input class="form-control centered" type="text" name="jobDuration" placeholder="Duration: e.g., 6 Weeks/Months" required>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr></tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group has-success">
                                            <textarea type="text" class="form-control centered" name="jobDesc" placeholder="Type a Detailed Job Description Here" style="" required>
                                            </textarea>
                                        </div>

                                        <div class="form-container" style="float: right;">
                                            <button name="create_job" type="submit" class="btn btn-primary btn-block text-uppercase btn-lg">
                                                Log Request
                                            </button>
                                        </div>
                                </div>
                                </form>
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
      
<!-- Import JS -->
<?php include 'js.php'; ?>

</body>
</html>
  <?php }}