<?php
// index.php (public_html)

// DB
require __DIR__ . "/admin/config/db.php";

// LANGUAGE (create this file exactly as I showed before)
require __DIR__ . "/includes/lang.php";

// Cars + first image
$stmt = $pdo->query("
  SELECT c.*,
         (SELECT image FROM car_main_images WHERE car_id = c.id ORDER BY id ASC LIMIT 1) AS first_image
  FROM car_main c
  ORDER BY c.created_at DESC
  LIMIT 6
");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Blogs
$stmtB = $pdo->query("SELECT id, title, content, image, created_at FROM blog ORDER BY created_at DESC LIMIT 2");
$blogs = $stmtB->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="<?= htmlspecialchars($lang) ?>" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>კკკ & კომპანია - სატვირთო მანქანების დილერი საქართველოში | Truck Dealership</title>
    <meta name="description"
        content="KKK & Company - საიმედო სატვირთო მანქანების დილერი საქართველოში. ევროპული ხარისხის მძიმე ტექნიკა, გადაზიდვები და ლოჯისტიკური მომსახურება.">
    <meta name="keywords"
        content="სატვირთო მანქანები, დილერი, საქართველო, გადაზიდვები, ლოჯისტიკა, ტრაკები, truck dealership georgia">
    <link rel="canonical" href="https://kkk-co.ge/">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logo.png">
    <meta name="robots" content="index, follow">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Your CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

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
            object-fit: cover;
        }

        /* make body same height */
        .blog-card-modern .card-body {
            min-height: 220px;
        }

        /* clamp title */
        .blog-card-modern .card-title {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        /* clamp excerpt */
        .blog-card-modern .card-text {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Topbar -->
    <div class="topbar">
        <div class="container py-2 d-flex justify-content-between align-items-center">
            <p class="mb-0 opacity-75">+995 551 04 75 35</p>

            <div class="d-flex gap-3 align-items-center">

                <!-- Language -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" type="button"
                        data-bs-toggle="dropdown">
                        <?php
                        $flag = "assets/images/Flag_of_Georgia.svg.png";
                        if ($lang === "en") $flag = "assets/images/Flag_of_the_United_States.svg.webp";
                        if ($lang === "ru") $flag = "assets/images/Flag_of_Russia.svg.png"; // თუ არ გაქვს, შეცვალე
                        ?>
                        <img src="<?= htmlspecialchars($flag) ?>" width="30" height="20" alt="">
                        <?= strtoupper($lang) ?>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1"
                                href="<?= htmlspecialchars(lang_url('en')) ?>">
                                <img src="assets/images/Flag_of_the_United_States.svg.webp" width="30" height="20"
                                    alt="">EN
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1"
                                href="<?= htmlspecialchars(lang_url('ka')) ?>">
                                <img src="assets/images/Flag_of_Georgia.svg.png" width="30" height="20" alt="">KA
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1"
                                href="<?= htmlspecialchars(lang_url('ru')) ?>">
                                <img src="assets/images/Flag_of_Russia.svg.png" width="30" height="20" alt="">RU
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Currency (as you had) -->
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
            <img src="assets/images/logo.png" width="70" alt="Logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><?= t('nav_home', 'მთავარი') ?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="aboutus.php"><?= t('nav_about', 'ჩვენს შესახებ') ?></a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="gallery.php"><?= t('nav_gallery', 'ფოტო გალერეა') ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php"><?= t('nav_blog', 'ბლოგი') ?></a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="contact.php"><?= t('nav_contact', 'კონტაქტი') ?></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0"
                class="active"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/index_slider_iamges/index_slider_1.jpg" class="d-block w-100 carousel-img"
                    alt="Truck 1">
                <div class="carousel-caption d-none d-md-block">
                    <h2><?= t('slider_1_title', 'მძიმე ტექნიკა') ?></h2>
                    <p><?= t('slider_1_text', 'საიმედო სატვირთო მანქანები მშენებლობის, ტრანსპორტისა და ლოჯისტიკისთვის.') ?>
                    </p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="assets/images/index_slider_iamges/index_slider_2.jpg" class="d-block w-100 carousel-img"
                    alt="Truck 2">
                <div class="carousel-caption d-none d-md-block">
                    <h2><?= t('slider_2_title', 'ევროპული ხარისხი') ?></h2>
                    <p><?= t('slider_2_text', 'ევროპიდან იმპორტირებული მაღალი წარმადობის სატვირთო მანქანები.') ?></p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="assets/images/index_slider_iamges/index_slider_3.jpg" class="d-block w-100 carousel-img"
                    alt="Truck 3">
                <div class="carousel-caption d-none d-md-block">
                    <h2><?= t('slider_3_title', 'საუკეთესო ფასის გარანტია') ?></h2>
                    <p><?= t('slider_3_text', 'კონკურენტული ფასები და მოქნილი შესყიდვის ვარიანტები.') ?></p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container text-center my-4">
        <h2><?= t('shipping', 'გადაზიდვები') ?></h2>
    </div>

    <!-- Old Cards Section -->
    <div class="container-fluid d-flex justify-content-center align-items-center gap-3 my-4">
        <div class="card" style="width: 28rem;">
            <img src="assets/images/cardTax/pics05.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= t('ship_land_title', 'სახმელეთო') ?></h5>
                <p class="card-text">
                    <?= t(
                        'ship_land_text',
                        'ჩვენი კომპანიის ერთ-ერთი პრიორიტეტია საავტომობილო გადაზიდვები ევროპის, კავკასიის და დსთ-ს ნებისმიერი ქვეყნიდან. სახმელეთო (საავტომობილო-სარკინიგზო) ტრანსპორტით ჩვენ ვახორციელებთ ტვირთების ტრანსპორტირებას, როგორც საქართველოს ტერიტორიაზე'
                    ) ?>
                </p>
                <a href="aboutus.php#shipping" class="btn btn-primary"><?= t('ship_btn', 'წავალთ ყველგან') ?></a>
            </div>
        </div>

        <div class="card" style="width: 28rem;">
            <img src="assets/images/cardTax/pics06.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= t('ship_sea_title', 'საზღვაო') ?></h5>
                <p class="card-text">
                    <?= t(
                        'ship_sea_text',
                        'ტვირთების საზღვაო გადაზიდვებს ვახორციელებთ მთელი მსოფლიოს მაშტაბით სრულად და ნაწილობრივ დატვირთული კონტეინერებით, ნაყარი ფორმით, ასევე არაგაბარიტული ტვირთების გადაზიდვებს. საჭიროების შემთხვევაში დავფრახტავთ გემს.'
                    ) ?>
                </p>
                <a href="aboutus.php#shipping" class="btn btn-primary"><?= t('ship_btn', 'წავალთ ყველგან') ?></a>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center mt-3 flex-wrap"
        style="gap: 10px; background-color: #0d6efd; text-align: center;">
        <img src="assets/images/logo.png" alt="logo">
        <h2 style="color: white;"><?= t('best_service', 'გთავაზობთ საუკეთესო მომსახურეობას') ?></h2>
    </div>

    <!-- New Swiper Section -->
    <div class="container my-5">
        <div class="swiper-main-container">
            <div class="card-wrapper swiper shipping-swiper">
                <ul class="card-list swiper-wrapper">

                    <?php foreach ($cars as $car): ?>
                        <?php
                        // uploads path: public_html/assets/uploads/cars/{id}/{image}
                        $img = !empty($car["first_image"])
                            ? "assets/uploads/cars/" . (int) $car["id"] . "/" . $car["first_image"]
                            : "assets/images/swiper1/1.jpg";
                        ?>
                        <li class="card-item swiper-slide">
                            <a href="list-html/cars.php?id=<?= (int) $car['id'] ?>" class="card-link truck-card">

                                <img src="<?= htmlspecialchars($img) ?>" class="card-image"
                                    alt="<?= htmlspecialchars($car['title'] ?? (($car['brand'] ?? '') . ' ' . ($car['model'] ?? ''))) ?>">

                                <?php $isSold = (($car["status"] ?? "available") === "sold"); ?>
                                <span class="badge truck-badge">
                                    <?= $isSold ? t('sold', 'გაყიდულია') : t('for_sale', 'გასაყიდი') ?>
                                </span>

                                <h2 class="card-title truck-title">
                                    <?= htmlspecialchars(($car['brand'] ?? '') . ' ' . ($car['model'] ?? '') . ' – ' . ($car['year'] ?? '')) ?>
                                </h2>

                                <ul class="truck-specs">
                                    <li><i class="fa-solid fa-road"></i> <?= (int) ($car['mileage'] ?? 0) ?> <?= t('km', 'კმ') ?>
                                    </li>
                                    <li><i class="fa-solid fa-gears"></i> <?= htmlspecialchars($car['gearbox'] ?? '-') ?></li>
                                    <li><i class="fa-solid fa-gas-pump"></i> <?= htmlspecialchars($car['fuel'] ?? '-') ?></li>
                                </ul>

                                <div class="truck-footer">
                                    <span class="truck-price"><?= number_format((int) ($car['price'] ?? 0)) ?> ₾</span>
                                    <button class="card-button" type="button">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </div>

                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="gap: 100px; background-color: #0d6efd; padding: 20px;">
        <h2 style="color: white;"><?= t('blog', 'ბლოგი') ?></h2>
    </div>

    <div class="container my-5">
        <div class="row g-4">

            <?php foreach ($blogs as $b): ?>
                <?php
                $img = !empty($b["image"])
                    ? "assets/uploads/blog/" . (int) $b["id"] . "/" . $b["image"]
                    : "assets/images/truck-1.jpg";

                $excerpt = mb_substr(trim(strip_tags($b["content"] ?? "")), 0, 100);
                if (mb_strlen(trim(strip_tags($b["content"] ?? ""))) > 100) $excerpt .= "...";
                ?>

                <div class="col-lg-6 col-12">
                    <div class="card blog-card blog-card-modern">
                        <div class="row g-0 align-items-stretch">

                            <div class="col-md-5 position-relative">
                                <img src="<?= htmlspecialchars($img) ?>" class="img-fluid blog-img" alt="Truck Blog">
                                <span class="blog-tag">BLOG</span>
                            </div>

                            <div class="col-md-7 d-flex flex-column">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title">
                                        <?= htmlspecialchars($b["title"] ?? "") ?>
                                    </h5>

                                    <p class="card-text text-muted">
                                        <?= htmlspecialchars($excerpt) ?>
                                    </p>

                                    <div class="blog-meta mt-auto mb-3">
                                        <span><i class="fa-regular fa-calendar"></i>
                                            <?= htmlspecialchars($b["created_at"] ?? "") ?>
                                        </span>
                                    </div>

                                    <div class="card-buttons d-flex gap-2">
                                        <a href="blog.php?id=<?= (int) $b["id"] ?>" class="btn btn-primary btn-sm px-3">
                                            <?= t('read_more', 'წაიკითხე მეტი') ?>
                                        </a>

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

            <?php if (empty($blogs)): ?>
                <div class="col-12">
                    <div class="alert alert-warning"><?= t('no_blog', 'ბლოგი ჯერ არ დამატებულა.') ?></div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative">
                        <img src="assets/images/truck-1.jpg" class="img-fluid rounded shadow" alt="Our Logistics">
                        <div
                            class="about-experience bg-primary text-white p-3 rounded position-absolute bottom-0 end-0 m-3 d-none d-md-block">
                            <h3 class="mb-0 fw-bold">10+</h3>
                            <p class="mb-0"><?= t('years_exp', 'წლის გამოცდილება') ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 ps-lg-5">
                    <h6 class="text-primary fw-bold text-uppercase"><?= t('about_small', 'ჩვენს შესახებ') ?></h6>
                    <h2 class="display-6 fw-bold mb-4"><?= t('about_title', 'საიმედო პარტნიორი ლოჯისტიკაში') ?></h2>
                    <p class="lead text-muted"><?= t('about_lead', 'ჩვენ გთავაზობთ სრულ ლოჯისტიკურ მომსახურებას მთელი საქართველოსა და ევროპის მასშტაბით.') ?></p>
                    <p><?= t('about_p1', 'ჩვენი კომპანია წლებია უზრუნველყოფს ტვირთების უსაფრთხო და სწრაფ გადაზიდვას. ჩვენი ავტოპარკი აღჭურვილია თანამედროვე სტანდარტების მქონე სატვირთო ავტომობილებით, რაც გარანტიას იძლევა თქვენი ტვირთის დაცულობაზე.') ?></p>
                    <a href="aboutus.php" class="btn btn-primary px-4 py-2 mt-3"><?= t('about_btn', 'გაიგეთ მეტი') ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase"><?= t('services_small', 'სერვისები') ?></h6>
            <h2 class="fw-bold"><?= t('services_title', 'რას ვთავაზობთ მომხმარებელს') ?></h2>
        </div>

        <div class="container">
            <div class="row g-4 justify-content-center">

                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center service-card">
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width:70px;height:70px;">
                            <i class="fa-solid fa-truck fa-2x"></i>
                        </div>
                        <h5 class="fw-bold"><?= t('srv_1_t', 'სახმელეთო გადაზიდვები') ?></h5>
                        <p class="small text-muted"><?= t('srv_1_p', 'ტვირთების გადაზიდვა ევროპისა და აზიის მიმართულებით.') ?></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center service-card">
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width:70px;height:70px;">
                            <i class="fa-solid fa-ship fa-2x"></i>
                        </div>
                        <h5 class="fw-bold"><?= t('srv_2_t', 'საზღვაო გადაზიდვები') ?></h5>
                        <p class="small text-muted"><?= t('srv_2_p', 'კონტეინერული და ტვირთების საზღვაო ტრანსპორტირება.') ?></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center service-card">
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width:70px;height:70px;">
                            <i class="fa-solid fa-file-shield fa-2x"></i>
                        </div>
                        <h5 class="fw-bold"><?= t('srv_3_t', 'საბაჟო-საბროკერო მომსახურება') ?></h5>
                        <p class="small text-muted"><?= t('srv_3_p', 'დოკუმენტაცია და საბაჟო პროცედურების სრული მხარდაჭერა.') ?></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 ">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center service-card">
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width:70px;height:70px;">
                            <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                        </div>
                        <h5 class="fw-bold"><?= t('srv_4_t', 'საკონტეინერო გადაზიდვები') ?></h5>
                        <p class="small text-muted"><?= t('srv_4_p', 'უსაფრთხო და ეფექტური კონტეინერული ლოჯისტიკა.') ?></p>
                    </div>
                </div>

                <div class="col-12 service-wide">
                    <div class="card h-100 service-card border-0 shadow-sm p-4 text-center">
                        <div class="icon-box bg-danger-subtle text-danger rounded-circle mx-auto mb-3">
                            <i class="fa-solid fa-triangle-exclamation fa-2x"></i>
                        </div>
                        <h5 class="fw-bold"><?= t('srv_5_t', 'სახიფათო ტვირთები') ?></h5>
                        <p class="small text-muted"><?= t('srv_5_p', 'ADR სტანდარტების დაცვით სახიფათო ტვირთების გადაზიდვა.') ?></p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-4">
                    <img src="assets/images/logo.png" width="80" class="mb-3" alt="Logo">
                    <p class="text-secondary"><?= t('footer_desc', 'საიმედო და სწრაფი ლოჯისტიკური მომსახურება ევროპიდან და აზიიდან.') ?></p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-4"><?= t('footer_links', 'ლინკები') ?></h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="index.php" class="text-decoration-none text-secondary"><?= t('nav_home', 'მთავარი') ?></a></li>
                        <li class="mb-2"><a href="aboutus.php" class="text-decoration-none text-secondary"><?= t('nav_about', 'ჩვენს შესახებ') ?></a></li>
                        <li class="mb-2"><a href="gallery.php" class="text-decoration-none text-secondary"><?= t('nav_gallery', 'გალერეა') ?></a></li>
                        <li class="mb-2"><a href="blog.php" class="text-decoration-none text-secondary"><?= t('nav_blog', 'ბლოგი') ?></a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold mb-4"><?= t('footer_contact', 'კონტაქტი') ?></h5>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        <?= t('finance_dept', 'ფინანსური განყოფილება') ?>: <br>
                        +995 551 047 535
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        <?= t('sales_manager', 'გაყიდვების მენეჯერი') ?>: <br>
                        +995 551 458 454
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        <?= t('service_manager', 'სერვის ცენტრის მენეჯერი') ?>: <br>
                        +995 599 100 577
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-envelope me-2"></i>
                        info@kkk-co.ge
                    </p>
                </div>

                <div class="col-lg-3">
                    <h5 class="fw-bold mb-4"><?= t('footer_address', 'მისამართი') ?></h5>
                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        <?= t('addr_1', 'ფოთი, წმ გიორგის ქ. №11') ?>
                    </p>
                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        <?= t('addr_2', 'ფოთი, 9 აპრილის ხეივანი №28') ?>
                    </p>
                </div>

            </div>

            <hr class="mt-5 mb-4 border-secondary">

            <div class="text-center text-secondary small">
                © 2025 KKK CO. <?= t('rights', 'ყველა უფლება დაცულია.') ?>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Swiper.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
