<?php
require "../includes/auth.php";
require "../config/db.php";

$stmt = $pdo->query("SELECT * FROM cars ORDER BY created_at DESC");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Manage Cars</title>

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
        <div class="admin-topbar__badge">Cars</div>
        <div class="admin-topbar__hint">🚗 მანქანების მართვა</div>
      </div>

      <div class="admin-topbar__right d-flex gap-2">
        <a class="btn btn-primary admin-btn" href="cars-add.php">+ Add Car</a>
        <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">Dashboard</a>
      </div>
    </header>

    <!-- Content -->
    <main class="admin-content">
      <div class="admin-card">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <h2 class="admin-h2 mb-1">🚗 მანქანების სია</h2>
            <div class="admin-muted">სულ: <?= (int)count($cars) ?></div>
          </div>
        </div>

        <?php if (empty($cars)): ?>
          <div class="alert alert-info mb-0">ჯერ არცერთი მანქანა არ არის დამატებული.</div>
        <?php else: ?>
          <div class="table-responsive">
            <table class="table admin-table align-middle mb-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Brand</th>
                  <th>Model</th>
                  <th>Year</th>
                  <th>Price</th>
                  <th>Fuel</th>
                  <th>Gearbox</th>
                  <th>Created</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($cars as $car): ?>
                <tr>
                  <td class="admin-td-id">#<?= (int) $car["id"] ?></td>
                  <td><?= htmlspecialchars($car["brand"] ?? "") ?></td>
                  <td><?= htmlspecialchars($car["model"] ?? "") ?></td>
                  <td><?= (int) ($car["year"] ?? 0) ?></td>
                  <td class="fw-bold"><?= number_format((int) ($car["price"] ?? 0)) ?> ₾</td>
                  <td><?= htmlspecialchars($car["fuel"] ?? "") ?></td>
                  <td><?= htmlspecialchars($car["gearbox"] ?? "") ?></td>
                  <td class="text-muted small"><?= htmlspecialchars($car["created_at"] ?? "") ?></td>

                  <td class="text-end">
                    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                      <a class="btn btn-sm btn-outline-dark admin-action" href="cars-edit.php?id=<?= (int) $car["id"] ?>">
                        ✏️ Edit
                      </a>

                      <a class="btn btn-sm btn-outline-primary admin-action" href="car-photos.php?id=<?= (int) $car["id"] ?>">
                        📷 Photos
                      </a>

                      <a class="btn btn-sm btn-outline-danger admin-action"
                         href="cars-delete.php?id=<?= (int) $car["id"] ?>"
                         onclick="return confirm('წაშლა გინდა მართლა?');">
                        🗑 Delete
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>

      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
