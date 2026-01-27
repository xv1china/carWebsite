<?php
require "../includes/auth.php";
require "../config/db.php";

$carId = (int)($_GET["id"] ?? 0);
if ($carId <= 0) {
  header("Location: cars-manage.php");
  exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (empty($_FILES["images"]["name"][0])) {
    $error = "აირჩიე მინიმუმ 1 ფოტო.";
  } else {
    $uploadDir = __DIR__ . "/../assets/uploads/cars/" . $carId . "/";
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $allowedExt = ["jpg", "jpeg", "png", "webp"];
    $maxSize = 6 * 1024 * 1024;
    $fail = 0;

    for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {
      $tmp  = $_FILES["images"]["tmp_name"][$i] ?? "";
      $name = $_FILES["images"]["name"][$i] ?? "";
      $err  = $_FILES["images"]["error"][$i] ?? UPLOAD_ERR_NO_FILE;
      $size = (int)($_FILES["images"]["size"][$i] ?? 0);

      if ($err === UPLOAD_ERR_NO_FILE) continue;
      if ($err !== UPLOAD_ERR_OK) { $fail++; continue; }
      if (!$tmp || !is_uploaded_file($tmp)) { $fail++; continue; }
      if ($size <= 0 || $size > $maxSize) { $fail++; continue; }

      $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
      if (!in_array($ext, $allowedExt, true)) { $fail++; continue; }

      $mime = @mime_content_type($tmp);
      if ($mime && strpos($mime, "image/") !== 0) { $fail++; continue; }

      $fileName = uniqid("car_", true) . "." . $ext;

      if (move_uploaded_file($tmp, $uploadDir . $fileName)) {
        $stmtImg = $pdo->prepare("INSERT INTO car_images (car_id, image) VALUES (?, ?)");
        $stmtImg->execute([$carId, $fileName]);
      } else {
        $fail++;
      }
    }

    if ($fail > 0) {
      $success = "ფოტოები დაემატა, მაგრამ ზოგი ვერ აიტვირთა ($fail).";
    } else {
      $success = "ფოტოები წარმატებით დაემატა ✅";
    }
  }
}
?>

<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Add Photos</title>

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
        <div class="admin-sidebar__title">Admin Panel</div>
        <div class="admin-sidebar__subtitle">Cars</div>
      </div>
    </div>

    <nav class="admin-nav">
      <a class="admin-nav__link" href="dashboard.php"><span class="admin-nav__icon">🏠</span> Dashboard</a>
      <a class="admin-nav__link" href="cars-add.php"><span class="admin-nav__icon">➕</span> Add Car</a>
      <a class="admin-nav__link" href="cars-manage.php"><span class="admin-nav__icon">🚗</span> Manage Cars</a>

      <div class="admin-nav__sep"></div>
      <a class="admin-nav__link admin-nav__link--danger" href="logout.php"><span class="admin-nav__icon">⎋</span> Logout</a>
    </nav>
  </aside>

  <!-- Main -->
  <div class="admin-main">
    <!-- Topbar -->
    <header class="admin-topbar">
      <div class="admin-topbar__left">
        <div class="admin-topbar__badge">Car ID: <?= (int)$carId ?></div>
        <div class="admin-topbar__hint">ფოტოების დამატება</div>
      </div>

      <div class="admin-topbar__right d-flex gap-2">
        <a class="btn btn-outline-secondary admin-btn-soft" href="car-photos.php?id=<?= (int)$carId ?>">Back</a>
      </div>
    </header>

    <!-- Content -->
    <main class="admin-content">
      <div class="admin-card">
        <h2 class="admin-h2 mb-1">➕ Add Photos</h2>
        <div class="admin-muted mb-3">jpg/png/webp • მაქს. 6MB თითო ფოტო</div>

        <?php if ($success): ?>
          <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="admin-form">
          <label class="form-label">ფოტოები (multiple)</label>
          <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>

          <div class="admin-help mt-2 mb-3">
            რჩევა: მონიშნე ერთდროულად რამდენიმე ფოტო (Ctrl/Command).
          </div>

          <button class="btn btn-primary admin-btn">Upload</button>
        </form>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
