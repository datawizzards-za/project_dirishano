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
	<link href="assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <section id="container">
        <div id="login-page">
            <div class="container">
                <div class="login-wrap">
                <form id="spReg" class="form-login animated fadeInDown" method="POST">
                    <h2 class="form-login-heading">JMB Online <br />Service Provider Registration</h2>
					
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
                    <div id="spRegForm" class="login-wrap">
                        <input type="text" class="form-control" name="cname" placeholder="Company Name" pattern="[a-zA-z].{2,}" title="Company Name should be at least 2 charaters" autofocus required>
                        <br />
                        <input type="text" class="form-control" name="tradeas" placeholder="Trading As" pattern="[a-zA-z].{2,}" title="enter a valid Name" required/>
                        <br />
                        <input type="text" class="form-control" name="pAddress" placeholder="Physical Address" pattern=".{8,}" title="a valid Address should be at least 8 charaters" required/>
                        <br>
                        <input type="text" class="form-control" name="wAddress" placeholder="Website">
                        <br />
                        <input type="email" class="form-control" name="email" placeholder="Email Address" title="example info@jmbonline.co.za" required/>
                        <br>
                        <input type="tel" class="form-control" name="cellno" placeholder="Contact Number" pattern="^\d{3}-\d{3}-\d{4}$" title="e.g. 081-718-9287" required/>
                        <br>
                        <input type="text" class="form-control" name="cregno" placeholder="Company Reg. No." pattern="^\d{4}/\d{6}/\d{2}$" title="e.g. 2015/172309/07" required/>
                        <br />
                        <input type="text" class="form-control" name="taxreg" placeholder="Tax Reg. No." pattern="[0-9]{1,10}" title="A Valid Tax Ref No. has 10 digits" required/>
                        <br />
                        <input type="password" class="form-control" name="password" placeholder="*********" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required/>
                        <br />
                        <button class="btn btn-theme btn-block" name="btnReg" type="submit"><i class="fa fa-file"></i> REGISTER</button>
                        <br />
                        <div class="registration">
                            Already have an Account?
                            <a class="" href="login.php">Sign In</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/submit.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>