<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('../include/config.php');
session_start();

$username = $_SESSION['username'];

$switch = $_GET['switch'];

switch ($switch) {
    case "basic":
        echo editBasicInfo($username, $connection);
        break;
    
    case "cert":
        echo addCertificate($username, $connection);
        break;
    
    case "skills":
        echo addSkill($username, $connection);
        break;
    
    default:
        break;
}

