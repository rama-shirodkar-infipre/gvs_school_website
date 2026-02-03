<?php
require_once __DIR__ . '/include/header.php';

/* Get service ID */
$id = $_GET['id'] ?? 0;

/* Fetch existing service */
$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$id]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    die('Service not found');
}

/* Handle form submit */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) {
        die('Invalid CSRF token');
    }

    $pdo->prepare("
        UPDATE services SET
            title = ?,
            short_description = ?,
            long_description = ?,
            icon_svg = ?,
            page_slug = ?,
            display_order = ?,
            is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['title'],
        $_POST['short_description'],
        $_POST['long_description'],
        $_POST['icon_svg'],
        $_POST['page_slug'],
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'Service updated successfully');
    header("Location: services.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Edit Service</h5>
    </div>

    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Service Title -->
        <div class="mb-3">
            <label class="form-label">Service Title</label>
            <input type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($service['title']) ?>"
                required>
        </div>

        <!-- Short Description -->
        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description"
                class="form-control"
                rows="4"><?= htmlspecialchars($service['short_description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Long Description</label>
            <textarea name="long_description" id="editor" rows="8"><?= htmlspecialchars($service['long_description']) ?></textarea>
        </div>


        <!-- Icon SVG -->
        <div class="mb-3">
            <label class="form-label">Icon SVG Code</label>
            <textarea name="icon_svg"
                class="form-control"
                rows="6"
                placeholder="Paste full SVG code here"><?= htmlspecialchars($service['icon_svg']) ?></textarea>
            <small class="text-muted">
                Paste complete &lt;svg&gt;…&lt;/svg&gt; code
            </small>
        </div>

        <!-- Page Slug -->
        <div class="mb-3">
            <label class="form-label">Page Slug</label>
            <input type="text"
                name="page_slug"
                class="form-control"
                value="<?= htmlspecialchars($service['page_slug']) ?>"
                placeholder="event-planning-and-community-events.php">
        </div>

        <!-- Order & Status -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    class="form-control"
                    value="<?= $service['display_order'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" <?= $service['is_active'] ? 'selected' : '' ?>>
                        Active
                    </option>
                    <option value="0" <?= !$service['is_active'] ? 'selected' : '' ?>>
                        Inactive
                    </option>
                </select>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                Update Service
            </button>
            <a href="services.php" class="btn btn-secondary">
                Back
            </a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>
<script>
    CKEDITOR.replace('editor', {
        height: 300,
        removeButtons: 'PasteFromWord',
        filebrowserUploadMethod: 'form'
    });
</script>