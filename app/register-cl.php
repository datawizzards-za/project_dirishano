<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JMB Online | Register</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">	  	
                    <form id="clientReg" class="form-login animated fadeInDown" method="POST">
		        <h2 class="form-login-heading">JMB Online <br />Client Registration</h2>   
                        <br />
                        
                        <div id="loading" class="text-center" hidden>
                            <img src="images/preloader.gif" height="64" width="64" alt="">
                            <br />
                            <br />
                        </div>

                        <div id="error" class="col-lg-12 centered" hidden>
                            <div id="error_msg" class="alert alert-danger text-center text-bold text-desc fadeInUpBig animated "></div>                                                            
                        </div>

                        <div id="success" class='col-lg-12 centered' hidden>
                            <div id="success_msg" class="alert alert-success text-center text-bold text-desc fadeInDownBig animated"></div>
                        </div>
                        
		        <div class="login-wrap">
                    <input type="text" class="form-control"  name="cname" pattern="[a-zA-z].{4,}" title="Name should be at least 4 charaters" placeholder="Company or Person Name" autofocus required">
                    <br>                    
                    <input type="text" class="form-control" name="paddress" placeholder="Physical Address" required>
		            <br>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    <br>
                    <input class="form-control" name="cellno" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" title="e.g. 081-718-9287"  placeholder="Contact Number" required>
                    <br>
                    <input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title=" password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" placeholder="***********" required>
                    <br>
                    <button class="btn btn-theme btn-block" name="btnReg" type="submit"><i class="fa fa-file"></i> REGISTER</button>
                    <hr>
                    <div class="registration">
                        Already have an Account?
                        <a class="" href="login.php">Sign In</a>
                    </div>
                        </div>
              </form>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/submit.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
