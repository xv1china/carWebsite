<?php
require __DIR__ . "/includes/lang.php";
?>
<!doctype html>
<html lang="<?= htmlspecialchars($lang) ?>" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= t('about_page_title', 'შ.პ.ს. "კკკ & კომპანია" — სატრანსპორტო და საექსპედიტორო მომსახურება | საქართველო') ?></title>
  <meta name="description" content="<?= t('about_meta_desc', 'KKK & Company — საიმედო სატვირთო გადაზიდვები, საერთაშორისო ლოჯისტიკა და საბაჟო მომსახურება საქართველოში. 20+ ტრაილერის ფლოტი, 24/7 დისპეტჩერი, GPS თვალყურის დევნება.') ?>">

  <link rel="canonical" href="https://kkk-co.ge/aboutus.php">
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

  <!-- Optional: hreflang (თუ რეალურად გაქვს /en/ /ru/ paths, თუ არა — მოაშორე) -->
  <link rel="alternate" hreflang="ka" href="https://kkk-co.ge/aboutus.php">
  <link rel="alternate" hreflang="en" href="https://kkk-co.ge/aboutus.php?lang=en">
  <link rel="alternate" hreflang="ru" href="https://kkk-co.ge/aboutus.php?lang=ru">
  <link rel="alternate" hreflang="x-default" href="https://kkk-co.ge/aboutus.php">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    @keyframes modalFadeIn {
      from { opacity: 0; transform: scale(0.985); }
      to { opacity: 1; transform: scale(1); }
    }
    .modal.show .modal-dialog { animation: modalFadeIn 200ms ease-out; }

    .skip-link{
      position:absolute; top:-40px; left:0;
      background: var(--color-accent, #0d6efd);
      color:#fff; padding:8px 16px; z-index:1000;
      text-decoration:none; border-radius:0 0 4px 0;
    }
    .skip-link:focus{ top:0; }
    *:focus-visible{ outline:2px solid #0d6efd; outline-offset:2px; }

    .visually-hidden{
      position:absolute; width:1px; height:1px; padding:0; margin:-1px;
      overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0;
    }

    @media print{
      .topbar, .navbar, footer, .hero__cta-secondary, #quote-form, .modal, .hero-buttons{ display:none!important; }
      .hero__title-ka, .hero__title-en{ color:#000!important; }
      #hero{ background:none!important; padding:2rem 0!important; color:#000!important; }
      a[href]:after{ content:" (" attr(href) ")"; }
    }

    #hero{
      background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.65)),
        url("assets/images/index_slider_iamges/index_slider_1.jpg") center/cover no-repeat;
      color:#fff; min-height:80vh; display:flex; align-items:center;
    }
    .hero-overlay{
      position:absolute; inset:0;
      background: radial-gradient(circle at top right, rgba(13,110,253,0.25), transparent 60%);
      z-index:1;
    }
    .hero__container{ max-width:900px; }
    .hero__title-ka{ font-size: clamp(2rem, 4vw, 3rem); line-height:1.2; }
    .hero__title-en{ font-size: clamp(1.1rem, 2vw, 1.4rem); }
    .hero__subtitle{ font-size:1.05rem; max-width:700px; color: rgba(255,255,255,0.85); }

    .hero-buttons .btn{ transition: transform .25s ease, box-shadow .25s ease; }
    .hero-buttons .btn:hover{ transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.25); }
  </style>
</head>

