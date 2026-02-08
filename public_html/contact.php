<?php
require __DIR__ . "/admin/config/db.php";
require __DIR__ . "/includes/lang.php";
?>
<!doctype html>
<html lang="<?= htmlspecialchars($lang) ?>" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= t('contact_page_title', 'კონტაქტი - კკკ & კომპანია | Contact') ?></title>
  <meta name="description" content="<?= t('contact_meta_desc', 'დაგვიკავშირდით - კკკ & კომპანია. სატვირთო მანქანების შეძენა, გადაზიდვები და ლოჯისტიკური მომსახურება') ?>">

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
      <a href="index.php"><img src="assets/images/logo.png" width="70" alt="Logo"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-3">
          <li class="nav-item"><a class="nav-link" href="index.php"><?= t('nav_home','მთავარი') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="aboutus.php"><?= t('nav_about','ჩვენს შესახებ') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php"><?= t('nav_gallery','ფოტო გალერეა') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="blog.php"><?= t('nav_blog','ბლოგი') ?></a></li>
          <li class="nav-item"><a class="nav-link active" href="contact.php"><?= t('nav_contact','კონტაქტი') ?></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contact Header -->
  <section class="py-5 bg-primary text-white text-center">
    <div class="container">
      <h1 class="display-4 fw-bold mb-3"><?= t('contact_h1','დაგვიკავშირდით') ?></h1>
      <p class="lead"><?= t('contact_sub','ჩვენ მზად ვართ გიპასუხოთ თქვენს ყველა კითხვაზე') ?></p>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="py-5" style="background-color: white;">
    <div class="container">
      <div class="row g-5">

        <!-- Contact Info -->
        <div class="col-lg-5">
          <h2 class="fw-bold mb-4"><?= t('contact_info_title','კონტაქტის ინფორმაცია') ?></h2>

          <!-- Phones -->
          <div class="d-flex align-items-start mb-3">
            <div class="icon-box bg-primary-subtle text-primary me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div class="flex-grow-1">
              <h5 class="fw-bold mb-1"><?= t('contact_phones','ტელეფონები') ?></h5>
              <p class="text-muted mb-0">
                <?= t('finance_dept','ფინანსური განყოფილება') ?>:
                <a href="tel:+995551047535" class="text-decoration-none text-muted">+995 551 04 75 35</a><br>

                <?= t('sales_manager','გაყიდვების მენეჯერი') ?>:
                <a href="tel:+995551458454" class="text-decoration-none text-muted">+995 551 45 84 54</a><br>

                <?= t('service_manager','სერვის ცენტრის მენეჯერი') ?>:
                <a href="tel:+995599100577" class="text-decoration-none text-muted">+995 599 100 577</a>
              </p>
            </div>
          </div>

          <!-- Email -->
          <div class="d-flex align-items-start mb-3">
            <div class="icon-box bg-primary-subtle text-primary me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="flex-grow-1">
              <h5 class="fw-bold mb-1"><?= t('contact_email','ელ-ფოსტა') ?></h5>
              <p class="text-muted mb-0">
                <a href="mailto:info@kkk-co.ge" class="text-decoration-none text-muted">info@kkk-co.ge</a>
              </p>
            </div>
          </div>

          <!-- Addresses -->
          <div class="d-flex align-items-start mb-3">
            <div class="icon-box bg-primary-subtle text-primary me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="flex-grow-1">
              <h5 class="fw-bold mb-1"><?= t('contact_addresses','მისამართები') ?></h5>
              <p class="text-muted mb-0">
                <?= t('addr_1', 'ფოთი, წმ. გიორგის ქ. №11') ?><br>
                <?= t('addr_2', 'ფოთი, 9 აპრილის ხეივანი №28') ?>
              </p>
            </div>
          </div>

          <!-- Social Links -->
          <div class="mt-3">
            <h5 class="fw-bold mb-2"><?= t('contact_social','მოგვიყევით სოციალური ქსელებით') ?></h5>
            <div class="d-flex gap-3">
              <a href="https://www.facebook.com/iakubik" target="_blank" class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center" style="width:45px; height:45px;"><i class="fa-brands fa-facebook"></i></a>
            </div>
          </div>

          <!-- Google Map -->
          <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm mt-4">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d310.7195352296747!2d41.71073248976298!3d42.19137712521966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x405db7cdbace6a17%3A0x880e21d2c63e533a!2sKkk%26company!5e0!3m2!1ska!2sge!4v1770559561315!5m2!1ska!2sge" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-7">
          <div class="card border-0 shadow p-4 p-md-5">
            <h2 class="fw-bold mb-4"><?= t('contact_form_title','გაგვიგზავნეთ შეტყობინება') ?></h2>

            <form id="contactForm" novalidate>
              <div class="row g-3">

                <div class="col-md-6">
                  <label class="form-label"><?= t('f_name','სახელი') ?> *</label>
                  <input type="text" class="form-control" name="name" placeholder="<?= t('ph_name','თქვენი სახელი') ?>" required>
                  <div class="invalid-feedback"><?= t('err_name','გთხოვთ შეიყვანოთ სახელი') ?></div>
                </div>

                <div class="col-md-6">
                  <label class="form-label"><?= t('f_email','ელ-ფოსტა') ?> *</label>
                  <input type="email" class="form-control" name="email" placeholder="example@mail.com" required>
                  <div class="invalid-feedback"><?= t('err_email','გთხოვთ შეიყვანოთ სწორი ელ-ფოსტა') ?></div>
                </div>

                <div class="col-md-6">
                  <label class="form-label"><?= t('f_phone','ტელეფონი') ?></label>
                  <input type="tel" class="form-control" name="phone" placeholder="+995 XXX XXX XXX">
                </div>

                <div class="col-md-6">
                  <label class="form-label"><?= t('f_subject','თემა') ?> *</label>
                  <select class="form-select" name="subject" required>
                    <option value=""><?= t('subject_choose','აირჩიეთ თემა') ?></option>
                    <option value="truck-sale"><?= t('subject_truck','სატვირთო მანქანის შეძენა') ?></option>
                    <option value="shipping"><?= t('subject_shipping','გადაზიდვის მოთხოვნა') ?></option>
                    <option value="customs"><?= t('subject_customs','საბაჟო მომსახურება') ?></option>
                    <option value="consultation"><?= t('subject_consult','კონსულტაცია') ?></option>
                    <option value="other"><?= t('subject_other','სხვა') ?></option>
                  </select>
                  <div class="invalid-feedback"><?= t('err_subject','გთხოვთ აირჩიოთ თემა') ?></div>
                </div>

                <div class="col-12">
                  <label class="form-label"><?= t('f_message','შეტყობინება') ?> *</label>
                  <textarea class="form-control" rows="5" name="message" placeholder="<?= t('ph_message','მოგვწერეთ დეტალურად...') ?>" required></textarea>
                  <div class="invalid-feedback"><?= t('err_message','გთხოვთ შეიყვანოთ შეტყობინება') ?></div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="privacy" required>
                    <label class="form-check-label" for="privacy">
                      <?= t('privacy_agree','ვეთანხმები') ?>
                      <a href="#" class="text-primary"><?= t('privacy_policy','კონფიდენციალურობის პოლიტიკას') ?></a>
                    </label>
                    <div class="invalid-feedback"><?= t('err_privacy','გთხოვთ დაეთანხმოთ პოლიტიკას') ?></div>
                  </div>
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary w-100 py-3">
                    <i class="fa-solid fa-paper-plane me-2"></i><?= t('send_btn','შეტყობინების გაგზავნა') ?>
                  </button>
                </div>

                <div class="col-12">
                  <div id="formAlert" class="alert d-none" role="alert"></div>
                </div>

              </div>
            </form>

            <!-- message for JS -->
            <div id="i18nSuccess"
                 data-success="<?= htmlspecialchars(t('send_success','თქვენი შეტყობინება წარმატებით გაიგზავნა! ჩვენ დაგიკავშირდებით მალე.')) ?>">
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer (same keys as index) -->
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

  <script>
    // Form Validation
    (function() {
      'use strict';
      const form = document.getElementById('contactForm');

      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();

          const alertDiv = document.getElementById('formAlert');
          const msg = document.getElementById('i18nSuccess')?.dataset?.success || '';

          alertDiv.className = 'alert alert-success';
          alertDiv.textContent = msg;
          alertDiv.classList.remove('d-none');

          form.reset();
          form.classList.remove('was-validated');
          alertDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        form.classList.add('was-validated');
      }, false);
    })();
  </script>
</body>
</html>
