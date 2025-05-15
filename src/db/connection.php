<?php
$host = '127.0.0.1'; // Use 127.0.0.1 instead of localhost
$dbname = 'php_judging_app';
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password (leave blank)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>