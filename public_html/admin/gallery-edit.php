<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: gallery-manage.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    header("Location: gallery-manage.php");
    exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $status = in_array($_POST["status"] ?? "", ["active", "inactive"], true) ? $_POST["status"] : "active";

    $upd = $pdo->prepare("UPDATE gallery SET title = ?, description = ?, status = ?, updated_at = NOW() WHERE id = ?");
    $upd->execute([$title ?: null, $description ?: null, $status, $id]);

    if (!empty($_FILES["image"]["name"])) {
        $uploadDir = dirname(__DIR__) . "/assets/uploads/gallery/" . $id . "/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $allowed = ["jpg", "jpeg", "png", "webp"];
        $maxSize = 6 * 1024 * 1024;
        $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $tmp = $_FILES["image"]["tmp_name"] ?? "";
        $fileErr = $_FILES["image"]["error"] ?? UPLOAD_ERR_NO_FILE;
        $size = (int)($_FILES["image"]["size"] ?? 0);

        if ($fileErr === UPLOAD_ERR_OK && $tmp && is_uploaded_file($tmp) && in_array($ext, $allowed, true) && $size > 0 && $size <= $maxSize) {
            if (!empty($item["image"])) {
                $old = $uploadDir . $item["image"];
                if (is_file($old)) @unlink($old);
            }
            $fileName = "gallery_" . uniqid("", true) . "." . $ext;
            if (move_uploaded_file($tmp, $uploadDir . $fileName)) {
                $pdo->prepare("UPDATE gallery SET image = ? WHERE id = ?")->execute([$fileName, $id]);
                $item["image"] = $fileName;
            }
        }
    }

    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    $success = "განახლდა ✅";
}
?>
<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gallery Edit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container py-4">
  <div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <div class="admin-h2 mb-1">✏️ Gallery Edit</div>
        <div class="admin-muted">ID: #<?= (int)$item["id"] ?></div>
      </div>
      <a class="btn btn-outline-secondary admin-btn-soft" href="gallery-manage.php">Back</a>
    </div>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="admin-form">
      <div class="mb-3">
        <label class="form-label">მიმდინარე სურათი</label><br>
        <?php if (!empty($item["image"])): ?>
          <img src="../assets/uploads/gallery/<?= (int)$item["id"] ?>/<?= htmlspecialchars($item["image"]) ?>" style="width:180px;height:110px;object-fit:cover;border-radius:12px;">
        <?php else: ?>
          <span class="admin-badge admin-badge--muted">No image</span>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label class="form-label">შეცვალე სურათი</label>
        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        <div class="admin-help mt-1">jpg, png, webp – max 6MB</div>
      </div>
      <div class="mb-3">
        <label class="form-label">სათაური</label>
        <input name="title" class="form-control" value="<?= htmlspecialchars($item["title"] ?? "") ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">აღწერა</label>
        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($item["description"] ?? "") ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">სტატუსი</label>
        <select name="status" class="form-select">
          <option value="active" <?= ($item["status"] ?? "active") === "active" ? "selected" : "" ?>>Active</option>
          <option value="inactive" <?= ($item["status"] ?? "") === "inactive" ? "selected" : "" ?>>Inactive</option>
        </select>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-primary admin-btn">Update</button>
        <a href="gallery-manage.php" class="btn btn-outline-secondary admin-btn-soft">Cancel</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
