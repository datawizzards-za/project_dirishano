<?php

define('DBHOST', 'localhost');
define('DBUSER', 'jmbonjap_root');
define('DBNAME','jmbonjap_jmbdb');
define('DBPASS', '11235iTech!');

$connection = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
$dbServer = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if($connection->connect_error){
    echo "#########################################";
    echo "\nERROR: AUTHENTICATION FAILED";
    echo "##########################################";
    die($connection->connect_error);
}else{
    require_once('functions.php');
}

?>