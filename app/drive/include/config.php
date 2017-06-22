<?php
    include_once('../session.php');

    $dec = md5($session_name);
    $path = "../files/portfolio/$dec/files";
	
//=========================================================================================
// Upload Folder Path
// -------------------
// It can be relative or absolute depends your OS and Web server.

//====================================/////////////////====================================

$Tipo = 0;

// Listado: Define an array with Machine Name or IP Address -------------------------------
$Listado = "../../files/portfolio";
//====================================/////////////////====================================

$Template = "grey";
//====================================/////////////////====================================

$LANG = "EN_US";
//====================================/////////////////====================================

// Active JSFX_LinkFader2 Links Effect (if performance problems, turn it off)
$JSFX_LinkFader2 = true;
//====================================/////////////////====================================


?>