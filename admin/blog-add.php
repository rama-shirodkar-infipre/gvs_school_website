<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $image = upload_image($_FILES['image'], 'blogs');
    }

    $pdo->prepare("
        INSERT INTO blogs
        (title, slug, short_description, description, category, author, blog_date, image, is_active)
        VALUES (?,?,?,?,?,?,?,?,?)
    ")->execute([
        $_POST['title'],
        $_POST['slug'],
        $_POST['short_description'],
        $_POST['description'],
        $_POST['category'],
        $_POST['author'],
        $_POST['blog_date'],
        $image,
        $_POST['is_active']
    ]);

    flash_set('success', 'Blog added');
    header("Location: blogs.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Add Blog</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control mb-2" required>

        <label class="form-label">Slug (file name)</label>
        <input type="text" name="slug" class="form-control mb-2" placeholder="future-of-business-community.php">

        <label class="form-label">Short Description</label>

        <textarea name="short_description" class="form-control mb-2"></textarea>

        <label class="form-label">Full Description</label>
        <!-- <textarea name="description" class="form-control mb-2" rows="6"></textarea> -->
        <textarea name="description" id="editor" rows="8"></textarea>

        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Blog Date</label>
                <input type="date" name="blog_date" class="form-control">
            </div>
        </div>

        <label class="form-label mt-3">Image</label>
        <input type="file" name="image" class="form-control mb-2">

        <label class="form-label">Status</label>
        <select name="is_active" class="form-select mb-3">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <div class="mb-3">
            <button class="btn btn-primary">Save</button>
            <a href="blogs.php" class="btn btn-secondary">Back</a>
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