<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once('../include/config.php');

$job_ref = sanitize_post($_POST['job_ref']);
$projLen = sanitize_post($_POST['proj_len']);
$price = sanitize_post($_POST['price']);
$location = sanitize_post($_POST['location']);
$job_bidder = sanitize_post($_POST['job_bidder']);
$detailed_price = sanitize_post($_POST['priceBreakdown']);

$submitRes = "";

if ($job_ref == "" || $projLen == "" || $price == "" || $location == "" || $job_bidder == "" || $detailed_price == "")
    {$submitRes = "0";}
else{    
    $bidJob = $connection->query("INSERT INTO bids VALUES ('','$job_ref','$job_bidder','0','$price','$location','$projLen', '$detailed_price',CURRENT_TIMESTAMP)");
    
    if($bidJob){
        
        $submitRes = "1";
        
        $jobDetails = $connection->query("SELECT jobs.EMAILADDRESS, JOB_TITLE, TRADEAS, PHONENUMBER, BIDDER, BID_AMOUNT, BID_LOCATION, REGNAME FROM serviceprovider 
                                        INNER JOIN bids ON serviceprovider.EMAILADDRESS=bids.BIDDER 
                                        INNER JOIN jobs ON bids.JOB_ID=jobs.JOB_ID 
                                        INNER JOIN clients ON jobs.EMAILADDRESS=clients.EMAILADDRESS
                                        WHERE serviceprovider.EMAILADDRESS='$job_bidder' AND jobs.JOB_ID=$job_ref");

    if($jobDetails -> num_rows > 0 ) {
       $notifyResults = notifyClient($jobDetails);        
    }else {}
}else{
    $submitRes = "2";
}
}

echo $submitRes;