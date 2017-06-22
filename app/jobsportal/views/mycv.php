<?php

    $names = $bio = $email = $contact = $cert_name = $cert_year = "";

    //Basic Info
    $person = $connection->query("SELECT * FROM jobseeker where EMAIL='$username'");

    foreach($person as $item){

        $names = $item['NAMES'];
        $age = $item['AGE'];
        $gender = $item['GENDER'];
        $res_addr = $item['RESIDENTIAL'];
        $email = $item['EMAIL'];
        $contact = $item['CONTACT'];
    }
    
    //Certificates
    $certs = $connection->query("SELECT * FROM certificates WHERE PERSON='$username' ORDER BY ID DESC");
    
    //Skills
    $skills = $connection->query("SELECT * FROM skills WHERE PERSON='$username' ORDER BY ID DESC");
        
?>
<div class="col-lg-9 animated fadeInDown">
    <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
      <h1 class="text-center">JMB Jobs Portal: CV 
      </h1>
    </div>
    <br />

    <div class="row mtbox">
        
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab-cv" data-toggle="tab">My Cv</a>
            </li>
            <li>
                <a href="#tab-cvbasic" data-toggle="tab">Basic Info</a>
            </li>
            <li>
                <a href="#tab-cvcert" data-toggle="tab">Qualifications</a>
            </li>
            <li>
                <a href="#tab-cvskills" data-toggle="tab">Skills</a>
            </li>
            <li>
                <a href="#tab-cvdoc" data-toggle="tab">Upload CV</a>
            </li>
        </ul>
        <div class="tab-content">
            
            <div class="tab-pane active animated fadeInDown" id="tab-cv">
                <div class="clearfix">
                    <div class="panel-group" id="accordionDemo">
                        <div class="panel panel-primary ng-isolate-scope">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseBasic" data-toggle="collapse" class="accordion-toggle text-uppercase" data-parent="#accordionDemo">
                                        Basic Information
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapseBasic">
                                <div class="panel-body">                                    
                                    <table class="table table-hover table-condensed">
                                        <tbody>
                                            <tr>
                                                <td>Full Names</td><td> <?php echo $names ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td><td><?php echo $gender ?></td>
                                            </tr>
                                            <tr>
                                                <td>Age</td><td><?php echo $age ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No.</td><td><?php echo $contact ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Address</td><td><?php echo $username ?></td>
                                            </tr>
                                            <tr>
                                                <td>Physical Address</td><td><?php echo $res_addr ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-info ng-isolate-scope">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseCert" data-toggle="collapse" class="accordion-toggle" data-parent="#accordionDemo">
                                        QUALIFICATIONS AND CERTIFICATES
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseCert">
                                <div class="panel-body">  
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td><strong>Name</strong></td>
                                                <td> <strong> Year </strong> </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($certs as $degree){ ?>
                                            <tr>
                                                <td> <?php echo $degree["NAME"] ?> </td>
                                                <td> <?php echo $degree["YEAR"] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-success ng-isolate-scope">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseSkills" data-toggle="collapse" class="accordion-toggle text-uppercase" data-parent="#accordionDemo">
                                        SKILLS AND COMPETENCY
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseSkills">
                                <div class="panel-body">                                    
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td><strong>Skill</strong></td>
                                                <td> <strong> Competency  </strong> </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($skills as $degree){ ?>
                                            <tr>
                                                <td> <?php echo $degree["SNAME"] ?> </td>
                                                <td> <?php echo $degree["COMPETENCY"] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane animated fadeInDown" id="tab-cvbasic">
            <div class="clearfix">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <strong> Basic Info </strong>
                    </div>
                    <div class="panel-body">
                        <div class=" col-md-12">                               
                            <div id="_loading" class="text-center" hidden>
                                <img src="../../images/preloader.gif" height="64" width="64" alt="">
                                <br />
                                <br />
                            </div>

                            <div id="_success" class='col-lg-12 fadeInDownBig animated centered' hidden>
                                <div id="success_msg" class="alert alert-success text-center text-bold text-desc"></div>
                            </div>

                            <div id="_error" class='col-lg-12 centered fadeInUpBig animated' hidden>
                                <div id="error_msg" class="alert alert-danger text-center text-bold text-desc"></div>
                            </div>
                        </div>
                        
                        <form id="js_basic_info" method="POST">                        
                            <div class=" col-md-4">
                                <input class="form-control centered" type="text" name="names"  placeholder="<?php echo $names; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <select id="genderSelect" name="gender" style="width: 100%" data-placeholder="Select Gender" required>
                                        <option><?php echo $gender==''?'':$gender?></option>	<!-- empty, for placeholder -->
                                        <option value="1">Female</option>
                                        <option value="2">Male</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control centered" type="text" name="age" placeholder="<?php echo $age==''?'Enter your Age':$age?>" required>
                            </div>
                            <hr /> <hr >
                            <div class=" col-md-4">
                                <input class="form-control centered" type="text" name="phone_no" placeholder="<?php echo $contact==''?'Enter your Phone No.':$contact?>" required>
                            </div>
                            <div class=" col-md-8">
                                <input class="form-control centered" type="text" name="res_addr" placeholder="<?php echo $res_addr==''?'Enter your Residential Address':$res_addr?>" required>
                            </div>
                            <div class=" col-md-12">
                                <div class=" col-md-6"></div>
                                <div class=" col-md-6">
                                    <br />
                                    <button type="submit" class="btn btn-primary text-uppercase right">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>                
            </div>
                        
            <div class="tab-pane animated fadeInDown" id="tab-cvcert">
                <div class="clearfix">
                 <div class="panel panel-primary">                    
                    <div class="panel-heading text-center">
                        <strong> Qualifications and Certificates</strong>
                    </div>
                     
                     <form id="add_certificates" method="POST">   
                    <div class="panel-body"> 
                        <div class=" col-md-12">                               
                            <div id="c_loading" class="text-center" hidden>
                                <img src="../../images/preloader.gif" height="64" width="64" alt="">
                                <br />
                                <br />
                            </div>

                            <div id="c_success" class='col-lg-12 fadeInDownBig animated centered' hidden>
                                <br />
                                <div id="csuccess_msg" class="alert alert-success text-center text-uppercase text-bold text-desc"></div>
                            </div>

                            <div id="c_error" class='col-lg-12 centered fadeInUpBig animated' hidden>
                                <br />
                                <div id="cerror_msg" class="alert alert-danger text-uppercase text-center text-bold text-desc"></div>
                            </div>
                        </div>  
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="cert_name" placeholder="Centificate Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="cert_year" placeholder="Year Obtained" required>
                        </div>                            
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </button>
                        </div>
                    </div>
                     </form>
                    <div class="panel-body">                         
                        <div class=" col-md-1"></div>                     
                        <div class=" col-md-10">
                            <div class="list-group">
                                <form id="del_cert" method="POST">   
                                <?php 
                                    foreach($certs as $item){
                                        $cert_name = $item['NAME'];
                                        $cert_year = $item['YEAR'];
                                    
                                    ?>
                                    <input type="hidden" class="form-control" name="cert_id" value="<?php echo $item['ID']; ?>">
                                    
                                    <a class="list-group-item hvr-grow">
                                        <?php echo $cert_name.", ".$cert_year; ?>
                                        <button type="submit" class="close" >
                                                <span aria-hidden="true">X</span>
                                        </button>
                                    </a>
                                    <?php } ?>
                                </form>
                            </div>                            
                        </div>              
                        <div class=" col-md-1"></div>  
                    </div>
                 </div>
                </div>
            </div>
            
            <div class="tab-pane animated fadeInDown" id="tab-cvskills">
                <div class="clearfix">
                 <div class="panel panel-primary">                    
                    <div class="panel-heading text-center">
                        <strong> Skills and Competency</strong>
                    </div>   
                    <div class="panel-body">                   
                        <div class="col-md-12">                               
                            <div id="s_loading" class="text-center" hidden>
                                <img src="../../images/preloader.gif" height="64" width="64" alt="">
                            </div>

                            <div id="s_success" class='col-lg-12 fadeInDownBig animated centered' hidden>
                                <div id="ssuccess_msg" class="alert alert-success text-center text-uppercase text-bold text-desc"></div>
                            </div>

                            <div id="s_error" class='col-lg-12 centered fadeInUpBig animated' hidden>
                                <div id="serror_msg" class="alert alert-danger text-uppercase text-center text-bold text-desc"></div>
                            </div>
                        </div>
                        <form id="add_skill" class="form-inline" method="POST">
                            <div class="col-md-2"></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="skill_name" class="form-control" placeholder="Enter Skill" required>
                                </div>

                                <div class="form-group">
                                    <select id="skillsSelect" name="skill_level" style="width: 100%" data-placeholder="Competency" required>
                                        <option></option>	<!-- empty, for placeholder -->
                                        <option value="Begginer">Begginer</option>
                                        <option value="Intermideiate">Intermideiate</option>
                                        <option value="Professional">Professional</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>
                        </form> 
                    </div>
                     <div class="panel-body">                         
                        <div class=" col-md-1"></div>                     
                        <div class=" col-md-10">
                            <div class="list-group">
                                <form id="del_skill" method="POST">   
                                <?php 
                                    foreach($skills as $item){
                                        $skill_name = $item['SNAME'];
                                        $skill_level = $item['COMPETENCY'];
                                    
                                    ?>
                                    <input type="hidden" class="form-control" name="skill_id" value="<?php echo $item['ID']; ?>">
                                    
                                    <a class="list-group-item hvr-grow">
                                        <?php echo $skill_name.", ".$skill_level; ?>
                                        <button type="submit" class="close" >
                                                <span aria-hidden="true">X</span>
                                        </button>
                                    </a>
                                    <?php } ?>
                                </form>
                            </div>                            
                        </div>              
                        <div class=" col-md-1"></div>  
                     </div>
                </div>
                </div>
            </div>

            <div class="tab-pane animated fadeInDown" id="tab-cvdoc">
                <!-- Basic Table -->
                <div class="panel ">
                    <div class="panel-body fadeInDown animated">
                         <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-center text-uppercase"><strong>Please come back later.</strong>
                                    </td>
                                </tr>
                            </thead>
                         </table>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- /row mt -->	                      
</div><!-- /col-lg-9 END SECTION MIDDLE -->

<!-- **********************************************************************************************************************************************************
RIGHT SIDEBAR CONTENT
*********************************************************************************************************************************************************** -->                    
<div class="col-lg-3 ds">
    <!-- USERS ONLINE SECTION -->
    <?php include './jobslist.php'; ?>                      
</div><!-- /col-lg-3 -->