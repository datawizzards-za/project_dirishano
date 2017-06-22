<?
/*=========================================================================================
|																						   |
====================================/////////////////=====================================*/?>
<?php require_once('include/config.php'); ?>
<?php require_once('include/language/'.$LANG.'.php'); ?>
<?php require_once('include/ls_func.php'); ?>

<?php
	
	session_start();
	
	if(isset($_SESSION['username']))
	{
		include_once("../connect.php"); 
		
		$username = $_SESSION['username'];
		
		$sql_query = "SELECT * FROM profiles WHERE USERNAME = '$username'";
		
		$query = mysqli_query($db_server, $sql_query);
		
		$row = mysqli_fetch_row($query);
		
		$username = $row[0];
		$lastname = $row[1];
		$name = $row[2];
		$country = $row[3];
		$city = $row[4];
		
		$is_Admin = $row[13];
		
		$picture = $row[12];
		$results = $lastname." ".$name;
		$encrypted_drive = md5($username);

		$directory_images = "../xportal/profiles/$encrypted_drive/images/";
		
		$folder_create = "";
		
		if(isset($_POST['create_folder']))
			$folder_create = htmlentities(stripslashes($_POST['create_folder']));
		
		if($folder_create !="")
		{
			$enctype_ = md5($username);
			$folder_create = "../xportal/profiles/$enctype_/mydrive/$folder_create";
			if(!file_exists($folder_create))
			{
				mkdir($folder_create, 0777, true);
			}
			else
			{
				echo "<script type='text/javascript'>
					alert('Directory Exist try other name');
				</script>";
			}

		}
		
		$loop = "";
		
		if(isset($_POST['delete']))
		{
			$loop = htmlentities(stripslashes($_POST['delete']));
			
			if(!unlink($loop))
			{
				echo "<script type='text/javascript'>
					alert('Could not delete file!');
				</script>";
			}
			else
			{
			
				echo "<script type='text/javascript'>
					alert('Deleted successfully');
				</script>";
			
			}
			
			
		}
?>



<html>
<head>
<link rel="shortcut icon" href="/favicon.ico">
<link href="images/template/<?php echo $Template ?>/styles/stylefss.css" rel="stylesheet" type="text/css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Materia - Admin Template">
	<meta name="keywords" content="materia, webapp, admin, dashboard, template, ui">
	<meta name="author" content="solutionportal">
	<!-- <base href="/"> -->

	<title> xPortal | My Drive</title>
	
	<!-- Icons -->
	<link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">

	<!-- Plugins -->
	<link rel="stylesheet" href="../styles/plugins/c3.css">
	<link rel="stylesheet" href="../styles/plugins/waves.css">
	<link rel="stylesheet" href="../styles/plugins/perfect-scrollbar.css">

	
	<!-- Css/Less Stylesheets -->
	<link rel="stylesheet" href="../styles/bootstrap.min.css">
	<link rel="stylesheet" href="../styles/main.min.css">


	 
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

	<!-- Match Media polyfill for IE9 -->
	<!--[if IE 9]> <script src="scripts/ie/matchMedia.js"></script>  <![endif]--> 

<link rel="shortcut icon" href="/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<script type="text/javascript" language="javascript" src="scripts/script.php"></script>
<script type="text/javascript" language="javascript" src="scripts/MessageBoxes.js"></script>
<?php if ($JSFX_LinkFader2) { ?>
<script type="text/javascript" language="javascript" src="scripts/JSFX_LinkFader2.js"></script>
<?php } ?>
<link href="styles/pages.css" rel="stylesheet" type="text/css">
</head>
<body id="app" class="app off-canvas">
<header class="site-head" id="site-head">
		<ul class="list-unstyled left-elems">
			<!-- nav trigger/collapse -->
			<li>
				<a href="javascript:;" class="nav-trigger ion ion-drag"></a>
			</li>
			<!-- #end nav-trigger -->

			<!-- Search box -->
			<li>
				<div class="form-search hidden-xs">
					<form id="site-search" action="../search.php" method="GET">
                                <input type="search" name="search" class="form-control" placeholder="Type here for search...">
                                <button type="submit" class="ion ion-ios-search-strong"></button>
                        </form>
				</div>
			</li>	<!-- #end search-box -->

			<!-- site-logo for mobile nav -->
			<li>
				<div class="site-logo visible-xs">
					<a href="javascript:;" class="text-uppercase h3">
						<span class="text">xPortal</span>
					</a>
				</div>
			</li> <!-- #end site-logo -->

			<!-- fullscreen -->
			<li class="fullscreen hidden-xs">
				<a href="javascript:;"><i class="ion ion-qr-scanner"></i></a>

			</li>	<!-- #end fullscreen -->

			<!-- notification drop -->
			<?php $notification = mysqli_query($db_server, "SELECT * FROM notification WHERE RECIEVER ='$username' AND STATUS='0'"
                                . "ORDER BY TIME DESC LIMIT 10");
			
			
			$row_note = mysqli_num_rows($notification); 
			
			?>
			<!-- notification drop -->
			<li class="notify-drop hidden-xs dropdown">
				<a href="javascript:;" data-toggle="dropdown">
					<i class="ion ion-speakerphone"></i>
					<span class="badge badge-danger badge-xs circle"><?php echo $row_note; ?></span>
				</a>

				<div class="panel panel-default dropdown-menu">
            <div class="panel-heading">
                    You have <?php echo $row_note; ?> new notifications 
            </div>
                                    <div class="panel-body" style="width: 400px">
                    <ul class="list-unstyled" style="width: 100%">

                            <?php 

                            foreach($notification as $notify)
                            {
                                    $notify_person = $notify['USERNAME'];
                                    $notify_content = $notify['CONTENT'];
                                    $notify_status	= $notify['STATUS'];
                                    $notify_id		= $notify['NOTIFICATION_ID'];
                                    $query_notify = mysqli_query($db_server, "SELECT LASTNAME, FIRSTNAME, PROFILE_PICTURE FROM "
                                            . "profiles WHERE USERNAME = '$notify_person'");
                                    
                                    $notify_Rows = mysqli_num_rows($query_notify);
                                    
                                    if($notify_Rows > 0){
                                    
                                    
                                    foreach($query_notify as $profiler)
                                    {

                                            //$picture_1 = $profile['PROFILE_PICTURE'];
                                            //$encdir = md5($message);
                                            //$directory_images_ ="xportal/profiles/$encdir/images/$picture_1" ;

                                            $urnames = $profiler['LASTNAME']." ".$profiler['FIRSTNAME'];
                                            $combine = $urnames." ".$notify_content;

                                    echo "<li class='clearfix'>".
                                            "<a href='index.php?view=$notify_status"."&erase=$notify_id'>
                                                    <span class='left bg-success'></span>
                                                    <div class='desc' style='font-size: 10pt'>
                                                            <strong>$combine</strong>
                                                            <p class='small text-muted'>".$notify['TIME']."</p>
                                                    </div>
                                            </a>
                                    </li>";



                            }}
                            }


                            ?>
                    </ul>
            </div>
    </div>

			</li>	<!-- #end notification drop -->

		</ul>

		<ul class="list-unstyled right-elems">
			<!-- profile drop -->
			<li class="profile-drop hidden-xs dropdown">
				<a href="javascript:;" data-toggle="dropdown">
					
			<?php 
			if($picture == NULL)
			{
				echo "<img src='./images/default.png' class='user-image' alt='IMG' />";
			}
			else {
				echo "<img src='./$directory_images$picture' class='user-image' alt='IMG' />";
			}
			?>
					
                  <span class="hidden-xs" style="color:#ffffff;font-weight:bold"><?php echo $lastname." ".$name; ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
                                  
                            <li><a href="../profile.php"><span class="ion ion-person">&nbsp;&nbsp;</span>Profile</a></li>
							<?php
                             if( $is_Admin == '1' ){
                                 echo "<li><a href='admin.php'><span class='ion ion-android-settings'>&nbsp;&nbsp;</span>Admin Panel</a>
                                     </li>";
                                 }
                            ?>
                            <li><a href="../signout.php"><span class="ion ion-power">&nbsp;&nbsp;</span>Logout</a></li>
                  
				</ul>
			</li>
			<!-- #end profile-drop -->
		</ul>

	</header>
	<!-- #end header -->
	<!-- main-container -->
	<div class="main-container clearfix">
		<!-- main-navigation -->
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			<div class="nav-head">
				<!-- site logo -->
				<a href="index.php" class="site-logo text-uppercase">
					<i class="ion ion-disc"></i>
					<span class="text">xPortal</span>
				</a>
			</div>

			<!-- Site nav (vertical) -->

			<nav class="site-nav clearfix" role="navigation">
				<div class="profile clearfix mb15">
					<div class="btn-group btn-success" style="border-radius:50px; margin-left:8px; margin-top: 10px; width:160px">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" 
           style=" background-color: #e91e63; color: whitesmoke; border-radius:50px; width:160px; font-weight:bold">
                + CREATE
                <span class="caret"></span>
        </a>
                    <ul class="dropdown-menu">
                        <li ><a href=""><i class="ion ion-person-add"></i>Connections</a></li>
                        <li ><a href=""><i class="ion ion-android-people"></i>Group</a></li>
                        <li ><a href="tasks.php"><i class="ion ion-compose"></i>Task</a></li>
                        <li ><a href="calendar.php"><i class="ion ion-calendar"></i>Calender Event</a></li>
                    </ul>
					</div>
				</div>

				<!-- navigation -->
				<ul class="list-unstyled clearfix nav-list mb15">
					<li>
						<a href="../index.php">
							<i class="ion ion-monitor"></i>
							<span class="text">Dashboard</span>
						</a>
					</li>
                                        	<li>
						<a href="../chat.php">
							<i class="ion ion-chatbubbles"></i>
							<span class="text">Chat</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="ion ion-email"></i>
							<span class="text">Mail</span>
						</a>
					</li>
                                        
                                        <li>
						<a href="../calendar.php">
							<i class="ion ion-calendar"></i>
							<span class="text">Calendar</span>
						</a>
					</li>

					<li>
						<a href="../tasks.php">
							<i class="ion ion-compose"></i>
							<span class="text">Tasks</span>
						</a>
					</li>


					<li class="active">
						<a href="index.php">
							
							<i class="ion ion-folder"></i>
							<span class="text">My Drive</span>
							
						</a>
					</li>					
				</ul> <!-- #end navigation -->
			</nav>

			<!-- nav-foot -->
			<footer class="nav-foot">
				<p>2015 &copy; <span>xPortal</span></p>
			</footer>
		</aside>
		<!-- #end main-navigation -->
		
		
	
	
		<div class="content-container" id="content">
			<!-- dashboard page -->
			<div class="page page-dashboard">

				<div class="page-wrap">

					<div class="row">
						<!-- dashboard header -->
						<div class="col-md-12">
							<div class="dash-head clearfix mt15 mb20">
								<div class="left">
									<h4 class="mb5 text-light"><strong>My Drive</strong></h4>
								</div>
							</div>
						</div>
					</div> <!-- #end row -->
	
						<div class="row">
						
<!-- Analytics -->
<div class="col-md-7">
        <div class="panel panel-default mb20 panel-hovered analytics">
                <div class="panel-heading">Upload New Files Below</div>
					<div class="panel-heading">             
					   
						<div class="" style="width: 100%;" >
							
							<div class="clearfix">
									
								<center>
									<div class="panel panel-default mb20 panel-hovered analytics" style=" height: 100px">
									  <table class="table">
											<form action="fileup.php" method="post" enctype="multipart/form-data" name="form1">
												<tr> 
												  <td> 
												   <span class="style11"><?php echo $nSelectFile ?></span>
													<input name="userfile" type="file">
													<?php if(isset($_GET['cam'])) {?>
													<input name="carpeta" type="hidden" value="<?php echo $_GET['cam'] ?>">
													<?php }?></td>
													<td>
														<span class="style11">Submit File</span><br />
											<input type="submit"  value="Upload" onClick="msgboxProcesando(true);" class="btn-group btn-primary wave-effects" style="padding:4px 6px;width:80%"></td>
												</tr>
											</form>
										</table>
									</div>
								</center>
							</div>
								
						</div>
					</div>
          
        </div>
    
    
		<div class="panel panel-default mb20 panel-hovered analytics">
			
					<div class="dash-head clearfix mt15 mb20" style="border-radius: 20px; border:  #3e4fb1 solid;margin-left: 20px; margin-right: 20px; padding: 10px 30px">
							<div class="left">
								<strong>MY FILES</strong>
							</div>
					</div>

				   <div class="panel-body">
						   
						   <div id="contenedor"></div>
						<script type="text/javascript" language="javascript"> msgboxProcesando(true); </script>
						<!--?php require_once('images/template/'.$Template.'/includes/top.php'); ?-->
						<form action="" method="get" name="formFiles">
							<table width="<?php echo $pTableWidth ?>" border="0" align="<?php echo $pTableAlign?>" class="table" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
							<tr bgcolor="#3e4fb1" class="features"> 
								<td  bgcolor="#3e4fb1"><div align="center" ><strong><?php echo $nFile?></strong></div></td>
								<td  bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nSize?></strong></div></td>
								<td  bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nFileType?></strong></div></td>
								<td  bgcolor="#3e4fb1"><div align="center"><strong><?php echo $nAction?></strong></div></td>
							</tr>
  
							<tr bgcolor="#FFFFFF"> 
								<td>
								  <?php 
								  
								  if (isset($_GET['cam']))
								  {
									$ncam = "". $_GET['cam']; 
									?>

									<p>
									<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php echo setUpperPath($_GET['cam'])?>"><img src="images/open.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo ($_GET['cam'])?>/..</a>
									</p>
								<?php
								  }
								  else
								  {
									$ncam = "";
									?>
									<p>
									<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam="><img src="images/open.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle">/..</a>
									</p>
								<?php
								}
								?>
								 </td>
								<td></td>
								<td></td>
								<td align="right"><a href="javascript:void(0);" onMouseOver="window.status='';return true;" onClick="newFolder('<?php echo $ncam ?>')"><img src="images/closed.gif" width="16" height="16" border="0" align="absmiddle" title="<?php echo $nNewFolderIcon ?>"></a></td>
							</tr>
						
						  <?php
						  $path = $path . $ncam;
						  ?>
						  <?php

						if ($dir = @opendir($path)) {
						  while (($file = readdir($dir)) !== false) {
							//echo "$file\n";
							if ($file != "." && $file != "..") {
						?>
				  <tr bgcolor="#FFFFFF"> 
						<td height="19"><p>&nbsp;
						<?php if (!is_dir($path."/".$file)) { ?>
						<a class="fadeLink" onClick="msgboxProcesando(true);" href="<?php echo $path."/".$file?>" ><img src="images/doc.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " ".$file?></a>
						<?php }else{?>
						<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php if (isset($_GET['cam'])){echo $_GET['cam'];}else{echo "";} echo "/".$file?>" ><img src="images/closed.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " " .$file?></a>
						<?php }?></p>
						</td>
						<td><div align="right"><p><?php echo tamanio_archivo($file,$path);?></p></div></td>
						<td> 
						 
						  <div align="center"> <p><?php if(tipo_archivo($file,$path)==1) echo $nTDir; else echo $nTFile;?></p></div></td>
						<td align="right"><p>
						<?php if (!is_dir($path."/".$file)) { ?>
						<a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $path."/".$file?>', 2,'<?php echo $ncam?>');" onMouseOver="window.status='';return true;">
						<img src="images/delete.gif" title="<?php echo $nDeleteIcon ?>" width="18" height="14" border="0">
						<?php }else{?>
						<a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $path."/".$file?>', 1,'<?php echo $ncam?>');" onMouseOver="window.status='';return true;">
						<img src="images/delete.gif" title="<?php echo $nDeleteFolderIcon ?>" width="18" height="14" border="0">
						<?php }?></a></p></td>
				  </tr>
				  
		  <?php
		  }  }
		  closedir($dir);
		}

		?>
		</table>
		</form>
						   
						   
						   
				   </div>
			
		</div>

		</div> 
		
		<div class="col-md-5">
        <div class="panel panel-default panel-hovered mb20 todo" id="todoApp">
            <div class="panel-heading">
                <span>Todo List</span>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled todo-list">

                </ul>

                <!-- Add todo input -->
                <form id="input-todo" class="input-todo">
                        <input placeholder="Write some todo task here..." type="text">
                </form>
            </div> <!-- #end panel-body -->
            <div class="panel-footer todo-foot clearfix" id="todo-filters">
                <div class="left">
                        <button class="btn btn-pink btn-xs right toggle-all">Toggle All</button>
                </div>
                <div class="right">
                        <span class="remaining btn btn-xs btn-default">left</span>
                        <button class="btn btn-pink btn-xs clear-completed">Clear Completed</button>
                </div>
            </div>
        </div> <!-- #end panel -->
        <div class="col-md-5" style="width: 100%">
        <div class="panel panel-default panel-hovered mb20 activities">
                <div class="panel-heading">My Tasks</div>
                <div class="panel-body">
                    <div class='table-responsive col-md-12'>
             <table class='table table-bordered table-striped'>
                <tbody>

<?php 

$query_mytasks = "SELECT * FROM tasks WHERE USERNAME = '$username' OR RESPONSIBLE = '$username' ORDER BY DEADLINE LIMIT 5";
$mytask_results = mysqli_query($db_server, $query_mytasks);

foreach($mytask_results as $task)
{
    //$dateTimeC = $task['DATECREATED'];
    //$dateTimeD = $task['DEADLINE'];
    
    //$timeInterval = $dateTimeC->diff($dateTimeD);
    
    //echo "DateC: $dateTimeC and DateD: $dateTimeD";
    
    echo "<tr>
            <td><strong>".$task['TASK_NAME']."</strong></td>
        </tr>";
}
    ?>
                </tbody>
             </table>
</div>
</div>
</div>
</div>
<!-- recent activities -->
<div class="col-md-5" style="width: 100%">
        <div class="panel panel-default panel-hovered mb20 activities">
                <div class="panel-heading">Recent Activities</div>
                <div class="panel-body">
                        <ul class="list-unstyled">
<?php 

$query_activities = "SELECT * FROM tbl_activities WHERE ACTIVITY_PERSON = '$username' ORDER BY ACTIVITY_DATETIME DESC LIMIT 10";
$activity_results = mysqli_query($db_server, $query_activities);

foreach($activity_results as $activity)
{
    
    echo "<li class='info'>
            <span class='point'></span>
            <span class='time small text-muted'>".$activity['ACTIVITY_DATETIME']."</span>
            <p>".$activity['ACTIVITY_DESC']."</p>
    </li>";
}
    ?>
                        </ul>
</div>
</div>
</div>
						<!-- #end recent activities -->
</div>
		
		
		</div>
		
		
		</div> <!-- #end page-wrap -->
			</div>
			<!-- #end dashboard page -->
		</div>

	</div> <!-- #end main-container -->
	<!-- theme settings -->
	<div class="site-settings clearfix hidden-xs">
		<div class="settings clearfix">
			<div class="trigger ion ion-settings left"></div>
			<div class="wrapper left">
				<ul class="list-unstyled other-settings">
					<li class="clearfix mb10">
						<div class="left small">Nav Horizontal</div>
						<div class="md-switch right">
							<label>
								<input type="checkbox" id="navHorizontal"> 
								<span>&nbsp;</span> 
							</label>
						</div>
						
						
					</li>
					<li class="clearfix mb10">
						<div class="left small">Fixed Header</div>
						<div class="md-switch right">
							<label>
								<input type="checkbox"  id="fixedHeader"> 
								<span>&nbsp;</span> 
							</label>
						</div>
					</li>
					<li class="clearfix mb10">
						<div class="left small">Nav Full</div>
						<div class="md-switch right">
							<label>
								<input type="checkbox"  id="navFull"> 
								<span>&nbsp;</span> 
							</label>
						</div>
					</li>
				</ul>
				<hr/>
				<ul class="themes list-unstyled" id="themeColor">
					<li data-theme="theme-zero" class="active"></li>
					<li data-theme="theme-one"></li>
					<li data-theme="theme-two"></li>
					<li data-theme="theme-three"></li>
					<li data-theme="theme-four"></li>
					<li data-theme="theme-five"></li>
					<li data-theme="theme-six"></li>
					<li data-theme="theme-seven"></li>
				</ul>
			</div>
		</div>
	</div>
	
	</div>
	<!-- #end theme settings -->


	<script src="../scripts/vendors.js"></script>
	<script src="../scripts/plugins/d3.min.js"></script>
	<script src="../scripts/plugins/c3.min.js"></script>
	<script src="../scripts/plugins/screenfull.js"></script>
	<script src="../scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="../scripts/plugins/waves.min.js"></script>
	<script src="../scripts/plugins/jquery.sparkline.min.js"></script>
	<script src="../scripts/plugins/jquery.easypiechart.min.js"></script>
	<script src="../scripts/plugins/bootstrap-rating.min.js"></script>
	<script src="../scripts/app.js"></script>
	<script src="../scripts/index.init.js"></script>
</body>
</html>
<?php
	}
	else
	{
		header('location:login.php');
	}
?>
