<?php
require_once __DIR__ . '/include/header.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
if (!$data) die('Testimonial not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $photo = $data['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $photo = upload_image($_FILES['photo'], 'testimonials');
    }

    $pdo->prepare("
        UPDATE testimonials SET
            name = ?,
            designation = ?,
            message = ?,
            photo = ?,
            display_order = ?,
            is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $_POST['message'],
        $photo,
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'Testimonial updated successfully');
    header("Location: home-master.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar mb-3">
        <h5>Edit Testimonial</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text"
                name="name"
                class="form-control"
                value="<?= htmlspecialchars($data['name']) ?>"
                required>
        </div>

        <!-- Designation -->
        <div class="mb-3">
            <label class="form-label">Designation</label>
            <input type="text"
                name="designation"
                class="form-control"
                value="<?= htmlspecialchars($data['designation']) ?>">
        </div>

        <!-- Message -->
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message"
                class="form-control"
                rows="4"><?= htmlspecialchars($data['message']) ?></textarea>
        </div>

        <!-- Photo -->
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <!-- Existing Photo -->
        <?php if ($data['photo']): ?>
            <div class="mb-3">
                <label class="form-label">Current Photo</label><br>
                <img src="<?= $site_url.'uploads/'. $data['photo'] ?>"
                    class="img-thumbnail"
                    style="max-height:150px;">
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Display Order -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    value="<?= $data['display_order'] ?>"
                    class="form-control">
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
        <div class="mt-4">
            <button class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="home-master.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>