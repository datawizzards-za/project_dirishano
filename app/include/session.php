<?php
    
if(!isset($_SESSION['username'])){
    session_start();
    if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == ''))
    {
        header('location:login/');
        exit();
    }
    $session_name = $_SESSION['username'];
}

$session_name = $_SESSION['username'];