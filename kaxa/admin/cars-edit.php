<?php
require "../includes/auth.php";
require "../config/db.php";

$id = (int) ($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: cars-manage.php");
    exit;
}

$success = "";
$error = "";

$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    header("Location: cars-manage.php");
    exit;
}

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
        $error = "გთხოვ შეავსე აუცილებელი ველები (Brand, Model, Year, Price, Fuel, Gearbox).";
    } else {
        $upd = $pdo->prepare("
          UPDATE cars
          SET title = ?, brand = ?, model = ?, year = ?, price = ?, fuel = ?, gearbox = ?, mileage = ?, description = ?, status = ?
          WHERE id = ?
        ");
        $upd->execute([$title, $brand, $model, $year, $price, $fuel, $gearbox, $mileage, $description, $status, $id]);

        $stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        $success = "განახლდა ✅";
    }
}
?>

<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Edit Car</title>

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- Admin theme -->
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
        <div class="admin-topbar__badge">ID: <?= (int) $car["id"] ?></div>
        <div class="admin-topbar__hint">✏️ მანქანის რედაქტირება</div>
      </div>

      <div class="admin-topbar__right d-flex gap-2">
        <a class="btn btn-outline-secondary admin-btn-soft" href="cars-manage.php">Back</a>
        <a class="btn btn-outline-dark admin-btn-soft" href="car-photos.php?id=<?= (int) $car["id"] ?>">Photos</a>
      </div>
    </header>

    <!-- Content -->
    <main class="admin-content">
      <div class="admin-card">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <h2 class="admin-h2 mb-1">✏️ Edit Car</h2>
            <div class="admin-muted">
              <?= htmlspecialchars(($car["brand"] ?? "") . " " . ($car["model"] ?? "") . " • " . (int)($car["year"] ?? 0)) ?>
            </div>
          </div>
        </div>

        <?php if ($success): ?>
          <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="row g-3 admin-form">

          <div class="col-md-6">
            <label class="form-label">სათაური (optional)</label>
            <input
              name="title"
              class="form-control"
              value="<?= htmlspecialchars($car["title"] ?? "") ?>"
              placeholder="მაგ: Volvo FH16 2022"
            >
          </div>

          <div class="col-md-3">
            <label class="form-label">Brand *</label>
            <input
              name="brand"
              class="form-control"
              required
              value="<?= htmlspecialchars($car["brand"] ?? "") ?>"
              placeholder="Volvo"
            >
          </div>

          <div class="col-md-3">
            <label class="form-label">Model *</label>
            <input
              name="model"
              class="form-control"
              required
              value="<?= htmlspecialchars($car["model"] ?? "") ?>"
              placeholder="FH16"
            >
          </div>

          <div class="col-md-3">
            <label class="form-label">Year *</label>
            <input
              name="year"
              type="number"
              class="form-control"
              required
              value="<?= (int) ($car["year"] ?? 0) ?>"
            >
          </div>

          <div class="col-md-3">
            <label class="form-label">Price (₾) *</label>
            <input
              name="price"
              type="number"
              class="form-control"
              required
              value="<?= (int) ($car["price"] ?? 0) ?>"
            >
          </div>

          <div class="col-md-3">
            <label class="form-label">Fuel *</label>
            <?php $fuelVal = (string) ($car["fuel"] ?? ""); ?>
            <select name="fuel" class="form-select" required>
              <option value="">აირჩიე</option>
              <option <?= $fuelVal === "დიზელი" ? "selected" : "" ?>>დიზელი</option>
              <option <?= $fuelVal === "ბენზინი" ? "selected" : "" ?>>ბენზინი</option>
              <option <?= $fuelVal === "ჰიბრიდი" ? "selected" : "" ?>>ჰიბრიდი</option>
              <option <?= $fuelVal === "ელექტრო" ? "selected" : "" ?>>ელექტრო</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Gearbox *</label>
            <?php $gearVal = (string) ($car["gearbox"] ?? ""); ?>
            <select name="gearbox" class="form-select" required>
              <option value="">აირჩიე</option>
              <option <?= $gearVal === "ავტომატიკა" ? "selected" : "" ?>>ავტომატიკა</option>
              <option <?= $gearVal === "მექანიკა" ? "selected" : "" ?>>მექანიკა</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Mileage (კმ)</label>
            <input
              name="mileage"
              type="number"
              class="form-control"
              value="<?= (int) ($car["mileage"] ?? 0) ?>"
              placeholder="120000"
            >
          </div>

          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea
              name="description"
              rows="4"
              class="form-control"
              placeholder="აღწერა..."
            ><?= htmlspecialchars($car["description"] ?? "") ?></textarea>
          </div>

          <div class="col-md-3">
            <label class="form-label">Status *</label>
            <?php $statusVal = (string) ($car["status"] ?? "available"); ?>
            <select name="status" class="form-select" required>
              <option value="available" <?= $statusVal === "available" ? "selected" : "" ?>>გასაყიდი</option>
              <option value="sold" <?= $statusVal === "sold" ? "selected" : "" ?>>გაყიდულია</option>
            </select>
          </div>

          <div class="col-12 d-flex flex-wrap gap-2 mt-2">
            <button class="btn btn-primary admin-btn" type="submit">Update</button>
            <a class="btn btn-outline-secondary admin-btn-soft" href="cars-manage.php">Back</a>
            <a class="btn btn-outline-dark admin-btn-soft" href="car-photos.php?id=<?= (int) $car["id"] ?>">Photos</a>
          </div>

        </form>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
