<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../app/include/config.php');

$usr = sanitize_post($_POST['username']);
$username = strtolower($usr);

if(filter_var($username, FILTER_VALIDATE_EMAIL)){
$user = "";
   
$pass = sanitize_post($_POST['password']);

$password = passAuth($connection, $username, $pass);            
    
$results = $connection->query("SELECT EMAILADDRESS,PASSWORD FROM jobseekers where EMAILADDRESS='$username' and PASSWORD='$password'
                                UNION SELECT EMAILADDRESS,PASSWORD FROM employers where EMAILADDRESS='$username' and PASSWORD='$password'");

    if($results-> num_rows > 0){
        create_dirs($connection, $username);
        echo md5($username);
    }  else {
        echo FALSE;
    }

$connection->close();
}else{ echo 2; }