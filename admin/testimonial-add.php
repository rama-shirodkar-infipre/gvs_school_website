<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $photo = upload_image($_FILES['photo'], 'testimonials');

    $pdo->prepare("
        INSERT INTO testimonials (name, designation, message, photo, display_order, is_active)
        VALUES (?,?,?,?,?,?)
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $_POST['message'],
        $photo,
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    flash_set('success', 'Testimonial added');
    header("Location: home-master.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <h5>Add Testimonial</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text"
                name="name"
                class="form-control"
                placeholder="Enter name"
                required>
        </div>

        <!-- Designation -->
        <div class="mb-3">
            <label class="form-label">Designation</label>
            <input type="text"
                name="designation"
                class="form-control"
                placeholder="Enter designation">
        </div>

        <!-- Message -->
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message"
                class="form-control"
                rows="4"
                placeholder="Enter testimonial message"></textarea>
        </div>

        <!-- Photo -->
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file"
                name="photo"
                class="form-control">
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