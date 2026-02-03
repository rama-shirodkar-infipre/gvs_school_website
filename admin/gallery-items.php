<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$cat = $_GET['cat'];

$items = $pdo->prepare("
    SELECT * FROM gallery_items
    WHERE category_id=?
    ORDER BY display_order ASC
");
$items->execute([$cat]);
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Gallery Items</h5>
        <a href="gallery-item-add.php?cat=<?= $cat ?>" class="btn btn-primary">+ Add Item</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Status</th>
            <th width="160">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $i): ?>
            <tr>
                <td>
                    <img src="<?= $site_url.'uploads/'.$i['image'] ?>" height="60">
                </td>
                <td><?= htmlspecialchars($i['title']) ?></td>
                <td><?= htmlspecialchars($i['subtitle']) ?></td>
                <td><?= $i['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="gallery-item-edit.php?id=<?= $i['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="gallery-item-delete.php?id=<?= $i['id'] ?>"
                       onclick="return confirm('Delete?')"
                       class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'include/footer.php'; ?>
