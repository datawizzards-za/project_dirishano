<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once('../include/config.php');

$username = $_SESSION['username'];

$jobDuration = sanitize_post($_POST['jobDuration']);
$jobTitle = sanitize_post($_POST['jobTitle']);
$jobDesc = sanitize_post($_POST['jobDesc']);
$jobLocation = sanitize_post($_POST['jobLocation']);

$submitRes = "";


if ($jobDuration == "" || $jobTitle == "" || $jobDesc == "" || $jobLocation == ""){$submitRes = "0";}
else{
    
    $logJob = $connection->query("INSERT INTO jobs(`EMAILADDRESS`, `TIMEPOSTED`, `JOB_TITLE`, `JOB_DESC`, `JOB_DURATION`, `JOB_LOCATION`) VALUES('$username', CURRENT_TIMESTAMP,'$jobTitle','$jobDesc','$jobDuration','$jobLocation')");
    
    if($logJob)
    {
        #In app Notifications
        $allSPs = $connection->query("SELECT EMAILADDRESS, TRADEAS from serviceprovider");
        
        foreach($allSPs as $email_info ){
            $to_user = $email_info['EMAILADDRESS'];
            $messages = "New Service Request. Hurry and place your best bid.";
            $connection->query("INSERT INTO notifications(`FROM_USER`, `TO_USER`, `MESSAGE`, `STATUS`, `TIMEPOST`) VALUES('$username','$to_user','$messages','0',CURRENT_TIMESTAMP)");
        }
        
        $submitRes = "1";
                
        $clientName = "";
        $getClient = $connection->query("SELECT REGNAME FROM clients WHERE EMAILADDRESS='$username'");
        foreach ($getClient as $cl){$clientName = $cl['REGNAME'];}
        
        $notifyAll = notifyAll($allSPs, $jobTitle, $jobDesc, $jobLocation, $clientName,$connection);                
        
        if(!$notifyAll){$submitRes = "2";}
    }else{
        $submitRes = "3";
    }
}

echo $submitRes;