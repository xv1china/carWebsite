<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$stmt = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gallery Manage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container py-4">
  <div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <div class="admin-h2 mb-1">📷 Gallery Manage</div>
        <div class="admin-muted">ყველა ელემენტი</div>
      </div>
      <div class="d-flex gap-2">
        <a class="btn btn-primary admin-btn" href="gallery-add.php">+ Add</a>
        <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">Back</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>სურათი</th>
            <th>სათაური</th>
            <th>სტატუსი</th>
            <th>თარიღი</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
            <?php
            $img = !empty($item["image"])
              ? "../assets/uploads/gallery/" . (int) $item["id"] . "/" . $item["image"]
              : "";
            ?>
            <tr>
              <td class="admin-td-id">#<?= (int) $item["id"] ?></td>
              <td>
                <?php if ($img): ?>
                  <img src="<?= htmlspecialchars($img) ?>" style="width:70px;height:44px;object-fit:cover;border-radius:10px;">
                <?php else: ?>
                  <span class="admin-badge admin-badge--muted">No image</span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($item["title"] ?? "-") ?></td>
              <td>
                <span class="admin-badge <?= ($item["status"] ?? "active") === "active" ? "admin-badge--ok" : "admin-badge--muted" ?>">
                  <?= htmlspecialchars($item["status"] ?? "active") ?>
                </span>
              </td>
              <td class="text-muted"><?= htmlspecialchars($item["created_at"] ?? "") ?></td>
              <td class="text-end d-flex justify-content-end gap-2">
                <a class="btn btn-sm btn-outline-warning admin-action" href="gallery-edit.php?id=<?= (int) $item["id"] ?>">Edit</a>
                <a class="btn btn-sm btn-outline-danger admin-action" href="gallery-delete.php?id=<?= (int) $item["id"] ?>" onclick="return confirm('წაშლა გინდა?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>

          <?php if (!$items): ?>
            <tr>
              <td colspan="6" class="text-center text-muted py-4">ცარიელია</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
