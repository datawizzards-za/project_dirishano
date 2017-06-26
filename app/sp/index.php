<?php
session_start();
include_once('../include/config.php');

$username = $username_session = $_SESSION['username'];
$pageID = md5($username_session);

$noteID = "";
$logout_path = "../logout.php";

$index = "../";

if (!isset($username_session))
{
      header("location: $logout_path");
}else{
    //Get User Type
    $userType = getUserType($connection, $username);
    
    //Set Company Name
    $CompName = getCompName($connection, $username, $userType);
    $userAvatar = getDIRAvatar($connection, $username);
    
    if(isset($_POST['update_pro'])){
        $paddress = sanitize_post($_POST['paddress']);
        $telephone = sanitize_post($_POST['telephone']);
        $connection->query("UPDATE serviceprovider SET PADDRESS='$paddress',PHONENUMBER='$telephone' WHERE EMAILADDRESS='$username'");
    }
    
    if(isset($_GET['note_id'])){
        $noteID = stripcslashes($_GET['note_id']);
        if($noteID!=""){
            $connection->query("UPDATE `notifications` SET `STATUS`='1' WHERE `NOTIFICATION_ID`='$noteID'");
        }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

<title>JMB Online | Profile </title>
    <?php require_once('../commons/css.php') ?>
</head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
        <?php require '../commons/header.php'; ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
        <?php require '../commons/aside.php'; ?>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-9 main-chart animated fadeInDown"> 
                      <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
                          <h1 class="text-center">JMB Online: Profile</h1>
                      </div>                  
                    <div class="row">
                    <!-- dashboard header -->
                    <div class="col-md-12">
                    <div class="dash-head clearfix mt15 mb20 ">
                    <!-- tab style -->
                    <div class="clearfix">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-myprofile" data-toggle="tab"><span class="ion ion-person">&nbsp;&nbsp;</span>MY PROFILE</a></li>
                            <li><a href="#tab-editprofile" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>EDIT PROFILE</a></li>
                            <li><a href="#tab-avatar" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>PROFILE PHOTO</a></li>
                            <li><a href="#tab-changepass" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>CHANGE PASSWORD</a></li>
                        </ul>
                        <div class="tab-content">
                            
                            <!-- My profile Tab -->
                            <div class="tab-pane active animated fadeInDown" id="tab-myprofile">
                                <div class="clearfix">
                                    <!-- #end profile-picture -->
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-body" style="font-size:10pt;">
                                                <table class="table">
                                                   <?php
                                                  $results = $connection->query("SELECT * FROM serviceprovider where EMAILADDRESS='$username'");
                                                                                      
                                                  foreach($results as $item){
                                                  ?>
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td><td><?php echo $item['COMPANYNAME'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trading As</td><td><?php echo $item['TRADEAS'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Physical Address</td><td><?php echo $item['PADDRESS'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email Address</td><td><?php echo $item['PHONENUMBER'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Website</td><td><?php echo $item['WEBADDRESS'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contact Number</td><td><?php echo $item['EMAILADDRESS'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company Reg. No.</td><td><?php echo $item['COMPREGNO'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tax Ref. No.</td><td><?php echo $item['TAXREGNO'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>VAT No.</td><td><?php echo $item['VATNO'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>CIBD No.</td><td><?php echo $item['CIBDNO'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>NHBRC No.</td><td><?php echo $item['NHBRCNO'];?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                                                                 
                            <!-- Edit Profile -->
                            <div class="tab-pane animated fadeInDown" id="tab-editprofile">
                                <div class="clearfix">
                                    <!-- Basic Table -->
                                    <form id="editSP" method="POST">
                                        <div class=" col-md-12"> 
                                            <!--
                                                #########################################
                                                    LOADING ICON and Feedback
                                                ##########################################
                                            -->                                                
                                            <div id="pro_loading" class="text-center" hidden>
                                                <br />
                                                <img src="../images/preloader.gif" height="64" width="64" alt="">
                                                <br />
                                                <br />
                                            </div>

                                            <div id="pro_success" class='col-lg-12 fadeInDownBig animated centered' hidden>
                                                <br />
                                                <div id="pro_success_msg" class="alert alert-success text-center text-bold text-desc"></div>
                                            </div>

                                            <div id="pro_error" class='col-lg-12 centered fadeInUpBig animated' hidden>
                                                <br />
                                                <div id="pro_error_msg" class="alert alert-danger text-center text-bold text-desc"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                                                              
                                                <!-- ########### PANEL BODY -->
                                                <div class="panel-body" style="font-size:10pt;">                                                
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <input class="form-control centered" type="text" name="tradeAs" value='<?php echo $item['TRADEAS'];?>' required>                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="text" name="pAddress" value='<?php echo $item['PADDRESS'];?>' required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                       <?php echo $item['EMAILADDRESS'];?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="text" name="telNo" value='<?php echo $item['PHONENUMBER'];?>' required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <input class="form-control centered" type="text" name="website" value='<?php if($item['WEBADDRESS'] == ''){echo 'VAT No.';}else{echo $item['WEBADDRESS'];}?>' required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-body" style="font-size:10pt;">
                                      
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <?php echo $item['COMPREGNO'];?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <br />
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <?php echo $item['TAXREGNO'];?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus centered">
                                                                        <input class="form-control centered" type="text" name="vatNo" value="<?php if($item['VATNO'] == ''){echo 'VAT No.';}else{echo $item['VATNO'];}?>" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="text" name="cibdNo" value="<?php if($item['CIBDNO'] == ''){echo 'CIBD No.';}else{echo $item['CIBDNO'];}?>" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="text" name="nhbrcNo" value="<?php if($item['NHBRCNO'] == ''){echo 'NHBRC No.';}else{echo $item['NHBRCNO'];}?>" required>
                                                                    </div>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                            
                                            </div>
                                        </div>
                                    </div> <!-- #end todo-list -->
                                    <div class="form-container" style="float: right; width:50%">
                                        <button name="update_pro" type="submit" class="btn btn-primary btn-block text-uppercase btn-lg">
                                            UPDATE
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>                            
                            <div class="tab-pane animated fadeInDown" id="tab-avatar">
                                <div class="row mt clearfix">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <br />
                                            </div>
                                            
                                            <! -- PROFILE 02 PANEL -->
                                            <div class="col-lg-6 mb">
                                                
                                                <div id="pic_loading" class="text-center" hidden>
                                                    <img src="../images/preloader.gif" height="64" width="64" alt="">
                                                    <br />
                                                    <br />
                                                </div>
                                                
                                                <div id="pic_error" class="col-lg-12 centered" hidden>
                                                    <div id="error_msg" class="alert alert-danger text-center text-bold text-desc fadeInDownBig animated "></div>                                                        
                                                </div>
                                                
                                                <div id="pic_success" class='col-lg-12 centered' hidden>
                                                    <div id="success_msg" class="alert alert-success text-center text-bold text-desc fadeInUpBig animated"></div>
                                                </div>
                                                
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                      <img height="250px" width="100%" id="previewing" src="<?php echo $userAvatar; ?>" />
                                                  <div id="selectImage">
                                                    <input type="file" name="file" class="hidden" id="file" required />
                                                    <div class="col-lg-4"> <br /> </div>
                                                    <div id="btnSave" class="col-lg-4">
                                                        <br />
                                                        <input type="submit" value="Save" class="btn btn-lg btn-primary" />                                                            
                                                    </div>
                                                  </div>
                                                </form>
                                            </div><!--/ col-md-4 -->
                                            
                                            <div class="col-lg-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane animated fadeInDown" id="tab-changepass">
                                <div class="clearfix">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-body">
                                                <form method="POST" id="changePass">
                                                    
                                                    <div id="loading" class="text-center" hidden>
                                                        <img src="../images/preloader.gif" height="64" width="64" alt="">
                                                        <br />
                                                        <br />
                                                    </div>
                                                    
                                                    <div id="pass_error" class="col-lg-12 centered" hidden>
                                                        <div id="pass_error_msg" class="alert alert-danger text-center text-bold text-desc fadeInUpBig animated "></div>                                                            
                                                    </div>
                                                    
                                                    <div id="pass_success" class='col-lg-12 centered' hidden>
                                                        <div id="pass_success_msg" class="alert alert-success text-center text-bold text-desc fadeInDownBig animated"></div>
                                                    </div>
                                                    
                                                    <div class="col-md-2"> <br /> </div>
                                                    <div class="col-md-8">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="password" id="old_password" name="old_password" placeholder="Enter Existing Password" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="password" id="password" name="password" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="has-success focus">
                                                                        <input class="form-control centered" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
                                                    <p id="passError" class="text-danger text-center" hidden><br /> Oops! Passwords do not match.</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-container">
                                                                        <button name="update_pass" id="update_pass" type="submit" class="btn btn-primary btn-block text-uppercase">
                                                                            Change
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                                    <div class="col-md-2"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- #end todo-list -->
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div> <!-- #end row -->
                  <!-- #end row -->                      
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  <div class="col-lg-3 ds">
                      <!-- USERS ONLINE SECTION -->
                      <?php require_once '../commons/suplist.php'; ?>
                  </div><!-- /col-lg-3 -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <?php require_once('../footer.php') ?>
      <!--footer end-->
  </section>
      
    <!-- Import JS  -->
    <?php require_once '../commons/js.php'; ?>   

    <script type="text/javascript">
            $("#uploadFilec").click(
                    function(e){
                        $("#uploadFile").click();
                        $('#previewing').attr('src', e.target.result);
                    });
                    
            $("#previewing").click(
                    function(e){
                        $("#file").click();
                    });
    </script>
    
    

  

  </body>
</html>
  <?php }
