<?php
require_once 'include/header.php';

$cat = $_GET['cat'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('CSRF error');

    $img = upload_image($_FILES['image'], 'gallery');

    $pdo->prepare("
        INSERT INTO gallery_items
        (category_id,title,subtitle,image,display_order,is_active)
        VALUES (?,?,?,?,?,?)
    ")->execute([
        $cat,
        $_POST['title'],
        $_POST['subtitle'],
        $img,
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    header("Location: gallery-items.php?cat=$cat");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>Add Gallery Item</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control mb-3">

        <label class="form-label">Subtitle</label>
        <input type="text" name="subtitle" class="form-control mb-3">

        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control mb-3" required>

        <label class="form-label">Display Order</label>
        <input type="number" name="display_order" class="form-control mb-3">

        <label class="form-label">Status</label>
        <select name="is_active" class="form-select mb-3">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <div class="mb-3">
            <button class="btn btn-primary">Save</button>
            <a href="gallery-items.php?cat=<?= $cat ?>" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php include 'include/footer.php'; ?>