<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("SELECT * FROM admission_documents")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Required Documents</h5>
        <a href="admission-document-action.php" class="btn btn-primary">Add</a>
    </div>

    <ul class="list-group mt-3">
        <?php foreach ($rows as $r): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= htmlspecialchars($r['document_name']) ?>
                <span>
                    <a href="admission-document-action.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="admission-document-action.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete?')">Delete</a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php require_once 'include/footer.php'; ?>