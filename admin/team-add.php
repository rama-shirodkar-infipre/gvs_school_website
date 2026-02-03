<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $photo = null;
    if (!empty($_FILES['photo']['name'])) {
        $photo = upload_image($_FILES['photo'], 'team');
    }

    $pdo->prepare("
        INSERT INTO team
        (name,designation,photo,linkedin,twitter,instagram,display_order,is_active)
        VALUES (?,?,?,?,?,?,?,?)
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $photo,
        $_POST['linkedin'],
        $_POST['twitter'],
        $_POST['instagram'],
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    flash_set('success', 'Team member added');
    header("Location: team.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Add Team Member</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Designation</label>
            <input type="text" name="designation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">LinkedIn</label>
                <input type="text" name="linkedin" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Twitter</label>
                <input type="text" name="twitter" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Instagram</label>
                <input type="text" name="instagram" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="0">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Save</button>
            <a href="team.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>