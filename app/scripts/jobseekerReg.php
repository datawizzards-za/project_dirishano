<?php
include_once('../include/config.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $password = sanitize_post($_POST['password']);
  $email = sanitize_post($_POST['email_address']);
  $fullNames = sanitize_post($_POST['full_names']);
  
  $hashedPass = hashPass($password);
  $submitRes = "";
  
  if (checkUser($connection, $email)){
      $submitRes = "0";
  } else{
      $createUser = $connection->query("INSERT INTO jobseeker(`NAMES`, `EMAIL`, `PASSWORD`, `TYPE`) VALUES ('$fullNames', '$email', '$hashedPass', 'JOBSEEKER')");
      
      if(!$createUser){ 
          $submitRes = "1";           
      }else{
          $submitRes = "2";
          welcomeJobsPortal($email);
      }
  }
          
  echo $submitRes;
