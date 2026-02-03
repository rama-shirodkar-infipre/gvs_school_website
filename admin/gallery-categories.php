<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$rows = $pdo->query("
    SELECT * FROM gallery_categories
    ORDER BY display_order ASC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Gallery Categories</h5>
        <a href="gallery-category-add.php" class="btn btn-primary">+ Add Category</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Order</th>
            <th>Title</th>
            <th>Status</th>
            <th width="200">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= $r['display_order'] ?></td>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= $r['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="gallery-category-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="gallery-items.php?cat=<?= $r['id'] ?>" class="btn btn-sm btn-info">Items</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'include/footer.php'; ?>
