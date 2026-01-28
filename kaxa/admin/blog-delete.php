<?php
require "../includes/auth.php";
require "../config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: blog-manage.php");
  exit;
}

$stmt = $pdo->prepare("SELECT image FROM blog WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$del = $pdo->prepare("DELETE FROM blog WHERE id = ?");
$del->execute([$id]);

if ($row && !empty($row["image"])) {
  $path = __DIR__ . "/../assets/uploads/blog/" . $id . "/" . $row["image"];
  if (is_file($path)) @unlink($path);
}

header("Location: blog-manage.php");
exit;
