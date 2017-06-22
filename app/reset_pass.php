<?php

session_abort();
    
  include_once('include/config.php');
  
  $pageID = $_GET['page_id'];
  $username = "";
  $logout_route = "logout.php";

  if (!($pageID))
  {
      header("location:logout.php");     
  }  else {
      
      $username = getUser($connection, $pageID);
      
      $usrTyp = getUserType($connection, $username);
      
      if($usrTyp == "JOBSEEKER" || $usrTyp == "EMPLOYER"){
          $logout_route = "jobsportal/login/logout.php";
      }
      
      if ($username){
          
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

    <title>JMB Online | Reset Password</title>

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
                <div class="auth-container">
                    <div class="form-container login-wrap">
                        <div id="profile" class="profile text-center text-capitalize clearfix mb30" style="border: 1px solid transparent">
                            <h4 class="name">
                                Please reset password below
                            </h4>
                        </div>
                        
                    <div id="loading" class="text-center" hidden>
                        <img src="images/preloader.gif" height="64" width="64" alt="">   
                        <br />
                    </div>

                        <div id="error_div" class='col-lg-12 fadeInUpBig animated ' hidden>
                            <div class="alert alert-danger  text-bold text-desc">
                                Oops! Something went wrong. <br />Please try again. <br /> <br />
                                Should the problem persist, <br /> please contact support on support@jmbonline.co.za
                            </div>
                        </div>
                        
                        
                        <div id="success" class="profile text-center text-capitalize bounceIn animated" hidden>
                            <h4 class="name">                                
                                Thank you 
                            </h4>
                                <br />
                            <h4 class="name">      
                                Please  
                                <a href="<?php echo $logout_route ?>"> login</a> with your new password.
                            </h4>
                        </div>
                        
                        
                        <form class="form-horizontal" id="resetPassForm" method="POST">
                            
                            <input type="hidden" name="_id" id="_id" value="<?php echo $username ?>" required>

                        <input type="password" class="form-control text-center" name="password" id="password" placeholder="New Password" required>
                        <br />
                        <input type="password" class="form-control text-center" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                    <br />
                    <p id="passError" class="text-danger text-center" hidden>Opps. Your passwords do not match!</p>
                    <br />
                    <button id="btn_register" class="btn btn-theme btn-block" type="submit">RESET</button>
                    </form>
                        <hr />
                    </div>
                </div>
                
            </div>
        </div> 
		<!-- #end content-container -->
                <script>
                    $('#password').focus();
                </script>
	</div> <!-- #end main-container --><!-- Dev only -->
        <script src="assets/js/jquery.js"></script>
        <script src="scripts//js/submit.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
  <?php }else{
      header("location:logout.php");   
  } }