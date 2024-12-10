<?php
$dbHost = 'localhost';
$dbName = 'loginregisterotp';
$dbUsername = 'root';
$dbPassword = '';
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;", $dbUsername, $dbPassword);
 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch (PDOException $e) {
    echo "Sql has Error:=> " . $e->getMessage();
}
