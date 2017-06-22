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
                    <form id="jobseeker_reg" class="form-login animated fadeInDown" method="POST">
		        <h2 class="form-login-heading">JMB Jobs Portal <br />Job Seeker Registration</h2>   
                        
                        <div id="loading" class="text-center" hidden>
                            <br />
                            <img src="images/preloader.gif" height="64" width="64" alt="">
                            <br />
                        </div>

                        <div id="error" class="col-lg-12 centered" hidden>
                            <br />
                            <div id="error_msg" class="alert alert-danger text-center text-bold text-desc fadeInUpBig animated ">                                
                            </div>                                                            
                        </div>

                        <div id="success" class='col-lg-12 centered' hidden>
                            <br />
                            <div id="success_msg" class="alert alert-success text-center text-bold text-desc fadeInDownBig animated">                                
                            </div>
                        </div>
                        
		        <div class="login-wrap">
                    <input type="text" class="form-control"  name="full_names" pattern="[a-zA-z].{4,}" title="Name should be at least 4 charaters" 
                           placeholder="Full Names" autofocus required>
                    <br>
                    <input type="email" class="form-control" name="email_address" placeholder="Email Address" required>
                    <br>
                    <input type="password" class="form-control" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" placeholder="Password" required>
                    <br>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                    <br />
                    <p id="passError" class="text-danger" hidden>Opps. Your passwords do not match!</p>
                    <button class="btn btn-theme btn-block" name="btn_register" id="btn_register" type="submit"><i class="fa fa-file"></i> REGISTER</button>
                    <br />
                    <div class="registration">
                        Already have a Profile?
                        <a class="" href="jobsportal/login/">Sign In</a>
                    </div>
                        </div>
              </form>
	  	</div>
	  </div>
      
      <!-- Import JS  -->
      <?php include 'js.php'; ?>   
</body>
</html>
