<?php
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    try{
        $dbh = new PDO("mysql:host=$servername;dbname=c9", $username, $password);
    }
    catch(PDOException $e){
        echo "Unable to connect to database.<br><br>Error:<br><br>". $e->getMessage();
    }
?>