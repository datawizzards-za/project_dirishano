<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once('../include/config.php');

$usr = $_SESSION['username'];
$username = strtolower($usr);
   
$pass = sanitize_post($_POST['usrpass']);

$password = passAuth($connection, $username, $pass);            
    
$results = $connection->query("SELECT EMAILADDRESS,PASSWORD FROM clients where EMAILADDRESS='$username' and PASSWORD='$password'
                                UNION SELECT EMAILADDRESS,PASSWORD FROM supplier where EMAILADDRESS='$username' and PASSWORD='$password' 
                                UNION SELECT EMAILADDRESS,PASSWORD FROM serviceprovider where EMAILADDRESS='$username' and PASSWORD='$password'");

    if($results){
        create_dirs($connection, $username);
        echo md5($username);
    }  else {
        echo 0;
    }

$connection->close();