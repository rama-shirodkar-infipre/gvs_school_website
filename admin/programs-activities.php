<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("
    SELECT * FROM programs_activities
    ORDER BY id DESC
")->fetchAll();
?>

<div class="content">
    <div class="d-flex justify-content-between mb-3">
        <h5>Programs & Activities</h5>
        <a href="program-activity-add.php" class="btn btn-primary">
            + Add Program
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Status</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $i => $r): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?php if ($r['image']): ?>
                            <img src="<?= $site_url ?>uploads/<?= $r['image'] ?>"
                                height="50">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td>
                        <?php if ($r['program_date'] && $r['to_date']): ?>
                            <?= date('d M Y', strtotime($r['program_date'])) ?> - <?= date('d M Y', strtotime($r['to_date'])) ?>
                        <?php else: ?>
                            <?= date('d M Y', strtotime($r['program_date'])) ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-<?= $r['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $r['is_active'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td>
                        <a href="program-activity-edit.php?id=<?= $r['id'] ?>"
                            class="btn btn-sm btn-warning">Edit</a>
                        <a href="program-activity-delete.php?id=<?= $r['id'] ?>"
                            onclick="return confirm('Delete this record?')"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'include/footer.php'; ?>