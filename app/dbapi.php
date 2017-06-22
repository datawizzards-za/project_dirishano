<?php
    session_start();
    include_once('include/config.php');
    if(isset($_SESSION['username'])){header('location:index.php');}
    include_once('create_dir.php');

    $session_user = "";    

    $username = $password = $error = "";
    if(isset($_POST['btnLogin'])){
        if(isset($_POST['username']))
            $username = sanitize_post($_POST['username']);
        $session_user = $username;
        if(isset($_POST['password']))
            $password = sanitize_post($_POST['password']);
        $results = $connection->query("SELECT EMAILADDRESS,PASSWORD FROM clients where EMAILADDRESS='$username' and PASSWORD='$password' UNION 
                                       SELECT EMAILADDRESS,PASSWORD FROM supplier where EMAILADDRESS='$username' and PASSWORD='$password' UNION
                                       SELECT EMAILADDRESS,PASSWORD FROM serviceprovider where EMAILADDRESS='$username' and PASSWORD='$password'");
        if($results-> num_rows > 0){
            while($row = $results->fetch_assoc()){
                $_SESSION['username'] = $row['EMAILADDRESS'];                
                header('location:index.php');
            }

        }
        if($results-> num_rows <= 0){
            $error = "<br /><div class='col-lg-12 centered'><div class='alert alert-danger '><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button><div>Oops! That Email Address does't seem to be Registered. <br />Please double check and try again.</div></div></div>";
        }
        else{
            $error = "<br /><div class='col-lg-12 centered'><div class='alert alert-danger '><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button><div>Oops! Wrong Password or Email Address. <br />Please double check and try again.</div></div></div>";
        }
        $connection->close();
    }

    $userEmail = "";
    if(isset($_POST['btnForgotPass'])){
        if(isset($_POST['userMail']))

        $userEmail = sanitize_post($_POST['userMail']);

        $results = $connection->query("SELECT EMAILADDRESS,PASSWORD FROM clients where EMAILADDRESS='$userEmail' UNION
                                       SELECT EMAILADDRESS,PASSWORD FROM serviceprovider where EMAILADDRESS='$userEmail'");

             
      if($results-> num_rows > 0){
            while($row = $results->fetch_assoc()){
                    $userPAss = $row['PASSWORD'];

                    // Create the email and send the message
                    $email_subject = "FASTBID: RECOVER PASSWORD";
                    $email_body = "\n\nYOU HAVE REQUESTED TO RECOVER THE PASSWORD FOR YOUR FASBID ACCOUNT. \n\n
                                    If you did not, please ignore this email, otherwise find your password below. \n\n
                                    Email Address: $userEmail\n
                                    Password     : $userPAss\n\n\n
                                    Thank you for using FastBid.";
                    $headers = "From: MailServer@fastbid.co.za\n"; 
                    $headers .= "Reply-To: $userEmail";	
                    mail($userEmail, $email_subject, $email_body,$headers);

                    $error = "<br /><div class='col-lg-12 centered'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button>
                        <div>Yay, your password has be retrieved and send to <br /> $userEmail Please check your email.</div></div></div>";
                }

        }
        elseif($results-> num_rows <= 0){
            $error = "<br /><div class='col-lg-12 centered'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button><div>Oops! That Email Address does't seem to be Registered. <br />Please double check and try again.</div></div></div>";
        }

        $connection->close();
    }

?>