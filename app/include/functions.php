<?php

//Encrypt Password
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
$year = date('Y');

function create_dirs($connection, $user){
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    $baseDIR = $root."/app/files";
    
    $userType = getUserType($connection, $user);
    $thisUser = "";
    
    switch ($userType){
        case "client":
            $thisUser = $connection->query("SELECT EMAILADDRESS from clients WHERE EMAILADDRESS='$user'");
            break;
            
        case "service";
            $thisUser = $connection->query("SELECT EMAILADDRESS from serviceprovider WHERE EMAILADDRESS='$user'");
            break;
            
        case "supplier":
            $thisUser = $connection->query("SELECT EMAILADDRESS from supplier WHERE EMAILADDRESS='$user'");
            break;
            
        case "JOBSEEKER":
            $thisUser = $connection->query("SELECT EMAIL AS EMAILADDRESS from jobseeker WHERE EMAIL='$user'");
            $baseDIR = $root."/app/jobsportal/files";
            break;
        
        case "EMPLOYER":
            $thisUser = $connection->query("SELECT EMAIL AS EMAIL from employer WHERE EMAIL='$user'");
            $baseDIR = $root."/app/jobsportal/files";
            break;
        
        default:
            break;
    }
    
    foreach ($thisUser as $theUser)
    {
        $encryptedDIR = md5($theUser['EMAILADDRESS']);
        
        $portfolio_dir = "$baseDIR/portfolio/$encryptedDIR/files/";
        $img_dir = "$baseDIR/imgs/$encryptedDIR/";
             
        if(!file_exists($portfolio_dir)){mkdir($portfolio_dir, 0755, true);}
        if(!file_exists($img_dir)){mkdir($img_dir, 0755, true);}
    }   
}

function getDIRAvatar($connection, $user){
    $avatarName = $dp = "";
    $avatarNames = $connection->query("SELECT AVATAR FROM clients WHERE EMAILADDRESS='$user' UNION "
            . "SELECT AVATAR FROM serviceprovider WHERE EMAILADDRESS='$user' UNION "
            . "SELECT AVATAR FROM supplier WHERE EMAILADDRESS='$user' UNION "
            . "SELECT AVATAR FROM jobseeker WHERE EMAIL='$user' UNION "
            . "SELECT AVATAR FROM employer WHERE EMAIL='$user'");
    
    foreach ($avatarNames as $avName){$avatarName = $avName['AVATAR'];}
    
    $encryptedUsr = md5($user);
    
    $baseDIR = "../files";
    
    $img_dir = "$baseDIR/imgs/$encryptedUsr/";
    
    if( $avatarName == "" || $avatarName == "NULL" || !file_exists($img_dir) || !file_exists("$img_dir$avatarName")) { 
        $dp = "$baseDIR/imgs/default.png";
    }else{
        $dp = "$img_dir$avatarName";
    }
    
    return $dp;
}

function getAvatar($connection, $user){
    global $baseDIR;
    $avatarName = $dp = "";
    $avatarNames = $connection->query("SELECT AVATAR FROM clients WHERE EMAILADDRESS='$user' UNION "
            . "SELECT AVATAR FROM serviceprovider WHERE EMAILADDRESS='$user' UNION "
            . "SELECT AVATAR FROM supplier WHERE EMAILADDRESS='$user' UNION "
            . "SELECT AVATAR FROM jobseeker WHERE EMAIL='$user' UNION "
            . "SELECT AVATAR FROM employer WHERE EMAIL='$user'");
    
    foreach ($avatarNames as $avName){$avatarName = $avName['AVATAR'];}
    
    $encryptedUsr = md5($user);
    
    $baseDIR = "files";
    $img_dir = "$baseDIR/imgs/$encryptedUsr/";
    
    if( $avatarName == "" || $avatarName == "NULL" || !file_exists($img_dir) || !file_exists("$img_dir$avatarName")) { 
        $dp = "$baseDIR/imgs/default.png";
    }else{
        $dp = "$img_dir$avatarName";
    }
    
    return $dp;
}

