<?php
include 'include/config.php';
include 'admin/helpers.php';
include 'include/header.php';

// Why Choose Us
$whyChoose = $pdo->query("
    SELECT * FROM why_choose_us
    WHERE is_active=1
    ORDER BY id ASC
")->fetchAll();


// Steps
$steps = $pdo->query("
    SELECT * FROM admission_steps
    WHERE is_active = 1
    ORDER BY step_no ASC
")->fetchAll();

// Fetch active sliders
$sliders = $pdo->query("
      SELECT * FROM home_sliders
      WHERE is_active = 1
      ORDER BY display_order ASC
  ")->fetchAll();

// about us
$about = $pdo->query("SELECT * FROM about_us WHERE is_active=1 LIMIT 1")->fetch();

// course list
$courses = $pdo->query("SELECT * FROM courses WHERE is_active=1")->fetchAll();

?>

<div class="site-wrap">
  <?php
  include 'include/navbar.php';
  ?>


  <?php if (!empty($sliders)): ?>
    <div class="hero-slide owl-carousel site-blocks-cover">
      <?php foreach ($sliders as $slider): ?>
        <div class="intro-section" style="background-image: url('<?= $site_url . 'uploads/' . htmlspecialchars($slider['image']) ?>');">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                <h1 class="mb-4"><?= htmlspecialchars($slider['title']) ?></h1>
                <p class="lead"><?= htmlspecialchars($slider['subtitle']) ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="hero-slide owl-carousel site-blocks-cover">
      <div class="intro-section" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="site-section">
    <div class="container">
      <div class="row align-items-center">

        <!-- Image -->
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="uploads/<?= $about['image'] ?>" alt="Gopal Krishna School Students" class="img-fluid rounded-lg shadow">
        </div>

        <!-- Content -->
        <div class="col-lg-6 pl-lg-5">
          <span class="text-uppercase text-muted small">About Us</span>

          <h2 class="mt-2 mb-4" style="color:#000;">
            <?= nl2br($about['title']) ?>
          </h2>

          <?= $about['description'] ?>

          <a href="about.php" class="btn btn-outline-primary px-4 py-2 rounded-pill mt-3">
            Know more about us
          </a>
        </div>

      </div>
    </div>
  </div>


  <!-- ================= WHY CHOOSE US ================= -->
  <?php if (!empty($whyChoose)): ?>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Why Choose Gopal Krishna School?</span>
            </h2>
          </div>
        </div>
        <div class="row">
          <?php foreach ($whyChoose as $w): ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="feature-1 border">
                <div class="icon-wrapper bg-primary">
                  <span class="<?= $w['icon'] ?> text-white"></span>
                </div>
                <div class="feature-1-content">
                  <h2><?= htmlspecialchars($w['title']) ?></h2>
                  <?= $w['description'] ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="site-section bg-light">
    <div class="container">

      <div class="row mb-5 justify-content-center text-center">
        <div class="col-lg-8">
          <h2 class="section-title-underline mb-3">
            <span>A Journey of Discovery: From Pre-Primary to High School</span>
          </h2>
          <p>
            We nurture students at every stage of their educational journey, providing age-appropriate learning
            experiences that build strong foundations, confidence, and future readiness.
          </p>
        </div>
      </div>

      <div class="row">
        <?php foreach ($courses as $c): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-1 border h-100">
              <figure class="mb-3">
                <img src="<?= $site_url ?>uploads/<?= $c['image'] ?>" alt="Pre-Primary School" class="img-fluid rounded">
              </figure>
              <div class="feature-1-content">
                <h3><?= $c['title'] ?></h3>
                <p>
                  <?= $c['short_description'] ?>
                </p>
                <p>
                  <a href="course-details.php?course=<?= $c['slug'] ?>" class="btn btn-primary px-4 rounded-0">
                    <?= $c['title'] ?> Curriculum
                  </a>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>


  <div class="section-bg style-1" style="background-image: url('images/about_1.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h2 class="section-title-underline style-2">
            <span>About Gopalkrishna School</span>
          </h2>
        </div>
        <div class="col-lg-8">
          <p class="lead">Gopalkrishna Vidhyaprasarak Saunstha was established in 2006 with a vision to provide
            quality education and strong values to students from nursery to higher classes. Over the years, the
            Saunstha has grown steadily, focusing on academic excellence, extracurricular development, and holistic
            student growth.</p>
          <p>We believe in a student-centered approach to education that blends rigorous academic inquiry with a focus
            on creativity, critical thinking, and social-emotional well-being</p>
          <p><a href="#">Read more</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-4 text-center">
        <div class="col-12">
          <h2 class="section-title-underline">
            <span>A Glimpse into Our World</span>
          </h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" controls preload="metadata">
              <source src="videos/homePage.mp4" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- // 05 - Block -->
  <div class="site-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-4">
          <h2 class="section-title-underline">
            <span>Testimonials</span>
          </h2>
        </div>
      </div>
      <?php
      // Fetch testimonials from database
      $testimonials = $pdo->query("
        SELECT * FROM testimonials
        WHERE is_active = 1
        ORDER BY display_order ASC
      ")->fetchAll();
      ?>

      <?php if (!empty($testimonials)): ?>
        <div class="owl-slide owl-carousel">
          <?php foreach ($testimonials as $testimonial): ?>
            <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="<?= $site_url ?>uploads/<?= htmlspecialchars($testimonial['photo']) ?>" alt="<?= htmlspecialchars($testimonial['name']) ?>" class="img-fluid mr-3">
                <div>
                  <h3><?= htmlspecialchars($testimonial['name']) ?></h3>
                  <span><?= htmlspecialchars($testimonial['designation']) ?></span>
                </div>
              </div>
              <div>
                <p>&ldquo;<?= htmlspecialchars($testimonial['message']) ?>&rdquo;</p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>


  <div class="site-section journey-section">
    <div class="container">
      <div class="row mb-4 text-center">
        <div class="col-12">
          <span class="text-uppercase text-muted small">Get Started</span>
          <h2 class="section-title-underline mt-2">
            <span>Your Journey to Gopal Krishna School</span>
          </h2>
          <!-- <p class="mt-3">
      We believe in nurturing the whole child through a balanced curriculum that emphasizes academic rigor, character development, and critical thinking.
    </p> -->
        </div>
      </div>
      <?php if ($steps): ?>
        <div class="row">
          <?php foreach ($steps as $s): ?>
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
              <div class="why-card">
                <span class="step-label">Step: <?= sprintf('%02d', $s['step_no']) ?></span>
                <h3><?= htmlspecialchars($s['title']) ?></h3>
                <p>
                  <?= nl2br($s['description']) ?>
                </p>
              </div>

            </div>
          <?php endforeach; ?>

        </div>
        <div class="text-center mt-5">
          <p class="mb-4">
            We look forward to welcoming your family into our community.
          </p>
          <a href="admissions.php" class="btn btn-primary px-5 py-3 rounded-pill">
            Apply Now
          </a>
        </div>
        <br>
      <?php endif; ?>
    </div>

    <div class="site-section ftco-subscribe-1" style="background-image: url('images/bg_1.jpg')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <h2>Subscribe to us!</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,</p>
          </div>
          <div class="col-lg-5">
            <form action="" class="d-flex">
              <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
              <button class="btn btn-primary rounded py-3 px-4" type="submit">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    include 'include/footer.php';
    ?>
  </div>
  <?php
  include 'include/footerScript.php';
  ?>