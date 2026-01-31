<?php
require __DIR__ . "/admin/config/db.php";

$stmt = $pdo->query("SELECT id, title, description, image, created_at FROM gallery WHERE status = 'active' ORDER BY created_at DESC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

function galleryImgUrl($item) {
    if (empty($item["image"])) return "";
    return "assets/uploads/gallery/" . (int)$item["id"] . "/" . $item["image"];
}

function shortText($text, $len = 80) {
    $t = trim(strip_tags($text ?? ""));
    if (mb_strlen($t) <= $len) return $t;
    return mb_substr($t, 0, $len) . "...";
}
?>
<!doctype html>
<html lang="ka" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ფოტო გალერეა - კკკ & კომპანია | Gallery</title>
    <meta name="description" content="ჩვენი ფლოტის, ოფისისა და პროექტების ფოტო გალერეა - კკკ & კომპანია">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container py-2 d-flex justify-content-between align-items-center">
            <p class="mb-0 opacity-75">+995 551 04 75 35</p>
            <div class="d-flex gap-3 align-items-center">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown">
                        <img src="assets/images/Flag_of_Georgia.svg.png" width="30" height="20" alt=""> KA
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item d-flex align-items-center gap-1" href="#"><img src="assets/images/Flag_of_the_United_States.svg.webp" width="30" height="20" alt="">EN</a></li>
                        <li><a class="dropdown-item d-flex align-items-center gap-1" href="#"><img src="assets/images/Flag_of_Georgia.svg.png" width="30" height="20" alt="">KA</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown">₾ GEL</button>
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
                    <li class="nav-item"><a class="nav-link active" href="gallery.php">ფოტო გალერეა</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">ბლოგი</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">კონტაქტი</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Gallery Header -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">ფოტო გალერეა</h1>
            <p class="lead">ჩვენი ფლოტი, ოფისი და პროექტები</p>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4" id="gallery-grid">
                <?php foreach ($items as $item): ?>
                    <?php $imgUrl = galleryImgUrl($item); ?>
                    <?php if ($imgUrl): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100 gallery-card">
                            <div class="gallery-img-wrap" role="button" tabindex="0" style="height: 220px; overflow: hidden; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#galleryModal" data-img="<?= htmlspecialchars($imgUrl) ?>" data-title="<?= htmlspecialchars($item["title"] ?? "") ?>">
                                <img src="<?= htmlspecialchars($imgUrl) ?>" class="card-img-top w-100 h-100" alt="<?= htmlspecialchars($item["title"] ?? "") ?>" style="object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <?php if (!empty($item["title"])): ?>
                                    <h6 class="card-title fw-bold"><?= htmlspecialchars($item["title"]) ?></h6>
                                <?php endif; ?>
                                <?php if (!empty($item["description"])): ?>
                                    <p class="card-text small text-muted mb-0"><?= htmlspecialchars(shortText($item["description"])) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if (empty($items)): ?>
                <div class="text-center py-5 text-muted">
                    <p class="mb-0">გალერეა ცარიელია.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="galleryModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <img id="galleryModalImg" src="" alt="" class="img-fluid w-100" style="max-height: 70vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <img src="assets/images/logo.png" width="80" class="mb-3" alt="Logo">
                    <p class="text-secondary">საიმედო და სწრაფი ლოჯისტიკური მომსახურება ევროპიდან და აზიიდან.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-4">ლინკები</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="index.php" class="text-decoration-none text-secondary">მთავარი</a></li>
                        <li class="mb-2"><a href="aboutus.php" class="text-decoration-none text-secondary">ჩვენს შესახებ</a></li>
                        <li class="mb-2"><a href="gallery.php" class="text-decoration-none text-secondary">გალერეა</a></li>
                        <li class="mb-2"><a href="blog.php" class="text-decoration-none text-secondary">ბლოგი</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold mb-4">კონტაქტი</h5>
                    <p class="text-secondary mb-2"><i class="fa-solid fa-phone me-2"></i>+995 551 047 535</p>
                    <p class="text-secondary mb-2"><i class="fa-solid fa-envelope me-2"></i>info@kkk-co.ge</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-4">მისამართი</h5>
                    <p class="text-secondary mb-2"><i class="fa-solid fa-location-dot me-2"></i>ფოთი, წმ გიორგის ქ. №11</p>
                </div>
            </div>
            <hr class="mt-5 mb-4 border-secondary">
            <div class="text-center text-secondary small">© 2025 KKK CO. ყველა უფლება დაცულია.</div>
        </div>
    </footer>

    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
    (function() {
        var modal = document.getElementById('galleryModal');
        if (modal) {
            modal.addEventListener('show.bs.modal', function(e) {
                var trigger = e.relatedTarget;
                if (trigger) {
                    document.getElementById('galleryModalImg').src = trigger.getAttribute('data-img') || '';
                    document.getElementById('galleryModalTitle').textContent = trigger.getAttribute('data-title') || '';
                }
            });
        }
    })();
    </script>
</body>
</html>
