<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("SELECT * FROM admission_steps ORDER BY step_no ASC")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Admission Steps</h5>
        <a href="admission-step-action.php" class="btn btn-primary">Add Step</a>
    </div>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Step</th>
            <th>Title</th>
            <th>Status</th>
            <th width="160">Action</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= $r['step_no'] ?></td>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= $r['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="admission-step-action.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="admission-step-action.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this step?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once 'include/footer.php'; ?>