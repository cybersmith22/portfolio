<?php
    $servername = 'localhost';
    $username = 'smith';
    $password = 'wzBT7';
    $dbname = 'gameandplay';
    
    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname");//, $username, $password);
         echo "Connected to $dbname";
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo $error_message;
        exit();
    }
?>