<body class="bg-light">
  <a class="skip-link" href="#main"><?= t('skip_to_main','გადასვლა მთავარ კონტენტზე') ?></a>

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
                        $flag = "assets/images/language_flag/Flag_of_Georgia.svg.png";
                        if ($lang === "en") $flag = "assets/images/language_flag/Flag_of_the_United_States.svg.jpg";
                        if ($lang === "ru") $flag = "assets/images/language_flag/Flag-Russia.jpg"; // თუ არ გაქვს, შეცვალე
                        ?>
                        <img src="<?= htmlspecialchars($flag) ?>" width="30" height="20" alt="">
                        <?= strtoupper($lang) ?>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1"
                                href="<?= htmlspecialchars(lang_url('ka')) ?>">
                                <img src="assets/images/language_flag/Flag_of_Georgia.svg.png" width="30" height="20" alt="">KA
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1"
                                href="<?= htmlspecialchars(lang_url('en')) ?>">
                                <img src="assets/images/language_flag/Flag_of_the_United_States.svg.jpg" width="30" height="20"
                                    alt="">EN
                            </a>
                        </li>
                        
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1"
                                href="<?= htmlspecialchars(lang_url('ru')) ?>">
                                <img src="assets/images/language_flag/Flag-Russia.jpg" width="30" height="20" alt="">RU
                            </a>
                        </li>
                    </ul>
                </div>

        <!-- Currency -->
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown">
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
      <a href="index.php" class="d-flex align-items-center">
        <img src="assets/images/logo.png" width="70" alt="KKK & Company Logo" class="navbar-logo">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-3">
          <li class="nav-item"><a class="nav-link" href="index.php"><?= t('nav_home','მთავარი') ?></a></li>
          <li class="nav-item"><a class="nav-link active" href="aboutus.php"><?= t('nav_about','ჩვენს შესახებ') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php"><?= t('nav_gallery','ფოტო გალერეა') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="blog.php"><?= t('nav_blog','ბლოგი') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php"><?= t('nav_contact','კონტაქტი') ?></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main id="main">
    <!-- HERO -->
    <header id="hero" class="py-5 position-relative overflow-hidden" role="banner" aria-labelledby="hero-title">
      <div class="container hero__container position-relative z-2 text-center text-lg-start">
        <h1 id="hero-title" class="hero__title-ka fw-bold mb-3"><?= t('about_hero_h1','შ.პ.ს. „კკკ & კომპანია“') ?></h1>

        <h2 class="hero__title-en mb-3"><?= t('about_hero_h2','თქვენი საიმედო პარტნიორი ლოჯისტიკასა და გადაზიდვებში') ?></h2>

        <p class="hero__subtitle mb-4 mx-auto mx-lg-0">
          <?= t('about_hero_p','საერთაშორისო გადაზიდვები, საკუთარი ტრაილერების ფლოტი, საბაჟო მომსახურება, 24/7 მონიტორინგი და სრული კონტროლი თქვენი ტვირთისთვის.') ?>
        </p>

        <div class="hero-buttons d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
          <a href="contact.php" class="btn btn-primary btn-lg px-4"><?= t('about_hero_btn_quote','შეთავაზების მიღება') ?></a>
          <a href="tel:+995551047535" class="btn btn-outline-light btn-lg px-4"><?= t('about_hero_btn_call','📞 +995 551 04 75 35') ?></a>
        </div>
      </div>
      <div class="hero-overlay"></div>
    </header>

    <!-- ABOUT CANONICAL -->
    <section id="about-canonical" class="bg-white" role="region" aria-labelledby="canonical-title">
      <div class="container text-center my-4">
        <h2><?= t('about_section_title','ჩვენს შესახებ') ?></h2>
      </div>

      <div class="container">
        <h2 id="canonical-title" class="visually-hidden"><?= t('about_official_desc','ოფიციალური კომპანიის აღწერა') ?></h2>

        <div id="shipping" class="canonical-block">
          <blockquote class="mb-0">
            <p><?= t('about_canon_p1','შ.პ.ს. "კკკ & კომპანი" – სატრანსპორტო-საექსპედიტორო კომპანიაა.') ?></p>
            <p><?= t('about_canon_p2','ჩვენ როგორც საქართველოს ტერიტორიაზე, ასევე მთელი მსოფლიოს მასშტაბით, ვუზრუნველყოფთ ნებისმიერი სახისა და მოცულობის ტვირთის გადაზიდვას საავტომობილო, საზღვაო და ასევე სარკინიგზო ტრანსპორტით.') ?></p>
            <p><?= t('about_canon_p3','სხვადასხვა ქვეყნებსა და ქალაქებში წარმომადგენლობებსა და საქმიანი პარტნიორების არსებობით, კომპანია უზრუნველყოფს თავისი კლიენტების მომსახურებას მთელ მსოფლიოში.') ?></p>
            <p><?= t('about_canon_p4','კომპანიის წარმატებული საქმიანობა დამყარებულია მისი თანამშრომლების მაღაკვალიფიციურობაზე, ენერგიულობისა და ინიციატივაზე. ჩვენი საქმიანობის ოპერატიულობა და საიმედოობა უზრუნველყოფილია თანამედროვე ტექნიკითა და კავშირის საშუალებებით.') ?></p>
            <p><?= t('about_canon_p5','კომპანიის პასუხისმგებლობა დაზღვეულია საერთაშორისო სტანდარტების შესაბამისა და პროფესიონალური მუშაობით უზრუნველყოფს მომსახურებას საერთაშორისო დონეზე.') ?></p>
            <p><?= t('about_canon_p6','ჩვენ გთავაზობთ სატრანსპორტო-საექსპედიტორი მომსახურების სრულ პაკეტს:') ?></p>

            <ul>
              <li><?= t('about_canon_li1','საზღვაო, სახმელეთო, საკონტეინერო და სარკინიგზო გადაზიდვები;') ?></li>
              <li><?= t('about_canon_li2','ტვირთების დასაწყობება საქართველოში და მის ფარგლებს გარეთ საჭირო დროს და ადგილზე;') ?></li>
              <li><?= t('about_canon_li3','საბაჟო-საბროკერო მომსახურება;') ?></li>
              <li><?= t('about_canon_li4','კომპანიას აქვს საკუთარი ავტოპარკი `დაკომპლექტებული 20 ერთეული ტრაილერით და ავტო ტექ.მომსახურების ცენტრით.') ?></li>
            </ul>

            <p><?= t('about_canon_p7','შ.პ.ს. "კკკ & კომპანი" თქვენი საუკეთესო არჩევანი და საიმედო პარტნიორი იქნება!') ?></p>
          </blockquote>
        </div>
      </div>
    </section>

    <!-- MISSION -->
    <section id="mission" class="py-5 bg-light" role="region" aria-labelledby="mission-title">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="position-relative">
              <img src="assets/images/truck-1.jpg" alt="<?= t('about_mission_img_alt','KKK & Company ლოჯისტიკური ცენტრი და გუნდი') ?>"
                class="img-fluid rounded shadow w-100">
            </div>
          </div>

          <div class="col-lg-6 ps-lg-5">
            <h6 class="text-primary fw-bold text-uppercase"><?= t('about_mission_small','მისია და ხედვა') ?></h6>
            <h2 id="mission-title" class="display-6 fw-bold mb-4"><?= t('about_mission_title','კავკასიის რეგიონის ლიდერი ლოჯისტიკაში') ?></h2>

            <p class="lead text-muted"><?= t('about_mission_lead','ჩვენი მისიაა გახდეთ კავკასიის რეგიონში სატრანსპორტო ლოჯისტიკის ლიდერი, რომელიც აერთიანებს ინოვაციას, საიმედოობას და კლიენტზე ორიენტირებულ მიდგომას.') ?></p>

            <p><?= t('about_mission_p1','ჩვენ ვხედავთ საქართველოს, როგორც ევროპასა და აზიას შორის ლოჯისტიკურ კერას და ვქმნით ინფრასტრუქტურას, რომელიც ხელს შეუწყობს საერთაშორისო ვაჭრობის ზრდას. ჩვენი ღირებულებები: პროფესიონალიზმი, გამჭვირვალობა, საიმედოობა და ინოვაცია.') ?></p>

            <div class="quick-facts mt-4">
              <h3 class="h5 mb-3"><?= t('about_facts_title','სწრაფი ფაქტები:') ?></h3>
              <ul class="list-unstyled row">
                <li class="col-md-6 mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= t('about_fact_1','20+ ტრაილერის საკუთარი ფლოტი') ?></li>
                <li class="col-md-6 mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= t('about_fact_2','24/7 დისპეტჩერის მომსახურება') ?></li>
                <li class="col-md-6 mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= t('about_fact_3','GPS რეალური დროის თვალყურის დევნება') ?></li>
                <li class="col-md-6 mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= t('about_fact_4','სრული საბაჟო ბროკერირება') ?></li>
                <li class="col-md-6 mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= t('about_fact_5','საშუალო ტრანზიტი: თბილისი-სტამბოლი 3-4 დღე') ?></li>
                <li class="col-md-6 mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= t('about_fact_6','45+ გამოცდილი თანამშრომელი') ?></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- FLEET -->
    <section id="fleet-safety" class="py-5 bg-white" role="region" aria-labelledby="fleet-title">
      <div class="container">
        <h2 id="fleet-title" class="text-center mb-5"><?= t('about_fleet_title','ჩვენი ფლოტი და უსაფრთხოების სტანდარტები') ?></h2>

        <div class="row g-4">
          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-hover">
              <div class="card-body text-center p-4">
                <div class="icon-box bg-primary-subtle text-primary mb-3">
                  <i class="fa-solid fa-truck fa-2x"></i>
                </div>
                <h4 class="card-title"><?= t('about_fleet_card1_t','თანამედროვე ფლოტი') ?></h4>
                <p class="card-text"><?= t('about_fleet_card1_p','20+ Volvo და Scania სატვირთო მანქანა Euro-6 სტანდარტით, ტემპერატურის კონტროლით და GPS თვალყურის დევნებით.') ?></p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-hover">
              <div class="card-body text-center p-4">
                <div class="icon-box bg-primary-subtle text-primary mb-3">
                  <i class="fa-solid fa-shield-halved fa-2x"></i>
                </div>
                <h4 class="card-title"><?= t('about_fleet_card2_t','უსაფრთხოების სერტიფიკატები') ?></h4>
                <p class="card-text"><?= t('about_fleet_card2_p','ISO 9001:2015, სატრანსპორტო უსაფრთხოების სერტიფიკატი და რეგულარული ტექნიკური შემოწმებები.') ?></p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-hover">
              <div class="card-body text-center p-4">
                <div class="icon-box bg-primary-subtle text-primary mb-3">
                  <i class="fa-solid fa-user-shield fa-2x"></i>
                </div>
                <h4 class="card-title"><?= t('about_fleet_card3_t','გამოცდილი მძღოლები') ?></h4>
                <p class="card-text"><?= t('about_fleet_card3_p','ყველა მძღოლი გაივლის რეგულარულ სასწავლო კურსებს და აქვს 5+ წლის გამოცდილება საერთაშორისო მარშრუტებზე.') ?></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- TESTIMONIALS -->
    <section id="testimonials" class="py-5 bg-white" role="region" aria-labelledby="testimonials-title">
      <div class="container">
        <h2 id="testimonials-title" class="text-center mb-5"><?= t('about_test_title','რას ამბობენ ჩვენი კლიენტები') ?></h2>

        <div class="row g-4">
          <div class="col-lg-6">
            <div class="card testimonial-card border-0 shadow-sm h-100">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="testimonial-avatar bg-primary text-white">გმ</div>
                  <div class="ms-3">
                    <h5 class="mb-0"><?= t('about_test_1_name','გიორგი მელაძე') ?></h5>
                    <p class="text-muted mb-0"><?= t('about_test_1_role','ლოჯისტიკის დირექტორი, "პრომეტეი გრუპი"') ?></p>
                  </div>
                </div>
                <blockquote class="mb-0">
                  <p class="fst-italic"><?= t('about_test_1_text','"კკკ & კომპანიასთან თანამშრომლობა გამოირჩევა პროფესიონალიზმით და ტვირთების დროულად მიტანით. მათი საიმედოობა ჩვენი ლოჯისტიკური ჯაჭვის განუყოფელი ნაწილია."') ?></p>
                </blockquote>
                <div class="rating mt-3">
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card testimonial-card border-0 shadow-sm h-100">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="testimonial-avatar bg-primary text-white">მბ</div>
                  <div class="ms-3">
                    <h5 class="mb-0"><?= t('about_test_2_name','მარიამ ბერიძე') ?></h5>
                    <p class="text-muted mb-0"><?= t('about_test_2_role','დამფუძნებელი, "ვინის სახლი"') ?></p>
                  </div>
                </div>
                <blockquote class="mb-0">
                  <p class="fst-italic"><?= t('about_test_2_text','"მცირე ბიზნესისთვის საერთაშორისო გადაზიდვები ყოველთვის გამოწვევა იყო. კკკ-ის გუნდმა პროცესი გაგვიმარტივა და ყოველთვის დროულად მოგვყავთ ტვირთი. რეკომენდაციას ვაძლევ!"') ?></p>
                </blockquote>
                <div class="rating mt-3">
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star-half-stroke text-warning"></i>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-5 bg-light" role="region" aria-labelledby="faq-title">
      <div class="container">
        <h2 id="faq-title" class="text-center mb-5"><?= t('about_faq_title','ხშირად დასმული კითხვები') ?></h2>

        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="accordion" id="faqAccordion">

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                    <?= t('about_faq_q1','რა ქვეყნებსა და რეგიონებს მოიცავს თქვენი მომსახურება?') ?>
                  </button>
                </h3>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <?= t('about_faq_a1','<strong>საქართველოში:</strong> ყველა რეგიონი და ქალაქი.<br><strong>საერთაშორისოდ:</strong> თურქეთი, აზერბაიჯანი, სომხეთი, რუსეთი, უკრაინა, ევროპის კავშირის ქვეყნები (გერმანია, პოლონეთი, ნიდერლანდები, იტალია), ასევე ცენტრალური აზიის ქვეყნები.') ?>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                    <?= t('about_faq_q2','როგორ შემიძლია ტვირთის თვალყურის დევნება?') ?>
                  </button>
                </h3>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <?= t('about_faq_a2','ყველა ტვირთს გააჩნია უნიკალური თვალყურის დევნების ნომერი. თქვენ შეგიძლიათ მისი მეშვეობით: 1) შეხვიდეთ ჩვენს ონლაინ პორტალზე და შეიყვანოთ ნომერი 2) გამოიყენოთ ჩვენი მობილური აპლიკაცია 3) დაგვირეკოთ დისპეტჩერს 24/7 ნომერზე: +995 689 09 09 09. GPS თვალყურის დევნება ხელმისაწვდომია რეალურ დროში.') ?>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                    <?= t('about_faq_q3','როგორი საბაჟო პროცედურებია საჭირო საერთაშორისო გადაზიდვებისთვის?') ?>
                  </button>
                </h3>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <?= t('about_faq_a3','ჩვენ ვუზრუნველვყოფთ სრულ საბაჟო ბროკერირებას. საჭირო დოკუმენტები: - კომერციული ინვოისი - გადაზიდვის დოკუმენტები (CMR, Bill of Lading) - წარმოშობის საბუთები - დეკლარაციები. ჩვენი გუნდი დაგეხმარებათ ყველა საბაჟო ფორმალობების შესრულებაში და გადასახადების გაანგარიშებაში.') ?>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                    <?= t('about_faq_q4','როგორ მივიღო ექსპრეს ან გადაუდებელი მომსახურება?') ?>
                  </button>
                </h3>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <?= t('about_faq_a4','ექსპრეს მომსახურებისთვის გთხოვთ დაგვირეკოთ პირდაპირ ჩვენს დისპეტჩერ ცენტრს +995 689 09 09 09. გადაუდებელი ტვირთებისთვის ჩვენ გვაქვს სპეციალური ექსპრეს ფლოტი, რომელიც მზადაა 2-4 საათში. ექსპრეს მომსახურება ხელმისაწვდომია 24/7, მათ შორის შაბათ-კვირას და არდადეგებზე.') ?>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                    <?= t('about_faq_q5','რა ტიპის დაზღვევას გთავაზობთ ტვირთებისთვის?') ?>
                  </button>
                </h3>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <?= t('about_faq_a5','ჩვენ გთავაზობთ სამი დონის დაზღვევას: 1) <strong>საბაზისო დაზღვევა</strong> - ჩვეულებრივი რისკები (დაზიანება, ქურდობა) 2) <strong>გაფართოებული დაზღვევა</strong> - ბუნებრივი კატასტროფები, პოლიტიკური რისკები 3) <strong>სრული დაზღვევა</strong> - ყველა რისკი. დაზღვევის ღირებულება დამოკიდებულია ტვირთის ღირებულებაზე, მარშრუტზე და დაფარვის დონეზე.') ?>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer (same keys as other pages) -->
  <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-4">
                    <img src="assets/images/logo.png" width="80" class="mb-3" alt="Logo">
                    <p class="text-secondary"><?= t('footer_desc', 'საიმედო და სწრაფი ლოჯისტიკური მომსახურება ევროპიდან და აზიიდან.') ?></p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="https://www.facebook.com/iakubik" class="text-white fs-5"><i class="fa-brands fa-facebook"></i></a>
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
                        +995 551 04 75 35
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        <?= t('sales_manager', 'გაყიდვების მენეჯერი') ?>: <br>
                        +995 551 45 84 54
                    </p>

                    <p class="text-secondary mb-2">
                        <i class="fa-solid fa-phone me-2"></i>
                        <?= t('service_manager', 'სერვის ცენტრის მენეჯერი') ?>: <br>
                        +995 599 10 05 77
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

  <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
