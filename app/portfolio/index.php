<?php
require_once('../include/config.php');
session_start();

$username = $username_session = $_SESSION['username'];
$pageID = md5($username_session);

$logout_path = "../logout.php";
$index = "../";

if(!isset($username_session)){
    header_remove();
    header("location:../404/");                
}else{

        //Get User Type
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      
      $encrypted_dir = md5($username_session);
      $directory = "../files/portfolio/$encrypted_dir/files";
      $userAvatar = getDIRAvatar($connection, $username_session);
      
      $portfolioUser = $username_session;
      
      $compDetails = $connection->query("SELECT * FROM serviceprovider where EMAILADDRESS='$portfolioUser'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

<title>JMB Online | Portfolio </title>
    <?php require_once('../commons/css.php') ?>
<link href="../assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
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
                    <div class="col-lg-9 main-chart fadeInDown animated">
                        <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                            <h1 class="text-center text-uppercase">JMB Online: Portfolio</h1>
                        </div>
                        <div class="row">
                            <!-- dashboard header -->
                            <div class="col-md-12">
                                    <div class="row mt">
                                        <br />
                                        <?php
                                        
                                    $open = opendir($directory);
                                    $emptyDIR = TRUE;
                                    
                                    while(($files = readdir($open)) != FALSE)
                                    {
                                        if($files !="." && $files !=".." && $files!="Thumbs.db" && $files!=".DS_Store" )
                                            {
                                            $emptyDIR = FALSE;
                                            $ext = pathinfo($files, PATHINFO_EXTENSION);
                                                
                                            if ($ext == "pdf" )
                                            {
                                                echo "<a href='$directory/$files' style='margin-right:8px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                                <img src='../images/pdf.png' height='80' >
                                                                <br /><b><center>$files</center></b>
                                                        </div>
                                                        </a>";
                                            }
                                            elseif($ext =="jpg" || $ext =="png" || $ext =="gif" || $ext =="svg" || $ext == "tiff" || $ext == "rif" || $ext == "bmp")
                                            {
                                                echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 desc'>
                                                    <div class='project-wrapper'>
                                                        <div class='project'>
                                                            <div class='photo-wrapper'>
                                                            <div class='photo'>
                                                            <a class='fancybox' href='$directory/$files'>
                                                                <img class='img-responsive' src='$directory/$files' alt=''></a>
                                                            </div>
                                                            <div class='overlay'></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div><!-- col-lg-4 -->";

                                            }
                                            elseif($ext =="ppt" || $ext == "pptx" )
                                            {
                                                echo "<a href='$directory/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                                <div style='float:left;margin-right:8px;'>
                                                                        <img src='../images/ppt.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";

                                            }
                                            elseif($ext =="doc" || $ext == "docx" || $ext =="odt")
                                            {
                                                echo "<a href='$directory/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                        <img src='../images/word.png' height='80'>
                                                            <br /><b><center>$files</center></b>
                                                        </div>
                                                        </a>";
                                            }
                                            elseif($ext =="xls" || $ext =="xlsx" || $ext == "csv")
                                            {
                                                echo "<a href='files/newsletters/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;margin-right:8px;'>
                                                                <img src='../images/excel.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";

                                            }elseif($ext =="php"){ }
                                            else{
                                                echo "<a href='$directory/$files' style='margin-right:8px;margin-bottom:4px;float:left;border:1px solid #3f51b5;padding:4px 8px;color:#000;'>
                                                        <div style='float:left;>
                                                                <img src='../images/word.png' height='80'>
                                                                        <br /><b><center>$files</center></b>
                                                                </div>
                                                        </a>";
                                            }
                                        }
                                        else{ $emptyDIR = TRUE;}
                                    }
                                    
                                    if($emptyDIR){?>
                                        
                                        <div class="clearfix">
                                            <!-- Basic Table -->
                                            <div class="col-md-12">
                                                <div class="panel-group">                                                        
                                                    <div class="panel-primary panel-hovered panel-stacked mb20">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title text-center text-uppercase animated fadeInDownBig">
                                                                NOTHING TO SHOW HERE
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <?php
                                    }?>
                                    </div>
                            </div>
                        </div> <!-- #end row -->
                        <!-- #end row -->
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->
                    <!-- **********************************************************************************************************************************************************
                    RIGHT SIDEBAR CONTENT
                    *********************************************************************************************************************************************************** -->
                    <div class="col-lg-3 ds">
                        <?php require_once '../commons/suplist.php'; ?>
                    </div><!-- /col-lg-3 -->
                </div><! --/row -->
            </section>
        </section>

        <!--main content end-->
        <!--footer start-->
            <?php require_once('../footer.php') ?>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php require_once '../commons/js.php'; ?>   
  
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

  <?php }