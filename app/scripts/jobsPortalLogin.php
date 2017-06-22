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
    
    
    $results = $connection->query("SELECT EMAIL,PASSWORD FROM jobseeker where EMAIL='$username' and PASSWORD='$password'
                                   UNION SELECT EMAIL,PASSWORD FROM employer where EMAIL='$username' and PASSWORD='$password'");

        if($results-> num_rows > 0){
            create_dirs($connection, $username);
            echo setSession($username);
            //echo md5($username);
        }else {
            echo 0;
        } 

    $connection->close();
}else{ echo 2; }