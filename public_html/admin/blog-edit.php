<?php
require __DIR__ . "/includes/auth.php";
require __DIR__ . "/config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: blog-manage.php");
    exit;
}

// მოვიტანოთ ბლოგი
$stmt = $pdo->prepare("SELECT * FROM blog WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header("Location: blog-manage.php");
    exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $content = trim($_POST["content"] ?? "");

    if ($title === "" || $content === "") {
        $error = "სათაური და შინაარსი სავალდებულოა.";
    } else {
        // 1) ტექსტების update
        $upd = $pdo->prepare("
            UPDATE blog
            SET title = ?, content = ?, updated_at = NOW()
            WHERE id = ?
        ");
        $upd->execute([$title, $content, $id]);

        // 2) IMAGE UPDATE (optional)
        if (!empty($_FILES["image"]["name"])) {
            $uploadDir = dirname(__DIR__) . "/assets/uploads/blog/" . $id . "/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $allowed = ["jpg", "jpeg", "png", "webp"];
            $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

            // basic checks
            $tmp = $_FILES["image"]["tmp_name"] ?? "";
            $err = $_FILES["image"]["error"] ?? UPLOAD_ERR_NO_FILE;

            if ($err === UPLOAD_ERR_OK && $tmp && is_uploaded_file($tmp) && in_array($ext, $allowed, true)) {

                // ძველი სურათის წაშლა (თუ არსებობს)
                if (!empty($post["image"])) {
                    $old = $uploadDir . $post["image"];
                    if (is_file($old)) {
                        @unlink($old);
                    }
                }

                $fileName = uniqid("blog_", true) . "." . $ext;

                if (move_uploaded_file($tmp, $uploadDir . $fileName)) {
                    $stmtImg = $pdo->prepare("UPDATE blog SET image = ? WHERE id = ?");
                    $stmtImg->execute([$fileName, $id]);
                }
            }
        }

        // refresh (რომ ახალი ფოტო/ტექსტი გამოჩნდეს)
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        $success = "ბლოგი განახლდა ✅";
    }
}
?>
<!doctype html>
<html lang="ka">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ბლოგის რედაქტირება</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <div class="container py-4">
        <div class="admin-card">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div class="admin-h2 mb-1">✏️ ბლოგის რედაქტირება</div>
                    <div class="admin-muted">ID: #<?= (int)$post["id"] ?></div>
                </div>
                <a class="btn btn-outline-secondary admin-btn-soft" href="blog-manage.php">უკან</a>
            </div>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="row g-3">

                <div class="col-12">
                    <label class="form-label">სათაური *</label>
                    <input name="title" class="form-control" value="<?= htmlspecialchars($post["title"]) ?>" required>
                </div>

                <div class="col-12">
                    <label class="form-label">შინაარსი *</label>
                    <textarea name="content" rows="10" class="form-control"
                        required><?= htmlspecialchars($post["content"]) ?></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">მიმდინარე სურათი</label><br>

                    <?php if (!empty($post["image"])): ?>
                        <img src="../assets/uploads/blog/<?= (int)$post["id"] ?>/<?= htmlspecialchars($post["image"]) ?>"
                            style="width:180px;height:110px;object-fit:cover;border-radius:12px;">
                    <?php else: ?>
                        <span class="admin-badge admin-badge--muted">სურათი არ არის</span>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label class="form-label">სურათის შეცვლა</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">jpg / png / webp</div>
                </div>

                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-warning admin-btn">განახლება</button>
                    <a href="blog-manage.php" class="btn btn-outline-secondary admin-btn-soft">გაუქმება</a>
                </div>

            </form>

        </div>
    </div>

</body>

</html>
