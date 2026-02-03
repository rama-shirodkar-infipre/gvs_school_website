<?php
require_once 'include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('CSRF error');

    $pdo->prepare("
        INSERT INTO gallery_categories (title, display_order, is_active)
        VALUES (?,?,?)
    ")->execute([
        $_POST['title'],
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    header("Location: gallery-categories.php");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>Add Gallery Category</h5>

    <form method="post" class="card p-4">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label class="form-label">Category Title</label>
        <input type="text" name="title" class="form-control mb-3" required>

        <label class="form-label">Display Order</label>
        <input type="number" name="display_order" class="form-control mb-3">

        <label class="form-label">Status</label>
        <select name="is_active" class="form-select mb-3">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <div class="mb-3">
            <button class="btn btn-primary">Save</button>
            <a href="gallery-categories.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php include 'include/footer.php'; ?>