<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$data = $pdo->query("SELECT * FROM about_us LIMIT 1")->fetch();

$history = [];
if ($data) {
    $stmt = $pdo->prepare("SELECT * FROM about_history WHERE about_id=?");
    $stmt->execute([$data['id']]);
    $history = $stmt->fetchAll();
}

?>

<div class="content">

    <!-- Top Bar -->
    <div class="topbar d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">About Us</h5>
        <a href="aboutus-edit.php" class="btn btn-primary">
            <i class="bi bi-pencil-square"></i> Edit About Page
        </a>
    </div>

    <?php if ($data): ?>

        <!-- ABOUT SECTION -->
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold bg-light">
                About Section
            </div>
            <div class="card-body">
                <span class="badge bg-secondary mb-2"><?= $data['subheading'] ?></span>
                <h3 class="fw-bold"><?= $data['title'] ?></h3>

                <div class="row mt-3">
                    <div class="col-lg-8">
                        <p><?= $data['description'] ?></p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <?php if ($data['image']): ?>
                            <img src="<?= $site_url ?>uploads/<?= $data['image'] ?>"
                                class="img-fluid rounded shadow-sm"
                                style="max-height:220px;">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- VISION & MISSION -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light fw-bold">
                        Vision
                    </div>
                    <div class="card-body">
                        <?= nl2br($data['vision']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light fw-bold">
                        Mission
                    </div>
                    <div class="card-body">
                        <?= nl2br($data['mission']) ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($history)): ?>
            <!-- HISTORY SECTION -->
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold bg-light">
                    Saunstha & School History
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($history as $index => $h): ?>
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-3 h-100">
                                    <span class="badge bg-primary mb-2">
                                        History <?= $index + 1 ?>
                                    </span>
                                    <p class="mb-0">
                                        <?= nl2br($h['description']) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <!-- PRESIDENT MESSAGE -->
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold bg-light">
                President & Head of School
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-center">
                        <?php if ($data['president_image']): ?>
                            <img src="<?= $site_url ?>uploads/<?= $data['president_image'] ?>"
                                class="img-fluid rounded-circle shadow"
                                style="max-width:180px;">
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-8">
                        <blockquote class="blockquote">
                            <p class="mb-3"><?= nl2br($data['president_message']) ?></p>
                        </blockquote>
                        <h6 class="fw-bold mb-0"><?= $data['president_name'] ?></h6>
                        <small class="text-muted"><?= $data['president_designation'] ?></small>

                        <?php if (!empty($data['president_quote'])): ?>
                            <p class="mt-3 fst-italic text-secondary">
                                “<?= $data['president_quote'] ?>”
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-warning shadow-sm">
            No About Us content added yet.
        </div>
    <?php endif; ?>

</div>

<?php require_once 'include/footer.php'; ?>