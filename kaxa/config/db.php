<?php
$host = "localhost";
$db   = "car_dealer";
$user = "root";
$pass = ""; // თუ XAMPP-ზე default ცარიელია

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
