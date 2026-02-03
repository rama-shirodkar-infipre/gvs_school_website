<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("
    SELECT * FROM contact_enquiries
    ORDER BY created_at DESC
")->fetchAll();
?>

<div class="content">
    <h5 class="mb-3">Contact Enquiries</h5>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th width="140">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $i => $r): ?>
                <tr class="<?= !$r['is_read'] ? 'table-warning' : '' ?>">
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars($r['service']) ?></td>
                    <td><?= date('d M Y H:i', strtotime($r['created_at'])) ?></td>
                    <td>
                        <span class="badge bg-<?= $r['is_read'] ? 'success' : 'secondary' ?>">
                            <?= $r['is_read'] ? 'Read' : 'New' ?>
                        </span>
                    </td>
                    <td>
                        <a href="contact-view.php?id=<?= $r['id'] ?>"
                            class="btn btn-sm btn-primary">View</a>
                        <a href="contact-delete.php?id=<?= $r['id'] ?>"
                            onclick="return confirm('Delete enquiry?')"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'include/footer.php'; ?>