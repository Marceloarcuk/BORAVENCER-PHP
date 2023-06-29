<?php
    include('config.php');

try{
    $conection = new PDO('mysql:host='.$db_host.';port=3306;dbname='.$db_name,$db_user,$db_pass);
}
catch(PDOException $e){
    echo $e->getMessage();
}

$titulo="#BORAVENCER";