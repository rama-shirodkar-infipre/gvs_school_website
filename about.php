<?php
include 'include/config.php';
include 'admin/helpers.php';
include 'include/header.php';
/* =========================
   FETCH DATA
========================= */

// About Us (single row)
$about = $pdo->query("SELECT * FROM about_us WHERE is_active=1 LIMIT 1")->fetch();

// History
$history = [];
if ($about) {
  $stmt = $pdo->prepare("SELECT * FROM about_history WHERE about_id=? ORDER BY id ASC");
  $stmt->execute([$about['id']]);
  $history = $stmt->fetchAll();
}

// Why Choose Us
$whyChoose = $pdo->query("
    SELECT * FROM why_choose_us
    WHERE is_active=1
    ORDER BY id ASC
")->fetchAll();

// Staff Members
$staff = $pdo->query("
    SELECT * FROM staff_members
    WHERE is_active=1
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
          <h2 class="mb-0">About Us</h2>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= BREADCRUMB ================= -->
  <div class="custom-breadcrumns border-bottom">
    <div class="container">
      <a href="index.php">Home</a>
      <span class="mx-3 icon-keyboard_arrow_right"></span>
      <span class="current">About Us</span>
    </div>
  </div>

  <!-- ================= ABOUT INTRO ================= -->
  <?php if ($about): ?>
    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-lg-8">
            <!-- <small style="letter-spacing:2px;font-weight:600;">
            
            </small> -->
            <h1 style="font-weight:700;margin-top:15px;">
              <?= nl2br($about['title']) ?>
            </h1>
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <?php if ($about['image']): ?>
              <img src="uploads/<?= $about['image'] ?>"
                class="img-fluid"
                style="border-radius:20px;">
            <?php endif; ?>
          </div>

          <div class="col-lg-5 ml-auto">
            <h3 style="font-weight:600; margin-bottom:20px;">
              <?= htmlspecialchars($about['subheading']) ?>
            </h3>
            <?= $about['description'] ?>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>

  <!-- ================= HISTORY ================= -->
  <?php if (!empty($history)): ?>
    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-lg-12 text-center">
            <h2 class="section-title-underline">
              <span>Saunstha & School History</span>
            </h2>
          </div>
        </div>

        <div class="row">
          <?php foreach ($history as $h): ?>
            <div class="col-lg-6 mb-3">
              <p><?= nl2br($h['description']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  <?php endif; ?>

  <!-- ================= VISION & MISSION ================= -->
  <?php if ($about): ?>
    <div class="site-section bg-light">
      <div class="container">

        <div class="row align-items-start mb-5">
          <div class="col-lg-3">
            <p style="font-weight:600;letter-spacing:1px;">Vision</p>
          </div>
          <div class="col-lg-9">
            <p style="font-size:28px;line-height:1.6;">
              <?= nl2br($about['vision']) ?>
            </p>
          </div>
        </div>

        <hr style="margin:50px 0;">

        <div class="row align-items-start">
          <div class="col-lg-3">
            <p style="font-weight:600;letter-spacing:1px;">Mission</p>
          </div>
          <div class="col-lg-9">
            <p style="font-size:28px;line-height:1.6;">
              <?= nl2br($about['mission']) ?>
            </p>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>

  <!-- ================= PRESIDENT ================= -->
  <?php if ($about): ?>
    <div class="site-section">
      <div class="container">

        <div class="row align-items-center">

          <div class="col-lg-4 mb-4">
            <h2 style="font-weight:700;">
              President & <br> Head of School
            </h2>
            <p><?= nl2br($about['president_message']) ?></p>
          </div>

          <div class="col-lg-4 text-center mb-4">
            <?php if ($about['president_image']): ?>
              <img src="uploads/<?= $about['president_image'] ?>"
                class="img-fluid"
                style="border-radius:20px;max-height:420px;">
            <?php endif; ?>
          </div>

          <div class="col-lg-4">
            <div style="font-size:40px;">“</div>
            <p style="font-size:18px;">
              <?= htmlspecialchars($about['president_quote']) ?>
            </p>
            <p>
              <strong><?= htmlspecialchars($about['president_name']) ?></strong><br>
              <?= htmlspecialchars($about['president_designation']) ?>
            </p>
          </div>

        </div>
      </div>
    </div>
  <?php endif; ?>

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

  <!-- ================= STAFF ================= -->
  <?php if (!empty($staff)): ?>
    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Our Staff Members</span>
            </h2>
          </div>
        </div>
        <div class="row">
          <?php foreach ($staff as $s): ?>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="feature-1 border person text-center">
                <?php if ($s['image']): ?>
                  <img src="uploads/<?= $s['image'] ?>" class="img-fluid">
                <?php endif; ?>
                <div class="feature-1-content">
                  <h2><?= htmlspecialchars($s['name']) ?></h2>
                  <span class="position d-block"><?= htmlspecialchars($s['designation']) ?></span>
                  <p><?= htmlspecialchars($s['bio']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row">
          <?php foreach ($staff as $s): ?>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="feature-1 border person text-center">
                <?php if ($s['image']): ?>
                  <img src="uploads/<?= $s['image'] ?>" class="img-fluid">
                <?php endif; ?>
                <div class="feature-1-content">
                  <h2><?= htmlspecialchars($s['name']) ?></h2>
                  <span class="position d-block"><?= htmlspecialchars($s['designation']) ?></span>
                  <p><?= htmlspecialchars($s['bio']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  <?php endif; ?>

</div>
<?php include 'include/footer.php'; ?>
<?php include 'include/footerScript.php'; ?>