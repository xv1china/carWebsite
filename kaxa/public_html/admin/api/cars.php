<?php
require __DIR__ . "/../config/db.php";
header("Content-Type: application/json; charset=utf-8");

// ---- Input ----
$q       = trim($_GET["q"] ?? "");
$brand   = trim($_GET["brand"] ?? "");
$fuel    = trim($_GET["fuel"] ?? "");
$gearbox = trim($_GET["gearbox"] ?? "");
$status  = trim($_GET["status"] ?? ""); // available | sold | ""
$minPrice = isset($_GET["minPrice"]) ? (int)$_GET["minPrice"] : 0;
$maxPrice = isset($_GET["maxPrice"]) ? (int)$_GET["maxPrice"] : 0;
$year     = isset($_GET["year"]) ? (int)$_GET["year"] : 0;

$page  = max(1, (int)($_GET["page"] ?? 1));
$limit = 12;
$offset = ($page - 1) * $limit;

// ---- WHERE building (safe) ----
$where = [];
$params = [];

if ($q !== "") {
  $where[] = "(c.title LIKE ? OR c.brand LIKE ? OR c.model LIKE ?)";
  $like = "%" . $q . "%";
  $params[] = $like; $params[] = $like; $params[] = $like;
}

if ($brand !== "") {
  $where[] = "c.brand = ?";
  $params[] = $brand;
}
if ($fuel !== "") {
  $where[] = "c.fuel = ?";
  $params[] = $fuel;
}
if ($gearbox !== "") {
  $where[] = "c.gearbox = ?";
  $params[] = $gearbox;
}
if ($status === "available" || $status === "sold") {
  $where[] = "c.status = ?";
  $params[] = $status;
}
if ($year > 0) {
  $where[] = "c.year = ?";
  $params[] = $year;
}
if ($minPrice > 0) {
  $where[] = "c.price >= ?";
  $params[] = $minPrice;
}
if ($maxPrice > 0) {
  $where[] = "c.price <= ?";
  $params[] = $maxPrice;
}

$whereSql = $where ? ("WHERE " . implode(" AND ", $where)) : "";

// ---- Total count ----
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM cars c $whereSql");
$stmtCount->execute($params);
$total = (int)$stmtCount->fetchColumn();

$totalPages = (int)ceil($total / $limit);

// ---- Data query (first_image) ----
$sql = "
  SELECT c.*,
         (SELECT image FROM car_images WHERE car_id = c.id ORDER BY id ASC LIMIT 1) AS first_image
  FROM cars c
  $whereSql
  ORDER BY c.created_at DESC
  LIMIT $limit OFFSET $offset
";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ---- Normalize for frontend ----
$data = [];
foreach ($rows as $r) {
  $img = "";
  if (!empty($r["first_image"])) {
    $img = "/list-html/assets/uploads/cars/" . (int)$r["id"] . "/" . $r["first_image"];
  }

  $data[] = [
    "id" => (int)$r["id"],
    "title" => (string)($r["title"] ?? ""),
    "brand" => (string)($r["brand"] ?? ""),
    "model" => (string)($r["model"] ?? ""),
    "year" => (int)($r["year"] ?? 0),
    "price" => (int)($r["price"] ?? 0),
    "fuel" => (string)($r["fuel"] ?? ""),
    "gearbox" => (string)($r["gearbox"] ?? ""),
    "mileage" => (int)($r["mileage"] ?? 0),
    "status" => (string)($r["status"] ?? "available"),
    "image" => $img
  ];
}

echo json_encode([
  "page" => $page,
  "limit" => $limit,
  "total" => $total,
  "totalPages" => $totalPages,
  "data" => $data
], JSON_UNESCAPED_UNICODE);
