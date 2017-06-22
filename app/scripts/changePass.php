<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('../include/config.php');
session_start();

$username = $_SESSION['username'];

$usrTyp = getUserType($connection, $username);


$submitRes = "0";

$oldpass = sanitize_post($_POST['old_password']);
$npass = sanitize_post($_POST['password']);
$cpass = sanitize_post($_POST['confirm_password']);

$theUser = $encPass = "";

if($npass == $cpass){
    
    switch ($usrTyp){
        case "client":
            $theUser = $connection->query("SELECT PASSWORD FROM clients where EMAILADDRESS='$username'");
            break;
        case "service":
            $theUser = $connection->query("SELECT PASSWORD FROM serviceprovider where EMAILADDRESS='$username'");
            break;
        case "supplier":
            $theUser = $connection->query("SELECT PASSWORD FROM supplier where EMAILADDRESS='$username'");
            break;
        case "JOBSEEKER":
            $theUser = $connection->query("SELECT PASSWORD FROM jobseeker where EMAIL='$username'");
            break;
        case "EMPLOYER":
            $theUser = $connection->query("SELECT PASSWORD FROM employer where EMAIL='$username'");
            break;
        default:
            break;
    }
    
    if($theUser->num_rows > 0){
        foreach ($theUser as $client){
            $encPass = $client['PASSWORD'];            
            if ($oldpass == unhashPass($encPass)){
                $submitRes = "1";
                break;}}
                
        if($submitRes){
            $cpass = hashPass($npass);
            $updPass = ""; 
            
            switch ($usrTyp){
                case "client":
                    $updPass = $connection->query("UPDATE clients SET PASSWORD='$cpass' WHERE EMAILADDRESS='$username'"); 
                    break;
                case "service":
                    $updPass = $connection->query("UPDATE serviceprovider SET PASSWORD='$cpass' WHERE EMAILADDRESS='$username'"); 
                    break;
                case "supplier":
                    $updPass = $connection->query("UPDATE supplier SET PASSWORD='$cpass' WHERE EMAILADDRESS='$username'");
                    break;
                case "JOBSEEKER":
                    $updPass = $connection->query("UPDATE jobseeker SET PASSWORD='$cpass' WHERE EMAIL='$username'");
                    break;
                case "EMPLOYER":
                    $updPass = $connection->query("UPDATE employer SET PASSWORD='$cpass' WHERE EMAIL='$username'");
                    break;
                default:
                    break;
            }
            
            if($updPass){$submitRes = "1";}else{$submitRes = "2";}
            
        }else{$submitRes = "0";}
    }
}else{
    $submitRes = "3";
}

echo $submitRes;

