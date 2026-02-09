<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";
require __DIR__ . "/includes/translate.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $brand = trim($_POST["brand"] ?? "");
    $model = trim($_POST["model"] ?? "");
    $year = (int) ($_POST["year"] ?? 0);
    $price = (int) ($_POST["price"] ?? 0);
    $fuel = trim($_POST["fuel"] ?? "");
    $gearbox = trim($_POST["gearbox"] ?? "");
    $mileage = (int) ($_POST["mileage"] ?? 0);
    $description = trim($_POST["description"] ?? "");
    $status = ($_POST["status"] ?? "available") === "sold" ? "sold" : "available";

    if ($brand === "" || $model === "" || $year <= 0 || $price <= 0 || $fuel === "" || $gearbox === "") {
        $error = "გთხოვ შეავსე აუცილებელი ველები (ბრენდი, მოდელი, წელი, ფასი, საწვავი, გადაცემათა კოლოფი).";
    } else {
        // ✅ translate pack (KA->EN/RU)
        [$title_ka, $title_en, $title_ru] = translate_pack_ka($title);
        [$desc_ka, $desc_en, $desc_ru] = translate_pack_ka($description);

        $stmt = $pdo->prepare("
          INSERT INTO car_main (
            title, brand, model, year, price, fuel, gearbox, mileage, description, status,
            title_ka, title_en, title_ru,
            description_ka, description_en, description_ru
          )
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $title, $brand, $model, $year, $price, $fuel, $gearbox, $mileage, $description, $status,
            $title_ka, $title_en, $title_ru,
            $desc_ka, $desc_en, $desc_ru
        ]);

        $carId = (int) $pdo->lastInsertId();

        $uploadErrorCount = 0;

        if (!empty($_FILES["images"]["name"][0])) {
            $uploadDir = dirname(__DIR__) . "/assets/uploads/cars/" . $carId . "/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $allowedExt = ["jpg", "jpeg", "png", "webp"];
            $maxSize = 6 * 1024 * 1024;

            for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {
                $tmp  = $_FILES["images"]["tmp_name"][$i] ?? "";
                $name = $_FILES["images"]["name"][$i] ?? "";
                $err  = $_FILES["images"]["error"][$i] ?? UPLOAD_ERR_NO_FILE;
                $size = (int)($_FILES["images"]["size"][$i] ?? 0);

                if ($err === UPLOAD_ERR_NO_FILE) continue;
                if ($err !== UPLOAD_ERR_OK) { $uploadErrorCount++; continue; }
                if (!$tmp || !is_uploaded_file($tmp)) { $uploadErrorCount++; continue; }
                if ($size <= 0 || $size > $maxSize) { $uploadErrorCount++; continue; }

                $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowedExt, true)) { $uploadErrorCount++; continue; }

                $mime = @mime_content_type($tmp);
                if ($mime && strpos($mime, "image/") !== 0) { $uploadErrorCount++; continue; }

                $fileName = uniqid("car_", true) . "." . $ext;

                if (move_uploaded_file($tmp, $uploadDir . $fileName)) {
                    $stmtImg = $pdo->prepare("INSERT INTO car_main_images (car_id, image) VALUES (?, ?)");
                    $stmtImg->execute([$carId, $fileName]);
                } else {
                    $uploadErrorCount++;
                }
            }
        }

        $success = $uploadErrorCount > 0
            ? "მანქანა დაემატა ✅ (ID: $carId). ზოგი ფოტო ვერ აიტვირთა ($uploadErrorCount)."
            : "მანქანა დაემატა ✅ (ID: $carId)";
    }
}
?>

<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>მანქანის დამატება</title>

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
        <div class="admin-topbar__badge">მანქანები</div>
        <div class="admin-topbar__hint">➕ მანქანის დამატება</div>
      </div>

      <div class="admin-topbar__right d-flex gap-2">
        <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">უკან</a>
        <a class="btn btn-outline-dark admin-btn-soft" href="cars-manage.php">მართვა</a>
      </div>
    </header>

    <!-- Content -->
    <main class="admin-content">
      <div class="admin-card">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <h2 class="admin-h2 mb-1">➕ მანქანის დამატება</h2>
            <div class="admin-muted">შეავსე ველები და შეინახე</div>
          </div>
        </div>

        <?php if ($success): ?>
          <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="row g-3 admin-form">

          <div class="col-md-6">
            <label class="form-label">სათაური (არასავალდებულო)</label>
            <input name="title" class="form-control" placeholder="მაგ: Volvo FH16 2022">
          </div>

          <div class="col-md-3">
            <label class="form-label">ბრენდი *</label>
            <input name="brand" class="form-control" required placeholder="Volvo">
          </div>

          <div class="col-md-3">
            <label class="form-label">მოდელი *</label>
            <input name="model" class="form-control" required placeholder="FH16">
          </div>

          <div class="col-md-3">
            <label class="form-label">წელი *</label>
            <input name="year" type="number" class="form-control" required placeholder="2022">
          </div>

          <div class="col-md-3">
            <label class="form-label">ფასი (₾) *</label>
            <input name="price" type="number" class="form-control" required placeholder="85000">
          </div>

          <div class="col-md-3">
            <label class="form-label">საწვავი *</label>
            <select name="fuel" class="form-select" required>
              <option value="">აირჩიე</option>
              <option>დიზელი</option>
              <option>ბენზინი</option>
              <option>ჰიბრიდი</option>
              <option>ელექტრო</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">გადაცემათა კოლოფი *</label>
            <select name="gearbox" class="form-select" required>
              <option value="">აირჩიე</option>
              <option>ავტომატიკა</option>
              <option>მექანიკა</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">გარბენი (კმ)</label>
            <input name="mileage" type="number" class="form-control" placeholder="120000">
          </div>

          <div class="col-12">
            <label class="form-label">აღწერა</label>
            <textarea name="description" rows="4" class="form-control" placeholder="აღწერა..."></textarea>
          </div>

          <div class="col-12">
            <label class="form-label">ფოტოები (მრავლობითი)</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            <div class="admin-help mt-2">შეგიძლია 1-ზე მეტი ფოტო ატვირთო. (jpg/png/webp) მაქს 6MB თითო.</div>
          </div>

          <div class="col-md-3">
            <label class="form-label">სტატუსი *</label>
            <select name="status" class="form-select" required>
              <option value="available" selected>გასაყიდი</option>
              <option value="sold">გაყიდულია</option>
            </select>
          </div>

          <div class="col-12 d-flex flex-wrap gap-2 mt-2">
            <button class="btn btn-primary admin-btn" type="submit">შენახვა</button>
            <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">უკან</a>
            <a class="btn btn-outline-dark admin-btn-soft" href="cars-manage.php">მართვა</a>
          </div>

        </form>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
