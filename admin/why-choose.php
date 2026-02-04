<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("SELECT * FROM why_choose_us ORDER BY id DESC")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between mb-3">
        <h5>Why Choose Us</h5>
        <a href="why-choose-add.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Icon</th>
                <th>Title</th>
                <th>Status</th>
                <th width="160">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $i => $r): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><i class="<?= $r['icon'] ?>"></i></td>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td>
                        <?= $r['is_active']
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-secondary">Inactive</span>' ?>
                    </td>
                    <td>
                        <a href="why-choose-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="why-choose-delete.php?id=<?= $r['id'] ?>"
                            onclick="return confirm('Delete this item?')"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'include/footer.php'; ?>