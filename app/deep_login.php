<?php

session_abort();
    
  include_once('include/config.php');
  
  $pageID = "";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:login.php");      
  }  else {
      
      $username = getUser($connection, $pageID);
      
      if (setSession($username)){
      
      $username_session = $username;
            
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      $userAvatar = getAvatar($connection, $username_session);
      ?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Materia - Admin Template">
    <meta name="keywords" content="materia, webapp, admin, dashboard, template, ui">
    <meta name="author" content="solutionportal">
    <link rel="shortcut icon" type="image/png" href="../img/icon.png"/>
    <!-- <base href="/"> -->

    <title>JMB Online | Login</title>

    <!-- Icons -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">

    <!-- Css/Less Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">

    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'> -->

    <!-- Match Media polyfill for IE9 -->
    <!--[if IE 9]> <script src="scripts/ie/matchMedia.js"></script>  <![endif]--> 
</head>
<body id="app" class="app off-canvas body-full animated fadeInDown" style="background-color: #000">
    <!-- main-container -->
    <div class="main-container ">
        <!-- content-here -->
        <div class="content-container" id="content" style="background-color: #000">
            <div class="page page-auth clearfix">
                <div class="auth-container lock-screen" >
                    <div class="form-container login-wrap">
                        <div id="profile" class="profile clearfix mb30" style="border: 1px solid transparent">
                            <img height="120px" width="35%" src="<?php echo $userAvatar ?>">
                            <h4 class="name"><?php echo $CompName ?></h4>
                        </div>
                        
                    <div id="loading" class="text-center" hidden>
                        <img src="images/preloader.gif" height="64" width="64" alt="">   
                        <br />
                        <br />
                    </div>

                    <div id="error_div" class='col-lg-12 fadeInUpBig animated centered' hidden>
                        <div class="alert alert-danger text-center text-bold text-desc" id="error_msg"></div>
                    </div>
                        <form class="form-horizontal" id="deepLoginForm" method="POST">

                        <input type="password" class="form-control text-center" name="usrpass" id="password" placeholder="Password" required>
                    <br />
                    <label class="checkbox">
                        <span class="pull-right">
                            <a href="logout.php"> Forgot Password?</a>
                        </span>
                    </label>
                    <br />
                    <button class="btn btn-theme btn-block" type="submit">SIGN IN</button>
                    </form>
                </div>
                </div>
                
            </div>
        </div> 
		<!-- #end content-container -->

	</div> <!-- #end main-container --><!-- Dev only -->
        <script src="assets/js/jquery.js"></script>
    <script src="assets/js/submit.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
  <?php } }