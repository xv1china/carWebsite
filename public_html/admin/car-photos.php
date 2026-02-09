<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$carId = (int)($_GET["id"] ?? 0);
if ($carId <= 0) {
  header("Location: cars-manage.php");
  exit;
}

$stmtCar = $pdo->prepare("SELECT id, brand, model, year FROM car_main WHERE id = ?");
$stmtCar->execute([$carId]);
$car = $stmtCar->fetch(PDO::FETCH_ASSOC);

if (!$car) {
  header("Location: cars-manage.php");
  exit;
}

$stmt = $pdo->prepare("SELECT id, image FROM car_main_images WHERE car_id = ? ORDER BY id DESC");
$stmt->execute([$carId]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>მანქანის ფოტოები</title>

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- ერთიანი Admin CSS -->
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="admin">

  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <div class="admin-sidebar__brand">
      <div class="admin-sidebar__logo">A</div>
      <div>
        <div class="admin-sidebar__title">ადმინ პანელი</div>
        <div class="admin-sidebar__subtitle">მანქანები</div>
      </div>
    </div>

    <nav class="admin-nav">
      <a class="admin-nav__link" href="dashboard.php"><span class="admin-nav__icon">🏠</span> მთავარი</a>
      <a class="admin-nav__link" href="cars-add.php"><span class="admin-nav__icon">➕</span> მანქანის დამატება</a>
      <a class="admin-nav__link" href="cars-manage.php"><span class="admin-nav__icon">🚗</span> მანქანების მართვა</a>

      <div class="admin-nav__sep"></div>
      <a class="admin-nav__link admin-nav__link--danger" href="logout.php"><span class="admin-nav__icon">⎋</span> გასვლა</a>
    </nav>
  </aside>

  <!-- Main -->
  <div class="admin-main">

    <!-- Topbar -->
    <header class="admin-topbar">
      <div class="admin-topbar__left">
        <div class="admin-topbar__badge">მანქანის ID: <?= (int)$car["id"] ?></div>
        <div class="admin-topbar__hint">
          <?= htmlspecialchars(($car["brand"] ?? "") . " " . ($car["model"] ?? "") . " - " . ($car["year"] ?? "")) ?>
        </div>
      </div>

      <div class="admin-topbar__right d-flex gap-2">
        <a class="btn btn-outline-secondary admin-btn-soft" href="cars-manage.php">უკან</a>
        <a class="btn btn-primary admin-btn" href="car-photos-add.php?id=<?= (int)$carId ?>">ფოტოების დამატება</a>
      </div>
    </header>

    <!-- Content -->
    <main class="admin-content">
      <div class="admin-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <h2 class="admin-h2 mb-1">📷 ფოტოები</h2>
            <div class="admin-muted">სულ: <?= (int)count($images) ?> ფოტო</div>
          </div>
        </div>

        <?php if (empty($images)): ?>
          <div class="alert alert-info mb-0">ამ მანქანას ჯერ ფოტო არ აქვს.</div>
        <?php else: ?>
          <div class="row g-3">
            <?php foreach ($images as $img): ?>
              <?php
                $file = $img["image"] ?? "";
                $fileSafe = basename($file); // prevent ../ tricks
                $src = "../assets/uploads/cars/" . (int)$carId . "/" . $fileSafe;

                // Absolute path on server to validate existence
                $absPath = dirname(__DIR__) . "/assets/uploads/cars/" . (int)$carId . "/" . $fileSafe;
                $exists = ($fileSafe !== "" && is_file($absPath));
              ?>

              <div class="col-6 col-md-4 col-lg-3">
                <div class="admin-photo">
                  <?php if ($exists): ?>
                    <img
                      class="admin-photo__img"
                      src="<?= htmlspecialchars($src) ?>"
                      alt="მანქანის ფოტო"
                      loading="lazy"
                    >
                  <?php else: ?>
                    <div
                      class="admin-photo__img d-flex align-items-center justify-content-center bg-light text-muted"
                      style="height:180px;border-radius:12px;"
                    >
                      ფაილი ვერ მოიძებნა
                    </div>
                  <?php endif; ?>

                  <div class="admin-photo__footer">
                    <small class="text-muted">#<?= (int)$img["id"] ?></small>

                    <a
                      class="btn btn-sm btn-danger admin-btn-danger"
                      href="car-photos-delete.php?car_id=<?= (int)$carId ?>&img_id=<?= (int)$img["id"] ?>"
                      onclick="return confirm('ნამდვილად გინდა ფოტოს წაშლა?');"
                    >
                      წაშლა
                    </a>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </main>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
