<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $img = upload_image($_FILES['image'], 'about');

    $pdo->prepare("
        INSERT INTO about_us
        (subheading,title,description,vision,mission,image)
        VALUES (?,?,?,?,?,?)
    ")->execute([
        $_POST['subheading'],
        $_POST['title'],
        $_POST['description'],
        $_POST['vision'],
        $_POST['mission'],
        $img
    ]);

    flash_set('success', 'About section added');
    header("Location: aboutus.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Add About Section</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <div class="mb-3">
            <label>Subheading</label>
            <input type="text" name="subheading" class="form-control">
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Vision</label>
                <textarea name="vision" class="form-control"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label>Mission</label>
                <textarea name="mission" class="form-control"></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <button class="btn btn-success ">Save</button>
            <a href="aboutus.php" class="btn btn-secondary ">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>