<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM staff_members WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
if (!$data) die('Not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $img = $data['image'];
    if (!empty($_FILES['image']['name'])) {
        $img = upload_image($_FILES['image'], 'staff');
    }

    $pdo->prepare("
        UPDATE staff_members SET
        name=?, designation=?, bio=?, image=?
        WHERE id=?
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $_POST['bio'],
        $img,
        $id
    ]);

    flash_set('success', 'Updated successfully');
    header("Location: why-choose.php");
    exit;
}

?>

<div class="content">
    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Name</label>
        <input name="name" class="form-control mb-2" value="<?= $data['name'] ?>">

        <label>Designation</label>
        <input name="designation" class="form-control mb-2" value="<?= $data['designation'] ?>">

        <label>Bio</label>
        <textarea name="bio" class="form-control mb-2" rows="3"><?= $data['bio'] ?></textarea>

        <label>Photo</label>
        <input type="file" name="image" class="form-control mb-2">

        <?php if ($data['image']): ?>
            <img src="<?= $site_url ?>uploads/<?= $data['image'] ?>"
                class="img-thumbnail mt-2"
                width="150" height="200">
        <?php endif; ?>
        <div class="mb-1">

            <button class="btn btn-primary mt-3">Update</button>
            <a href="staff.php" class="btn btn-secondary mt-3">Back</a>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>