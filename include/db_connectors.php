<?php

$host = getenv('DB_HOST') ?: ''; 
$user = getenv('DB_USERNAME') ?: '';  
$pass = getenv('DB_PASSWORD') ?: '';      
$dbname = getenv('DB_DATABASE') ?: '';  
$port = getenv('DB_PORT') ?: '3306';   

// Establish database connection using PDO
try {
    $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    ]);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

?>
