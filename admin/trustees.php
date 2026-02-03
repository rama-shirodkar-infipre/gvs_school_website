<?php
require_once __DIR__ . '/include/header.php';
require_once __DIR__ . '/include/navbar.php';

$rows = $pdo->query("SELECT * FROM trustees ORDER BY display_order ASC, id DESC")->fetchAll();
?>

<div class="content">

    <div class="topbar d-flex justify-content-between align-items-center">
        <h5>Trustees</h5>
        <a href="trustee-add.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Trustee
        </a>
    </div>

    <?php if ($msg = flash_get('success')): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <?php if ($r['photo']): ?>
                                <img src="<?= $site_url.'uploads/'.$r['photo'] ?>" height="55" class="rounded">
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($r['name']) ?></td>
                        <td><?= htmlspecialchars($r['designation']) ?></td>
                        <td>
                            <?= $r['is_active']
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-secondary">Inactive</span>' ?>
                        </td>
                        <td>
                            <a href="trustee-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="trustee-delete.php?id=<?= $r['id'] ?>"
                               onclick="return confirm('Delete trustee?')"
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
