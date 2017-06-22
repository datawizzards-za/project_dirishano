<?php
session_start();
include_once('../include/config.php');

$job_num = $_GET['id'];

$adTitle = $adDesc = $adLocation = $adContactPerson = $adCellNo = $adEmail = $adPostDate = $adClosinDate = $adPoster = "";

$theAds = $connection->query("SELECT * from jobadverts WHERE ID='$job_num'");

foreach ($theAds as $jobAd){
    $adTitle = $jobAd["TITLE"];
    $adDesc = $jobAd["DESCRIPTION"];
    $adLocation = $jobAd["LOCATION"];
    $adContactPerson = $jobAd["CONTACT"];
    $adCellNo = $jobAd["CELL"];
    $adEmail = $jobAd["EMAIL"];
    $adClosinDate = $jobAd["CLOSINGDATE"];
} ?>

<br />
<div class="modal-header">
    <h4 class="modal-title centered">
        <?php echo $adTitle ?>
    </h4>
</div>

<div class="modal-body centered">
        <div class="col-md-12 alert alert-info text-uppercase text-center hvr-grow">
            <strong><?php echo $adDesc  ?></strong>
        </div>
        <div class="col-md-12 alert alert-info hvr-grow">
            <div class="col-md-6 text-uppercase text-center">
                Where? <br /> <strong> <?php echo $adLocation ?> </strong>
            </div>
            <div class="col-md-6 text-uppercase text-center">
                Closing? <br /> <strong> <?php echo $adClosinDate ?> </strong>
            </div>
        </div>
        <div class="col-lg-12 alert alert-info text-uppercase text-center hvr-grow">
            <div class="col-md-4">
                Contact Person? <br /> <strong> <?php echo $adContactPerson ?> </strong>
            </div>
            <div class="col-md-4">
                Email? <br /> <strong> <?php echo $adEmail ?> </strong>
            </div>
            <div class="col-md-4">
                Cell? <br /> <strong> <?php echo $adCellNo ?> </strong>
            </div>
        </div>
</div>
<div class="modal-footer centered">
    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
</div>