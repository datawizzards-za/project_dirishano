<?php
include_once('include/config.php');

include_once('include/_config.php'); 
require_once('drive/include/language/'.$LANG.'.php');
require_once('drive/include/ls_func.php');

$pageID = "";
$logout_path = "logout.php";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:404/pg.error.php");      
  }  else {
      
      $username_session = $_SESSION['username'];
      
      $username = $supEmail = getUser($connection, $pageID);
      
      if(!$username_session){
          header_remove();
          header("location:404/pg.error.php");                
      }else{

        //Get User Type
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      
      $encrypted_dir = md5($supEmail);
      $path = "files/portfolio/$encrypted_dir/files";
      $userAvatar = getAvatar($connection, $username_session);
      $emptyDIR = TRUE;
      
      $compDetails = $connection->query("SELECT * FROM supplier WHERE EMAILADDRESS='$supEmail'");
      
      $pageID = md5($username_session);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JMB Online | Catalogue </title>    
    
    <!-- Custom styles for this template --> 
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
      
    <link href="assets/css/main.min.css" rel="stylesheet">    
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>    
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
                      <?php if($userType == 'client'){?> <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID ?>"> <?php }
                               elseif($userType == 'service'){ ?> <a class="logout" href="profile_sp.php?page_id=<?php echo $pageID ?>"><?php }
                               else{?> <a class="logout" href="profile_sup.php?page_id=<?php echo $pageID ?>"> <?php } ?>                                 
                     
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
                    
                    <?php
                    
                    if($userType == 'client' ){
                          echo "<li class='mt'><a href='bids.php?page_id=$pageID'><i class='fa fa-tasks'></i><span>BIDS</span></a></li>";
                        }elseif($userType == 'service' ){
                          echo "<li class='mt'><a href='jobs.php?page_id=$pageID'><i class='fa fa-book'></i><span>JOBS</span></a></li>";
                          echo "<li class='mt'><a href='portfolio.php?page_id=$pageID'><i class='fa fa-archive'></i><span>PORTFOLIO</span></a></li>";
                        }else{
                            echo "<li class='mt '><a class='active' href='catalogue.php?page_id=$pageID'><i class='fa fa-archive'></i><span class='text-uppercase'>My Catalogue</span></a></li>";
                        }
                        ?>

                    <li class="mt">
                        <a href="newslet.php?page_id=<?php echo $pageID?>">
                            <i class="fa fa-envelope-o"></i>
                            <span>NEWSLETTERS</span>
                        </a>
                    </li>

                    <li class="mt">
                      <?php
                          if($userType == 'client'){ echo "<a href='profile_cl.php?page_id=$pageID'>";}
                            elseif($userType == 'service'){ echo "<a href='profile_sp.php?page_id=$pageID'>";}
                            elseif($userType == 'supplier'){ echo "<a href='profile_sup.php?page_id=$pageID'>";}
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
                            <h1 class="text-center text-uppercase">JMB Online: Portfolio</h1>
                        </div>
                        <div class="row">
                            <!-- dashboard header -->
                            <div class="col-md-12">
                                <div class="dash-head clearfix mt15 mb20 ">
                                <!-- tab style -->
                                <div class="clearfix">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-comp" data-toggle="tab"><span class="ion">&nbsp;&nbsp;</span>Company Info</a></li>
                                        <li><a href="#tab-catlg" data-toggle="tab"><span class="ion">&nbsp;&nbsp;</span>Catalogue List</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-comp">
                                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                <div class="panel-body animated fadeInDown">
                                                    <table class="table">
                                                        
                                                   <?php
                                                   foreach($compDetails as $item){?>
                                                    <tbody>
                                                        <tr>
                                                            <td>Company Name</td><td><?php echo $item['COMPANYNAME'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Online Catalogue</td>
                                                            <td><a href="http://<?php echo $item['WEBADDRESS'];?>" target="_blank"><?php echo $item['WEBADDRESS'];?></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email Address</td><td><?php echo $item['EMAILADDRESS'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Physical Address</td><td><?php echo $item['PADDRESS'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contact Number</td><td><?php echo $item['TELLNUMBER'];?></td>
                                                        </tr>
                                                    </tbody>
                                                  <?php }?>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-catlg">
                                            <div class="panel panel-lined panel-hovered fadeInDown animated">
                                                
                                                <!-- Begin File Listing -->
                                                
                                                <div class="panel-body">
                                                    <div id="contenedor"></div>
                                                    <script type="text/javascript" language="javascript"> msgboxProcesando(true); </script>
                                                    <form action="" method="get" name="formFiles">
                                                        <table width="<?php echo $pTableWidth ?>" border="0" align="<?php echo $pTableAlign?>" class="table" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                            <tr class="features">
                                                                <td bgcolor="#428bca"><div align="center"><strong><?php echo $nFile?></strong></div></td>
                                                                <td bgcolor="#428bca"><div align="center"><strong><?php echo $nFileType?></strong></div></td>
                                                                <td bgcolor="#428bca"><div align="center"><strong><?php echo $nSize?></strong></div></td>
                                                            </tr>
                                                            
                                                            <?php 
                                                            if (isset($_GET['cam'])){$ncam = "". $_GET['cam'];} else{$ncam = "";}
                                                            $path = $path . $ncam; 
                                                            $dir = @opendir($path);
                                                            if ($dir) {
                                                                while (($file = readdir($dir)) !== false) {                                               
                                                                    if ($file != "." && $file != "..") {
                                                                        $emptyDIR = FALSE;                     
                                                                        ?>

                                                                    <tr bgcolor="#FFFFFF">
                                                                        <td height="19">
                                                                            <p>
                                                                                &nbsp;
                                                                                <?php if (!is_dir($path."/".$file)) { ?>
                                                                                <a class="fadeLink" onClick="msgboxProcesando(true);" href="<?php echo $path."/".$file?>"><img src="images/doc.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle">
                                                                                <?php
                                                                                          $subName = substr($file, -10);
                                                                                          $fName = "...".$subName;
                                                                                          echo " ".$file;
                                                                                ?></a>
                                                                                <?php }else{?>
                                                                                <a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php if (isset($_GET['cam'])){echo $_GET['cam'];}else{echo "";} echo "/".$file?>">
                                                                                <img src="images/closed.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " " .$file?></a>
                                                                           <?php }?>
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <div align="center"> <p><?php if(tipo_archivo($file,$path)==1) echo $nTDir; else echo $nTFile;?></p></div>
                                                                        </td>
                                                                        <td><div align="center"><p><?php echo tamanio_archivo($file,$path);?></p></div></td>
                                                                    </tr>
                                                                    <?php } } closedir($dir); }?>
                                                                </table>
                                                            </form>
                                                        </div>
                                                
                                                <!-- End File List -->
                                    
                                    <?php 
                                    if($emptyDIR){?>
                                            <h4 class="panel-title text-center text-uppercase">
                                                NOTHING TO SHOW HERE 
                                            </h4>
                                                <br /> <br />
                                    <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
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
                              <img class="img-circle" src="<?php echo $supAvatar ?>" width="35px" height="35px" align="">
                          </div>
                          <div class="details">
                              <p>
                                  <a href="catalogue.php?page_id=<?php echo md5($supEmail)?>"><?php echo $supName ?><br />
                                  <muted><?php echo $supCatalogue ?></muted>
                                  </a>
                              </p>
                          </div>
                      </div>
                      
                      <?php } ?>

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
    <script src="assets/js/fancybox/jquery.fancybox.js"></script>    
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
  
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