function checkCK($connection, $email){
    $checkEmail = $connection->query("SELECT COMPREGNO FROM serviceprovider WHERE COMPREGNO='$email'");
          if ($checkEmail->num_rows){return TRUE;}else{return FALSE;}
}

function checkTaxNum($connection, $email){
    $checkEmail = $connection->query("SELECT TAXREGNO FROM serviceprovider WHERE TAXREGNO='$email'");
          if ($checkEmail->num_rows){return TRUE;}else{return FALSE;}
}

//################### JOBS PORTAL #################

function deleteSkill($connection){   
    
    $submitRes = "";
    $id = sanitize_post($_POST['skill_id']);
    
    $delCert = $connection->query("DELETE FROM skills WHERE ID='$id'");
        
    if($delCert){
        $submitRes = "1";
    }else{
        $submitRes = "0";
    }
    return $submitRes;   
}

function deleteCertificate($connection){   
    
    $submitRes = "";
    $id = sanitize_post($_POST['cert_id']);
    
    $delCert = $connection->query("DELETE FROM certificates WHERE ID='$id'");
        
    if($delCert){
        $submitRes = "1";
    }else{
        $submitRes = "0";
    }
    return $submitRes;   
}

function addSkill($username, $connection){   
    
    $submitRes = "";
    $name = sanitize_post($_POST['skill_name']);
    $level = sanitize_post($_POST['skill_level']);
    
    $addSkill = $connection->query("INSERT INTO skills(`SNAME`, `COMPETENCY`, `PERSON`) VALUES ('$name', '$level', '$username')");
        
    if($addSkill){
        $submitRes = "1";
    }else{
        $submitRes = "0";
    }
    return $submitRes;   
}

function addCertificate($username, $connection){   
    
    $submitRes = "";
    $name = sanitize_post($_POST['cert_name']);
    $year = sanitize_post($_POST['cert_year']);
    
    $addCert = $connection->query("INSERT INTO certificates(`NAME`, `YEAR`, `PERSON`) VALUES ('$name', '$year', '$username')");
        
    if($addCert){
        $submitRes = "1";
    }else{
        $submitRes = "0";
    }
    return $submitRes;   
}

function editBasicInfo($username, $connection){   
    
    $gender = sanitize_post($_POST['gender'])=="1"?"Female":"Male";    
    $age = sanitize_post($_POST['age']);
    $phoneNo = sanitize_post($_POST['phone_no']);
    $address = sanitize_post($_POST['res_addr']);
    
    $submitRes = "";
    
    $updateBasicInfo = $connection->query("UPDATE jobseeker SET AGE='$age', GENDER='$gender', CONTACT='$phoneNo', RESIDENTIAL='$address' WHERE EMAIL='$username'");
        
    if($updateBasicInfo){
        $submitRes = "1";
    }else{
        $submitRes = "0";
    }
    return $submitRes;   
}

//###############################################################################

//Update Service Provider Details
function editSUP($username, $connection){    
    $pAddress = sanitize_post($_POST['pAddress']);
    $telNum = sanitize_post($_POST['telNum']);
    $webAddress = sanitize_post($_POST['webAddress']);
    
    $updateSP = $connection->query("UPDATE supplier SET PADDRESS='$pAddress', TELLNUMBER='$telNum', WEBADDRESS='$webAddress' WHERE EMAILADDRESS='$username'");
        
    if($updateSP){
        $submitRes = "1";
    }else{
        $submitRes = "2";
    }
    return $submitRes;   
}

//Update Service Provider Details
function editSP($username, $connection){    
    $pAddress = sanitize_post($_POST['pAddress']);
    $telNum = sanitize_post($_POST['telNo']);
    $tradeAs = sanitize_post($_POST['tradeAs']);
    $webAddress = sanitize_post($_POST['website']);
    $vatNo = sanitize_post($_POST['vatNo']);
    $cibdNo = sanitize_post($_POST['cibdNo']);
    $nhbrcNo = sanitize_post($_POST['nhbrcNo']);
    
    $updateSP = $connection->query("UPDATE serviceprovider SET TRADEAS='$tradeAs', PADDRESS='$pAddress', PHONENUMBER='$telNum', WEBADDRESS='$webAddress', VATNO='$vatNo', CIBDNO='$cibdNo', NHBRCNO='$nhbrcNo' WHERE EMAILADDRESS='$username'");
        
    if($updateSP){
        $submitRes = "1";
    }else{
        $submitRes = "2";
    }
    return $submitRes;   
}

