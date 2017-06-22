<?php


$myFile = $_GET['dlfile'];
unlink($myFile);
$ncam = "";
if (isset($_GET['cam']))
  $ncam = $_GET['cam'];
header("Location: index.php?cam=".$ncam);
?>