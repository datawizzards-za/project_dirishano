<?php

include_once('../include/config.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cellno = sanitize_post($_POST['cellno']);
  $password = hashPass(sanitize_post($_POST['password']));
  $email = sanitize_post($_POST['email']);
  $comp_name = sanitize_post($_POST['cname']);
  $paddress = sanitize_post($_POST['paddress']);
  $waddress = sanitize_post($_POST['waddress']);
  
  $submitRes = "";

  if ($email == "" || $password == "" || $cellno == "" || $paddress=="" || $comp_name==""){$submitRes = "0";}
  else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){$submitRes = "1";}
      else{
          if (checkUser($connection, $email)){$submitRes = "2";}
          else{
              $createUser = $connection->query("INSERT INTO supplier VALUES('$email', '$comp_name','$waddress','$paddress','$cellno','$password',CURRENT_TIMESTAMP,'supplier','NULL')");
              if(!$createUser){$submitRes = "3";}
              else{$submitRes = "4"; welcomeUser($email);}
          }
      }
  }
  
  echo $submitRes;