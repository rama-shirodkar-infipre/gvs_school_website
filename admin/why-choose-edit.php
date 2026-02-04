<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? 0;

// Fetch record
$stmt = $pdo->prepare("SELECT * FROM why_choose_us WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    die('Record not found');
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $pdo->prepare("
        UPDATE why_choose_us SET
        icon = ?,
        title = ?,
        description = ?,
        is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['icon'],
        $_POST['title'],
        $_POST['description'],
        isset($_POST['is_active']) ? 1 : 0,
        $id
    ]);

    flash_set('success', 'Updated successfully');
    header("Location: why-choose.php");
    exit;
}

require_once 'include/navbar.php';
?>

<div class="content">

    <!-- Topbar -->
    <div class="topbar mb-4 d-flex justify-content-between align-items-center">
        <h5>Edit Why Choose Us</h5>
        <a href="why-choose.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <!-- Form -->
    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <div class="mb-3">
            <label class="form-label fw-semibold">Icon Class</label>
            <input type="text"
                name="icon"
                class="form-control"
                placeholder="eg: flaticon-library"
                value="<?= htmlspecialchars($data['icon']) ?>">
            <small class="text-muted">
                Use icon class from flaticon (example: flaticon-mortarboard)
            </small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Title</label>
            <input type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($data['title']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description"
                id="editor"
                class="form-control"><?= htmlspecialchars($data['description']) ?></textarea>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input"
                type="checkbox"
                name="is_active"
                value="1"
                id="activeCheck"
                <?= $data['is_active'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="activeCheck">
                Active
            </label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="why-choose.php" class="btn btn-outline-secondary px-4">
                Cancel
            </a>
        </div>

    </form>
</div>

<?php require_once 'include/footer.php'; ?>

<script>
    CKEDITOR.replace('editor', {
        height: 250,
        removeButtons: 'PasteFromWord',
        filebrowserUploadMethod: 'form'
    });
</script>