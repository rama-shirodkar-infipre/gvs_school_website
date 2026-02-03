<?php
require_once __DIR__ . '/include/header.php';

$id = $_GET['id'] ?? 0;
$data = $pdo->prepare("SELECT * FROM home_sliders WHERE id=?");
$data->execute([$id]);
$data = $data->fetch();
if (!$data) die('Not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $image = $data['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = upload_image($_FILES['image'], 'sliders');
    }

    $pdo->prepare("
        UPDATE home_sliders SET title=?, subtitle=?, image=?, display_order=?, is_active=?
        WHERE id=?
    ")->execute([
        $_POST['title'],
        $_POST['subtitle'],
        $image,
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'Slider updated');
    header("Location: home-master.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>
<div class="content">
    <h5>Edit Slider</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($data['title']) ?>">
        </div>

        <!-- Subtitle -->
        <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text"
                name="subtitle"
                class="form-control"
                value="<?= htmlspecialchars($data['subtitle']) ?>">
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">Slider Image</label>
            <input type="file"
                name="image"
                class="form-control">
        </div>

        <!-- Existing Image -->
        <?php if ($data['image']): ?>
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="<?= $site_url.'uploads/'. $data['image'] ?>"
                    class="img-thumbnail"
                    style="max-height: 120px;">
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Display Order -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    class="form-control"
                    value="<?= $data['display_order'] ?>">
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" <?= $data['is_active'] ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= !$data['is_active'] ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-3">
            <button class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="home-master.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>