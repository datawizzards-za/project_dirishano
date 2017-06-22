<?php
include_once('../include/config.php');

include_once('../include/_config.php'); 
require_once('../drive/include/language/'.$LANG.'.php');
require_once('../drive/include/ls_func.php');

$username = $username_session = $_SESSION['username'];
$supEmail = getUser($connection, $_GET['x']);

$pageID = md5($username_session);
$logout_path = "../logout.php";
$index = "../";

if(!isset($username_session)){
    header_remove();
    header("location:../logout.php");                
}else{
    
    $userType = getUserType($connection, $username_session);
    //Set Company Name
    $CompName = getCompName($connection, $username_session, $userType);
      
    $encrypted_dir = md5($supEmail);
    $path = "../files/portfolio/$encrypted_dir/files";
    $userAvatar = getDIRAvatar($connection, $username_session);
    $emptyDIR = TRUE;
    
    $compDetails = $connection->query("SELECT * FROM supplier WHERE EMAILADDRESS='$supEmail'");

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

<title>JMB Online | Catalogue </title> 
    <?php require_once('../commons/css.php') ?>
</head>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
         <?php require_once('../commons/header.php'); ?>
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
                        <?php require_once('../commons/suplist.php') ?>
                    </div>

                  </div><! --/row -->
            </section>
        </section>

        <!--main content end-->
        <!--footer start-->
            <?php require_once('../footer.php') ?>
        <!--footer end-->
    </section>

    <?php require_once('../commons/js.php'); ?>

  
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