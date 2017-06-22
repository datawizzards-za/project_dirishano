<?php 

 require_once '../session.php'; 
require_once('include/config.php');
require_once('include/language/'.$LANG.'.php');
require_once('include/ls_func.php');

$username = $username_session = $_SESSION['username'];
require_once('../include/config.php');

$pageID = $encrypted_drive = md5($username_session);

$userType = getUserType($connection, $username_session);

$CompName = getCompName($connection, $username_session, $userType);

$userAvatar = getDIRAvatar($connection, $username_session);

$index = "../";
$logout_path = "../logout.php";

$path = "../files/portfolio/$encrypted_drive/files/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("head.php"); ?>
</head>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
            <?php include '../commons/header.php'; ?>
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
                        <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                            <h1 class="text-center text-uppercase">JMB Online: Portfolio Administration</h1>
                        </div>
                        <div class="row">
                            <div class="panel panel-hovered mb20 table-responsive basic-table text-center">
                                <div class="clearfix">
                                    <div class="panel panel-default mb20 panel-hovered analytics">
                                        <form action="fileup.php" method="post" enctype="multipart/form-data" name="form1">
                                            <div class="col-lg-4">
                                                <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                    <div class="panel-body">
                                                        <div class="col-lg-12">
                                                            <br />
                                                            <span class="style11"></span>
                                                            <input name="userfile" type="file">
                                                            <?php if(isset($_GET['cam'])) {?>
                                                            <input name="carpeta" type="hidden" value="<?php echo $_GET['cam'] ?>">
                                                            <?php }?>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <br />
                                                            <input type="submit" value="Upload" onClick="msgboxProcesando(true);" class="btn-group btn-primary wave-effects" style="padding:4px 6px;width:80%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                            <div class="col-lg-8">
                                                <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                        <div class="panel-body">
                                                            <div id="contenedor"></div>
                                                            <script type="text/javascript" language="javascript"> msgboxProcesando(true); </script>
                                                            <form action="" method="get" name="formFiles">
                                                                <table width="<?php echo $pTableWidth ?>" border="0" align="<?php echo $pTableAlign?>" class="table" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                                    <tr bgcolor="#3e4fb1" class="features">
                                                                        <td bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nFile?></strong></div></td>
                                                                        <td bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nSize?></strong></div></td>
                                                                        <td bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nFileType?></strong></div></td>
                                                                        <td bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nAction?></strong></div></td>
                                                                    </tr>
                                                                     <?php if (isset($_GET['cam'])){$ncam = "". $_GET['cam'];} else{$ncam = "";}?>
                                                              

                                                                    <?php $path = $path . $ncam; 
                                                                    if ($dir = @opendir($path)) { 
                                                                        while (($file = readdir($dir)) !== false) { 
                                                                            if ($file != "." && $file != ".." && $file != ".DS_Store" && $file != "index.php") 
                                                                                { ?>

                                                                    <tr bgcolor="#FFFFFF">
                                                                        <td height="19">
                                                                            <p>
                                                                                &nbsp;
                                                                                <?php if (!is_dir($path."/".$file)) { ?>
                                                                                <a class="fadeLink" onClick="msgboxProcesando(true);" href="<?php echo $path."/".$file?>" target="_blank"><img src="images/doc.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle">
                                                                                <?php
                                                                                          $subName = substr($file, -8);
                                                                                          $fName = "...".$subName;
                                                                                          echo " ".$fName;
                                                                                ?></a>
                                                                                <?php }else{?>
                                                                                <a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php if (isset($_GET['cam'])){echo $_GET['cam'];}else{echo "";} echo "/".$file?>">
                                                                                <img src="images/closed.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " " .$file?></a>
                                                                           <?php }?>
                                                                            </p>
                                                                        </td>
                                                                        <td><div align="right"><p><?php echo tamanio_archivo($file,$path);?></p></div></td>
                                                                        <td>
                                                                            <div align="center"> <p><?php if(tipo_archivo($file,$path)==1) echo $nTDir; else echo $nTFile;?></p></div>
                                                                        </td>
                                                                        <td align="right">
                                                                            <p>
                                                                                <?php if (!is_dir($path."/".$file)) { ?>
                                                                                <a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $path."/".$file?>', 2,'<?php echo $ncam?>');" onMouseOver="window.status='';return true;">
                                                                                    <img src="images/delete.gif" title="<?php echo $nDeleteIcon ?>" width="18" height="14" border="0">
                                                                                    <?php }else{?>
                                                                                    <a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $path."/".$file?>', 1,'<?php echo $ncam?>');" onMouseOver="window.status='';return true;">
                                                                                        <img src="images/delete.gif" title="<?php echo $nDeleteFolderIcon ?>" width="18" height="14" border="0">
                                                                                   <?php }?>
                                                                                    </a>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } } closedir($dir); }?>
                                                                </table>
                                                            </form>
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
                      <?php require '../commons/suplist.php'; ?>
                    </div><!-- /col-lg-3 -->
                </div><! --/row -->
            </section>
        </section>

        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; <?php echo date("Y") ?>
            </div>
        </footer>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php require_once('../commons/js.php') ?>


</body>
</html>