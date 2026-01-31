<?php
require __DIR__ . "/admin/config/db.php";

function post_image_url(array $p): string {
  if (!empty($p["image"])) {
    return "assets/uploads/blog/" . (int)$p["id"] . "/" . $p["image"];
  }
  return "assets/images/truck-1.jpg";
}

function excerpt(string $text, int $len = 190): string {
  $t = trim(strip_tags($text));
  if (mb_strlen($t) <= $len) return $t;
  return mb_substr($t, 0, $len) . "...";
}

$id = (int)($_GET["id"] ?? 0);

// ===== Single post =====
$post = null;
if ($id > 0) {
  $stmt = $pdo->prepare("SELECT id, title, content, image, created_at FROM blog WHERE id = ? LIMIT 1");
  $stmt->execute([$id]);
  $post = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$post) {
    header("Location: blog.php");
    exit;
  }
}

// ===== List + search + pagination =====
$q = "";
$page = 1;
$pages = 1;
$posts = [];

if ($id <= 0) {
  $q = trim($_GET["q"] ?? "");
  $page = max(1, (int)($_GET["page"] ?? 1));
  $limit = 6;
  $offset = ($page - 1) * $limit;

  $where = "";
  $params = [];

  if ($q !== "") {
    $where = "WHERE title LIKE ? OR content LIKE ?";
    $like = "%".$q."%";
    $params = [$like, $like];
  }

  $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM blog $where");
  $stmtCount->execute($params);
  $total = (int)$stmtCount->fetchColumn();
  $pages = max(1, (int)ceil($total / $limit));

  if ($page > $pages) $page = $pages;
  $offset = ($page - 1) * $limit;

  $stmt = $pdo->prepare("SELECT id, title, content, image, created_at FROM blog $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
  $stmt->execute($params);
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="ka" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ბლოგი - კკკ & კომპანია | Blog</title>
    <meta name="description" content="სატვირთო მანქანების, ლოჯისტიკისა და გადაზიდვების შესახებ სიახლეები და სტატიები">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
       <style>
        <style>

        /* BLOG cards equal sizes */
        .blog-card-modern {
            height: 100%;
        }

        .blog-card-modern .row {
            height: 100%;
        }

        /* fix image size */
        .blog-card-modern .blog-img {
            width: 100%;
            height: 220px;
            /* შეგიძლია შეცვალო 200/240 */
            object-fit: cover;
        }

        /* make body same height */
        .blog-card-modern .card-body {
            min-height: 220px;
            /* ტექსტი რომ არ “გადმოიყაროს” */
        }

        /* clamp title */
        .blog-card-modern .card-title {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            /* მაქს 2 ხაზი */
            overflow: hidden;
        }

        /* clamp excerpt */
        .blog-card-modern .card-text {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            /* მაქს 3 ხაზი */
            overflow: hidden;
        }
    </style>
    </style>
</head>
<body class="bg-light">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container py-2 d-flex justify-content-between align-items-center">
            <p class="mb-0 opacity-75">+995 551 04 75 35</p>
            <div class="d-flex gap-3 align-items-center">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" type="button"
                        data-bs-toggle="dropdown">
                        <img src="assets/images/Flag_of_Georgia.svg.png" width="30" height="20" alt=""> KA
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item d-flex align-items-center gap-1" href="#"><img
                                    src="assets/images/Flag_of_the_United_States.svg.webp" width="30" height="20" alt="">EN</a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center gap-1" href="#"><img
                                    src="assets/images/Flag_of_Georgia.svg.png" width="30" height="20" alt="">KA</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" type="button"
                        data-bs-toggle="dropdown">
                        ₾ GEL
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">₾ GEL</a></li>
                        <li><a class="dropdown-item" href="#">$ USD</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a href="index.php"><img src="assets/images/logo.png" width="70" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item"><a class="nav-link" href="index.php">მთავარი</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">ჩვენს შესახებ</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">ფოტო გალერეა</a></li>
                    <li class="nav-item"><a class="nav-link active" href="blog.php">ბლოგი</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">კონტაქტი</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Blog Header -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">ბლოგი</h1>
            <p class="lead">სიახლეები და სტატიები სატვირთო მანქანების, ლოჯისტიკისა და გადაზიდვების შესახებ</p>

            <?php if ($id <= 0): ?>
              <div class="row justify-content-center mt-4">
                <div class="col-lg-6">
                  <form method="get" class="d-flex gap-2">
                    <input name="q" class="form-control" placeholder="ძებნა..." value="<?= htmlspecialchars($q) ?>">
                    <button class="btn btn-light fw-bold">Search</button>
                  </form>
                </div>
              </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Blog Posts -->
    <section class="py-5">
        <div class="container">

        <?php if ($id > 0): ?>
            <?php $img = post_image_url($post); ?>
            <a href="blog.php" class="btn btn-outline-secondary mb-4">← უკან</a>

            <div class="card blog-card blog-card-modern">
              <div class="row g-0 align-items-stretch">
                <div class="col-md-5 position-relative">
                  <img src="<?= htmlspecialchars($img) ?>" class="img-fluid blog-img" alt="Blog">
                  <span class="blog-tag">BLOG</span>
                </div>

                <div class="col-md-7 d-flex flex-column">
                  <div class="card-body d-flex flex-column h-100">
                    <h5 class="card-title"><?= htmlspecialchars($post["title"]) ?></h5>

                    <div class="blog-meta mb-3">
                      <span><i class="fa-regular fa-calendar"></i> <?= htmlspecialchars($post["created_at"] ?? "") ?></span>
                    </div>

                    <div class="text-muted" style="white-space:pre-wrap;">
                      <?= nl2br(htmlspecialchars($post["content"])) ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        <?php else: ?>

            <div class="row g-4">

              <?php foreach ($posts as $p): ?>
                <?php
                  $img = post_image_url($p);
                  $ex = excerpt($p["content"] ?? "", 180);
                ?>
                <div class="col-lg-6">
                  <div class="card blog-card blog-card-modern h-100">
                    <div class="row g-0 align-items-stretch">
                      <div class="col-md-5 position-relative">
                        <img src="<?= htmlspecialchars($img) ?>" class="img-fluid blog-img" alt="Blog">
                        <span class="blog-tag">BLOG</span>
                      </div>
                      <div class="col-md-7 d-flex flex-column">
                        <div class="card-body d-flex flex-column h-100">
                          <h5 class="card-title"><?= htmlspecialchars($p["title"]) ?></h5>

                          <p class="card-text text-muted"><?= htmlspecialchars($ex) ?></p>

                          <div class="blog-meta mt-auto mb-3">
                            <span><i class="fa-regular fa-calendar"></i> <?= htmlspecialchars($p["created_at"] ?? "") ?></span>
                          </div>

                          <div class="card-buttons d-flex gap-2">
                            <a href="blog.php?id=<?= (int)$p["id"] ?>" class="btn btn-primary btn-sm px-3">წაიკითხე მეტი</a>
                            <button class="btn btn-outline-secondary btn-sm icon-btn" type="button">
                              <i class="fa-regular fa-bookmark"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm icon-btn" type="button">
                              <i class="fa-solid fa-share-nodes"></i>
                            </button>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

              <?php if (!$posts): ?>
                <div class="col-12">
                  <div class="alert alert-warning">ვერ მოიძებნა.</div>
                </div>
              <?php endif; ?>

            </div>

            <!-- Pagination -->
            <?php if ($pages > 1): ?>
              <nav class="mt-4">
                <ul class="pagination justify-content-center">
                  <?php for ($i=1; $i<=$pages; $i++): ?>
                    <li class="page-item <?= ($i===$page) ? "active" : "" ?>">
                      <a class="page-link" href="?q=<?= urlencode($q) ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor; ?>
                </ul>
              </nav>
            <?php endif; ?>

        <?php endif; ?>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">

                <!-- Logo & description -->
                <div class="col-lg-4">
                    <img src="assets/images/logo.png" width="80" class="mb-3" alt="Logo">
                    <p class="text-secondary">
                        საიმედო და სწრაფი ლოჯისტიკური მომსახურება ევროპიდან და აზიიდან.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Links -->
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-4">ლინკები</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="index.php" class="text-decoration-none text-secondary">მთავარი</a>
                        </li>
                        <li class="mb-2"><a href="aboutus.php" class="text-decoration-none text-secondary">ჩვენს
                                შესახებ</a></li>
                        <li class="mb-2"><a href="gallery.php"
                                class="text-decoration-none text-secondary">გალერეა</a></li>
                        <li class="mb-2"><a href="blog.php" class="text-decoration-none text-secondary">ბლოგი</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold mb-4">კონტაქტი</h5>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        ფინანსური განყოფილება: <br>
                        +995 551 047 535
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        გაყიდვების მენეჯერი: <br>
                        +995 551 458 454
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        სერვის ცენტრის მენეჯერი: <br>
                        +995 599 100 577
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-envelope me-2"></i>
                        info@kkk-co.ge
                    </p>
                </div>

                <!-- Address -->
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-4">მისამართი</h5>
                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        ფოთი, წმ გიორგის ქ. №11
                    </p>
                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        ფოთი, 9 აპრილის ხეივანი №28
                    </p>
                </div>

            </div>

            <hr class="mt-5 mb-4 border-secondary">

            <div class="text-center text-secondary small">
                © 2025 KKK CO. ყველა უფლება დაცულია.
            </div>
        </div>
    </footer>

    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
