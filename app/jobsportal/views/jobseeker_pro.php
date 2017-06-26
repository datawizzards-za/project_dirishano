<?php

    $names = $bio = $email = $contact = "";

    $person = $connection->query("SELECT * FROM jobseeker where EMAIL='$username'");

    foreach($person as $item){

        $names = $item['NAMES'];
    }
?>

<!-- tab style -->
<div class="clearfix">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-editprofile" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>EDIT PROFILE</a></li>
        <li><a href="#tab-avatar" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>PROFILE PHOTO</a></li>
        <li><a href="#tab-changepass" data-toggle="tab"><span class="ion ion-person-add">&nbsp;&nbsp;</span>CHANGE PASSWORD</a></li>
    </ul>
    <div class="tab-content">

        <!-- Edit Profile -->
        <div class="tab-pane active animated fadeInDown" id="tab-editprofile">
            <div class="clearfix">
                <!-- Basic Table -->
                <form id="edit_js_pro" method="POST">
                    <div class=" col-md-12">      
                        <div id="pro_loading" class="text-center" hidden>
                            <br />
                            <img src="../../images/preloader.gif" height="64" width="64" alt="">
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
                    <div class="col-md-12">

                        <!-- ########### PANEL BODY -->
                        <div class="panel-body hvr-grow" >                                                
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="col-md-6 has-success focus centered">
                                                <input class="form-control centered" type="text" id="js_names" name="js_names" value='<?php echo $names;?>' required>   
                                                <br />
                                            </div>
                                            <div class="col-md-6 has-success focus centered">
                                                <input class="form-control centered" type="text" value='<?php echo $username;?>' required disabled="">   
                                                <br />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-container col-md-6">
                                                <button type="submit" class="btn btn-primary btn-block text-uppercase" name="update_pro">
                                                    UPDATE
                                                </button>
                                                <br />
                                            </div>
                                            <div class="form-container col-md-6">
                                                <button type="submit"
                                                        class="btn btn-danger btn-block text-uppercase " name="remove_pro">
                                                    remove profile
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>                            
        <div class="tab-pane animated fadeInDown" id="tab-avatar">
            <div class="row mt clearfix">
                <!-- Basic Table -->
                <div class="col-md-12 ">
                        <div class="col-lg-3"></div>

                        <! -- PROFILE 02 PANEL -->
                        <div class="col-lg-6 col-md-6 col-sm-6 mb">

                            <div id="pic_loading" class="text-center" hidden>
                                <img src="../../images/preloader.gif" height="64" width="64" alt="">
                                <br />
                                <br />
                            </div>

                            <div id="pic_error" class="col-lg-12 centered" hidden>
                                <div id="error_msg" class="alert alert-danger text-center text-bold text-desc fadeInDownBig animated "></div>                                                        
                            </div>

                            <div id="pic_success" class='col-lg-12 centered' hidden>
                                <div id="success_msg" class="alert alert-success text-center text-bold text-desc fadeInUpBig animated"></div>
                            </div>
                            
                            
                            <div class="alert alert-info text-center text-bold text-desc">
                                Click on the image to upload new.
                            </div>   

                            <form id="changeImage" enctype="multipart/form-data">
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

        <div class="tab-pane animated fadeInDown" id="tab-changepass">
            <div class="panel-body hvr-grow">
                <form method="POST" id="changeJobsPass">

                    <div id="loading" class="text-center" hidden>
                        <img src="../../images/preloader.gif" height="64" width="64" alt="">
                        <br />
                        <br />
                    </div>

                    <div id="pass_error" class="col-lg-12 centered" hidden>
                        <div id="pass_error_msg" class="alert alert-danger text-center text-bold text-desc fadeInUpBig animated "></div>                                                            
                    </div>

                    <div id="pass_success" class='col-lg-12 centered' hidden>
                        <div id="pass_success_msg" class="alert alert-success text-center text-bold text-desc fadeInDownBig animated"></div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="has-success focus col-md-3">
                                            <input class="form-control centered" type="password" name="old_password" id="old_password" placeholder="Enter Existing Password" required>
                                            <br />
                                        </div>
                                        <div class="has-success focus col-md-3">
                                            <input class="form-control centered" type="password" name="password" id="password" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
                                            <br />
                                        </div>
                                        <div class="has-success focus col-md-3">
                                            <input class="form-control centered" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
                                            <br />
                                        </div>
                                        <div class="form-container col-md-3">
                                            <button name="update_pass" id="update_pass" type="submit" class="btn btn-primary btn-block text-uppercase">
                                                Change
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="has-success col-lg-12">
                                            <div id="passError" class="alert alert-danger text-center text-desc col-lg-12" hidden>
                                                Oops! Passwords do not match.
                                            </div>   
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>