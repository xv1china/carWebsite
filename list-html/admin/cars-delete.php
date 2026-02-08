<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: cars-manage.php");
  exit;
}

$stmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
$stmt->execute([$id]);

header("Location: cars-manage.php");
exit;
