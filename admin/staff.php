<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("SELECT * FROM staff_members ORDER BY id DESC")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between mb-3">
        <h5>Staff Members</h5>
        <a href="staff-add.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Staff
        </a>
    </div>

    <table class="table table-bordered align-middle">
        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Status</th>
            <th width="160">Action</th>
        </tr>

        <?php foreach ($rows as $i => $r): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td>
                    <?php if ($r['image']): ?>
                        <img src="<?= $site_url ?>uploads/<?= $r['image'] ?>"
                            style="height:50px;border-radius:50%;">
                    <?php endif; ?>
                </td>
                <td><?= $r['name'] ?></td>
                <td><?= $r['designation'] ?></td>
                <td>
                    <?= $r['is_active']
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>' ?>
                </td>
                <td>
                    <a href="staff-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="staff-delete.php?id=<?= $r['id'] ?>"
                        onclick="return confirm('Delete this staff?')"
                        class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once 'include/footer.php'; ?>