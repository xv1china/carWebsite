<?php
session_start();
require "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? "");
  $password = (string)($_POST["password"] ?? "");

  $stmt = $pdo->prepare("SELECT id, username, password FROM admin WHERE username = ? LIMIT 1");
  $stmt->execute([$username]);
  $admin = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$admin || empty($admin["password"])) {
    $error = "არასწორი username ან password";
  } else {
    if (password_verify($password, $admin["password"])) {
      $_SESSION["admin_id"] = (int)$admin["id"];
      header("Location: dashboard.php");
      exit;
    } else {
      $error = "არასწორი username ან password";
    }
  }
}
?>

<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- ერთიანი admin theme -->
<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body class="admin-auth">
  <div class="admin-auth__bg"></div>

  <main class="admin-auth__wrap">
    <div class="admin-auth__card">
      <div class="admin-auth__brand">
        <!-- თუ გინდა ლოგო ჩასვი -->
        <!-- <img src="../assets/images/logo.png" alt="Logo" height="34"> -->
        <div class="admin-auth__title">Admin Panel</div>
        <div class="admin-auth__subtitle">შესვლა ადმინისტრატორის ანგარიშით</div>
      </div>

      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger small mb-3"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="post" class="admin-auth__form" autocomplete="on">
        <div class="mb-2">
          <label class="form-label small mb-1">Username</label>
          <input class="form-control admin-input" name="username" placeholder="Enter username" required>
        </div>

        <div class="mb-3">
          <label class="form-label small mb-1">Password</label>
          <input class="form-control admin-input" type="password" name="password" placeholder="Enter password" required>
        </div>

        <button class="btn btn-primary admin-btn w-100">Login</button>

      </form>
    </div>
  </main>
</body>
</html>
