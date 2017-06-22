<?php

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBNAME','jmbdb');
define('DBPASS', '');

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