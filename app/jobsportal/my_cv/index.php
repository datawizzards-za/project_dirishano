<?php

  session_start();

  require_once('../../include/config.php');
  
  require_once('../cv/include/config.php');
  require_once('../cv/include/language/'.$LANG.'.php');
  require_once('../cv/include/ls_func.php');
  
  $pageID = "";
  $index = "../../jobsportal";
  $logout_path = "../login/logout.php";             
  
  $username = strtolower($_SESSION['username']);
  
  if($username){
      
      $pageID = md5($username); 
      
      $username_session = $username;
            
      $userType = getUserType($connection, $username_session);
      
      //Set Company Name
      $CompName = getCompName($connection, $username_session, $userType);
      $userAvatar = getDIRAvatar($connection, $username_session);
      ?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" type="image/png" href="../../images/icon.png"/>

<title>JMB Jobs Portal | CV </title>
    <?php require_once('../commons/head.php'); ?>
    
    <link type="text/css" rel="stylesheet" href="../cv/styles/pages.css" >
    <script type="text/javascript" language="javascript" src="../cv/scripts/script.php"></script>
    <script type="text/javascript" language="javascript" src="../cv/scripts/MessageBoxes.js"></script>

    <?php if ($JSFX_LinkFader2) { ?>
        <script type="text/javascript" language="javascript" src="../cv/scripts/JSFX_LinkFader2.js"></script>
    <?php } ?>
</head>    
  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <?php require_once ('../../header.php'); ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <?php require_once('../commons/aside.php'); ?>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  
                  <?php 
                    if ($userType == "JOBSEEKER"){
                        include '../views/mycv.php';
                    }else{
                        include '../views/employer.php';
                    }
                  ?>
                  
                  <!-- **********************************************************************************************************************************************************
                  RIGHT SIDEBAR CONTENT
                  *********************************************************************************************************************************************************** -->                    
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                          <?php require_once('../commons/jobslist.php'); ?>                      
                  </div><!-- /col-lg-3 -->
              
              </div><! --/row -->
          </section>
      </section>
      <!--main content end-->      

      <!--footer start-->
      <?php require_once('../../footer.php'); ?>
      <!--footer end-->
  </section>
      
      <!-- Import JS -->
      <?php require_once('../commons/js.php'); ?>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('submit', '#form1', function()
            {
                var data = $(this).serialize();
                $.ajax({
                type : 'POST',
                url  : '../cv/fileup.php',
                data : data,
                success :  function(data){
                    
                    alert(data);
                    
                    /*
                    $("#loading").fadeOut('fast');
                    if(data === "2")
                    {
                        $('#success').show(function()
                            {
                                $("#success_msg").html("Yay! Your account has been created. <br />Please sign in");
                            });
                    }else if(data === "0"){
                        $('#error').show(function()
                        {
                            $("#error_msg").html("Oops! That email address is already registered. <br />Please login, or reset your password.");
                        });
                    }else if(data === "1"){
                        $('#error').show(function()
                        {
                            $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                        });
                    }*/
                }});
                    return false;
            });
    });
    </script>    
    
  </body>
</html>
      <?php }else {
          header("location:$logout_path");      
      }