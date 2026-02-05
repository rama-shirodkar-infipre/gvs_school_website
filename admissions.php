<?php
include 'include/config.php';
include 'admin/helpers.php';
include 'include/header.php';

/* =====================
   FETCH DATA
===================== */

// Intro
$intro = $pdo->query("
    SELECT * FROM admission_intro
    WHERE is_active = 1
    LIMIT 1
")->fetch();

// Steps
$steps = $pdo->query("
    SELECT * FROM admission_steps
    WHERE is_active = 1
    ORDER BY step_no ASC
")->fetchAll();

// Levels
$levels = $pdo->query("
    SELECT * FROM admission_levels
    WHERE is_active = 1
    ORDER BY id ASC
")->fetchAll();

// Documents
$documents = $pdo->query("
    SELECT * FROM admission_documents
    WHERE is_active = 1
    ORDER BY id ASC
")->fetchAll();

// Highlights
$highlights = $pdo->query("
    SELECT * FROM admission_highlights
    WHERE is_active = 1
    ORDER BY id ASC
")->fetchAll();
?>

<div class="site-wrap">
  <?php include 'include/navbar.php'; ?>

  <!-- ================= HERO ================= -->
  <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
    style="background-image:linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),url('images/bg_1.jpg')">
    <div class="container">
      <div class="row align-items-end">
        <div class="col-lg-7">
          <h2 class="mb-0">Admissions</h2>
          <p>Your child’s journey towards holistic education starts here</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= BREADCRUMB ================= -->
  <div class="custom-breadcrumns border-bottom">
    <div class="container">
      <a href="index.php">Home</a>
      <span class="mx-3 icon-keyboard_arrow_right"></span>
      <span class="current">Admission</span>
    </div>
  </div>

  <!-- ================= INTRO ================= -->
  <?php if ($intro): ?>
    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-lg-7">
            <span class="text-uppercase text-muted small">
              <?= htmlspecialchars($intro['subheading'] ?? 'Admission') ?>
            </span>
            <h2 class="section-title-underline mb-4">
              <span><?= htmlspecialchars($intro['heading']) ?></span>
            </h2>
            <p><?= nl2br($intro['description']) ?></p>
          </div>
        </div>

        <?php if ($steps): ?>
          <div class="row text-center">
            <?php foreach ($steps as $s): ?>
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="p-4 border rounded h-100">
                  <h1 class="text-primary"><?= sprintf('%02d', $s['step_no']) ?></h1>
                  <h4><?= htmlspecialchars($s['title']) ?></h4>
                  <p><?= nl2br($s['description']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  <?php endif; ?>

  <!-- ================= LEVELS ================= -->
  <?php if ($levels): ?>
    <div class="site-section bg-light">
      <div class="container">
        <h2 class="text-center mb-5" style="color:black;">
          Admissions Open for the Academic Year
        </h2>

        <div class="row text-center">
          <?php foreach ($levels as $l): ?>
            <div class="col-lg-4 mb-4">
              <div class="p-4 border rounded h-100 admission-card">
                <?php if ($l['image']): ?>
                  <img src="uploads/<?= $l['image'] ?>"
                    class="img-fluid mb-3 admission-img">
                <?php endif; ?>
                <h4><?= htmlspecialchars($l['title']) ?></h4>
                <p><?= htmlspecialchars($l['subtitle']) ?></p>
                <p><?= nl2br($l['description']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  <?php endif; ?>

  <!-- ================= DOCUMENTS ================= -->
  <?php if ($documents): ?>
    <div class="site-section admission-docs">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-6 mb-4">
            <h2 class="section-title-underline mb-4">
              <span>Required enrollment documents</span>
            </h2>
            <p>
              To complete your child’s admission, please ensure you have the
              following documents ready.
            </p>
            <a href="#" class="btn btn-primary btn-pill px-5 py-3">
              Begin Application
            </a>
          </div>

          <div class="col-lg-6">
            <ul class="admission-list list-unstyled">
              <?php foreach ($documents as $d): ?>
                <li><?= htmlspecialchars($d['document_name']) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>

  <!-- ================= HIGHLIGHTS ================= -->
  <?php if ($highlights): ?>
    <div class="section-bg style-1" style="background-image:url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <?php foreach ($highlights as $h): ?>
            <div class="col-lg-4 col-md-6 mb-5">
              <span class="icon <?= $h['icon'] ?>"></span>
              <h3><?= htmlspecialchars($h['title']) ?></h3>
              <p><?= nl2br($h['description']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php include 'include/footer.php'; ?>
</div>

<?php include 'include/footerScript.php'; ?>