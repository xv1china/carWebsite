<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: gallery-manage.php");
    exit;
}

$stmt = $pdo->prepare("SELECT image FROM gallery WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$pdo->prepare("DELETE FROM gallery WHERE id = ?")->execute([$id]);

$uploadDir = dirname(__DIR__) . "/assets/uploads/gallery/" . $id . "/";
if (is_dir($uploadDir)) {
    $files = glob($uploadDir . "*");
    foreach ($files as $f) {
        if (is_file($f)) @unlink($f);
    }
    @rmdir($uploadDir);
}

header("Location: gallery-manage.php");
exit;
