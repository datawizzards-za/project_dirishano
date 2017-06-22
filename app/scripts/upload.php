<?php
session_start();
include_once('../include/config.php');
$username = $_SESSION['username'];

$usrTyp = getUserType($connection, $username);
$userAvatar = getDIRAvatar($connection, $username);

$user = md5($username);
$res = "";
$targetPath = $mov_cmd = "";
$sourcePath = "Nothing";

if(isset($_FILES["file"]["type"]))
{
    $validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    
    if ((   ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/PNG") ||
        ($_FILES["file"]["type"] == "image/jpg") ||  ($_FILES["file"]["type"] == "image/JPG") || ($_FILES["file"]["type"] == "image/JPEG") || 
        ($_FILES["file"]["type"] == "image/jpeg")) && 
        ($_FILES["file"]["size"] < 100000000) && //Approx. 100kb files can be uploaded.
        in_array($file_extension, $validextensions)){
            if ($_FILES["file"]["error"] > 0)
            {
                $res = "0"; //echo "<script type='text/javascript'>alert('File upload Error...!!');</script>";
            }
            else{

    $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
    $targetPath = "../files/imgs/$user/".$_FILES['file']['name']; // Target path where file is to be stored
    $mov_cmd = move_uploaded_file($sourcePath,$targetPath);
    if ($mov_cmd) {
    
    $avater = $_FILES['file']['name'];
    if($usrTyp == 'client'){
        $theUser = $connection->query("UPDATE `clients` SET `AVATAR`='$avater' WHERE EMAILADDRESS='$username'");
    }
    elseif($usrTyp == 'service'){
        $theUser = $connection->query("UPDATE `serviceprovider` SET `AVATAR`='$avater' WHERE EMAILADDRESS='$username'");
    }
    else{
        $theUser = $connection->query("UPDATE `supplier` SET `AVATAR`='$avater' WHERE EMAILADDRESS='$username'");
    }
    unlink($userAvatar);
    $res = "1";
    }
}
}else{
    $res = "-1";
}
}
echo $res;
