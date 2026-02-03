<?php
require_once __DIR__ . '/include/header.php';
require_once __DIR__ . '/include/navbar.php';

$rows = $pdo->query("SELECT * FROM about_us ORDER BY id DESC")->fetchAll();
?>

<div class="content">

    <div class="topbar d-flex justify-content-between align-items-center">
        <h5>About Us</h5>
        <a href="about-add.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add About Section
        </a>
    </div>

    <?php if ($msg = flash_get('success')): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($r['title']) ?></td>
                        <td>
                            <?php if ($r['image']): ?>
                                <img src="<?= $site_url.'uploads/'.$r['image'] ?>" height="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $r['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>' ?>
                        </td>
                        <td>
                            <a href="about-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="about-delete.php?id=<?= $r['id'] ?>"
                               onclick="return confirm('Delete this record?')"
                               class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>
