<?php
require_once __DIR__ . '/include/header.php';
require_once __DIR__ . '/include/navbar.php';

$rows = $pdo->query("
    SELECT * FROM team
    ORDER BY display_order ASC, id DESC
")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between align-items-center">
        <h5>Team Members</h5>
        <a href="team-add.php" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Team Member
        </a>
    </div>

    <?php if ($msg = flash_get('success')): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td>
                            <?php if ($r['photo']): ?>
                                <img src="<?= $site_url.'uploads/' . $r['photo'] ?>" height="50">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($r['name']) ?></td>
                        <td><?= htmlspecialchars($r['designation']) ?></td>
                        <td><?= $r['display_order'] ?></td>
                        <td>
                            <span class="badge <?= $r['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                <?= $r['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td>
                            <a href="team-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="team-delete.php?id=<?= $r['id'] ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this member?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>