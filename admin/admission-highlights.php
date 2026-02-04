<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("SELECT * FROM admission_highlights")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Admission Highlights</h5>
        <a href="admission-highlight-action.php" class="btn btn-primary">Add</a>
    </div>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Icon</th>
            <th>Title</th>
            <th>Status</th>
            <th width="160">Action</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><i class="<?= $r['icon'] ?>"></i></td>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= $r['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="admission-highlight-action.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="admission-highlight-action.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once 'include/footer.php'; ?>