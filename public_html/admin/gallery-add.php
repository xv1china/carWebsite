<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";
require __DIR__ . "/includes/translate.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $status = in_array($_POST["status"] ?? "", ["active", "inactive"], true) ? $_POST["status"] : "active";

    if (empty($_FILES["image"]["name"])) {
        $error = "სურათი აუცილებელია.";
    } else {
        $tmp  = $_FILES["image"]["tmp_name"] ?? "";
        $name = $_FILES["image"]["name"] ?? "";
        $err  = $_FILES["image"]["error"] ?? UPLOAD_ERR_NO_FILE;
        $size = (int)($_FILES["image"]["size"] ?? 0);

        $allowedExt = ["jpg", "jpeg", "png", "webp"];
        $maxSize = 6 * 1024 * 1024;
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        if ($err !== UPLOAD_ERR_OK || !$tmp || !is_uploaded_file($tmp)) {
            $error = "სურათის ატვირთვა ვერ მოხერხდა.";
        } elseif ($size <= 0 || $size > $maxSize) {
            $error = "სურათის ზომა არ უნდა აღემატებოდეს 6MB.";
        } elseif (!in_array($ext, $allowedExt, true)) {
            $error = "დაშვებული ფორმატები: jpg, png, webp.";
        } else {
            $mime = @mime_content_type($tmp);
            if ($mime && strpos($mime, "image/") !== 0) {
                $error = "ფაილი უნდა იყოს სურათი.";
            } else {

                // ✅ translate pack
                [$title_ka, $title_en, $title_ru] = translate_pack_ka($title);
                [$desc_ka, $desc_en, $desc_ru] = translate_pack_ka($description);

                $stmt = $pdo->prepare("
                  INSERT INTO gallery (
                    title, description, image, status,
                    title_ka, title_en, title_ru,
                    description_ka, description_en, description_ru
                  )
                  VALUES (?, ?, '', ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                  $title ?: null,
                  $description ?: null,
                  $status,
                  $title_ka ?: null, $title_en ?: null, $title_ru ?: null,
                  $desc_ka ?: null, $desc_en ?: null, $desc_ru ?: null
                ]);

                $galleryId = (int)$pdo->lastInsertId();

                $uploadDir = dirname(__DIR__) . "/assets/uploads/gallery/" . $galleryId . "/";
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $fileName = "gallery_" . uniqid("", true) . "." . $ext;

                if (move_uploaded_file($tmp, $uploadDir . $fileName)) {
                    $up = $pdo->prepare("UPDATE gallery SET image = ? WHERE id = ?");
                    $up->execute([$fileName, $galleryId]);
                    header("Location: gallery-manage.php");
                    exit;
                } else {
                    $error = "ფაილის შენახვა ვერ მოხერხდა.";
                }
            }
        }
    }
}
?>

<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gallery Add</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container py-4">
  <div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <div class="admin-h2 mb-1">📷 გალერეის დამატება</div>
        <div class="admin-muted">სურათი + სათაური + აღწერა</div>
      </div>
      <div class="d-flex gap-2">
        <a class="btn btn-outline-primary admin-btn-soft" href="gallery-manage.php">Manage</a>
        <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">Back</a>
      </div>
    </div>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="admin-form">
      <div class="mb-3">
        <label class="form-label">სურათი *</label>
        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
        <div class="admin-help mt-1">jpg, png, webp – max 6MB</div>
      </div>
      <div class="mb-3">
        <label class="form-label">სათაური (ოფციური)</label>
        <input name="title" class="form-control" value="<?= htmlspecialchars($_POST["title"] ?? "") ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">აღწერა (ოფციური)</label>
        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($_POST["description"] ?? "") ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">სტატუსი</label>
        <select name="status" class="form-select">
          <option value="active" <?= ($_POST["status"] ?? "active") === "active" ? "selected" : "" ?>>Active</option>
          <option value="inactive" <?= ($_POST["status"] ?? "") === "inactive" ? "selected" : "" ?>>Inactive</option>
        </select>
      </div>
      <button class="btn btn-primary admin-btn">Save</button>
    </form>
  </div>
</div>

</body>
</html>
