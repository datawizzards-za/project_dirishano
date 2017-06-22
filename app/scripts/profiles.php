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


$switch = $_GET['switch'];

switch ($switch) {
    case "CL":
        echo editCL($username, $connection);
        break;
    
    case "SP":
        echo editSP($username, $connection);
        break;
    
    case "SUP":
        echo editSUP($username, $connection);
        break;
    
    default:
        break;
}

