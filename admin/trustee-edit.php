<?php
require_once __DIR__ . '/include/header.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM trustees WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
if (!$data) die('Trustee not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $photo = $data['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $photo = upload_image($_FILES['photo'], 'trustees');
    }

    $pdo->prepare("
        UPDATE trustees SET
            name=?, designation=?, photo=?, display_order=?, is_active=?
        WHERE id=?
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $photo,
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'Trustee updated');
    header("Location: trustees.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>
<div class="content">
    <div class="topbar mb-3">
        <h5>Edit Trustee</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Trustee Name</label>
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

        <!-- Photo -->
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <!-- Existing Photo -->
        <?php if ($data['photo']): ?>
            <div class="mb-3">
                <label class="form-label">Current Photo</label><br>
                <img src="<?= $site_url.'uploads/' . $data['photo'] ?>"
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
            <a href="trustees.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>


<?php require_once __DIR__ . '/include/footer.php'; ?>