<?php
require __DIR__ . "/../../config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: ../index.php");
  exit;
}

// Car
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
  header("Location: ../index.php");
  exit;
}

// Images
$stmtI = $pdo->prepare("SELECT image FROM car_images WHERE car_id = ? ORDER BY id ASC");
$stmtI->execute([$id]);
$images = $stmtI->fetchAll(PDO::FETCH_COLUMN);

// Helpers
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8"); }

$status = ($car["status"] ?? "available") === "sold" ? "sold" : "available";
$statusText = $status === "sold" ? "გაყიდულია" : "გასაყიდი";

function imgUrl($carId, $file){
  return "/kaxa/assets/uploads/cars/" . (int)$carId . "/" . $file;
}

$mainImg = !empty($images[0]) ? imgUrl($id, $images[0]) : "../images/no-image.jpg";
?>
<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= h(($car["brand"] ?? "") . " " . ($car["model"] ?? "") . " " . ($car["year"] ?? "")) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <style>
    .car-hero {
      width:100%;
      height:420px;
      object-fit:cover;
      border-radius:16px;
      background:#f2f2f2;
    }
    .thumb {
      width:100%;
      height:90px;
      object-fit:cover;
      border-radius:12px;
      cursor:pointer;
      background:#f2f2f2;
      border:2px solid transparent;
    }
    .thumb.active { border-color: #0d6efd; }
    .spec-card { border-radius:16px; }
  </style>
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <img src="../images/logo.png" width="70" alt="Logo">
      <div class="ms-auto">
        <a class="btn btn-outline-secondary" href="../index.php">← Back</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div>
        <h2 class="mb-1">
          <?= h($car["brand"] ?? "") ?> <?= h($car["model"] ?? "") ?> - <?= (int)($car["year"] ?? 0) ?>
        </h2>
        <div class="text-muted">
          ID: #<?= (int)$car["id"] ?> •
          <span class="badge <?= $status === "sold" ? "text-bg-secondary" : "text-bg-primary" ?>">
            <?= h($statusText) ?>
          </span>
        </div>
      </div>

      <div class="fs-3 fw-bold">
        <?= number_format((int)($car["price"] ?? 0)) ?> ₾
      </div>
    </div>

    <div class="row g-4">
      <!-- Left: gallery -->
      <div class="col-lg-7">
        <img id="mainImg" class="car-hero" src="<?= h($mainImg) ?>" alt="Car image">

        <?php if (!empty($images)): ?>
          <div class="row g-2 mt-2">
            <?php foreach ($images as $idx => $file): ?>
              <?php $u = imgUrl($id, $file); ?>
              <div class="col-4 col-md-3">
                <img
                  class="thumb <?= $idx === 0 ? "active" : "" ?>"
                  src="<?= h($u) ?>"
                  alt="thumb"
                  onclick="setMain('<?= h($u) ?>', this)"
                >
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-warning mt-3 mb-0">ფოტო ჯერ არ აქვს დამატებული.</div>
        <?php endif; ?>
      </div>

      <!-- Right: specs -->
      <div class="col-lg-5">
        <div class="card shadow-sm spec-card">
          <div class="card-body">
            <h5 class="mb-3">მონაცემები</h5>

            <div class="row g-2 small">
              <div class="col-6 text-muted">Brand</div>
              <div class="col-6 fw-semibold text-end"><?= h($car["brand"] ?? "-") ?></div>

              <div class="col-6 text-muted">Model</div>
              <div class="col-6 fw-semibold text-end"><?= h($car["model"] ?? "-") ?></div>

              <div class="col-6 text-muted">Year</div>
              <div class="col-6 fw-semibold text-end"><?= (int)($car["year"] ?? 0) ?></div>

              <div class="col-6 text-muted">Fuel</div>
              <div class="col-6 fw-semibold text-end"><?= h($car["fuel"] ?? "-") ?></div>

              <div class="col-6 text-muted">Gearbox</div>
              <div class="col-6 fw-semibold text-end"><?= h($car["gearbox"] ?? "-") ?></div>

              <div class="col-6 text-muted">Mileage</div>
              <div class="col-6 fw-semibold text-end"><?= number_format((int)($car["mileage"] ?? 0)) ?> კმ</div>

              <div class="col-6 text-muted">Status</div>
              <div class="col-6 fw-semibold text-end"><?= h($statusText) ?></div>

              <div class="col-6 text-muted">Added</div>
              <div class="col-6 fw-semibold text-end"><?= h($car["created_at"] ?? "") ?></div>
            </div>

            <hr>

            <h6 class="mb-2">აღწერა</h6>
            <div class="text-muted" style="white-space: pre-wrap;">
              <?= h($car["description"] ?? "აღწერა არ არის.") ?>
            </div>

            <div class="d-grid mt-3">
              <a href="../index.php" class="btn btn-primary">კატალოგში დაბრუნება</a>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    function setMain(url, el){
      document.getElementById('mainImg').src = url;
      document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
      el.classList.add('active');
    }
  </script>
</body>
</html>
