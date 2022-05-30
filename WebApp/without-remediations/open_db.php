<?php
    $servername = 'localhost';
    $username = 'phpmyadmin';
    $password = 'V!rtua1Box';
    $dbname = 'smith';
    
    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname");//, $username, $password);
        echo "Connected to $dbname";
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo $error_message;
        exit();
    }
?>