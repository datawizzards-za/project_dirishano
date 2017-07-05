<?php
session_start();
include_once('../include/config.php');

$d = $_GET['id'];

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
        Showing 
    </h4>
</div>

<div class="modal-body centered">
       
                    <table class="table" id="table_vivio">
                        <thead> 
                            <tr>
                                <td class="text-center">
                                    <strong>JOB TITLE</strong>
                                </td>
                                <td class="text-center">
                                    <strong>SKILLS REQUIRED</strong>
                                </td>
                                <td class="text-center">
                                    <strong>LOCATION</strong>
                                </td>
                                <td class="text-center" id="search_id">

                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="alert alert-info text-uppercase text-center hvr-grow" style="margin: 10px">
                                <td class="col-md-4">
                                    <div>
                                        <strong><?php echo $value_jobs['TITLE'];?></strong>
                                    </div>
                                </td>
                                <td class="col-md-4">
                                    <div>
                                        <strong><?php echo $value_jobs['LOCATION'];?></strong>
                                    </div>
                                </td>
                                <td class="col-md-3">
                                    <div>
                                        <strong><?php echo $value_jobs['LOCATION'];?></strong>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <div>
                                        <a data-toggle="modal" data-target="#job_full" href="modal_ad.php?id=<?php echo $sessionJob?>" class="list-group-item active">VIEW</a>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
</div>
<div class="modal-footer centered">
    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
</div>