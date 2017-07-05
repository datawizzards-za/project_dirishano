
<?php require_once('include/config.php'); ?>
<?php require_once('include/ls_func.php'); ?>
<?php  $cam = "";
if (isset($_POST['carpeta'])){
    $path = $path . "/" . $_POST['carpeta'];
    $cam = "?cam=".$_POST['carpeta'];
}

/*$uploaddir = $path ."/";
logentradas($path . " -- ".gethostbyaddr(getenv("REMOTE_ADDR"))." ======== ".$_FILES['userfile']['name'] ." =========> UPLOAD");

if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name'])){
    print("<center><b>ERROR : FILE NOT SUPPORTED</b></center>");
}else{
    header("Location: ../mycv.php".$cam);
}*/

echo $cam;

//print_r($_FILES);