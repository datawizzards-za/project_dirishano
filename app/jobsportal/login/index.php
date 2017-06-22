<?php 
include_once('../../include/config.php');
session_start();

if(isset($_SESSION['username'])){
    $user = md5(strtolower($_SESSION['username']));     
    header("location:../");
}else{  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JMB Jobs Portal | Login</title>
    
    <?php require '../commons/css.php'; ?>
    
    
  </head>

  <body style="background-color: #000">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
                    <form id="jobsportal_login" class="form-login animated fadeInDown" method="POST">
		        <h2 class="form-login-heading">Sign In to the JMB Jobs Portal</h2>
                        
                        <div id="loading" class="text-center" hidden>
                            <img src="../../images/preloader.gif" height="64" width="64" alt="">
                        </div>   
                        
                        <div id="error_div" class='col-lg-12 fadeInUpBig animated centered' hidden>
                            <br />
                            <div class="alert alert-danger text-center text-bold text-desc" id="error_msg"></div>
                        </div>
                        
		        <div class="login-wrap">
		            <input type="email" class="form-control" name="username" id="username" placeholder="Email Address" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
                                    <a data-toggle="modal" href="index.php#forgotpassModal"> Forgot Password?</a>
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" name="btnLogin" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                            <br />
		            <div class="registration">
		                Don't have a JMB Jobs Portal Profile yet?<br/>
                                <a data-toggle="modal" href="index.php#registerModal">Register for Free</a>
		            </div>
		        </div>
                  </form>
		
		      
              <!-- Forgot Pass Modal -->            
            <form id="forgotPassForm" method="POST">
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgotpassModal" class="modal fade">
                      <div class="modal-dialog animated fadeInDown">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title centered">Forgot Password ?</h4>
                              </div>
                              
                              <div id="fpass_loading" class="text-center animated bounceIn" hidden>
                                <br />
                                <img src="../../images/preloader.gif" height="64" width="64" alt="">
                                <br />
                                <br />
                              </div>
                              
                              <div id="fpass_success" class='col-lg-12 centered animated bounceIn' hidden>
                                  <br />
                                  <div class='alert alert-success'>
                                      <div id="fpass_success_msg"></div>                                          
                                  </div>                                      
                              </div>
                              
                              <div id="fpass_error" class='col-lg-12 centered animated bounceIn' hidden>
                                  <br />
                                  <div class='alert alert-danger'>
                                      <div id="fpass_error_msg"></div>                                          
                                  </div>                                      
                              </div>
                              
                              <div class="modal-body centered">                                  
                                  <input type="email" id="userMail" name="userMail" placeholder="Type your e-mail address here to reset your password" autocomplete="off" class="form-control placeholder-no-fix centered">
                              </div>
                              <div class="modal-footer centered">
                                  <button data-dismiss="modal" id="btnCancel" class="btn btn-default" type="button">Cancel</button>
                                  <button class="btn btn-theme" type="submit" name="btnForgotPass">Submit</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- modal -->        
            </form>
              
            <!-- Register Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registerModal" class="modal fade">
                <div class="modal-dialog animated fadeInDown">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title centered">Register As?</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row centered">
                                <div class="col-md-6 text-uppercase">
                                    <h4><strong><a href="../../jobseeker/">Job Seeker</a></strong></h4>
                                </div>
                                <div class="col-md-6 text-uppercase">
                                    <h4><strong><a href="../../employer.php">Employer</a></strong></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../scripts/js/submit.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">    
         $("#btnCancel").click(
                 function() {
                     $('#fpass_error').hide();  
                     $('#fpass_success').hide();
                 });
    
    </script>
    
  </body>
</html>
<?php }