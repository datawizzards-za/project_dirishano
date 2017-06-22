<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../include/config.php');

$usr = sanitize_post($_POST['username']);
$username = strtolower($usr);

if(filter_var($username, FILTER_VALIDATE_EMAIL)){
$user = "";
   
$pass = sanitize_post($_POST['password']);

$password = passAuth($connection, $username, $pass);            
    
$results = $connection->query("SELECT EMAILADDRESS,PASSWORD FROM clients where EMAILADDRESS='$username' and PASSWORD='$password'
                                UNION SELECT EMAILADDRESS,PASSWORD FROM supplier where EMAILADDRESS='$username' and PASSWORD='$password' 
                                UNION SELECT EMAILADDRESS,PASSWORD FROM serviceprovider where EMAILADDRESS='$username' and PASSWORD='$password'");

    if($results->num_rows > 0){
        create_dirs($connection, $username);
        setSession($username);
        echo md5($username);
    }  else {
        echo FALSE;
    }

$connection->close();
}else{ echo 2; }