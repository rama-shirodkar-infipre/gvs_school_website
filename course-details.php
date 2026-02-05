<?php
include 'include/config.php';
include 'admin/helpers.php';
include 'include/header.php';


$slug = $_GET['course'] ?? '';

$course = $pdo->prepare("SELECT * FROM courses WHERE slug=? AND is_active=1");
$course->execute([$slug]);
$course = $course->fetch();

if (!$course) die('Course not found');

$outcomes = $pdo->prepare("
  SELECT * FROM course_outcomes
  WHERE course_id=? AND is_active=1
");
$outcomes->execute([$course['id']]);

$curriculum = $pdo->prepare("
  SELECT * FROM course_curriculum
  WHERE course_id=? AND is_active=1
  ORDER BY sort_order ASC
");
$curriculum->execute([$course['id']]);

$methods = $pdo->prepare("
  SELECT * FROM course_methodology
  WHERE course_id=? AND is_active=1
");
$methods->execute([$course['id']]);

// Why Choose Us
$whyChoose = $pdo->query("
    SELECT * FROM why_choose_us
    WHERE is_active=1
    ORDER BY id ASC
")->fetchAll();
?>

<div class="site-wrap">
    <?php include 'include/navbar.php'; ?>

    <!-- BANNER -->
    <div class="site-section site-blocks-cover pb-4"
        style="background-image:
     linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
     url('<?= $site_url ?>uploads/<?= $course['image'] ?>')">

        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2><?= $course['banner_title'] ?></h2>
                    <p><?= $course['banner_subtitle'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="index.php">Home</a>
            <span class="mx-3">›</span>
            <a href="courses.php">Courses</a>
            <span class="mx-3">›</span>
            <span class="current"><?= $course['title'] ?></span>
        </div>
    </div>

    <!-- OUTCOMES -->
    <div class="site-section bg-light">
        <div class="container">
            <h2 class="text-center text-primary mb-5">Key Learning Outcomes</h2>

            <div class="row">
                <?php foreach ($outcomes as $o): ?>
                    <div class="col-md-4 mb-4">
                        <div class="outcome-card">
                            <span class="outcome-icon <?= $o['icon'] ?>"></span>
                            <h4><?= $o['title'] ?></h4>
                            <p><?= $o['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- CURRICULUM -->
    <div class="site-section">
        <div class="container">
            <h2 class="text-center section-title mb-5">Curriculum & Subjects</h2>

            <div class="custom-accordion">
                <?php foreach ($curriculum as $i => $c): ?>
                    <div class="accordion-box <?= $i == 0 ? 'active' : '' ?>">
                        <div class="accordion-title">
                            <?= $c['title'] ?>
                            <span class="arrow"></span>
                        </div>
                        <div class="accordion-content">
                            <?= $c['content'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- METHODOLOGY -->
    <div class="site-section bg-light">
        <div class="container">
            <h2 class="text-center text-primary mb-5">
                <?= $course['title'] ?> Teaching Methodology
            </h2>

            <div class="row">
                <?php foreach ($methods as $m): ?>
                    <div class="col-md-6 mb-4">
                        <div class="method-card">
                            <span class="method-icon <?= $m['icon'] ?>"></span>
                            <h4><?= $m['title'] ?></h4>
                            <p><?= $m['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <!-- <div class="site-section cta-academic">
        <div class="container text-center">
            <h2>Ready to Join Our Academic Community?</h2>
            <p><?= $course['cta_text'] ?? 'Start your journey with us today.' ?></p>
            <a href="admissions.php" class="btn btn-primary">Begin Admission Process</a>
        </div>
    </div> -->

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


    <div class="site-section cta-academic">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">

                    <h2 class="cta-title">
                        Ready to Join Our Academic Community?
                    </h2>

                    <p class="cta-text">
                        Discover the difference a strong foundation can make. Our admissions team
                        is ready to guide you through the next steps.
                    </p>

                    <a href="admissions.php" class="btn btn-primary cta-btn">
                        Begin Admission Process
                    </a>

                </div>
            </div>
        </div>
    </div>


    <?php include 'include/footer.php'; ?>
</div>

<?php include 'include/footerScript.php'; ?>

<script>
    document.querySelectorAll('.accordion-title').forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.parentElement;
            document.querySelectorAll('.accordion-box').forEach(box => {
                if (box !== parent) box.classList.remove('active');
            });
            parent.classList.toggle('active');
        });
    });
</script>