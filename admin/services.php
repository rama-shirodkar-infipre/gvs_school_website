<?php
require_once __DIR__.'/include/header.php';
require_once __DIR__.'/include/navbar.php';

$rows = $pdo->query("
    SELECT * FROM services
    ORDER BY display_order ASC, id DESC
")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Services</h5>
        <a href="service-add.php" class="btn btn-primary">+ Add Service</a>
    </div>

    <?php if ($msg = flash_get('success')): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Order</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= $r['display_order'] ?></td>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= $r['page_slug'] ?></td>
                <td>
                    <span class="badge <?= $r['is_active']?'bg-success':'bg-secondary' ?>">
                        <?= $r['is_active']?'Active':'Inactive' ?>
                    </span>
                </td>
                <td>
                    <a href="service-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="service-feature.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-info">Features</a>
                    <a href="service-delete.php?id=<?= $r['id'] ?>"
                       onclick="return confirm('Delete service?')"
                       class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__.'/include/footer.php'; ?>
