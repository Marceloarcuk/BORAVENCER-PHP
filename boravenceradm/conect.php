<?php
include 'config.php';

try{
    $connect= new PDO("mysql:host=".$host.";dbname=".$dbname, $user,$pass);
    $connectCoorp= new PDO("mysql:host=".$host.";dbname=".$dbnameCoorp, $user,$pass);
	
	
	
}
catch(PDOException $e){
    echo $e->getMessage();
}

?>