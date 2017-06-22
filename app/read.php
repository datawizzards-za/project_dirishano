<?php

	session_start();
	include_once('include/config.php');

	$session_user = "";   
	$result = false;

    $username = $password = $error = "";
    if(isset($_POST['btnLogin'])){
        if(isset($_POST['username']))
            $username = sanitize_post($_POST['username']);
        
        $session_user = $username;
        if(isset($_POST['password']))
            $password = sanitize_post($_POST['password']);
        
        $results = $connection->query("SELECT EMAILADDRESS,PASSWORD FROM clients where EMAILADDRESS='$username' and PASSWORD='$password' UNION SELECT EMAILADDRESS,PASSWORD FROM supplier where EMAILADDRESS='$username' and PASSWORD='$password' UNION SELECT EMAILADDRESS,PASSWORD FROM serviceprovider where EMAILADDRESS='$username' and PASSWORD='$password'");
		
        if($results-> num_rows > 0){
            while($row = $results->fetch_assoc()){
                $_SESSION['username'] = $row['EMAILADDRESS'];                
                $result = true;
            }

        }
        if($results-> num_rows <= 0){
            $error = "<br /><div class='col-lg-12 centered'><div class='alert alert-danger '><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button><div>Oops! That Email Address does't seem to be Registered. <br />Please double check and try again.</div></div></div>";
            $result = false;
        }
        else{
            $error = "<br /><div class='col-lg-12 centered'><div class='alert alert-danger '><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button><div>Oops! Wrong Password or Email Address. <br />Please double check and try again.</div></div></div>";
            $result = false;
        }

        //echo json_encode(array('result' => $result);)

        $connection->close();
        die();
    }
?>