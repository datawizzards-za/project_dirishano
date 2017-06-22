<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../include/config.php');

$username = $_GET['id'];
$password = sanitize_post($_POST['confirm_password']);
$encPass = hashPass($password);

$usrTyp = getUserType($connection, $username);
    
    $theUser = "";
    
    switch ($usrTyp){
        case "client":
            $theUser = $connection->query("UPDATE client SET PASSWORD='$encPass' WHERE EMAILADDRESS='$username'");
            break;
        case "service":
            $theUser = $connection->query("UPDATE serviceprovider SET PASSWORD='$encPass' WHERE EMAILADDRESS='$username'");
            break;
        case "supplier":
            $theUser = $connection->query("UPDATE supplier SET PASSWORD='$encPass' WHERE EMAILADDRESS='$username'");
            break;
        case "JOBSEEKER":
            $theUser = $connection->query("UPDATE JOBSEEKER SET PASSWORD='$encPass' WHERE EMAIL='$username'");
            break;
        case "EMPLOYER":
            $theUser = $connection->query("UPDATE EMPLOYER SET PASSWORD='$encPass' WHERE EMAIL='$username'");
            break;
        default:
            break;
    }
    
    if($theUser){
        passReset($username);
        echo '1';
    }else{
        echo '0';
    }