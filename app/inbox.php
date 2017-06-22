<?php

  include_once('include/config.php');
  
  $pageID = "";

  if (!($pageID = stripcslashes($_GET['page_id'])))
  {
      header("location:login.php");      
  }  else {
      
      $user = getUser($connection, $pageID);
      
      if (setSession($user)){
      
      $username = $username_session = $user;
            
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      $userAvatar = getAvatar($connection, $username_session);
      ?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <?php include 'head.php'; ?>
    <!--external css-->
    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/ionicons/ionicons.min.css" rel="stylesheet" />
    <link href="assets/plugins/summernote.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="assets/plugins/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/plugins/select2.css">
    <link rel="stylesheet" href="styles/plugins/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="styles/plugins/bootstrap-slider.css">
    <link rel="stylesheet" href="styles/plugins/bootstrap-datepicker.css">
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
        <?php include 'header.php'; ?> 
      </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">              	  	
                  
                  <p class="centered">
                      <?php if($userType == 'client'){?> <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID ?>"> <?php }
                               elseif($userType == 'service'){ ?> <a class="logout" href="profile_sp.php?page_id=<?php echo $pageID ?>"><?php }
                               else{?> <a class="logout" href="profile_sup.php?page_id=<?php echo $pageID ?>"> <?php } ?>                                 
                     
                          <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
                      </a>
                  </p>
              	  <h5 class="centered"><?php echo $CompName ?></h5>           
                  
                  <li class="mt hvr-grow">
                      <a class="active" href="index.php?page_id=<?php echo $pageID ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>DASHBOARD</span>
                      </a>
                  </li>

                  <?php
                  
                  if($userType == 'client' ){
                          echo "<li class='mt'><a href='bids.php?page_id=$pageID'><i class='fa fa-tasks'></i><span>BIDS</span></a></li>";
                        }elseif($userType == 'service' ){
                          echo "<li class='mt'><a href='jobs.php?page_id=$pageID'><i class='fa fa-book'></i><span>JOBS</span></a></li>";
                          echo "<li class='mt'><a href='portfolio.php?page_id=$pageID'><i class='fa fa-archive'></i><span>PORTFOLIO</span></a></li>";
                        }else{
                            echo "<li class='mt'><a href='catalogue.php?page_id=$pageID'><i class='fa fa-archive'></i><span class='text-uppercase'>My Catalogue</span></a></li>";
                        }                        
                  ?>
                  
                  <li class="mt">
                      <a href="newslet.php?page_id=<?php echo $pageID; ?>">
                          <i class="fa fa-envelope-o"></i>
                          <span>NEWSLETTERS</span>
                      </a>
                  </li>

                  <li class="mt">
                      <?php
                          if($userType == 'client'){ echo "<a href='profile_cl.php?page_id=$pageID'>";}
                            elseif($userType == 'service'){ echo "<a href='profile_sp.php?page_id=$pageID'>";}
                            elseif($userType == 'supplier'){ echo "<a href='profile_sup.php?page_id=$pageID'>";}
                      ?>
                          <i class="fa fa-user"></i>
                          <span>PROFILE</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-9 main-chart fadeInDown animated">
                      <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                        <h1 class="text-center">JMB Online: Inbox </h1>
                    </div>  
                      
                      <div class="row mtbox">
                          
                          <!-- material page -->
<div class="page page-email">

        <div class="page-wrap">
    <button type="button" class="btn btn-pink ion ion-plus compose-btn" data-toggle="modal" data-target="#composeMailModal"></button>
        <div class="row">
            <div class="col-md-2">
                <nav class="email-nav clearfix hvr-grow">
                    <!-- compose mail btn -->
                    <form class="form-horizontal" action="javascript:;">
                        <div class="input-group mb30">
                        <input class="form-control" type="text" placeholder="Search mail...">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default fa fa-search"></button>
                            </div>
                        </div>
                    </form>
                    <div class="xsmall nav-text-lead text-uppercase text-muted mb10">Navigation</div>
                    <ul class="list-unstyled navigation mb15">
                            <li class="active"><a href="javascript:;"><span class="ion ion-filing"></span>Inbox (12)</a></li>
                            <li><a href="javascript:;"><span class="ion ion-paper-airplane"></span>Sent</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-10 hvr-shrink">
                    <div class="email-content">
<!-- email summary lists -->
<ul class="email-lists list-unstyled clearfix mb30 hvr-grow">
<li class="read">
    <a href="javascript:;">
            <div class="group clearfix small">
                    <span class="sender-name left text-bold">Jonathan Doe</span>
                    <span class="email-date right xsmall mt1 text-pink">3 mins ago</span>
            </div>
            <p class="subject">Some nice subject here.</p>
            <p class="summary small text-muted">Nor again is there anyone who loves or pursues or desires to obtain pain of itself...</p>

            <div class="group clearfix">
                    <span class="ion ion-trash-a left remove-email"></span>
                    <span class="ion right ion-paperclip" ></span>
            </div>
    </a>
</li>
<li class="active">
    <a href="javascript:;">
            <div class="group clearfix small">
                    <span class="sender-name left text-bold">Organizer.com</span>
                    <span class="email-date right xsmall mt1 text-pink">12th Feb</span>
            </div>
            <p class="subject">Meetup at C.P, New Delhi</p>
            <p class="summary small text-muted">Lorem ipsum dolar sit amet...</p>

            <div class="group clearfix">
                    <span class="ion ion-trash-a left remove-email"></span>
                    <span class="ion right" ></span>
            </div>
    </a>
</li>
<li class="read">
    <a href="javascript:;">
            <div class="group clearfix small">
                    <span class="sender-name left text-bold">android.io</span>
                    <span class="email-date right xsmall mt1 text-pink">11th Jan</span>
            </div>
            <p class="subject">Calling all android developers to join me</p>
            <p class="summary small text-muted">Pellentesque habitant morbi tristique senectus et netus...</p>

            <div class="group clearfix">
                    <span class="ion ion-trash-a left remove-email"></span>
                    <span class="ion right ion-paperclip" ></span>
            </div>
    </a>
</li>
<li>
    <a href="javascript:;">
            <div class="group clearfix small">
                    <span class="sender-name left text-bold">android.io</span>
                    <span class="email-date right xsmall mt1 text-pink">22nd Dec</span>
            </div>
            <p class="subject">Meetup at C.P, New Delhi</p>
            <p class="summary small text-muted">Lorem ipsum dolar sit amet...</p>

            <div class="group clearfix">
                    <span class="ion ion-trash-a left remove-email"></span>
                    <span class="ion right"></span>
            </div>
    </a>
</li>
<li>
    <a href="javascript:;">
            <div class="group clearfix small">
                    <span class="sender-name left text-bold">trigger.io</span>
                    <span class="email-date right xsmall mt1 text-pink">12th Dec</span>
            </div>
            <p class="subject">RE: Question about account information V334RE99e: s3ss</p>
            <p class="summary small text-muted">Hi, Thanks for the reply, I want to know something...</p>

            <div class="group clearfix">
                    <span class="ion ion-trash-a left remove-email"></span>
                    <span class="ion right ion-paperclip" ></span>
            </div>
    </a>
</li>



</ul> <!-- #end email summary lists -->

<!-- email view (in real app, it must be loaded via xhr/json-->
<div class="email-view mb15 hvr-grow">

<div class="group clearfix head mb15">
<div class="left">
<h3 class="text-light mt5">Meetup at C.P., New Delhi</h3>
<p><strong>Organizer.com</strong></p>
</div>
<div class="right">
<div class="btn-group mb10 btn-group-sm">
    <button class="btn btn-default ion ion-trash-a" type="button" ></button>
    <button class="btn btn-default ion ion-arrow-left-c" type="button"></button>
    <button class="btn btn-default fa ion-arrow-right-c" type="button"></button>
</div>
<div class="date small text-pink text-bold">12th Feb</div>
</div>
</div>

<div class="email-description">
<p>
Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla.</p> 
</div>


<!-- reply box -->
<form class="form-horizontal clearfix" action="javascript:;">
<div id="replyBox"></div>		

<button class="btn btn-success btn-sm mt15 right" type="submit"><i class="fa fa-paper-plane"></i>Reply</button>
</form>
</div>
</div>

</div> <!-- #end row -->
</div> <!-- #end page-wrap -->
</div>
</div> 

      </div><!-- /row mt -->	                      
  </div><!-- /col-lg-9 END SECTION MIDDLE -->
  
  <div class="modal modalFadeInScale" id="composeMailModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="email-compose">	<!-- wrapper for specific style -->
					
					<div class="modal-header clearfix bg-dark">
						<div class="small text-uppercase left title">New Message</div>
						<button class="close right" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body">
						<form name="email-compose" id="mail-compose" action="javascript:;" class="form-horizontal">

							<div class="input-group mb15">
								<span class="input-group-addon">To:</span>
								<input type="text" class="form-control">
							</div>

							<div class="input-group mb15">
								<span class="input-group-addon">Subject:</span>
								<input type="text" class="form-control">
							</div>


							<div class="input-group mb15"  style="width: 100%">
								<div id="composeMailBox"></div>
							</div>


							<button type="submit" class="btn btn-success">Send Message</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                    
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                      <h3>SUPPLIERS</h3>                      
                      <?php 
                      
                      $suppliers = $connection->query("SELECT * FROM supplier");
                      
                      foreach ($suppliers as $supplier){
                          $supName = $supplier['COMPANYNAME'];
                          $supCatalogue = $supplier['WEBADDRESS'];
                          $supEmail = $supplier['EMAILADDRESS'];
                          $supAvatar = getAvatar($connection, $supEmail);?>

                      <!-- Third Member -->
                      <div class="desc">
                          <div class="thumb">
                              <a href="catalogue.php?page_id=<?php echo md5($supEmail)?>">
                                  <img class="img-circle" src="<?php echo $supAvatar ?>" width="35px" height="35px" align="">
                              </a>
                          </div>
                          <div class="details">
                              <p>
                                  <a href="catalogue.php?page_id=<?php echo md5($supEmail)?>">
                                      <?php echo $supName ?><br />
                                  <muted><?php echo $supCatalogue ?></muted>
                                  </a>
                              </p>
                          </div>
                      </div>                      
                      <?php } ?>
                  </div><!-- /col-lg-3 -->
              
                  </div>><! --/row -->
          </section>
      </section>
      <!--main content end-->      

      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <i><strong>Powered by iTechHub</strong>. </i>Copyright &copy; 2016
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- INBOX -->
    <script src="assets/scripts/vendors.js"></script>
    <script src="assets/scripts/sc"></script>
    <script src="assets/scripts/perfect-scrollbar.min.js"></script>
    <script src="assets/scripts/waves.min.js"></script>
    <script src="assets/scripts/summernote.min.js"></script>
    <script src="assets/scripts/app.js"></script>
    <script src="assets/scripts/inbox.init.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
  </body>
</html>
  <?php   
  }else{
      header_remove();
      header("location:login.php"); 
  }
  }