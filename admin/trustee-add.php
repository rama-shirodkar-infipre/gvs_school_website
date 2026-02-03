<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $photo = upload_image($_FILES['photo'], 'trustees');

    $pdo->prepare("
        INSERT INTO trustees
        (name, designation, photo, display_order, is_active)
        VALUES (?,?,?,?,?)
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $photo,
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    flash_set('success', 'Trustee added successfully');
    header("Location: trustees.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar"><h5>Add Trustee</h5></div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" required class="form-control">
        </div>

        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Display Order</label>
                <input type="number" name="display_order" class="form-control" value="0">
            </div>
            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="trustees.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>
