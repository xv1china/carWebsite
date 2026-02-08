<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$carId = (int)($_GET["car_id"] ?? 0);
$imgId = (int)($_GET["img_id"] ?? 0);

if ($carId <= 0 || $imgId <= 0) {
  header("Location: cars-manage.php");
  exit;
}

// ვიპოვოთ ფაილის სახელი
$stmt = $pdo->prepare("SELECT image FROM car_images WHERE id = ? AND car_id = ? LIMIT 1");
$stmt->execute([$imgId, $carId]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row && !empty($row["image"])) {
  $filePath = dirname(__DIR__) . "/assets/uploads/cars/" . $carId . "/" . $row["image"];

  // DB-დან წაშლა
  $del = $pdo->prepare("DELETE FROM car_images WHERE id = ? AND car_id = ?");
  $del->execute([$imgId, $carId]);

  // დისკიდან წაშლა
  if (is_file($filePath)) {
    @unlink($filePath);
  }
}

header("Location: car-photos.php?id=" . $carId);
exit;
