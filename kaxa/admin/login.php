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
  } elseif (password_verify($password, $admin["password"])) {
    $_SESSION["admin_id"] = (int)$admin["id"];
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "არასწორი username ან password";
  }
}
?>
<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- შენი admin css -->
  <link rel="stylesheet" href="../assets/css/admin.css">

  <style>
    /* Login layout only */
    .login-wrap{
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 20px;
    }
    .login-card{
      width: 100%;
      max-width: 420px;
      background: var(--admin-card);
      border: 1px solid var(--admin-border);
      border-radius: var(--admin-radius);
      box-shadow: 0 10px 20px rgba(0,0,0,.04);
      padding: 26px;
    }
    .login-logo{
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: #f0fdf4;
      border: 1px solid rgba(22,163,74,.25);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 900;
      color: var(--admin-primary-700);
      margin-inline: auto;
    }
    .login-title{
      font-weight: 900;
      margin-top: 10px;
    }
    .login-sub{
      color: var(--admin-muted);
      font-size: 13px;
    }
  </style>
</head>

<body>

<div class="login-wrap">
  <div class="login-card">

    <div class="text-center mb-4">
      <div class=""><img src="../main-site/images/logo.png" width="100px" alt="logo"></div>
      <div class="login-title">ადმინისტრატორის ავტორიზაცია</div>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger py-2">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="post" class="admin-form">

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input
          type="text"
          name="username"
          class="form-control"
          value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"
          required
        >
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input
          type="password"
          name="password"
          class="form-control"
          required
        >
      </div>

      <button class="btn btn-primary admin-btn w-100">
        Login
      </button>

    </form>

    <div class="text-center mt-4 admin-muted">
      © <?= date("Y") ?> Admin Panel
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