//Update Client Details
function editCL($username, $connection){    
    $pAddress = sanitize_post($_POST['paddress']);
    $telNum = sanitize_post($_POST['telephone']);
    
    if ($pAddress == "" || $telNum == ""){
        $submitRes = "0";
    }else{
        $updateCL = $connection->query("UPDATE clients SET ADDRESS='$pAddress', CONTACTNO='$telNum' WHERE EMAILADDRESS='$username'");
        
        if($updateCL){
            $submitRes = "1";
        }else{
            $submitRes = "2";
        }
    }
    return $submitRes;   
}

function checkUser($connection, $email){
    $checkEmail = $connection->query("SELECT EMAILADDRESS FROM clients WHERE EMAILADDRESS='$email' UNION
                                      SELECT EMAILADDRESS FROM serviceprovider WHERE EMAILADDRESS='$email' UNION
                                      SELECT EMAILADDRESS FROM supplier WHERE EMAILADDRESS='$email' UNION
                                      SELECT EMAIL FROM jobseeker WHERE EMAIL='$email' UNION
                                      SELECT EMAIL FROM employer WHERE EMAIL='$email'");
          if ($checkEmail->num_rows){return TRUE;}else{return FALSE;}
}

function setSession($user)
{
    session_start();
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['username'] = $user;
    
    if (isset($_SESSION['username']))
        {
            return TRUE;        
        }else{
            return FALSE;
        }
}

function hashPass($toEncrypt){
    $encrypt = serialize($toEncrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex(pack('H*', ENCRYPTION_KEY)), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, pack('H*', ENCRYPTION_KEY), $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
    return $encoded;
}

function unhashPass($toDecrypt){
    $decrypt = explode('|', $toDecrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    
    $decryption = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, pack('H*', ENCRYPTION_KEY), $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decryption, -64);
    $decrypted = substr($decryption, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex(pack('H*', ENCRYPTION_KEY)), -32));
    if($calcmac!==$mac){ return false; }
    $decryptedPass = unserialize($decrypted);
    return $decryptedPass;
}

function getUser($connection, $pageID)
{
    $allEmails = $connection->query("SELECT EMAILADDRESS FROM clients UNION 
                                  SELECT EMAILADDRESS FROM supplier UNION 
                                  SELECT EMAILADDRESS FROM serviceprovider UNION
                                  SELECT EMAIL FROM jobseeker UNION
                                  SELECT EMAIL FROM employer");
    
      foreach ($allEmails as $email) {          
          $oneEmail = $email['EMAILADDRESS'];
          if(md5($oneEmail) == $pageID){return $oneEmail;}
      }
}

function getJobAd($connection, $pageID)
{
    $allJobs = $connection->query("SELECT * FROM jobadverts");
    
    foreach($allJobs as $job) {
        $oneJob = $job['ID'];
        if(md5($oneJob) == $pageID){return $oneJob;}
      }
}

function getJobID($connection, $pageID)
{
    $allJobs = $connection->query("SELECT * FROM jobs");
    
    foreach($allJobs as $job) {
        $oneJob = $job['JOB_ID'];
        if(md5($oneJob) == $pageID){return $oneJob;}
      }
}

function getBidID($connection, $pageID)
{
    $allBids = $connection->query("SELECT * FROM bids");
    
    foreach($allBids as $bid) {
        $oneBid = $bid['BID_ID'];
        if(md5($oneBid) == $pageID){return $oneBid;}
      }
}

function passAuth($connection, $username, $pas)
{
    $usrTyp = getUserType($connection, $username);
    
    $theUser = $encPass = "";
    
    switch ($usrTyp){
        case "client":
            $theUser = $connection->query("SELECT PASSWORD FROM clients where EMAILADDRESS='$username'");
            break;
        case "service":
            $theUser = $connection->query("SELECT PASSWORD FROM serviceprovider where EMAILADDRESS='$username'");
            break;
        case "supplier":
            $theUser = $connection->query("SELECT PASSWORD FROM supplier where EMAILADDRESS='$username'");
            break;
        case "JOBSEEKER":
            $theUser = $connection->query("SELECT PASSWORD FROM jobseeker where EMAIL='$username'");
            break;
        case "EMPLOYER":
            $theUser = $connection->query("SELECT PASSWORD FROM employer where EMAIL='$username'");
            break;
        default:
            break;
    }
    
    if($theUser){
        foreach ($theUser as $user){$encPass = $user['PASSWORD'];}
        
        if ($pas == unhashPass($encPass)){
            return $encPass;
        }
    }
}

function sanitize_post($var)
{
	global $connection;
	$var1 = strip_tags($var);
	$var2 = htmlentities($var1);
	$var3 = stripslashes($var2);
	return $connection->real_escape_string($var3);
}

function login($username, $password){

  $query = "SELECT * FROM clients  WHERE EMAILADDRESS = $username AND PASSWORD = $password";
  return ;
}

function getUserType($connection, $username_session)
{
    //Get User Type
    $userTypeResults = $connection->query("SELECT TYPE from clients WHERE EMAILADDRESS='$username_session' UNION
                                           SELECT TYPE from supplier WHERE EMAILADDRESS='$username_session' UNION
                                           SELECT TYPE from serviceprovider WHERE EMAILADDRESS='$username_session' UNION
                                           SELECT TYPE from jobseeker WHERE EMAIL='$username_session' UNION
                                           SELECT TYPE from employer WHERE EMAIL='$username_session'");
    while($row=$userTypeResults->fetch_assoc()){ return $userType = $row['TYPE']; }
}

function notifyClient ($jobDetails){
    global $year;
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";
    
    foreach($jobDetails as $bid)
    {        
        //from jobs and clients
        $DST = $bid['EMAILADDRESS'];            
        $client = $bid['REGNAME'];
        $thisJob = strtoupper($bid['JOB_TITLE']);
        
        $pID = md5($DST);
        
        //from Bids and SP
        $bidderNumber = $bid['PHONENUMBER'];
        $bidderName = $bid['TRADEAS'];
        $bidderLocation = $bid['BID_LOCATION'];
        $bidPrice = $bid['BID_AMOUNT'];
        $bidderEmail = $bid['BIDDER'];

        $greetingLine = "Dear $client, <br />You have a new Bid. Please see the details below.";

        // Create the email and send the message
        $email_subject = "JMB Online: Incoming Bid";
        $email_body = $head.$greetingLine."<br>".$head
                . "JOB: $thisJob <br />"
                . "PRICE: R$bidPrice <br />"
                . "BIDDER DETAILS <br> $bidderName<br>$bidderEmail<br>$bidderNumber<br>$bidderLocation"
                . "<br /><br />"
                . "Please <a href='http://www.jmbonline.co.za/app/deep_login.php?page_id=$pID'>login</a> to your account for more details.<br />".$head.
            "Copyright &copy; $year. www.jmbonline.co.za. Ts and Cs apply.";
        $headers .= "From: clients@jmbonline.co.za\n";
        $headers .= "Reply-To: support@jmbonline.co.za";
        
        if(mail($DST, $email_subject, $email_body,$headers)){return 1;}else{return 0;}
    }
}

function notifyAll($allSPs, $jobTitle, $jobDesc, $jobLoc, $clName)
{
    global $year;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";
    
    $capsJobTitle = strtoupper($jobTitle);
    $capsjobDesc = strtoupper($jobDesc);
    $capsJobLoc = strtoupper($jobLoc);
        
    foreach($allSPs as $email)
        {
            $DST = $email['EMAILADDRESS'];
            $spName = $email['REGNAME'];
            
            $pID = md5($DST);
            
            $greetingLine = "Dear $spName, <br /> a new Service Request just came in. Please see the details below.<br />";
                
            // Create the email and send the message
            $email_subject = "JMB Online: Incoming Job";
            $email_body = $head.$greetingLine.$head
                    . "TITLE: $capsJobTitle <br />"
                    . "JOB DESCRIPTION: $capsjobDesc <br />"
                    . "LOCATION: $capsJobLoc <br />"
                    . "CLIENT: $clName <br /><br />"
                    . "Please <a href='http://www.jmbonline.co.za/app/deep_login.php?page_id=$pID'>login</a> to your account for more details.<br />".$head.
            "Copyright &copy; $year. www.jmbonline.co.za. Ts and Cs apply.";
            $headers .= "From: contractors@jmbonline.co.za\n";
            $headers .= "Reply-To: support@jmbonline.co.za";	
            if(mail($DST, $email_subject, $email_body,$headers)){return TRUE;}else{return FALSE;}
        }    
}

function getCompName($connection, $username_session, $userType)
{
    if( $userType == 'service'){
        $CompNameResults = $connection->query("SELECT TRADEAS from serviceprovider WHERE EMAILADDRESS='$username_session'");
        foreach($CompNameResults as $item){return $CompName = $item['TRADEAS'];}
    }elseif( $userType == 'client'){
        $CompNameResults = $connection->query("SELECT REGNAME from clients WHERE EMAILADDRESS='$username_session'");
        foreach($CompNameResults as $item){return $CompName = $item['REGNAME'];}
    }elseif( $userType == 'supplier'){
        $CompNameResults = $connection->query("SELECT COMPANYNAME from supplier WHERE EMAILADDRESS='$username_session' AND TYPE='supplier'");
        foreach($CompNameResults as $item){return $CompName = $item['COMPANYNAME'];}
    }elseif( $userType == 'JOBSEEKER'){
        $CompNameResults = $connection->query("SELECT NAMES from jobseeker WHERE EMAIL='$username_session'");
        foreach($CompNameResults as $item){return $CompName = $item['NAMES'];}
    }else{
        $CompNameResults = $connection->query("SELECT PERSON from employer WHERE EMAIL='$username_session'");
        foreach($CompNameResults as $item){return $CompName = $item['PERSON'];}
    }
}

function notifySP ($spDetails, $bidStatus, $username, $connection)
{
    global $year;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";
    
    $greetingLine =  ""; 
    
   foreach($spDetails as $sp)
   {
       $DST = $sp['BIDDER'];
       $spName = $sp['TRADEAS'];
       $client = $sp['REGNAME'];
       $jobTitle = $sp['JOB_TITLE'];
       
       $pID = md5($DST);
       
       if ($bidStatus == 1){
           $greetingLine = "Dear $spName, <br /> your Bid Has Been APPROVED. <br />Please see the details below.<br />";
           $msg = "Yay, your bid has been APPROVED!";
           sendNotif($username, $DST, $msg, $connection);
       }
       elseif($bidStatus == 0){
           $greetingLine = "Dear $spName, <br /> your Bid Has Been REJECTED. <br />Please see the details below.<br />";
           $msg = "Oops, your bid has been REJECTED!";
           sendNotif($username, $DST, $msg, $connection);
       }
       
       $email_subject = "JMB Online: BID STATUS";
       $email_body = $head.$greetingLine."<br>".$head.""
                    . "JOB TITLE: $jobTitle <br />"
                    . "CLIENT: $client <br /><br />"
                    . "Please <a href='http://www.jmbonline.co.za/app/deep_login.php?page_id=$pID'>login</a> to your account for more details.<br />".$head.
            "Copyright &copy; $year. www.jmbonline.co.za. Ts and Cs apply.";
            $headers .= "From: contractors@jmbonline.co.za\n";
            $headers .= "Reply-To: support@jmbonline.co.za";	
            if(mail($DST, $email_subject, $email_body,$headers)){return TRUE;}else{return FALSE;}
            
        }    
}

function sendNotif($username, $to_user, $message, $connection)
{
    $connection->query("INSERT INTO notifications(`FROM_USER`, `TO_USER`, `MESSAGE`, `STATUS`, `TIMEPOST`) VALUES('$username','$to_user','$message','0',CURRENT_TIMESTAMP)");   
    return true;
}

function welcomeUser($dst)
{
    global $year;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";

    $pID = md5($dst);

    // Create the email and send the message
    $email_subject = "JMB Online: Welcome";
    $email_body = $head."Welcome to JMB Online <br />".$head
            . "You have successfully created a JMB Online account. <br />"
            . "Welcome to the world of convinience. <br /><br />"
            . "Should you have any quiries, please feel free to email us at support@jmbonline.co.za <br />"
            . "<br /><br />"
            . "<a href='http://www.jmbonline.co.za/app/deep_login.php?page_id=$pID'>Login</a> to your account and explore the possibilities.<br />".$head.
            "Copyright &copy; $year. www.jmbonline.co.za. Ts and Cs apply.";
    $headers .= "From: users@jmbonline.co.za\n";
    $headers .= "Reply-To: support@jmbonline.co.za";

    if(mail($dst, $email_subject, $email_body,$headers)){return 1;}else{return 0;}
}

function welcomeJobsPortal($dst)
{
    global $year;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";

    $pID = md5($dst);

    // Create the email and send the message
    $email_subject = "JMB Online: Welcome";
    $email_body = $head."Welcome to JMB Online <br />".$head
            . "You have successfully created a JMB Jobs Portal profile. <br />"
            . "Welcome to the world of convinience. <br /><br />"
            . "Please MAKE SURE you update your CV.<br>"
            . "Employers WILL NOT see your profile if you have not updated your CV. <br /> <br>"
            . "Should you have any quiries, please feel free to email us at support@jmbonline.co.za"
            . "<br /><br />"
            . "<a href='http://www.jmbonline.co.za/app/jobsportal/deep_login.php?page_id=$pID'>Login</a> to your account to get started.<br />".$head.
            "Copyright &copy; $year. www.jmbonline.co.za. Ts and Cs apply.";
    $headers .= "From: jobsportal@jmbonline.co.za\n";
    $headers .= "Reply-To: jobsportal@jmbonline.co.za";

    if(mail($dst, $email_subject, $email_body,$headers)){return 1;}else{return 0;}
}

function resetPass($dst)
{
    global $year;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";

    $pID = md5($dst);

    // Create the email and send the message
    $email_subject = "JMB Online: Reset Password";
    $email_body = $head."Password Reset <br />".$head
            . "We have recieved your request to reset your password.<br />"
            . "Your wish is our command. <br /><br />"
            . "Please click the link below and get started. <br><br>"
            . "<a href='http://www.jmbonline.co.za/app/reset_pass.php?page_id=$pID'>Reset Password</a> <br><br>"
            . "Should you have any quiries, please feel free to email us at support@jmbonline.co.za"
            . "<br />".$head.
            "Copyright &copy; $year. <br />www.jmbonline.co.za. Ts and Cs apply.";
    $headers .= "From: users@jmbonline.co.za\n";
    $headers .= "Reply-To: support@jmbonline.co.za";

    if(mail($dst, $email_subject, $email_body,$headers)){return 1;}else{return 0;}
}

function passReset($dst)
{
    global $year;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $head = "******************************************************<br />";

    $pID = md5($dst);

    // Create the email and send the message
    $email_subject = "JMB Online: Reset Password";
    $email_body = $head."Password Reset Success <br />".$head
            . "We have updated your password as requested.<br /><br />"
            . "If you did not make this request, please reset your password below.<br>"
            . "Otherwise just ignore this email.<br><br>"
            . "<a style='color:red' href='http://www.jmbonline.co.za/app/reset_pass.php?page_id=$pID'>Reset Password Now</a> <br><br>"
            . "Should you have any quiries, please feel free to email us at support@jmbonline.co.za"
            . "<br />".$head.
            "Copyright &copy; $year. www.jmbonline.co.za. Ts and Cs apply.";
    $headers .= "From: users@jmbonline.co.za\n";
    $headers .= "Reply-To: support@jmbonline.co.za";

    if(mail($dst, $email_subject, $email_body,$headers)){return 1;}else{return 0;}
}