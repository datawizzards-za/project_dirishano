<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Fastbid, Service bid, Bid, Vescovo">

    <title>JMB Online | Register</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet">
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container animated fadeInDown">
	  	
		      <form id="supReg" class="form-login" action="" method="POST">
		        <h2 class="form-login-heading">JMB Online <br />Supplier Registration</h2>
				
                            <div id="loading" class="text-center" hidden>
                                <br />
                                <img src="images/preloader.gif" height="64" width="64" alt="">
                                <br />
                            </div>

                            <div id="success_div" class='col-lg-12 fadeInDownBig animated centered' hidden>
                            <br />
                            <div id="success_msg" class="alert alert-success text-center text-bold text-desc">
                            </div>
                            </div>

                            <div id="error_div" class='col-lg-12 centered fadeInUpBig animated' hidden>
                            <br />
                            <div id="error_msg" class="alert alert-danger text-center text-bold text-desc"></div>
                            </div>
                        
		        <div class="login-wrap">
                    <input type="text" class="form-control"  name="cname" pattern="[a-zA-z].{2,}" title="Name should be 2 or more charaters" placeholder="Company Name" autofocus>
                    <br>                    
                    <input type="text" class="form-control" name="waddress" placeholder="Web Address">
                    <br>
                    <input type="text" class="form-control" name="paddress" pattern=".{8,}" title="Please enter a Valid Address" placeholder="Physical Address">
		            <br>                    
                    <input type="text" class="form-control" name="cellno" placeholder="Tell Number">
                    <br>
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                    <br />
                    <input type="password" class="form-control" name="password" placeholder="***********">
                    <br />
		            <button class="btn btn-theme btn-block" name="cred" type="submit"><i class="fa fa-file"></i> REGISTER</button>
                            <br />
		            <div class="registration">
		                Already have an Account? 
		                <a class="" href="login.php">
		                    Sign In
		                </a>
		            </div>
		
		        </div>
                      </form>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/submit.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>

  </body>
</html>