<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("
    SELECT * FROM mi_vaishya_pdfs
    ORDER BY year DESC, quarter DESC
")->fetchAll();
?>

<div class="content">
    <div class="d-flex justify-content-between mb-3">
        <h5>Mi Vaishya PDFs</h5>
        <a href="mi-vaishya-add.php" class="btn btn-primary">+ Add PDF</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Quarter</th>
                <th>Year</th>
                <th>Status</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $i => $r): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td><?= $r['quarter'] ?></td>
                    <td><?= $r['year'] ?></td>
                    <td>
                        <span class="badge bg-<?= $r['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $r['is_active'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td>
                        <a href="mi-vaishya-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="mi-vaishya-delete.php?id=<?= $r['id'] ?>"
                            onclick="return confirm('Delete this PDF?')"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'include/footer.php'; ?>