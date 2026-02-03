<?php
error_reporting(1);
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pdo->prepare("
        INSERT INTO services
        (title,short_description,long_description,icon_svg,page_slug,display_order,is_active)
        VALUES (?,?,?,?,?,?,?)
    ")->execute([
        $_POST['title'],
        $_POST['short_description'],
        $_POST['long_description'],
        $_POST['icon_svg'],
        $_POST['page_slug'],
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    flash_set('success', 'Service added');
    header("Location: services.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Add Service</h5>
    </div>

    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label class="form-label">Service Title</label>
        <input type="text" name="title" class="form-control mb-3" required>

        <label class="form-label">Short Description</label>
        <textarea name="short_description" class="form-control mb-3"></textarea>

        <label class="form-label">Long Description</label>
        <textarea name="long_description" id="editor" rows="8"></textarea>

        <label class="form-label">Icon SVG Code</label>
        <textarea name="icon_svg" class="form-control mb-3" rows="5"
            placeholder="Paste full SVG here"></textarea>

        <label class="form-label">Page Slug</label>
        <input type="text" name="page_slug" class="form-control mb-3"
            placeholder="event-planning-and-community-events.php">

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Save</button>
            <a href="services.php" class="btn btn-secondary">Back</a>
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