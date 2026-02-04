<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $img = upload_image($_FILES['image'], 'staff');

    $pdo->prepare("
        INSERT INTO staff_members (name,designation,bio,image)
        VALUES (?,?,?,?)
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $_POST['bio'],
        $img
    ]);

    flash_set('success', 'Staff added');
    header("Location: staff.php");
    exit;
}

?>

<div class="content">
    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Name</label>
        <input name="name" class="form-control mb-2">

        <label>Designation</label>
        <input name="designation" class="form-control mb-2">

        <label>Bio</label>
        <textarea name="bio" class="form-control mb-2" rows="3"></textarea>

        <label>Photo</label>
        <input type="file" name="image" class="form-control mb-3">

        <div class="mb-1">
            <button class="btn btn-success">Save</button>
            <a href="staff.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>