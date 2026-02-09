<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$stmt = $pdo->query("SELECT * FROM blog ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="ka">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ბლოგების მართვა</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

  <div class="container py-4">
    <div class="admin-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <div class="admin-h2 mb-1">🗂️ ბლოგების მართვა</div>
          <div class="admin-muted">ყველა პოსტი</div>
        </div>
        <div class="d-flex gap-2">
          <a class="btn btn-primary admin-btn" href="blog-add.php">+ ბლოგის დამატება</a>
          <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">უკან</a>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table admin-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>სურათი</th>
              <th>სათაური</th>
              <th>თარიღი</th>
              <th class="text-end">ქმედებები</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($posts as $p): ?>
              <?php
              $img = !empty($p["image"])
                ? "../assets/uploads/blog/" . (int) $p["id"] . "/" . $p["image"]
                : "";
              ?>
              <tr>
                <td class="admin-td-id">#<?= (int) $p["id"] ?></td>
                <td>
                  <?php if ($img): ?>
                    <img src="<?= htmlspecialchars($img) ?>"
                      style="width:70px;height:44px;object-fit:cover;border-radius:10px;">
                  <?php else: ?>
                    <span class="admin-badge admin-badge--muted">სურათი არ არის</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($p["title"]) ?></td>
                <td class="text-muted"><?= htmlspecialchars($p["created_at"] ?? "") ?></td>
                <td class="text-end d-flex justify-content-end gap-2">
                  <a class="btn btn-outline-warning admin-action" href="blog-edit.php?id=<?= (int) $p["id"] ?>">
                    რედაქტირება
                  </a>

                  <a class="btn btn-outline-danger admin-action" href="blog-delete.php?id=<?= (int) $p["id"] ?>"
                    onclick="return confirm('ნამდვილად გინდა წაშლა?');">
                    წაშლა
                  </a>
                </td>

              </tr>
            <?php endforeach; ?>

            <?php if (!$posts): ?>
              <tr>
                <td colspan="5" class="text-center text-muted">ცარიელია</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</body>

</html>
