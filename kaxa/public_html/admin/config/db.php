<?php
$host = "localhost";
$db   = "car_dealer";
$user = "root";
$pass = ""; // თუ XAMPP-ზე default ცარიელია
define('GOOGLE_TRANSLATE_API_KEY', 'PUT_YOUR_KEY');

try {
  $pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (PDOException $e) {
  die("DB ERROR: " . $e->getMessage());
}
