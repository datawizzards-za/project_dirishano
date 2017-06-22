<?php
session_start();
include_once('../../include/config.php');

$person = $_GET['id'];

$names = $email = $contact = $gender = $age = $res_addr = "";

$basicInfo = $connection->query("SELECT * FROM jobseeker WHERE EMAIL='$person'");
$certs = $connection->query("SELECT * FROM certificates WHERE PERSON='$person'");
$skills = $connection->query("SELECT * FROM skills WHERE PERSON='$person'"); 

foreach ($basicInfo as $thisPerson){
    $names = $thisPerson['NAMES'];
    $contact = $thisPerson['CONTACT'];
    $gender = $thisPerson['GENDER'];
    $age = $thisPerson['AGE'];
    $res_addr = $thisPerson['RESIDENTIAL'];
}

?>

<br />
<div class="modal-header">
    <h4 class="modal-title centered">
         CV of <?php echo $names ?>
    </h4>
</div>

<div class="modal-body">   
    
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
                            <td>Email Address</td><td><?php echo $person ?></td>
                        </tr>
                        <tr>
                            <td>Physical Address</td><td><?php echo $res_addr ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-primary ng-isolate-scope">
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

    <div class="panel panel-primary ng-isolate-scope">
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
<div class="modal-footer centered">
    <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
</div>