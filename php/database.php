<?php
// database.php

$host = 'localhost';
$db = 'Ngamobil';
$user = 'root'; // replace with your MySQL username
$pass = 'mysql'; // replace with your MySQL password

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$conn = new mysqli($host, $user, $pass, $db);

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
