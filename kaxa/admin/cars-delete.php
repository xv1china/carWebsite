<?php
require "../includes/auth.php";
require "../config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: cars-manage.php");
  exit;
}

$stmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
$stmt->execute([$id]);

header("Location: cars-manage.php");
exit;
