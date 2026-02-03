<?php
require_once __DIR__ . '/include/header.php';

$id = $_GET['id'] ?? 0;
$about = $pdo->prepare("SELECT * FROM about_us WHERE id=?");
$about->execute([$id]);
$data = $about->fetch();
if (!$data) die('Not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $img = $data['image'];
    if (!empty($_FILES['image']['name'])) {
        $img = upload_image($_FILES['image'], 'about');
    }

    $pdo->prepare("
        UPDATE about_us SET
        subheading=?,title=?,description=?,vision=?,mission=?,image=?
        WHERE id=?
    ")->execute([
        $_POST['subheading'],
        $_POST['title'],
        $_POST['description'],
        $_POST['vision'],
        $_POST['mission'],
        $img,
        $id
    ]);

    flash_set('success', 'Updated successfully');
    // header("Location: aboutus.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>
<div class="content">
    <div class="topbar mb-3">
        <h5>Edit About Section</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Subheading -->
        <div class="mb-3">
            <label class="form-label">Subheading</label>
            <input type="text"
                name="subheading"
                class="form-control"
                value="<?= htmlspecialchars($data['subheading']) ?>">
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($data['title']) ?>">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                rows="4"
                class="form-control"><?= htmlspecialchars($data['description']) ?></textarea>
        </div>

        <!-- Vision -->
        <div class="mb-3">
            <label class="form-label">Vision</label>
            <textarea name="vision"
                rows="3"
                class="form-control"><?= htmlspecialchars($data['vision']) ?></textarea>
        </div>

        <!-- Mission -->
        <div class="mb-3">
            <label class="form-label">Mission</label>
            <textarea name="mission"
                rows="3"
                class="form-control"><?= htmlspecialchars($data['mission']) ?></textarea>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">About Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <?php if ($data['image']): ?>
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="<?= $site_url .'admin/uploads/'. $data['image'] ?>"
                    class="img-thumbnail"
                    style="max-height:150px;">
            </div>
        <?php endif; ?>

        <!-- Actions -->
        <div class="mt-4">
            <button class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="aboutus.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>


<?php require_once __DIR__ . '/include/footer.php'; ?>