<?php require __DIR__ . "/includes/auth.php"; ?>
<!doctype html>
<html lang="ka">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Dashboard</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="admin">

  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <div class="admin-sidebar__brand">
      <div class="admin-sidebar__logo">A</div>
      <div>
        <div class="admin-sidebar__title">Admin Panel</div>
        <div class="admin-sidebar__subtitle">Dashboard</div>
      </div>
    </div>

    <nav class="admin-nav">
      <a class="admin-nav__link" href="blog-add.php">
        <span class="admin-nav__icon">📝</span> Add Blog
      </a>
      <a class="admin-nav__link" href="blog-manage.php">
        <span class="admin-nav__icon">📰</span> Manage Blog
      </a>
      <a class="admin-nav__link" href="gallery-add.php">
        <span class="admin-nav__icon">📷</span> Add Gallery
      </a>
      <a class="admin-nav__link" href="gallery-manage.php">
        <span class="admin-nav__icon">🖼️</span> Manage Gallery
      </a>
      <a class="admin-nav__link" href="cars-add.php">
        <span class="admin-nav__icon">➕</span> Add Car
      </a>
      <a class="admin-nav__link" href="cars-manage.php">
        <span class="admin-nav__icon">🚗</span> Manage Cars
      </a>

      <div class="admin-nav__sep"></div>

      <a class="admin-nav__link admin-nav__link--danger" href="logout.php">
        <span class="admin-nav__icon">⎋</span> Logout
      </a>
    </nav>
  </aside>

  <!-- Main -->
  <div class="admin-main">
    <header class="admin-topbar">
      <div class="admin-topbar__left">
        <div class="admin-topbar__badge">● Online</div>
        <div class="admin-topbar__hint">ბლოგის, მანქანების და გალერეის მართვა</div>
      </div>

      <div class="admin-topbar__right">
        <a class="btn btn-primary admin-btn" href="blog-add.php">+ Add Blog</a>
        <a class="btn btn-primary admin-btn" href="gallery-add.php">+ Add Gallery</a>
        <a class="btn btn-primary admin-btn" href="cars-add.php">+ Add Gallery</a>
      </div>
    </header>

    <main class="admin-content">
      <div class="admin-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <div>
            <h2 class="admin-h2 mb-1">Admin Dashboard</h2>
            <div class="admin-muted">აირჩიე მოქმედება მენიუდან</div>
          </div>
        </div>

        <div class="row g-3 mt-3">
          <div class="col-md-6 col-lg-4">
            <a class="admin-tile" href="blog-add.php">
              <div class="admin-tile__icon">📝</div>
              <div>
                <div class="admin-tile__title">Add Blog</div>
                <div class="admin-tile__text">ახალი ბლოგის დამატება</div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4">
            <a class="admin-tile" href="blog-manage.php">
              <div class="admin-tile__icon">📰</div>
              <div>
                <div class="admin-tile__title">Manage Blog</div>
                <div class="admin-tile__text">პოსტების მართვა</div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4">
            <a class="admin-tile" href="gallery-add.php">
              <div class="admin-tile__icon">📷</div>
              <div>
                <div class="admin-tile__title">Add Gallery</div>
                <div class="admin-tile__text">გალერეის ელემენტის დამატება</div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4">
            <a class="admin-tile" href="gallery-manage.php">
              <div class="admin-tile__icon">🖼️</div>
              <div>
                <div class="admin-tile__title">Manage Gallery</div>
                <div class="admin-tile__text">გალერეის ელემენტების მართვა</div>
              </div>
            </a>
          </div>

                  <div class="row g-3 mt-3">
          <div class="col-md-6 col-lg-4">
            <a class="admin-tile" href="cars-add.php">
              <div class="admin-tile__icon">➕</div>
              <div>
                <div class="admin-tile__title">Add Car</div>
                <div class="admin-tile__text">ახალი მანქანის დამატება</div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4">
            <a class="admin-tile" href="cars-manage.php">
              <div class="admin-tile__icon">🚗</div>
              <div>
                <div class="admin-tile__title">Manage Cars</div>
                <div class="admin-tile__text">სია • რედაქტირება • წაშლა</div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4">
            <a class="admin-tile admin-tile--danger" href="logout.php">
              <div class="admin-tile__icon">⎋</div>
              <div>
                <div class="admin-tile__title">Logout</div>
                <div class="admin-tile__text">გასვლა ადმინიდან</div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>