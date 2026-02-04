<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

// Fetch counts from DB
$stats = [];
$tables = [
    'blogs' => 'Total Blogs',
    'gallery_items' => 'Gallery Items',
    'programs_activities' => 'Programs',
    'contact_enquiries' => 'Messages',
    'team' => 'Team Members',
    'trustees' => 'Trustees',
    'testimonials' => 'Testimonials',
    'faqs' => 'FAQs',
    'home_sliders' => 'Sliders'
];

foreach ($tables as $table => $label) {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM `$table`");
    $stats[$label] = $stmt->fetch()['count'];
}

// Colors for cards
$colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'bg-info', 'bg-secondary', 'bg-dark', 'bg-purple', 'bg-teal'];
?>

<div class="content">

    <!-- Top Bar -->
    <div class="topbar d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="mb-0">Welcome, <?= htmlspecialchars($_SESSION['admin_name']) ?></h5>
            <small class="text-muted">GVS School Website</small>
        </div>
        <div class="text-muted">
            <i class="bi bi-calendar3"></i> <?= date('d M Y, l') ?>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <?php $i = 0;
        foreach ($stats as $label => $count): ?>
            <div class="col-md-3">
                <div class="card stat-card <?= $colors[$i % count($colors)] ?> text-white shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h6 class="mb-2"><?= $label ?></h6>
                        <h2 class="mb-0"><?= $count ?></h2>
                    </div>
                </div>
            </div>
        <?php $i++;
        endforeach; ?>
    </div>

    <!-- Quick Links / Actions -->
    <div class="row mt-4 g-3">
        <div class="col-md-4">
            <a href="blogs.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm hover-scale">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-richtext display-4 text-primary mb-2"></i>
                        <h6>Manage Blogs</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="gallery.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm hover-scale">
                    <div class="card-body text-center">
                        <i class="bi bi-images display-4 text-success mb-2"></i>
                        <h6>Manage Gallery</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="programs.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm hover-scale">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-event display-4 text-warning mb-2"></i>
                        <h6>Manage Programs</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Admin Overview -->
    <div class="card mt-4 border-0 shadow-sm">
        <div class="card-body">
            <h6>Admin Overview</h6>
            <p class="text-muted mb-0">
                Manage <strong>blogs, gallery, programs, team members, trustees, testimonials, sliders, and FAQs</strong> of
                <strong>GVS School Website</strong> from this dashboard. Quickly see stats and navigate to management pages.
            </p>
        </div>
    </div>

</div>

<style>
    /* Extra styling for dashboard */
    .stat-card {
        border-radius: 10px;
        text-align: center;
        padding: 20px;
    }

    .hover-scale:hover {
        transform: scale(1.05);
        transition: 0.3s;
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .bg-teal {
        background-color: #20c997 !important;
    }
</style>

<?php require_once 'include/footer.php'; ?>