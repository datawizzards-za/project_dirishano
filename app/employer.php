<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JMB Jobs Portal | Register</title>
    
    <?php include 'assets.php'; ?>
    
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">	  	
                    <form id="employer_reg" class="form-login animated fadeInDown" method="POST">
		        <h2 class="form-login-heading">JMB Jobs Portal <br />Creat Employer Account</h2>   
                        
                        <div id="loading" class="text-center" hidden>
                            <img src="../app/images/preloader.gif" height="64" width="64" alt="">
                            <br />
                        </div>

                        <div id="error" class="col-lg-12 centered" hidden>
                            <div id="error_msg" class="alert alert-danger text-center text-bold text-desc fadeInUpBig animated "></div>                                                            
                        </div>

                        <div id="success" class='col-lg-12 centered' hidden>
                            <div id="success_msg" class="alert alert-success text-center text-bold text-desc fadeInDownBig animated"></div>
                        </div>
                        
		        <div class="login-wrap">
                    <input type="text" class="form-control"  name="company_name" placeholder="Company Name" autofocus required>
                    <br>                    
                    <input type="text" class="form-control" name="company_rep" placeholder="Company Representative" required>
		            <br>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    <br>
                    <input type="password" class="form-control" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" placeholder="***********" required>
                    <br>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" placeholder="***********" required>
                    <br>
                    <button class="btn btn-theme btn-block" name="btnReg" type="submit"><i class="fa fa-file"></i> REGISTER</button>
                    <hr>
                    <div class="registration">
                        Already have a Profile?
                        <a class="" href="jobsportal/login/">Sign In</a>
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
