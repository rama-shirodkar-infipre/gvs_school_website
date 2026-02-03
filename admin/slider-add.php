<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $image = upload_image($_FILES['image'], 'sliders');

    $pdo->prepare("
        INSERT INTO home_sliders (title, subtitle, image, display_order, is_active)
        VALUES (?,?,?,?,?)
    ")->execute([
        $_POST['title'],
        $_POST['subtitle'],
        $image,
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    flash_set('success', 'Slider added');
    header("Location: home-master.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>
<div class="content">
    <h5>Add Slider</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text"
                name="title"
                class="form-control"
                placeholder="Enter slider title">
        </div>

        <!-- Subtitle -->
        <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text"
                name="subtitle"
                class="form-control"
                placeholder="Enter slider subtitle">
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">Slider Image</label>
            <input type="file"
                name="image"
                class="form-control"
                required>
        </div>

        <div class="row">
            <!-- Display Order -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    class="form-control"
                    value="0">
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-3">
            <button class="btn btn-success px-4">
                <i class="bi bi-save"></i> Save
            </button>
            <a href="home-master.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>


<?php require_once __DIR__ . '/include/footer.php'; ?>