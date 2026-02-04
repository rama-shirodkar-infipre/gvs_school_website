<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$data = $pdo->query("SELECT * FROM admission_intro LIMIT 1")->fetch();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between mb-3">
        <h5>Admission Intro</h5>
        <a href="admission-intro-edit.php" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>

    <?php if ($data): ?>
        <div class="card p-4 shadow-sm">
            <h4><?= htmlspecialchars($data['heading']) ?></h4>
            <h6 class="text-muted"><?= htmlspecialchars($data['subheading']) ?></h6>
            <p><?= nl2br($data['description']) ?></p>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No content added yet.</div>
    <?php endif; ?>
</div>

<?php require_once 'include/footer.php'; ?>