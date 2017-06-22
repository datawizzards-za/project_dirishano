<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../include/config.php');

$username = sanitize_post($_POST['userMail']);

$emailList = $connection->query("SELECT EMAILADDRESS FROM clients where EMAILADDRESS='$username' UNION
                                    SELECT EMAILADDRESS FROM supplier where EMAILADDRESS='$username' UNION
                                    SELECT EMAILADDRESS FROM serviceprovider where EMAILADDRESS='$username' UNION
                                    SELECT EMAIL FROM jobseeker WHERE EMAIL='$username' UNION
                                    SELECT EMAIL FROM employer WHERE EMAIL='$username'");
if($emailList-> num_rows > 0){
    resetPass($username);
    echo 1;
}else {echo 2;}