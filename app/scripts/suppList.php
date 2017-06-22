<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../include/config.php');

$s_var = $_GET['suppEmail'];

$_SESSION['CAT'] = $s_var;

if(isset($_SESSION['CAT'])){
    $GLOBALS['SESSION_CAT'] = $_SESSION['CAT'];
}

echo $GLOBALS['SESSION_CAT'];