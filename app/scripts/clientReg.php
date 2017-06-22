<?php
include_once('../include/config.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $cellno = sanitize_post($_POST['cellno']);
  $password = sanitize_post($_POST['password']);
  $hashedPass = hashPass($password);
  $email = sanitize_post($_POST['email']);
  $comp_name = sanitize_post($_POST['cname']);
  $paddress = sanitize_post($_POST['paddress']);
  
  $submitRes = "";

  if ($email == "" || $password == "" || $cellno == "" || $paddress=="" || $comp_name==""){ $submitRes = "0";}
  else{      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $submitRes = "1";
          }else{
              if (checkUser($connection, $email)){$submitRes = "2";}
              else{
              $createUser = $connection->query("INSERT INTO clients(`EMAILADDRESS`, `REGNAME`, `ADDRESS`, `CONTACTNO`, `PASSWORD`, `TIMEREG`, `TYPE`, `AVATAR`)VALUES('$email', '$comp_name','$paddress','$cellno','$hashedPass',CURRENT_TIMESTAMP,'client','NULL')");
              if(!$createUser){ $submitRes = "3"; }else{
                  $submitRes = "4";
                  welcomeUser($email);                  
              }
          }
        }
  }
  
  echo $submitRes;
