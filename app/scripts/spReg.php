<?php

include_once('../include/config.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cellno = sanitize_post($_POST['cellno']);
  $pass = sanitize_post($_POST['password']);
  $email = sanitize_post($_POST['email']);
  $comp_name = sanitize_post($_POST['cname']);
  $paddress = sanitize_post($_POST['pAddress']);
  $webAddress = sanitize_post($_POST['wAddress']);
  $tradeas = sanitize_post($_POST['tradeas']);
  $cregno = sanitize_post($_POST['cregno']);
  $taxreg = sanitize_post($_POST['taxreg']);
  
  $submitRes = "";

  if ($email == "" || $pass == "" || $cellno == "" || $paddress=="" || $comp_name=="" || $taxreg=="" || $cregno=="" || $tradeas==""){$submitRes = "0";}
  else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$submitRes = "1";}
      else{
          if (checkUser($connection, $email)){$submitRes = "2";}
          elseif (checkTaxNum($connection, $taxreg)){$submitRes = "5";}
          elseif (checkCK($connection, $cregno)){$submitRes = "6";}
          else{
              $password = hashPass($pass);
              $createUser = $connection->query("INSERT INTO serviceprovider VALUES('$email', '$comp_name','$tradeas','$paddress', '$webAddress', '$cellno','$cregno','$taxreg', '', '', '', '$password',CURRENT_TIMESTAMP,'service','NULL')");
              if(!$createUser){
                  $submitRes = "3";
              }else{
                  $submitRes = "4"; 
                  welcomeUser($email);
              }
          }
      }
  }
  
  echo $submitRes;