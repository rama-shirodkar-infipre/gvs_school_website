<?php
require_once 'include/header.php';
require_once 'include/navbar.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $pdo->prepare("
        INSERT INTO why_choose_us (icon,title,description)
        VALUES (?,?,?)
    ")->execute([
        $_POST['icon'],
        $_POST['title'],
        $_POST['description']
    ]);

    flash_set('success', 'Added successfully');
    header("Location: why-choose.php");
    exit;
}


?>

<div class="content">
    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Icon Class (eg: flaticon-library)</label>
        <input name="icon" class="form-control mb-2">

        <label>Title</label>
        <input name="title" class="form-control mb-2">

        <label>Description</label>
        <textarea name="description" id="editor" class="form-control"></textarea>

        <div class="mb-1">
            <a href="why-choose.php" class="btn btn-secondary mt-3">Back</a>
            <button class="btn btn-success mt-3">Save</button>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>


<script>
    CKEDITOR.replace('editor', {
        height: 250
    });
</script>