<?php
require_once __DIR__ . '/include/header.php';

/* Get blog ID */
$id = $_GET['id'] ?? 0;

/* Fetch blog */
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die('Blog not found');
}

/* Handle form submit */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) {
        die('Invalid CSRF token');
    }

    $image = $blog['image'];

    if (!empty($_FILES['image']['name'])) {
        $image = upload_image($_FILES['image'], 'blogs');
    }

    $pdo->prepare("
        UPDATE blogs SET
            title = ?,
            slug = ?,
            short_description = ?,
            description = ?,
            category = ?,
            author = ?,
            blog_date = ?,
            image = ?,
            is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['title'],
        $_POST['slug'],
        $_POST['short_description'],
        $_POST['description'],
        $_POST['category'],
        $_POST['author'],
        $_POST['blog_date'],
        $image,
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'Blog updated successfully');
    header("Location: blogs.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar mb-3">
        <h5>Edit Blog</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Blog Title</label>
            <input type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($blog['title']) ?>"
                required>
        </div>

        <!-- Slug -->
        <div class="mb-3">
            <label class="form-label">Page Slug / File Name</label>
            <input type="text"
                name="slug"
                class="form-control"
                value="<?= htmlspecialchars($blog['slug']) ?>"
                placeholder="future-of-business-community.php">
        </div>

        <!-- Short Description -->
        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description"
                class="form-control"
                rows="3"><?= htmlspecialchars($blog['short_description']) ?></textarea>
        </div>

        <!-- Full Description -->
        <div class="mb-3">
            <label class="form-label">Full Description</label>
            <textarea name="description"
                id="editor"
                rows="8"><?= htmlspecialchars($blog['description']) ?></textarea>

        </div>

        <div class="row">
            <!-- Category -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Category</label>
                <input type="text"
                    name="category"
                    class="form-control"
                    value="<?= htmlspecialchars($blog['category']) ?>">
            </div>

            <!-- Author -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Author</label>
                <input type="text"
                    name="author"
                    class="form-control"
                    value="<?= htmlspecialchars($blog['author']) ?>">
            </div>

            <!-- Blog Date -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Blog Date</label>
                <input type="date"
                    name="blog_date"
                    class="form-control"
                    value="<?= $blog['blog_date'] ?>">
            </div>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">Blog Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Existing Image -->
        <?php if ($blog['image']): ?>
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="<?= $site_url.'uploads/' . $blog['image'] ?>"
                    class="img-thumbnail"
                    style="max-height:180px;">
            </div>
        <?php endif; ?>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="is_active" class="form-select">
                <option value="1" <?= $blog['is_active'] ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= !$blog['is_active'] ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">
                Update Blog
            </button>
            <a href="blogs.php" class="btn btn-secondary ms-2">
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