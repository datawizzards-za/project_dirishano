<?php 

session_start();

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Materia - Admin Template">
	<meta name="keywords" content="materia, webapp, admin, dashboard, template, ui">
	<meta name="author" content="solutionportal">
        <link rel="shortcut icon" type="image/png" href="../../img/icon.png"/>
	<!-- <base href="/"> -->

	<title>JMB Online | Page Not Found </title>
	
	<!-- Icons -->
	<link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">

	<!-- Plugins -->
	<link rel="stylesheet" href="styles/plugins/waves.css">
	<link rel="stylesheet" href="styles/plugins/perfect-scrollbar.css">
	
	<!-- Css/Less Stylesheets -->
	<link rel="stylesheet" href="styles/bootstrap.min.css">
	<link rel="stylesheet" href="styles/main.min.css">
</head>
<body id="app" class="app off-canvas body-full">
	<!-- main-container -->
	<div class="main-container clearfix">
		<!-- content-here -->
		<div class="content-container" id="content">
			<div class="page page-err clearfix">

				<div class="err-container">
                                    
                                    <?php if(isset($_SESSION['username'])){?>
					<h1 class="m404 mb0">404 <a href="../" class="ion ion-forward" title="Get Me out of Here"></a></h1>
                                    
                                    <?php }else{?>
                                        
                                        <h1 class="m404 mb0">404 <a href="../logout.php" class="ion ion-forward" title="Get Me out of Here"></a></h1>
                                        
					<?php } ?>
                                        
                                        <p class="text-desc mb20">Oops, this page seems invalid.</p>
                                        
					<div class="form-container">
                                            <hr><br /><br />
					</div>

                                        <p class="small text-muted text-normal">
                                            <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; <?php echo date('Y') ?>
                                        </p>

				</div>
				
			</div>

		</div> 
		<!-- #end content-container -->

	</div> <!-- #end main-container -->
        
	<!-- Vendors -->
	<script src="scripts/vendors.js"></script>





	


</body>
</html>