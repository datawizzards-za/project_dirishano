<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>JMB Online</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" type="image/png" href="img/icon.png"/>
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Slider
    ================================================== -->
<link href="css/owl.carousel.css" rel="stylesheet" media="screen">
<link href="css/owl.theme.css" rel="stylesheet" media="screen">

<!--Fancy Box-->
<link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Google Analytics -->
<?php include_once("analyticstracking.php") ?>

<div id="preloader">
  <div id="status"> <img src="img/preloader.gif" height="64" width="64" alt=""> </div>
</div>
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
      <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php"><strong>JMB Online</strong></a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#home" class="page-scroll">Home</a></li>
          <li><a href="#about-section" class="page-scroll">About Us</a></li>
        <li><a href="#our-process" class="page-scroll">Our Process</a></li>
          <li><a href="#contact-section" class="page-scroll">Contact</a></li>
          <li><a href="#works-section" class="page-scroll">FAQ</a></li>
          <li><a href="app/login/" target="_blank" class="page-scroll" style="border: 1px solid #33E">Sign In</a></li>
          <li><a href="#jobsportal" class="page-scroll">Jobs Portal</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- Header -->
<header class="text-center" name="home">
  <div class="intro-text">
    <h1 class="wow fadeInDown">Welcome to <strong><span class="color">JMB Online</span></strong></h1>
    <p class="wow fadeInDown">Let convenience Take Charge</p>
    <!--a href="#works-section" class="btn btn-default btn-lg page-scroll wow fadeInUp" data-wow-delay="200ms">Register Now</a-->
  </div>
  <div id="services-section">

  <div class="container">

    <div class="section-title wow fadeInDown">
      <h2>Get<strong> Registered</strong></h2>
      <hr>
    </div>
     <div class="row">
        <div class="col-md-4 col-lg-3 service wow fadeInUp" data-wow-delay="400ms"> <i></i>
        <h4><strong></strong></h4>
        </div>
        <div class="col-md-2 col-lg-2 service wow fadeInUp" data-wow-delay="400ms">
            <a href="app/register-cl.php" target="_blank"><i class="fa fa-user-plus"></i></a>
            <h4><strong><a href="app/register-cl.php" target="_blank">CLIENT</a></strong></h4>
        </div>
        <div class="col-md-2 col-lg-2 service wow fadeInUp" data-wow-delay="600ms">
            <a href="app/register-sp.php" target="_blank"><i class="fa fa-gears"></i></a>
            <h4><strong><a href="app/register-sp.php" target="_blank">SERVICE PROVIDER</a></strong></h4>
        </div>
        <div class="col-md-2 col-lg-2 service wow fadeInUp" data-wow-delay="600ms">
            <a href="app/register-sup.php" target="_blank"><i class="fa fa-database"></i></a>
            <h4><strong><a href="app/register-sup.php" target="_blank">SUPPLIER</a></strong></h4>
        </div>
    </div>
    </div>
    </div>
</header>


<!-- About Section -->
<div id="about-section">
  <div class="container">
    <div class="section-title text-center wow fadeInDown">
      <h2><strong>About</strong> us</h2>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-6 wow fadeInLeft"> <div class="space"></div> <img src="img/about.png" class="img-responsive"> </div>
      <div class="col-md-6 wow fadeInRight">
          <h4>Who We Are</h4>
          <p>JMB Online is a subsidiary of JMB Construction - a construction Company based in Pretoria. JMB Online seeks to harness and exploit the power of Technology in the construction industry. </p>
          <p>We provide an Online Bidding System which allows Clients to log a job, i.e., a Construction Project, thereby inviting interested Contractors to bid for the job and compete for the project in terms of costs and time to complete.
            The system provides access to a variety of Suppliers to choose from, depending on price, promotions and delivery time, etc. 
            <br><br>JMB Online is a 1-Stop converged service that seeks to help you get your project started, your company working, and/or get your products in the market</p>
          <h4>What We Offer</h4>
           <div class="list-style">
            <div class="row">
              <div class="col-lg-12 col-sm-6 col-xs-12">
                <ul>
                  <li>Free Registration and Access to our Database</li>
                  <li>Clients can source Quotes and Material from a pool of Suppliers with ease</li>
                  <li>Suppliers can advertise their products and promotions to the precise target market</li>
                  <li>Contractors, small or big, get equal opportunity to bid for projects</li>
                  <li>Get access to qualified job seekers on the Jobs Portal</li>
                </ul>
              </div>
            </div>
          </div>     
      </div>
    </div>
  </div>
