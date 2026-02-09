<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";
require __DIR__ . "/includes/translate.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"] ?? "");
  $content = trim($_POST["content"] ?? "");

  if ($title === "" || $content === "") {
    $error = "სათაური და შინაარსი აუცილებელია.";
  } else {

    // ✅ translate pack
    [$title_ka, $title_en, $title_ru] = translate_pack_ka($title);

    // content ხშირად გრძელი ტექსტია — API error-ზე fallback მაინც იმუშავებს
    [$content_ka, $content_en, $content_ru] = translate_pack_ka($content);

    $stmt = $pdo->prepare("
      INSERT INTO blog (title, content, image, title_ka, title_en, title_ru, content_ka, content_en, content_ru)
      VALUES (?, ?, NULL, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
      $title, $content,
      $title_ka, $title_en, $title_ru,
      $content_ka, $content_en, $content_ru
    ]);

    $postId = (int)$pdo->lastInsertId();

    // image upload (optional) — იგივე დაგიტოვე
    if (!empty($_FILES["image"]["name"])) {
      $tmp  = $_FILES["image"]["tmp_name"] ?? "";
      $name = $_FILES["image"]["name"] ?? "";
      $err  = $_FILES["image"]["error"] ?? UPLOAD_ERR_NO_FILE;
      $size = (int)($_FILES["image"]["size"] ?? 0);

      $allowedExt = ["jpg","jpeg","png","webp"];
      $maxSize = 6 * 1024 * 1024;

      if ($err === UPLOAD_ERR_OK && $tmp && is_uploaded_file($tmp) && $size > 0 && $size <= $maxSize) {
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExt, true)) {
          $mime = @mime_content_type($tmp);
          if (!$mime || strpos($mime, "image/") === 0) {

            $dir = dirname(__DIR__) . "/assets/uploads/blog/" . $postId . "/";
            if (!is_dir($dir)) mkdir($dir, 0777, true);

            $fileName = "blog_" . uniqid("", true) . "." . $ext;

            if (move_uploaded_file($tmp, $dir . $fileName)) {
              $up = $pdo->prepare("UPDATE blog SET image = ? WHERE id = ?");
              $up->execute([$fileName, $postId]);
            }
          }
        }
      }
    }

    $success = "ბლოგი დაემატა ✅ (ID: $postId)";
  }
}
?>


<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ბლოგის დამატება</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container py-4">
  <div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <div class="admin-h2 mb-1">📝 ბლოგის დამატება</div>
        <div class="admin-muted">სათაური + შინაარსი + სურათი</div>
      </div>
      <div class="d-flex gap-2">
        <a class="btn btn-outline-primary admin-btn-soft" href="blog-manage.php">მართვა</a>
        <a class="btn btn-outline-secondary admin-btn-soft" href="dashboard.php">უკან</a>
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
        <label class="form-label">სათაური *</label>
        <input name="title" class="form-control" required value="<?= htmlspecialchars($_POST["title"] ?? "") ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">შინაარსი *</label>
        <textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars($_POST["content"] ?? "") ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">სურათი (არასავალდებულო)</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="admin-help mt-1">jpg/png/webp, მაქს. 6MB</div>
      </div>

      <button class="btn btn-primary admin-btn">შენახვა</button>
    </form>
  </div>
</div>

</body>
</html>