</div

<!-- Testimonials Section -->
<div id="testimonials-section" class="text-center">
  <div class="container">
    <div class="section-title wow fadeInDown">
      <h2><strong>Why Join Us</strong></h2>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="testimonial" class="owl-carousel owl-theme wow fadeInUp" data-wow-delay="200ms">
          <div class="item">
            <p><strong>
                Our platform is Online. Available 24/7. Accessible from Any Device. And it's FREE.
           </strong></p>
          </div>
          <div class="item">
            <p><strong>
                Everything you need, in One place. JMB Online saves you Time and Money.
           </strong></p>
          </div>
          <div class="item">
            <p><strong>
                A vast network of Clients, Suppliers, and Contractors. Free Access to a vast pool of quotations. Comparison made easy.
           </strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Services Section -->
<div id="services-section" class="text-center">
  <div class="container" id="our-process">
    <div class="section-title wow fadeInDown">
      <h2>Our <strong>Process</strong></h2>
      <hr>
      <div class="clearfix"></div>
    </div>
    <div class="space"></div>
    <div class="row">
    <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="200ms"> <i class="fa fa-user-plus"></i>
        <h4><strong>Register</strong></h4>
        <p>Register as a Client, Contrator or Supplier</p>
    </div>
    <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="400ms"><i class="fa fa-question"></i>
        <h4><strong>Log a Job</strong></h4>
        <p>Client logs a Job</p>
    </div>
    <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="800ms"><i class="fa fa-quote-right"></i>
        <h4><strong>Instant Quote</strong></h4>
        <p>Client/Contractor can intantly get a quote from a trusted and reputable Supplier</p>
    </div>
    <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="600ms"><i class="fa fa-check-square"></i>
        <h4><strong>Bid</strong></h4>
        <p>Contractor bids a Job</p>
    </div>      
    </div>
  </div>
</div>

<!-- Jobs Portal Section -->
<div id="jobsportal" class="text-center">
  <div class="container" id="our-process">
    <div class="section-title wow fadeInDown">
      <h2>The <strong>Jobs Portal</strong></h2>
      <hr>
      <div class="clearfix"></div>
    </div>
    <div class="space"></div>
    <div class="row">
    <div class="col-md-4 col-sm-6 service wow fadeInUp" data-wow-delay="200ms"> 
        <a href="app/jobseeker.php" target="_blank">
            <i class="fa"><strong>Job Seeker</strong></i>
        </a>
    </div>
    <div class="col-md-4 col-sm-6 service wow fadeInUp" data-wow-delay="400ms">
        <a href="app/employer.php" target="_blank">
            <i class="fa"><strong>Employer</strong></i>
        </a>
    </div>
    <div class="col-md-4 col-sm-6 service wow fadeInUp" data-wow-delay="800ms">
        <a href="app/jobsportal/home/" target="_blank">
            <i class="fa"><strong>Explore</strong></i>
        </a>
    </div>      
    </div>
  </div>
</div>

<!-- Contact Section -->
<div id="contact-section" class="text-center">
  <div class="container">
    <div class="section-title wow fadeInDown">
      <h2><strong>Contact</strong> us</h2>
      <hr>
    </div>
    <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay="200ms">
      <div class="col-md-4"> <i class="fa fa-map-marker fa-2x"></i>
          <p>10 Horridus Place <br /> Montana Park<br /> 0182 Pretoria. South Africa</p>
      </div>
      <div class="col-md-4"> <i class="fa fa-envelope-o fa-2x"></i>
        <p>info@jmbonline.co.za</p>
      </div>
      <div class="col-md-4"> <i class="fa fa-phone fa-2x"></i>
          <p> +27 (0) 82 061 3818 <br> +27 (0) 71 364 5157</p>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay="400ms">
	<h3>Leave us a message</h3>
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder="Name" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-default">Send Message</button>
      </form>
      <div class="social">
        <ul>
          <li><a href="https://www.facebook.com/JMBOnlineZA"><i class="fa fa-facebook"></i></a></li>
          <li><a href="https://twitter.com/JMBOnlineZA"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="footer">
  <div class="container">
      <p><i><strong>Powered by <a href="http://www.itechhub.co.za" target="_blank">iTechHub SA</a></strong></i>. Copyright © 2016</p>
  </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/wow.min.js"></script> 
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
<script type="text/javascript" src="js/contact_me.js"></script> 
<script type="text/javascript" src="js/owl.carousel.js"></script> 

<!-- Javascripts
    ================================================== --> 
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>